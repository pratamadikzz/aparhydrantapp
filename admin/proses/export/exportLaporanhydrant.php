<?php
// File: admin/proses/export/exportLaporanhydrant.php

try {
    include '../../../koneksi.php';

    if (!$koneksi) {
        throw new Exception("Koneksi database gagal / variabel \$koneksi kosong. Cek koneksi.php.");
    }

    $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
    $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';

    $monthMapping = [
        'Januari'   => '01', 'Februari' => '02', 'Maret'    => '03',
        'April'     => '04', 'Mei'      => '05', 'Juni'     => '06',
        'Juli'      => '07', 'Agustus'  => '08', 'September'=> '09',
        'Oktober'   => '10', 'November' => '11', 'Desember' => '12'
    ];

    $bulanNumber = isset($monthMapping[$bulan]) ? $monthMapping[$bulan] : '';

    if (empty($bulanNumber) || empty($tahun)) {
        die("Parameter bulan/tahun tidak valid.");
    }

    $bulanNumberEsc = mysqli_real_escape_string($koneksi, $bulanNumber);
    $tahunEsc       = mysqli_real_escape_string($koneksi, $tahun);

    // FIX #1 (HTTP 500): query lama men-SELECT kolom yang tidak diagregasi
    // padahal GROUP BY cuma berdasarkan code_hydrant+bulan+tahun. Ini
    // melanggar sql_mode ONLY_FULL_GROUP_BY (default aktif di banyak
    // MySQL/MariaDB versi baru), dan di PHP 8.1+ mysqli_query() melempar
    // exception saat query gagal -> exception itu tidak tertangkap ->
    // PHP fatal -> browser cuma menampilkan HTTP 500 kosong. Sekarang
    // semua kolom selain code_hydrant dibungkus MAX(...) supaya valid,
    // dan seluruh proses dibungkus try/catch supaya kalau masih ada
    // error lain, pesannya tampil jelas (bukan 500 kosong lagi).
    //
    // FIX #3 (Lokasi lengkap): JOIN ke data_hydrant (Data Master) lewat
    // code_hydrant, supaya Lokasi & Jenis Lokasi diambil langsung dari
    // Data Master saat ini (bukan snapshot lama di laporan_hydrant yang
    // bisa beda kalau Data Master sudah diubah). Kalau hydrant-nya
    // sudah dihapus dari Data Master, fallback ke data snapshot yang
    // tersimpan di laporan_hydrant supaya baris lama tetap tampil.
    $query = "SELECT
                 lh.code_hydrant,
                 MAX(lh.nama) AS nama,
                 MAX(lh.tanggal_inspeksi) AS tanggal_inspeksi,
                 MAX(dh.lokasi) AS lokasi_master,
                 MAX(lh.lokasi) AS lokasi_snapshot,
                 MAX(dh.nomer_urut) AS nomer_urut_master,
                 MAX(lh.nomer_urut) AS nomer_urut_snapshot,
                 MAX(dh.jenis_lokasi) AS jenis_lokasi_master,
                 MAX(lh.jenis_lokasi) AS jenis_lokasi_snapshot,
                 MAX(lh.hose) AS hose,
                 MAX(lh.nozzle) AS nozzle,
                 MAX(lh.valve) AS valve,
                 MAX(lh.kunci) AS kunci,
                 MAX(lh.seal_karet_hose) AS seal_karet_hose,
                 MAX(lh.seal_karet_nozzle) AS seal_karet_nozzle,
                 MAX(lh.box_hydrant) AS box_hydrant,
                 MAX(lh.keterangan) AS keterangan
              FROM laporan_hydrant lh
              LEFT JOIN data_hydrant dh ON dh.code_hydrant = lh.code_hydrant
              WHERE MONTH(lh.tanggal_inspeksi) = '$bulanNumberEsc'
              AND YEAR(lh.tanggal_inspeksi) = '$tahunEsc'
              GROUP BY lh.code_hydrant
              ORDER BY MAX(lh.id) ASC";

    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        throw new Exception("Query error: " . mysqli_error($koneksi));
    }

    // Tentukan Indoor/Outdoor dari nomer_urut: angka murni (atau '-'/kosong)
    // = Indoor, mengandung huruf = Outdoor. Dipakai sebagai fallback kalau
    // data Master untuk hydrant tsb tidak ditemukan (mis. sudah dihapus).
    // FIX: Hydrant Indoor sekarang juga punya Nomer Urut angka biasa
    // (1,2,3,...), jadi tidak bisa lagi ditebak dari awalan huruf "A" saja.
    function tentukan_jenis_lokasi($nomer_urut) {
        $n = trim((string) $nomer_urut);
        if ($n === '' || $n === '-' || ctype_digit($n)) {
            return 'Indoor';
        }
        return 'Outdoor';
    }

    // Sumber jenis lokasi yang SAMA dipakai untuk tampilan Lokasi maupun
    // pengelompokan urutan (Indoor dulu, baru Outdoor).
    function tentukan_jenis_row($row) {
        if ($row['jenis_lokasi_master'] !== null && $row['jenis_lokasi_master'] !== '') {
            return $row['jenis_lokasi_master'];
        }
        if ($row['jenis_lokasi_snapshot'] !== null && $row['jenis_lokasi_snapshot'] !== '') {
            return $row['jenis_lokasi_snapshot'];
        }
        return tentukan_jenis_lokasi($row['nomer_urut_master'] ?: $row['nomer_urut_snapshot']);
    }

    // Gabungkan jadi "Indoor (Warehouse)" / "Outdoor (Ruang Isolasi)",
    // diambil dari Data Master kalau ada, fallback ke snapshot laporan.
    function format_lokasi_lengkap($row) {
        $lokasiNama = ($row['lokasi_master'] !== null && $row['lokasi_master'] !== '')
            ? $row['lokasi_master']
            : $row['lokasi_snapshot'];

        $jenis = tentukan_jenis_row($row);

        return trim($jenis . ' (' . $lokasiNama . ')');
    }

    // Ambil semua baris dulu ke array PHP biasa.
    $rows = [];
    while ($r = mysqli_fetch_assoc($result)) {
        $r['nomer_urut_tampil'] = $r['nomer_urut_master'] ?: $r['nomer_urut_snapshot'];
        $rows[] = $r;
    }

    // FIX (Urutan laporan): urutkan Hydrant Indoor SEMUA dulu (1,2,3,...),
    // baru Hydrant Outdoor (A1,A2,...A15) - bukan berdasarkan waktu scan/id.
    // Pengelompokan pakai jenis_lokasi yang sebenarnya (bukan tebak-tebakan
    // dari nomer_urut semata), baru diurutkan angka di dalam grupnya,
    // supaya A9 tidak muncul setelah A10 dan Indoor tidak tercampur Outdoor.
    function angka_urut_hydrant_export($nomer_urut) {
        if (preg_match('/(\d+)/', (string) $nomer_urut, $m)) {
            return (int) $m[1];
        }
        return -1;
    }
    usort($rows, function ($a, $b) {
        $groupA = tentukan_jenis_row($a) === 'Indoor' ? 0 : 1;
        $groupB = tentukan_jenis_row($b) === 'Indoor' ? 0 : 1;
        if ($groupA !== $groupB) {
            return $groupA <=> $groupB;
        }
        return angka_urut_hydrant_export($a['nomer_urut_tampil']) <=> angka_urut_hydrant_export($b['nomer_urut_tampil']);
    });

    // FIX (Export dipisah Indoor/Outdoor): kalau parameter &jenis= dikirim
    // (dari tombol Export Excel di halaman Laporan yang sudah dipisah jadi
    // 2 tabel), saring $rows supaya cuma berisi bagian itu saja. Kalau
    // parameter tidak dikirim (mis. link lama), tampilkan semua seperti
    // biasa - supaya tidak merusak pemakaian lama.
    $jenisFilter = isset($_GET['jenis']) ? trim($_GET['jenis']) : '';
    if ($jenisFilter === 'Indoor' || $jenisFilter === 'Outdoor') {
        $rows = array_values(array_filter($rows, function ($r) use ($jenisFilter) {
            return tentukan_jenis_row($r) === $jenisFilter;
        }));
    }

    $namaFile = 'Laporan_Inspeksi_Hydrant_' . ($jenisFilter !== '' ? $jenisFilter . '_' : '') . $bulan . '_' . $tahun . '.xls';

    // Hapus semua output buffer sebelum header
    while (ob_get_level()) ob_end_clean();

    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=\"$namaFile\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Tambah BOM untuk UTF-8
    echo "\xEF\xBB\xBF";
    ?>
    <html>
    <head>
    <meta charset="UTF-8">
    <style>
        table { border-collapse: collapse; width: 100%; }
        td, th { border: 1px solid #000; padding: 6px 10px; font-family: Arial; font-size: 11pt; }
        .header { background-color: #CC0000; color: #FFFFFF; font-weight: bold; text-align: center; }
        .center { text-align: center; }
    </style>
    </head>
    <body>
    <table>
        <tr>
            <th colspan="<?php echo $jenisFilter === 'Indoor' ? 13 : 14; ?>" class="header" style="font-size:13pt;">
                Laporan Inspeksi Hydrant<?php echo $jenisFilter !== '' ? ' ' . htmlspecialchars($jenisFilter) : ''; ?> - <?php echo htmlspecialchars($bulan . ' ' . $tahun); ?>
            </th>
        </tr>
        <tr>
            <th class="header">No</th>
            <th class="header">Nama Petugas</th>
            <th class="header">Tanggal Inspeksi</th>
            <th class="header">Code Hydrant</th>
            <th class="header">Nomer Urut</th>
            <th class="header">Lokasi</th>
            <th class="header">Hose</th>
            <th class="header">Nozzle</th>
            <th class="header">Valve</th>
            <?php if ($jenisFilter !== 'Indoor'): ?><th class="header">Kunci</th><?php endif; ?>
            <th class="header">Seal Karet Hose</th>
            <th class="header">Seal Karet Nozzle</th>
            <th class="header">Box Hydrant</th>
            <th class="header">Keterangan</th>
        </tr>
    <?php $no = 1; foreach ($rows as $row): ?>
        <tr>
            <td class="center"><?php echo $no; ?></td>
            <td><?php echo htmlspecialchars($row['nama']); ?></td>
            <td class="center"><?php echo date('d-m-Y', strtotime($row['tanggal_inspeksi'])); ?></td>
            <td class="center"><?php echo htmlspecialchars($row['code_hydrant']); ?></td>
            <td class="center"><?php echo htmlspecialchars($row['nomer_urut_tampil']); ?></td>
            <td><?php echo htmlspecialchars(format_lokasi_lengkap($row)); ?></td>
            <td class="center"><?php echo htmlspecialchars($row['hose']); ?></td>
            <td class="center"><?php echo htmlspecialchars($row['nozzle']); ?></td>
            <td class="center"><?php echo htmlspecialchars($row['valve']); ?></td>
            <?php if ($jenisFilter !== 'Indoor'): ?><td class="center"><?php echo htmlspecialchars($row['kunci']); ?></td><?php endif; ?>
            <td class="center"><?php echo htmlspecialchars($row['seal_karet_hose']); ?></td>
            <td class="center"><?php echo htmlspecialchars($row['seal_karet_nozzle']); ?></td>
            <td class="center"><?php echo htmlspecialchars($row['box_hydrant']); ?></td>
            <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
        </tr>
    <?php $no++; endforeach; ?>
    </table>
    </body>
    </html>
    <?php

} catch (Throwable $e) {
    // Tangkap SEMUA jenis error/exception (termasuk mysqli exception di PHP 8.1+)
    // supaya tidak lagi muncul halaman 500 kosong, melainkan pesan yang jelas.
    while (ob_get_level()) ob_end_clean();
    header('Content-Type: text/plain; charset=utf-8');
    http_response_code(500);
    echo "TERJADI ERROR SAAT EXPORT:\n\n";
    echo $e->getMessage();
}

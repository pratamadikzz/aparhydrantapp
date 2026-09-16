<?php
// Koneksi database
include '../koneksi.php';

// Ambil parameter bulan dan tahun dari URL
if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];

    // Array bulan dalam Bahasa Indonesia
    $bulan_indonesia = [
        "Januari" => "01", "Februari" => "02", "Maret" => "03", "April" => "04",
        "Mei" => "05", "Juni" => "06", "Juli" => "07", "Agustus" => "08",
        "September" => "09", "Oktober" => "10", "November" => "11", "Desember" => "12"
    ];

    // Pastikan nama bulan ada di dalam array
    if (array_key_exists($bulan, $bulan_indonesia)) {
        $bulan_angka = $bulan_indonesia[$bulan];
    } else {
        echo "Bulan tidak valid.";
        exit;
    }

    // FIX MASALAH 1: Tambah id ke SELECT supaya tombol hapus bisa pakai id
    // FIX MASALAH 3: Tambah GROUP BY untuk cegah duplikat tampil
    //
    // FIX (Lokasi lengkap): JOIN ke data_hydrant (Data Master) lewat
    // code_hydrant supaya Lokasi & Jenis Lokasi diambil langsung dari
    // Data Master saat ini, bukan snapshot lama di laporan_hydrant.
    // Kolom selain code_hydrant dibungkus MAX(...) supaya query valid
    // di MySQL/MariaDB dengan sql_mode ONLY_FULL_GROUP_BY aktif.
    $query = "
    SELECT MAX(lh.id) AS id, MAX(lh.nama) AS nama, MAX(lh.tanggal_inspeksi) AS tanggal_inspeksi,
           lh.code_hydrant,
           MAX(dh.nomer_urut) AS nomer_urut_master, MAX(lh.nomer_urut) AS nomer_urut_snapshot,
           MAX(dh.lokasi) AS lokasi_master, MAX(lh.lokasi) AS lokasi_snapshot,
           MAX(dh.jenis_lokasi) AS jenis_lokasi_master, MAX(lh.jenis_lokasi) AS jenis_lokasi_snapshot,
           MAX(lh.hose) AS hose, MAX(lh.nozzle) AS nozzle, MAX(lh.valve) AS valve, MAX(lh.kunci) AS kunci,
           MAX(lh.seal_karet_hose) AS seal_karet_hose, MAX(lh.seal_karet_nozzle) AS seal_karet_nozzle,
           MAX(lh.box_hydrant) AS box_hydrant, MAX(lh.keterangan) AS keterangan
    FROM laporan_hydrant lh
    LEFT JOIN data_hydrant dh ON dh.code_hydrant = lh.code_hydrant
    WHERE MONTH(lh.tanggal_inspeksi) = '$bulan_angka' 
    AND YEAR(lh.tanggal_inspeksi) = '$tahun'
    GROUP BY lh.code_hydrant
    ORDER BY MAX(lh.id) ASC
    ";

    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($result) > 0) {
        $laporan = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $laporan = [];
    }
} else {
    echo "";
    exit;
}

// Tentukan Indoor/Outdoor dari nomer_urut sebagai fallback kalau Data
// Master untuk hydrant tsb tidak ditemukan (mis. sudah dihapus).
// FIX: Hydrant Indoor sekarang juga punya Nomer Urut berupa angka biasa
// (1, 2, 3, ...), bukan cuma '-'. Jadi Indoor dikenali dari angka MURNI
// (atau '-'/kosong), sedangkan Outdoor selalu mengandung huruf (A1, A2, ...).
function tentukan_jenis_lokasi_laporan($nomer_urut) {
    $n = trim((string) $nomer_urut);
    if ($n === '' || $n === '-' || ctype_digit($n)) {
        return 'Indoor';
    }
    return 'Outdoor';
}

// Gabungkan jadi "Indoor (Warehouse)" / "Outdoor (Ruang Isolasi)", diambil
// dari Data Master kalau ada, fallback ke snapshot laporan kalau tidak.
function format_lokasi_lengkap_laporan($row) {
    $lokasiNama = ($row['lokasi_master'] !== null && $row['lokasi_master'] !== '')
        ? $row['lokasi_master']
        : $row['lokasi_snapshot'];

    $jenis = tentukan_jenis_laporan_row($row);

    return trim($jenis . ' (' . $lokasiNama . ')');
}

// Sumber jenis lokasi yang SAMA dipakai untuk tampilan Lokasi maupun
// untuk pengelompokan urutan (Indoor dulu, baru Outdoor), supaya
// keduanya selalu konsisten satu sama lain.
function tentukan_jenis_laporan_row($row) {
    if ($row['jenis_lokasi_master'] !== null && $row['jenis_lokasi_master'] !== '') {
        return $row['jenis_lokasi_master'];
    }
    if ($row['jenis_lokasi_snapshot'] !== null && $row['jenis_lokasi_snapshot'] !== '') {
        return $row['jenis_lokasi_snapshot'];
    }
    return tentukan_jenis_lokasi_laporan($row['nomer_urut_master'] ?: $row['nomer_urut_snapshot']);
}

foreach ($laporan as &$row) {
    $row['nomer_urut']    = $row['nomer_urut_master'] ?: $row['nomer_urut_snapshot'];
    $row['lokasi_tampil'] = format_lokasi_lengkap_laporan($row);
}
unset($row);

// FIX (Urutan laporan): urutkan Hydrant Indoor SEMUA dulu (1,2,3,...),
// baru Hydrant Outdoor (A1,A2,...A15) - bukan berdasarkan waktu scan/id.
// PENTING: sejak Indoor juga punya Nomer Urut berupa angka biasa,
// pengelompokan Indoor/Outdoor TIDAK BISA lagi ditebak dari nomer_urut
// semata (angka "1" bisa berarti Indoor #1 ATAU bagian dari "A1"), jadi
// pengelompokan pakai jenis_lokasi yang sebenarnya (sama seperti yang
// dipakai untuk kolom Lokasi), baru diurutkan angka di dalam grupnya.
function angka_urut_hydrant($nomer_urut) {
    if (preg_match('/(\d+)/', (string) $nomer_urut, $m)) {
        return (int) $m[1];
    }
    return -1;
}
usort($laporan, function ($a, $b) {
    $groupA = tentukan_jenis_laporan_row($a) === 'Indoor' ? 0 : 1;
    $groupB = tentukan_jenis_laporan_row($b) === 'Indoor' ? 0 : 1;
    if ($groupA !== $groupB) {
        return $groupA <=> $groupB;
    }
    return angka_urut_hydrant($a['nomer_urut']) <=> angka_urut_hydrant($b['nomer_urut']);
});

// FIX (Laporan dipisah Indoor/Outdoor): pecah array yang sudah terurut
// jadi dua kelompok terpisah untuk ditampilkan sebagai 2 tabel berbeda.
// Karena $laporan sudah terurut Indoor-dulu-baru-Outdoor lalu angka,
// urutan di masing-masing kelompok otomatis tetap benar setelah dipecah.
$laporanIndoor = array_values(array_filter($laporan, function ($r) {
    return tentukan_jenis_laporan_row($r) === 'Indoor';
}));
$laporanOutdoor = array_values(array_filter($laporan, function ($r) {
    return tentukan_jenis_laporan_row($r) !== 'Indoor';
}));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inspeksi Hydrant - <?php echo $bulan . " " . $tahun; ?></title>
    <link rel="icon" href="../assets/img/logokecilAH.png" type="image/x-icon" />
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["../assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Laporan Inspeksi Hydrant Bulan <?php echo $bulan . " " . $tahun; ?></h2>

    <?php
    // FIX (Laporan dipisah Indoor/Outdoor): render tabel Indoor & Outdoor
    // dengan struktur yang sama persis (cuma sumber data & id tabel beda),
    // supaya kedua tabel konsisten dan gampang dirawat.
    // FIX (Hapus Kunci dari Indoor): parameter $tampilkanKunci mengontrol
    // apakah kolom Kunci dirender sama sekali - bukan cuma dikosongkan.
    // Indoor -> false (kolom tidak ada), Outdoor -> true (kolom tetap ada).
    function render_tabel_laporan_hydrant($tableId, $judul, $dataList, $tampilkanKunci) {
        $colspanKosong = $tampilkanKunci ? 15 : 14;
        ?>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="mb-3"><?php echo htmlspecialchars($judul); ?></h4>
                <div class="table-responsive">
                    <table id="<?php echo $tableId; ?>" class="table table-bordered table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Inspeksi</th>
                                <th>Code Hydrant</th>
                                <th>Nomer Urut</th>
                                <th>Lokasi</th>
                                <th>Hose</th>
                                <th>Nozzle</th>
                                <th>Valve</th>
                                <?php if ($tampilkanKunci): ?><th>Kunci</th><?php endif; ?>
                                <th>Seal Karet Hose</th>
                                <th>Seal Karet Nozzle</th>
                                <th>Box Hydrant</th>
                                <th>Keterangan</th>
                                <th class="kolom-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dataList)): ?>
                                <?php foreach ($dataList as $index => $data): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($data['tanggal_inspeksi'])); ?></td>
                                        <td><?php echo htmlspecialchars($data['code_hydrant']); ?></td>
                                        <td><?php echo htmlspecialchars($data['nomer_urut']); ?></td>
                                        <td><?php echo htmlspecialchars($data['lokasi_tampil']); ?></td>
                                        <td><?php echo htmlspecialchars($data['hose']); ?></td>
                                        <td><?php echo htmlspecialchars($data['nozzle']); ?></td>
                                        <td><?php echo htmlspecialchars($data['valve']); ?></td>
                                        <?php if ($tampilkanKunci): ?><td><?php echo htmlspecialchars($data['kunci']); ?></td><?php endif; ?>
                                        <td><?php echo htmlspecialchars($data['seal_karet_hose']); ?></td>
                                        <td><?php echo htmlspecialchars($data['seal_karet_nozzle']); ?></td>
                                        <td><?php echo htmlspecialchars($data['box_hydrant']); ?></td>
                                        <td><?php echo htmlspecialchars($data['keterangan']); ?></td>
                                        <td class="kolom-aksi">
                                            <button class="btn btn-danger btn-sm"
                                                    onclick="konfirmasiHapus(<?php echo $data['id']; ?>)">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="<?php echo $colspanKosong; ?>" class="text-center">Tidak ada data inspeksi untuk bulan ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    }

    render_tabel_laporan_hydrant('laporanTableIndoor', 'Hydrant Indoor', $laporanIndoor, false);
    render_tabel_laporan_hydrant('laporanTableOutdoor', 'Hydrant Outdoor', $laporanOutdoor, true);
    ?>
</div>

<!-- FIX MASALAH 2: Modal konfirmasi hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalHapusLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data inspeksi hydrant ini?<br>
                <small class="text-danger">Data yang dihapus tidak dapat dikembalikan.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <a id="btnHapusKonfirmasi" href="#" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Ya, Hapus
                </a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<!-- Inisialisasi DataTables -->
<script>
// FIX (Laporan dipisah Indoor/Outdoor): dua instance DataTable terpisah,
// masing-masing dengan tombol Export Excel & Export PDF sendiri-sendiri.
// Export Excel mengirim parameter &jenis=Indoor / &jenis=Outdoor supaya
// exportLaporanhydrant.php tahu bagian mana yang harus diekspor.
function initTabelLaporan(tableId, jenis) {
    $('#' + tableId).DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fas fa-arrow-left"></i> Kembali',
                className: 'btn btn-warning',
                action: function (e, dt, node, config) {
                    window.history.back();
                }
            },
            {
                text: '<i class="fas fa-file-excel"></i> Export Excel',
                className: 'btn btn-success',
                action: function (e, dt, node, config) {
                    window.location.href = 'proses/export/exportLaporanhydrant.php?bulan=<?= urlencode($_GET['bulan']) ?>&tahun=<?= urlencode($_GET['tahun']) ?>&jenis=' + jenis;
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> Export PDF',
                className: 'btn btn-danger',
                orientation: 'landscape',
                pageSize: 'A4',
                title: 'Laporan Inspeksi Hydrant ' + jenis + ' - <?= urlencode($_GET["bulan"]) ?> <?= urlencode($_GET["tahun"]) ?>',
                exportOptions: {
                    // FIX (poin 5): kolom Aksi (tombol Hapus) cuma untuk di
                    // website, tidak boleh ikut ke PDF - PDF hanya berisi
                    // data inspeksi.
                    columns: ':not(.kolom-aksi)'
                }
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json",
        }
    });
}

initTabelLaporan('laporanTableIndoor', 'Indoor');
initTabelLaporan('laporanTableOutdoor', 'Outdoor');

// FIX MASALAH 2: Fungsi konfirmasi hapus (dipakai bersama oleh kedua tabel)
function konfirmasiHapus(id) {
    var bulan = '<?= urlencode($_GET['bulan']) ?>';
    var tahun = '<?= urlencode($_GET['tahun']) ?>';
    document.getElementById('btnHapusKonfirmasi').href = 
        'proses/hydrant/hapus_laporan_hydrant.php?id=' + id + '&bulan=' + bulan + '&tahun=' + tahun;
    $('#modalHapus').modal('show');
}
</script>

</body>
</html>
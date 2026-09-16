<?php
// ================================================================
// File: admin/fix_hydrant_tool.php
// TUJUAN: Alat sementara untuk:
//   1. Update nama user (Admin_CII -> nama asli)
//   2. Update nama lama di data laporan_hydrant
//   3. Hapus data duplikat di laporan_hydrant
//
// CARA PAKAI:
//   Upload ke: admin/fix_hydrant_tool.php
//   Buka di:   https://www.storage-cloud.my.id/admin/fix_hydrant_tool.php
//
// PENTING: HAPUS FILE INI SETELAH SELESAI DIGUNAKAN!
// ================================================================

session_start();
include '../koneksi.php';

$action   = isset($_POST['action']) ? $_POST['action'] : '';
$messages = [];
$errors   = [];

// ── AKSI 1: Update nama di tabel user ──────────────────────────
if ($action === 'update_user') {
    $username  = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $nama_baru = mysqli_real_escape_string($koneksi, trim($_POST['nama_baru']));

    if (empty($username) || empty($nama_baru)) {
        $errors[] = "Username dan Nama Baru tidak boleh kosong.";
    } else {
        // Update tabel user
        $q = "UPDATE user SET nama='$nama_baru' WHERE username='$username'";
        if (mysqli_query($koneksi, $q) && mysqli_affected_rows($koneksi) > 0) {
            $messages[] = "✅ Nama user '$username' berhasil diubah menjadi '$nama_baru'.";
            // Otomatis update juga data lama di laporan_hydrant
            $q2 = "UPDATE laporan_hydrant SET nama='$nama_baru' WHERE nama='$username'";
            mysqli_query($koneksi, $q2);
            $affected2 = mysqli_affected_rows($koneksi);
            $messages[] = "✅ $affected2 baris data lama di laporan_hydrant juga ikut diperbarui.";
        } else {
            $errors[] = "Username '$username' tidak ditemukan, atau nama sudah sama.";
        }
    }
}

// ── AKSI 2: Update nama langsung di laporan_hydrant ────────────
if ($action === 'update_laporan') {
    $nama_lama = mysqli_real_escape_string($koneksi, trim($_POST['nama_lama']));
    $nama_baru = mysqli_real_escape_string($koneksi, trim($_POST['nama_baru_laporan']));

    if (empty($nama_lama) || empty($nama_baru)) {
        $errors[] = "Nama Lama dan Nama Baru tidak boleh kosong.";
    } else {
        $q = "UPDATE laporan_hydrant SET nama='$nama_baru' WHERE nama='$nama_lama'";
        if (mysqli_query($koneksi, $q)) {
            $affected = mysqli_affected_rows($koneksi);
            $messages[] = "✅ $affected baris diubah dari '$nama_lama' menjadi '$nama_baru'.";
        } else {
            $errors[] = "Error: " . mysqli_error($koneksi);
        }
    }
}

// ── AKSI 3: Hapus duplikat di laporan_hydrant ──────────────────
if ($action === 'hapus_duplikat') {
    // Pertahankan id terkecil (data pertama masuk), hapus sisanya
    $q = "DELETE lh1 FROM laporan_hydrant lh1
          INNER JOIN laporan_hydrant lh2
              ON lh1.code_hydrant = lh2.code_hydrant
              AND MONTH(lh1.tanggal_inspeksi) = MONTH(lh2.tanggal_inspeksi)
              AND YEAR(lh1.tanggal_inspeksi)  = YEAR(lh2.tanggal_inspeksi)
              AND lh1.id > lh2.id";
    if (mysqli_query($koneksi, $q)) {
        $deleted = mysqli_affected_rows($koneksi);
        $messages[] = "✅ $deleted baris duplikat berhasil dihapus.";
    } else {
        $errors[] = "Error hapus duplikat: " . mysqli_error($koneksi);
    }
}

// ── AKSI 4: Hapus hydrant outdoor lama (tanpa kode "A") dari Data Master
if ($action === 'hapus_outdoor_lama') {
    $q = "DELETE FROM data_hydrant
          WHERE jenis_lokasi = 'Outdoor'
            AND nomer_urut NOT LIKE 'A%'";
    if (mysqli_query($koneksi, $q)) {
        $deleted = mysqli_affected_rows($koneksi);
        $messages[] = "✅ $deleted hydrant outdoor lama (tanpa kode A) berhasil dihapus dari Data Master.";
    } else {
        $errors[] = "Error hapus outdoor lama: " . mysqli_error($koneksi);
    }
}

// ── AKSI 5: Rapikan Nomer Urut Outdoor (A01 -> A1, A09 -> A9, dst -
// TANPA angka nol di depan, sesuai format yang diminta terbaru).
// A10-A15 tidak disentuh karena memang sudah tanpa nol di depan.
// Hydrant Indoor tidak disentuh sama sekali di sini.
if ($action === 'rapikan_nomer_urut') {
    $q = "UPDATE data_hydrant
          SET nomer_urut = CONCAT('A', SUBSTRING(nomer_urut, 3))
          WHERE jenis_lokasi = 'Outdoor'
            AND nomer_urut REGEXP '^A0[0-9]$'";
    if (mysqli_query($koneksi, $q)) {
        $updated = mysqli_affected_rows($koneksi);
        $messages[] = "✅ $updated Nomer Urut Outdoor dirapikan tanpa angka nol di depan (mis. A01 -> A1).";
    } else {
        $errors[] = "Error rapikan nomor urut: " . mysqli_error($koneksi);
    }
}

// ── AKSI 6: Isi Nomer Urut Hydrant Indoor (1, 2, 3, ... - angka biasa)
// Diambil dari angka pada Code Hydrant yang sudah ada (HDR001 -> 1,
// HDR002 -> 2, dst), TANPA mengubah Code Hydrant itu sendiri.
if ($action === 'isi_nomer_urut_indoor') {
    $q = "UPDATE data_hydrant
          SET nomer_urut = CAST(SUBSTRING(code_hydrant, 4) AS UNSIGNED)
          WHERE jenis_lokasi = 'Indoor'";
    if (mysqli_query($koneksi, $q)) {
        $updated = mysqli_affected_rows($koneksi);
        $messages[] = "✅ $updated Nomer Urut Indoor diisi otomatis (angka biasa, mis. HDR001 -> 1).";
    } else {
        $errors[] = "Error isi nomor urut indoor: " . mysqli_error($koneksi);
    }
}

// ── AKSI 7: Terapkan Nomer Urut khusus Data Master Indoor sesuai urutan
// yang diminta (BUKAN sekadar urut angka Code Hydrant seperti AKSI 6).
// Ini menimpa AKSI 6 dengan urutan yang benar untuk 11 hydrant ini:
//   HDR001->1, HDR002->2, HDR003->3, HDR004->4, HDR006->5, HDR009->6,
//   HDR007->7, HDR008->8, HDR010->9, HDR011->10, HDR036->11
// Khusus HDR036: statusnya sekarang Outdoor lama, diubah jadi Indoor
// (Lokasi TIDAK diubah). Khusus HDR005: dikosongkan lagi ('-') karena
// sudah tidak dipakai/rusak, digantikan HDR036. Code Hydrant TIDAK ada
// yang diubah sama sekali - cuma nomer_urut & jenis_lokasi (khusus HDR036).
if ($action === 'terapkan_urutan_indoor_custom') {
    $q = "UPDATE data_hydrant
          SET nomer_urut = CASE code_hydrant
                WHEN 'HDR001' THEN '1'
                WHEN 'HDR002' THEN '2'
                WHEN 'HDR003' THEN '3'
                WHEN 'HDR004' THEN '4'
                WHEN 'HDR006' THEN '5'
                WHEN 'HDR009' THEN '6'
                WHEN 'HDR007' THEN '7'
                WHEN 'HDR008' THEN '8'
                WHEN 'HDR010' THEN '9'
                WHEN 'HDR011' THEN '10'
                WHEN 'HDR036' THEN '11'
                WHEN 'HDR005' THEN '-'
                ELSE nomer_urut
              END,
              jenis_lokasi = CASE code_hydrant
                WHEN 'HDR036' THEN 'Indoor'
                ELSE jenis_lokasi
              END,
              lokasi = CASE code_hydrant
                WHEN 'HDR036' THEN 'Boiler'
                ELSE lokasi
              END
          WHERE code_hydrant IN (
                'HDR001','HDR002','HDR003','HDR004','HDR006','HDR009',
                'HDR007','HDR008','HDR010','HDR011','HDR036','HDR005'
          )";
    if (mysqli_query($koneksi, $q)) {
        $updated = mysqli_affected_rows($koneksi);
        $messages[] = "✅ $updated baris Data Master diperbarui sesuai urutan Nomer Urut Indoor yang diminta.";
    } else {
        $errors[] = "Error terapkan urutan indoor custom: " . mysqli_error($koneksi);
    }
}

// ── AKSI 8: Perbaiki Laporan Bulan Juli 2026 - baris yang tercatat
// HDR005 (hasil scan pakai QR lama sebelum diganti) diubah jadi HDR036,
// supaya laporan Juli menampilkan HDR036 (bukan HDR005 yang sudah tidak
// aktif). Nomer Urut & Lokasi di baris laporan itu juga ikut disamakan
// dengan HDR036 di Data Master saat ini (Nomer Urut 11, Lokasi "Boiler"),
// supaya konsisten kalau Data Master di masa depan berubah lagi.
// Bulan/tahun lain TIDAK disentuh.
if ($action === 'perbaiki_laporan_juli_hdr005_ke_hdr036') {
    $q = "UPDATE laporan_hydrant
          SET code_hydrant = 'HDR036',
              nomer_urut = '11',
              lokasi = 'Boiler',
              jenis_lokasi = 'Indoor'
          WHERE code_hydrant = 'HDR005'
            AND MONTH(tanggal_inspeksi) = '07'
            AND YEAR(tanggal_inspeksi) = '2026'";
    if (mysqli_query($koneksi, $q)) {
        $updated = mysqli_affected_rows($koneksi);
        $messages[] = "✅ $updated baris Laporan bulan Juli 2026 diubah dari HDR005 menjadi HDR036.";
    } else {
        $errors[] = "Error perbaiki laporan Juli: " . mysqli_error($koneksi);
    }
}

// ── Ambil data untuk ditampilkan ───────────────────────────────
// Semua user
$usersRes = mysqli_query($koneksi, "SELECT id, username, nama, level FROM user ORDER BY id ASC");
$users = [];
while ($r = mysqli_fetch_assoc($usersRes)) { $users[] = $r; }

// Nama yang ada di laporan_hydrant
$namaRes = mysqli_query($koneksi, "SELECT nama, COUNT(*) as jml FROM laporan_hydrant GROUP BY nama ORDER BY jml DESC");
$namaList = [];
while ($r = mysqli_fetch_assoc($namaRes)) { $namaList[] = $r; }

// Cek hydrant outdoor lama (tanpa kode "A") di Data Master
$outdoorLamaRes = mysqli_query($koneksi,
    "SELECT id, code_hydrant, nomer_urut, lokasi
     FROM data_hydrant
     WHERE jenis_lokasi = 'Outdoor'
       AND nomer_urut NOT LIKE 'A%'
     ORDER BY id ASC");
$outdoorLamaList = [];
while ($r = mysqli_fetch_assoc($outdoorLamaRes)) { $outdoorLamaList[] = $r; }

// Cek Nomer Urut Outdoor yang belum rapi (masih pakai nol di depan, A01-A09)
$belumRapiRes = mysqli_query($koneksi,
    "SELECT id, code_hydrant, nomer_urut, lokasi
     FROM data_hydrant
     WHERE jenis_lokasi = 'Outdoor'
       AND nomer_urut REGEXP '^A0[0-9]$'
     ORDER BY CAST(SUBSTRING(nomer_urut, 2) AS UNSIGNED) ASC");
$belumRapiList = [];
while ($r = mysqli_fetch_assoc($belumRapiRes)) { $belumRapiList[] = $r; }

// Cek Hydrant Indoor yang Nomer Urut-nya belum berupa angka biasa (mis. masih '-')
$indoorBelumNomorRes = mysqli_query($koneksi,
    "SELECT id, code_hydrant, nomer_urut, lokasi
     FROM data_hydrant
     WHERE jenis_lokasi = 'Indoor'
       AND nomer_urut NOT REGEXP '^[0-9]+$'
     ORDER BY code_hydrant ASC");
$indoorBelumNomorList = [];
while ($r = mysqli_fetch_assoc($indoorBelumNomorRes)) { $indoorBelumNomorList[] = $r; }

// Preview untuk AKSI 7: tampilkan kondisi SEKARANG untuk 11 kode yang
// akan terkena mapping custom, supaya admin bisa cek sebelum klik.
$mappingCustom = [
    'HDR001' => '1', 'HDR002' => '2', 'HDR003' => '3', 'HDR004' => '4',
    'HDR006' => '5', 'HDR009' => '6', 'HDR007' => '7', 'HDR008' => '8',
    'HDR010' => '9', 'HDR011' => '10', 'HDR036' => '11', 'HDR005' => '-',
];
$kodeList = "'" . implode("','", array_keys($mappingCustom)) . "'";
$customPreviewRes = mysqli_query($koneksi,
    "SELECT code_hydrant, nomer_urut, jenis_lokasi, lokasi
     FROM data_hydrant
     WHERE code_hydrant IN ($kodeList)");
$customPreviewList = [];
while ($r = mysqli_fetch_assoc($customPreviewRes)) { $customPreviewList[] = $r; }

// Preview untuk AKSI 8: baris Laporan bulan Juli 2026 yang masih tercatat HDR005
$laporanJuliHdr005Res = mysqli_query($koneksi,
    "SELECT id, nama, tanggal_inspeksi, code_hydrant, nomer_urut, lokasi
     FROM laporan_hydrant
     WHERE code_hydrant = 'HDR005'
       AND MONTH(tanggal_inspeksi) = '07'
       AND YEAR(tanggal_inspeksi) = '2026'
     ORDER BY tanggal_inspeksi ASC");
$laporanJuliHdr005List = [];
while ($r = mysqli_fetch_assoc($laporanJuliHdr005Res)) { $laporanJuliHdr005List[] = $r; }

// Cek duplikat
$dupRes = mysqli_query($koneksi,
    "SELECT code_hydrant,
            MONTH(tanggal_inspeksi) as bln,
            YEAR(tanggal_inspeksi)  as thn,
            COUNT(*)                as jml,
            GROUP_CONCAT(id ORDER BY id ASC) as ids
     FROM laporan_hydrant
     GROUP BY code_hydrant, bln, thn
     HAVING COUNT(*) > 1
     ORDER BY thn DESC, bln DESC");
$dupList = [];
while ($r = mysqli_fetch_assoc($dupRes)) { $dupList[] = $r; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix Hydrant Tool</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background: #f4f6f9; }
        .card { margin-bottom: 20px; border-radius: 10px; }
        .top-warning {
            background: #dc3545; color: white;
            padding: 14px 20px; border-radius: 8px;
            margin-bottom: 24px; font-weight: bold;
            font-size: 15px;
        }
    </style>
</head>
<body>
<div class="container mt-4 mb-5" style="max-width:900px">

    <div class="top-warning">
        <i class="fas fa-exclamation-triangle"></i>
        FILE SEMENTARA — HAPUS SETELAH SELESAI!
        Jangan biarkan file ini ada di server terlalu lama.
    </div>

    <h4 class="mb-4"><i class="fas fa-tools"></i> Fix Hydrant Tool</h4>

    <?php foreach ($messages as $m): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $m ?></div>
    <?php endforeach; ?>
    <?php foreach ($errors as $e): ?>
        <div class="alert alert-danger"><i class="fas fa-times-circle"></i> <?= $e ?></div>
    <?php endforeach; ?>

    <!-- STATUS: Daftar User -->
    <div class="card">
        <div class="card-header bg-info text-white">
            <i class="fas fa-users"></i> Daftar User di Database
            <small class="ml-2">(yang disorot kuning = nama perlu dicek)</small>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th><th>Username</th>
                        <th>Nama (yang muncul di laporan)</th><th>Level</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u):
                        $perluDicek = (stripos($u['nama'], 'admin') !== false || strpos($u['nama'], '_') !== false);
                    ?>
                    <tr class="<?= $perluDicek ? 'table-warning' : '' ?>">
                        <td><?= $u['id'] ?></td>
                        <td><strong><?= htmlspecialchars($u['username']) ?></strong></td>
                        <td>
                            <?= htmlspecialchars($u['nama']) ?>
                            <?php if ($perluDicek): ?>
                                <span class="badge badge-warning ml-1">⚠ Cek nama ini</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($u['level']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- PERBAIKAN 1: Update nama di tabel user -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user-edit"></i>
            Perbaikan 1 — Ubah Nama User + Otomatis Update Data Lama
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">
                Ubah field <code>nama</code> di tabel <code>user</code> supaya scan berikutnya
                langsung pakai nama benar. Data lama di laporan_hydrant juga ikut diperbarui otomatis.
            </p>
            <form method="POST">
                <input type="hidden" name="action" value="update_user">
                <div class="form-row align-items-end">
                    <div class="form-group col-md-4">
                        <label><strong>Username akun</strong> (lihat tabel di atas)</label>
                        <input type="text" name="username" class="form-control"
                               placeholder="Contoh: admin_cii" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label><strong>Nama Baru</strong> (nama asli petugas)</label>
                        <input type="text" name="nama_baru" class="form-control"
                               placeholder="Contoh: Bilqis" required>
                    </div>
                    <div class="form-group col-md-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Update Nama User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- PERBAIKAN 2: Update nama di laporan_hydrant saja -->
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <i class="fas fa-edit"></i>
            Perbaikan 2 — Ubah Nama Langsung di Tabel laporan_hydrant
        </div>
        <div class="card-body">
            <p class="text-muted mb-2">
                Nama yang tersimpan di <code>laporan_hydrant</code> saat ini:
            </p>
            <div class="mb-3">
                <?php foreach ($namaList as $n):
                    $isAneh = (stripos($n['nama'], 'admin') !== false || strpos($n['nama'], '_') !== false);
                ?>
                    <span class="badge badge-<?= $isAneh ? 'danger' : 'success' ?> mr-1 mb-1 p-2">
                        <?= htmlspecialchars($n['nama']) ?> (<?= $n['jml'] ?> data)
                        <?= $isAneh ? ' ⚠' : ' ✅' ?>
                    </span>
                <?php endforeach; ?>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="update_laporan">
                <div class="form-row align-items-end">
                    <div class="form-group col-md-4">
                        <label><strong>Nama Lama</strong> (yang salah, lihat badge merah di atas)</label>
                        <input type="text" name="nama_lama" class="form-control"
                               placeholder="Contoh: Admin_CII" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label><strong>Nama Baru</strong> (nama asli yang benar)</label>
                        <input type="text" name="nama_baru_laporan" class="form-control"
                               placeholder="Contoh: Bilqis" required>
                    </div>
                    <div class="form-group col-md-4">
                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fas fa-sync"></i> Update Nama di Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- STATUS + PERBAIKAN 4: Hydrant Outdoor Lama tanpa kode "A" -->
    <div class="card border-danger">
        <div class="card-header bg-<?= count($outdoorLamaList) > 0 ? 'danger' : 'success' ?> text-white">
            <i class="fas fa-<?= count($outdoorLamaList) > 0 ? 'exclamation-circle' : 'check-circle' ?>"></i>
            Data Master — Hydrant Outdoor Lama (tanpa kode "A") —
            <?= count($outdoorLamaList) > 0 ? count($outdoorLamaList) . ' data ditemukan!' : 'Tidak ada data lama ✅' ?>
        </div>
        <?php if (count($outdoorLamaList) > 0): ?>
        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th><th>Code Hydrant</th><th>Nomer Urut</th><th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($outdoorLamaList as $o): ?>
                    <tr class="table-danger">
                        <td><?= $o['id'] ?></td>
                        <td><strong><?= htmlspecialchars($o['code_hydrant']) ?></strong></td>
                        <td><?= htmlspecialchars($o['nomer_urut']) ?></td>
                        <td><?= htmlspecialchars($o['lokasi']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <p class="text-muted">
                Hydrant Outdoor seharusnya memakai kode <strong>A1–A15</strong>. Baris di atas
                adalah hydrant outdoor lama yang tidak memakai kode "A" (sudah tidak dipakai)
                dan akan dihapus dari Data Master. Kolom <strong>Lokasi</strong> (nama lokasi)
                tidak ikut diubah untuk hydrant lain. Laporan inspeksi lama yang sudah ada
                <strong>tidak akan ikut terhapus</strong>, karena laporan menyimpan datanya sendiri.
            </p>
            <form method="POST"
                  onsubmit="return confirm('YAKIN ingin menghapus semua hydrant outdoor lama di atas dari Data Master?\nAksi ini tidak bisa di-undo!')">
                <input type="hidden" name="action" value="hapus_outdoor_lama">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i> Hapus Hydrant Outdoor Lama Sekarang
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <!-- STATUS + PERBAIKAN 5: Rapikan Nomer Urut Outdoor (A01 -> A1) -->
    <div class="card border-warning">
        <div class="card-header bg-<?= count($belumRapiList) > 0 ? 'warning' : 'success' ?> text-<?= count($belumRapiList) > 0 ? 'dark' : 'white' ?>">
            <i class="fas fa-<?= count($belumRapiList) > 0 ? 'exclamation-circle' : 'check-circle' ?>"></i>
            Data Master — Nomer Urut Outdoor Masih Pakai Nol di Depan (mis. A01, A09) —
            <?= count($belumRapiList) > 0 ? count($belumRapiList) . ' data ditemukan!' : 'Semua sudah rapi ✅' ?>
        </div>
        <?php if (count($belumRapiList) > 0): ?>
        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th><th>Code Hydrant</th><th>Nomer Urut Sekarang</th><th>Akan Jadi</th><th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($belumRapiList as $b): ?>
                    <tr class="table-warning">
                        <td><?= $b['id'] ?></td>
                        <td><strong><?= htmlspecialchars($b['code_hydrant']) ?></strong></td>
                        <td><?= htmlspecialchars($b['nomer_urut']) ?></td>
                        <td><strong>A<?= (int) substr($b['nomer_urut'], 2) ?></strong></td>
                        <td><?= htmlspecialchars($b['lokasi']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <p class="text-muted">
                Nomer Urut Outdoor dirapikan supaya <strong>tanpa angka nol di depan</strong>
                (A1, A2, ... A9, A10, ... A15), sesuai format yang diminta.
                Hydrant <strong>Indoor tidak ikut disentuh sama sekali</strong>.
                A10-A15 sudah tanpa nol di depan jadi tidak akan diubah.
            </p>
            <form method="POST"
                  onsubmit="return confirm('YAKIN ingin merapikan semua Nomer Urut Outdoor di atas?\nAksi ini tidak bisa di-undo!')">
                <input type="hidden" name="action" value="rapikan_nomer_urut">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-broom"></i> Rapikan Nomer Urut Outdoor Sekarang
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <!-- STATUS + PERBAIKAN 6: Isi Nomer Urut Hydrant Indoor -->
    <div class="card border-info">
        <div class="card-header bg-<?= count($indoorBelumNomorList) > 0 ? 'info' : 'success' ?> text-white">
            <i class="fas fa-<?= count($indoorBelumNomorList) > 0 ? 'exclamation-circle' : 'check-circle' ?>"></i>
            Data Master — Hydrant Indoor Belum Punya Nomer Urut —
            <?= count($indoorBelumNomorList) > 0 ? count($indoorBelumNomorList) . ' data ditemukan!' : 'Semua sudah terisi ✅' ?>
        </div>
        <?php if (count($indoorBelumNomorList) > 0): ?>
        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th><th>Code Hydrant</th><th>Nomer Urut Sekarang</th><th>Akan Jadi</th><th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($indoorBelumNomorList as $b): ?>
                    <tr class="table-info">
                        <td><?= $b['id'] ?></td>
                        <td><strong><?= htmlspecialchars($b['code_hydrant']) ?></strong></td>
                        <td><?= htmlspecialchars($b['nomer_urut']) ?></td>
                        <td><strong><?= (int) substr($b['code_hydrant'], 3) ?></strong></td>
                        <td><?= htmlspecialchars($b['lokasi']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <p class="text-muted">
                Nomer Urut Indoor diisi otomatis berupa <strong>angka biasa (1, 2, 3, ...)</strong>,
                diambil dari angka yang sudah ada di Code Hydrant (mis. HDR001 -> 1).
                <strong>Code Hydrant itu sendiri TIDAK diubah sama sekali.</strong>
            </p>
            <form method="POST"
                  onsubmit="return confirm('YAKIN ingin mengisi Nomer Urut untuk semua Hydrant Indoor di atas?')">
                <input type="hidden" name="action" value="isi_nomer_urut_indoor">
                <button type="submit" class="btn btn-info text-white">
                    <i class="fas fa-list-ol"></i> Isi Nomer Urut Indoor Sekarang
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <!-- STATUS + PERBAIKAN 7: Terapkan Nomer Urut khusus Indoor (urutan custom, bukan urut Code Hydrant) -->
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-list-ol"></i>
            Data Master — Terapkan Urutan Nomer Urut Indoor Khusus (1–11)
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Code Hydrant</th><th>Nomer Urut Sekarang</th><th>Jenis Sekarang</th><th>Lokasi Sekarang</th><th>Akan Jadi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customPreviewList as $c): ?>
                    <tr class="<?= $c['code_hydrant'] === 'HDR036' ? 'table-warning' : (($c['code_hydrant'] === 'HDR005') ? 'table-secondary' : 'table-primary') ?>">
                        <td><strong><?= htmlspecialchars($c['code_hydrant']) ?></strong></td>
                        <td><?= htmlspecialchars($c['nomer_urut']) ?></td>
                        <td><?= htmlspecialchars($c['jenis_lokasi']) ?></td>
                        <td><?= htmlspecialchars($c['lokasi']) ?></td>
                        <td><strong>
                            Nomer Urut: <?= $mappingCustom[$c['code_hydrant']] ?>
                            <?= $c['code_hydrant'] === 'HDR036' ? ', jadi Indoor, Lokasi jadi "Boiler"' : '' ?>
                        </strong></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($customPreviewList)): ?>
                    <tr><td colspan="5" class="text-center text-muted">Tidak ada kode yang cocok ditemukan di Data Master.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <p class="text-muted">
                Ini menerapkan urutan Nomer Urut Indoor <strong>khusus sesuai yang diminta</strong>
                (bukan sekadar urut angka Code Hydrant seperti tombol di atas). <strong>HDR036</strong>
                akan diubah jenisnya dari Outdoor menjadi Indoor, dan Lokasi-nya diubah jadi
                <strong>"Boiler"</strong> (menggantikan HDR005 yang sudah tidak dipakai).
                <strong>HDR005</strong> akan dikosongkan Nomer Urut-nya (jadi tidak aktif dalam urutan 1-11).
                <strong>Code Hydrant tidak ada yang diubah.</strong>
                Aman dijalankan kapan saja, termasuk kalau tombol "Isi Nomer Urut Indoor Sekarang" di atas
                sudah pernah diklik sebelumnya - ini akan menimpa dengan urutan yang benar.
            </p>
            <form method="POST"
                  onsubmit="return confirm('YAKIN ingin menerapkan urutan Nomer Urut Indoor khusus ini?\nHDR036 akan diubah jadi Indoor.\nHDR005 Nomer Urut-nya akan dikosongkan.')">
                <input type="hidden" name="action" value="terapkan_urutan_indoor_custom">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-double"></i> Terapkan Urutan Indoor Khusus Sekarang
                </button>
            </form>
        </div>
    </div>

    <!-- STATUS + PERBAIKAN 8: Ganti HDR005 -> HDR036 di Laporan bulan Juli 2026 -->
    <div class="card border-danger">
        <div class="card-header bg-<?= count($laporanJuliHdr005List) > 0 ? 'danger' : 'success' ?> text-white">
            <i class="fas fa-<?= count($laporanJuliHdr005List) > 0 ? 'exclamation-circle' : 'check-circle' ?>"></i>
            Laporan Juli 2026 — Baris yang Masih Tercatat HDR005 —
            <?= count($laporanJuliHdr005List) > 0 ? count($laporanJuliHdr005List) . ' data ditemukan!' : 'Tidak ada ✅' ?>
        </div>
        <?php if (count($laporanJuliHdr005List) > 0): ?>
        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th><th>Nama</th><th>Tanggal Inspeksi</th><th>Code Sekarang</th><th>Nomer Urut Sekarang</th><th>Lokasi Sekarang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporanJuliHdr005List as $l): ?>
                    <tr class="table-danger">
                        <td><?= $l['id'] ?></td>
                        <td><?= htmlspecialchars($l['nama']) ?></td>
                        <td><?= date('d-m-Y', strtotime($l['tanggal_inspeksi'])) ?></td>
                        <td><strong><?= htmlspecialchars($l['code_hydrant']) ?></strong> → akan jadi <strong>HDR036</strong></td>
                        <td><?= htmlspecialchars($l['nomer_urut']) ?> → akan jadi <strong>11</strong></td>
                        <td><?= htmlspecialchars($l['lokasi']) ?> → akan jadi <strong>Boiler</strong></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <p class="text-muted">
                Baris di atas adalah hasil scan bulan <strong>Juli 2026</strong> yang masih tercatat
                sebagai <strong>HDR005</strong> (QR lama), padahal hydrant fisiknya sudah diganti jadi
                <strong>HDR036</strong>. Tombol ini mengubah Code Hydrant, Nomer Urut, dan Lokasi
                pada baris laporan tsb supaya sesuai dengan HDR036 di Data Master.
                <strong>Bulan/tahun lain tidak disentuh</strong> - riwayat lama tetap tercatat HDR005
                seperti apa adanya saat itu.
            </p>
            <form method="POST"
                  onsubmit="return confirm('YAKIN ingin mengubah baris Laporan Juli 2026 di atas dari HDR005 menjadi HDR036?')">
                <input type="hidden" name="action" value="perbaiki_laporan_juli_hdr005_ke_hdr036">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-exchange-alt"></i> Ganti HDR005 Jadi HDR036 di Laporan Juli 2026
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <!-- STATUS: Duplikat -->
    <div class="card">
        <div class="card-header bg-<?= count($dupList) > 0 ? 'danger' : 'success' ?> text-white">
            <i class="fas fa-<?= count($dupList) > 0 ? 'exclamation-circle' : 'check-circle' ?>"></i>
            Status Duplikat di laporan_hydrant —
            <?= count($dupList) > 0 ? count($dupList) . ' duplikat ditemukan!' : 'Tidak ada duplikat ✅' ?>
        </div>
        <?php if (count($dupList) > 0): ?>
        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Code Hydrant</th><th>Bulan</th><th>Tahun</th>
                        <th>Jumlah Data</th><th>Semua ID (terkecil dipertahankan)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dupList as $d): ?>
                    <tr class="table-danger">
                        <td><strong><?= htmlspecialchars($d['code_hydrant']) ?></strong></td>
                        <td><?= $d['bln'] ?></td>
                        <td><?= $d['thn'] ?></td>
                        <td><?= $d['jml'] ?></td>
                        <td><?= $d['ids'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

    <!-- PERBAIKAN 3: Hapus duplikat (tampil hanya kalau ada duplikat) -->
    <?php if (count($dupList) > 0): ?>
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <i class="fas fa-trash"></i>
            Perbaikan 3 — Hapus Data Duplikat
        </div>
        <div class="card-body">
            <p>
                Untuk setiap hydrant yang duplikat di bulan yang sama,
                data dengan <strong>ID terkecil (pertama masuk) dipertahankan</strong>,
                sisanya dihapus permanen.
            </p>
            <form method="POST"
                  onsubmit="return confirm('YAKIN ingin hapus semua duplikat?\nAksi ini tidak bisa di-undo!')">
                <input type="hidden" name="action" value="hapus_duplikat">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i> Hapus Semua Duplikat Sekarang
                </button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <div class="alert alert-warning mt-3">
        <i class="fas fa-exclamation-triangle"></i>
        <strong>Reminder:</strong> Setelah semua selesai, hapus atau rename file
        <code>fix_hydrant_tool.php</code> dari server.
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
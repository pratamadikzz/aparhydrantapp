<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../koneksi.php'; // ✅ BENAR (admin → naik 1 folder)

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil data POST
$code         = $_POST['code'] ?? '';
$lokasi       = $_POST['lokasi'] ?? '';
$valve        = $_POST['valve'] ?? '';
$hose         = $_POST['hose'] ?? '';
$nozzle       = $_POST['nozzle'] ?? '';
$clamp_nozzle = $_POST['clamp_nozzle'] ?? '';
$drum_hose    = $_POST['drum_hose'] ?? '';
$keterangan   = $_POST['keterangan'] ?? '';

$activity = $_POST['activity'] ?? '';
$tanggal  = $_POST['tanggal'] ?? '';

// Validasi
if (
    empty($code) || empty($lokasi) || empty($valve) ||
    empty($hose) || empty($nozzle) || empty($clamp_nozzle) || empty($drum_hose)
) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Data belum lengkap!',
            text: 'Silakan lengkapi semua data wajib'
        }).then(() => {
            window.history.back();
        });
    </script>";
    exit();
}

// Insert ke hosereel
$sql = "INSERT INTO hosereel
(code, lokasi, valve, hose, nozzle, clamp_nozzle, drum_hose, keterangan)
VALUES
('$code','$lokasi','$valve','$hose','$nozzle','$clamp_nozzle','$drum_hose','$keterangan')";

if (mysqli_query($koneksi, $sql)) {

    // Simpan activity (opsional)
    $nama_pengguna = $_SESSION['username'];

mysqli_query($koneksi, "
    INSERT INTO aktivitas
    (nama_pengguna, code_apar, tanggal, keterangan)
    VALUES
    ('$nama_pengguna', '$code', '$tanggal', 'Menambahkan data Hose Reel')
");


    // SweetAlert sukses
    echo "
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Hose Reel berhasil ditambahkan',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = 'hoseriil.php';
            });
        </script>
    </body>
    </html>";

} else {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Data gagal disimpan ke database'
        }).then(() => {
            window.history.back();
        });
    </script>";
}

mysqli_close($koneksi);

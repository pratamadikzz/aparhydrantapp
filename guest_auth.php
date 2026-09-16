<?php
session_start();

// Ambil data dari form modal
$lokasi = $_POST['lokasi'] ?? '';
$kode   = $_POST['kode'] ?? '';

// Daftar kode lokasi
$kode_valid = [
    'Bogor'      => '3575',
    'Majalengka' => '3576'
];

if (isset($kode_valid[$lokasi]) && $kode_valid[$lokasi] === $kode) {
    // Simpan session
    $_SESSION['guest']  = true;
    $_SESSION['lokasi'] = $lokasi;

    // Redirect ke halaman guest
    header("Location: guest.php");
    exit;
} else {
    echo "<script>
        alert('Kode lokasi salah atau lokasi tidak valid!');
        window.history.back();
    </script>";
    exit;
}

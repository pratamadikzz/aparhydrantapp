<?php
// Proteksi session
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // aktifkan kalau sudah pakai HTTPS
session_start();

// 🔧 Mode maintenance
$maintenance = false; // ubah ke true kalau maintenance

if ($maintenance) {
    // Kalau bukan admin dan bukan di halaman maintenance.php → redirect
    if (
        (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin') &&
        basename($_SERVER['PHP_SELF']) !== 'maintenance.php'
    ) {
        header("Location: maintenance.php");
        exit();
    }
}
?>

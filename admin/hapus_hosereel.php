<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: hoseriil.php");
    exit();
}

$id = $_GET['id'];

// Hapus data
$hapus = mysqli_query($koneksi, "DELETE FROM hosereel WHERE id='$id'");

if ($hapus) {
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
                text: 'Data Hose Reel berhasil dihapus'
            }).then(() => {
                window.location.href = 'hoseriil.php';
            });
        </script>
    </body>
    </html>";
} else {
    echo "
    <script>alert('Gagal menghapus data'); window.history.back();</script>";
}

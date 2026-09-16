<?php
include '../../koneksi.php'; // Sesuaikan path

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query hapus
    $query = "DELETE FROM laporan WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../data_inspeksi.php?bulan=" . $_GET['bulan'] . "&tahun=" . $_GET['tahun']);
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>

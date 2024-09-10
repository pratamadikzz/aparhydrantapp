<?php
include ('../../../koneksi.php');
$lokasi = $_POST['lokasi'];
$activity = $_POST['activity'];
  $tanggal = $_POST['tanggal'];

$gel = "INSERT INTO tbl_lokasi (lokasi) VALUES ('$lokasi')";
if (mysqli_query($koneksi, $gel)) {
    // Eksekusi query untuk memasukkan aktivitas
    $query3 = "INSERT INTO aktivitas (tanggal, keterangan) VALUES ('$tanggal', '$activity')";
    if (mysqli_query($koneksi, $query3)) {
        header("location:../../lokasi.php");
    } else {
        echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: " . $gel . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);

?>
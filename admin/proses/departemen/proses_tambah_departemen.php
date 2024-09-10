<?php
include ('../../../koneksi.php');
$departemen = $_POST['departemen'];
$activity = $_POST['activity'];
$tanggal = $_POST['tanggal'];

$gel = "INSERT INTO tbl_departemen (departemen) VALUES ('$departemen')";
if (mysqli_query($koneksi, $gel)) {
    // Eksekusi query untuk memasukkan aktivitas
    $query3 = "INSERT INTO aktivitas (tanggal, keterangan) VALUES ('$tanggal', '$activity')";
    if (mysqli_query($koneksi, $query3)) {
        header("location:../../departemen.php");
    } else {
        echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: " . $gel . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);

?>
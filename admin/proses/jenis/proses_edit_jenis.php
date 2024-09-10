<?php
include ('../../../koneksi.php');
$id = $_POST['id'];
$lokasi = $_POST['lokasi'];
$activity = $_POST['activity'];
$tanggal = $_POST['tanggal'];

$query = "UPDATE jenis_apar SET jenis_apar='$lokasi' WHERE id='$id'";

if (mysqli_query($koneksi, $query)) {
    // Eksekusi query untuk memasukkan aktivitas
    $query3 = "INSERT INTO aktivitas (tanggal, keterangan) VALUES ('$tanggal', '$activity')";
    if (mysqli_query($koneksi, $query3)) {
        header("location:../../jenis_apar.php");
    } else {
        echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}
mysqli_close($koneksi);
?>

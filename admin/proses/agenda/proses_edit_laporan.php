<?php
include ('../../../koneksi.php');
$id = $_POST['id'];
$depar = $_POST['keterangan'];

$query = "UPDATE events SET keterangan='$depar' WHERE id='$id'";

if (mysqli_query($koneksi, $query)) {
    header("location:../../laporan.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}
mysqli_close($koneksi);
?>

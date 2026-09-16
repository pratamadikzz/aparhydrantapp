<?php
include '../../../koneksi.php';

$title = $_POST['title'];
$start = $_POST['start'];
$keterangan = $_POST['keterangan'];

$sql = "INSERT INTO events (title, start, keterangan) VALUES ('$title', '$start', '$keterangan')";

if ($koneksi->query($sql) === TRUE) {
    echo "New event created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>

<?php
include '../../../koneksi.php';

$event_id = $_POST['id'];

$sql = "DELETE FROM events WHERE id = $event_id";

if ($koneksi->query($sql) === TRUE) {
    echo "Agenda Berhasil di Hapus";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>

<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$id            = $_POST['id'];
$lokasi        = $_POST['lokasi'];
$valve         = $_POST['valve'];
$hose          = $_POST['hose'];
$nozzle        = $_POST['nozzle'];
$clamp_nozzle  = $_POST['clamp_nozzle'];
$drum_hose     = $_POST['drum_hose'];
$keterangan    = $_POST['keterangan'];

$query = "UPDATE hosereel SET
            lokasi='$lokasi',
            valve='$valve',
            hose='$hose',
            nozzle='$nozzle',
            clamp_nozzle='$clamp_nozzle',
            drum_hose='$drum_hose',
            keterangan='$keterangan'
          WHERE id='$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: hoseriil.php?status=update_sukses");
} else {
    die("Gagal update: " . mysqli_error($koneksi));
}

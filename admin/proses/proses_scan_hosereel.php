<?php
include ('../../koneksi.php');

$day = date('Y-m-d');

// Ambil data POST
$id = $_POST['id'];
$code = $_POST['code'];
$lokasi = $_POST['lokasi'];
$valve = $_POST['valve'];
$hose = $_POST['hose'];
$nozzle = $_POST['nozzle'];
$clamp_nozzle = $_POST['clamp_nozzle'];
$drum_hose = $_POST['drum_hose'];
$keterangan = $_POST['keterangan'];

// Data tambahan untuk aktivitas
$tanggal = $_POST['tanggal'];
$activity = $_POST['activity'];

// =======================
// UPDATE tabel hosereel
// =======================
$query1 = "UPDATE hosereel SET 
            lokasi='$lokasi', 
            valve='$valve', 
            hose='$hose', 
            nozzle='$nozzle', 
            clamp_nozzle='$clamp_nozzle', 
            drum_hose='$drum_hose', 
            keterangan='$keterangan'
            WHERE id='$id'";

// =======================
// INSERT ke tabel aktivitas
// =======================
$query2 = "INSERT INTO aktivitas (tanggal,keterangan,code_apar) VALUES ('$tanggal','$activity','$code')";

// =======================
// INSERT ke tabel laporan_hosereel
// =======================
$query3 = "INSERT INTO laporan_hosereel (nama,code_hosereel,tanggal_inspeksi,lokasi,valve,hose,nozzle,clamp_nozzle,drum_hose,keterangan)
           VALUES ('".$_SESSION['username']."','$code','$day','$lokasi','$valve','$hose','$nozzle','$clamp_nozzle','$drum_hose','$keterangan')";

// Eksekusi query
if(mysqli_query($koneksi, $query1)) {
    if(mysqli_query($koneksi, $query2)) {
        if(mysqli_query($koneksi, $query3)) {
            header("location:../../scan.php");
        } else {
            echo "Error laporan_hosereel: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error aktivitas: " . mysqli_error($koneksi);
    }
} else {
    echo "Error update hosereel: " . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>

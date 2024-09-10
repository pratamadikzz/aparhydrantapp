<?php
include ('../../../koneksi.php');

// Retrieve POST data
$id = $_POST['id'];
$codeApar = $_POST['code_apar'];
$lokasi = $_POST['lokasi'];
$departemen = $_POST['departemen'];
$tanggal_refill = $_POST['tanggal_refill'];
$tanggal_expired = $_POST['tanggal_expired'];
$vendor = $_POST['vendor'];
$kondisi = $_POST['kondisi'];
$masa_pemakaian = $_POST['masa_pemakaian'];
$tanggal_penggantian = $_POST['tanggal_penggantian'];
$jenisApar = $_POST['jenis_apar'];
$nozzle = $_POST['nozzle'];
$tabung = $_POST['tabung'];
$presure = $_POST['presure'];
$catridge = $_POST['catridge'];
$pin = $_POST['pin'];
$handle = $_POST['handle'];
$berat = $_POST['berat'];

// Additional data for events table
$nama = $_POST['nama'];
$keterangan = $_POST['keterangan'];

// Tambahan Untuk Activity User
$tanggal = $_POST['tanggal'];
$activity = $_POST['activity'];

// Update query for data_apar table
$query1 = "UPDATE data_apar SET 
            code_apar='$codeApar', 
            lokasi='$lokasi', 
            departemen='$departemen', 
            vendor='$vendor',
            kondisi='$kondisi',
            masa_pemakaian='$masa_pemakaian',
            tanggal_penggantian='$tanggal_penggantian',
            tanggal_refill='$tanggal_refill', 
            tanggal_expired='$tanggal_expired',
            jenis_apar='$jenisApar',
            nozzle='$nozzle', 
            tabung='$tabung', 
            presure='$presure',
            catridge='$catridge', 
            pin='$pin', 
            handle='$handle',
            berat='$berat' 
            WHERE id='$id'";

// Insert query for events table
$query2 = "UPDATE events SET nama='$nama',keterangan='$keterangan' WHERE title='$codeApar'";

// Insert query for aktivitas table
$query3 = "INSERT INTO aktivitas (code_apar, tanggal, keterangan) VALUES ('$codeApar', '$tanggal', '$activity')";

// Execute the update query
if (mysqli_query($koneksi, $query1)) {
    // Execute the update query for events table
    if (mysqli_query($koneksi, $query2)) {
        // Execute the insert query for aktivitas table
        if (mysqli_query($koneksi, $query3)) {
            header("location:../../scan.php");
        } else {
            echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Error: " . $query2 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: " . $query1 . "<br>" . mysqli_error($koneksi);
}

// Close the database connection
mysqli_close($koneksi);
?>

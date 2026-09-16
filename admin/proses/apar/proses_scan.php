<?php

//proses_scan.php



include('../../../koneksi.php');

$day = date('Y-m-d');

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
$plat_nomer = $_POST['platNomor'];

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
            berat='$berat', 
                 plat_nomer='$plat_nomer' 
            WHERE id='$id'";

// Insert query for events table
$query2 = "INSERT INTO aktivitas (tanggal, keterangan,code_apar) VALUES ('$tanggal', '$activity','$codeApar')";

// Check if a report already exists for this APAR code this month
$selectReport = "SELECT id, nama FROM laporan WHERE code_apar='$codeApar' AND MONTH(tanggal_inspeksi)=MONTH('$day') AND YEAR(tanggal_inspeksi)=YEAR('$day') LIMIT 1";
$resultReport = mysqli_query($koneksi, $selectReport);
if ($resultReport && mysqli_num_rows($resultReport) > 0) {
    $existingReport = mysqli_fetch_assoc($resultReport);
    $existingName = $existingReport['nama'];
    $errorMessage = "Kode APAR ini sudah di-scan bulan ini oleh $existingName";
    header("Location:../../scan.php?scan_error=" . urlencode($errorMessage));
    exit;
}

$query3 = "INSERT INTO laporan (nama,code_apar,tanggal_inspeksi,lokasi,departemen,vendor,kondisi,masa_pemakaian,tanggal_penggantian,tanggal_refill,tanggal_expired,jenis_apar,nozzle,tabung,presure,catridge,pin,handle,berat,plat_nomer) VALUES ('$nama','$codeApar','$day','$lokasi','$departemen','$vendor','$kondisi','$masa_pemakaian','$tanggal_penggantian','$tanggal_refill','$tanggal_expired','$jenisApar','$nozzle','$tabung','$presure','$catridge','$pin','$handle','$berat','$plat_nomer')";

// Execute the update query
if (mysqli_query($koneksi, $query1)) {
    // Execute the update query for events table
    if (mysqli_query($koneksi, $query2)) {
        // Execute the insert/update query for laporan table
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

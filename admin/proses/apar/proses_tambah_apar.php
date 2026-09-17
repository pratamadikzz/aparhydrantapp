<?php
include ('../../../koneksi.php');

// Retrieve POST data
$codeApar = $_POST['code_apar'];
$lokasi = $_POST['lokasi'];
$departemen = $_POST['departemen'];
$jenisApar = $_POST['jenis_apar'];
$nozzle = $_POST['nozzle'];
$tabung = $_POST['tabung'];
$presure = $_POST['presure'];
$catridge = $_POST['catridge'];
$pin = $_POST['pin'];
$handle = $_POST['handle'];
$tgl_refill = $_POST['tanggal_refill'];
$tgl_exp = $_POST['tanggal_expired'];
$berat = $_POST['berat'];
$plat = $_POST['plat'];
$jenis_tabung = $_POST['jenis_tabung'];

// Check if plat_nomer is provided
if (empty($plat)) {
    // Insert into data_apar without plat_nomer
    $query = "INSERT INTO data_apar (code_apar, lokasi, departemen, jenis_apar, nozzle, tabung, presure, catridge, pin, handle, tanggal_refill, tanggal_expired, berat, jenis_tabung) 
              VALUES ('$codeApar', '$lokasi', '$departemen', '$jenisApar', '$nozzle', '$tabung', '$presure', '$catridge', '$pin', '$handle', '$tgl_refill', '$tgl_exp', '$berat', '$jenis_tabung')";

    $redirect = 'apar.php';
} else {
    // Insert into data_apar with plat_nomer
    $query = "INSERT INTO data_apar (code_apar, lokasi, departemen, jenis_apar, nozzle, tabung, presure, catridge, pin, handle, tanggal_refill, tanggal_expired, berat, plat_nomer, jenis_tabung) 
              VALUES ('$codeApar', '$lokasi', '$departemen', '$jenisApar', '$nozzle', '$tabung', '$presure', '$catridge', '$pin', '$handle', '$tgl_refill', '$tgl_exp', '$berat', '$plat', '$jenis_tabung')";

    $redirect = 'apar_mobil.php';
}

// Execute the query
if (mysqli_query($koneksi, $query)) {
    // Additional insert for user activity
    $tanggal = $_POST['tanggal'];
    $activity = $_POST['activity'];

    $query3 = "INSERT INTO aktivitas (code_apar, tanggal, keterangan) VALUES ('$codeApar', '$tanggal', '$activity')";

    if (mysqli_query($koneksi, $query3)) {
        header("location:../../" . $redirect);
    } else {
        echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Close the database connection
mysqli_close($koneksi);
?>

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
$plat = $_POST['plat'];

// Primary update query
$query = "UPDATE data_apar SET code_apar='$codeApar', lokasi='$lokasi', departemen='$departemen', vendor='$vendor', kondisi='$kondisi', masa_pemakaian='$masa_pemakaian', tanggal_penggantian='$tanggal_penggantian', tanggal_refill='$tanggal_refill', tanggal_expired='$tanggal_expired', jenis_apar='$jenisApar', nozzle='$nozzle', tabung='$tabung', presure='$presure', catridge='$catridge', pin='$pin', handle='$handle', berat='$berat' WHERE id='$id'";

// Execute the primary update query
if (mysqli_query($koneksi, $query)) {
    // Check if plat_nomer is provided
    if (!empty($plat)) {
        // Execute the secondary update query to update plat_nomer
        $query2 = "UPDATE data_apar SET plat_nomer='$plat' WHERE id='$id'";
        if (mysqli_query($koneksi, $query2)) {
            // Redirect to apar_mobil.php
            header("location:../../apar_mobil.php");
        } else {
            echo "Error executing query2: " . $query2 . "<br>" . mysqli_error($koneksi);
        }
    } else {
        // If no plat_nomer, redirect to apar.php
        header("location:../../apar.php");
    }

    // Insert an activity log
    $tanggal = $_POST['tanggal'];
    $activity = $_POST['activity'];
    $query3 = "INSERT INTO aktivitas (code_apar,tanggal, keterangan) VALUES ('$codeApar','$tanggal', '$activity')";

    if (!mysqli_query($koneksi, $query3)) {
        echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error executing query: " . $query . "<br>" . mysqli_error($koneksi);
}

// Close the database connection
mysqli_close($koneksi);
?>

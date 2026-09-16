<?php
include('../../../koneksi.php');


    // Ambil data dari form
    $id = $_POST['id'];
    $lokasi = $_POST['lokasi'];
    $hose = $_POST['hose'];
    $nozzle = $_POST['nozzle'];
    $valve = $_POST['valve'];
    // Kunci cuma ada di form edit Outdoor sekarang (Indoor sudah tidak pakai
    // field Kunci lagi), jadi ambil dengan default kosong supaya form edit
    // Indoor (yang tidak mengirim field ini) tidak menyebabkan error.
    $kunci = mysqli_real_escape_string($koneksi, $_POST['kunci'] ?? '');
    $seal_karet_hose = $_POST['seal_karet_hose'];
    $seal_karet_nozzle = $_POST['seal_karet_nozzle'];
    $box_hydrant = $_POST['box_hydrant'];
    $keterangan = $_POST['keterangan'];
    $nomer_urut = $_POST['nomer_urut'];

    $activity = $_POST['activity'];
$tanggal = $_POST['tanggal'];
$code_hydrant = $_POST['code_hydrant'];

    // Query untuk update data
    $query = "UPDATE data_hydrant SET 
                lokasi = '$lokasi', 
                 nomer_urut = '$nomer_urut', 
                hose = '$hose', 
                nozzle = '$nozzle', 
                valve = '$valve', 
                kunci = '$kunci', 
                seal_karet_hose = '$seal_karet_hose', 
                seal_karet_nozzle = '$seal_karet_nozzle', 
                box_hydrant = '$box_hydrant', 
                keterangan = '$keterangan'
              WHERE id = '$id'";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Eksekusi query untuk memasukkan aktivitas
        $query3 = "INSERT INTO aktivitas (tanggal, keterangan,code_apar) VALUES ('$tanggal', '$activity','$code_hydrant')";
        if (mysqli_query($koneksi, $query3)) {
            header("location:../../hydrant.php");
        } else {
            echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
?>

<?php
include ('../../../koneksi.php');
$code_hydrant = $_POST['code_hydrant'];
$lokasi = $_POST['lokasi'];
$jenis_lokasi = $_POST['jenis_lokasi'];
// Nomer Urut sekarang dipakai untuk Indoor (angka biasa: 1,2,3,...) dan
// Outdoor (A1,A2,...). Kalau tidak diisi, default ke '-' seperti semula.
$nomer_urut = isset($_POST['nomer_urut']) ? trim($_POST['nomer_urut']) : '';
if ($nomer_urut === '') {
    $nomer_urut = '-';
}
$nomer_urut = mysqli_real_escape_string($koneksi, $nomer_urut);
$activity = $_POST['activity'];
  $tanggal = $_POST['tanggal'];

$gel = "INSERT INTO data_hydrant (code_hydrant,lokasi,jenis_lokasi,nomer_urut) VALUES ('$code_hydrant','$lokasi','$jenis_lokasi','$nomer_urut')";
if (mysqli_query($koneksi, $gel)) {
    // Eksekusi query untuk memasukkan aktivitas
    $query3 = "INSERT INTO aktivitas (tanggal, keterangan) VALUES ('$tanggal', '$activity')";
    if (mysqli_query($koneksi, $query3)) {
        header("location:../../hydrant.php");
    } else {
        echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: " . $gel . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);

?>
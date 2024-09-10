<?php

include ('../../../koneksi.php');

// Mendapatkan data dari formulir atau dari sumber lainnya
$nama = $_POST['nama'];
$user = $_POST['username'];
$pass = $_POST['password'];
$sebagai = $_POST['sebagai'];

// Informasi Tambahan
$activity = $_POST['activity'];
$tanggal = $_POST['tanggal'];


// Menghasilkan hash dari password menggunakan algoritma default (BCRYPT)
$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

// Perintah SQL untuk menyimpan data ke dalam tabel
$gel = "INSERT INTO user (nama, username, password, level) VALUES ('$nama', '$user', '$hashed_pass', '$sebagai')";

// Eksekusi query untuk memperbarui data user
if (mysqli_query($koneksi, $gel)) {
    // Eksekusi query untuk memasukkan aktivitas
    $query3 = "INSERT INTO aktivitas (tanggal, keterangan) VALUES ('$tanggal', '$activity')";
    if (mysqli_query($koneksi, $query3)) {
        header("location:../../user.php");
    } else {
        echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: " . $gel . "<br>" . mysqli_error($koneksi);
}
// Menutup koneksi
mysqli_close($koneksi);

?>

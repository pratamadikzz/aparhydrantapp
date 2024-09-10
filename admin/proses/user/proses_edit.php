<?php

include ('../../../koneksi.php');

// Mendapatkan data dari formulir atau dari sumber lainnya
$id = $_POST['id'];
$nama = $_POST['nama'];
$user = $_POST['username'];
$pass = $_POST['password'];
$sebagai = $_POST['sebagai'];

// Informasi Tambahan
$activity = $_POST['activity'];
$tanggal = $_POST['tanggal'];

// Periksa apakah password baru dimasukkan
if (!empty($pass)) {
    // Hash the new password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    // Perintah SQL untuk memperbarui data termasuk password
    $query = "UPDATE user SET nama='$nama', username='$user', password='$hashed_pass', level='$sebagai' WHERE id='$id'";
} else {
    // Perintah SQL untuk memperbarui data tanpa mengubah password
    $query = "UPDATE user SET nama='$nama', username='$user', level='$sebagai' WHERE id='$id'";
}

// Eksekusi query untuk memperbarui data user
if (mysqli_query($koneksi, $query)) {
    // Eksekusi query untuk memasukkan aktivitas
    $query3 = "INSERT INTO aktivitas (tanggal, keterangan) VALUES ('$tanggal', '$activity')";
    if (mysqli_query($koneksi, $query3)) {
        header("location:../../user.php");
    } else {
        echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);

?>

<?php
session_start();

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
$data = mysqli_fetch_assoc($login);

if ($data && password_verify($password, $data['password'])) {
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['id'] = $data['id'];
    $_SESSION['level'] = $data['level'];
    
    if ($data['level'] == "admin") {
        header("location:index.php");
    } else if ($data['level'] == "user") {
        header("location:index.php");
    } else {
        echo "<script>alert('Username atau password Salah'); window.location.href = 'login.php';</script>";
    }
} else {
    echo "<script>alert('Username atau password Salah'); window.location.href = 'login.php';</script>";
}
?>

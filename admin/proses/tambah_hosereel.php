<?php
include '../koneksi.php';
session_start();

// Cek login admin
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['submit'])){
    $code = $_POST['code'];
    $lokasi = $_POST['lokasi'];
    $valve = $_POST['valve'];
    $hose = $_POST['hose'];
    $nozzle = $_POST['nozzle'];
    $clamp_nozzle = $_POST['clamp_nozzle'];
    $drum_hose = $_POST['drum_hose'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO hosereel (code, lokasi, valve, hose, nozzle, clamp_nozzle, drum_hose, keterangan)
            VALUES ('$code', '$lokasi', '$valve', '$hose', '$nozzle', '$clamp_nozzle', '$drum_hose', '$keterangan')";

    if(mysqli_query($koneksi, $sql)){
        header("Location: hosereel.php?success=Data berhasil ditambahkan");
    } else {
        $error = "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Hose Reel</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>Tambah Data Hose Reel</h3>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Code Hose Reel</label>
            <input type="text" name="code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Valve</label>
            <select name="valve" class="form-control" required>
                <option value="baik">Baik</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Hose</label>
            <select name="hose" class="form-control" required>
                <option value="baik">Baik</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Nozzle</label>
            <select name="nozzle" class="form-control" required>
                <option value="baik">Baik</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Clamp Nozzle</label>
            <select name="clamp_nozzle" class="form-control" required>
                <option value="baik">Baik</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Drum Hose</label>
            <select name="drum_hose" class="form-control" required>
                <option value="baik">Baik</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
        <a href="hosereel.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>

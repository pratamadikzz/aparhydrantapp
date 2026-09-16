<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: hoseriil.php");
    exit();
}

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM hosereel WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Hose Reel</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h3>Edit Data Hose Reel</h3>
    <hr>

    <form action="proses_edit_hosereel.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <div class="mb-3">
            <label>Code Hose Reel</label>
            <input type="text" class="form-control" value="<?= $data['code']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" class="form-control" name="lokasi" value="<?= $data['lokasi']; ?>" required>
        </div>

        <?php
        function opsi($val, $db){
            return $val == $db ? 'selected' : '';
        }
        ?>

        <div class="mb-3">
            <label>Valve</label>
            <select name="valve" class="form-control">
                <option value="Baik" <?= opsi('Baik',$data['valve']); ?>>Baik</option>
                <option value="Tidak" <?= opsi('Tidak',$data['valve']); ?>>Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Hose</label>
            <select name="hose" class="form-control">
                <option value="Baik" <?= opsi('Baik',$data['hose']); ?>>Baik</option>
                <option value="Tidak" <?= opsi('Tidak',$data['hose']); ?>>Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Nozzle</label>
            <select name="nozzle" class="form-control">
                <option value="Baik" <?= opsi('Baik',$data['nozzle']); ?>>Baik</option>
                <option value="Tidak" <?= opsi('Tidak',$data['nozzle']); ?>>Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Clamp Nozzle</label>
            <select name="clamp_nozzle" class="form-control">
                <option value="Baik" <?= opsi('Baik',$data['clamp_nozzle']); ?>>Baik</option>
                <option value="Tidak" <?= opsi('Tidak',$data['clamp_nozzle']); ?>>Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Drum Hose</label>
            <select name="drum_hose" class="form-control">
                <option value="Baik" <?= opsi('Baik',$data['drum_hose']); ?>>Baik</option>
                <option value="Tidak" <?= opsi('Tidak',$data['drum_hose']); ?>>Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"><?= $data['keterangan']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="hoseriil.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>

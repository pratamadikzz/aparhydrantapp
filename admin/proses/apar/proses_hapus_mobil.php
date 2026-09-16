<?php
include ('../../../koneksi.php');
$id = $_POST['id'];



// Escape the ID to prevent SQL injection
$id = mysqli_real_escape_string($koneksi, $id);

// Query to delete the user from the database
$result = mysqli_query($koneksi, "DELETE FROM data_apar WHERE id = '$id'");
$cek = mysqli_affected_rows($koneksi);

if ($cek > 0) {
    // If the deletion was successful, insert an activity log
    $codeApar = $_POST['code_apar'];
    $activity = $_POST['activity'];
    $tanggal = $_POST['tanggal'];
    $query3 = "INSERT INTO aktivitas (code_apar,tanggal, keterangan) VALUES ('$codeApar','$tanggal', '$activity')";

    if (mysqli_query($koneksi, $query3)) {
        echo "<script> 
                alert('BERHASIL DI MENGHAPUS');
              </script>";
        header("Location: ../../apar_mobil.php");
    } else {
        echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: User tidak ditemukan atau gagal menghapus.<br>" . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);
?>

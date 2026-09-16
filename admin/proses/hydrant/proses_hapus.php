<?php
include ('../../../koneksi.php');
$id = $_POST['id'];

$id = mysqli_real_escape_string($koneksi, $id);

$result = mysqli_query($koneksi, "DELETE FROM data_hydrant WHERE id = '$id'");
$cek = mysqli_affected_rows($koneksi);

if ($cek > 0) {
  // If the deletion was successful, insert an activity log
  $activity = $_POST['activity'];
  $tanggal = $_POST['tanggal'];
  $code_hydrant = $_POST['code_hydrant'];
  
  $query3 = "INSERT INTO aktivitas (tanggal, keterangan,code_apar) VALUES ('$tanggal', '$activity','$code_hydrant')";

  if (mysqli_query($koneksi, $query3)) {
      echo "<script> 
              alert('BERHASIL DI MENGHAPUS');
            </script>";
      header("Location: ../../hydrant.php");
  } else {
      echo "Error: " . $query3 . "<br>" . mysqli_error($koneksi);
  }
} else {
  echo "Error: Lokasi tidak ditemukan atau gagal menghapus.<br>" . mysqli_error($koneksi);
}
?>

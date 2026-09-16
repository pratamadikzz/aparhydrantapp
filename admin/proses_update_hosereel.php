<?php
include '../koneksi.php';

$id = $_POST['id'];

$stmt = mysqli_prepare($koneksi, "
    UPDATE hosereel SET
      lokasi=?,
      valve=?,
      hose=?,
      nozzle=?,
      clamp_nozzle=?,
      drum_hose=?,
      keterangan=?
    WHERE id=?
");

mysqli_stmt_bind_param(
  $stmt,
  "sssssssi",
  $_POST['lokasi'],
  $_POST['valve'],
  $_POST['hose'],
  $_POST['nozzle'],
  $_POST['clamp_nozzle'],
  $_POST['drum_hose'],
  $_POST['keterangan'],
  $id
);

mysqli_stmt_execute($stmt);

echo json_encode(['success'=>true]);

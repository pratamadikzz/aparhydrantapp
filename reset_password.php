<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

  $stmt = $koneksi->prepare('UPDATE user SET password = ? WHERE username = ?');
  $stmt->bind_param('ss', $new_password, $username);

  if ($stmt->execute()) {
    echo 'success';
  } else {
    echo 'error';
  }

  $stmt->close();
  $koneksi->close();
}
?>

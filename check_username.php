<?php
// Database connection
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];

  $stmt = $koneksi->prepare('SELECT * FROM user WHERE username = ?');
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo 'valid';
  } else {
    echo 'invalid';
  }

  $stmt->close();
  $koneksi->close();
}
?>

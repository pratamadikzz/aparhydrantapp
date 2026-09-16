<?php
// emergency-login.php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // akun darurat
    $emergency_user = "emergency_admin";
    $emergency_pass = "adminhelp";

    if ($username === $emergency_user && $password === $emergency_pass) {
        session_regenerate_id(true);
        $_SESSION['username'] = $username;
        $_SESSION['level']    = "admin";
        $_SESSION['pending_login'] = true; // flag sementara
    } else {
        $error = "⚠️ Username atau password darurat salah!";
    }
}

// proses pilih lokasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pilih_lokasi'])) {
    $lokasi = $_POST['lokasi'] ?? '';
    if (!empty($lokasi)) {
        $_SESSION['lokasi'] = $lokasi;
        unset($_SESSION['pending_login']); // hapus flag

        if ($lokasi === 'bogor') {
            header("Location: https://www.storage-cloud.my.id");
        } elseif ($lokasi === 'majalengka') {
            header("Location: https://www.storage-cloud.my.id/Cek_AparHydrantMaja/");
        } else {
            header("Location: index.php");
        }
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Darurat | Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
    rel="icon"
    href="assets/img/logokecilAH.png"
    type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: url(assets/img/787fce35-6227-45d1-9430-f022c6684a88.png);
      background-size: cover;
      font-family: 'Arial', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
    }
    .login-box {
      width: 380px;
      padding: 30px 25px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.2);
      text-align: center;
      animation: fadeInUp 1s ease;
    }
    @keyframes fadeInUp {
      from {opacity: 0; transform: translateY(30px);}
      to {opacity: 1; transform: translateY(0);}
    }
    .login-box h2 {
      color: #fff;
      margin-bottom: 20px;
      font-weight: 600;
    }
    .login-box input {
      width: 100%;
      padding: 12px 5px;
      margin: 10px 0;
      border-radius: 50px;
      border: none;
      font-size: 1rem;
      outline: none;
      background: rgba(255,255,255,0.85);
    }
    .login-box button {
      width: 100%;
      padding: 12px;
      border-radius: 50px;
      border: none;
      font-size: 1rem;
      font-weight: bold;
      background: linear-gradient(135deg, #ff416c, #ff4b2b);
      color: #fff;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 10px;
    }
    .login-box button:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .login-box a {
      display: inline-block;
      margin-top: 15px;
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }
    .login-box a:hover {
      color: #ffb347;
    }
    .error-msg {
      background: rgba(255,0,0,0.2);
      padding: 8px;
      border-radius: 8px;
      margin-bottom: 10px;
      color: #fff;
      font-size: 0.9rem;
    }
    .login-box img {
      width: 90px;
      margin-bottom: 15px;
      filter: drop-shadow(0 5px 8px rgba(0,0,0,0.3));
    }
  </style>
</head>
<body>
  <div class="login-box">
    <img src="assets/img/logologinAH.png" alt="Logo">
    <h2><i class="fas fa-key"></i> Login Darurat</h2>
    <?php if (!empty($error)): ?>
      <div class="error-msg"><?= $error; ?></div>
    <?php endif; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username Darurat" required autocomplete="off">
      <input type="password" name="password" placeholder="Password Darurat" required autocomplete="off">
      <button type="submit" name="login"><i class="fas fa-sign-in-alt"></i> Masuk</button>
    </form>
    <a href="login.php"><i class="fa-solid fa-arrow-left"></i> Kembali ke Login</a>
  </div>

  <!-- Modal Pilih Lokasi -->
  <div class="modal fade" id="lokasiModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <form method="POST" class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="fa-solid fa-map-marker-alt me-2"></i>Pilih Lokasi</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <select name="lokasi" class="form-select mb-3" required>
            <option value="">-- Pilih Lokasi --</option>
            <option value="bogor">Bogor</option>
            <option value="majalengka">Majalengka</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="submit" name="pilih_lokasi" class="btn btn-primary">Lanjutkan</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <?php if (!empty($_SESSION['pending_login'])): ?>
  <script>
    var lokasiModal = new bootstrap.Modal(document.getElementById('lokasiModal'));
    lokasiModal.show();
  </script>
  <?php endif; ?>
</body>
</html>

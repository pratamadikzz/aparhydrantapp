<?php
// Taruh ini paling atas
include 'config.php';

// Proteksi session
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // aktifkan kalau sudah pakai HTTPS/Cloudflare
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Query user dari database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // 🔐 Regenerasi session ID setelah login sukses
            session_regenerate_id(true);

           $_SESSION['username'] = $row['username'];
		   $_SESSION['level']    = $row['level'] ?? 'user';

           // ⛔ reset nama supaya WAJIB isi ulang
           unset($_SESSION['nama_pengguna']);

		   header("Location: index.php");
		   exit();

        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <title>Cek Apar | Hydrant - Sign In</title>
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link
    rel="icon"
    href="assets/img/logokecilAH.png"
    type="image/x-icon" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background: url(assets/img/787fce35-6227-45d1-9430-f022c6684a88.png);
      ;
      font-family: 'Arial', sans-serif;
      background-size: cover;
      overflow: hidden;
    }

    .grid.align__item {
  width: 100%;
  max-width: 400px; /* maksimal lebar form */
  padding: 20px;
}

    .grid {
      position: relative;
      z-index: 2;
    }

    .register {
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      padding: 1rem 1rem;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .register img {
      display: block;
      margin: 0 auto 2rem;
      width: 100px;
      height: auto;
      filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.2));
    }

    h2 {
      color: #333;
      font-size: 2rem;
      margin-bottom: 2rem;
      text-align: center;
      font-weight: 600;
    }

    .form__field input {
      width: 100%;
       padding: 0.8rem 1rem; /* sedikit lebih kecil */
      border: 2px solid #e1e5e9;
      border-radius: 50px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.8);
    }

    .form__field input:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      outline: none;
    }

    .form__field input[type="submit"] {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      cursor: pointer;
      font-weight: 600;
      margin-top: 1rem;
      transition: transform 0.2s ease;
    }

    .form__field input[type="submit"]:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .register a {
      display: block;
      text-align: center;
      margin-top: 1rem;
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .register a:hover {
      color: #b18ed4ff;
    }

    .register p {
      text-align: center;
      margin-top: 1.5rem;
      color: #666;
      font-size: 0.9rem;
    }

    /* Floating particles effect */
    .particle {
      position: absolute;
      width: 10px;
      height: 10px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .particle:nth-child(1) {
      left: 10%;
      animation-delay: 0s;
    }

    .particle:nth-child(2) {
      left: 20%;
      animation-delay: 1s;
    }

    .particle:nth-child(3) {
      left: 30%;
      animation-delay: 2s;
    }

    .particle:nth-child(4) {
      left: 40%;
      animation-delay: 3s;
    }

    .particle:nth-child(5) {
      left: 50%;
      animation-delay: 4s;
    }

    .particle:nth-child(6) {
      left: 60%;
      animation-delay: 5s;
    }

    .particle:nth-child(7) {
      left: 70%;
      animation-delay: 6s;
    }

    .particle:nth-child(8) {
      left: 80%;
      animation-delay: 7s;
    }

    .particle:nth-child(9) {
      left: 90%;
      animation-delay: 8s;
    }

    .particle:nth-child(10) {
      left: 100%;
      animation-delay: 9s;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-20px);
      }
    }

    .back-btn {
      position: relative;
      text-decoration: none;
      bottom: 200px;
      top: 5px;
      left: 1px;
      font-weight: bold;
      transition: 0.3s ease-in-out;
      padding: 8px 12px;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .back-btn::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -5px;
      /* tepat di bawah teks */
      width: 0%;
      height: 2px;
      background: rgb(90, 5, 151);
      transition: width 0.3s ease-in-out;
    }

    .back-btn:hover::after {
      width: 100%;
    }

    .back-btn:hover {
      background: rgba(36, 53, 179, 0.7);
    }
  </style>

</head>
</head>

<body class="align">

  <div class="grid align__item" data-aos="zoom-in">

    <div class="register">

      <img src="assets/img/logologinAH.png" width="300px">

      <h2>Sign In - Bogor</h2>

      <form action="cek_login.php" method="post" class="form">

        <div class="form__field">
          <input type="text" placeholder="Username" name="username" required autocomplete="off">
        </div>

        <div class="form__field">
          <input type="password" placeholder="Password" name="password" required autocomplete="off">
        </div>

        <div class="form__field">
          <input type="submit" value="Sign In">
        </div>
        <a href="emergency-login.php" class="btn btn-danger">
    <i class="fas fa-key"></i> Login Darurat (Admin)
  </a>
        <a href="landing.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
      </form>
      <a href="forget.php">Lupa Password?</a>
      <p>Silahkan Sign In Terlebih dahulu</p>

    </div>

  </div>

</body>
<link rel="stylesheet" href="style.scss">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</html>
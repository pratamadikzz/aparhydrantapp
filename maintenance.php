<?php
include 'config.php';

// Kalau maintenance udah dimatikan, langsung balik ke index
if (!$maintenance) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Maintenance</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
      margin: 0;
      overflow: hidden;
    }

    .box {
      text-align: center;
      padding: 40px 60px;
      border-radius: 15px;
      background: white;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      animation: fadeIn 1s ease-in-out;
      max-width: 500px;
      position: relative;
      z-index: 10;
      overflow: hidden;
    }

    /* ✨ Outline neon hidup + glow */
    .box::before {
      content: "";
      position: absolute;
      top: -4px; left: -4px; right: -4px; bottom: -4px;
      border-radius: 20px;
      background: conic-gradient(
        from 0deg,
        #ff00ff,
        #00ffff,
        #ffff00,
        #ff00ff
      );
      animation: spin 4s linear infinite;
      z-index: -1;
      padding: 4px;
      filter: blur(8px); /* glow effect */
      -webkit-mask: 
        linear-gradient(#000 0 0) content-box, 
        linear-gradient(#000 0 0);
      -webkit-mask-composite: xor;
              mask-composite: exclude;
    }

    @keyframes spin {
      0%   { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    h1 { font-size: 2rem; color: #333; margin: 10px 0; }
    h2 { font-size: 1.5rem; color: #555; margin-bottom: 5px; }
    h3, h4 { margin: 5px 0; color: #666; font-weight: normal; }
    p { color: #444; margin-top: 10px; }

    .support { margin-top: 20px; }
    .support a {
      display: inline-block;
      padding: 12px 20px;
      background: #25D366;
      color: white;
      text-decoration: none;
      font-weight: bold;
      border-radius: 8px;
      transition: background 0.3s;
    }
    .support a:hover { background: #128C7E; }

    /* Awan animasi */
    .cloud {
      position: absolute;
      top: 50px;
      width: 200px;
      height: 100px;
      background: #fff;
      border-radius: 100px;
      box-shadow: 60px 0 0 20px #fff, 120px 10px 0 40px #fff, 180px 0 0 20px #fff;
      opacity: 0.7;
      animation: cloudMove 30s linear infinite;
    }

    .cloud:nth-child(2) {
      top: 120px;
      left: -300px;
      animation-duration: 40s;
    }

    @keyframes cloudMove {
      0% { left: -300px; }
      100% { left: 110%; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Container animasi Lottie */
    #lottie {
      width: 200px;
      margin: 20px auto;
    }
  </style>
</head>
<body>
  <!-- Awan -->
  <div class="cloud"></div>
  <div class="cloud"></div>

  <div class="box">
    <h2>Mohon Maaf saat ini</h2>
    <h1>Website Sedang Maintenance</h1>
    <h3>Mulai dari</h3>
    <h4>Jumat Pukul 09.00 - Senin Pukul 14.00 WIB</h4>
    <p>Silakan coba beberapa saat lagi.</p>

    <!-- Animasi kartun (Lottie) -->
    <div id="lottie"></div>

    <div class="support">
      <a href="https://wa.me/6282125098439?text=Halo%20Admin,%20saya%20butuh%20bantuan." target="_blank">
        🔧 Hubungi via WhatsApp
      </a>
    </div>
  </div>

  <script>
    // Load animasi Lottie (contoh animasi maintenance)
    lottie.loadAnimation({
      container: document.getElementById('lottie'),
      renderer: 'svg',
      loop: true,
      autoplay: true,
      path: "https://assets8.lottiefiles.com/packages/lf20_qp1q7mct.json"
    });
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cek Apar | Hydrant - Reset Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/img/logokecil.png" type="image/x-icon"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    /* ===== Body & Background ===== */
    body {
      margin: 0;
      height: 100vh;
      font-family: 'Arial', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      background: url(assets/img/787fce35-6227-45d1-9430-f022c6684a88.png) center/cover no-repeat;
      position: relative;
    }

    /* Floating Particles */
    .particle {
      position: absolute;
      width: 10px;
      height: 10px;
      background: rgba(255,255,255,0.12);
      border-radius: 50%;
      animation: float 10s ease-in-out infinite;
    }
    .particle:nth-child(1) { left: 5%; animation-delay: 0s; }
    .particle:nth-child(2) { left: 20%; animation-delay: 2s; }
    .particle:nth-child(3) { left: 35%; animation-delay: 4s; }
    .particle:nth-child(4) { left: 50%; animation-delay: 6s; }
    .particle:nth-child(5) { left: 65%; animation-delay: 8s; }
    .particle:nth-child(6) { left: 80%; animation-delay: 10s; }
    .particle:nth-child(7) { left: 90%; animation-delay: 12s; }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-25px); }
    }

    /* ===== Form Container Glassmorphism ===== */
    .register {
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(15px);
      padding: 3rem 2.5rem;
      border-radius: 25px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 20px 50px rgba(0,0,0,0.4);
      text-align: center;
      position: relative;
      z-index: 10;
      border: 1px solid rgba(255,255,255,0.25);
      animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(50px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .register img {
      width: 160px;
      margin-bottom: 20px;
      filter: drop-shadow(0 5px 15px rgba(0,0,0,0.3));
    }

    h2 {
      margin-bottom: 2rem;
      color: #fff;
      font-weight: 700;
      font-size: 1.8rem;
      text-shadow: 0 0 8px rgba(118,75,162,0.6);
    }

    /* ===== Form Inputs ===== */
   .form__field input {
  width: 100%;
  padding: 1rem 0.1rem;
  margin-bottom: 1rem;
  border: 2px solid rgba(255,255,255,0.4);
  border-radius: 50px;
  font-size: 1rem;
  background: rgba(255,255,255,0.1); /* default gelap */
  color: #fff;
  transition: all 0.3s ease; /* smooth transition */
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.form__field input:focus {
  border-color: #764ba2;
  background: rgba(60,100,55,0.35); /* bg menjadi lebih terang */
  box-shadow: 0 0 12px rgba(118,75,162,0.7);
  outline: none;
  transform: translateY(-2px);
}


    .form__field input::placeholder {
      color: rgba(255,255,255,0.7);
    }

    /* .form__field input:focus {
      border-color: #764ba2;
      box-shadow: 0 0 12px rgba(118,75,162,0.7);
      field-color: blue;
      outline: none;
      transform: translateY(-2px);
      background: rgba(255,255,255,0.15);
    } */

    /* ===== Submit Button Neon Glow ===== */
    .form__field input[type="submit"] {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border: none;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 0 8px rgba(118,75,162,0.6), 0 0 20px rgba(118,75,162,0.4);
    }

    .form__field input[type="submit"]:hover {
      box-shadow: 0 0 15px rgba(118,75,162,0.8), 0 0 30px rgba(118,75,162,0.6);
      transform: translateY(-3px);
      filter: brightness(1.1);
    }

    /* ===== Links ===== */
    a {
      display: block;
      margin-top: 1rem;
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    a:hover { color: #667eea; }

    p {
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #ddd;
    }

    .lang-dropdown {
  padding: 6px 12px;
  border-radius: 8px;
  border: 1px solid rgba(255,255,255,0.4);
  background: rgba(255,255,255,0.15);
  color: #fff;
  font-weight: 600;
  font-size: 0.95rem;
  cursor: pointer;
  outline: none;
  transition: all 0.3s ease;
  appearance: none; /* hilangkan default arrow */
  -webkit-appearance: none;
  -moz-appearance: none;
  position: relative;
}

/* Arrow Custom */
.lang-dropdown::after {
  content: "▼";
  position: absolute;
  right: 12px;
  pointer-events: none;
}

/* Hover / Focus */
.lang-dropdown:hover,
.lang-dropdown:focus {
  background: rgba(60,100,55,0.35);
  border-color: #764ba2;
  color: #fff;
}

/* Toggle switch style */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 24px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #764ba2;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

/* Mode Siang / Gelap */
.register.light-mode {
  background-color: rgba(255, 50, 50, 0.15); /* putih transparan */
  backdrop-filter: blur(10px); /* efek blur */
  -webkit-backdrop-filter: blur(10px); /* support Safari */
  color: #333;
  border: 1px solid rgba(0,0,0,0.2);
  box-shadow: 0 20px 50px rgba(0,0,0,0.2);
}

.register.light-mode input {
  background: rgba(255,255,255,0.8);
  color: #333;
  border-color: rgba(0,0,0,0.3);
}

.register.light-mode input::placeholder {
  color: rgba(0,0,0,0.5);
}

.register.light-mode a { color: #333; }
.register.light-mode a:hover { color: #667eea; }
.register.light-mode h2 { color: #333; text-shadow: none; }

/* Toast Notification */
.toast {
  position: fixed;
  top: 20px;
  right: 20px;
  background: rgba(118, 75, 162, 0.95);
  color: #fff;
  padding: 15px 25px;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
  font-size: 0.95rem;
  opacity: 0;
  pointer-events: none;
  transform: translateY(-20px);
  transition: all 0.4s ease;
  z-index: 9999;
}

.toast.show {
  opacity: 1;
  pointer-events: auto;
  transform: translateY(0);
}

  </style>
</head>

<body>
  <!-- Floating Particles -->
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>
<div id="toast" class="toast"></div>
  <!-- Reset Password Form -->
  <div class="register">
    <img src="assets/img/logologinAH.png" alt="Logo">
    <h2>Reset Password</h2>

<!-- Toggle Dark / Light -->
<div style="text-align:right; margin-bottom:15px;">
  <label class="switch">
    <input type="checkbox" id="darkModeToggle">
    <span class="slider round"></span>
  </label>
</div>
<!-- Language Flags -->
<div style="text-align:right; margin-bottom:15px;">
  <select id="langSelect" class="lang-dropdown">
    <option value="id">🇮🇩 Indonesia</option>
    <option value="en">🇺🇸 English</option>
  </select>
</div>

    <form id="resetForm" class="form">
      <div class="form__field">
        <input type="text" placeholder="Username" name="username" id="username" required>
      </div>

      <div class="form__field" id="resetFields" style="display:none;">
        <input type="password" placeholder="New Password" name="new_password" id="new_password" >
        <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" >
      </div>

      <div class="form__field">
        <input type="submit" value="Confirm" id="submitBtn">
      </div>
    </form>

    <a href="login.php"><i class="fa-solid fa-arrow-left"></i> Kembali ke Login</a>
    <p>Silahkan reset password terlebih dahulu</p>
  </div>

<!-- ===== JS ===== -->
<script>
$(document).ready(function() {
  // ===== Toast Notification =====
  function showToast(message) {
    const $toast = $('#toast');
    $toast.text(message).addClass('show');
    setTimeout(() => $toast.removeClass('show'), 3000);
  }

  // ===== Language Toggle =====
  const texts = {
    en: {
      title: "Reset Password",
      username: "Username",
      new_password: "New Password",
      confirm_password: "Confirm Password",
      submit: "Confirm",
      back: "<i class='fa-solid fa-arrow-left'></i> Back to Login",
      alertEmpty: "Please fill all fields",
      alertMismatch: "Passwords do not match",
      alertSuccess: "Password reset successful",
      alertError: "Error resetting password",
      alertUserNotFound: "Username not found"
    },
    id: {
      title: "Reset Password",
      username: "Nama Pengguna",
      new_password: "Password Baru",
      confirm_password: "Konfirmasi Password",
      submit: "Konfirmasi",
      back: "<i class='fa-solid fa-arrow-left'></i> Kembali ke Login",
      alertEmpty: "Harap isi semua field",
      alertMismatch: "Password tidak cocok",
      alertSuccess: "Password berhasil direset",
      alertError: "Terjadi kesalahan saat reset password",
      alertUserNotFound: "Username tidak ditemukan"
    }
  };

  let currentLang = 'id';

  // Dropdown change
  $('#langSelect').change(function() {
    setLanguage($(this).val());
  });

  function setLanguage(lang) {
    currentLang = lang;
    const t = texts[lang];
    $('h2').html(t.title);
    $('#username').attr('placeholder', t.username);
    $('#new_password').attr('placeholder', t.new_password);
    $('#confirm_password').attr('placeholder', t.confirm_password);
    $('#submitBtn').val(t.submit);
    $('a[href="login.php"]').html(t.back);
  }

  // ===== Form Submit =====
  $('#resetForm').on('submit', function(e) {
    e.preventDefault();
    const username = $('#username').val().trim();
    const newPassword = $('#new_password').val().trim();
    const confirmPassword = $('#confirm_password').val().trim();

    if ($('#resetFields').is(':hidden')) {
      if (!username) return showToast(texts[currentLang].alertEmpty);

      // cek username
      $.ajax({
        type: 'POST',
        url: 'check_username.php',
        data: { username },
        success: function(response) {
          if (response === 'valid') {
            $('#resetFields').slideDown(function() {
              $('#new_password, #confirm_password').prop('required', true);
            });
            $('#submitBtn').val(texts[currentLang].submit);
          } else {
            showToast(texts[currentLang].alertUserNotFound);
          }
        }
      });
    } else {
      if (!newPassword || !confirmPassword) return showToast(texts[currentLang].alertEmpty);
      if (newPassword !== confirmPassword) {
        showToast(texts[currentLang].alertMismatch);
      } else {
        $.ajax({
          type: 'POST',
          url: 'reset_password.php',
          data: { username, new_password: newPassword, confirm_password: confirmPassword },
          success: function(response) {
            if (response === 'success') {
              showToast(texts[currentLang].alertSuccess);
              setTimeout(() => window.location.href = 'login.php', 1000);
            } else {
              showToast(texts[currentLang].alertError);
            }
          }
        });
      }
    }
  });

  // ===== Input Focus Highlight =====
  $('.form__field input').on('focus', function() {
    $(this).css('background', 'rgba(60,100,55,0.35)');
  }).on('blur', function() {
    $(this).css('background', 'rgba(255,255,255,0.1)');
  });

  // ===== Dark Mode Toggle =====
  $('#darkModeToggle').change(function() {
    if($(this).is(':checked')){
      $('.register').removeClass('light-mode'); // Dark mode
    } else {
      $('.register').addClass('light-mode'); // Light mode
    }
  });
});


</script>

</body>
</html>

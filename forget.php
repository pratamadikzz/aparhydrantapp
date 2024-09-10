<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cek Apar | Forget Password</title>
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="assets/img/logokecil.png" type="image/x-icon"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
        .form-group {
            margin-bottom: 15px;
        }
    </style>
<body class="align">
  <div class="grid align__item">
    <div class="register">
      <img src="assets/img/logologin.png" width="300px">
      <h2>Reset Password</h2>
      <form id="resetForm" class="form">
        <div class="form__field">
          <input type="text" placeholder="Username" name="username" id="username">
        </div>
        <div class="form__field" id="resetFields" style="display:none;">
          <input type="password" placeholder="New Password" name="new_password" id="new_password">
          <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
        </div>
        <div class="form__field">
          <input type="submit" value="Confirm" id="submitBtn">
        </div>
      </form>
      <a href="login.php">Kembali Kemenu Login</a>
      <p>Silahkan Sign In Terlebih dahulu</p>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#resetForm').on('submit', function(e) {
        e.preventDefault();
        const username = $('#username').val();
        const newPassword = $('#new_password').val();
        const confirmPassword = $('#confirm_password').val();
        
        if ($('#resetFields').is(':hidden')) {
          // Check username
          $.ajax({
            type: 'POST',
            url: 'check_username.php',
            data: {username: username},
            success: function(response) {
              if (response === 'valid') {
                $('#resetFields').show();
                $('#submitBtn').val('Reset Password');
              } else {
                alert('Username not found');
              }
            }
          });
        } else {
          // Reset password
          if (newPassword !== confirmPassword) {
            alert('Passwords do not match');
          } else {
            $.ajax({
              type: 'POST',
              url: 'reset_password.php',
              data: {
                username: username,
                new_password: newPassword,
                confirm_password: confirmPassword
              },
              success: function(response) {
                if (response === 'success') {
                  alert('Password reset successful');
                  window.location.reload();
                } else {
                  alert('Error resetting password');
                }
              }
            });
          }
        }
      });
    });
  </script>
</body>
<link rel="stylesheet" href="style.scss">
</html>

<?php require 'process/login.php';

if (isset($_SESSION['username'])) {
  if ($_SESSION['section'] == 'mppd1') {
    header('location: page/requester/dashboard.php');
    exit;
  }elseif($_SESSION['section'] == 'ame3'){
    header('location: page/purchasing/dashboard.php');
    exit;
  }elseif($_SESSION['section'] == 'ame2'){
    header('location: page/installation/dashboard.php');
    exit;
  }  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> JOMS | Login </title>
   <link rel="alternate icon" href="dist/img/logo.ico" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="plugins/style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <!-- style="background-image: url('dist/img/.png'); background-repeat: no-repeat; background-size: 100% 100%;" -->
<div class="login-box">
  <div class="login-logo">
    <img src="dist/img/logo.png" style="height:150px;">
    <h1><b>Jig Order <br> Monitoring System</b></h1>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST" id="login_form">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          <!-- /.col -->
          <div class="input-group mb-3">
            <button type="submit" class="btn btn-primary btn-block" name="login_btn" value="login">Sign In</button>
            <a href="template/Joms work instructions.pdf"  class="btn btn-secondary btn-block" target="_blank">Work Instruction</a>
          </div>
          <!-- /.col -->
        </div>
      </form>
      </div>
    </div>
  </div>
</body>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

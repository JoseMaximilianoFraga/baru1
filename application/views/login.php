<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('template/admin/') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('template/admin/') ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('template/admin/') ?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('template/admin/') ?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('template/admin/') ?>/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      background-image: url('');
      background-size: cover;
    }

    .login-box {
      width: 360px;
      background: #ffffff;
      border: 1px solid #d2d6de;
      border-radius: 4px;
      box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
    }

    .login-logo {
      text-align: center;
      margin-bottom: 25px;
    }

    .login-logo img {
      max-height: 120px;
    }

    .login-box-body {
      padding: 20px;
    }

    .login-box-body .form-group {
      margin-bottom: 20px;
    }

    .login-box-body .form-control {
      border-radius: 0;
    }

    .login-box-body .btn {
      border-radius: 0;
      font-weight: bold;
    }

    .login-box-msg {
      margin: 0;
      padding: 0 20px 20px 20px;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="login-box">
    <div class="login-logo">
      <img src="<?= base_url('template/logo_midodaren.png') ?>" class="img-responsive">
    </div>
    
    <div class="login-box-body">
      <?php if ($this->session->flashdata('pesan')): ?>
        <div class="alert alert-danger">
          <?= $this->session->flashdata('pesan') ?>
        </div>
      <?php endif; ?>
      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" placeholder="Username" required="">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password" required="">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
  </div>
</body>
</html>

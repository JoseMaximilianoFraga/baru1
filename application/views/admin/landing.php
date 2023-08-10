<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Midodaren Back Office Application</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .landing-page {
      height: 100vh;
      background-image: url('template/midodaren_logo_yellow.png');
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.5s ease;
    }
    .landing-page:hover {
        background-image: url('template/midodaren_logo_black.png');
    }
    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 40px;
      background-color: #fff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    h1 {
      font-size: 36px;
      font-weight: bold;
      color: #000; /* Mengganti warna tulisan menjadi hitam */
    }
    p {
      font-size: 18px;
      color: #000; /* Mengganti warna tulisan menjadi hitam */
    }
    .btn-primary {
      background-color: #FF9800;
      border-color: #FF9800;
      margin-top: 20px;
    }
    .btn-primary:hover {
      background-color: #F57C00;
      border-color: #F57C00;
    }
  </style>
</head>
<body>
  <div class="landing-page">
    <div class="container text-center">
      <h1>Selamat Datang</h1>
      <p>Klik tombol dibawah ini untuk masuk ke login</p>
      <a href="<?= base_url('login'); ?>" class="btn btn-primary">Masuk</a>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

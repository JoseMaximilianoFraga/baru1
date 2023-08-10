<?php
 if($this->session->userdata('level') == "admin" ){

 ?>
<div class="container"><?= $this->session->flashdata('pesan'); ?></div>
<br /><br /><br />
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>20</h3>

              <p>Data Staff</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>2</h3>

              <p>Data Admin</p>
            </div>
            <div class="icon">
             <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>150</h3>

              <p>Proyek</p>
            </div>
            <div class="icon">
             <i class="fa fa-check"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>150</h3>

              <p>Proyek Berjalan</p>
            </div>
            <div class="icon">
             <i class="fa fa-hourglass-half"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        

 
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            

<?php }elseif($this->session->userdata('level') == "topmanajemen"){ ?>


<br /><br /><br />
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>20</h3>

              <p>Data Staff</p>
            </div>
            <div class="icon">
              <i class="fa fa-database"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>2</h3>

              <p>Data Admin</p>
            </div>
            <div class="icon">
             <i class="fa fa-cubes"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>150</h3>

              <p>Proyek</p>
            </div>
            <div class="icon">
             <i class="fa fa-cubes"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>150</h3>

              <p>Proyek Berjalan</p>
            </div>
            <div class="icon">
             <i class="fa fa-database"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        

 
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            
<?php }elseif($this->session->userdata('level') == "user"){ ?>

<div class="container"><?= $this->session->flashdata('pesan'); ?></div>

<div class="callout callout-success">
                <h4><i class="fa fa-cubes"></i>Selamat Datang </h4>

                <p>Anda Login Sebagai User Silahkan Pilih Menu Di Samping Untuk Menggunakan Sistem</p>
              </div>

<?php }elseif($this->session->userdata('level') == "pegawai"){ ?>

  <!DOCTYPE html>
<html>
<head>
    <style>
        /* Styles for the notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 300px;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            display: none;
        }

        /* Styles for the notification content */
        .notification-content {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="notification" id="notification">
    <div class="notification-content">
        <div class="container"><?= $this->session->flashdata('pesan'); ?></div>
        <div class="callout callout-info">
            <h4><i class="fa fa-cubes"></i>Selamat Datang</h4>
            <p>Anda Login Sebagai Staff Silahkan Pilih Menu Di Samping Untuk Menggunakan Sistem</p>
        </div>
        <div class="container"><?= $this->session->flashdata('pesan'); ?></div>
    </div>
</div>

<script>
    // Function to show the notification
    function showNotification() {
        var notification = document.getElementById('notification');
        notification.style.display = 'block';

        // Hide the notification after 5 seconds
        setTimeout(function() {
            hideNotification(notification);
        }, 5000);
    }

    // Function to hide the notification
    function hideNotification(notification) {
        notification.style.display = 'none';
    }

    // Show the notification when the page loads
    window.addEventListener('load', showNotification);
</script>

</body>
</html>

<br /><br /><br />
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>2</h3>

              <p>Riwayat Kerja</p>
            </div>
            <div class="icon">
              <i class="fa fa-database"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>75</h3>

              <p>Hasil Penilaian Kinerja</p>
            </div>
            <div class="icon">
             <i class="fa fa-cubes"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Rp. 1.500.000</h3>

              <p>Insentif</p>
            </div>
            <div class="icon">
             <i class="fa fa-database"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        

 
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>

<?php } ?>
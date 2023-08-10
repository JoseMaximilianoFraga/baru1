<!-- Tampilan view admin/tambah_pesanan.php -->
<!-- ... -->
 
<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<?= $this->session->flashdata('pesan') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Pesanan</h3>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
    <!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Pesanan</title>
    <br><br>
</head>
<body>
    <?php echo validation_errors(); ?>

    <?php echo form_open('admin/tambah'); ?>
    <div class="form-group">
    <label for="nama_pelanggan">Nama Pelanggan</label>
    <input type="text" class="form-control" name="nama_pelanggan" value="<?php echo set_value('nama_pelanggan'); ?>">
    </div>
    <div class="form-group">
    <label for="tanggal_pesanan">Tanggal Pesanan</label>
    <input type="date" class="form-control" name="tanggal_pesanan" value="<?php echo set_value('tanggal_pesanan'); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
    <a href="<?php echo base_url('admin/pesanan'); ?>" class="btn btn-warning">Kembali</a>
</body>
</html>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- ... -->
<!-- Tampilan view admin/tambah_pesanan.php -->
<!-- ... -->
 
<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<?= $this->session->flashdata('pesan') ?>

<div class="card">
    <!-- /.card-header -->
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- ... -->


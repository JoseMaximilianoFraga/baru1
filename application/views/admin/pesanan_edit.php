<!-- Tampilan view admin/tambah_pesanan.php -->
<!-- ... -->
 
<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<?= $this->session->flashdata('pesan') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Validasi Pesanan</h3>
    </div>
    <!-- /.card-header -->

<?php echo validation_errors(); ?>

    <?php echo form_open('admin/update_pesanan/'.$pesanan->id_pesanan); ?>
    <!--<div class="form-group">-->
    <!--<label for="nama_pelanggan">Nama Pelanggan</label>-->
    <input type="hidden" class="form-control" name="nama_pelanggan" value="<?php echo $pesanan->nama_pelanggan; ?>">
    <!--</div>-->
    <!--<div class="form-group">-->
    <!--<label for="tanggal_pesanan">Tanggal Pesanan</label>-->
    <input type="hidden" class="form-control" name="tanggal_pesanan" value="<?php echo $pesanan->tanggal_pesanan; ?>">
    <!--</div>-->
    <div class="form-group">
    <label>Status</label><br>
    <input type="radio" name="status" value="Belum Validasi" <?php if($pesanan->status == "Belum Validasi") echo "checked"; ?>> Belum Validasi<br>
    <input type="radio" name="status" value="Validasi" <?php if($pesanan->status == "Validasi") echo "checked"; ?>> Validasi<br>
    <br><br>
    <button type="submit" class="btn btn-primary">Validasi</button>
    <a href="<?php echo base_url('admin/pesanan_top_manajemen'); ?>" class="btn btn-warning">Kembali</a>

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
    <div class="card-header">
    </div>
    <!-- /.card-header -->
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- ... -->


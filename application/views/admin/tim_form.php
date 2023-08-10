<!-- Tampilan view admin/tambah_pesanan.php -->
<!-- ... -->
 
<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<?= $this->session->flashdata('pesan') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Tim</h3>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
    <form method="post" action="<?= base_url('admin/edit_pesanan/'.$pesanan['id_pesanan']) ?>">
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan"  name="nama_pelanggan" value="<?= $pesanan['nama_pelanggan'] ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pesanan">Tanggal Pesanan</label>
                <input type="date" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" value="<?= $pesanan['tanggal_pesanan'] ?>" required>
                <input type="hidden" name="status" value="<?= $pesanan['status'] ?>" required>            
            </div>
            <!-- <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div> -->
            <button type="submit" class="btn btn-primary">Tambah Pesanan</button>
        </form>
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
        <h3 class="card-title">Tambah Pesanan</h3>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
    <!-- <form method="post" action="<?= base_url('admin/edit_pesanan/'.$pesanan['id_pesanan']) ?>"> -->
    <form method="post" action="<?= base_url('admin/edit_pesanan/'.$pesanan['id_pesanan']) ?>">
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan"  name="nama_pelanggan" value="<?= $pesanan['nama_pelanggan'] ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pesanan">Tanggal Pesanan</label>
                <input type="date" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" value="<?= $pesanan['tanggal_pesanan'] ?>" required>
                <input type="hidden" name="status" value="<?= $pesanan['status'] ?>" required>            
            </div>
            <!-- <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div> -->
            <button type="submit" class="btn btn-primary">Tambah Pesanan</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- ... -->


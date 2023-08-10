<!-- Tampilan view admin/tambah_pesanan.php -->
<!-- ... -->
 
<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<?= $this->session->flashdata('pesan') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Kelola Tugas</h3>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <form action="<?= base_url('admin/tambah_penugasan_satu/' . $pesanan->id_pesanan) ?>" method="post">
        <br>
        <br>
            <div class="form-group">
                <label for="bukti_kegiatan">Bukti kegiatan</label>
                <input type="hidden" class="form-control" id="id_pesanan" name="id_pesanan" value="<?= $pesanan->id_pesanan ?>" required>
                <input type="hidden" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $pesanan->nama_pelanggan ?>" required>
                <input type="hidden" class="form-control" id="select_tim" name="select_tim" value="<?= $pesanan->tim ?>" required>
                <input type="hidden" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" value="<?= $pesanan->tanggal_pesanan ?>" required>
                <input type="hidden" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" value="<?= $pesanan->tanggal_pesanan ?>" required>
                <input type="hidden" class="form-control" id="catatan_tugas" name="catatan_tugas" value="<?= $pesanan->catatan_kerja ?>" required>
                <input type="file" class="form-control" id="bukti_kegiatan" name="bukti_kegiatan" value="<?= $pesanan->bukti_kegiatan ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo base_url('admin/tabel_penugasan'); ?>" class="btn btn-warning">Kembali</a>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- ... -->

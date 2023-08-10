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
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="hidden" class="form-control" id="id_pesanan" name="id_pesanan" value="<?= $pesanan->id_pesanan ?>" required>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $pesanan->nama_pelanggan ?>" required>
            </div>
            <div class="form-group">
                <label for="tim">Tim</label>
                <!-- <input type="text" class="form-control" id="tim" name="tim" required> -->
                <select name="select_tim" id="select_tim" class="form-control">
                    <?php
                        $tim = $this->db->query("SELECT * FROM tim")->result();
                        foreach ($tim as $t) {
                    ?>
                        <option value="<?= $t->id_tim?>"><?= $t->nama_tim?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_pesanan">Tanggal Pelaksanaan</label>
                <input type="date" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" value="<?= $pesanan->tanggal_pesanan ?>" required>
            </div>
            <div class="form-group">
                <label for="catatan_kerja">Catatan Tugas</label>
                <textarea name="catatan_tugas" id="catatan_tugas" cols="100" rows="10" class="form-control" required><?php echo isset($pesanan->catatan_kerja) ? $pesanan->catatan_kerja : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo base_url('admin/tabel_penugasan'); ?>" class="btn btn-warning">Kembali</a>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- ... -->

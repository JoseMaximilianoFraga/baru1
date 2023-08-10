<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<h2>Form Penilaian Kinerja</h2><hr />
<?= $this->session->flashdata('pesan') ?>

<!-- Form tambah penilaian kinerja -->
<form action="<?= base_url('admin/tambah_kinerja') ?>" method="post">
    <div class="form-group">
        <label for="nama_staff">Nama Staff</label>
        <select class="form-control" id="nama_staff" name="nama_staff" required>
        <option value=""></option>
            <?php foreach ($pegawai as $pegawai) : ?>
                <option value="<?= $pegawai['nama'] ?>"><?= $pegawai['nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tim">Tim</label>
        <input type="text" class="form-control" id="tim" name="tim" required>
    </div>
    <div class="form-group">
        <label for="tanggal_kerja">Tanggal Kerja</label>
        <input type="date" class="form-control" id="tanggal_kerja" name="tanggal_kerja" required>
    </div>
    <div class="form-group">
        <label for="nilai">Nilai</label>
        <input type="text" class="form-control" id="nilai" name="nilai" required>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Penilaian Kinerja</button>
</form>

<!-- ... -->

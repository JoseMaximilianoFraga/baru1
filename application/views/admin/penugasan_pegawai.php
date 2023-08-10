<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<h2>Penugasan</h2><hr/>
<?= $this->session->flashdata('pesan') ?>
<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Pelanggan</th>
                    <th>Tim</th>
                    <th>Tanggal</th>
                    <th>Catatan Tugas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                // Memanggil fungsi penugasanByTim() dari model
$tim = 'tim A'; // Ganti dengan nama tim yang sesuai
$this->load->model('M_admin'); // Ganti 'nama_model' dengan nama model yang Anda gunakan
$data = $this->m_admin->penugasanByTim($tim);

// Setelah pemanggilan fungsi selesai, variabel $data sudah berisi data dari hasil query
// Anda bisa menggunakan variabel $data dalam perulangan foreach atau sesuai kebutuhan lainnya

$No = 1;
foreach ($data as $penugasan) {
    $tim = $penugasan->tim;

    // Letakkan kondisi di awal loop
    if ($tim != null) {
        $status = 'Telah Ditugaskan';
        ?>

        <tr>
            <td><?= $No++; ?></td>
            <td><?= $penugasan->nama_pelanggan ?></td>
            <td><?= $tim ?></td>
            <td><?= $penugasan->tanggal_pesanan ?></td>
            <td><?= $penugasan->catatan_kerja ?></td>
            <td><?= $status ?></td>
            <td class="text-center" width="150px">
                <a href="<?= site_url('admin/tambah_penugasan_detail/' . $penugasan->id_pesanan) ?>" class="btn btn-warning">
                    detail
                </a>
                <a href="<?= site_url('admin/tambah_penugasan_selesai/' . $penugasan->id_pesanan) ?>" class="btn btn-primary">
                    selesaikan
                </a>
            </td>
        </tr>

        <?php
    } // akhir if
} // akhir foreach
?>

                </tbody>
                     </table>
                <!-- <table></table> -->
        <!-- <form action="<?= base_url('admin/tambah_penugasan_satu') ?>" method="post">
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $data['nama_pelanggan'] ?>" required>
            </div>
            <div class="form-group">
                <label for="tim">Tim</label>
                <input type="date" class="form-control" id="tim" name="tim" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pesanan">Tanggal Pelaksanaan</label>
                <input type="date" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" <?= $pesanan['tanggal_pesanan'] ?>" required>
            </div>
            <div class="form-group">
                <label for="catatan_tugas">Catatan Tugas</label>
                <div></div>
                <textarea name="catatan_tugas" id="catatan_tugas" cols="100" rows="10"></textarea>

            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div> 
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo base_url('admin/pesanan'); ?>" class="btn btn-warning">Kembali</a>
        </form> -->
    <!-- </div> -->
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- ... -->

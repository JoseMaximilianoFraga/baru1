<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<h2>Penugasan</h2><hr/>
<?= $this->session->flashdata('pesan') ?>
  <a href="<?= base_url('admin/tambah/') ?>" class="btn btn-primary">Tambah</a>
<br><br><br>
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
                      $No=1;
                      foreach ($data as $penugasan) {
                        $tim = $this->db->query("SELECT * FROM penugasan WHERE id_pesanan = '$penugasan->id_pesanan'")->row();
                        if($tim){
                          $get_tim = $this->db->query("SELECT * FROM tim WHERE id_tim = '$tim->id_tim'")->row();
                          if ($tim->id_tim == null) {
                            $tim->id_tim = '-';
                            $status = 'Belum Ditugaskan';
                          } else {
                            $status = 'Telah Ditugaskan';
                          }
                        }else{
                          $get_tim = '';
                          $status = 'Belum Ditugaskan';
                        }
                        // $tim = $penugasan->tim;

                    ?>
                    <tr>
                        <td><?= $No++ ?></td>
                        <td><?= $penugasan->nama_pelanggan ?></td> 
                        <td><?php if($get_tim) echo $get_tim->nama_tim ?></td>
                        <td><?= $penugasan->tanggal_pesanan ?></td>
                        <td><?php if($tim) echo  $tim->catatan_kerja ?></td>
                        <td><?= $status ?></td>
                        <td class="text-center" width="150px">
                          <?php if($status == "Belum Ditugaskan"){?>
                            <a href="<?= site_url('admin/tambah_penugasan/' . $penugasan->id_pesanan) ?>" class="btn btn-info">
                          <?php }else{?>
                          <?php }?>
                          <b>Penugasan</b>
                        </a>
                      </td>
                    </tr>
                   <?php  } ?>
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

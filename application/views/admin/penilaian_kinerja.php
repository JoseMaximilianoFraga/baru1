<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<h2>Penilaian Kinerja</h2><hr />
<?= $this->session->flashdata('pesan') ?>
<a href="<?= base_url('admin/tambah_kinerja/') ?>" class="btn btn-primary">Tambah</a>
<br><br><br>
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Penilaian Kinerja</th>
                  <th>Nama Staff</th>
                  <th>Tim</th>
                  <th>Tanggal Kerja</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                  
                </tr>
                </thead>
                 <tbody>
                 <?php $no=1; foreach($data->result_array() as $admin): ?>
                 <tr>
                 <td><?= $no ?></td>
                 <td><?= $admin['id_penilaian_kinerja'] ?></td> 
                 <td><?= $admin['nama_staff'] ?></td> 
                 <td><?= $admin['tim'] ?></td> 
                 <td><?= $admin['tanggal_kerja'] ?></td> 
                 <td><?= $admin['nilai'] ?></td> 
                 <td>
                 <a href="<?= base_url('admin/hapus_kinerja/' . $admin['id_penilaian_kinerja']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</a> 

                 </td>
                 </tr>
                 <?php $no++; endforeach; ?>
                 </tbody>
               </table>
 
 
<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<h2>Pesanan</h2><hr/>
<?= $this->session->flashdata('pesan') ?>
<a href="<?= base_url('admin/tambah/') ?>" class="btn btn-primary">Tambah</a>
<br><br><br>
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Pesanan</th>
                  <th>Nama Pelanggan</th>
                  <th>Tanggal Pesanan</th>
                  <th>Status</th>
                  
                </tr>
                </thead>
                 <tbody>
                 <?php $no=1; foreach($data as $admin):
                 $status = $admin->status;
                  if ($admin->status ==null){
                    $status='Belum Validasi';} ?>
                 <tr>
                 <td><?= $no++; ?></td>
                 <td><?= $admin->id_pesanan ?></td> 
                 <td><?= $admin->nama_pelanggan ?></td> 
                 <td><?= $admin->tanggal_pesanan ?></td> 
                 <td><?= $status ?></td>
                 </tr>
                 <?php endforeach; ?>
                 </tbody>
               </table>
  </div>
 
 
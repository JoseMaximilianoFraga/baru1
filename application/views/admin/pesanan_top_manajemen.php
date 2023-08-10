<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<h2>Pesanan</h2><hr/>
<?= $this->session->flashdata('pesan') ?>
<!--<a href="<?= base_url('admin/tambah/') ?>" class="btn btn-primary">Tambah</a>-->
<table id="example1" class="table table-bordered table-striped">
<thead>
  <tr>
    <th>No</th>
    <th>Id Pesanan</th>
    <th>Nama Pelanggan</th>
    <th>Tanggal Pesanan</th>
    <th>Status</th>
    <th>Aksi</th>
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
      <td>
        <?php if ($status !== 'Validasi') : ?>
          <!-- <a href="<?= base_url('admin/detail_pesanan/' . $admin->id_pesanan) ?>" class="btn btn-info">Validasi</a> -->
          <a href="<?= base_url('admin/validasi_pesanan/' . $admin->id_pesanan) ?>"onclick="return(confirm('Anda Yakin Akan Validasi?'))"class="btn btn-info">Validasi</a>
        <?php else : ?>
          
          <a href="#"class="btn btn-success" disabled>Sudah Validasi</a>
        <?php endif; ?>
      </td>       
                 
                 </tr>
                 <?php endforeach; ?>
                 </tbody>
               </table>
 
 
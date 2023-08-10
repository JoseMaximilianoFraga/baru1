<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<h2>Tim</h2><hr/>
<a href="<?= base_url('admin/tim_tambah') ?>" class="btn btn-primary">Tambah</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>
 <table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>No</th>
      <th>Id Tim</th>
      <th>Nama Tim</th>
      <th>Aksi</th>
    </tr>
    </thead>
     <tbody>
     <?php $no=1; foreach($data->result_array() as $admin): ?>
     <tr>
     <td><?= $no++; ?></td>
     <td><?= $admin['id_tim'] ?></td> 
     <td><?= $admin['nama_tim'] ?></td> 
     <td>
      <a href="<?= site_url('admin/detail_tim/' . $admin['id_tim']); ?>" class="btn btn-info">Detail</a>
      <a href="<?= site_url('admin/edit_tim/' . $admin['id_tim']); ?>" class="btn btn-warning">Edit</a>
      <a href="<?= site_url('admin/hapus_tim/' . $admin['id_tim']); ?>" onclick="return(confirm('Anda Yakin Akan Hapus?'))" class="btn btn-danger">Hapus</a>
    </td>
     </tr>
     <?php $no++; endforeach; ?>
     </tbody>
   </table>

 
 
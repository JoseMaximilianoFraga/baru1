<link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
<h2>Staf</h2><hr/>
<a href="<?= base_url('admin/pegawai_tambah/') ?>" class="btn btn-primary">Tambah</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>
 <table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Agama</th>
      <th>Foto</th>
      <th>Jabatan</th>
      <th>Pendidikan</th>
      <th>Alamat Lengkap</th>
      <th>Aksi</th>
    </tr>
    </thead>
     <tbody>
     <?php $no=1; foreach($data->result_array() as $admin): ?>
     <tr>
     <td><?= $no ?></td>
     <td><?= $admin['nama'] ?></td> 
     <td><?php if($admin['jk'] == "L"){ echo "Laki-Laki";}else{ echo "Perempuan";} ?></td>
     <td><?= $admin['agama'] ?></td>
     <td><img src="<?= base_url('template/data/'.$admin['foto']) ?>" class="img-responsive" style="width: 100px;height: 100xp"></td>
     <td><?= $admin['nama_jabatan'] ?></td>
     <td><?= $admin['pendidikan'] ?></td>
     <td><?= $admin['alamat'] ?></td>
     <td><a href="<?= base_url('admin/pegawai_edit/'.$admin['id_pegawai']) ?>" class="btn btn-info">Edit</a> <a href="<?= base_url('admin/pegawai_hapus/'.$admin['id_pegawai']) ?>"onclick="return(confirm('Anda Yakin Akan Hapus?'))"class="btn btn-danger">Hapus</a></td> 
    </tr>
     <?php $no++; endforeach; ?>
     </tbody>
   </table>

 
 
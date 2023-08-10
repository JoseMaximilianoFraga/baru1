<table class="table table-striped">
<form action="" method="POST" enctype="multipart/form-data"> 
 
<tr><th>Nama</th><td><input type="text" name="nama" value="<?= $nama ?>" class="form-control" required=""></td></tr>
<tr><th>Jenis Kelamin</th><td><select class="form-control" name="jk" required="">
	                          <option value="L">Laki-Laki</option>
	                          <option value="P">Perempuan</option>
                              </select></td></tr>

<tr>
	<th>Jabatan</th>
	<td>
		<select name="id_jabatan" class="form-control" required="">
	     	<?php if($aksi !== "edit"){?> <option value="">--Pilih Data Jabatan--</option> <?php } ?>
	      	<?php foreach($jabatan as $jab): 
	      		$selected = ($jab['id_jabatan'] == $id_jabatan) ? "selected" : "";
  			?>

     			<option value="<?= $jab['id_jabatan'] ?>" <?= $selected;?> ><?= ucfirst($jab['nama_jabatan']) ?></option>
	      	<?php endforeach; ?>	
      	</select>
    </td>
</tr>

<tr><th>Foto</th><td>
	<?php 
      if($aksi == "edit"){
        echo '<img src="'.base_url('template/data/'.$foto).'" class="img-responsive" style="width:200px;height:200px">';
      }else{

      }
	?>
<input type="file" name="gambar" value="" class="form-control">
</td></tr>
<tr><th>Agama</th><td><select class="form-control" name="agama" required="">
	                   <option value="Islam">Islam</option>
	                   <option value="Kristen">Kristen</option>
	                   <option value="Khatolik">Khatolik</option>
	                   <option value="Budha">Budha</option>
	                   <option value="Hindu">Hindu</option>
	                   <option value="Konghucu">Konghucu</option>    
	                   <option value="Lainnya">Lainnya</option>    
	                   </select></td></tr>
<tr><th>Pendidikan</th><td><input type="text" name="pendidikan" value="<?= $pendidikan ?>" class="form-control" required=""></td></tr>
<tr><th>Alamat </th><td><input type="text" name="alamat" value="<?= $alamat ?>" class="form-control" required=""></td></tr>
<tr><td></td><td><input type="submit" name="kirim" value="Submit" class="btn btn-primary"> &nbsp;&nbsp; <a href="<?= base_url('admin/pegawai')?>" class="btn btn-danger">Batal</a></td></tr>
</form>
</table>
<?php 
if($aksi == "edit"):
?>	
<span><i>Kosongkan gambar jika tidak ingin diganti.</i></span>
<?php endif; ?>
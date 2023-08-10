<table class="table table-striped">
<form action="<?= base_url('admin/proses_edit_tim');?>" method="POST" enctype="multipart/form-data"> 
 
<?php $nama_tim = $this->db->query("SELECT * FROM tim WHERE id_tim = '$edit->id_tim'")->row();?>
<?php $anggota1 = $this->db->query("SELECT * FROM pegawai WHERE id_pegawai = '$edit->id_ketua'")->row();?>
<?php $anggota2 = $this->db->query("SELECT * FROM pegawai WHERE id_pegawai = '$edit->id_anggota_1'")->row();?>
<?php $anggota3 = $this->db->query("SELECT * FROM pegawai WHERE id_pegawai = '$edit->id_anggota_2'")->row();?>
<?php $anggota4 = $this->db->query("SELECT * FROM pegawai WHERE id_pegawai = '$edit->id_anggota_3'")->row();?>
<?php $anggota5 = $this->db->query("SELECT * FROM pegawai WHERE id_pegawai = '$edit->id_anggota_4'")->row();?>
<tr><th>Nama Tim</th><td><input type="text" name="nama_tim" value="<?= $nama_tim->nama_tim?>" class="form-control" required="" disabled></td></tr>
<tr><th>Nama Co</th><td><input type="text" name="nama_co" value="<?= $anggota1->nama?>" class="form-control" required="" disabled></td></tr>
<tr><th>Nama Anggota 1</th><td><input type="text" name="anggota_1" value="<?= $anggota2->nama?>" class="form-control" required="" disabled></td></tr>
<tr><th>Nama Anggota 2</th><td><input type="text" name="anggota_2" value="<?= $anggota3->nama?>" class="form-control" required="" disabled></td></tr>
<tr><th>Nama Anggota 3</th><td><input type="text" name="anggota_3" value="<?= $anggota4->nama?>" class="form-control" required="" disabled></td></tr>
<tr><th>Nama Anggota 4</th><td><input type="text" name="anggota_4" value="<?= $anggota5->nama?>" class="form-control" required="" disabled></td></tr>
<tr><td></td><td><a href="<?= base_url('admin/tim')?>" class="btn btn-danger">Kembali</a></td></tr>

</form>
</table>	
<table class="table table-striped">
<form action="<?= base_url('admin/proses_edit_tim');?>" method="POST" enctype="multipart/form-data"> 
 
<?php $nama_tim = $this->db->query("SELECT * FROM tim WHERE id_tim = '$edit->id_tim'")->row();?>
<tr><th>Nama Tim</th><td><input type="text" name="nama_tim" value="<?= $nama_tim->nama_tim?>" class="form-control" required=""></td></tr>
<input type="hidden" name = "id" value="<?= $edit->id_tim?>">
<tr><th>Nama Co</th><td><select class="form-control" name="nama_co" required="">
                            <?php
                                $tim = $this->db->query("SELECT * FROM pegawai")->result();
                                foreach ($tim as $t) {
                            ?>
                                <option <?php if($edit->id_ketua == $t->id_pegawai) echo "selected"?> value="<?= $t->id_pegawai?>"><?= $t->nama?></option>
                            <?php } ?>
                              </select></td></tr>
<tr><th>Nama anggota 1</th><td><select class="form-control" name="anggota_1" required="">
                            <?php
                                $tim1 = $this->db->query("SELECT * FROM pegawai")->result();
                                foreach ($tim1 as $t) {
                            ?>
                                <option <?php if($edit->id_anggota_1 == $t->id_pegawai) echo "selected"?> value="<?= $t->id_pegawai?>"><?= $t->nama?></option>
                            <?php } ?>
                              </select></td></tr>
<tr><th>Nama anggota 2</th><td><select class="form-control" name="anggota_2" required="">
                            <?php
                                $tim2 = $this->db->query("SELECT * FROM pegawai")->result();
                                foreach ($tim2 as $t) {
                            ?>
                                <option <?php if($edit->id_anggota_2 == $t->id_pegawai) echo "selected"?> value="<?= $t->id_pegawai?>"><?= $t->nama?></option>
                            <?php } ?>
                              </select></td></tr>
<tr><th>Nama anggota 3</th><td><select class="form-control" name="anggota_3" required="">
                            <?php
                                $tim3 = $this->db->query("SELECT * FROM pegawai")->result();
                                foreach ($tim3 as $t) {
                            ?>
                                <option <?php if($edit->id_anggota_3 == $t->id_pegawai) echo "selected"?> value="<?= $t->id_pegawai?>"><?= $t->nama?></option>
                            <?php } ?>
                              </select></td></tr>
<tr><th>Nama anggota 4</th><td><select class="form-control" name="anggota_4" required="">
                            <?php
                                $tim4 = $this->db->query("SELECT * FROM pegawai")->result();
                                foreach ($tim4 as $t) {
                            ?>
                                <option <?php if($edit->id_anggota_4 == $t->id_pegawai) echo "selected"?> value="<?= $t->id_pegawai?>"><?= $t->nama?></option>
                            <?php } ?>
                              </select></td></tr>
                              <tr><td></td><td><input type="submit" name="kirim" value="Submit" class="btn btn-primary"> &nbsp;&nbsp; <a href="<?= base_url('admin/tim')?>" class="btn btn-danger">Batal</a></td></tr>

</form>
</table>	
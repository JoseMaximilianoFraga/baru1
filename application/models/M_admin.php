<?php 

/**
* 
*/
class M_admin extends CI_model
{
	
public function pegawai($value='')
{
 return $this->db->query("SELECT * from pegawai a, jabatan b where a.id_jabatan=b.id_jabatan group by a.id_pegawai");
}

public function pesanan($value='')
{
  $bulan = date('m');
 return $this->db->query("SELECT * from pesanan WHERE tanggal_pesanan LIKE '%$bulan%'")->result();
}

public function get_pesanan_by_id($id_pesanan) {
  // Mengambil data pesanan berdasarkan id_pesanan dari tabel pesanan
  $query = $this->db->get_where('pesanan', array('id_pesanan' => $id_pesanan));

  // Mengembalikan hasil query sebagai objek
  return $query->row();
}

public function update_pesanan($id_pesanan, $data) {
  // Update data pesanan berdasarkan id_pesanan
  $this->db->where('id_pesanan', $id_pesanan);
  $this->db->update('pesanan', $data);

  // Mengembalikan status update data pesanan
  return ($this->db->affected_rows() > 0);
}

public function tim($value='')
{
 return $this->db->query("SELECT * from tim");
}

public function getTimData()
    {
        // Mengambil data tim
        $this->db->select('id_tim, nama_tim');
        $this->db->from('tim');
        $query = $this->db->get();

        // Mengembalikan hasil query
        return $query;
    }

    public function getTimById($id_tim)
    {
        // Mengambil data tim berdasarkan ID
        $this->db->select('id_tim, nama_tim');
        $this->db->from('tim');
        $this->db->where('id_tim', $id_tim);
        $query = $this->db->get();

        // Mengembalikan hasil query sebagai objek tunggal
        return $query->row();
    }

    public function updateTimData($id_tim, $nama_tim)
    {
        // Melakukan update data tim
        $this->db->set('nama_tim', $nama_tim);
        $this->db->where('id_tim', $id_tim);
        $this->db->update('tim');
    }

    public function get_pesanan($id_pesanan)
    {
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->get('pesanan')->row_array();
    }

    public function tambah_pesanan($data) {
      // Lakukan proses penambahan data pesanan ke database
      $this->db->insert('pesanan', $data);

      // Mengembalikan status penambahan data pesanan
      return ($this->db->affected_rows() > 0);
  }

  public function penugasan() {
    $this->db->select('pesanan.id_pesanan, pesanan.nama_pelanggan, pesanan.tanggal_pesanan, pesanan.status, penugasan.catatan_kerja, tim.nama_tim as tim');
    $this->db->from('pesanan');
    $this->db->join('penugasan', 'pesanan.id_pesanan = penugasan.id_pesanan', 'left');
    $this->db->join('tim', 'tim.id_tim = penugasan.id_tim');
    $this->db->where('pesanan.status', 'Validasi');
    // $this->db->where('penugasan.tim', $id_tim); //filter
    return $this->db->get()->result();
  }

  public function penugasanByTim($tim) {
    $this->db->select('pesanan.id_pesanan, pesanan.nama_pelanggan, pesanan.tanggal_pesanan, pesanan.status, penugasan.catatan_kerja, tim.nama_tim as tim');
    $this->db->from('pesanan');
    $this->db->join('penugasan', 'pesanan.id_pesanan = penugasan.id_pesanan', 'left');
    $this->db->join('tim', 'tim.id_tim = penugasan.id_tim');
    $this->db->where('pesanan.status', 'Validasi');
    $this->db->where('penugasan.id_tim', $tim);
    // $this->db->where('penugasan.tim', $id_tim); //filter
    return $this->db->get()->result();
  }

  public function getPesananById($id) {
    $this->db->select('*');
    $this->db->from('penugasan');
    $this->db->where('id_pesanan', $id);
    return $this->db->get()->row();
  }

  public function tambahPenugasan($data) {
    return $this->db->insert('penugasan', $data);
  }

public function penilaian_kinerja($value='')
{
 return $this->db->query("SELECT * from penilaian_kerja");
}

public function insertData($data) {
        $this->db->insert('penilaian_kinerja', $data);
        return $this->db->insert_id();
}

public function hapus_kinerja($id)
    {
        $this->db->where('id_penilaian_kinerja', $id);
        $this->db->delete('penilaian_kinerja');

        return $this->db->affected_rows() > 0;
    }

public function getAllPegawai() {
  return $this->db->get('pegawai')->result_array();
}

public function count_data($table){
  return $this->db->query("SELECT COUNT(*) AS jml_data FROM $table");
}

public function cek_absen($id_pegawai='',$tanggal='')
{
 return $this->db->query("SELECT * from absen where id_pegawai='$id_pegawai' AND tanggal='$tanggal'");
}

public function gaji_pegawai()
{
 return $this->db->query("SELECT * from pegawai a, jabatan b ,gaji d where a.id_jabatan=b.id_jabatan AND d.id_pegawai=a.id_pegawai group by d.id_pegawai");
}

public function cari_pegawai($cari)
{
 return $this->db->query("SELECT * from pegawai a ,jabatan b where a.id_jabatan=b.id_jabatan AND a.id_pegawai='$cari'");
}

public function pegawai_data()
{
 return $this->db->query("SELECT * from pegawai a ,jabatan b  where a.id_jabatan=b.id_jabatan group by a.id_pegawai");
}



public function tpp_id($id='')
{
  return $this->db->query("SELECT * from pegawai a,jabatan b ,tpp c , absen d where c.id_pegawai='$id' AND a.id_jabatan=b.id_jabatan 
    AND d.id_pegawai=a.id_pegawai
    AND c.id_pegawai=a.id_pegawai
    group by c.id_tpp");
}

public function tpp()
{
  return $this->db->query("SELECT * from pegawai a,jabatan b ,tpp c , absen d where a.id_jabatan=b.id_jabatan 
    AND d.id_pegawai=a.id_pegawai
  	AND c.id_pegawai=a.id_pegawai
  	group by c.id_tpp");
}


public function tpp_print($id)
{
  return $this->db->query("SELECT * from pegawai a,jabatan b ,tpp c , absen d where a.id_jabatan=b.id_jabatan 
    AND d.id_pegawai=a.id_pegawai
  	AND c.id_pegawai=a.id_pegawai
  	AND c.id_tpp='$id'
  	group by c.id_pegawai");
}


public function cari_gaji($id='')
{
return $this->db->query("SELECT * from pegawai a, jabatan b  where a.id_jabatan=b.id_jabatan AND a.id_pegawai='$id' group by a.id_pegawai");
}

public function cari_jabatan($id='')
{
 return $this->db->query("SELECT * from pegawai a, jabatan b where a.id_pegawai='$id' AND a.id_jabatan=b.id_jabatan group by a.id_pegawai");
}

public function hapus_pesanan($id)
    {
        $this->db->where('id_pesanan', $id);
        $this->db->delete('pesanan');

        return $this->db->affected_rows() > 0;
    }


    public function getById($id) {
      $this->db->where('id_pesanan', $id);
      return $this->db->get('pesanan')->row();
    }

    public function getTim() {
      $this->db->select('nama_tim');
      $query = $this->db->get('tim');

      if ($query->num_rows() > 0) {
          return $query->result_array();
      } else {
          return array();
      }
  }

}
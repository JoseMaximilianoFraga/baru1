<?php
class m_penilaian_kinerja extends CI_Model {

    public function get_all_penilaian($value='') {
        return $this->db->query("SELECT * from penilaian_kinerja");
    }

    public function get_penilaian_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('penilaian_kinerja');
        return $query->row();
    }

    public function insert_penilaian($data) {
        $this->db->insert('penilaian_kinerja', $data);
        return $this->db->insert_id();
    }

    // Contoh fungsi untuk menghitung rata-rata nilai kinerja
    public function hitung_rata_rata() {
        $this->db->select_avg('nilai_kinerja');
        $query = $this->db->get('penilaian_kinerja');
        return $query->row()->nilai_kinerja;
    }

    // Contoh fungsi untuk menghitung nilai kinerja maksimum dan minimum
    public function hitung_max_min() {
        $this->db->select_max('nilai_kinerja');
        $query = $this->db->get('penilaian_kinerja');
        $max = $query->row()->nilai_kinerja;

        $this->db->select_min('nilai_kinerja');
        $query = $this->db->get('penilaian_kinerja');
        $min = $query->row()->nilai_kinerja;

        return array('max' => $max, 'min' => $min);
    }
}


/**
* 
*/

    
//  public function absensi($dari='',$sampai='')
//  	{
//  	return $this->db->query("SELECT * from absen a, pegawai b where a.id_pegawai=b.id_pegawai AND a.tanggal between '$dari' AND '$sampai' group by a.id_pegawai");
//  	}	
//  public function tpp($dari='',$sampai='')
//     {
//    return $this->db->query("SELECT * from pegawai a,jabatan b ,tpp c where a.id_jabatan=a.id_jabatan AND c.tgl between '$dari' AND '$sampai' 
//   	group by c.id_pegawai");
//     }   


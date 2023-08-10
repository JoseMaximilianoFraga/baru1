<?php
class Pegawai_model extends CI_Model {
    public function getAllPegawai() {
        return $this->db->get('pegawai')->result_array();
    }
}
?>

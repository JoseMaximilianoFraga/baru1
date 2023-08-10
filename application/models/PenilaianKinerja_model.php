<?php
class PenilaianKinerja_model extends CI_Model {
    public function insertData($data) {
        $this->db->insert('penilaian_kinerja', $data);
        return $this->db->insert_id();
    }
}
?>

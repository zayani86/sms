<?php

class Murid_model extends CI_Model
{

    public function get_dt_murid_list($kelas_id, $sekolah_id)
    {
        $this->db->select("a.nama, a.no_kp_baru, a.id");
        $this->db->from('tbl_murid a');

        $this->db->where('a.tbl_kelas_id', $kelas_id);
        $this->db->where('a.tbl_sekolah_id', $sekolah_id);
        $this->db->where('a.soft_delete', 0);
        
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_senarai_murid_by_activity($aktivity_id)
    {
        $this->db->select("a.nama, a.no_kp_baru, a.id");
        $this->db->from('aktiviti_murid a');
        $this->db->where('a.aktiviti_id', $aktivity_id);
        
        $query = $this->db->get();

        return $query->result_object();
    }
}

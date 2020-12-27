<?php

class Pentadbiran_model extends CI_Model
{

    public function get_dt_activity_list()
    {
        $this->db->select("a.*, kategori.keterangan as kat_desc ");
        $this->db->from('aktiviti_pentadbiran a');
        $this->db->join('konf_kod kategori', 'kategori.id = a.kategori_id');

        $this->db->where('a.is_active', 1);
        $this->db->where('a.soft_delete', 0);
        $this->db->order_by('a.tarikh_mula', 'desc');
        $query = $this->db->get();

        return $query->result_object();
    }

    public function get_activity($activity_id)
    {

        $this->db->select('a.*, kategori.keterangan');
        $this->db->from('aktiviti_pentadbiran a ');
        $this->db->join('konf_kod kategori', 'kategori.id = a.kategori_id', 'left');
        $this->db->where('a.id', $activity_id);

        $query = $this->db->get();
        return $query->row_object();
    }
}

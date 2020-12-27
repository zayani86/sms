<?php

class Program_model extends CI_Model
{

    public function get_dt_activity_list()
    {
        $this->db->select("pl.*, kategori.keterangan as kat_desc ");
        $this->db->from('program_luar pl');
        $this->db->join('konf_kod kategori', 'kategori.id = pl.kategori_id');

        $this->db->where('pl.is_active', 1);
        $this->db->where('pl.soft_delete', 0);
        $this->db->order_by('pl.tarikh_mula', 'desc');
        $query = $this->db->get();

        return $query->result_object();
    }

    public function get_activity($activity_id)
    {

        $this->db->select('a.*, kategori.keterangan');
        $this->db->from('program_luar a ');
        $this->db->join('konf_kod kategori', 'kategori.id = a.kategori_id', 'left');
        $this->db->where('a.id', $activity_id);

        $query = $this->db->get();
        return $query->row_object();
    }
}

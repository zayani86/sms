<?php

class Mastercode_model extends CI_Model
{

    #region Start - Kod Lain
    function get_all_data_konf_kod($kategori)
    {
        $this->db->select('*');
        $this->db->from('konf_kod');
        $this->db->where('konf_kod.kategori', $kategori);

        $this->db->where('konf_kod.is_active', 1);
        $this->db->where('konf_kod.soft_delete', 0);

        $query = $this->db->get();
        return $query->result_object();
    }
    #endregion End - Kod Lain

}

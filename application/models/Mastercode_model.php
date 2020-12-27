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

    #region Start - konf group
    function get_all_data_konf_group($selected_value = null)
    {
        $this->db->select('*');
        $this->db->from('konf_group');

        if(!empty($selected_value))
        {
            $this->db->where('konf_group.id', $selected_value);
            $query = $this->db->get();
            return $query->row_object();
        } 
        else 
        {
            $this->db->where('konf_group.is_active', 1);
            $this->db->where('konf_group.soft_delete', 0);

            $query = $this->db->get();
            return $query->result_object();
        }
    }
    #endregion End - konf group

    #start get list of data
    function get_data_by_parent_id($parent_id = null)
    {
        $this->db->select("kk.id, kk.kod, kk.keterangan, kk.kategori");
        $this->db->from('konf_kod kk');
        $this->db->where('kk.is_active', true);
        $this->db->where('kk.soft_delete', false);
        $this->db->where('kk.parent_id', $parent_id);
        $query = $this->db->get();
        
        return $query->result_object();
    }

    function get_tingkatan_tahun($konf_sekolah = null)
    {
        $this->db->select('nama_tingkatan');
        $this->db->from('tbl_kelas');
        
        if(!empty($konf_sekolah))
        {
            $this->db->where('tbl_sekolah_id', $konf_sekolah);
        }

        $this->db->group_by('nama_tingkatan');
        $this->db->order_by('susunan');
        $query = $this->db->get();
        return $query->result_object();
    }

    function get_kelas($nama_tingkatan = null)
    {
        $this->db->select('id, kelas');
        $this->db->from('tbl_kelas');
        
        if(!empty($nama_tingkatan))
        {
            $this->db->where('nama_tingkatan', $nama_tingkatan);
        }

        $this->db->where('tbl_sekolah_id', $this->session->konf_sekolah);

        $this->db->order_by('susunan');
        $query = $this->db->get();
        return $query->result_object();
    }

}

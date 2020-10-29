<?php

class Sistem_model extends CI_Model
{

    public function is_user_first_time($id)
    {
        $this->db->select('users.first_time_login');
        $this->db->from('users');
        $this->db->where('users.id', $id);

        $query = $this->db->get();
        return $query->row_object()->first_time_login;
    }

    public function get_dt_user_list()
    {
        $this->db->select("*");
        $this->db->from('users');
        $query = $this->db->get();

        return $query->result_object();
    }
}

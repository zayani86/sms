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

    public function if_exist($parameter, $table, $where = []) //count existing row
    {
        $this->db->select('count(' . $parameter . ') as num');
        $this->db->from($table);
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get();
        
        return $query->row_object();
    }
}

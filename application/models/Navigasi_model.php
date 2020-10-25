<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigasi_model extends CI_Model {
	/**
	 * generate database connection.
	 */
	public function __construct() {
		parent::__construct();
		$this->load->database();
    }
    
    public function get_akses_modul() {
        $this->db->distinct();
		$this->db->select('konf_module.id, konf_module.name, konf_module.module_icon, konf_module.module_sort');
        $this->db->from('users');
		$this->db->join('map_user_konf_role', 'map_user_konf_role.user_id = users.id');
		$this->db->join('konf_menu_access', 'konf_menu_access.konf_role_id = map_user_konf_role.konf_role_id');
		$this->db->join('konf_menu', 'konf_menu.id = konf_menu_access.konf_menu_id');
        $this->db->join('konf_module', 'konf_module.id = konf_menu.konf_module_id');
		$this->db->where('users.id', get_session('user_id'));
		$this->db->where('JSON_EXTRACT(konf_menu_access.access_right, "$.l") =1');
		$this->db->where('konf_menu_access.is_active', 1);
		$this->db->where('konf_module.is_active', 1);
		$this->db->order_by("konf_module.module_sort");
		$query = $this->db->get();
		
		return $query->result_object();
	}

	public function get_akses_menu_isParents() {
        $this->db->distinct();
		$this->db->select('konf_menu.id, konf_menu.konf_module_id, konf_menu.name, 
							konf_menu.url,konf_menu.is_active, konf_menu.menu_sort, 
							konf_menu_access.access_right');
        $this->db->from('users');
		$this->db->join('map_user_konf_role', 'map_user_konf_role.user_id = users.id');

		$this->db->join('konf_menu_access', 'konf_menu_access.konf_role_id = map_user_konf_role.konf_role_id');
        $this->db->join('konf_menu', 'konf_menu.id = konf_menu_access.konf_menu_id');
		$this->db->where('users.id', get_session('user_id'));
		$this->db->where('JSON_EXTRACT(konf_menu_access.access_right, "$.l") =1');
        $this->db->where('konf_menu_access.is_active', 1);
		$this->db->where('konf_menu.is_active', 1);

		$this->db->group_start();
        $this->db->where('konf_menu.konf_menu_parent_id IS NULL');
        $this->db->or_where('konf_menu.konf_menu_parent_id ',0);
	 	$this->db->group_end();
		$this->db->order_by("konf_menu.menu_sort");
		$query = $this->db->get();
		
		return $query->result_object();
	
    }    
    
	public function get_akses_menu_byParents($parent_id) {
        $this->db->distinct();
		$this->db->select('konf_menu.id, konf_menu.konf_module_id, konf_menu.name, 
							konf_menu.url,konf_menu.is_active, konf_menu.menu_sort, 
							konf_menu_access.access_right,konf_menu.menu_icon');
		$this->db->from('users');
		
		$this->db->join('map_user_konf_role', 'map_user_konf_role.user_id = users.id');
		
        $this->db->join('konf_menu_access', 'konf_menu_access.konf_role_id = map_user_konf_role.konf_role_id');
        $this->db->join('konf_menu', 'konf_menu.id = konf_menu_access.konf_menu_id');
		$this->db->where('konf_menu.konf_menu_parent_id', $parent_id);
		$this->db->where('users.id', get_session('user_id'));
		$this->db->where('JSON_EXTRACT(konf_menu_access.access_right, "$.l") =1');
        $this->db->where('konf_menu_access.is_active', 1);
		$this->db->where('konf_menu.is_active', 1);
		$this->db->order_by("konf_menu.menu_sort");
		$query = $this->db->get();
		
		return $query->result_object();
    }    
    
	public function get_menu_by_id($menu_id) {
		$this->db->select('konf_menu.id, konf_menu.konf_module_id, konf_menu.name, 
							konf_menu.url,konf_menu.konf_menu_parent_id,konf_menu.is_active, konf_menu.menu_sort');
        $this->db->from('konf_menu');
		$this->db->where('konf_menu.id', $menu_id);
		$query = $this->db->get();
		return $query->row_object();
	}    

	public function get_module_by_id($modul_id) {
		$this->db->select('konf_module.id, konf_module.name, konf_module.name, 
							konf_module.module_icon, konf_module.is_active, konf_module.module_sort');
        $this->db->from('konf_module');
		$this->db->where('konf_module.id', $modul_id);
		$query = $this->db->get();
		return $query->row_object();
	}	


	public function get_akses_by_cli($tindakan,$user_id,$cli) {
		$this->db->select('konf_menu.id, konf_menu.konf_module_id, konf_menu.name, 
							konf_menu.url,konf_menu.is_active, konf_menu.menu_sort, 
							konf_menu_access.access_right');
        $this->db->from('users');
		$this->db->join('map_user_konf_role', 'map_user_konf_role.user_id = users.id');

        $this->db->join('konf_menu_access', 'konf_menu_access.konf_role_id = map_user_konf_role.konf_role_id');
        $this->db->join('konf_menu', 'konf_menu.id = konf_menu_access.konf_menu_id');
		$this->db->where('users.id', $user_id);
        $this->db->where('konf_menu_access.is_active', 1);
		$this->db->where('konf_menu.is_active', 1);
		$this->db->where('konf_menu.id', $cli);

		if ($tindakan=='l'){
			$this->db->where('JSON_EXTRACT(konf_menu_access.access_right, "$.l") =1');
		}elseif ($tindakan=='t'){
			$this->db->where('JSON_EXTRACT(konf_menu_access.access_right, "$.t") =1');
		}elseif ($tindakan=='s'){
			$this->db->where('JSON_EXTRACT(konf_menu_access.access_right, "$.s") =1');
		}elseif ($tindakan=='h'){
			$this->db->where('JSON_EXTRACT(konf_menu_access.access_right, "$.h") =1');
		}elseif ($tindakan=='c'){
			$this->db->where('JSON_EXTRACT(konf_menu_access.access_right, "$.c") =1');
		}else{
			$this->db->where('JSON_EXTRACT(konf_menu_access.access_right, "$.l") =1');
		}



		$query = $this->db->count_all_results();
		
		if ($query==0){
			return false;
		}else{
			return true;
		}

	}    
	
}
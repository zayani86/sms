<?php

class Sistem_model extends CI_Model
{
    #region misc
    public function get_jawatan_hakiki()
    {
        $this->db->select('kod, keterangan, id');
        $this->db->from('konf_kod');
        $this->db->where('kategori', 'JAWATAN_HAKIKI');
        $this->db->where('soft_delete', 0);
        $this->db->where('flag_jawatan is not null', null);
        $this->db->order_by('flag_jawatan,kod');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_kod_aktiviti_with_or_without_condition($where_and = [], $where_or = [], $join = [])
    {
        $this->db->select('kka.id, kka.kod, perihal');
        $this->db->from('konf_kod_aktiviti kka');
        if (isset($join)) {
            foreach ($join as $key => $value) {
                $this->db->join($key, $value);
            }
        }
        if (isset($where_and)) {
            foreach ($where_and as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        if (isset($where_or)) {
            foreach ($where_or as $key => $value) {
                $this->db->or_where($key, $value);
            }
        }
        $this->db->group_by('kka.id');
        $this->db->order_by('kod');
        $this->db->where('kka.is_active', 1);
        $this->db->where('kka.soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_kategori_vot()
    {
        $this->db->select('kod, keterangan');
        $this->db->from('konf_kod');
        $this->db->where('kategori', 'KATEGORI_VOT');
        $this->db->where('soft_delete', 0);
        $this->db->order_by('kod');
        $query = $this->db->get();
        return $query->result_object();
    }

    function get_vot_with_or_without_condition($where_and = [], $where_or = [], $join = [])
    {
        // pr($_POST);
        $this->db->select('id, kod_vot, keterangan,CASE
         WHEN kod_vot like "%T%" THEN 1
         WHEN kod_vot like "%B%" THEN 2
         WHEN kod_vot like "%P%" THEN 3
         END as a', FALSE);
        $this->db->from('konf_ptj_vot');
        if (isset($join)) {
            foreach ($join as $key => $value) {
                $this->db->join($key, $value);
            }
        }
        if (isset($where_and)) {
            foreach ($where_and as $key => $value) {
                if ($value != "")
                    $this->db->where($key, $value);
            }
        }
        if (isset($where_or)) {
            foreach ($where_or as $key => $value) {
                $this->db->or_where($key, $value);
            }
        }
        $this->db->where('konf_ptj_vot.is_active', 1);
        $this->db->where('konf_ptj_vot.soft_delete', 0);
        $this->db->order_by('a,kod_vot');
        $query = $this->db->get();

        return $query->result_object();
    }

    function get_kod_projek_with_or_without_condition($where_and = [], $where_or = [], $join = [])
    {
        $this->db->select('id, kod_projek, keterangan');
        $this->db->from('konf_kod_projek');
        if (isset($join)) {
            foreach ($join as $key => $value) {
                if ($value != "")
                    $this->db->join($key, $value);
            }
        }
        if (isset($where_and)) {
            foreach ($where_and as $key => $value) {
                // if ($value != "")
                $this->db->where($key, $value);
            }
        }
        if (isset($where_or)) {
            foreach ($where_or as $key => $value) {
                $this->db->or_where($key, $value);
            }
        }
        $this->db->where('konf_kod_projek.is_active', 1);
        $this->db->where('konf_kod_projek.soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    function get_kod_projek_with_or_without_condition_for_tambah($where_and = [], $where_or = [], $join = [], $kod_projek)
    {
        $this->db->select('id, kod_projek, keterangan');
        $this->db->from('konf_kod_projek');
        if (isset($join)) {
            foreach ($join as $key => $value) {
                if ($value != "")
                    $this->db->join($key, $value);
            }
        }
        if (isset($where_and)) {
            foreach ($where_and as $key => $value) {
                // if ($value != "")
                $this->db->where($key, $value);
            }
        }
        if (isset($where_or)) {
            foreach ($where_or as $key => $value) {
                $this->db->or_where($key, $value);
            }
        }
        $this->db->where_not_in('konf_kod_projek.id', $kod_projek);

        $this->db->where('konf_kod_projek.is_active', 1);
        $this->db->where('konf_kod_projek.soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    function get_daerah_only()
    {
        $this->db->select('id, keterangan');
        $this->db->from('konf_kod');
        $this->db->where('konf_kod.is_active', 1);
        $this->db->where('konf_kod.soft_delete', 0);
        $this->db->where('kategori', 'DAERAH');
        $this->db->where('keterangan !=', "Ibu Pejabat");
        $this->db->where('keterangan !=', "Pelbagai Daerah");
        $query = $this->db->get();
        return $query->result();
    }

    public function if_exist($parameter, $table, $where = []) //count existing row
    {
        $this->db->select('count(' . $parameter . ') as num');
        $this->db->from($table);
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get();
        // pr($query);
        return $query->row_object();
    }

    public function get_exist_by_parameter($parameter, $table, $join = [], $where = []) //1 row only
    {
        $this->db->select($parameter);
        $this->db->from($table);
        foreach ($join as $key => $value) {
            $this->db->join($key, $value);
        }
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get();
        //         pr($query);
        return $query->row_object();
    }

    public function get_kod_objek_projek($jenis)
    {
        $this->db->select('id');
        if ($jenis == 3) { //pembangunan - kod projek
            $this->db->select('kod_projek as kod');
            $this->db->from('konf_kod_projek');
        } else { //tanggungan & bekalan - kod objek
            $this->db->select('kod');
            $this->db->from('konf_kod_objek');
        }
        $query = $this->db->get();
        // pr($query);
        $result = $query->result();

        $arr['id'] = [];
        $arr['kod'] = [];

        foreach ($result as $key => $value) {
            array_push($arr['id'], $value->id);
            array_push($arr['kod'], $value->kod);
        }

        return $arr;
    }

    public function get_kod_objek_by_id_n_projek($kod, $jenis)
    {
        $this->db->select('id');
        if ($jenis == 3) { //pembangunan - kod projek
            $this->db->select('kod_projek as kod');
            $this->db->from('konf_kod_projek');
            $this->db->where('konf_kod_projek.kod_projek', $kod);
        } else { //tanggungan & bekalan - kod objek
            $this->db->select('kod');
            $this->db->from('konf_kod_objek');
            $this->db->where('konf_kod_objek.kod', $kod);
        }
        $query = $this->db->get();
        // pr($query);
        $result = $query->result();

        return $result;
    }


    function get_kod_objek_with_or_without_condition($where_and = [], $where_or = [], $join = [])
    {
        $this->db->select('id, kod, definisi');
        $this->db->from('konf_kod_objek');
        if (isset($join)) {
            foreach ($join as $key => $value) {
                $this->db->join($key, $value);
            }
        }
        if (isset($where_and)) {
            foreach ($where_and as $key => $value) {
                if ($value != "")
                    $this->db->where($key, $value);
            }
        }
        if (isset($where_or)) {
            foreach ($where_or as $key => $value) {
                $this->db->or_where($key, $value);
            }
        }
        $this->db->where('konf_kod_objek.is_active', 1);
        $this->db->where('konf_kod_objek.soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function getAliranKerja($id)
    {
        $this->db->select('fail_permohonan.status_semasa, konf_urusan_flow.name, konf_urusan_flow.id as konf_urusan_flow_id,
        konf_urusan_id, konf_urusan_flow.seq_no');
        $this->db->from('konf_urusan_flow');
        $this->db->join('fail_permohonan_flow', 'fail_permohonan_flow.konf_urusan_flow_id = konf_urusan_flow.id');
        $this->db->join('fail_permohonan', 'fail_permohonan.konf_curr_flow_id = fail_permohonan_flow.id');
        $this->db->where('fail_permohonan.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_konf_urusan_by_submodul($submodul_name, $wf_kod = [])
    {
        $this->db->select('GROUP_CONCAT(id) as id');
        $this->db->from('konf_urusan');
        if (empty($wf_kod))
            $this->db->like('name', $submodul_name, 'after');
        else {
            foreach ($wf_kod as $key => $value)
                $this->db->or_where('kod_urusan', $value);
        }
        $query = $this->db->get();
        return $query->row_object();
    }

    // same function as get_penyedia_flag_by_submodule @workflow_model
    // public function get_penyedia_by_submodul($submodul_id){
    //     $this->db->select('GROUP_CONCAT(id) as id');
    //     $this->db->from('konf_urusan_flow');
    //     $this->db->where('seq_no', 1);
    //     $this->db->where_in('konf_urusan_id', $submodul_id);
    //     $query = $this->db->get();
    //     pr($query);
    //     return $query->row_object();
    // }

    public function get_semakan_pnj_by_konf_urusan_id($id)
    {
        $this->db->select('id');
        $this->db->from('konf_urusan_flow');
        $this->db->where('soft_delete', 0);
        $this->db->where('name', 'Semakan PNJ');
        $this->db->where('konf_urusan_id', $id);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_flow_by_konf_urusan_id_and_name($id, $flow_name)
    {
        $this->db->select('id');
        $this->db->from('konf_urusan_flow');
        $this->db->where('soft_delete', 0);
        $this->db->where('name', $flow_name);
        $this->db->where('konf_urusan_id', $id);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function is_admin($id)
    {
        $this->db->select('konf_role_id');
        $this->db->from('profile_ptj_role ppr');
        $this->db->join('profile_konf_ptj pkp', 'pkp.id = profile_konf_ptj_id');
        $this->db->where('pkp.user_id', $id);
        $query = $this->db->get();
        $tmp_record = $query->result_object();
        $tmp_array = [];

        if (!empty($tmp_record)) {
            foreach ($tmp_record as $key => $value) {
                $tmp_array[] = $value->konf_role_id;
            }

            return $tmp_array;
        }
    }

    public function get_alamat_2($id = null, $pkn = false, $jbt_id = null)
    {
        $this->db->select('jbt.pegawai_pengawal, alamat_1, alamat_2, alamat_3, alamat_4, poskod,
        bandar, kk.keterangan as daerah');
        if ($pkn === false && $jbt_id == null) {
            $this->db->from('fail_permohonan fp');
            $this->db->join('konf_ptj_alamat kpa', 'kpa.konf_ptj_id = fp.konf_ptj_id');
            $this->db->join('konf_ptj', 'konf_ptj.id = fp.konf_ptj_id');
            $this->db->join('konf_ptj jbt', 'jbt.id = konf_ptj.parent_ptj_id');
            // $this->db->join('alamat', 'alamat.id = kpa.alamat_id');
            // $this->db->join('konf_kod kk', 'kk.id = alamat.daerah_id', 'LEFT');
            $this->db->where('fp.id', $id);
        } elseif ($pkn === true) {
            $this->db->from('konf_ptj');
            // FIXME: prob better to use search by like than hardcode the id like this :/
            $this->db->join('konf_ptj_alamat kpa', 'kpa.konf_ptj_id = 74');
            $this->db->join('konf_ptj jbt', 'jbt.id = konf_ptj.parent_ptj_id and jbt.id = 5');
        } elseif ($pkn === false && $jbt_id != null) {
            $this->db->from('konf_ptj jbt');
            $this->db->join('konf_ptj_alamat kpa', 'kpa.konf_ptj_id = ' . $jbt_id);
            $this->db->where('jbt.id', $jbt_id);
        }
        $this->db->join('alamat', 'alamat.id = kpa.alamat_id');
        $this->db->join('konf_kod kk', 'kk.id = alamat.daerah_id', 'LEFT');
        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_pelulus($id, $konf_urusan_flow_id, $pkn = true)
    {
        $this->db->select('users.name as nama_pelulus, kk.keterangan as gelaran_jwtn, fpf_pkn.tarikh_tindakan');
        $this->db->from('fail_permohonan fp');
        $this->db->where('fp.id', $id);
        $this->db->join('fail_permohonan_flow fpf', 'fpf.fail_permohonan_id = fp.id');
        $this->db->join('fail_permohonan_flow fpf_pkn', 'fpf_pkn.fail_permohonan_id = fp.id and fpf_pkn.konf_urusan_flow_id = ' . $konf_urusan_flow_id);
        $this->db->join('users', 'users.id = fpf_pkn.tindakan_oleh_id');
        $this->db->join('profile_konf_ptj pkp', 'pkp.user_id = fpf_pkn.tindakan_oleh_id');
        if ($pkn === true)
            $this->db->join('konf_ptj ptj_pkn', 'ptj_pkn.id = pkp.konf_ptj_id and ptj_pkn.parent_ptj_id = 5');
        $this->db->join('konf_kod kk', 'kk.id = pkp.konf_gelaran_jwtn_id', 'LEFT');
        $this->db->group_by('fp.id');
        $this->db->order_by('fpf.id', 'DESC');
        $query = $this->db->get();
        //         pr($query);
        return $query->row_object();
    }

    public function get_pemohon($id)
    {
        $this->db->select('users.name, kk.keterangan as jawatan');
        $this->db->from('fail_permohonan fp');
        $this->db->join('users', 'users.id = fp.users_id');
        $this->db->join('profile_konf_ptj pkp', 'pkp.user_id = fp.users_id and pkp.konf_ptj_id = fp.konf_ptj_id');
        $this->db->join('konf_kod kk', 'kk.id = pkp.konf_gelaran_jwtn_id', 'LEFT');
        $this->db->where('fp.id', $id);
        $this->db->where('pkp.is_active', 1);
        $this->db->where('pkp.soft_delete', 0);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function find_daerah($daerah)
    {
        $this->db->select('id');
        $this->db->from('konf_kod kk');
        $this->db->like('LOWER(kk.keterangan)', strtolower($daerah));
        $this->db->where('kk.kategori', 'DAERAH');
        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_nama_menteri_besar()
    {
        $this->db->select('keterangan');
        $this->db->from('konf_kod');
        $this->db->where('kategori', 'MB');
        $query = $this->db->get();
        return $query->row();
    }
    #endregion

    #region START - General
    public function get_konf_system($konf_nama)
    {
        $this->db->from('konf_sistem');
        $this->db->where('konf_nama', $konf_nama);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function konf_system_update($konf_nama, $data)
    {
        $this->db->trans_begin();
        $json_socmed = json_encode($data);

        $this->db->set('konf_value', $json_socmed);
        $this->db->where('konf_nama', $konf_nama);
        $this->db->update('konf_sistem');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    #endregion END - General

    #region START - Roles
    private function _roles_getdt_query()
    {
        $this->db->from('konf_role');
    }

    private function _roles_getdt_filter()
    {
        if ($this->input->post('roles')) {
            $this->db->like('konf_role.name', $this->input->post('roles'));
        }
        if (IS_NUMERIC($this->input->post('status'))) {
            $this->db->where('konf_role.is_active', $this->input->post('status'));
        }
    }

    public function getdt_roles()
    {
        $this->_roles_getdt_query();
        $this->_roles_getdt_filter();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where('konf_role.soft_delete', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_roles()
    {
        $this->_roles_getdt_filter();
        $this->db->from('konf_role');
        $this->db->where('konf_role.soft_delete', 0);
        return $this->db->count_all_results();
    }

    public function count_all_roles()
    {
        $this->db->from('konf_role');
        $this->db->where('konf_role.soft_delete', 0);
        return $this->db->count_all_results();
    }

    public function roles_get_all()
    {
        $this->db->from('konf_role');
        $this->db->order_by('name');
        $this->db->where('soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_menu_by_id($menu_id)
    {
        $this->db->from('konf_menu');
        $this->db->where('konf_menu.id', $menu_id);

        $query = $this->db->get();

        return $query->row_object();
    }

    public function get_all_module($open_public = null)
    {
        $this->db->select('konf_module.id, konf_module.name, konf_module.module_icon, konf_module.is_active, konf_module.module_sort, konf_module.wf_kod');
        $this->db->from('konf_module');
        $this->db->where('konf_module.soft_delete', 0);
        $this->db->where('konf_module.is_active', 1);
        $this->db->order_by("konf_module.module_sort");

        if (!empty($open_public))
            $this->db->where('open_public', $open_public);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_menu()
    {
        $this->db->select('konf_menu.id, konf_menu.konf_module_id, konf_menu.name, 
						konf_menu.url,konf_menu.konf_module_id,konf_menu.konf_menu_parent_id,konf_menu.is_active, konf_menu.menu_sort, konf_menu.wf_kod');
        $this->db->from('konf_menu');
        $this->db->where('konf_menu.soft_delete', 0);
        $this->db->where('konf_menu.is_active', 1);
        $this->db->order_by("konf_menu.menu_sort");

        $query = $this->db->get();

        return $query->result();
    }

    public function get_menu_access_by_roles($id)
    {
        $this->db->select('konf_menu_access.konf_menu_id, konf_role.id as konf_role_id, konf_menu_access.access_right, konf_role.name, konf_menu_access.id as kma_id');
        $this->db->from('konf_menu_access');
        $this->db->join("konf_role", "konf_role.id = konf_menu_access.konf_role_id");
        $this->db->where('konf_menu_access.soft_delete', 0);
        $this->db->where('konf_menu_access.is_active', 1);
        $this->db->where('konf_menu_access.konf_role_id', $id);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_menu_access_by_profile($id)
    {
        $this->db->select('konf_menu_access.id, konf_menu_id, access_right, tarikh_aktif_dari, tarikh_aktif_hingga, konf_menu.name');
        $this->db->from('konf_menu_access');
        $this->db->where('konf_menu_access.soft_delete', 0);
        $this->db->where('konf_menu_access.is_active', 1);
        $this->db->where('profile_konf_ptj.user_id', $id);
        $this->db->join('konf_menu', 'konf_menu.id = konf_menu_access.konf_menu_id');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.konf_role_id = konf_menu_access.konf_role_id');
        $this->db->join('profile_konf_ptj', 'profile_konf_ptj.id = profile_ptj_role.profile_konf_ptj_id');

        $query = $this->db->get();
        return $query->result();
    }


    public function get_menu_by($where = array(), $returnMethod = "")
    {
        $this->db->select('konf_menu.id, konf_menu.konf_module_id, konf_menu.name, 
						konf_menu.url,konf_menu.konf_module_id,konf_menu.konf_menu_parent_id,konf_menu.is_active, konf_menu.menu_sort');
        $this->db->from('konf_menu');
        $this->db->where('konf_menu.soft_delete', 0);
        $this->db->where('konf_menu.is_active', 1);

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        $query = $this->db->get();

        return ($returnMethod) ? $query->$returnMethod() : $query->result();
    }

    public function get_module_by($where = array(), $returnMethod = "")
    {
        $this->db->select('konf_module.id, konf_module.name, konf_module.module_icon, konf_module.is_active, konf_module.module_sort');
        $this->db->from('konf_module');
        $this->db->where('konf_module.soft_delete', 0);
        $this->db->where('konf_module.is_active', 1);
        $this->db->order_by("konf_module.module_sort");

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        $query = $this->db->get();

        return ($returnMethod) ? $query->$returnMethod() : $query->result();
    }

    public function akses_pengguna_insert($post)
    {
        $this->db->trans_begin();

        $data['konf_role'] = array(
            'name' => $post['name'],
            'is_active' => ($post['active']) ? 1 : 0,
        );

        $this->db->insert('konf_role', $data['konf_role']);
        $masterid = $this->db->insert_id();

        $konf_menu = $this->sistem_model->get_all_menu();
        foreach ($konf_menu as $key => $item_konf_menu) {
            $get_lihat_menu = 'lihat_menu_' . $item_konf_menu->id;
            $get_tambah_menu = 'tambah_menu_' . $item_konf_menu->id;
            $get_simpan_menu = 'simpan_menu_' . $item_konf_menu->id;
            $get_hapus_menu = 'hapus_menu_' . $item_konf_menu->id;
            $get_cetak_menu = 'cetak_menu_' . $item_konf_menu->id;

            $val_lihat = ($post[$get_lihat_menu]) ? 1 : 0;
            $val_tambah = ($post[$get_tambah_menu]) ? 1 : 0;
            $val_simpan = ($post[$get_simpan_menu]) ? 1 : 0;
            $val_hapus = ($post[$get_hapus_menu]) ? 1 : 0;
            $val_cetak = ($post[$get_cetak_menu]) ? 1 : 0;

            $data_access = array(
                'l' => $val_lihat,
                't' => $val_tambah,
                's' => $val_simpan,
                'h' => $val_hapus,
                'c' => $val_cetak,
            );

            $data['konf_menu_access'][] = array(
                'konf_role_id' => $masterid,
                'konf_menu_id' => $item_konf_menu->id,
                'access_right' => json_encode($data_access),
                'is_active' => 1,
            );
        }

        if ($data['konf_menu_access']) {
            $this->db->insert_batch('konf_menu_access', $data['konf_menu_access']);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return $masterid;
        }
    }

    public function akses_pengguna_update($post)
    {
        $this->db->trans_begin();

        $data['konf_role'] = array(
            'name' => $post['name'],
            'is_active' => ($post['active']) ? 1 : 0,
        );

        $this->db->update('konf_role', $data['konf_role'], 'id=' . $post['frmid']);

        $konf_menu = $this->sistem_model->get_all_menu();
        foreach ($konf_menu as $key => $item_konf_menu) {
            $get_lihat_menu = 'lihat_menu_' . $item_konf_menu->id;
            $get_tambah_menu = 'tambah_menu_' . $item_konf_menu->id;
            $get_simpan_menu = 'simpan_menu_' . $item_konf_menu->id;
            $get_hapus_menu = 'hapus_menu_' . $item_konf_menu->id;
            $get_cetak_menu = 'cetak_menu_' . $item_konf_menu->id;

            $val_lihat = ($post[$get_lihat_menu]) ? 1 : 0;
            $val_tambah = ($post[$get_tambah_menu]) ? 1 : 0;
            $val_simpan = ($post[$get_simpan_menu]) ? 1 : 0;
            $val_hapus = ($post[$get_hapus_menu]) ? 1 : 0;
            $val_cetak = ($post[$get_cetak_menu]) ? 1 : 0;

            $data_access = array(
                'l' => $val_lihat,
                't' => $val_tambah,
                's' => $val_simpan,
                'h' => $val_hapus,
                'c' => $val_cetak,
            );

            $data['konf_menu_access'][] = array(
                'konf_role_id' => $post['frmid'],
                'konf_menu_id' => $item_konf_menu->id,
                'access_right' => json_encode($data_access),
                'is_active' => 1,
            );
        }

        if ($data['konf_menu_access']) {
            $this->db->delete('konf_menu_access', array('konf_role_id' => $post['frmid']));
            $this->db->insert_batch('konf_menu_access', $data['konf_menu_access']);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return $post['frmid'];
        }
    }

    public function get_peranan_pengguna($id)
    {
        $this->db->from('konf_role');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function peranan_delete($id)
    {
        //soft delete only for table user
        $this->db->trans_begin();

        $this->db->delete('konf_menu_access', array('konf_role_id' => $id));
        $this->db->delete('konf_role', array('id' => $id));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    #endregion END - Roles

    #region START - Pengguna
    private function _getdt_query_senarai_pengguna()
    {
        $this->db->distinct('users.id AS profile_id, users.no_pengenalan AS profile_no_pengenalan, users.name AS profile_name, 
                            users.email AS profile_email,users.is_active AS profile_active, 
                            konf_ptj.id AS ptj_id, konf_ptj.nama AS ptj_name, users.username');
        $this->db->select('users.id AS profile_id, users.no_pengenalan AS profile_no_pengenalan, users.name AS profile_name, 
                            users.email AS profile_email,users.is_active AS profile_active, 
                            konf_ptj.id AS ptj_id, konf_ptj.nama AS ptj_name, users.username');
        $this->db->from('users');
    }

    private function _getdt_jointables_senarai_pengguna()
    {
        // $this->db->join('users', 'profile.id = users.profile_id');
        $this->db->join('profile_konf_ptj', 'users.id = profile_konf_ptj.user_id and profile_konf_ptj.is_active = 1 ', 'LEFT');
        $this->db->join('konf_ptj', 'konf_ptj.id = profile_konf_ptj.konf_ptj_id', 'LEFT');
    }

    private function _getdt_filter_senarai_pengguna()
    {
        //add custom filter here
        if ($this->input->post('id_pengguna')) {
            $this->db->like('users.no_pengenalan', $this->input->post('id_pengguna'));
        }
        if ($this->input->post('name')) {
            $this->db->like('users.name', $this->input->post('name'));
        }
        if ($this->input->post('email')) {
            if ($this->input->post('email'))
                $this->db->where('users.email', $this->input->post('email'));
        }
        if ($this->input->post('jabatan')) {
            $this->db->where('konf_ptj.id', $this->input->post('jabatan'));
        }
        if (IS_NUMERIC($this->input->post('status'))) {
            $this->db->where('users.is_active', $this->input->post('status'));
        }
    }

    public function getdt_senarai_pengguna()
    {
        $this->_getdt_query_senarai_pengguna();
        $this->_getdt_jointables_senarai_pengguna();
        $this->_getdt_filter_senarai_pengguna();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getdt_senarai_pengguna2($rtnMethod = "result", $where = [], $join = [])
    {
        $this->db->select('users.username, users.name, users.email, users.is_active, users.id');
        $this->db->from('users');
        $this->db->group_by('users.id');
        // $this->db->join('users', 'users.profile_id = profile.id');
        // $this->db->where('profile.is_active', 1);
        if (isset($join)) {
            foreach ($join as $key => $value) {
                if ($value != "")
                    $this->db->join($key, $value);
            }
        }
        if (isset($where)) {
            foreach ($where as $key => $value) {
                if ($value != "")
                    $this->db->where($key, $value);
            }
        }
        $this->db->where('users.soft_delete', 0);
        //        $this->db->where('users.is_active', 1);
        $query = $this->db->get();
        //         pr($query);
        return $query->$rtnMethod();
    }

    public function count_filtered_senarai_pengguna()
    {
        $this->_getdt_jointables_senarai_pengguna();
        $this->_getdt_filter_senarai_pengguna();
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    public function count_all_senarai_pengguna()
    {
        $this->_getdt_jointables_senarai_pengguna();
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    public function pengguna_get_profile($id)
    {
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function pengguna_get_profil_ptj($id)
    {
        // $this->db->select('profile_ptj_role.profile_konf_ptj_id,konf_role.name, konf_ptj.nama');
        // $this->db->from('profile_ptj_role');
        // $this->db->join('profile_konf_ptj', 'profile_konf_ptj.id = profile_ptj_role.profile_konf_ptj_id');
        // $this->db->join('profile', 'profile.id = profile_konf_ptj.profile_id');
        // $this->db->join('konf_ptj', 'profile_konf_ptj.konf_ptj_id = konf_ptj.id');
        // $this->db->join('konf_role', 'profile_ptj_role.konf_role_id = konf_role.id');
        // $this->db->where('profile_ptj_role.is_active', 1);
        // $this->db->where('profile.id', $id);
        $this->db->select('konf_ptj.id, konf_ptj.nama');
        $this->db->from('konf_ptj');
        $this->db->join('profile_konf_ptj', 'profile_konf_ptj.konf_ptj_id = konf_ptj.id');
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.user_id', $id);
        $query = $this->db->get();
        // pr($query);
        return $query->result();
    }

    public function pengguna_get_ptj_role($id)
    {
        $this->db->select('profile_konf_ptj.konf_ptj_id, konf_role.name');
        $this->db->from('profile_konf_ptj');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id');
        $this->db->join('konf_role', 'konf_role.id = profile_ptj_role.konf_role_id');
        $this->db->where('profile_ptj_role.is_active', 1);
        $this->db->where('profile_konf_ptj.user_id', $id);
        $query = $this->db->get();
        // pr($query);
        return $query->result();
    }

    public function pengguna_get_user($id)
    {
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function pengguna_get_peranan_active($id)
    {
        // pr($id);
        // $this->db->select('profile_role.*, konf_role.name');
        // $this->db->from('profile_role');
        // $this->db->join('konf_role','konf_role.id = profile_role.konf_role_id');
        // $this->db->where('profile_role.profile_id', $id);
        // $this->db->where('profile_role.is_active', 1);
        $this->db->select('profile_konf_ptj.*, konf_role.name');
        $this->db->from('profile_konf_ptj');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id');
        $this->db->join('konf_role', 'konf_role.id = profile_ptj_role.konf_role_id');
        $this->db->where('profile_konf_ptj.user_id', $id);
        // $this->db->where('profile_role.is_active', 1);
        $this->db->where('profile_ptj_role.is_active', 1);
        $query = $this->db->get();
        // pr($query);
        return $query->result();
    }

    public function pengguna_get_ptj_active($id)
    {
        $this->db->select('profile_konf_ptj.id as pkp_id, profile_konf_ptj.konf_ptj_id, profile_konf_ptj.konf_jwtn_hakiki_id, profile_konf_ptj.konf_gelaran_jwtn_id, profile_konf_ptj.flow_access, profile_ptj_role.konf_role_id as ppr_id, konf_role.name as p_name');
        $this->db->from('profile_konf_ptj');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id', 'left');
        $this->db->join('konf_role', 'konf_role.id = profile_ptj_role.konf_role_id');
        $this->db->where('profile_konf_ptj.user_id', $id);
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $this->db->where('profile_ptj_role.tarikh_mula', null);
        $this->db->where('(profile_ptj_role.is_active = 1 OR profile_ptj_role.is_active IS NULL)');
        // $this->db->or_where('profile_ptj_role.is_active', null);
        $this->db->where('(profile_ptj_role.soft_delete = 0 OR profile_ptj_role.soft_delete IS NULL)');
        // $this->db->or_where('profile_ptj_role.soft_delete', null);
        $this->db->group_by('profile_konf_ptj.konf_ptj_id');
        $query = $this->db->get();
        // pr($query);
        return $query->result_object();
    }

    public function pengguna_get_ptj_active_multiple_role($id)
    {
        $this->db->select('profile_konf_ptj.id as pkp_id, profile_konf_ptj.konf_ptj_id, profile_konf_ptj.konf_jwtn_hakiki_id, profile_konf_ptj.konf_gelaran_jwtn_id, profile_konf_ptj.flow_access, profile_ptj_role.konf_role_id as ppr_id, konf_role.name as p_name');
        $this->db->from('profile_konf_ptj');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id', 'left');
        $this->db->join('konf_role', 'konf_role.id = profile_ptj_role.konf_role_id');
        $this->db->where('profile_konf_ptj.user_id', $id);
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $this->db->where('profile_ptj_role.tarikh_mula', null);
        $this->db->where('(profile_ptj_role.is_active = 1 OR profile_ptj_role.is_active IS NULL)');
        // $this->db->or_where('profile_ptj_role.is_active', null);
        $this->db->where('(profile_ptj_role.soft_delete = 0 OR profile_ptj_role.soft_delete IS NULL)');
        // $this->db->or_where('profile_ptj_role.soft_delete', null);
        $this->db->group_by('profile_konf_ptj.konf_ptj_id, profile_ptj_role.konf_role_id ');
        $query = $this->db->get();
        // pr($query);
        return $query->result_object();
    }

    public function pengguna_get_ptj_sementara($id)
    {
        $this->db->select('profile_konf_ptj.id as pkp_id, profile_konf_ptj.konf_ptj_id, profile_konf_ptj.konf_jwtn_hakiki_id, profile_konf_ptj.konf_gelaran_jwtn_id,
        profile_ptj_role.konf_role_id, profile_ptj_role.tarikh_mula, profile_ptj_role.tarikh_tamat, profile_ptj_role.is_active, profile_ptj_role.id as ppr_id,profile_ptj_role.konf_role_id as kr_id,profile_ptj_role.keterangan,konf_role.name as nama_peranan,profile_konf_ptj.flow_access, konf_role.name as p_name');
        $this->db->from('profile_konf_ptj');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id');
        $this->db->join('konf_role', 'profile_ptj_role.konf_role_id = konf_role.id');
        $this->db->where('profile_konf_ptj.user_id', $id);
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $this->db->where('profile_ptj_role.tarikh_mula !=', null);
        // $this->db->where('profile_ptj_role.is_active', 1);
        $this->db->where('profile_ptj_role.soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function pengguna_get_ptj_sementara2($return_type)
    {
        $this->db->select('users.id as user_id, users.profile_id, users.name, konf_ptj.nama as nama_ptj, konf_role.name as nama_role, date_format(profile_ptj_role.tarikh_mula, "%d-%m-%Y") as tarikh_mula, 
        date_format(profile_ptj_role.tarikh_tamat, "%d-%m-%Y") as tarikh_tamat, profile_ptj_role.is_active');
        $this->db->from('users');
        // $this->db->join('profile', 'profile.id = users.profile_id');
        $this->db->join('profile_konf_ptj', 'profile_konf_ptj.user_id = users.id');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id');
        $this->db->join('konf_ptj', 'konf_ptj.id = profile_konf_ptj.konf_ptj_id');
        $this->db->join('konf_role', 'konf_role.id = profile_ptj_role.konf_role_id');
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $this->db->where('profile_ptj_role.tarikh_mula !=', null);
        $this->db->where('profile_ptj_role.is_active', 1);
        $this->db->where('profile_ptj_role.soft_delete', 0);

        if ($return_type != "count_all_data") {
            if ($this->input->post('nama_pengguna')) {
                $this->db->like('users.name', $this->input->post('nama_pengguna'));
            }
            if ($this->input->post('nama_ptj')) {
                $this->db->like('konf_ptj.nama', $this->input->post('nama_ptj'));
            }
        }
        if ($return_type == "get_all_data") {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);

            $query = $this->db->get();
            // pr($query);
            return $query->result_object();
        } else {
            $this->db->select('count(profile_ptj_role.id) as total');
            return $this->db->get()->row()->total;
        }
    }

    public function get_existing_ptj($profile_id)
    {
        $this->db->select('profile_konf_ptj.id as pkp_id, profile_konf_ptj.konf_ptj_id');
        $this->db->from('profile_konf_ptj');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id');
        $this->db->where('profile_konf_ptj.user_id', $profile_id);
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $this->db->where('profile_ptj_role.soft_delete', 0);
        $this->db->group_by('profile_konf_ptj.konf_ptj_id');
        $query = $this->db->get();
        //         pr($query);
        return $query->result_object();
    }

    public function get_role($where = array())
    {
        $this->db->from('profile_ptj_role');

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_role2($where = array())
    {
        $this->db->from('konf_role');

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function check_ptj_ade_role_sementara($id)
    {
        $this->db->from('profile_ptj_role');
        $this->db->where('profile_ptj_role.profile_konf_ptj_id', $id);
        $this->db->where('profile_ptj_role.is_active', 1);
        $this->db->where('profile_ptj_role.soft_delete', 0);
        $this->db->where('profile_ptj_role.tarikh_mula !=', null);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_email_for_send()
    {
        $this->db->from('email_job');
        $this->db->where('email_job.is_sent', 0);
        $this->db->where('email_job.soft_delete', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_ptj_by_profile_id($profile_id)
    {
        $this->db->select('GROUP_CONCAT(DISTINCT(CONCAT(konf_ptj.kod, " - " , konf_ptj.nama)) SEPARATOR ",<br> ") xxx');
        $this->db->from('profile_konf_ptj');
        $this->db->join('konf_ptj', 'konf_ptj.id = profile_konf_ptj.konf_ptj_id');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id');

        $this->db->where('profile_konf_ptj.user_id', $profile_id);
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);

        $this->db->where('(profile_ptj_role.is_active = 1 OR profile_ptj_role.is_active IS NULL)');
        $this->db->where('(profile_ptj_role.soft_delete = 0 OR profile_ptj_role.soft_delete IS NULL)');

        $query = $this->db->get();

        return $query->row_object();
    }

    public function get_jabatan_by_profile_id($profile_id)
    {
        $this->db->select('GROUP_CONCAT(konf_ptj.nama_jabatan SEPARATOR ",<br> ") xxx');
        $this->db->from('profile_konf_ptj');
        $this->db->join('konf_ptj', 'konf_ptj.id = profile_konf_ptj.konf_ptj_id');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id', 'left');

        $this->db->where('profile_konf_ptj.user_id', $profile_id);
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $this->db->where('(profile_ptj_role.is_active = 1 OR profile_ptj_role.is_active IS NULL)');
        $this->db->where('(profile_ptj_role.soft_delete = 0 OR profile_ptj_role.soft_delete IS NULL)');

        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_jenis_ptj_by_profile_id($profile_id)
    {
        $this->db->select('GROUP_CONCAT(konf_ptj.jenis_ptj_id SEPARATOR ",<br> ") xxx');
        $this->db->from('profile_konf_ptj');
        $this->db->join('konf_ptj', 'konf_ptj.id = profile_konf_ptj.konf_ptj_id');
        $this->db->where('profile_konf_ptj.profile_id', $profile_id);
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_ptj_by_jabatan($jab_id, $parameter)
    {
        $this->db->select('GROUP_CONCAT(' . $parameter . ' SEPARATOR "<br>") xxx');
        $this->db->from('konf_ptj');
        $this->db->where('konf_ptj.parent_ptj_id', $jab_id);
        // $this->db->where('konf_ptj.is_active', 1);
        $this->db->where('konf_ptj.soft_delete', 0);
        $query = $this->db->get();
        return $query->row_object()->xxx;
    }

    public function get_ptj_kod_ativiti_by_jabatan($jab_id)
    {
        $this->db->select('GROUP_CONCAT(DISTINCT(konf_ptj.kod_aktiviti)  SEPARATOR ", <br>") xxx');
        $this->db->from('konf_ptj');
        $this->db->where('konf_ptj.parent_ptj_id', $jab_id);
        // $this->db->where('konf_ptj.is_active', 1);
        $this->db->where('konf_ptj.soft_delete', 0);
        $query = $this->db->get();
        return $query->row_object()->xxx;
    }

    public function is_user_first_time($id)
    {
        $this->db->select('users.first_time_login');
        $this->db->from('users');
        $this->db->where('users.id', $id);

        $query = $this->db->get();
        return $query->row_object()->first_time_login;
    }

    public function pengguna_insert($post)
    {
        $this->db->trans_begin();

        $data['profile'] = array(
            'name' => $post['name'],
            'nama_ringkasan' => $post['nama_ringkasan'],
            'no_pengenalan' => $post['ic1'] . $post['ic2'] . $post['ic3'],
            'email' => $post['email'],
            'no_tel' => $post['no_tel_pejabat'],
            'no_hp' => $post['no_tel_bimbit'],
            'profile_img' => $post['profile_img'],
        );
        $this->db->insert('profile', $data['profile']);
        $masterid = $this->db->insert_id();

        $data['users'] = array(
            'username' => $post['ic1'] . $post['ic2'] . $post['ic3'],
            'password' => $post['password'],
            'profile_id' => $masterid,
        );
        $this->db->insert('users', $data['users']);

        $data['profile_konf_ptj'] = array(
            'profile_id' => $masterid,
            'konf_ptj_id' => $post['ptj'],
            'tarikh_kuatkuasa_mula' => date('Y-m-d'),
            'konf_jwtn_hakiki_id' => $post['jwtn_hakiki'],
            'konf_gelaran_jwtn_id' => $post['jwtn_gelaran'],
            'is_active' => 1,
        );
        $this->db->insert('profile_konf_ptj', $data['profile_konf_ptj']);

        if ($post['role']) {
            foreach ($post['role'] as $key => $item) {
                $data['profile_role'][] = array(
                    'profile_id' => $masterid,
                    'konf_role_id' => $item,
                );
            }
            $this->db->insert_batch('profile_role', $data['profile_role']);
        }

        $data_access = array();
        if ($post['menu_id']) {
            pr('test');
            foreach ($post['menu_id'] as $key => $item) {
                $data_access['l'] = 0;
                $data_access['t'] = 0;
                $data_access['s'] = 0;
                $data_access['h'] = 0;
                $data_access['c'] = 0;

                $items = explode(",", $post['akses'][$key]);
                foreach ($items as $key2 => $value) {
                    if ($items[$key2] == 'l')  $data_access['l'] = 1;
                    if ($items[$key2] == 't')  $data_access['t'] = 1;
                    if ($items[$key2] == 's')  $data_access['s'] = 1;
                    if ($items[$key2] == 'h')  $data_access['h'] = 1;
                    if ($items[$key2] == 'c')  $data_access['c'] = 1;
                }

                $data['special_akses'][] = array(
                    'konf_menu_id'  => $post['menu_id'][$key],
                    'access_right'  => json_encode($data_access),
                    'profile_id'    => $masterid,
                    'tarikh_aktif_dari' => $post['tarikh_mula'],
                    'tarikh_aktif_hingga' => $post['tarikh_tamat']
                );
            }
            $this->db->insert_batch('konf_menu_access', $data['special_akses']);
            pr('1' . $this->db->last_query());
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            pr($this->db->error());
            return 0;
        } else {
            $this->db->trans_commit();
            return $masterid;
        }
    }

    public function profil_update($post)
    {
        $this->db->trans_begin();

        $data['profile'] = array(
            'id' => $post['frmid'],
            'nama_ringkasan' => $post['nama_ringkasan'],
            // 'no_pengenalan' => $post['username'],
            'no_pengenalan' => $post['ic1_s'] . $post['ic2_s'] . $post['ic3_s'],
            'email' => $post['email'],
            'no_tel' => $post['no_tel_pejabat'],
            'no_hp' => $post['no_tel_bimbit'],
            'profile_img' => $post['profile_img'],
        );

        $this->db->update('profile', $data['profile'], 'id=' . $data['profile']['id']);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            // pr($this->db->error());
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function pengguna_update($post)
    {
        // pr($post);
        $this->db->trans_begin();

        $data['profile'] = array(
            'id' => $post['frmid'],
            'name' => $post['name'],
            'nama_ringkasan' => $post['nama_ringkasan'],
            // 'no_pengenalan' => $post['username'],
            'no_pengenalan' => $post['ic1_s'] . $post['ic2_s'] . $post['ic3_s'],
            'email' => $post['email'],
            'no_tel' => $post['no_tel_pejabat'],
            'no_hp' => $post['no_tel_bimbit'],
            'profile_img' => $post['profile_img'],
        );

        $this->db->update('profile', $data['profile'], 'id=' . $data['profile']['id']);

        $data['user'] = array(
            'username' => $post['ic1_s'] . $post['ic2_s'] . $post['ic3_s'],
            // 'profile_id' => $post['frmid'],
        );

        $this->db->update('users', $data['user'], 'profile_id=' . $post['frmid']);

        if ($post['password']) {
            $data['users'] = array(
                'password' => $post['password'],
                'profile_id' => $post['frmid'],
            );
            $this->db->update('users', $data['users'], 'profile_id=' . $data['users']['profile_id']);
        }


        if (($post['ptj'] != $post['ptj_old']) || ($post['jwtn_hakiki'] != $post['jwtn_hakiki_old']) || ($post['jwtn_gelaran'] != $post['jwtn_gelaran_old'])) {
            $data['profile_konf_ptj_to_deactivate'] = array(
                'tarikh_kuatkuasa_hingga' => date('Y-m-d'),
                'is_active' => 0,
            );
            $this->db->update('profile_konf_ptj', $data['profile_konf_ptj_to_deactivate'], array('profile_id' => $masterid, 'is_active' => 1));

            $data['profile_konf_ptj'] = array(
                'profile_id' => $post['frmid'],
                'konf_ptj_id' => $post['ptj'],
                'tarikh_kuatkuasa_mula' => date('Y-m-d'),
                'konf_jwtn_hakiki_id' => $post['jwtn_hakiki'],
                'konf_gelaran_jwtn_id' => $post['jwtn_gelaran'],
                'is_active' => 1,
            );
            $this->db->update('profile_konf_ptj', $data['profile_konf_ptj'], 'profile_id=' . $post['frmid']);
        }

        if ($post['role']) {
            $data_profileroles = $this->pengguna_get_peranan_active($post['frmid']);

            foreach ($data_profileroles as $key => $item) {
                $arr_existingroles[$item->konf_role_id] = array(
                    'konf_role_id' => $item->konf_role_id,
                );
            }
            foreach ($arr_existingroles as $key => $item) {
                if (!in_array($key, $post['role'])) {
                    $data['profile_role_delete'][] = array(
                        'profile_id' => $post['frmid'],
                        'konf_role_id' => $item['konf_role_id'],
                    );
                }
            }
            foreach ($post['role'] as $key => $item) {
                if (!array_key_exists($item, $arr_existingroles)) {
                    $data['profile_role_insert'][] = array(
                        'profile_id' => $post['frmid'],
                        'konf_role_id' => $item,
                    );
                }
            }
            if ($data['profile_role_delete']) {
                foreach ($data['profile_role_delete'] as $key => $item) {
                    $this->db->delete('profile_role', $item);
                }
            }
            if ($data['profile_role_insert']) {
                $this->db->insert_batch('profile_role', $data['profile_role_insert']);
            }
        }

        $data_access = array();
        if ($post['menu_id']) {
            foreach ($post['menu_id'] as $key => $item) {
                $data_access['l'] = 0;
                $data_access['t'] = 0;
                $data_access['s'] = 0;
                $data_access['h'] = 0;
                $data_access['c'] = 0;

                $items = explode(",", $post['akses'][$key]);
                foreach ($items as $key2 => $value) {
                    if ($items[$key2] == 'l')  $data_access['l'] = 1;
                    if ($items[$key2] == 't')  $data_access['t'] = 1;
                    if ($items[$key2] == 's')  $data_access['s'] = 1;
                    if ($items[$key2] == 'h')  $data_access['h'] = 1;
                    if ($items[$key2] == 'c')  $data_access['c'] = 1;
                }
                $data['special_akses'][] = array(
                    'konf_menu_id'  => $post['menu_id'][$key],
                    'access_right'  => json_encode($data_access),
                    'profile_id'    => $post['frmid'],
                    'tarikh_aktif_dari' => $post['tarikh_mula'],
                    'tarikh_aktif_hingga' => $post['tarikh_tamat']
                );
            }
            $this->db->insert_batch('konf_menu_access', $data['special_akses']);
        }


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            // pr($this->db->error());
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function pengguna_delete($id)
    {
        //soft delete only for table user
        $this->db->trans_begin();

        $this->db->delete('users', array('profile_id' => $id));
        $this->db->delete('profile_konf_ptj', array('profile_id' => $id));
        $this->db->delete('profile_role', array('profile_id' => $id));
        $this->db->delete('profile', array('id' => $id));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function pengguna_delete_menu_akses($id)
    {
        $this->db->trans_begin();

        $data['id'] = $id;
        $data['soft_delete'] = 1;

        $this->db->update('konf_menu_access', $data, 'id=' . $data['id']);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function getdt_senarai_jabatan($rtnMethod = "result")
    {
        $this->db->trans_begin();

        $this->db->select("*");
        $this->db->from("konf_ptj");
        $this->db->join('konf_ptj_vot', 'konf_ptj_id = konf_ptj.id');
        $this->db->where("konf_ptj.soft_delete", 0);
        $this->db->where("konf_ptj.is_active", 1);

        $query = $this->db->get();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return $query->$rtnMethod();
        }
    }

    public function getdt_senarai_jabatan_ptj($rtnMethod = "result")
    {
        $this->db->trans_begin();

        $this->db->select("kp.*,kp_vot.kod_vot");
        $this->db->from("konf_ptj as kj");
        $this->db->join('konf_ptj as kp', 'kp.parent_ptj_id = kj.id');

        $this->db->join('konf_ptj_vot as kp_vot', 'kp_vot.konf_ptj_id = kj.id AND kp_vot.is_active = 1');
        $this->db->where("kj.soft_delete", 0);
        $this->db->where("kj.is_active", 1);
        $this->db->where("kp.soft_delete", 0);
        $this->db->where("kp.is_active", 1);
        $this->db->group_by("kp.id");
        $this->db->order_by("kp.parent_ptj_id");

        $query = $this->db->get();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return $query->$rtnMethod();
        }
    }

    #endregion END - Pengguna

    #region Start - PTJ
    function ptj_get_all()
    {
        $this->db->from('konf_ptj');
        $this->db->order_by('nama');
        $query = $this->db->get();
        return $query->result_object();
    }

    function get_konf_ptj($id)
    {
        $this->db->select('konf_ptj.nama');
        $this->db->from('konf_ptj');
        $this->db->where('konf_ptj.id', $id);
        $query = $this->db->get();
        return $query->row_object();
    }

    function get_konf_ptj_data($id)
    {
        $this->db->select('konf_ptj.kod, nama, nama_jabatan, kod_jabatan, no_tel, no_fax, emel, level, parent_ptj_id');
        $this->db->from('konf_ptj');
        $this->db->where('konf_ptj.id', $id);
        $query = $this->db->get();
        return $query->row_object();
    }


    #endregion Start - PTJ

    #region START - Navigasi
    private function _modul_getdt_query()
    {
        $this->db->from('konf_module');
    }

    private function _modul_getdt_filter()
    {
        if ($this->input->post('modul')) {
            $this->db->like('konf_module.name', $this->input->post('modul'));
        }
        if (IS_NUMERIC($this->input->post('status'))) {
            $this->db->where('konf_module.is_active', $this->input->post('status'));
        }
    }

    public function getdt_modul()
    {
        $this->_modul_getdt_query();
        $this->_modul_getdt_filter();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where('konf_module.soft_delete', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_modul()
    {
        $this->_modul_getdt_filter();
        $this->db->from('konf_module');
        $this->db->where('konf_module.soft_delete', 0);
        return $this->db->count_all_results();
    }

    public function count_all_modul()
    {
        $this->db->from('konf_module');
        $this->db->where('konf_module.soft_delete', 0);
        return $this->db->count_all_results();
    }

    public function navigasi_update($post)
    {
        $this->db->trans_begin();

        $data['konf_module'] = array(
            'id' => $post['frmid'],
            'name' => $post['name'],
            'module_icon' => $post['ikon'],
            'is_active' => ($post['active']) ? 1 : 0,

        );

        $this->db->update('konf_module', $data['konf_module'], 'id=' . $post['frmid']);

        $count_menu = count($this->input->post('menu_id'));
        if ($count_menu > 0) {
            for ($x = 0; $x < $count_menu; $x++) {
                $data['konf_menu'][] =  array(
                    'id' =>  $this->input->post('menu_id')[$x],
                    'name' => $this->input->post('menu_name')[$x],
                    'menu_sort' => $this->input->post('menu_sort')[$x],
                    'is_active' => ($this->input->post('menu_active')[$x]) ? 1 : 0,
                );
            }
            if ($data['konf_menu']) {
                $this->db->update_batch('konf_menu', $data['konf_menu'], 'id');
            }
        }

        $count_submenu = count($this->input->post('submenu_id'));
        if ($count_submenu > 0) {
            for ($x = 0; $x < $count_submenu; $x++) {
                $data['konf_submenu'][] =  array(
                    'id' =>  $this->input->post('submenu_id')[$x],
                    'konf_menu_parent_id' =>  $this->input->post('parent_id')[$x],
                    'name' => $this->input->post('submenu_name')[$x],
                    'menu_sort' => $this->input->post('submenu_sort')[$x],
                    'menu_icon' => $this->input->post('submenu_ikon')[$x],
                    'is_active' => ($this->input->post('submenu_active')[$x]) ? 1 : 0,
                );
            }
            if ($data['konf_submenu']) {
                $this->db->update_batch('konf_menu', $data['konf_submenu'], 'id');
            }
        }


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return $post['frmid'];
        }
    }

    public function get_menu_by_modul_id($modul_id)
    {
        $this->db->select('konf_menu.id, konf_menu.konf_module_id, konf_menu.name, 
                        konf_menu.url,konf_menu.konf_menu_parent_id,konf_menu.is_active, konf_menu.menu_sort, konf_menu.menu_icon');
        $this->db->from('konf_menu');
        $this->db->where('konf_menu.konf_module_id', $modul_id);
        $this->db->order_by('konf_menu.menu_sort asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_module_by_id($modul_id)
    {
        $this->db->select('konf_module.id, konf_module.name, konf_module.name, 
							konf_module.module_icon, konf_module.is_active, konf_module.module_sort');
        $this->db->from('konf_module');
        $this->db->where('konf_module.id', $modul_id);
        $query = $this->db->get();
        return $query->row_object();
    }

    #endregion END - Navigasi

    #region START - Kod

    public function get_konf_kod_by_id($id, $returnMethod = "")
    {
        $this->db->select('*');
        $this->db->from('konf_kod');
        $this->db->where('konf_kod.id', $id);
        $this->db->where('konf_kod.soft_delete', 0);
        $query = $this->db->get();

        return $query->row_object();
    }

    public function getdt_pkod($kategori, $returnMethod = "")
    {
        $this->db->select('*');
        $this->db->from('konf_kod');
        $this->db->where('konf_kod.kategori', $kategori);
        $this->db->where('konf_kod.soft_delete', 0);
        $query = $this->db->get();

        return ($returnMethod) ? $query->$returnMethod() : $query->result();
    }

    public function pkod_insert($post)
    {
        $this->db->trans_begin();

        $data['kod']        = $post['kod'];
        $data['kod_lain']   = $post['kod_lain'];
        $data['keterangan'] = $post['keterangan'];
        $data['kategori']   = strtoupper($post['kategori']);
        $data['is_active']  = $post['active'];

        $this->db->insert('konf_kod', $data);
        $pkod_id = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return $pkod_id;
        }
    }

    public function get_pkod($id)
    {
        $this->db->select("*");
        $this->db->from("konf_kod");
        $this->db->where("konf_kod.id", $id);
        $this->db->where('konf_kod.soft_delete', 0);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function pkod_update($id, $post)
    {
        $this->db->trans_begin();

        $data['kod']        = $post['kod'];
        $data['kod_lain']   = $post['kod_lain'];
        $data['keterangan'] = $post['keterangan'];
        $data['is_active']  = (!empty($post['active'])) ? $post['active'] : 0;
        // $data['is_active']  = $post['active'];

        $this->db->update('konf_kod', $data, 'id=' . $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return $id;
        }
    }

    public function pkod_delete($id)
    {
        $this->db->trans_begin();

        $data['soft_delete'] = 1;

        $this->db->update('konf_kod', $data, 'id=' . $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    #endregion END - Kod

    #region START - Ptj

    public function getdt_ptj($where = array(), $returnMethod = "")
    {
        $this->db->select('konf_ptj.id, konf_ptj.kod, konf_ptj.nama, konf_ptj.jenis_ptj_id, konf_kod.keterangan as jenis_ptj, konf_ptj.parent_ptj_id, konf_ptj.is_active');
        $this->db->from('konf_ptj');
        $this->db->where('konf_ptj.soft_delete', 0);
        $this->db->join("konf_kod", "konf_kod.id = konf_ptj.jenis_ptj_id");

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        $query = $this->db->get();

        return ($returnMethod) ? $query->$returnMethod() : $query->result();
    }

    public function ptj_insert($post)
    {
        $this->db->trans_begin();

        $alamat_id = array();

        $data['kod']            = $post['kod'];
        $data['nama']           = $post['nama'];
        $data['jenis_ptj_id']   = $post['jenis_ptj_id'];
        $data['parent_ptj_id']  = $post['parent_ptj_id'];
        $data['is_active']      = (!empty($post['active'])) ? $post['active'] : 0;

        $this->db->insert('konf_ptj', $data);
        $ptj_id = $this->db->insert_id();

        $alamat['alamat_1']         = $post['alamat_1'];
        $alamat['alamat_2']         = $post['alamat_2'];
        $alamat['alamat_3']         = $post['alamat_3'];
        $alamat['alamat_4']         = $post['alamat_4'];
        $alamat['poskod']           = $post['poskod'];
        $alamat['bandar']           = $post['bandar'];
        $alamat['negeri_id']        = $post['negeri'];
        $alamat['no_tel_1']         = $post['no_tel_1'];
        $alamat['no_faks']          = $post['no_faks'];
        $alamat['emel']             = $post['emel'];
        $alamat['website']          = $post['website'];
        $alamat['jenis_alamat_id']  = 24;

        // pr($alamat);
        $this->db->insert('alamat', $alamat);
        $alamat_id[] = $this->db->insert_id();

        if (empty($post["alamat_sm_sama"])) {
            $alamat_sm['alamat_1']         = $post['alamat_1_sm'];
            $alamat_sm['alamat_2']         = $post['alamat_2_sm'];
            $alamat_sm['alamat_3']         = $post['alamat_3_sm'];
            $alamat_sm['alamat_4']         = $post['alamat_4_sm'];
            $alamat_sm['poskod']           = $post['poskod_sm'];
            $alamat_sm['bandar']           = $post['bandar_sm'];
            $alamat_sm['negeri_id']        = $post['negeri_sm'];
            $alamat_sm['no_tel_1']         = $post['no_tel_1_sm'];
            $alamat_sm['no_faks']          = $post['no_faks_sm'];
            $alamat_sm['emel']             = $post['emel_sm'];
            $alamat_sm['website']         = $post['website_sm'];
            $alamat_sm['jenis_alamat_id']  = 23;

            $this->db->insert('alamat', $alamat_sm);
            $alamat_id[] = $this->db->insert_id();
        }

        $konf_ptj_alamat = array();

        foreach ($alamat_id as $value) {
            $item["konf_ptj_id"] = $ptj_id;
            $item["alamat_id"] = $value;
            array_push($konf_ptj_alamat, $item);
        }

        $this->db->insert_batch("konf_ptj_alamat", $konf_ptj_alamat);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return $ptj_id;
        }
    }

    public function get_alamat($where = array(), $returnMethod = "", $join = [])
    {
        $this->db->select("*");
        $this->db->from("konf_ptj_alamat");
        $this->db->where('konf_ptj_alamat.is_active', 1);
        $this->db->where('konf_ptj_alamat.soft_delete', 0);

        $this->db->join("alamat", "alamat.id = konf_ptj_alamat.alamat_id");

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        if (!empty($join)) {
            foreach ($join as $key => $value) {
                $this->db->join($key, $value);
            }
        }

        $query = $this->db->get();

        return ($returnMethod) ? $query->$returnMethod() : $query->result();
    }

    public function getdt_ptj_with_alamat($where = array(), $returnMethod = "")
    {
        $this->db->select('konf_ptj.id, konf_ptj.kod, konf_ptj.nama, konf_ptj.jenis_ptj_id, konf_kod.keterangan as jenis_ptj, konf_ptj.parent_ptj_id, konf_ptj.is_active, ap.alamat_1, ap.bandar, ap.jenis_alamat_id');
        $this->db->from('konf_ptj');
        $this->db->where('konf_ptj.soft_delete', 0);
        $this->db->join("konf_kod", "konf_kod.id = konf_ptj.jenis_ptj_id");
        $this->db->join("konf_ptj_alamat", "konf_ptj_alamat.konf_ptj_id = konf_ptj.id");
        $this->db->join("alamat ap", "(ap.id = konf_ptj_alamat.alamat_id AND ap.jenis_alamat_id = 24)");
        // $this->db->join("alamat asm", "(asm.id = konf_ptj_alamat.alamat_id && asm.jenis_alamat_id = 23)", "left");

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        $query = $this->db->get();

        return ($returnMethod) ? $query->$returnMethod() : $query->result();
    }

    public function ptj_update($ptj)
    {
        $this->db->trans_begin();

        $alamat_id = array();

        $data['kod']            = $ptj['kod'];
        $data['nama']           = $ptj['nama'];
        $data['jenis_ptj_id']   = $ptj['jenis_ptj_id'];
        $data['parent_ptj_id']  = $ptj['parent_ptj_id'];
        $data['is_active']      = (!empty($ptj['active'])) ? $ptj['active'] : 0;

        $this->db->update('konf_kod', $data, 'id=' . $ptj['id']);



        // // pr($alamat);
        // $this->db->insert('alamat', $alamat);
        // $alamat_id[] = $this->db->insert_id();

        //

        // $konf_ptj_alamat = array();

        // foreach ($alamat_id as $value)
        // {
        //     $item["konf_ptj_id"] = $ptj_id;
        //     $item["alamat_id"] = $value;
        //     array_push($konf_ptj_alamat, $item);
        // }

        // $this->db->insert_batch("konf_ptj_alamat", $konf_ptj_alamat);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }
    #endregion END - Ptj

    #region Start - Kod Lain
    function get_kod_lain($id)
    {
        $this->db->select('*');
        $this->db->from('konf_kod');
        $this->db->where('konf_kod.id', $id);
        $query = $this->db->get();
        return $query->row_object();
    }
    #endregion End - Kod Lain

    #region Start - Kod objek
    function get_kod_objeck($id)
    {
        $this->db->select('*');
        $this->db->from('konf_kod_objek');
        $this->db->where('konf_kod_objek.id', $id);
        $query = $this->db->get();

        return $query->row_object();
    }
    #endregion End - Kod Lain

    function get_kod_ptj_vot($id)
    {
        $this->db->select('*');
        $this->db->from('konf_ptj_vot');
        $this->db->where('konf_ptj_vot.id', $id);
        $query = $this->db->get();

        return $query->row_object();
    }

    public function get_ptj_by_profile($id)
    {
        $this->db->select('konf_ptj.level as ptj_level, konf_ptj.id as ptj_id, konf_ptj.kod as ptj_kod, konf_ptj.nama as ptj_nama,
        konf_ptj.parent_ptj_id as ptj_parent_id, jbt.kod as ptj_kod_jabatan, jbt.nama as ptj_nama_jabatan, konf_ptj.parent_ptj_id, 
        konf_ptj.parent_hq_id, profile_konf_ptj.*, profile_ptj_role.tarikh_tamat, profile_ptj_role.id as ppr_id, konf_role.name as role_name');
        $this->db->from('profile_konf_ptj');
        $this->db->join('konf_ptj', 'konf_ptj.id = profile_konf_ptj.konf_ptj_id');
        $this->db->join('konf_ptj jbt', 'konf_ptj.parent_ptj_id = jbt.id');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id', 'left');
        $this->db->join('konf_role', 'konf_role.id = profile_ptj_role.konf_role_id');
        $this->db->where('profile_konf_ptj.user_id', $id);
        $this->db->where('profile_konf_ptj.tarikh_kuatkuasa_mula <= ', date('Y-m-d'));
        $this->db->group_start();
        $this->db->or_where('profile_konf_ptj.tarikh_kuatkuasa_hingga IS NULL');
        $this->db->or_where('profile_konf_ptj.tarikh_kuatkuasa_hingga >= ', date('Y-m-d'));
        $this->db->group_end();

        $this->db->where('(profile_ptj_role.is_active = 1 OR profile_ptj_role.is_active IS NULL)');
        $this->db->where('(profile_ptj_role.soft_delete = 0 OR profile_ptj_role.soft_delete IS NULL)');
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $query = $this->db->get();

        if ($query !== false) {

            return $query->result();
        } else {
            return false;
        }
    }

    public function get_ptj_by_profile_and_ptj($profileid, $ptjid, $pkp_id = null)
    {
        $this->db->select('konf_ptj.level as ptj_level, konf_ptj.id as ptj_id, konf_ptj.kod as ptj_kod, konf_ptj.nama as ptj_nama,
        jbt.kod as ptj_kod_jabatan, jbt.nama as ptj_nama_jabatan, jbt.id as parent_ptj_id, konf_ptj.parent_hq_id, profile_konf_ptj.*, konf_role.name as role_name');
        $this->db->from('profile_konf_ptj');
        $this->db->join('konf_ptj', 'konf_ptj.id = profile_konf_ptj.konf_ptj_id');
        $this->db->join('konf_ptj jbt', 'jbt.id = konf_ptj.parent_ptj_id');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id', 'left');
        $this->db->join('konf_role', 'konf_role.id = profile_ptj_role.konf_role_id');
        $this->db->where('profile_konf_ptj.user_id', $profileid);
        $this->db->where('profile_konf_ptj.konf_ptj_id', $ptjid);

        // added line for safe measure. If other has been using this function will not affected
        if (!empty($pkp_id)) $this->db->where('profile_konf_ptj.id', $pkp_id);

        $this->db->where('profile_konf_ptj.tarikh_kuatkuasa_mula <= ', date('Y-m-d'));
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $this->db->group_start();
        $this->db->or_where('profile_konf_ptj.tarikh_kuatkuasa_hingga IS NULL');
        $this->db->or_where('profile_konf_ptj.tarikh_kuatkuasa_hingga >= ', date('Y-m-d'));
        $this->db->group_end();
        $query = $this->db->get();
        if ($query !== false) {
            return $query->row_object();
        } else {
            return false;
        }
    }

    #region Kod Objek
    public function getdt_objek($where = array(), $returnMethod = "")
    {
        $this->db->select('konf_kod_objek.id, konf_kod_objek.kod, konf_kod_objek.definisi,konf_kod_objek.parent_id, konf_kod_objek.is_active, konf_kod.kod as jenis_kod_objek');
        $this->db->from('konf_kod_objek');
        $this->db->where('konf_kod_objek.soft_delete', 0);
        $this->db->join("konf_kod", "konf_kod.id = konf_kod_objek.jenis_kod_objek");

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        $query = $this->db->get();

        return ($returnMethod) ? $query->$returnMethod() : $query->result();
    }

    public function getdt_objek_kemaskini($where = array(), $returnMethod = "")
    {
        $this->db->select('konf_kod_objek.id, konf_kod_objek.kod, konf_kod_objek.definisi, konf_kod_objek.keterangan, konf_kod_objek.parent_id, konf_kod_objek.is_active, konf_kod_objek.jenis_kod_objek');
        $this->db->from('konf_kod_objek');
        $this->db->where('konf_kod_objek.soft_delete', 0);
        $this->db->join("konf_kod", "konf_kod.id = konf_kod_objek.jenis_kod_objek");

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        $query = $this->db->get();

        return ($returnMethod) ? $query->$returnMethod() : $query->result();
    }

    public function objek_insert($post)
    {
        $this->db->trans_begin();

        $data = array(
            'kod' => $post['kod'],
            'definisi' => $post['definisi'],
            'keterangan' => $post['keterangan'],
            'jenis_kod_objek' => $post['jenis_kod_objek'],
            'parent_id' => ($post['parent_id']) ? $post['parent_id'] : null,
            'is_active' => ($post['active']) ? 1 : 0,
        );

        $this->db->insert('konf_kod_objek', $data);
        $masterid = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return $masterid;
        }
    }
    #endregion Kod Objek

    public function get_profileroles_by_ptj($profilid, $ptjid)
    {
        $this->db->select('profile_ptj_role.*');
        $this->db->from('profile_ptj_role');
        $this->db->join('profile_konf_ptj', 'profile_konf_ptj.id = profile_ptj_role.profile_konf_ptj_id');

        $this->db->where('profile_konf_ptj.user_id', $profilid);
        $this->db->where('profile_konf_ptj.konf_ptj_id ', $ptjid);
        $this->db->where('profile_konf_ptj.is_active ', 1);
        $this->db->where('profile_konf_ptj.soft_delete ', 0);

        $query = $this->db->get();
        if ($query !== false) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function jabatan_get_all_active_data()
    {
        $this->db->from('konf_ptj');
        $this->db->where('jenis_ptj_id', 18);
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        // $this->db->order_by('kod_jabatan');
        $this->db->order_by('kod', 'asc');
        $query = $this->db->get();

        return $query->result_object();
    }

    function jabatan_get_all_data()
    {
        $this->db->from('konf_ptj');
        $this->db->where('jenis_ptj_id', 18);
        $this->db->where('soft_delete', 0);

        $this->db->order_by('kod_jabatan');
        $query = $this->db->get();
        return $query->result_object();
    }

    function ptj_get_all_data()
    {
        $this->db->select("kp.id, kp.kod, kp.nama");
        $this->db->from("konf_ptj as kj");
        $this->db->join('konf_ptj as kp', 'kp.parent_ptj_id = kj.id');

        $this->db->join('konf_ptj_vot as kp_vot', 'kp_vot.konf_ptj_id = kj.id AND kp_vot.is_active = 1');
        $this->db->group_by("kp.id");
        $this->db->order_by("kp.parent_ptj_id");

        // $this->db->from('konf_ptj');
        // $this->db->where('jenis_ptj_id',19);
        // $this->db->where('is_active',1);
        // $this->db->where('soft_delete',0);
        // $this->db->order_by('kod');
        $query = $this->db->get();
        return $query->result_object();
    }

    function ptj_get_all_active_data()
    {
        $this->db->select("kp.id, kp.kod, kp.nama");
        $this->db->from("konf_ptj as kj");
        $this->db->join('konf_ptj as kp', 'kp.parent_ptj_id = kj.id');

        $this->db->join('konf_ptj_vot as kp_vot', 'kp_vot.konf_ptj_id = kj.id AND kp_vot.is_active = 1');
        $this->db->where("kj.soft_delete", 0);
        $this->db->where("kj.is_active", 1);
        $this->db->where("kp.soft_delete", 0);
        $this->db->where("kp.is_active", 1);
        $this->db->group_by("kp.id");
        $this->db->order_by("kp.parent_ptj_id");

        // $this->db->from('konf_ptj');
        // $this->db->where('jenis_ptj_id',19);
        // $this->db->where('is_active',1);
        // $this->db->where('soft_delete',0);
        // $this->db->order_by('kod');
        $query = $this->db->get();
        return $query->result_object();
    }

    function ptj_for_jabatan_pelaksana()
    {
        $this->db->select("kp.id, kp.kod, kp.nama");
        $this->db->from("konf_ptj as kj");
        $this->db->join('konf_ptj as kp', 'kp.parent_ptj_id = kj.id');

        // $this->db->join('konf_ptj_vot as kp_vot', 'kp_vot.konf_ptj_id = kj.id AND kp_vot.is_active = 1');
        $this->db->where("kj.soft_delete", 0);
        $this->db->where("kj.is_active", 1);
        $this->db->where("kp.soft_delete", 0);
        $this->db->where("kp.is_active", 1);
        $this->db->group_by("kp.id");
        $this->db->order_by("kp.kod");

        // $this->db->from('konf_ptj');
        // $this->db->where('jenis_ptj_id',19);
        // $this->db->where('is_active',1);
        // $this->db->where('soft_delete',0);
        // $this->db->order_by('kod');
        $query = $this->db->get();
        return $query->result_object();
    }

    function ptj_get_by_ptj_parent_id($ptj_parent_id = '', $vot = true)
    {
        $this->db->select("kp.id, kp.kod, kp.nama, kp.nama_jabatan, kp.parent_ptj_id, kj.parent_hq_id");
        $this->db->from("konf_ptj as kj");
        $this->db->join('konf_ptj as kp', 'kp.parent_ptj_id = kj.id');
        if ($vot === true)
            $this->db->join('konf_ptj_vot as kp_vot', 'kp_vot.konf_ptj_id = kj.id AND kp_vot.is_active = 1');
        $this->db->where_in("kp.parent_ptj_id", $ptj_parent_id);
        $this->db->where("kj.soft_delete", 0);
        $this->db->where("kj.is_active", 1);
        $this->db->where("kp.soft_delete", 0);
        $this->db->where("kp.is_active", 1);
        $this->db->group_by("kp.id");
        $this->db->order_by("kp.parent_ptj_id");

        $query = $this->db->get();
        return $query->result_object();
    }

    function ptj_hq_get_by_ptj_parent_id($ptj_parent_id = '', $vot = true)
    {
        $this->db->select("kp.id, kp.kod, kp.nama, kp.nama_jabatan, kp.parent_ptj_id, kj.parent_hq_id");
        $this->db->from("konf_ptj as kj");
        $this->db->join('konf_ptj as kp', 'kp.parent_ptj_id = kj.id');
        if ($vot === true)
            $this->db->join('konf_ptj_vot as kp_vot', 'kp_vot.konf_ptj_id = kj.id AND kp_vot.is_active = 1');
        $this->db->where_in("kp.parent_ptj_id", $ptj_parent_id);
        $this->db->where("kj.soft_delete", 0);
        $this->db->where("kj.is_active", 1);
        $this->db->where("kp.soft_delete", 0);
        $this->db->where("kp.is_active", 1);
        $this->db->where("kp.parent_hq_id is null");
        $this->db->group_by("kp.id");
        $this->db->order_by("kp.parent_ptj_id");

        $query = $this->db->get();
        //		pr($query);
        return $query->row();
    }

    function ptj_get_by_ptj_id($ptj_id, $rtn = 'result_object')
    {
        $this->db->select("kp.id, kp.kod, kp.nama, kp.nama_jabatan, kp.parent_ptj_id, kp.level, kp.jenis_ptj_id");
        $this->db->from("konf_ptj as kj");
        $this->db->join('konf_ptj as kp', 'kp.parent_ptj_id = kj.id');

        $this->db->join('konf_ptj_vot as kp_vot', 'kp_vot.konf_ptj_id = kj.id AND kp_vot.is_active = 1');
        $this->db->where_in("kp.id", $ptj_id);
        $this->db->where("kj.soft_delete", 0);
        $this->db->where("kj.is_active", 1);
        $this->db->where("kp.soft_delete", 0);
        $this->db->where("kp.is_active", 1);
        $this->db->group_by("kp.id");
        $this->db->order_by("kp.parent_ptj_id");

        $query = $this->db->get();

        return $query->$rtn();
    }

    function ptj_get_by_ptj_parent_id_bylevel($ptj_parent_id = '', $vot = true)
    {
        $this->db->select("kp.id, kp.kod, kp.nama, kp.nama_jabatan, kp.parent_ptj_id, kj.parent_hq_id");
        $this->db->from("konf_ptj as kj");
        $this->db->join('konf_ptj as kp', 'kp.parent_ptj_id = kj.id');
        if ($vot === true)
            $this->db->join('konf_ptj_vot as kp_vot', 'kp_vot.konf_ptj_id = kj.id AND kp_vot.is_active = 1');
        $this->db->where_in("kp.parent_ptj_id", $ptj_parent_id);
        $this->db->where("kj.level < kp.level");
        $this->db->where("kj.soft_delete", 0);
        $this->db->where("kj.is_active", 1);
        $this->db->where("kp.soft_delete", 0);
        $this->db->where("kp.is_active", 1);
        $this->db->group_by("kp.id");
        $this->db->order_by("kp.parent_ptj_id");

        $query = $this->db->get();
        return $query->result_object();
    }

    function ptj_get_by_ptj_vot($kod_vot, $rtn = 'result_object')
    {
        $this->db->select("kp.id, kp.kod, kp.nama, kp.nama_jabatan, kp.parent_ptj_id, kp.level, kp.jenis_ptj_id");
        $this->db->from("konf_ptj as kj");
        $this->db->join('konf_ptj as kp', 'kp.parent_ptj_id = kj.id');

        $this->db->join('konf_ptj_vot as kp_vot', 'kp_vot.konf_ptj_id = kj.id AND kp_vot.is_active = 1');
        $this->db->where("kp_vot.id", $kod_vot);
        $this->db->where("kj.soft_delete", 0);
        $this->db->where("kj.is_active", 1);
        $this->db->where("kp.soft_delete", 0);
        $this->db->where("kp.is_active", 1);
        $this->db->group_by("kp.id");
        $this->db->order_by("kp.parent_ptj_id");

        $query = $this->db->get();

        return $query->$rtn();
    }

    function pbt_get_all_active_data()
    {
        $this->db->from('konf_pbt_glc');
        $this->db->where('is_pbt', 1);
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        // $this->db->order_by('kod');
        $query = $this->db->get();
        return $query->result_object();
    }

    function agensi_get_all_active_data()
    {
        $this->db->from('konf_pbt_glc');
        $this->db->where('is_pbt', 0);
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        // $this->db->order_by('kod');
        $query = $this->db->get();
        return $query->result_object();
    }

    function unit_get_all_active_data()
    {
        $this->db->from('konf_unit');
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        // $this->db->order_by('kod');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function getdt_profilpnj($return_type)
    {
        // Main Table
        $this->db->from('profile');
        $this->db->join('konf_unit', 'konf_unit.id = profile.konf_unit_id');

        if ($return_type != "count_all_data") {
            //for listing carian
            if ($this->input->post('nama')) {
                $this->db->like('profile.name', $this->input->post('nama'));
            }
            if ($this->input->post('unit')) {
                $this->db->where('konf_unit.id', $this->input->post('unit'));
            }
        }

        $this->db->where('profile.konf_unit_id !=', NULL);
        $this->db->where('profile.is_active', 1);
        $this->db->where('profile.soft_delete', 0);

        //check by type for return
        if ($return_type == "get_all_data") {
            $this->db->select('profile.id as profilid, profile.name as profilnama, konf_unit.nama as unitnama');

            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('count(profile.id) as total');
            return $this->db->get()->row()->total;
        }
    }

    public function getall_staff_by_unit($unit_id)
    {
        $this->db->select('id, name');
        $this->db->from('profile');
        $this->db->where('konf_unit_id', $unit_id);
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $this->db->order_by('name');
        $query = $this->db->get();
        return $query->result_object();
    }

    function getall_vot_by_ptj($ptjid)
    {
        $this->db->select('id, kod_vot');
        $this->db->from('konf_ptj_vot');
        $this->db->order_by('jenis');
        $this->db->where('konf_ptj_id', $ptjid);
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    function get_konf_ptj_vot($filter_by = array())
    {
        $this->db->select('id, kod_vot');
        $this->db->from('konf_ptj_vot');
        $this->db->order_by('jenis');
        // $this->db->where('konf_ptj_id',$ptjid);
        if (count($filter_by) > 0) {
            foreach ($filter_by as $filter_name => $filter_val) {
                $this->db->where($filter_name, $filter_val);
            }
        }
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_konf_kod_projek($filter_by = array())
    {
        $this->db->select('konf_kod_projek.id as konf_kod_projek_id, konf_ptj_vot.id as konf_ptj_vot_id, kod_vot_id, kod_projek, konf_kod_projek.keterangan as projek_keterangan, konf_ptj_vot.keterangan as ptj_vot_keterangan');
        $this->db->from('konf_kod_projek');
        $this->db->join('konf_ptj_vot', 'konf_ptj_vot.id = konf_kod_projek.kod_vot_id', 'left');
        $this->db->order_by('kod_projek ASC');
        // $this->db->where('konf_ptj_id',$ptjid);
        if (count($filter_by) > 0) {
            foreach ($filter_by as $filter_name => $filter_val) {
                $this->db->where($filter_name, $filter_val);
            }
        }
        $this->db->where('konf_kod_projek.is_active', 1);
        $this->db->where('konf_kod_projek.soft_delete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    // TODO: DUMMY FOR NOW
    function getall_vot_by_ptj_by_jenis($jenis = [1, 2, 3])
    {
        $this->db->select('id, kod_vot, keterangan');
        $this->db->from('konf_ptj_vot');

        if (is_array($jenis)) {
            $this->db->where_in('jenis', $jenis);
        } else {
            $this->db->where('jenis', $jenis);
        }

        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $this->db->order_by('kod_vot');

        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_ptj_jbt_pegawai($ptj_id)
    {
        $this->db->select('konf_ptj.kod, konf_ptj.nama, jbt.nama as nama_jbt, jbt.kod as kod_jbt,
        jbt.pegawai_pengawal as pegawai_pengawal_nama');
        $this->db->from('konf_ptj');
        $this->db->join('konf_ptj jbt', 'jbt.id = konf_ptj.parent_ptj_id');
        // $this->db->join('pegawai_pengawal pp', 'pp.id = pegawai_pengawal_id');
        $this->db->where('konf_ptj.id', $ptj_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_ptj_jbt($jbt_id)
    {
        $this->db->select('pegawai_pengawal as pegawai_pengawal_nama');
        $this->db->from('konf_ptj');
        // $this->db->join('pegawai_pengawal pp', 'pp.id = pegawai_pengawal_id');
        $this->db->where('konf_ptj.id', $jbt_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_ptj_jbt2($ptj_id)
    {
        $this->db->select('pegawai_pengawal, no_tel, pegawai_pengawal.nama as pegawai_pengawal_name, pegawai_pengawal.id as pegawai_pengawal_id, konf_ptj.id as id');
        $this->db->from('konf_ptj');
        $this->db->join('pegawai_pengawal', 'pegawai_pengawal.konf_ptj_id = konf_ptj.id', 'left');
        $this->db->where('konf_ptj.id', $ptj_id);
        $this->db->order_by("pegawai_pengawal.id", "DESC");
        $query = $this->db->get();
        return $query->row();
    }

    public function get_senarai_konf_global($where = [], $rtnMethod = "")
    {
        $this->db->select('konf_kod.id, konf_kod.kod, konf_kod.kod_lain, konf_kod.keterangan, konf_kod.kategori, konf_kod.is_active');
        $this->db->from('konf_kod');

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        // $this->db->where('konf_kod.is_active',1);
        $this->db->where('konf_kod.soft_delete', 0)
            ->where('konf_kod.is_hide', 0);

        $query = $this->db->get();
        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }


    public function get_all_jenis_permohonan()
    {
        $this->db->select('id,nama');
        $this->db->from('konf_jenis_permohonan');
        $this->db->where('konf_jenis_permohonan.soft_delete', 0);
        $this->db->where('konf_jenis_permohonan.is_active', 1);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_senarai_kod_jabatan($where = [], $rtnMethod = "")
    {
        $this->db->select('konf_ptj.id as kp_id, konf_ptj.kod, konf_ptj.nama, konf_ptj.nama_jabatan, konf_ptj_vot.kod_vot, konf_ptj.jenis_ptj_id, konf_ptj.kod_jabatan,
         konf_kod.keterangan, konf_ptj.jawatankuasa_id, alamat.id as alamat_id, alamat.no_tel_1, alamat.no_faks, konf_ptj.is_active,
         alamat.alamat_1, alamat.alamat_2, alamat.alamat_3, alamat.alamat_4, alamat.poskod, alamat.bandar, alamat.daerah_id,
         pegawai_pengawal.nama as nama_pegawai, pegawai_pengawal.id as pegawai_id');
        $this->db->from('konf_ptj');
        $this->db->join('konf_kod', 'konf_kod.id = konf_ptj.jenis_ptj_id', 'left');
        $this->db->join('konf_ptj_vot', 'konf_ptj_vot.konf_ptj_id = konf_ptj.id', 'left');
        $this->db->join('konf_ptj_alamat', 'konf_ptj_alamat.konf_ptj_id = konf_ptj.id', 'left');
        $this->db->join('alamat', 'alamat.id = konf_ptj_alamat.alamat_id', 'left');
        $this->db->join('pegawai_pengawal', 'pegawai_pengawal.id = konf_ptj.pegawai_pengawal_id', 'left');


        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        // $this->db->where('konf_ptj.is_active',1);
        $this->db->where('konf_ptj.soft_delete', 0);
        // $this->db->where('konf_ptj_vot.soft_delete', 0);

        $query = $this->db->get();
        //        pr($query);
        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }

    public function get_senarai_kod_ptj($where = [], $rtnMethod = "")
    {
        $this->db->select('konf_ptj.id as kp_id, konf_ptj.kod, konf_ptj.nama, konf_ptj.nama_jabatan, konf_ptj.jenis_ptj_id, konf_ptj.kod_jabatan,
         konf_kod.keterangan, konf_ptj.jawatankuasa_id, alamat.id as alamat_id, alamat.no_tel_1, alamat.no_faks, 
         alamat.alamat_1, alamat.alamat_2, alamat.alamat_3, alamat.alamat_4, alamat.poskod, alamat.daerah_id, alamat.bandar,
         daerah_ptj.keterangan as daerah, konf_ptj.is_active, kod_aktiviti,konf_ptj.level, konf_ptj_alamat.daerah_id as lokasi_ptj');
        $this->db->from('konf_ptj');
        $this->db->join('konf_kod', 'konf_kod.id = konf_ptj.jenis_ptj_id', 'left');
        $this->db->join('konf_ptj_alamat', 'konf_ptj_alamat.konf_ptj_id = konf_ptj.id', 'left');
        $this->db->join('alamat', 'alamat.id = konf_ptj_alamat.alamat_id', 'left');
        $this->db->join('konf_kod daerah_ptj', 'daerah_ptj.id = alamat.daerah_id', 'left');

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        // $this->db->where('konf_ptj.is_active',1);
        $this->db->where('konf_ptj.soft_delete', 0);

        $query = $this->db->get();

        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }

    public function get_senarai_kod_ptj_id($where = [], $rtnMethod = "")
    {
        $ids = [];

        $this->db->select('konf_ptj.id as kp_id,');
        $this->db->from('konf_ptj');
        $this->db->join('konf_kod', 'konf_kod.id = konf_ptj.jenis_ptj_id');

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        // $this->db->where('konf_ptj.is_active',1);
        $this->db->where('konf_ptj.soft_delete', 0);

        $query = $this->db->get();
        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
        // foreach($query->result() as $key => $value)
        // {
        //     array_push($ids, $value->kp_id);
        // }

        // return $ids;
    }

    public function get_senarai_kod_jabatan2($where = [], $rtnMethod = "")
    {
        $this->db->select('konf_ptj.id as kp_id, konf_ptj.kod, konf_ptj.nama,
        konf_ptj.jenis_ptj_id, konf_kod.keterangan, konf_ptj.is_active, konf_ptj.kod_aktiviti');
        $this->db->from('konf_ptj');
        $this->db->join('konf_kod', 'konf_kod.id = konf_ptj.jenis_ptj_id');
        // $this->db->join('konf_ptj_vot', 'konf_ptj_vot.konf_ptj_id = konf_ptj.id and konf_ptj_vot.soft_delete = 0');

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        // $this->db->where('konf_ptj.is_active',1);
        $this->db->where('konf_ptj.soft_delete', 0);
        $this->db->where('konf_ptj.jenis_ptj_id', 18);
        //        $this->db->where('konf_ptj_vot.soft_delete', 0);
        $this->db->group_by('konf_ptj.id');

        $query = $this->db->get();
        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }

    public function get_senarai_gred_jawatan($where = [], $rtnMethod = "")
    {
        $this->db->select('konf_kod.id, konf_kod.kod as gred, konf_kod.keterangan as nama, konf_kod.klasifikasi_id, klasifikasi.keterangan as klasifikasi, 
        skim.keterangan as skim, konf_kod.skim_id, konf_kod.is_active');
        $this->db->from('konf_kod');
        $this->db->join('konf_kod klasifikasi', 'klasifikasi.id = konf_kod.klasifikasi_id and klasifikasi.kategori = "KLASIFIKASI_PERKHIDMATAN"', 'LEFT');
        $this->db->join('konf_kod skim', 'skim.id = konf_kod.skim_id and skim.kategori = "SKIM_PERKHIDMATAN"', 'LEFT');

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        $this->db->where('konf_kod.soft_delete', 0);
        $this->db->where('konf_kod.kategori', 'JAWATAN_HAKIKI');
        $this->db->order_by('konf_kod.kod');

        $query = $this->db->get();

        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }

    public function get_kod_jabatan()
    {
        $this->db->select("konf_ptj.kod");
        $this->db->from('konf_ptj');
        $this->db->where('konf_ptj.soft_delete', 0);
        $this->db->where('konf_ptj.is_active', 1);
        $this->db->where('konf_ptj.jenis_ptj_id', 18);

        $query = $this->db->get();
        $result = $query->result();

        $arr = [];

        foreach ($result as $key => $value) {
            array_push($arr, $value->kod);
        }

        return $arr;
    }

    // public function get_pegawai_pengawal()
    // {
    //     $this->db->select("pegawai_pengawal.nama, pegawai_pengawal.id");
    //     $this->db->from("fail_permohonan");
    //     $this->db->join("permohonan_pegawai_pengawal", "permohonan_pegawai_pengawal.fail_permohonan_id = fail_permohonan.id");
    //     $this->db->join("pegawai_pengawal", "pegawai_pengawal.id = permohonan_pegawai_pengawal.pegawai_pengawal_id");
    //     $this->db->where("fail_permohonan.status_semasa", 3);
    //     $this->db->group_by("pegawai_pengawal.nama");
    //     $this->db->order_by("pegawai_pengawal.id", "DESC");
    //     $query = $this->db->get();
    //     $result = $query->result();
    // }

    public function get_gred_jawatan()
    {
        $this->db->select("konf_jawatan.gred");
        $this->db->from('konf_jawatan');
        $this->db->where('konf_jawatan.soft_delete', 0);

        $query = $this->db->get();
        $result = $query->result();

        $arr = [];

        foreach ($result as $key => $value) {
            array_push($arr, $value->gred);
        }

        return $arr;
    }

    public function get_kod_ptj()
    {
        $this->db->select("konf_ptj.kod");
        $this->db->from('konf_ptj');
        $this->db->where('konf_ptj.soft_delete', 0);
        $this->db->where('konf_ptj.is_active', 1);
        $this->db->where('konf_ptj.jenis_ptj_id', 19);

        $query = $this->db->get();
        $result = $query->result();

        $arr = [];

        foreach ($result as $key => $value) {
            array_push($arr, $value->kod);
        }

        return $arr;
    }

    public function get_all_peranan()
    {
        $this->db->select('id,name');
        $this->db->from('konf_role');
        $this->db->where('konf_role.soft_delete', 0);
        $this->db->where('konf_role.is_active', 1);
        $this->db->order_by('name');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_senarai_kod_objek($where = [], $rtnMethod = "")
    {
        $this->db->select('konf_kod_objek.id, konf_kod_objek.kod, konf_kod_objek.definisi, konf_kod_objek.keterangan, konf_kod_objek.is_active,
        konf_kod_objek.jenis_kod_objek, konf_kod_objek.parent_id');
        if ($rtnMethod = "row_object") {
            $this->db->select('concat(parent.kod," ",parent.definisi) as parent_kod,case konf_kod_objek.jenis_kod_objek when 0 then "Objek Am" when 1 then "Objek Sebagai" when 2 then "Objek Kumpulan Lanjut"
            when 3 then "Objek Lanjut" end as jenis_kod_objek_nama', false);
            $this->db->join('konf_kod_objek parent', 'parent.id=konf_kod_objek.parent_id', 'left');
        }

        $this->db->from('konf_kod_objek');

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        $this->db->where('konf_kod_objek.soft_delete', 0);

        $query = $this->db->get();
        // pr($query);
        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }

    public function get_inserted_kod_objek()
    {
        $this->db->select('konf_kod_objek.id, konf_kod_objek.kod');
        $this->db->from('konf_kod_objek');
        $this->db->where('konf_kod_objek.soft_delete', 0);
        $query = $this->db->get();
        $result = $query->result();
        $arr = [];

        foreach ($result as $key => $value) {
            // array_push($arr, $value->kod);
            $arr[$value->kod] = $value->id;
        }

        return $arr;
        // return $result;
    }

    public function get_kod_objek($jenis)
    {
        $this->db->select('konf_kod_objek.id, konf_kod_objek.kod, konf_kod_objek.definisi');
        $this->db->from('konf_kod_objek');
        $this->db->where('konf_kod_objek.jenis_kod_objek', $jenis);
        $this->db->where('konf_kod_objek.soft_delete', 0);
        $this->db->where('konf_kod_objek.is_active', 1);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_kod_objek_by_kod($data)
    {
        $this->db->select('konf_kod_objek.id, konf_kod_objek.kod, konf_kod_objek.definisi');
        $this->db->from('konf_kod_objek');
        $this->db->where_in("konf_kod_objek.kod", $data);
        $this->db->where('konf_kod_objek.soft_delete', 0);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_parent_kod_objek($id)
    {
        $this->db->select('parent.kod');
        $this->db->from('konf_kod_objek');
        $this->db->join('konf_kod_objek parent', 'parent.id = konf_kod_objek.parent_id');
        $this->db->where('konf_kod_objek.id', $id);
        $this->db->where('konf_kod_objek.soft_delete', 0);
        $query = $this->db->get();
        $result = $query->row_object();
        return $result;
    }

    public function nested_get_senarai_kod_objek($jenis, $id = "")
    {
        $objek = [];

        if ($jenis == 0) {
            $this->db->select('*');
            $this->db->from('konf_kod_objek');
            if (!empty($id)) {
                $this->db->where('konf_kod_objek.id', $id);
            }
            $this->db->where('konf_kod_objek.jenis_kod_objek', 0);
            $this->db->where('konf_kod_objek.soft_delete', 0);
            $query = $this->db->get();
            $objek = $query->result();
        }

        if ($jenis != 0) {
            $this->db->select('*');
            $this->db->from('konf_kod_objek');
            $this->db->where('konf_kod_objek.parent_id', $id);
            $this->db->where('konf_kod_objek.soft_delete', 0);
            $query = $this->db->get();
            $objek = $query->result();
        }

        return $objek;
    }

    public function get_senarai_kod_objek3($post, $rtnMethod = "")
    {
        $this->db->select('*');
        $this->db->from('konf_kod_objek');
        if (!empty($post['kod_objek'])) {
            $this->db->like('konf_kod_objek.kod', $post['kod_objek']);
        }

        if (!empty($post['keterangan'])) {
            $this->db->like('konf_kod_objek.definisi', $post['keterangan']);
        }

        if (isset($post['status'])) {
            $this->db->like('konf_kod_objek.is_active', $post['status']);
        }

        //        if (!empty($am)) {
        //            $this->db->where('TRUNCATE(konf_kod_objek.kod, -4) =', $am);
        //        }
        //        if (!empty($sbg)) {
        //            $this->db->where('TRUNCATE(konf_kod_objek.kod, -3) =', $sbg);
        //        }
        //        if (!empty($kump)) {
        //            $this->db->where('TRUNCATE(konf_kod_objek.kod, -2) =', $kump);
        //        }
        //        if (!empty($lanjut)) {
        //            $this->db->where('konf_kod_objek.kod', $lanjut);
        //        }
        $this->db->where('konf_kod_objek.soft_delete', 0);

        if ($rtnMethod != "num_rows") {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();

        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }


    function getall_ptj_by_jab($jabid)
    {
        $this->db->select('id, kod, nama');
        $this->db->from('konf_ptj');
        $this->db->group_start();
        $this->db->where('parent_ptj_id', $jabid);
        // $this->db->or_where('id', $jabid);
        $this->db->group_end();
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    function getall_ptj_by_jab2($jabid)
    {
        $this->db->select('id, kod, nama');
        $this->db->from('konf_ptj');
        $this->db->group_start();
        $this->db->where('parent_ptj_id', $jabid);
        $this->db->group_end();
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function count_pnj_user($rtnMethod = "num_rows")
    {
        $this->db->select('users.username, users.name, users.email, users.is_active, users.id');
        $this->db->group_by('users.id');
        $this->db->from('users');
        // $this->db->join('users', 'users.profile_id = profile.id');
        $this->db->join('profile_konf_ptj', 'profile_konf_ptj.user_id = users.id');
        $this->db->where('profile_konf_ptj.konf_ptj_id', 73);
        $this->db->where('users.is_active', 1);
        $this->db->where('users.soft_delete', 0);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $query = $this->db->get();
        return $query->$rtnMethod();
    }

    public function count_ptj_user($rtnMethod = "num_rows")
    {
        $this->db->select('users.username, users.name, users.email, users.is_active, users.id');
        $this->db->from('users');
        // $this->db->join('users', 'users.profile_id = profile.id');
        $this->db->join('profile_konf_ptj', 'profile_konf_ptj.user_id = users.id');
        $this->db->join('konf_ptj', 'konf_ptj.id = profile_konf_ptj.konf_ptj_id');
        $this->db->join('konf_kod', 'konf_kod.id = konf_ptj.jenis_ptj_id');
        $this->db->where('konf_kod.id', 19);
        $this->db->where('users.is_active', 1);
        $this->db->where('users.soft_delete', 0);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $this->db->group_by('users.id');
        $query = $this->db->get();
        return $query->$rtnMethod();
    }

    public function count_ptj($rtnMethod = "num_rows")
    {
        $this->db->from('konf_ptj');
        $this->db->join('konf_ptj_vot', 'konf_ptj_vot.konf_ptj_id = konf_ptj.id');
        $this->db->where('konf_ptj.is_active', 1);
        $this->db->where('konf_ptj.soft_delete', 0);
        $query = $this->db->get();
        return $query->$rtnMethod();
    }

    public function get_vot_by_ptj_id($id)
    {
        $this->db->select('konf_ptj_vot.kod_vot');
        $this->db->from('konf_ptj_vot');
        $this->db->where('konf_ptj_vot.konf_ptj_id', $id);
        $this->db->where('konf_ptj_vot.is_active', 1);
        $this->db->where('konf_ptj_vot.soft_delete', 0);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_vot_by_ptj_id_jenis($id, $jenis)
    {
        $this->db->select('konf_ptj_vot.kod_vot');
        $this->db->from('konf_ptj_vot');
        $this->db->where('konf_ptj_vot.konf_ptj_id', $id);
        $this->db->where('konf_ptj_vot.jenis', $jenis);
        $this->db->where('konf_ptj_vot.is_active', 1);
        $this->db->where('konf_ptj_vot.soft_delete', 0);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_senarai_audit_trail($return_type)
    {
        $this->db->select('audit_trail.id, kod_audit.kod_nama, users.username, audit_trail.description, 
        date_format(audit_trail.created_date, "%d-%m-%Y  %H:%i:%s") as created_date,profile_konf_ptj.konf_ptj_id');
        $this->db->from('audit_trail');
        $this->db->join('users', 'users.id = audit_trail.users_id');
        $this->db->join('profile_konf_ptj', 'profile_konf_ptj.user_id = users.id and profile_konf_ptj.is_active = 1 and profile_konf_ptj.soft_delete = 0');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id and profile_ptj_role.is_active = 1 and profile_ptj_role.soft_delete = 0 ');
        $this->db->join('kod_audit', 'kod_audit.id = audit_trail.kod_audit_id');
        $ic = str_replace("-", "", $this->input->post('pengguna'));
        $ic2 = str_replace("_", "", $ic);

        if ($return_type != "count_all_data") {
            if ($this->input->post('pengguna')) {
                $this->db->like('users.username', $ic2);
            }
            if ($this->input->post('kategori_val')) {
                $this->db->where('kod_audit.id', $this->input->post('kategori'));
            }
            if ($this->input->post('tarikh_dari')) {
                $this->db->where('date_format(audit_trail.created_date, "%Y-%m-%d") >=', $this->input->post('tarikh_dari'));
            }
            if ($this->input->post('tarikh_hingga')) {
                $this->db->where('date_format(audit_trail.created_date, "%Y-%m-%d") <=', $this->input->post('tarikh_hingga'));
            }
            if ($this->input->post('ptj')) {
                $this->db->where('profile_konf_ptj.konf_ptj_id', $this->input->post('ptj'));
            }
            if ($this->input->post('modulval')) {
                $this->db->like('audit_trail.description', $this->input->post('modul'));
            }
            if ($this->input->post('submenuval')) {
                $this->db->like('audit_trail.description', $this->input->post('submenu'));
            }
            if ($this->input->post('data_sebelum')) {
                $this->db->like('audit_trail.before', $this->input->post('data_sebelum'));
            }
            if ($this->input->post('data_selepas')) {
                $this->db->like('audit_trail.after', $this->input->post('data_selepas'));
            }
            if ($this->input->post('no_rujukan')) {
                $this->db->like('audit_trail.description', $this->input->post('no_rujukan'));
            }
        }

        if ($return_type == "get_all_data") {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);

            $this->db->group_by("audit_trail.id");

            $this->db->order_by("audit_trail.created_date", "DESC");
            $query = $this->db->get();

            return $query->result_object();
        } else {
            $this->db->select('count(audit_trail.id) as total');
            return $this->db->get()->row()->total;
        }
    }

    public function get_audit_trail($return_type, $id)
    {
        $this->db->select('audit_trail.id, kod_audit.kod_nama, users.username, audit_trail.description, 
        date_format(audit_trail.created_date, "%d-%m-%Y %H:%i:%s") as created_date, audit_trail.before, audit_trail.after');
        $this->db->from('audit_trail');
        $this->db->join('users', 'users.id = audit_trail.users_id');
        $this->db->join('kod_audit', 'kod_audit.id = audit_trail.kod_audit_id');
        $this->db->where("audit_trail.id", $id);


        if ($return_type != "count_all_data") {
            if ($this->input->post('pengguna')) {
                $this->db->like('users.username', $this->input->post('pengguna'));
            }
        }
        if ($return_type == "get_all_data") {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);

            $this->db->order_by("audit_trail.created_date", "DESC");
            $query = $this->db->get();
            return $query->row_object();
        } else {
            $this->db->select('count(audit_trail.id) as total');
            return $this->db->get()->row()->total;
        }
    }

    #region START - Kod Vot
    public function get_kod_vot($rtnMethod = "", $where = [])
    {
        $this->db->select('vot.id, vot.konf_ptj_id, vot.konf_ptj_hq_id, vot.kod_vot, vot.keterangan, vot.is_active');
        $this->db->from('konf_ptj_vot vot');

        if ($rtnMethod == "result") {
            $this->db->select('kod as kod_jabatan, nama as jabatan, case when jenis = 1 then "Tanggungan"
            when jenis = 2 then "Bekalan" when jenis = 3 then "Pembangunan" end as jenis', false);
            $this->db->join('konf_ptj', 'vot.konf_ptj_id = konf_ptj.id');
        } else {
            $this->db->select('jenis');
        }

        foreach ($where as $key => $value) {
            if ($value != "") {
                if ($key == "kod_vot")
                    $this->db->like($key, $value);
                else
                    $this->db->where($key, $value);
            }
        }

        if ($rtnMethod != "num_rows") {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
        }

        $this->db->where('vot.soft_delete', 0);

        $query = $this->db->get();
        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }

    #endregion Kod Vot

    #region START - Kod Aktiviti
    public function get_kod_aktiviti($rtnMethod = "", $where = [], $group = "")
    {
        $this->db->select('kpa.id, kka.kod, kka.perihal, kpa.is_active');
        $this->db->from('konf_ptj_aktiviti kpa');
        $this->db->join('konf_kod_aktiviti kka', 'kka.id = kpa.kod_aktiviti_id ');
        $this->db->join('konf_ptj', 'konf_ptj.id = kpa.konf_ptj_id');
        // $this->db->join('konf_ptj jbt', 'jbt.id = konf_ptj.parent_ptj_id');

        if ($rtnMethod == "result") {
            $this->db->select('konf_ptj.nama as ptj');
        } else {
            $this->db->select('konf_ptj.id as konf_ptj_id');
        }

        foreach ($where as $key => $value) {
            if ($value != "") {
                if ($key == "kka.kod")
                    $this->db->like($key, $value);
                else
                    $this->db->where($key, $value);
            }
        }

        if ($rtnMethod != "num_rows") {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
        }

        $this->db->where('kpa.soft_delete', 0);

        if ($group != "") {
            $this->db->group_by($group);
        }

        $query = $this->db->get();

        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }

    public function get_kod_aktiviti_with_hq($rtnMethod = "", $where = [], $group = "")
    {
        $this->db->select('kpa.id, kka.kod, kka.perihal, kpa.is_active,kka.id as kka_id');
        $this->db->from('konf_ptj_aktiviti kpa');
        $this->db->join('konf_kod_aktiviti kka', 'kka.id = kpa.kod_aktiviti_id ');
        $this->db->join('konf_ptj', 'konf_ptj.id = kpa.konf_ptj_id OR konf_ptj.parent_hq_id = kpa.konf_ptj_id');
        //         $this->db->join('konf_ptj jbt', 'jbt.id = konf_ptj.parent_ptj_id');

        if ($rtnMethod == "result") {
            $this->db->select('konf_ptj.nama as ptj');
        } else {
            $this->db->select('konf_ptj.id as konf_ptj_id');
        }

        foreach ($where as $key => $value) {
            if ($value != "") {
                if ($key == "kka.kod")
                    $this->db->like($key, $value);
                else
                    $this->db->where($key, $value);
            }
        }

        if ($rtnMethod != "num_rows") {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
        }

        $this->db->where('kpa.soft_delete', 0);

        if ($group != "") {
            $this->db->group_by($group);
        }

        $query = $this->db->get();

        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }

    #endregion Kod Aktiviti

    #region START - Pegawai Pengawal
    public function get_pegawai_pengawal($rtnMethod = "", $where = [])
    {
        $this->db->select('konf_ptj.id, konf_ptj.nama, pp.nama as nama_pegawai_pengawal, pegawai_pengawal, pp.is_active as is_active,konf_ptj.pegawai_pengawal_is_active');
        $this->db->from('konf_ptj');
        $this->db->join('pegawai_pengawal pp', 'pp.id = konf_ptj.pegawai_pengawal_id', 'left');

        if ($rtnMethod == "result" || $rtnMethod == "num_rows") {
            $this->db->where('pegawai_pengawal is not null', null);
            $this->db->where('pegawai_pengawal !=', '');
        }

        foreach ($where as $key => $value) {
            if ($value != "") {
                if ($key == "pegawai_pengawal")
                    $this->db->like($key, $value);
                else
                    $this->db->where($key, $value);
            }
        }

        $this->db->where('jenis_ptj_id', 18);

        if ($rtnMethod != "num_rows") {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();

        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }

    #endregion Pegawai Pengawal

    #region START - Kod Projek Pembangunan
    public function get_kod_projek_pembangunan($rtnMethod = "", $where = [])
    {
        $this->db->select('kkp.id, kkp.keterangan as keterangan_projek, kkp.is_active,kkp.amaun_rj5t,kkp.tahun_dari,kkp.tahun_hingga');
        $this->db->from('konf_kod_projek kkp');

        if ($rtnMethod == "result") {
            $this->db->select('kkp.kod_projek, kod_vot');
        } else {
            $this->db->select('substr(kkp.kod_projek, 1, 2) as kod_projek_1, substr(kkp.kod_projek, 3, 4) as kod_projek_2, kod_vot_id, 
            konf_ptj_vot.kod_vot, konf_ptj_vot.keterangan');
        }
        $this->db->join('konf_ptj_vot', 'kkp.kod_vot_id = konf_ptj_vot.id');

        foreach ($where as $key => $value) {
            if ($value != "") {
                if ($key == "kod_projek")
                    $this->db->like($key, $value);
                else
                    $this->db->where($key, $value);
            }
        }

        if ($rtnMethod != "num_rows") {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
        }

        $this->db->where('kkp.soft_delete', 0);

        $query = $this->db->get();
        // pr($query);
        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }


    #endregion

    #region START - Muatnaik Baki Peruntukan
    public function get_muatnaik_baki_peruntukan($rtnMethod = "", $where = [])
    {
        $this->db->select('bp.id');
        $this->db->from('baki_peruntukan bp');

        if ($rtnMethod == "result") {
            $this->db->select('jabatan.nama as jabatan, kod_vot, ptj_bayar.nama as ptj_pembayar, ptj_tanggungjawab.nama as ptj_dipertanggungjawab, kka.kod, tarikh_kemaskini');
            $this->db->join('konf_ptj_vot', 'konf_ptj_vot.id = bp.kod_vot_id');
            $this->db->join('konf_ptj jabatan', 'jabatan.id = bp.jabatan_id');
            $this->db->join('konf_ptj ptj_bayar', 'ptj_bayar.id = bp.ptj_pembayar_id');
            $this->db->join('konf_ptj ptj_tanggungjawab', 'ptj_tanggungjawab.id = bp.ptj_dipertanggungjawab_id');
            $this->db->join('konf_kod_aktiviti kka', 'kka.id = bp.kod_aktiviti_id ', 'left');
        } else {
            $this->db->select('kod_vot_id, jabatan_id, ptj_pembayar_id, ptj_dipertanggungjawab_id, kod_aktiviti_id ');
        }

        foreach ($where as $key => $value) {
            if ($value != "") {
                $this->db->where($key, $value);
            }
        }

        if ($rtnMethod != "num_rows") {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
        }

        $this->db->where('bp.soft_delete', 0);
        $this->db->order_by('bp.tarikh_kemaskini desc');

        $query = $this->db->get();
        // pr($query);
        return ($rtnMethod) ? $query->$rtnMethod() : $query->result();
    }
    #endregion Muatnaik Baki Peruntukan

    public function get_ptj_byid($ptj_id)
    {
        $this->db->select('*');
        $this->db->from('konf_ptj');
        $this->db->where('id', $ptj_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_kategori_dasar($kategoriDasar)
    {

        $this->db->select('id,kod,definisi AS nama');
        $this->db->from('konf_kod_objek');
        $this->db->where('kategori_kod_objek', 2);
        $this->db->where('jenis_kod_objek', 1);
        if ($kategoriDasar == 183) {
            //one-off
            $objek_one_off = unserialize(OBJEK_ONE_OFF);
            $this->db->where_not_in('kod', $objek_one_off);
        } else if ($kategoriDasar == 184) {
            $objek_dasar_baru = unserialize(OBJEK_DASAR_BARU);
            //dasar Baru
            $this->db->where_not_in('kod', $objek_dasar_baru);
        } else {
            $objek_dasar_sedia_ada = unserialize(OBJEK_DASAR_BARU);
            //Dasar Sedia Ada
            $this->db->where_not_in('kod', $objek_dasar_sedia_ada);
        }
        $this->db->order_by('kod');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_kod_projek($id)
    {
        $this->db->select('konf_kod_projek.id, konf_kod_projek.kod_projek, konf_kod_projek.keterangan');
        $this->db->from('konf_kod_projek');
        $this->db->where('konf_kod_projek.id', $id);
        $this->db->where('konf_kod_projek.soft_delete', 0);
        $query = $this->db->get();
        $result = $query->row_object();

        return $result;
    }

    /**
     * get ptj parent
     */
    function getall_ptj_by_parent()
    {
        $this->db->select('id, kod, nama');
        $this->db->from('konf_ptj');
        $this->db->where("jenis_ptj_id", 18);
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $query = $this->db->get();
        return $query->result_object();
    }

    /**
     * get ptj parent
     */
    function getall_ptj_by_parent_by_kod($kod)
    {
        $this->db->select('id, kod, nama');
        $this->db->from('konf_ptj');
        $this->db->where("jenis_ptj_id", 18);
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $this->db->where('kod', $kod);
        $query = $this->db->get();
        return $query->row_object()->id;
    }

    /**
     * get ptj parent
     */
    function getall_ptj_by_kod($kod)
    {
        $this->db->select('id, kod, nama');
        $this->db->from('konf_ptj');
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $this->db->where('kod', $kod);
        $query = $this->db->get();
        return $query->row_object()->id;
    }

    function getall_ptj_by_nama($nama)
    {
        $this->db->select('id, kod, nama');
        $this->db->from('konf_ptj');
        $this->db->where('is_active', 1);
        $this->db->where('soft_delete', 0);
        $this->db->where('nama', $nama);
        $query = $this->db->get();
        return $query->row_object()->id;
    }


    /**
     * get ptj parent
     */
    function getall_ptj_by_parent_by_id($id, $vot = true)
    {
        $this->db->select('konf_ptj.id, konf_ptj.kod, konf_ptj.nama, konf_ptj.pegawai_pengawal');
        $this->db->from('konf_ptj');
        if ($vot === true)
            $this->db->join('konf_ptj_vot', 'konf_ptj_vot.konf_ptj_hq_id = konf_ptj.id');
        $this->db->where("konf_ptj.jenis_ptj_id", 19);
        $this->db->where('konf_ptj.is_active', 1);
        $this->db->where('konf_ptj.soft_delete', 0);
        $this->db->where('konf_ptj.parent_ptj_id', $id);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_status_option_by_wf($wf, $where_and = [])
    {
        $this->db->select('DISTINCT(kks.id), kks.keterangan');
        $this->db->from('konf_kod_status kks');
        $this->db->join('konf_urusan_flow kuf', 'kuf.konf_keputusan_id=kks.kod_lain');
        $this->db->join('konf_urusan', 'konf_urusan.id = kuf.konf_urusan_id');
        $this->db->where('kuf.is_active', 1);
        if (isset($where_and)) {
            foreach ($where_and as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        $this->db->where('kod_urusan', $wf);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * sorting ptj.
     */
    public function generate_konf_ptj_as_per_bajet($jenis)
    {

        $this->db->select("kpv.*, kp.kod as kod_ptj, kp.nama, kp.id as kp_id, kp.id as kptj_id, kp.pegawai_pengawal");
        $this->db->from("konf_ptj kp");
        $this->db->join("konf_ptj_vot kpv", "kpv.konf_ptj_id = kp.id", "left");
        $this->db->where("kp.jenis_ptj_id", 18);

        if (is_array($jenis)) {
            $this->db->where_in("kpv.jenis", $jenis);
        } else {
            $this->db->where("kpv.jenis", $jenis);
        }

        $this->db->where("kpv.is_active", 1);
        $this->db->where("kpv.soft_delete", 0);
        $this->db->order_by("kpv.jenis, kpv.kod_vot");
        $query = $this->db->get();

        $tmp_array = array();
        foreach ($query->result_object() as $key => $value) {
            $tmp_array["parent"][$value->kod_vot] = [
                'kod_vot_id' => $value->id,
                'ptj_id' => $value->kptj_id,
                'kod_vot' => $value->kod_vot,
                'keterangan' => $value->keterangan,
                'kod_ptj' => $value->kod_ptj,
                'nama' => $value->nama,
                'pegawai_pengawal' => $value->pegawai_pengawal,
            ];

            $child_object = $this->getall_ptj_by_parent_by_id($value->kp_id);

            if (!empty($child_object)) {
                foreach ($child_object as $kchild => $vchild) {
                    $tmp_array["parent"][$value->kod_vot]['child'][$vchild->id] = [
                        'ptj_id' => $vchild->id,
                        'kod_vot' => $value->kod_ptj,
                        'keterangan' => $value->keterangan,
                        'kod_ptj' => $vchild->kod,
                        'nama' => $vchild->nama,
                        'pegawai_pengawal' => $vchild->pegawai_pengawal,
                    ];
                }
            }
        }
        // pr($tmp_array);
        return $tmp_array;
    }

    public function generate_bajet_mengurus($year)
    {
        $this->db->select("bm.tahun, fp.konf_ptj_id, fp.status_semasa, bmo.objek, kko.definisi, bmo.parent_objek, bmo.parent_objek_nama, SUM(bmo.amaun) AS amaun, bmd.aktiviti_id, kka.kod as aktiviti_kod, kka.perihal");
        $this->db->from("fail_permohonan fp");
        $this->db->join("bajet_mengurus bm", "bm.fail_permohonan_id = fp.id", "inner");
        $this->db->join("bajet_mengurus_details bmd", "bmd.bajet_mengurus_id = bm.id", "inner");
        $this->db->join("bajet_mengurus_objek bmo", "bmo.bajet_mengurus_detail_id = bmd.id", "inner");
        $this->db->join("konf_kod_aktiviti kka", "kka.id = bmd.aktiviti_id");
        $this->db->join("konf_kod_objek kko", "kko.kod = bmo.objek");

        $this->db->where("fp.status_semasa", 3);
        $this->db->where("bm.tahun", $year);
        $this->db->group_by("fp.konf_ptj_id, bmo.objek, bmd.aktiviti_id");
        $this->db->order_by("kka.kod, bmo.objek");
        $query = $this->db->get();
        return $query->result_object();
    }

    public function generate_bajet_mengurus_new_new($year)
    {
        $this->db->select("bm.tahun, fp.konf_ptj_id, fp.status_semasa, bmo.objek, kko.definisi, bmo.parent_objek, bmo.parent_objek_nama, IF
	( SUM( mku.amaun_pindaan_anggaran_kemaskini ) > 0, SUM( mku.amaun_pindaan_anggaran_kemaskini ), SUM( mku.amaun_tahun_semasa_kemaskini ) ) AS amaun, bmd.aktiviti_id, kka.kod as aktiviti_kod, kka.perihal");
        $this->db->from("fail_permohonan fp");
        $this->db->join("bajet_mengurus bm", "bm.fail_permohonan_id = fp.id", "inner");
        $this->db->join("bajet_mengurus_details bmd", "bmd.bajet_mengurus_id = bm.id", "inner");
        $this->db->join("bajet_mengurus_objek bmo", "bmo.bajet_mengurus_detail_id = bmd.id", "inner");
        $this->db->join("konf_kod_aktiviti kka", "kka.id = bmd.aktiviti_id");
        $this->db->join("konf_kod_objek kko", "kko.kod = bmo.objek");
        //        $this->db->join("mesyuarat_kecil_belanjawan mkb", "mkb.konf_ptj_vot_id = bmd.kod_vot_id");
        $this->db->join("mesyuarat_kecil_belanjawan mkb", "mkb.konf_ptj_vot_id = bmd.kod_vot_id AND mkb.konf_kod_aktiviti_id = kka.id");

        $this->db->join("permohonan_mesyuarat_kecil pmk", "pmk.mesyuarat_kecil_belanjawan_id = mkb.id");
        $this->db->join("fail_permohonan fpm", "fpm.id = pmk.fail_permohonan_id");
        $this->db->join("mesyuarat_kecil_belanjawan_urus mku", "mku.mesyuarat_kecil_belanjawan_id = mkb.id AND kko.id = mku.konf_kod_objek_id");

        $this->db->where("fp.status_semasa", 3);
        $this->db->where("mkb.soft_delete", 0);
        $this->db->where("bm.tahun", $year);
        $this->db->group_by("fp.konf_ptj_id, bmo.objek, bmd.aktiviti_id");
        $this->db->order_by("kka.kod, bmo.objek");
        $query = $this->db->get();
        //        		pr($query);
        return $query->result_object();
    }

    public function generate_bajet_mengurus_new($year)
    {
        $this->db->select("mkb.tahun, kko.kod as objek, kko.definisi, IF
	( SUM( mku.amaun_pindaan_anggaran_kemaskini ) > 0, SUM( mku.amaun_pindaan_anggaran_kemaskini ), SUM( mku.amaun_tahun_semasa_kemaskini ) ) AS amaun, kka.id as aktiviti_id, kka.kod as aktiviti_kod, kka.perihal,kp.id as konf_ptj_id,kko2.kod as parent_objek");

        $this->db->from("mesyuarat_kecil_belanjawan mkb");
        $this->db->join("permohonan_mesyuarat_kecil pmk", "pmk.mesyuarat_kecil_belanjawan_id = mkb.id");
        $this->db->join("fail_permohonan fpm", "fpm.id = pmk.fail_permohonan_id");
        $this->db->join("mesyuarat_kecil_belanjawan_urus mku", "mku.mesyuarat_kecil_belanjawan_id = mkb.id");
        $this->db->join("konf_kod_aktiviti kka", "kka.id = mkb.konf_kod_aktiviti_id");
        $this->db->join("konf_kod_objek kko", "kko.id = mku.konf_kod_objek_id");
        $this->db->join('konf_ptj_vot as kp_vot', 'kp_vot.id = mkb.konf_ptj_vot_id');
        $this->db->join('konf_ptj as kj', 'kj.id = kp_vot.konf_ptj_id');
        $this->db->join('konf_ptj as kp', 'kp.parent_ptj_id = kj.id');
        $this->db->join('konf_kod_objek kko2', 'kko2.id = kko.parent_id');
        $this->db->where('kj.soft_delete', 0);
        $this->db->where('kj.is_active', 1);
        $this->db->where('kp.soft_delete', 0);
        $this->db->where('kp.is_active', 1);
        $this->db->where("kp.parent_hq_id is null");
        $this->db->where("fpm.soft_delete", 0);
        $this->db->where("fpm.status_semasa !=", 4);

        $this->db->where("mkb.soft_delete", 0);
        $this->db->where("mkb.tahun", $year);
        $this->db->group_by("konf_ptj_id, objek, mkb.konf_kod_aktiviti_id");
        $this->db->order_by("objek,konf_ptj_id,mkb.konf_kod_aktiviti_id");
        $query = $this->db->get();
        //        		pr($query);
        return $query->result_object();
    }


    public function generate_ringkasan_mengurus($data, $ptj_id, $year)
    {
        $this->db->select("bm.tahun, SUM(bmo.amaun) AS amaun, kka.kod as aktiviti_kod, kka.perihal");
        $this->db->from("fail_permohonan fp");
        $this->db->join("bajet_mengurus bm", "bm.fail_permohonan_id = fp.id", "inner");
        $this->db->join("bajet_mengurus_details bmd", "bmd.bajet_mengurus_id = bm.id", "inner");
        $this->db->join("bajet_mengurus_objek bmo", "bmo.bajet_mengurus_detail_id = bmd.id", "inner");
        $this->db->join("konf_kod_aktiviti kka", "kka.id = bmd.aktiviti_id");
        $this->db->join("konf_kod_objek kko", "kko.kod = bmo.objek");

        $this->db->where("fp.status_semasa", 3);
        if (!empty($ptj_id)) {
            $this->db->where_in("bm.konf_ptj_id", $ptj_id);
        }

        $this->db->where_in("bmo.objek", $data);
        $this->db->where("bm.tahun", $year);

        $query = $this->db->get();
        // if(in_array(93, $ptj_id))
        //     pr($query);
        return $query->row_array();
    }

    public function generate_ringkasan_mengurus_new($data, $ptj_id, $year)
    {
        $this->db->select("mkb.tahun, 	IF(SUM( mku.amaun_pindaan_anggaran_kemaskini ) > 0 ,SUM( mku.amaun_pindaan_anggaran_kemaskini ),SUM( mku.amaun_tahun_semasa_kemaskini )) as amaun, kka.kod as aktiviti_kod, kka.perihal");
        $this->db->from("fail_permohonan fp");
        $this->db->join("permohonan_mesyuarat_kecil pmk", "pmk.fail_permohonan_id = fp.id ", "inner");
        $this->db->join("mesyuarat_kecil_belanjawan mkb", "mkb.id = pmk.mesyuarat_kecil_belanjawan_id", "inner");
        $this->db->join("mesyuarat_kecil_belanjawan_urus mku", "mku.mesyuarat_kecil_belanjawan_id = mkb.id", "inner");
        $this->db->join("konf_ptj_vot kpv", "kpv.id = mkb.konf_ptj_vot_id");
        $this->db->join("konf_kod_aktiviti kka", "kka.id = mkb.konf_kod_aktiviti_id", "left");
        $this->db->join("konf_kod_objek kko", "kko.id = mku.konf_kod_objek_id");

        $this->db->where("fp.soft_delete", 0);
        if (!empty($ptj_id)) {
            $this->db->where_in("kpv.konf_ptj_id", $ptj_id);
        }
        $this->db->where_in("kko.kod", $data);
        $this->db->where("mkb.tahun", $year);

        $query = $this->db->get();
        // if(in_array(93, $ptj_id))
        return $query->row_array();
    }

    public function generate_ringkasan_mengurus_by_objek($year)
    {
        $this->db->select("bm.tahun, SUM(bmo.amaun) AS amaun, kka.kod as aktiviti_kod, kka.perihal,kko.kod");
        $this->db->from("fail_permohonan fp");
        $this->db->join("bajet_mengurus bm", "bm.fail_permohonan_id = fp.id", "inner");
        $this->db->join("bajet_mengurus_details bmd", "bmd.bajet_mengurus_id = bm.id", "inner");
        $this->db->join("bajet_mengurus_objek bmo", "bmo.bajet_mengurus_detail_id = bmd.id", "inner");
        $this->db->join("konf_kod_aktiviti kka", "kka.id = bmd.aktiviti_id");
        $this->db->join("konf_kod_objek kko", "kko.kod = bmo.objek");

        $this->db->where("fp.status_semasa", 3);

        $this->db->where("bm.tahun", $year);
        $this->db->group_by('kko.kod');

        $query = $this->db->get();
        // if(in_array(93, $ptj_id))
        //		     pr($query);
        return $query->result_array();
    }

    public function generate_ringkasan_mengurus_by_objek_new($year)
    {
        $this->db->select("mkb.tahun, 	IF(SUM( mku.amaun_pindaan_anggaran_kemaskini ) > 0 ,SUM( mku.amaun_pindaan_anggaran_kemaskini ),SUM( mku.amaun_tahun_semasa_kemaskini )) as amaun, kka.kod as aktiviti_kod, kka.perihal,kko.kod");
        $this->db->from("fail_permohonan fp");
        $this->db->join("permohonan_mesyuarat_kecil pmk", "pmk.fail_permohonan_id = fp.id", "inner");
        $this->db->join("mesyuarat_kecil_belanjawan mkb", "mkb.id = pmk.mesyuarat_kecil_belanjawan_id", "inner");
        $this->db->join("mesyuarat_kecil_belanjawan_urus mku", "mku.mesyuarat_kecil_belanjawan_id = mkb.id", "inner");
        $this->db->join("konf_ptj_vot kpv", "kpv.id = mkb.konf_ptj_vot_id");
        $this->db->join("konf_kod_aktiviti kka", "kka.id = mkb.konf_kod_aktiviti_id", "left");
        $this->db->join("konf_kod_objek kko", "kko.id = mku.konf_kod_objek_id");

        //		$this->db->where("fp.status_semasa", 3);
        $this->db->where("fp.soft_delete", 0);

        $this->db->where("mkb.tahun", $year);
        $this->db->group_by('kko.kod');

        $query = $this->db->get();
        // if(in_array(93, $ptj_id))
        return $query->result_array();
    }

    /**
     * sorting ptj.
     */
    public function generate_konf_ptj_as_per_bajet_mengurus($jenis)
    {

        $this->db->select("kpv.*, kp.kod as kod_ptj, kp.nama, kp.id as kp_id, kp.id as kptj_id, kp.pegawai_pengawal");
        $this->db->from("konf_ptj kp");
        $this->db->join("konf_ptj_vot kpv", "kpv.konf_ptj_id = kp.id", "left");
        $this->db->where("kp.jenis_ptj_id", 18);

        if (is_array($jenis)) {
            $this->db->where_in("kpv.jenis", $jenis);
        } else {
            $this->db->where("kpv.jenis", $jenis);
        }

        $this->db->where("kpv.is_active", 1);
        $this->db->where("kpv.soft_delete", 0);
        $this->db->order_by("kpv.jenis, kpv.kod_vot, kpv.id");
        $query = $this->db->get();

        $tmp_array = array();

        foreach ($query->result_object() as $key => $value) {
            $tmp_array["parent"][$value->id] = [
                'kod_vot_id' => $value->id,
                'ptj_id' => $value->kptj_id,
                'kod_vot' => $value->kod_vot,
                'keterangan' => $value->keterangan,
                'kod_ptj' => $value->kod_ptj,
                'nama' => $value->nama,
                'pegawai_pengawal' => $value->pegawai_pengawal,
            ];

            $child_object = $this->getall_ptj_by_parent_by_id_mengurus($value->kp_id);

            if (!empty($child_object)) {
                foreach ($child_object as $kchild => $vchild) {
                    $tmp_array["parent"][$value->id]['child'][$vchild->id] = [
                        'ptj_id' => $vchild->id,
                        'kod_vot' => $value->kod_ptj,
                        'keterangan' => $value->keterangan,
                        'kod_ptj' => $vchild->kod,
                        'nama' => $vchild->nama,
                        'pegawai_pengawal' => $vchild->pegawai_pengawal,
                    ];
                }
            }
        }
        //         pr($tmp_array);
        return $tmp_array;
    }

    /**
     * get ptj parent
     */
    function getall_ptj_by_parent_by_id_mengurus($id)
    {
        $this->db->select('konf_ptj.id, konf_ptj.kod, konf_ptj.nama, konf_ptj.pegawai_pengawal');
        $this->db->from('konf_ptj');
        // $this->db->join('konf_ptj_vot', 'konf_ptj_vot.konf_ptj_hq_id = konf_ptj.id');
        $this->db->where("konf_ptj.jenis_ptj_id", 19);
        $this->db->where('konf_ptj.is_active', 1);
        $this->db->where('konf_ptj.soft_delete', 0);
        $this->db->where('konf_ptj.parent_ptj_id', $id);
        $query = $this->db->get();
        return $query->result_object();
    }

    #region Start - Kod Lain
    function get_kod_lain_by_kod($kod)
    {
        $this->db->select('*');
        $this->db->from('konf_kod_objek');
        $this->db->where('konf_kod_objek.kod', $kod);
        $query = $this->db->get();

        return $query->row_object();
    }
    #endregion End - Kod Lain

    public function pengguna_get_ptj_role_by_pkp_id($pkp_id)
    {
        $this->db->select('profile_konf_ptj.konf_ptj_id');
        $this->db->from('profile_konf_ptj');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id');
        $this->db->join('konf_role', 'konf_role.id = profile_ptj_role.konf_role_id');
        $this->db->where('profile_ptj_role.is_active', 1);
        $this->db->where('profile_konf_ptj.id', $pkp_id);
        $query = $this->db->get();

        return $query->row_object();
    }

    public function get_checking_email($email)
    {
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function pengguna_get_ptj_role_akses_sementara($id)
    {
        $this->db->select('profile_ptj_role.*');
        $this->db->from('profile_konf_ptj');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id');
        $this->db->join('konf_role', 'konf_role.id = profile_ptj_role.konf_role_id');
        $this->db->where('profile_ptj_role.is_active', 1);
        $this->db->where('profile_ptj_role.soft_delete', 0);
        $this->db->where('profile_ptj_role.tarikh_tamat IS NOT NULL');
        $this->db->where('profile_konf_ptj.user_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_user_list_for_helpdesk()
    {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('soft_delete', 0);
        $this->db->where('is_active', 1);
        $query = $this->db->get();

        $tmp_array = [];
        foreach ($query->result_object() as $key => $value) {
            $tmp_array[$value->id] = $value->name;
        }

        return $tmp_array;
    }

    /**
     * for accessing user email from user access flow.
     * usage to sending email for processing file.
     */
    public function get_user_email_for_tindakan($flow_access_id)
    {

        $this->db->select("u.email");
        $this->db->from('profile_konf_ptj pkp');
        $this->db->join('users u', 'u.id = pkp.user_id');
        $this->db->where('pkp.soft_delete', 0);
        $this->db->where('pkp.is_active', 1);
        $this->db->where('pkp.konf_ptj_id', $this->session->ptj_id);
        $this->db->like('pkp.flow_access', $flow_access_id, 'both');
        $query = $this->db->get();

        return $query->result_object();
    }

    public function generate_konf_ptj_by_kod_vot($id)
    {

        $this->db->select("kpv.*, kp.kod as kod_ptj, kp.nama, kp.id as kp_id, kp.id as kptj_id, kp.pegawai_pengawal");
        $this->db->from("konf_ptj kp");
        $this->db->join("konf_ptj_vot kpv", "kpv.konf_ptj_id = kp.id", "left");
        //		$this->db->where("kp.jenis_ptj_id", 18);

        if (is_array($id)) {
            $this->db->where_in("kpv.id", $id);
        } else {
            $this->db->where("kpv.id", $id);
        }

        $this->db->where("kpv.is_active", 1);
        $this->db->where("kpv.soft_delete", 0);
        $this->db->order_by("kpv.jenis, kpv.kod_vot");
        $query = $this->db->get();

        $tmp_array = array();
        foreach ($query->result_object() as $key => $value) {
            $tmp_array["parent"][$value->kod_vot] = [
                'kod_vot_id' => $value->id,
                'ptj_id' => $value->kptj_id,
                'kod_vot' => $value->kod_vot,
                'keterangan' => $value->keterangan,
                'kod_ptj' => $value->kod_ptj,
                'nama' => $value->nama,
                'pegawai_pengawal' => $value->pegawai_pengawal,
            ];

            $child_object = $this->getall_ptj_by_parent_by_id_mengurus($value->kp_id);

            if (!empty($child_object)) {
                foreach ($child_object as $kchild => $vchild) {
                    $tmp_array["parent"][$value->kod_vot]['child'][$vchild->id] = [
                        'ptj_id' => $vchild->id,
                        'kod_vot' => $value->kod_ptj,
                        'keterangan' => $value->keterangan,
                        'kod_ptj' => $vchild->kod,
                        'nama' => $vchild->nama,
                        'pegawai_pengawal' => $vchild->pegawai_pengawal,
                    ];
                }
            }
        }
        // pr($tmp_array);
        return $tmp_array;
    }

    /**
     * get list of user sementara
     */
    public function get_id_sementara()
    {
        $this->db->select("u.*");
        $this->db->from('users u');
        $this->db->where('u.soft_delete', 0);
        $this->db->where('u.is_active', 1);
        $this->db->where('u.tarikh_tamat < ', date('Y-m-d'));

        $query = $this->db->get();
        return $query->result_object();
    }

    public function get_peranan_sementara()
    {
        $this->db->select('konf_ptj.level as ptj_level, konf_ptj.id as ptj_id, konf_ptj.kod as ptj_kod, konf_ptj.nama as ptj_nama,
        konf_ptj.parent_ptj_id as ptj_parent_id, jbt.kod as ptj_kod_jabatan, jbt.nama as ptj_nama_jabatan, konf_ptj.parent_ptj_id, 
        konf_ptj.parent_hq_id, profile_konf_ptj.*, profile_ptj_role.tarikh_tamat, profile_ptj_role.id as ppr_id, konf_role.name as role_name');
        $this->db->from('profile_konf_ptj');
        $this->db->join('konf_ptj', 'konf_ptj.id = profile_konf_ptj.konf_ptj_id');
        $this->db->join('konf_ptj jbt', 'konf_ptj.parent_ptj_id = jbt.id');
        $this->db->join('profile_ptj_role', 'profile_ptj_role.profile_konf_ptj_id = profile_konf_ptj.id', 'left');
        $this->db->join('konf_role', 'konf_role.id = profile_ptj_role.konf_role_id');


        $this->db->group_start();
        $this->db->or_where('profile_konf_ptj.tarikh_kuatkuasa_hingga IS NULL');
        $this->db->or_where('profile_konf_ptj.tarikh_kuatkuasa_hingga >= ', date('Y-m-d'));
        $this->db->group_end();
        $this->db->where('profile_konf_ptj.tarikh_kuatkuasa_mula <= ', date('Y-m-d'));
        $this->db->where('profile_ptj_role.tarikh_tamat <= ', date('Y-m-d'));

        $this->db->where('(profile_ptj_role.is_active = 1 OR profile_ptj_role.is_active IS NULL)');
        $this->db->where('(profile_ptj_role.soft_delete = 0 OR profile_ptj_role.soft_delete IS NULL)');
        $this->db->where('profile_konf_ptj.is_active', 1);
        $this->db->where('profile_konf_ptj.soft_delete', 0);
        $query = $this->db->get();

        if ($query !== false) {

            return $query->result();
        } else {
            return false;
        }
    }

    public function get_email_duplicate($email)
    {
        $this->db->from('users');
        $this->db->where('users.is_active', 1);
        $this->db->where('users.soft_delete', 0);
        $this->db->where('users.email', $email);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_id_duplicate($id)
    {
        $this->db->from('users');
        $this->db->where('users.is_active', 1);
        $this->db->where('users.soft_delete', 0);
        $this->db->where('users.username', $id);

        $query = $this->db->get();
        return $query->result();
    }

    function get_konf_kod_objek_map_abm7($filter_by = array())
    {
        $this->db->select('kko.*');
        $this->db->from('konf_kod_objek kko');
        $this->db->order_by('kko.kod ASC');

        if (count($filter_by) > 0) {
            foreach ($filter_by as $filter_name => $filter_val) {

                if (strpos($filter_name, 'IN') !== false) {
                    $filter_name = str_replace("IN", "", $filter_name);
                    $this->db->where_in($filter_name, $filter_val);
                } else {
                    $this->db->where($filter_name, $filter_val);
                }
            }
        }
        $this->db->where('kko.is_active', 1);
        $this->db->where('kko.soft_delete', 0);

        $query = $this->db->get();

        $temp_record = [];

        foreach ($query->result_object() as $key => $value) {
            $this->db->select('kko.*');
            $this->db->from('konf_kod_objek kko');
            $this->db->order_by('kko.kod ASC');

            $this->db->where('kko.parent_id', $value->id);
            $this->db->where('kko.is_active', 1);
            $this->db->where('kko.soft_delete', 0);

            $query2 = $this->db->get();

            $temp_record[$value->kod] = [
                'kod'           => $value->kod,
                'definisi'      => $value->definisi,
                'child_os'      => $query2->result_object(),
            ];
        }

        return $temp_record;
    }

    public function getFieldValue($tableName, $fieldName, $whereFieldName, $id)
    {
        $this->db->select($fieldName);
        $this->db->from($tableName);
        $this->db->where($whereFieldName, $id);

        $query = $this->db->get();
        return $query->row();
    }

    function get_ptj_hq_by_jab($id)
    {
        $this->db->select('*');
        $this->db->from('konf_ptj');
        $this->db->where('konf_ptj.parent_ptj_id', $id);
        $this->db->where('konf_ptj.parent_hq_id', null);

        $query = $this->db->get();

        return $query->row_object();
    }

    function get_ptj_under_hq($id)
    {
        $this->db->select('*');
        $this->db->from('konf_ptj');
        $this->db->where('konf_ptj.parent_hq_id', $id);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_senarai_pendaftaran_online()
    {
        $this->db->select("dio.*, kk.kod as jwtn_kod, kk.keterangan as jwtn, kk2.kod as gelaran_kod, kk2.keterangan as gelaran,u.username");
        $this->db->from("daftar_id_online dio");
        $this->db->join('users u', 'u.username = dio.no_kp_baru', 'left');
        $this->db->join('konf_kod kk', 'kk.id = dio.jawatan_hakiki_id AND kk.kategori="JAWATAN_HAKIKI"', 'left');
        $this->db->join('konf_kod kk2', 'kk2.id = dio.gelaran_jwtn_id AND kk2.kategori="GELARAN_JAWATAN"', 'left');

        $this->db->order_by('dio.approve_date', 'DESC');

        $query = $this->db->get();
        return $query->result_object();
    }
}

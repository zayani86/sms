<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}


/**
 * create asset url.
 */
if (!function_exists('assets_url()')) {
	function assets_url()
	{
		$ci = &get_instance();
		return base_url() . '/assets/themes/' . $ci->config->item('theme_version') . '/';
	}
}

/**
 * create upload url.
 */
if (!function_exists('image_url')) {
	function image_url()
	{
		return base_url() . '/uploads/';
	}
}

/**
 * create homepage url.
 */
if (!function_exists('homepage')) {
	function homepage()
	{
		return 'dashboard';
	}
}

if (!function_exists('activate_menu')) {
	function activate_menu($page_menu, $url_menu)
	{
		return ($page_menu == $url_menu) ? 'active pcoded-trigger' : '';
	}
}

if (!function_exists('activate_dashboard')) {
	function activate_dashboard()
	{
		$_ci = get_instance();
		$uri = $_ci->uri->segment(1);
		return ($uri == homepage()) ? 'active' : '';
	}
}

/**
 * get session name directly from session manager.
 */
if (!function_exists('get_session($session_name)')) {
	function get_session($session_name)
	{
		// Get a reference to the controller object
		$_ci = get_instance();
		return $_ci->session_manager->get_session($session_name);
	}
}

if (!function_exists('activate_modul')) {
	function activate_modul($page_modul, $url_modul)
	{
		return ($page_modul == $url_modul) ? 'active pcoded-trigger' : '';
	}
}

if (!function_exists('submenu_url')) {
	function submenu_url($menu_id)
	{
		return (!empty($menu_id)) ? '/' . $menu_id : '';
	}
}

if (!function_exists('trans($key)')) {
	function trans($key)
	{
		$_ci = get_instance();
		return $_ci->lang->line($key);
	}
}

if (!function_exists('url_akses')) {
	function url_akses()
	{
		$_ci = get_instance();
		$_ci->load->helper('url');
		if ($_ci->input->get('clc')) {
			return "?clm=" . $_ci->input->get('clm') . "&clp=" . $_ci->input->get('clp') . "&clc=" . $_ci->input->get('clc') . "&cli=" . $_ci->input->get('cli');
		} else {
			return "?clm=" . $_ci->input->get('clm') . "&clp=" . $_ci->input->get('clp') . "&cli=" . $_ci->input->get('cli');
		}
	}
}

if (!function_exists('set_url_akses')) {
	function set_url_akses($url)
	{
		$_ci = get_instance();
		$_ci->load->helper('url');
		if ($url['clp_2']) {
			return "?clm=" . $_ci->input->get('clm') . "&clp=" . $url['clp_2'] . "&clc=" . $url['clp_clc'] . "&cli=" . $url['cli'];
		} else {
			return "?clm=" . $_ci->input->get('clm') . "&clp=" . ($url['clp_clc'] != '' ? $url['clp_clc'] : $url['cli']) . "&cli=" . $url['cli'];
		}
	}
}

if (!function_exists('csrf_cookie_name')) {
	function csrf_cookie_name()
	{
		return "$.cookie('csrf_cookie_name')";
	}
}


if (!function_exists('get_menu_module')) {
	function get_menu_module($menu_id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_menu_by_id($menu_id);

		return $result->konf_module_id;
	}
}

if (!function_exists('get_konf_ptj_nama')) {
	function get_konf_ptj_nama($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_konf_ptj($id);

		return $result->nama;
	}
}

if (!function_exists('get_konf_jwtn_nama')) {
	function get_konf_jwtn_nama($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_kod_lain($id);

		return $result->kod . " - " . $result->keterangan;
	}
}

if (!function_exists('get_konf_gelaran_nama')) {
	function get_konf_gelaran_nama($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_kod_lain($id);

		return $result->keterangan;
	}
}

if (!function_exists('get_konf_modul_nama')) {
	function get_konf_modul_nama($id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_module_by_id($id);

		return $result->name;
	}
}

if (!function_exists('get_konf_unit')) {
	function get_konf_unit($id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_unit_by_id($id);
		return $result->nama;
	}
}


if (!function_exists('get_kod_pembekal_keterangan')) {
	function get_kod_pembekal_keterangan($id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_pembekal_by_id($id);
		return $result->nama;
	}
}

if (!function_exists('get_nama_bilik')) {
	function get_nama_bilik($id)
	{
		$_ci = get_instance();
		$_ci->load->model('pentadbiran/tempahan_bilik_model', 'tempahan_bilik_model');

		$result = $_ci->tempahan_bilik_model->get_nama_bilik_by_id($id);
		return $result->nama;
	}
}


if (!function_exists('valid_date')) {
	function valid_date($val)
	{
		if ($val) {
			return date('Y-m-d', strtotime($val));
		} else {
			return 	NULL;
		}
	}
}

if (!function_exists('status_rekodfail')) {
	function status_rekodfail($tkhbuka, $tkhtutup, $tkhlupus)
	{
		$status = '';
		if ($tkhlupus) {
			$status = 'Lupus';
		} elseif ($tkhtutup) {
			$status = 'Tutup';
		} elseif ($tkhbuka) {
			$status = 'Aktif';
		} else {
			$status = 'Tidak Dikenalpasti';
		}
		return $status;
	}
}

if (!function_exists('dt_status_rekodfail')) {
	function dt_status_rekodfail($tkhbuka, $tkhtutup, $tkhlupus)
	{
		$statusname = '';
		if ($tkhlupus) {
			$statusname = 'Lupus';
			$bgclass = 'danger';
		} elseif ($tkhtutup) {
			$statusname = 'Tutup';
			$bgclass = 'warning';
		} elseif ($tkhbuka) {
			$statusname = 'Aktif';
			$bgclass = 'success';
		} else {
			$statusname = 'Tidak Dijumpai';
			$bgclass = 'info';
		}
		return '<span class="bg-' . $bgclass . ' p-l-5 p-r-5 ">' . $statusname . '</span>';
	}
}

if (!function_exists('status_penerimaan_surat')) {
	function status_penerimaan_surat($val)
	{
		$status = '';
		if ($val == 1) {
			$status = 'Telah Dibaca';
			$bgclass = 'success';
		} else {
			$status = 'Baru';
			$bgclass = 'danger';
		}
		return '<span class="bg-' . $bgclass . ' p-l-5 p-r-5 ">' . $status . '</span>';
	}
}

if (!function_exists('get_konf_kod_keterangan')) {
	function get_konf_kod_keterangan($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_kod_lain($id);

		return $result->keterangan;
	}
}

if (!function_exists('get_konf_kod_kod')) {
	function get_konf_kod_kod($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_kod_lain($id);

		return $result->kod;
	}
}

if (!function_exists('get_konf_kod_object_keterangan')) {
	function get_konf_kod_object_keterangan($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_kod_objeck($id);

		return $result->definisi;
	}
}

if (!function_exists('get_konf_ptj_kod')) {
	function get_konf_ptj_kod($id, $flag = true)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_kod_ptj_vot($id);

		if ($flag) {
			return $result->kod_vot;
		} else {
			return $result->kod_vot . " - " . $result->keterangan;
		}
	}
}

if (!function_exists('show_button_by_status_semasa')) {
	function show_button_by_status_semasa($wf_failid)
	{
		$_ci = get_instance();
		$_ci->load->model('workflow_model');

		$wf_status = $_ci->workflow_model->get_fp_status_semasa($wf_failid1);
		$view = false;
		if (!empty($wf_status)) {
			if ($wf_status == 0) {
				$view = true;
			} elseif ($wf_status == 1) {
				$view = true;
			} elseif ($wf_status == 2) {
				$view = false;
			} elseif ($wf_status == 3) {
				$view = false;
			} elseif ($wf_status == 4) {
				$view = false;
			} else {
				$view = false;
			}
		} else {
			$view = true;
		}
		return $view;
	}
}

if (!function_exists('get_kod_unit_nama')) {
	function get_kod_unit_nama($id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_unit_by_id($id);
		return $result->nama;
	}
}

if (!function_exists('get_user_name')) {
	function get_user_name($id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_user_by_id($id);
		return $result->name;
	}
}


if (!function_exists('get_konf_ptj_data')) {
	function get_konf_ptj_data($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_konf_ptj_data($id);

		return $result->nama;
	}
}

if (!function_exists('get_konf_ptj_data_byid')) {
	function get_konf_ptj_data_byid($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_konf_ptj_data($id);

		return $result;
	}
}

if (!function_exists('get_role_by_ptj')) {
	function get_role_by_ptj($where)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_role($where);

		return $result;
	}
}

if (!function_exists('get_role_name')) {
	function get_role_name($role_id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_role2(array("konf_role.id" => $role_id));

		return $result->name;
	}
}

if (!function_exists('get_ptj_by_profile_id')) {
	function get_ptj_by_profile_id($profile_id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_ptj_by_profile_id($profile_id);

		return $result->xxx;
	}
}

if (!function_exists('get_jabatan_by_profile_id')) {
	function get_jabatan_by_profile_id($profile_id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_jabatan_by_profile_id($profile_id);

		return $result->xxx;
	}
}

if (!function_exists('get_jenis_ptj_id')) {
	function get_jenis_ptj_by_profile_id($profile_id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_jenis_ptj_by_profile_id($profile_id);

		return $result->xxx;
	}
}

if (!function_exists('helper_get_parent_kod_objek')) {
	function helper_get_parent_kod_objek($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_parent_kod_objek($id);
		// pr($result);
		return ($result->kod) ? $result->kod : 0;
	}
}

if (!function_exists('get_vot_by_ptj_id')) {
	function get_vot_by_ptj_id($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_vot_by_ptj_id($id);
		// pr($result);
		return ($result->kod_vot) ? $result->kod_vot : 0;
	}
}

if (!function_exists('get_vot_by_ptj_id_jenis')) {
	function get_vot_by_ptj_id_jenis($id, $jenis)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_vot_by_ptj_id_jenis($id, $jenis);
		// pr($result);
		return ($result->kod_vot) ? $result->kod_vot : 0;
	}
}

if (!function_exists('get_kod_keterangan')) {
	function get_kod_keterangan($id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_kod_lain(["konf_kod.id" => $id], "row_object");
		return ($result->keterangan) ? $result->keterangan : 0;
	}
}

if (!function_exists('get_jawatan')) {
	function get_jawatan($id)
	{
		$_ci = get_instance();
		$_ci->load->model('pegawai_pengawal_model');

		$result = $_ci->pegawai_pengawal_model->get_jawatan(["konf_jawatan.id" => $id], "row_object");
		return "[" . $result->gred . "] " . $result->nama;
	}
}

if (!function_exists('audit_kod()')) {
	function audit_kod()
	{
		$_ci = get_instance();
		return $_ci->db->get('kod_audit')->result_object();
	}
}

if (!function_exists('module_name()')) {
	function module_name($id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$name = $_ci->mastercode_model->get_module_by_id($id)->name;

		return $name;
	}
}

if (!function_exists('menu_name()')) {
	function menu_name($id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$name = $_ci->mastercode_model->get_menu_by_id($id)->name;

		return $name;
	}
}

if (!function_exists('get_kod_jabatan()')) {
	function get_kod_jabatan($kod)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_kod_jabatan($kod);

		return $result;
	}
}

if (!function_exists('get_jabatan_by_ptj()')) {
	function get_jabatan_by_ptj($ptjid)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_jabatan_by_ptj($ptjid);
		$parent_id = trim($result->parent_ptj_id);

		return $parent_id;
	}
}

if (!function_exists('get_nama_jabatan_by_ptj()')) {
	function get_nama_jabatan_by_ptj($ptjid)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_jabatan_by_ptj($ptjid);

		return $result;
	}
}

if (!function_exists('get_kod_objek()')) {
	function get_kod_objek($id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_kod_objek($id);

		return "[" . $result->kod . "]" . " " . $result->definisi;
	}
}

if (!function_exists('get_elaun')) {
	function get_elaun($id)
	{
		$_ci = get_instance();
		$_ci->load->model('tetapan_elaun_model');

		$result = $_ci->tetapan_elaun_model->get_permohonan(["tetapan_elaun.id" => $id]);

		return $result->keterangan;
	}
}

if (!function_exists('get_elaun_by_kod')) {
	function get_elaun_by_kod($kod)
	{

		$_ci = get_instance();
		$_ci->db->select("*");
		$_ci->db->from("tetapan_elaun");
		$_ci->db->where("jenis_elaun", $kod);
		$_ci->db->where("is_active", 1);
		$_ci->db->where("soft_delete", 0);

		$query = $_ci->db->get();

		return $query->row_object();
	}
}

if (!function_exists('get_bulan_kenaikan')) {
	function get_bulan_kenaikan()
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');
		return $_ci->mastercode_model->get_kod_lain(["kategori" => "BULAN_KENAIKAN"]);
	}
}


if (!function_exists('get_list_ptj()')) {
	function get_list_ptj($parent_id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$list = $_ci->mastercode_model->get_senarai_ptj_by_parent($parent_id);

		if (count($list) > 0) {
			$tmp_string = "";
			$no_row = 1;
			$size = count($list);
			foreach ($list as $key => $value) {
				if ($no_row < $size) {
					$tmp_string .= $value->id . ",";
				} else {
					$tmp_string .= $value->id;
				}
				$no_row++;
			}

			return $tmp_string;
		}

		return $parent_id;
	}
}

if (!function_exists('multiple_in_array')) {
	function multiple_in_array($array_1, $array_2)
	{
		if (!empty($array_1))
			foreach ($array_1 as $stack) {
				if (in_array($stack, $array_2)) {
					return true;
				}
			}
		return false;
	}
}

if (!function_exists('generate_running_no')) {
	function generate_running_no($format, $flag, $module, $default = "4")
	{
		$_ci = get_instance();

		$_ci->db->trans_start();
		$_ci->db->query("CALL running_number('" . $flag . "', '" . $module . "' , @running_no, @tarikh);");
		$query = $_ci->db->query("SELECT @running_no as no_run, @tarikh;");
		$_ci->db->trans_complete();

		return $format . sprintf('%0' . $default . 'd', $query->result()[0]->no_run);
	}
}

if (!function_exists('generate_running_no1')) {
	function generate_running_no1($format, $flag, $module, $kod_ptj, $default = "4")
	{
		$_ci = get_instance();

		$_ci->db->trans_start();
		$_ci->db->query("CALL running_number1('" . $flag . "', '" . $module . "' , '" . $kod_ptj . "' , @running_no, @tarikh);");
		$query = $_ci->db->query("SELECT @running_no as no_run, @tarikh;");
		$_ci->db->trans_complete();

		return $format . sprintf('%0' . $default . 'd', $query->result()[0]->no_run);
	}
}

if (!function_exists('helper_konf_kod_projek')) {
	function helper_konf_kod_projek($id)
	{
		$_ci = get_instance();
		$_ci->db->select("*");
		$_ci->db->from("konf_kod_projek");
		$_ci->db->where("id", $id);;

		$query = $_ci->db->get();

		return $query->row_object();
	}
}

if (!function_exists('get_konf_kod_projek_keterangan')) {
	function get_konf_kod_projek_keterangan($id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_kod_projek($id);
		$tmp_string = $result->kod_projek . ' - ' . $result->keterangan;
		return $tmp_string;
	}
}

if (!function_exists('get_ptj_ptg')) {
	function get_ptj_ptg($where = [], $rtn = 'row_object')
	{
		$_ci = get_instance();
		$_ci->db->select('*');
		$_ci->db->from('konf_ptj');
		$_ci->db->like('konf_ptj.is_pejabat_tanah', 1);

		foreach ((array)$where as $key => $value) {
			if ($value != "") {
				$_ci->db->where($key, $value);
			}
		}

		$query = $_ci->db->get();
		return $query->$rtn();
	}
}

if (!function_exists('get_program_aktiviti')) {
	function get_program_aktiviti($id)
	{
		$_ci = get_instance();

		$_ci->db->select("*");
		$_ci->db->from("konf_kod_aktiviti");
		$_ci->db->where("is_active", 1);
		$_ci->db->where("id", $id);

		$query = $_ci->db->get();
		return $query->row_object();
	}
}

/**
 * convert item list array.
 * need to put at where_in function in db code igniter.
 */
if (!function_exists('convert_to_array($list, $parameter)')) {
	function convert_to_array($list, $parameter)
	{
		$temp_array = array();
		foreach ($list as $value) {
			$temp_array[] = $value->$parameter;
		}

		return $temp_array;
	}
}

/**
 * convert item list array.
 * need to put at where_in function in db code igniter.
 */
if (!function_exists('get_objek_bajet_mengurus()')) {
	function get_objek_bajet_mengurus($bmd_id)
	{
		$_ci = get_instance();

		// TODO: get data from SA to be entered in db(table konf_kod or konf_kod_objek?)
		$_ci->db->select("bmo.*, kko.definisi");
		$_ci->db->from("bajet_mengurus_objek bmo");
		$_ci->db->join("konf_kod_objek kko", 'kko.kod = bmo.objek');
		$_ci->db->where("bmo.bajet_mengurus_detail_id", $bmd_id);
		$_ci->db->where("bmo.is_active", 1);

		$query = $_ci->db->get();
		$result = $query->row_object();

		return $result->objek . ' - ' . $result->definisi;
	}
}

/**
 * convert item list array.
 * need to put at where_in function in db code igniter.
 */
if (!function_exists('get_objek_bajet_mengurus_id()')) {
	function get_objek_bajet_mengurus_id($bmd_id)
	{
		$_ci = get_instance();

		// TODO: get data from SA to be entered in db(table konf_kod or konf_kod_objek?)
		$_ci->db->select("bmo.*, kko.definisi, kko.id as konf_objek_id");
		$_ci->db->from("bajet_mengurus_objek bmo");
		$_ci->db->join("konf_kod_objek kko", 'kko.kod = bmo.objek');
		$_ci->db->where("bmo.bajet_mengurus_detail_id", $bmd_id);
		$_ci->db->where("bmo.is_active", 1);

		$query = $_ci->db->get();
		$result = $query->row_object();

		return $result;
	}
}

/**
 * convert item list array.
 * need to put at where_in function in db code igniter.
 */
if (!function_exists('get_konf_kod_objek_by_id()')) {
	function get_konf_kod_objek_by_id($id)
	{
		$_ci = get_instance();

		// TODO: get data from SA to be entered in db(table konf_kod or konf_kod_objek?)
		$_ci->db->select("kko.*");
		$_ci->db->from("konf_kod_objek kko");
		$_ci->db->where("kko.id", $id);
		$_ci->db->where("kko.is_active", 1);
		$_ci->db->where("kko.soft_delete", 0);

		$query = $_ci->db->get();
		$result = $query->row_object();

		return $result;
	}
}

/**
 * convert item list array.
 * need to put at where_in function in db code igniter.
 */
if (!function_exists('get_konf_ptj_id_by_vot()')) {
	function get_konf_ptj_id_by_vot($id)
	{
		$_ci = get_instance();

		// TODO: get data from SA to be entered in db(table konf_kod or konf_kod_objek?)
		$_ci->db->select("konf_ptj_vot.*");
		$_ci->db->from("konf_ptj_vot");
		$_ci->db->where("konf_ptj_vot.id", $id);
		$_ci->db->where("konf_ptj_vot.is_active", 1);
		$_ci->db->where("konf_ptj_vot.soft_delete", 0);

		$query = $_ci->db->get();
		$tmp_data = $query->row_object();

		if (!empty($tmp_data)) {
			$_ci->db->select("kp.*");
			$_ci->db->from("konf_ptj kp");
			$_ci->db->where("kp.parent_ptj_id", $tmp_data->konf_ptj_id);
			$_ci->db->where("kp.is_active", 1);
			$_ci->db->where("kp.soft_delete", 0);

			$query = $_ci->db->get();
			$tmp_second = $query->result_object();

			if (!empty($tmp_second)) {
				$size = count($tmp_second);
				$tmp_id_string = "";
				foreach ($tmp_second as $k1 => $v2) {
					if ($size > 1) {
						$tmp_id_string .= $v2->id . ", ";
					} else {
						$tmp_id_string .= $v2->id;
					}
					$size--;
				}

				return $tmp_id_string;
			}
		}
	}
}

if (!function_exists('replace_comma_money')) {
	function replace_comma_money($amaun)
	{
		return str_replace(",", "", $amaun);
	}
}


if (!function_exists('get_daerah_ptj()')) {
	function get_daerah_ptj($parent_id)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$list = $_ci->mastercode_model->get_senarai_ptj_by_parent($parent_id);

		$tmp_array = [];
		if (!empty($list)) {
			foreach ($list as $key => $value) {
				$tmp_array[$value->id] = ['display_name' => $value->nama, 'ptj_id' => $value->id, 'group' => $value->group];
			}
		}

		return $tmp_array;
	}
}

if (!function_exists('get_konf_kod_keterangan_by_kod')) {
	function get_konf_kod_keterangan_by_kod($kod)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_kod_lain_by_kod($kod);

		return $result->keterangan;
	}
}

if (!function_exists('get_module_name')) {
	function get_module_name($role_id)
	{
		$_ci = get_instance();

		// TODO: get data from SA to be entered in db(table konf_kod or konf_kod_objek?)
		$_ci->db->select('GROUP_CONCAT(DISTINCT(CONCAT(kmd.name)) SEPARATOR ", <br> ") xxx');
		$_ci->db->from("konf_menu_access kma");
		$_ci->db->join("konf_menu km", "km.id = kma.konf_menu_id");
		$_ci->db->join("konf_module kmd", "kmd.id = km.konf_module_id");
		$_ci->db->group_start();
		$_ci->db->or_where('JSON_EXTRACT(access_right, "$.l") = 1');
		$_ci->db->or_where('JSON_EXTRACT(access_right, "$.t") = 1');
		$_ci->db->or_where('JSON_EXTRACT(access_right, "$.s") = 1');
		$_ci->db->or_where('JSON_EXTRACT(access_right, "$.h") = 1');
		$_ci->db->or_where('JSON_EXTRACT(access_right, "$.c") = 1');
		$_ci->db->group_end();
		$_ci->db->where("kma.konf_role_id", $role_id);

		$query = $_ci->db->get();

		return $query->row_object()->xxx;
	}
}

// return anything atleast got some id
if (!function_exists('get_jawatan_list')) {
	function get_jawatan_list()
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');

		$result = $_ci->sistem_model->get_jawatan_hakiki();

		$temp_result = [];

		foreach ($result as $key => $value) {

			if (in_array($value, $temp_result)) {
				continue;
			}

			$temp_result[$value->kod] = $value->id;
		}

		return $temp_result;
	}
}

if (!function_exists('get_elaun_by_kod_new')) {
	function get_elaun_by_kod_new($kod)
	{

		$_ci = get_instance();
		$_ci->db->select("*");
		$_ci->db->from("tetapan_elaun");
		$_ci->db->where("kod", $kod);
		$_ci->db->where("is_active", 1);
		$_ci->db->where("soft_delete", 0);

		$query = $_ci->db->get();

		return $query->row_object();
	}
}

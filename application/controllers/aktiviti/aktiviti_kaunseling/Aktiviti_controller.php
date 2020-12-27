<?php defined('BASEPATH') or exit('No direct script access allowed');

class Aktiviti_controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
	}
	
	public function index()
	{

		$data['mode'] = 'add';
        $data['formtitle'] = 'Senarai Aktiviti';
        $data['actionform'] = '#';
        $data['lastnewcrumb'] = 'Senarai Aktiviti';

		$this->load->section('js_header', array('aktiviti/aktiviti_kaunseling/js_lst_aktiviti.php'));
        $this->load->view('aktiviti/aktiviti_kaunseling/lst_aktiviti', $data);
	}

	public function dt_senarai_aktiviti()
	{
		$this->output->unset_template();
		$this->load->helper('date');
		$this->load->model('aktiviti/aktiviti_model', 'a_model');

		$post = $this->input->post();
        $records = $this->a_model->get_dt_activity_list();

		$data = array();
        $no = $_POST['start'];
        
		foreach ($records as $value) {
			$no++;
			$row    = array();
		
			$row[] = $no;
			$row[] = strtoupper($value->keterangan);
			$row[] = !empty($value->tarikh_mula) ? date('d/m/Y', strtotime($value->tarikh_mula)) : "";
			$row[] = date('h:i a', strtotime($value->waktu_mula)) .' - ' . date('h:i a', strtotime($value->waktu_tamat));
			$row[] = $value->is_active;
			$row[] = $value->id;
			$data[] = $row;
		}
		$soutput = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => null,
			"recordsFiltered" => null,
			"data" => $data,
		);

		echo json_encode($soutput);
    }
    
    public function register_activity()
    {
        $data['mode'] = 'add';
        $data['formtitle'] = 'Lapor Aktiviti Bimbingan dan Kaunseling';
        $data['actionform'] = 'aktiviti/aktiviti_kaunseling/aktiviti_controller/insert';
        $data['lastnewcrumb'] = 'Kemasukan Maklumat Aktiviti Bimbingan dan Kaunseling';

        $this->load->section('js_header', array('aktiviti/aktiviti_kaunseling/js_frm_aktiviti.php'));
        $this->load->view('aktiviti/aktiviti_kaunseling/frm_aktiviti', $data);
    }

    public function insert()
    {
        $this->load->helper('select_option');
		$this->load->model(array('sistem_model', 'ion_auth_model'));
		$this->load->helper(array('form', 'url'));

		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		$this->form_validation->set_rules('waktu_mula', 'Waktu Mula', 'required', array('required' => lang('validation_required')));
		$this->form_validation->set_rules('waktu_tamat', 'Waktu Tamat', 'required', array('required' => lang('validation_required')));
        
        if ($this->form_validation->run() == FALSE) {
            $this->session_manager->flash_error('Sila isi ruangan yang mempunyai tanda *. Terima Kasih.');
			$this->register_activity();
			
		} else {

            $this->load->model("transaksidb_model");

            $this->db->trans_begin();

            $post = $this->input->post();
			
			$activity['kategori_sesi'] 			= $post['kategori'];
			$activity['tarikh_mula'] 	= $post['tarikh_aktiviti'];
			$activity['waktu_mula'] 	= $post['waktu_mula'];
			$activity['waktu_tamat'] 			= $post['waktu_tamat'];
			$activity['jenis_sesi'] 			= $post['jenis_sesi'];
			$activity['sasaran_id'] 			= $post['sasaran_id'];
			$activity['klasifikasi_kg_id'] 			= $post['klasifikasi_kg_id'];
			$activity['nama_tingkatan'] 			= $post['nama_tingkatan'];
			$activity['kelas'] 			= $post['kelas'];
			$activity['bil_waktu'] 			= $post['bil_waktu'];
			$activity['kategori_klien'] 			= $post['klien'];
			$activity['kategori_cakna'] 			= $post['kategori_ziarah_cakna'];
			$activity['impak_cakna'] 			= $post['impak_ziarah_cakna'];
			$activity['jenis_program_id'] 			= $post['jenis_program_id'];
			$activity['lain_lain_program'] 			= $post['lain_lain_program'];
			$activity['tajuk_program'] 			= $post['tajuk_program'];
			$activity['pendekatan_id'] 			= $post['pendekatan_id'];
			$activity['jenis_perkhidmatan_id'] 			= $post['jenis_perkhidmatan_id'];
			$activity['fokus_id'] 			= $post['fokus_id'];
			$activity['fokus_sub_id'] 			= $post['sub_fokus_id'];

			$activity['created_by']			= $this->session->user_id;

            $activity_id = $this->transaksidb_model->insert('aktiviti', $activity);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
				$this->session_manager->flash_error('Maaf! Kemasukan maklumat aktiviti tidak berjaya.. Sila cuba lagi.');
				$this->register_activity();
			} else {
				$this->db->trans_commit();
                
                $this->session_manager->flash_success('Maklumat kemasukan aktiviti telah berjaya.');
				redirect(base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/register_activity_details/'.$activity_id) . url_akses());
			}
        }
	}

	public function register_activity_details($activity_id)
	{
		$data['mode'] = 'add';
        $data['formtitle'] = 'Lapor Aktiviti Bimbingan dan Kaunseling';
        $data['actionform'] = 'aktiviti/aktiviti_kaunseling/aktiviti_controller/insert_details';
		$data['lastnewcrumb'] = 'Kemasukan Maklumat Murid';
		
		$this->load->model('aktiviti/aktiviti_model', 'a_model');

		$data['aktiviti'] = $this->a_model->get_activity($activity_id);
		// pr($data);
        $this->load->section('js_header', array('aktiviti/aktiviti_kaunseling/js_frm_aktiviti_details.php'));
        $this->load->view('aktiviti/aktiviti_kaunseling/frm_aktiviti_details', $data);
	}

	public function insert_details()
    {
        $this->load->helper('select_option');
		$this->load->model(array('sistem_model', 'ion_auth_model'));
		$this->load->helper(array('form', 'url'));

		
		$this->load->library('form_validation');
		// $this->form_validation->set_error_delimiters('<li>', '</li>');
		// $this->form_validation->set_rules('perkara', 'Perkara', 'required', array('required' => lang('validation_required')));
		// $this->form_validation->set_rules('waktu_tamat', 'Waktu Tamat', 'required', array('required' => lang('validation_required')));
        
        if (FALSE) {
            $this->session_manager->flash_error('Sila isi ruangan yang mempunyai tanda *. Terima Kasih.');
			$this->register_activity();
			
		} else {

            $this->load->model("transaksidb_model");
            $this->db->trans_begin();

            $post = $this->input->post();
			
			$activity_details['perkara'] 							= $post['perkara'];
			$activity_details['persoalan'] 							= $post['persoalan'];
			$activity_details['tindakan_intervensi_id'] 			= $post['tindakan_intervensi_id'];
			$activity_details['keterangan_tindakan_intervensi'] 	= $post['keterangan_tindakan_intervensi'];
			$activity_details['nama_klien'] 						= $post['nama_klien'];
			$activity_details['aktiviti_id'] 						= $post['aktiviti_id'];
			$activity_details['focus'] 						= $post['focus'] == 'on' ? 1 : 0 ;
			$activity_details['risiko_cicir'] 						= $post['risiko_cicir'] == 'on' ? 1 : 0 ;

			$activity_details['rumusan_program'] 						= $post['rumusan_program'];
			$activity_details['objektif_program'] 						= $post['objektif_program'];
			$activity_details['sasaran_program'] 						= $post['sasaran_program'];
			$activity_details['kelebihan_program'] 						= $post['kelebihan_program'];
			$activity_details['kelemahan_program'] 						= $post['kelemahan_program'];
			$activity_details['penambahbaikan_program'] 				= $post['penambahbaikan_program'];

			$activity_details['nama_penjaga'] 					= $post['nama_penjaga'];
			$activity_details['tindakan_cakna'] 				= $post['tindakan_cakna'];

			$activity_details['m'] 					= $post['m'];
			$activity_details['c'] 					= $post['c'];
			$activity_details['i'] 					= $post['i'];
			$activity_details['sb'] 				= $post['sb'];
			$activity_details['sw'] 				= $post['sw'];
			$activity_details['ll'] 				= $post['ll'];
			$activity_details['pm'] 				= $post['pm'];
			$activity_details['pc'] 				= $post['pc'];
			$activity_details['pi'] 				= $post['pi'];
			$activity_details['psb'] 				= $post['psb'];
			$activity_details['psw'] 				= $post['psw'];
			$activity_details['pll'] 				= $post['pll'];

			$activity_id = $this->transaksidb_model->insert('aktiviti_details', $activity_details);
			
			if(count($post['murid_id']) > 0)
			{
				$aktiviti_murid = [];
				foreach($post['murid_id'] as $key => $value)
				{
					$aktiviti_murid[] = [
						'aktiviti_id' => $post['aktiviti_id'],
						'konf_sekolah_id' => $this->session->konf_sekolah,
						'nama_tingkatan' => $post['tingkatan_grid_id'],
						'nama' => $post['nama_murid'][$key],
						'kelas_id' => $post['kelas_id_grid_'][$key],
						'no_kp_baru' => $post['no_kp_murid_'][$key],
					];
				}

				$this->transaksidb_model->insert_bulk('aktiviti_murid', $aktiviti_murid);
			}
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
				$this->session_manager->flash_error('Maaf! Kemasukan maklumat aktiviti tidak berjaya.. Sila cuba lagi.');
				$this->register_activity();
			} else {
				$this->db->trans_commit();
                
                $this->session_manager->flash_success('Maklumat kemasukan aktiviti telah berjaya.');
				redirect(base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller') . url_akses());
			}
        }
	}

	public function kemaskini($activity_id)
	{
		$this->load->model('aktiviti/aktiviti_model', 'a_model');
		$this->load->model('aktiviti/murid_model', 'm_model');

		$data['mode'] = 'update';
        $data['formtitle'] = 'Lapor Aktiviti Bimbingan dan Kaunseling';
        $data['actionform'] = 'aktiviti/aktiviti_kaunseling/aktiviti_controller/update';
        $data['lastnewcrumb'] = 'Kemasukan Maklumat Aktiviti Bimbingan dan Kaunseling';

		$data['aktiviti'] = $this->a_model->get_activity($activity_id);
		$data['aktiviti_details'] = $this->a_model->get_activity_details($activity_id);
		$data['senarai_murid'] = $this->m_model->get_senarai_murid_by_activity($activity_id);
		// pr($data);
        $this->load->section('js_header', array('aktiviti/aktiviti_kaunseling/js_frm_aktiviti.php'));
        $this->load->view('aktiviti/aktiviti_kaunseling/frm_aktiviti_kemaskini', $data);
	}

	/**
	 * get jenis sesi
	 */
	public function ajax_get_jenis_sesi()
	{
		$this->output->unset_template();
		$this->load->model(['mastercode_model']);
		$list_temp = $this->mastercode_model->get_data_by_parent_id($this->input->get('kategori'));
		
		$keterangan = [];
		$id = [];
		$status = 'failed';

        if(count($list_temp) > 0){
            foreach($list_temp as $key => $value){
				$id[$value->kategori][] = $value->id;
				$keterangan[$value->kategori][] = $value->kod .' - '. $value->keterangan;
				$kategori[$value->kategori] = $value->kategori;
			}
			$status = 'success'	;
        }
		
		$response = [
			'status' => $status,
			'id' => $id,
			'keterangan' => $keterangan,
			'kategori' => $kategori,
		];

		echo json_encode($response);

	}

	public function get_kelas_nama_tingkatan()
	{
		$this->output->unset_template();
		$this->load->model(['mastercode_model']);
		$list_temp = $this->mastercode_model->get_kelas($this->input->get('kategori'));
		
		$nama_kelas = [];
		$id = [];
		$status = 'failed';

        if(count($list_temp) > 0){
            foreach($list_temp as $key => $value){
				$id[] = $value->id;
				$nama_kelas[] = $value->kelas;
			}
			$status = 'success'	;
        }
		
		$response = [
			'status' => $status,
			'id' => $id,
			'nama_kelas' => $nama_kelas,
		];

		echo json_encode($response);
	}

	public function ajax_delete()
	{
		$this->output->unset_template();
		$this->load->model("transaksidb_model");

		$this->db->trans_begin();
		$this->transaksidb_model->delete_bulk_hard('aktiviti_murid', 'id', [$this->input->get('aktiviti_murid_id')]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
		
	}

	public function update()
    {
        $this->load->helper('select_option');
		$this->load->model(array('sistem_model', 'ion_auth_model'));
		$this->load->model('aktiviti/aktiviti_model', 'a_model');
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		$this->form_validation->set_rules('waktu_mula', 'Waktu Mula', 'required', array('required' => lang('validation_required')));
		$this->form_validation->set_rules('waktu_tamat', 'Waktu Tamat', 'required', array('required' => lang('validation_required')));
        
        if ($this->form_validation->run() == FALSE) {
            $this->session_manager->flash_error('Sila isi ruangan yang mempunyai tanda *. Terima Kasih.');
			redirect(base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller') . url_akses());
		} else {

            $this->load->model("transaksidb_model");

            $this->db->trans_begin();

            $post = $this->input->post();
			
			$activity['kategori_sesi'] 			= $post['kategori_id'];
			$activity['tarikh_mula'] 	= $post['tarikh_aktiviti'];
			$activity['waktu_mula'] 	= $post['waktu_mula'];
			$activity['waktu_tamat'] 			= $post['waktu_tamat'];
			$activity['jenis_sesi'] 			= $post['jenis_sesi'];
			$activity['sasaran_id'] 			= $post['sasaran_id'];
			$activity['klasifikasi_kg_id'] 			= $post['klasifikasi_kg_id'];
			$activity['nama_tingkatan'] 			= $post['nama_tingkatan'];
			$activity['kelas'] 			= $post['kelas'];
			$activity['bil_waktu'] 			= $post['bil_waktu'];
			$activity['kategori_klien'] 			= $post['klien'];
			$activity['kategori_cakna'] 			= $post['kategori_ziarah_cakna'];
			$activity['impak_cakna'] 			= $post['impak_ziarah_cakna'];
			$activity['jenis_program_id'] 			= $post['jenis_program_id'];
			$activity['lain_lain_program'] 			= $post['lain_lain_program'];
			$activity['tajuk_program'] 			= $post['tajuk_program'];
			$activity['pendekatan_id'] 			= $post['pendekatan_id'];
			$activity['jenis_perkhidmatan_id'] 			= $post['jenis_perkhidmatan_id'];
			$activity['fokus_id'] 			= $post['fokus_id'];
			$activity['fokus_sub_id'] 			= $post['sub_fokus_id'];

			$activity['created_by']			= $this->session->user_id;

			$activity_id = $this->transaksidb_model->update('aktiviti', 'id', $post['aktiviti_id'], $activity);
			
			$activity_details['perkara'] 							= $post['perkara'];
			$activity_details['persoalan'] 							= $post['persoalan'];
			$activity_details['tindakan_intervensi_id'] 			= $post['tindakan_intervensi_id'];
			$activity_details['keterangan_tindakan_intervensi'] 	= $post['keterangan_tindakan_intervensi'];
			$activity_details['nama_klien'] 						= $post['nama_klien'];
			$activity_details['aktiviti_id'] 						= $post['aktiviti_id'];
			$activity_details['focus'] 						= $post['focus'] == 'on' ? 1 : 0 ;
			$activity_details['risiko_cicir'] 						= $post['risiko_cicir'] == 'on' ? 1 : 0 ;

			$activity_details['rumusan_program'] 						= $post['rumusan_program'];
			$activity_details['objektif_program'] 						= $post['objektif_program'];
			$activity_details['sasaran_program'] 						= $post['sasaran_program'];
			$activity_details['kelebihan_program'] 						= $post['kelebihan_program'];
			$activity_details['kelemahan_program'] 						= $post['kelemahan_program'];
			$activity_details['penambahbaikan_program'] 				= $post['penambahbaikan_program'];

			$activity_details['nama_penjaga'] 					= $post['nama_penjaga'];
			$activity_details['tindakan_cakna'] 				= $post['tindakan_cakna'];

			$activity_details['m'] 					= $post['m'];
			$activity_details['c'] 					= $post['c'];
			$activity_details['i'] 					= $post['i'];
			$activity_details['sb'] 				= $post['sb'];
			$activity_details['sw'] 				= $post['sw'];
			$activity_details['ll'] 				= $post['ll'];
			$activity_details['pm'] 				= $post['pm'];
			$activity_details['pc'] 				= $post['pc'];
			$activity_details['pi'] 				= $post['pi'];
			$activity_details['psb'] 				= $post['psb'];
			$activity_details['psw'] 				= $post['psw'];
			$activity_details['pll'] 				= $post['pll'];

			$checking_data = $this->a_model->get_activity_details($post['aktiviti_id']);

			if(!empty($checking_data))
			{
				$this->transaksidb_model->update('aktiviti_details', 'aktiviti_id', $post['aktiviti_id'], $activity_details);
			}
			else
			{
				$activity_id = $this->transaksidb_model->insert('aktiviti_details', $activity_details);
			}
			

			if(count($post['murid_id']) > 0)
			{
				$aktiviti_murid = [];
				foreach($post['murid_id'] as $key => $value)
				{
					$aktiviti_murid[] = [
						'aktiviti_id' => $post['aktiviti_id'],
						'konf_sekolah_id' => $this->session->konf_sekolah,
						'nama_tingkatan' => $post['tingkatan_grid_id'],
						'nama' => $post['nama_murid'][$key],
						'kelas_id' => $post['kelas_id_grid_'][$key],
						'no_kp_baru' => $post['no_kp_murid_'][$key],
					];
				}

				$this->transaksidb_model->insert_bulk('aktiviti_murid', $aktiviti_murid);
			}
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
				$this->session_manager->flash_error('Maaf! Kemasukan maklumat aktiviti tidak berjaya.. Sila cuba lagi.');
				$this->register_activity();
			} else {
				$this->db->trans_commit();
                
                $this->session_manager->flash_success('Maklumat kemasukan aktiviti telah berjaya.');
				redirect(base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller') . url_akses());
			}
        }
	}

	public function ajax_get_murid()
	{
		$this->output->unset_template();
		$this->load->helper('date');
		$this->load->model('aktiviti/murid_model', 'murid_model');

		$list_temp = $this->murid_model->get_dt_murid_list($this->input->get('kelas_id'), $this->session->konf_sekolah);

		echo json_encode($list_temp);
	}


}
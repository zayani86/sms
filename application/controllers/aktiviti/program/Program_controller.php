<?php defined('BASEPATH') or exit('No direct script access allowed');

class Program_controller extends MY_Controller
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

		$this->load->section('js_header', array('aktiviti/program/js_lst_aktiviti.php'));
        $this->load->view('aktiviti/program/lst_aktiviti', $data);
	}

	public function dt_senarai_aktiviti()
	{
		$this->output->unset_template();
		$this->load->helper('date');
		$this->load->model('aktiviti/program_model', 'p_model');

		$post = $this->input->post();
        $records = $this->p_model->get_dt_activity_list();

		$data = array();
        $no = $_POST['start'];
        
		foreach ($records as $value) {
			$no++;
			$row    = array();
		
			$row[] = $no;
			$row[] = strtoupper($value->kat_desc);
			$row[] = !empty($value->tarikh_mula) ? date('d/m/Y', strtotime($value->tarikh_mula)) : "";
			$row[] = date('h:i a', strtotime($value->waktu_mula)) .' - ' . date('h:i a', strtotime($value->waktu_tamat));
			$row[] = $value->perkara;
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
        $data['formtitle'] = 'Lapor Lain Lain Aktiviti';
        $data['actionform'] = 'aktiviti/program/program_controller/insert';
        $data['lastnewcrumb'] = 'Kemasukan Maklumat Lain Lain Aktiviti';

        $this->load->section('js_header', array('aktiviti/program/js_frm_aktiviti.php'));
        $this->load->view('aktiviti/program/frm_aktiviti', $data);
    }

    public function insert()
    {

        $this->load->helper('select_option');
		$this->load->model(array('sistem_model', 'ion_auth_model'));
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
        
        if (FALSE) {
            $this->session_manager->flash_error('Sila isi ruangan yang mempunyai tanda *. Terima Kasih.');
			$this->register_activity();
			
		} else {

            $this->load->model("transaksidb_model");

            $this->db->trans_begin();

            $post = $this->input->post();
	
			$program_luar['kategori_id'] 			= $post['kategori'];
			$program_luar['tarikh_mula'] 	= $post['tarikh_mula'];
			$program_luar['tarikh_tamat'] 	= $post['tarikh_tamat'];
			$program_luar['waktu_mula'] 	= $post['waktu_mula'];
			$program_luar['waktu_tamat'] 			= $post['waktu_tamat'];
			$program_luar['perkara'] 			= $post['perkara'];
			$program_luar['program_id'] 			= $post['program_id'];
			$program_luar['tempat'] 			= $post['tempat'];

			$program_luar['created_by']			= $this->session->user_id;

            $this->transaksidb_model->insert('program_luar', $program_luar);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
				$this->session_manager->flash_error('Maaf! Kemasukan maklumat aktiviti tidak berjaya.. Sila cuba lagi.');
				$this->register_activity();
			} else {
				$this->db->trans_commit();
                
                $this->session_manager->flash_success('Maklumat kemasukan aktiviti pentadbiran telah berjaya.');
				redirect(base_url('aktiviti/program/program_controller') . url_akses());
			}
        }
	}


	public function kemaskini($activity_id)
	{
		$this->load->model('aktiviti/program_model', 'p_model');

		$data['mode'] = 'update';
        $data['formtitle'] = 'Lapor Lain Lain Aktiviti';
        $data['actionform'] = 'aktiviti/program/program_controller/update';
        $data['lastnewcrumb'] = 'Kemasukan Maklumat Lain Lain Aktiviti';

		$data['aktiviti'] = $this->p_model->get_activity($activity_id);
		// pr($data);
        $this->load->section('js_header', array('aktiviti/program/js_frm_aktiviti.php'));
        $this->load->view('aktiviti/program/frm_aktiviti_kemaskini', $data);
	}

	public function update()
    {

        $this->load->helper('select_option');
		$this->load->model(array('sistem_model', 'ion_auth_model'));
		$this->load->model('aktiviti/program_model', 'p_model');
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
        
        if (FALSE) {
            $this->session_manager->flash_error('Sila isi ruangan yang mempunyai tanda *. Terima Kasih.');
			redirect(base_url('aktiviti/program/program_controller') . url_akses());
		} else {

            $this->load->model("transaksidb_model");

            $this->db->trans_begin();

            $post = $this->input->post();
			
			$program_luar['tarikh_mula'] 	= $post['tarikh_mula'];
			$program_luar['tarikh_tamat'] 	= $post['tarikh_tamat'];
			$program_luar['waktu_mula'] 	= $post['waktu_mula'];
			$program_luar['waktu_tamat'] 			= $post['waktu_tamat'];
			$program_luar['perkara'] 			= $post['perkara'];
			$program_luar['program_id'] 			= $post['program_id'];
			$program_luar['tempat'] 			= $post['tempat'];

			$program_luar['created_by']			= $this->session->user_id;

			$activity_id = $this->transaksidb_model->update('program_luar', 'id', $post['id'], $program_luar);
			
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
				$this->session_manager->flash_error('Maaf! Kemasukan maklumat aktiviti tidak berjaya.. Sila cuba lagi.');
				$this->register_activity();
			} else {
				$this->db->trans_commit();
                
                $this->session_manager->flash_success('Maklumat kemasukan aktiviti telah berjaya.');
				redirect(base_url('aktiviti/program/program_controller') . url_akses());
			}
        }
	}


}
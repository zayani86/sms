<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    #region Start - Pengguna
	public function user_list()
	{
		$this->load->helper('select_option');

		$data['formtitle'] = 'Senarai Pengguna';

		$this->load->section('js_header', array('admin/pengguna/js_lst_pengguna.php'));
        $this->load->view('admin/pengguna/lst_pengguna', $data);
	}

	public function dt_senarai_pengguna()
	{
		$this->output->unset_template();
		$this->load->helper('date');
		$this->load->model('sistem_model');

		$post = $this->input->post();
        $join = [];
        
        $records = $this->sistem_model->get_dt_user_list();

		$data = array();
        $no = $_POST['start'];
        
		foreach ($records as $value) {
			$no++;
			$row    = array();
		
			$row[] = $no;
			$row[] = $value->username;
			$row[] = $value->name;
			$row[] = $value->email;
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
    
    public function user_register()
    {
        $data['mode'] = 'add';
        $data['formtitle'] = 'Daftar Pengguna';
        $data['actionform'] = 'admin/profile/insert';
        $data['lastnewcrumb'] = 'Daftar Pengguna';

        $this->load->section('js_header', array('admin/pengguna/js_frm_pengguna.php'));
        $this->load->view('admin/pengguna/frm_pengguna', $data);
    }
    public function lapor_individu()
    {
        $data['mode'] = 'add';
        $data['formtitle'] = 'Kaunseling';
        $data['actionform'] = 'admin/profile/simpan_individu';
        $data['lastnewcrumb'] = 'Lapor';

        $this->load->section('js_header', array('admin/pengguna/js_frm_pengguna.php'));
        $this->load->view('admin/pengguna/frm_individu', $data);
    }

    public function lapor_program()
    {
        $data['mode'] = 'add';
        $data['formtitle'] = 'Kaunseling';
        $data['actionform'] = 'admin/profile/simpan_program';
        $data['lastnewcrumb'] = 'Lapor';

        $this->load->section('js_header', array('admin/pengguna/js_frm_pengguna.php'));
        $this->load->view('admin/pengguna/frm_program', $data);
    }


    public function lapor_pentadbiran()
    {
        $data['mode'] = 'add';
        $data['formtitle'] = 'Aktiviti Pentadbiran';
        $data['actionform'] = 'admin/profile/simpan_pentadbiran';
        $data['lastnewcrumb'] = 'Lapor';

        $this->load->section('js_header', array('admin/pengguna/js_frm_pengguna.php'));
        $this->load->view('admin/pengguna/frm_pentadbiran', $data);
    }



    public function simpan_individu()
    {


            $this->load->model("transaksidb_model");

            $this->db->trans_begin();

            $post = $this->input->post();
			// $password 			= $post['password2'];
			//$password 			= $post['ic1'] . $post['ic2'] . $post['ic3'];
			//$salt 				= $this->store_salt ? $this->salt() : FALSE;
			//$password_email 	= $password;
			//$password			= $this->ion_auth_model->hash_password($password, $salt);
			//$post['password'] 	= $password;
			//$post['ip_address'] = $this->input->ip_address();

			$users['tarikh'] 			= $post['tarikh'];
			$users['jenis_sesi'] 	= $post['jenis_sesi'];
			$users['sasaran'] 	= $post['sasaran'] ;
			$users['pendekatan'] 			= $post['pendekatan'];
			$users['perkhidmatan'] 			= $post['perkhidmatan'];
			$users['fokus'] 			= $post['fokus'];

            $masterid = $this->transaksidb_model->insert('data_kaunseling', $users);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
				$this->session_manager->flash_error('Maaf! Maklumat pengguna baru tidak berjaya disimpan.<br>Sila cuba lagi..');
				$this->lapor_individu();
			} else {
				$this->db->trans_commit();
                
                $this->session_manager->flash_success('Maklumat pengguna baru telah berjaya disimpan.');
				redirect(base_url('landing/dashboard_main') );
			}
        
    }



    public function simpan_program()
    {


            $this->load->model("transaksidb_model");

            $this->db->trans_begin();

            $post = $this->input->post();
			// $password 			= $post['password2'];
			//$password 			= $post['ic1'] . $post['ic2'] . $post['ic3'];
			//$salt 				= $this->store_salt ? $this->salt() : FALSE;
			//$password_email 	= $password;
			//$password			= $this->ion_auth_model->hash_password($password, $salt);
			//$post['password'] 	= $password;
			//$post['ip_address'] = $this->input->ip_address();

			$users['tarikh'] 			= $post['tarikh'];
			$users['jenis_program'] 	= $post['jenis_program'];
			$users['tajuk_program'] 	= $post['tajuk_program'] ;
			$users['pendekatan'] 			= $post['pendekatan'];
			$users['perkhidmatan'] 			= $post['perkhidmatan'];
			$users['fokus'] 			= $post['fokus'];

            $masterid = $this->transaksidb_model->insert('data_program', $users);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
				$this->session_manager->flash_error('Maaf! Maklumat pengguna baru tidak berjaya disimpan.<br>Sila cuba lagi..');
				$this->lapor_individu();
			} else {
				$this->db->trans_commit();
                
                $this->session_manager->flash_success('Maklumat pengguna baru telah berjaya disimpan.');
				redirect(base_url('landing/dashboard_main') );
			}
        
    }

    public function simpan_pentadbiran()
    {


            $this->load->model("transaksidb_model");

            $this->db->trans_begin();

            $post = $this->input->post();
			// $password 			= $post['password2'];
			//$password 			= $post['ic1'] . $post['ic2'] . $post['ic3'];
			//$salt 				= $this->store_salt ? $this->salt() : FALSE;
			//$password_email 	= $password;
			//$password			= $this->ion_auth_model->hash_password($password, $salt);
			//$post['password'] 	= $password;
			//$post['ip_address'] = $this->input->ip_address();

			$users['tarikh'] 			= $post['tarikh'];
			$users['perkara'] 	= $post['perkara'];
			$users['waktu_mula'] 	= $post['waktu_mula'] ;
			$users['waktu_tamat'] 			= $post['waktu_tamat'];


            $masterid = $this->transaksidb_model->insert('data_pentadbiran', $users);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
				$this->session_manager->flash_error('Maaf! Maklumat pengguna baru tidak berjaya disimpan.<br>Sila cuba lagi..');
				$this->lapor_pentadbiran();
			} else {
				$this->db->trans_commit();
                
                $this->session_manager->flash_success('Maklumat pengguna baru telah berjaya disimpan.');
				redirect(base_url('landing/dashboard_main') );
			}
        
    }

    public function insert()
    {
        $this->load->helper('select_option');
		$this->load->model(array('sistem_model', 'ion_auth_model'));
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		$this->form_validation->set_rules('name', 'Nama', 'required', array('required' => lang('validation_required')));
        
        if ($this->form_validation->run() == FALSE) {
            $this->session_manager->flash_error('Sila isi peranan pengguna.');
			$this->user_register();
		} else {

            $this->load->model("transaksidb_model");

            $this->db->trans_begin();

            $post = $this->input->post();
			// $password 			= $post['password2'];
			$password 			= $post['ic1'] . $post['ic2'] . $post['ic3'];
			$salt 				= $this->store_salt ? $this->salt() : FALSE;
			$password_email 	= $password;
			$password			= $this->ion_auth_model->hash_password($password, $salt);
			$post['password'] 	= $password;
			$post['ip_address'] = $this->input->ip_address();

			$users['name'] 			= $post['name'];
			$users['nama_ringkasan'] 	= $post['nama_ringkasan'];
			$users['no_pengenalan'] 	= $post['ic1'] . $post['ic2'] . $post['ic3'];
			$users['email'] 			= $post['email'];
			$users['no_tel'] 			= $post['no_tel_pejabat'];
			$users['no_hp'] 			= $post['no_tel_bimbit'];

            $masterid = $this->transaksidb_model->insert('users', $users);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
				$this->session_manager->flash_error('Maaf! Maklumat pengguna baru tidak berjaya disimpan.<br>Sila cuba lagi..');
				$this->user_register();
			} else {
				$this->db->trans_commit();
                
                $this->session_manager->flash_success('Maklumat pengguna baru telah berjaya disimpan.');
				redirect(base_url('admin/profile/user_list') . url_akses());
			}
        }
    }


}
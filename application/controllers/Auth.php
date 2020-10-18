<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth', 'form_validation']);
    }

    public function index()
    {
        echo "";
    }

    /**
	 * Log the user in
	 */
	public function login()
	{
		$this->data['title'] = $this->lang->line('login_heading');

		// validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() === TRUE) {
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			$newidentity  = str_replace('-', '', $this->input->post('identity'));

			if ($this->session_manager->has_session("module_menu")) {
				/* sometimes menu session not clear when logout. To prevent it being used. It will be destroy before login. */
				$this->session_manager->unset_session('module_menu');
			}
			
			if ($this->ion_auth->login($newidentity, $this->input->post('password'), $remember)) {
                
                ## redirect function
				$this->load->model(array('sistem_model', 'transaksidb_model'));

				$id = get_session("user_id");
				$first_time = $this->sistem_model->is_user_first_time($id);

				if ($first_time) {

					$this->db->trans_begin();

					$profile_ptj = $this->sistem_model->get_ptj_by_profile($id);
					
					if(!empty($profile_ptj)){
						foreach($profile_ptj as $key => $value){
							if(!empty($value->tarikh_tamat)){
								if($value->tarikh_tamat < date("Y-m-d")){
									$this->transaksidb_model->update("profile_ptj_role", "id", $value->ppr_id, ['is_active' => 0]);
								}
							}
						}
					}


					if ($this->db->trans_status() === FALSE) {
						$this->db->trans_rollback();
					} else {
						$this->db->trans_commit();
					}

					redirect('/profil/first_time_login') . url_akses();
				} else {

					// $this->db->trans_begin();

					// $profile_ptj = $this->sistem_model->get_ptj_by_profile($id);
					
					// if(!empty($profile_ptj)){
					// 	foreach($profile_ptj as $key => $value){
					// 		if(!empty($value->tarikh_tamat)){
					// 			if($value->tarikh_tamat < date("Y-m-d")){
					// 				$this->transaksidb_model->update("profile_ptj_role", "id", $value->ppr_id, ['is_active' => 0]);
					// 			}
					// 		}
					// 	}
					// }


					// if ($this->db->trans_status() === FALSE) {
					// 	$this->db->trans_rollback();
					// } else {
					// 	$this->db->trans_commit();
					// }

					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('/profil/pusat_tanggungjawab', 'refresh');
				}
			} else {
				// if the login was un-successful
				// redirect them back to the login page
				$this->load->model('sistem_model');

				$attempt = $this->session->userdata('attempt');
				$attempt++;
				$this->session->set_userdata('attempt', $attempt);
				
				if ($attempt == 3) {
					$attempt = 0;
					// if wanna set penalty time, use code below
					// $this->session->set_tempdata('penalty', true, 300);
					$this->session_manager->flash_error('Anda telah memasukkan ID Pengguna/Kata Laluan yang salah melebihi 3 kali. Sila hubungi Pentadbir Sistem');
				} else {
				
					if(!empty($this->ion_auth->get_error_kod()) && strcmp($this->ion_auth->get_error_kod(), '1') == 0){
						$this->session->set_flashdata('auth_message', 'ID Pengguna anda telah tamat tempoh.');
						$this->session_manager->flash_error('ID Pengguna anda telah tamat tempoh. Sila hubungi Pentadbir Sistem');
						redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
					}

					if(!empty($this->ion_auth->get_error_kod()) && strcmp($this->ion_auth->get_error_kod(), '2') == 0){
						$this->session->set_flashdata('auth_message', 'Maklumat Pengguna tidak dijumpai. Sila hubungi Pentadbir Sistem');
						$this->session_manager->flash_error('ID Pengguna belum wujud. Sila hubungi Pentadbir Sistem');
						redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
					}
					
					$exist = $this->sistem_model->if_exist("id", "users", $where = ["username" => $newidentity]);
				}
				
				if ($exist->num > 0) //id exist
					$this->session->set_flashdata('auth_message', 'Kata Laluan anda salah');
				elseif($$exist->num == 0)
					$this->session->set_flashdata('auth_message', 'ID Pengguna anda salah');
				redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		} else {
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = [
				'name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			];

			$this->data['password'] = [
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
			];
		
			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
		}
	}

    /**
	 * @param string     $view
	 * @param array|null $data
	 * @param bool       $returnhtml
	 *
	 * @return mixed
	 */
	public function _render_page($view, $data = NULL, $returnhtml = FALSE) //I think this makes more sense
	{

		$viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml) {
			return $view_html;
		}
	}
}
?>
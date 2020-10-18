<?php defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends MY_Controller
{


    public function dashboard_main()
    {
        $this->load->model('sistem_model');
		
		$data['formtitle'] = 'Dashboard';
		$data['lastnewcrumb'] = $data['formtitle'];
		
		$data['profile'] = $this->sistem_model->pengguna_get_profile($id);

		$this->load->view('dashboard/frm_dashboard_1',$data);
    }

}
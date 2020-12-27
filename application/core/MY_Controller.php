<?php


class MY_Controller extends CI_Controller {

	
	/**
	 * harcoded first
	 * Change it to DB configuration code later
	 */
	public  $_by_pass = false;

    function __construct() {

        parent::__construct();
		// $this->load->model('sistem_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('ion_auth','breadcrumbs'));

		if($this->ion_auth->logged_in() == true){ $this->_by_pass = false; }

		$this->output->unset_template();
		
		if(!$this->_by_pass){
			
			$this->output->set_template($this->config->item('theme_masterpage'));
			$setmenu=true;
		} else {
			$this->output->set_template($this->config->item('theme_login'));
		}

		if ($this->ion_auth->logged_in()===TRUE || $this->_by_pass){
			
			if  ($secureakses==true && $this->uri->segment(1) != 'dashboard' && $this->uri->segment(4) != 'set_user_profile' && $this->uri->segment(2) != 'set_user_profile' && $this->uri->segment(2) != 'kemaskini_profil'){

				if ($this->config->item('secureurl') && getaccess_lihat()==0 && !$this->_by_pass){
					$this->session_manager->flash_error('Maaf! URL yang anda cuba akses adalah tidak dibenarkan.');
					redirect(homepage());
				} else {

				}
			} else {

			}
			if ($setmenu){
				
				$this->menu_manager->addToSession($this->session->user_id);
			}
        }else{
			
			$this->output->set_template($this->config->item('theme_login'));
        }
    }
}

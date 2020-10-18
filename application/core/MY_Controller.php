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
		// $this->load->library(array('ion_auth'));

		$this->output->unset_template();
		// if(!$this->_by_pass){
		// 	$this->output->set_template($this->config->item('theme_masterpage'));
		// 	$setmenu=true;
		// } else {
		// 	$this->output->set_template($this->config->item('theme_login'));
		// }

		$this->output->set_template($this->config->item('theme_login'));
    }
}

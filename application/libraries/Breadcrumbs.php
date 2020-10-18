<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
| Library untuk generate breadcrumb
|
| Sila panggil function dibawah pada view untuk generate breadcrumb
|
| 
| For page record in table konf_menu 
|
| " <?php echo $this->breadcrumbs->generate() ?> "
|
| For page no record in table konf_menu and want to add for the last crumb ->   
|
| " <?php echo $this->breadcrumbs->generate('Maklumat Pengguna'); ?> "
|
| Breadcrumb dijana secara recursive dari table "konf_menu" dimana "konf_menu_parent_id" menjadi rujukan.
|
| MF - 20181023
*/

class breadcrumbs {
	
	private $breadcrumbs = array();
		 
	public function __get($var)
	{
		return get_instance()->$var;
	}
	
	public function __construct()
	{	
		// Load config file
		$this->load->config('breadcrumbs');
		// Get breadcrumbs display options
		$this->tag_open = $this->config->item('tag_open');
		$this->tag_close = $this->config->item('tag_close');
		$this->crumb_home = $this->config->item('crumb_home');
		$this->load->model('navigasi_model');
	}
	
	function buildCrumbs($param) {
		$menu = $this->navigasi_model->get_menu_by_id($param);

		if (!empty($menu->konf_menu_parent_id)){
			array_unshift($this->breadcrumbs, array('id' => $menu->id, 'name' => $menu->name, 'url' => $menu->url, 'konf_module_id' => $menu->konf_module_id, 'konf_menu_parent_id' => $menu->konf_menu_parent_id));
			$this->buildCrumbs($menu->konf_menu_parent_id);
		}else{
			array_unshift($this->breadcrumbs, array('id' => $menu->id, 'name' => $menu->name, 'url' => $menu->url, 'konf_module_id' => $menu->konf_module_id, 'konf_menu_parent_id' => $menu->konf_menu_parent_id));
		};
	}

	function generate($lastcrumb = null)
	{

		// pr($lastcrumb);
		$this->buildCrumbs($this->input->get('cli'));

		if (!empty($this->input->get('cli'))){
			$modul = $this->navigasi_model->get_module_by_id($this->input->get('clm'));
	
			if (!empty($this->breadcrumbs)) {
				$output = $this->tag_open . $this->crumb_home;
	
				//add modul without url
				$output .= '<a href="javascript:void(0)" class="btn btn-default visible-lg-block visible-md-block">' . $modul->name . '</a> ';
	
				//add recursive from child menu to parent
				$numItems = count($this->breadcrumbs);
				$i = 1;
				foreach ($this->breadcrumbs as $key => $crumb) {
					if ($i++ === $numItems && empty($lastcrumb)){
						$output .= '<div class="btn btn-gold"><b>' . $crumb['name'] .'</b></div>';
					}else {
						$output .= '<a href="' . $crumb['url'] . submenu_url($crumb['url']=='submenu' ?  $crumb['id'] : '') . '?clm=' . $this->input->get('clm') . '&clp=' . $this->input->get('clp') . '&cli=' . $crumb['id'] . '" class="btn btn-default visible-lg-block visible-md-block" >' . $crumb['name'] . '</a> ';
					}
				}
	
				//add custom crumb for current page not in konf_menu
				if ($lastcrumb){
					$output .=  '<div class="btn btn-gold"><b>' . $lastcrumb . '</b></div>';
				}
	
				return $output . $this->tag_close;
	
			}else {
				return '';
			}
		}else{
			if ($lastcrumb){
				$output = $this->tag_open . $this->crumb_home;
				$output .=  '<div class="btn btn-gold"><b>' . $lastcrumb . '</b></div>';
				return $output . $this->tag_close;
			}else{
				return '';
			}

		}



	}
}

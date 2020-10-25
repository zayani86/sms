<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class menu_manager 
{
    private $_ci;

	function __construct() {

		// Get the CodeIgniter reference
		$this->_ci = &get_instance();
        $this->_ci->load->model('navigasi_model');
    }
    
    protected function retrieveModules_by_user() {
		return $this->_ci->navigasi_model->get_akses_modul();
    }

    protected function retrieveMenu_isParent() {
		return $this->_ci->navigasi_model->get_akses_menu_isParents();
    }

    protected function retrieveMenu_ByParent($parent_id) {
		return $this->_ci->navigasi_model->get_akses_menu_byParents($parent_id);
    }
    
    public function addToSession($user_id) {
        
       if ($this->_ci->session_manager->has_session("module_menu")) {
          /* Skip menu if exits dalam session semasa, logout utk refresh menu */
        return;
       }


        foreach ($this->retrieveModules_by_user() as $modules)  {


            /* Store Session Setiap Modul Mengikut Peranan User */
            $tmp_module['module_menu'][$modules->id]['id'] = $modules->id;
            $tmp_module['module_menu'][$modules->id]['name'] = $modules->name;
            $tmp_module['module_menu'][$modules->id]['module_icon'] = $modules->module_icon;

            $tmp_menu = $this->retrieveMenu_isParent();

	        if (!empty($tmp_menu)) {
                foreach ($tmp_menu as $menu) {
                    if ($modules->id == $menu->konf_module_id){
                        /* Store Session Setiap Menu Mengikut Modul Diatas*/
                        $tmp_module['module_menu'][$modules->id]
                        ['menu'][$menu->id] = array(
                            'id' => $menu->id,
                            'name' => $menu->name,
                            'url' => $menu->url,
                            'access_right' => $menu->access_right,
                        );

                        // /* Sub Menu Level 1 */
                        $tmp_submenu1 = $this->retrieveMenu_ByParent($menu->id);

                        if (!empty($tmp_submenu1)) {
                            foreach ($tmp_submenu1 as $submenu1) {
                                /* Store Session Setiap Menu Mengikut Menu Diatas*/
                                $tmp_module['module_menu'][$modules->id]
                                ['menu'][$menu->id]
                                ['submenu1'][$submenu1->id] = array(
                                    'id' => $submenu1->id,
                                    'name' => $submenu1->name,
                                    'url' => $submenu1->url,
                                    'access_right' => $submenu1->access_right,
                                );

                                // pr($submenu1);
                                // /* Sub Menu Level 2 */
                                $tmp_submenu2 = $this->retrieveMenu_ByParent($submenu1->id);
                                if (!empty($tmp_submenu2)) {
                                    foreach ($tmp_submenu2 as $submenu2) {
                                        /* Store Session Setiap Menu Mengikut Sub Menu Level 1 Diatas*/

                                        
                                        $tmp_module['module_menu'][$modules->id]
                                        ['menu'][$menu->id]
                                        ['submenu1'][$submenu1->id]
                                        ['submenu2'][$submenu2->id] = array(
                                            'id' => $submenu2->id,
                                            'name' => $submenu2->name,
                                            'url' => $submenu2->url,
                                            'access_right' => $submenu2->access_right,
                                        );
                                    }
                                }  
                        
                            }
                        }
                    }
                }
            }
        }
        
        $this->_ci->session_manager->set_session($tmp_module);
    }
}
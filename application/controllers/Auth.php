<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{


    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "";
    }

    public function login()
    {
        $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
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
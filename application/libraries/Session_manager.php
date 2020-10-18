<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @license   zanko@jb
 */
class session_manager {

	/**
	 * CodeIgniter instance
	 *
	 * @var object
	 */
	private $_ci;

	/**
	 * construct required library.
	 */
	function __construct() {

		// Get the CodeIgniter reference
		$this->_ci = &get_instance();

		// Load the inflector helper
		$this->_ci->load->library('session');

	}

	/**
	 * override session manager.
	 *
	 * @param      <type>  $object  The object
	 */
	public function set_session($object, $model_name = null, $by_pass = true) {

		// check if object create new assign object in session.
		if (is_object($object)) {

			// assign to session controller
			$_SESSION[$model_name] = $object;
		}

		// check if array do this normal ways.
		if (is_array($object) && $by_pass) {

			// call method session normal ways.
			$this->_ci->session->set_userdata($object);
		} else {
			$_SESSION[$model_name] = $object;
		}

	}

	/**
	 * Determines if logged in.
	 *
	 * @return     boolean  True if logged in, False otherwise.
	 */
	public function is_logged_in() {
		$session_data = $this->get_session('user_model');
		return isset($session_data);
	}

	/**
	 * flash success
	 *
	 * @param      <type>  $message  The message
	 */
	public function flash_success($message) {
		$this->_ci->session->set_flashdata('alert-success', $message);
	}

	/**
	 * flash error
	 *
	 * @param      <type>  $message  The message
	 */
	public function flash_error($message) {
		$this->_ci->session->set_flashdata('alert-error', $message);
	}

	/**
	 * flash error
	 *
	 * @param      <type>  $message  The message
	 */
	public function flash_exist($message) {
		$this->_ci->session->set_flashdata('alert-exist', $message);
	}

	/**
	 * global retrieve session in view, controller.
	 *
	 * @param      <type>  $session_name  The session name
	 *
	 * @return     <type>  The session.
	 */
	public function get_session($session_name) {
		if (!empty($session_name)) {
			return isset($_SESSION[$session_name]) ? $_SESSION[$session_name] : NULL;
		} else {
			return NULL;
		}
	}

	/**
	 * Determines if it has session.
	 *
	 * @param      <type>   $key    The key
	 *
	 * @return     boolean  True if has session, False otherwise.
	 */
	public function has_session($key) {
		return $this->_ci->session->has_userdata($key);
	}

	/**
	 * destroy when log out.
	 */
	public function destroy() {
		$this->_ci->session->sess_destroy();
	}

	/**
	 * destroy specific session only.
	 *
	 * @param      <type>  $session_name  The session name
	 */
	public function unset_session($session_name) {
		unset($_SESSION[$session_name]);
	}

	/**
	 * Sets the flashdata.
	 *
	 * @param      <type>  $data   The data
	 * @param      <type>  $value  The value
	 */
	public function set_flashdata($data, $value = null) {
		$this->_ci->session->set_flashdata($data, $value);
	}

	/**
	 * { function_description }
	 *
	 * @param      <type>  $key    The key
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function flashdata($key = null) {
		return $this->_ci->session->flashdata($key);
	}

}

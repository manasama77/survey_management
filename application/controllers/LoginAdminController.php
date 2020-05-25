<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginAdminController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['cookie', 'string']);
	}

	public function index()
	{
		$cookies = get_cookie('surveybaik');

		if($cookies != NULL){
			$check_cookies = $this->mcore->get('admin', '*', ['cookies' => $cookies], NULL, 'ASC', NULL, NULL);

			if($check_cookies->num_rows() == 1){
				$id       = $check_cookies->row()->id;
				$username = $check_cookies->row()->username;
				$this->_set_session($id, $username);
				redirect(base_url().'admin/dashboard','refresh');
			}else{
				delete_cookie('surveybaik');
				redirect(base_url(),'refresh');
			}
		}else{
			$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
			$this->form_validation->set_rules('password', 'Password', 'callback_password_check');

			if ($this->form_validation->run() === FALSE) {
				$this->load->view('login/admin');
			}else{
				$username = $this->input->post('username');
				$where = [
					'username'   => $username,
					'deleted_at' => NULL
				];
				$arr      = $this->mcore->get('admin', '*', $where, NULL, 'ASC', NULL, NULL);
				$id       = $arr->row()->id;
				$username = $arr->row()->username;
				$this->_set_session($id, $username);

				$remember = $this->input->post('remember');
				if($remember == 'on'){
					$key_cookies = random_string('alnum', 64);
					set_cookie('surveybaik', $key_cookies, 3600*24*30);
					$this->mcore->update('admin', ['cookies' => $key_cookies, 'remember' => '1'], ['id' => $id]);	
				}
				
				redirect(site_url('admin/dashboard'));
			}
		}
	}

	public function username_check($str)
	{
		$where = [
			'username'   => $str,
			'deleted_at' => NULL
		];
		$arr = $this->mcore->get('admin', '*', $where, NULL, 'ASC', NULL, NULL);

		if ($arr->num_rows() == 0) {
			$this->form_validation->set_message('username_check', '{field} Tidak ditemukan');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function password_check($str)
	{
		$username = $this->input->post('username');
		$password = sha1($str.UYAH);
		$where = [
			'username'   => $username,
			'deleted_at' => NULL
		];
		$arr = $this->mcore->get('admin', '*', $where, NULL, 'ASC', NULL, NULL);
		if ($arr->num_rows() == 0) {
			// $this->form_validation->set_message('password_check', 'Username Tidak ditemukan');
			// return FALSE;
		} else {
			$db_pass  = $arr->row()->password;

			if ($password == $db_pass) {
				return TRUE;
			} else {
				$this->form_validation->set_message('password_check', '{field} Salah, silahkan cek kembali');
				return FALSE;
			}
		}
	}

	public function _set_session($id, $username)
	{
		$this->session->set_userdata(SESS.'id', $id);
		$this->session->set_userdata(SESS.'username', $username);
	}

	public function logout()
	{
		delete_cookie('surveybaik');
		$this->session->unset_userdata(SESS.'id');
		$this->session->unset_userdata(SESS.'username');
		redirect(site_url().'','refresh');
	}
}

/* End of file LoginAdminController.php */
/* Location: ./application/controllers/LoginAdminController.php */

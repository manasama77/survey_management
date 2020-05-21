<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginAdminController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login_admin', 'madmin');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'callback_password_check');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('login/admin');
		} else {
			$username = $this->input->post('username');
			$where = [
				'username'   => $username,
				'deleted_at' => NULL
			];
			$arr = $this->mcore->get('admin', '*', $where, NULL, 'ASC', NULL, NULL);
			$this->session->set_userdata(SESS.'id', $arr->row()->id);
			$this->session->set_userdata(SESS.'username', $username);
			redirect(site_url('admin/dashboard'));
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

	public function logout()
	{
		$this->session->unset_userdata(SESS.'id');
		$this->session->unset_userdata(SESS.'username');
		redirect(site_url().'','refresh');
	}
}

/* End of file LoginAdminController.php */
/* Location: ./application/controllers/LoginAdminController.php */

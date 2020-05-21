<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WelcomeController extends CI_Controller
{

	public function index()
	{
		$this->load->view('welcome');
	}

	public function init_admin()
	{
		$now      = new DateTime();
		$id_admin = $this->uuid->v4();
		$password = sha1('admin'.UYAH);

		# INIT ROLE
		##################################################################
		$data_admin[0] = [
			'id'         => $id_admin,
			'username'   => 'admin',
			'password'   => $password,
			'created_at' => $now->format('Y-m-d H:i:s'),
			'updated_at' => $now->format('Y-m-d H:i:s'),
			'deleted_at' => NULL
		];

		$exec = $this->mcore->store_batch('admin', $data_admin);
		##################################################################
	}
}

/* End of file WelcomeController.php */
/* Location: ./application/controllers/WelcomeController.php */

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
		$this->load->model('M_account_less', 'mless');
	}

	public function index()
	{
		$data['title']   = 'List Akun';
		$data['content'] = 'account/index';
		$data['vitamin'] = 'account/index_vitamin';
		$this->template->template($data);
	}

	public function create()
	{
		$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('verify_password', 'Verify Password', 'required|trim|matches[password]', array('matches' => '{field} tidak sama dengan field Password'));

		$this->form_validation->set_error_delimiters('<span class="help-block text-red">', '</span>');

		if ($this->form_validation->run() === FALSE) {
			$data['title']   = 'Tambah Akun';
			$data['content'] = 'account/form';
			$data['vitamin'] = 'account/form_vitamin';
			$this->template->template($data);
		}else{
			$cur_date = new DateTime('now');
			$id       = $this->uuid->v4();
			$username = $this->input->post('username');
			$password = sha1($this->input->post('password').UYAH);

			$object = [
				'id'         => $id,
				'username'   => $username,
				'password'   => $password,
				'created_at' => $cur_date->format('Y-m-d H:i:s'),
				'updated_at' => $cur_date->format('Y-m-d H:i:s'),
				'deleted_at' => NULL
			];
			$exec = $this->mcore->store('admin', $object);

			if($exec === TRUE){
				$this->session->set_flashdata('success', TRUE);
				redirect(site_url().'admin/account/create','refresh');
			}else{
				$this->session->set_flashdata('error', TRUE);
				redirect(site_url().'admin/account/create','refresh');
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

		if ($arr->num_rows() > 0) {
			$this->form_validation->set_message('username_check', '{field} sama ditemukan, silahkan gunakan username lain');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function datatables()
	{
		$list = $this->mless->get_datatables();
		$data = array();
		$no   = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row             = array();
			$row['no']       = $no;
			$row['id']       = $field->id;
			$row['username'] = $field->username;
			$data[]          = $row;
		}

		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->mless->count_all(),
			"recordsFiltered" => $this->mless->count_filtered(),
			"data"            => $data,
		);

		echo json_encode($output);
	}

	public function destroy()
	{
		$cur_date = new DateTime('now');
		$id = $this->input->post('id');

		$object = ['deleted_at' => $cur_date->format('Y-m-d H:i:s')];
		$where  = ['id' => $id];
		$exec   = $this->mcore->update('admin', $object, $where);

		if($exec){
			$ret = ['code' => 200];
		}else{
			$ret = ['code' => 500];
		}

		echo json_encode($ret);
	}

	public function reset()
	{
		$id = $this->input->post('id');
		$password = sha1($this->input->post('password').UYAH);

		$object = ['password' => $password];
		$where  = ['id' => $id];
		$exec   = $this->mcore->update('admin', $object, $where);

		if($exec){
			$ret = ['code' => 200];
		}else{
			$ret = ['code' => 500];
		}

		echo json_encode($ret);
	}

}

/* End of file AccountController.php */
/* Location: ./application/controllers/AccountController.php */
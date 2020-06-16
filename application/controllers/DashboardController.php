<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
	}

	public function index()
	{
		$data['title']   = 'Dashboard';
		$data['content'] = 'dashboard/index';
		$data['vitamin'] = 'dashboard/index_vitamin';

		$data['admin_count']        = $this->mcore->count('admin', ['deleted_at' => NULL]);
		$data['survey_aktif_count'] = $this->mcore->count('master_survey', ['status_survey' => '1']);
		$data['survey_close_count'] = $this->mcore->count('master_survey', ['status_survey' => '2']);

		$this->template->template($data);

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML('<h1>test</h1>');
		$mpdf->Output();
	}

}

/* End of file DashboardController.php */
/* Location: ./application/controllers/DashboardController.php */
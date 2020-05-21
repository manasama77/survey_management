<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SurveyController extends CI_Controller {

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

		$data['admin_count'] = $this->mcore->count('admin', ['deleted_at' => NULL]);

		$this->template->template($data);
	}

	public function create()
	{
		$this->form_validation->set_rules('nama_survey', 'Nama Survey', 'required');
		$this->form_validation->set_rules('desc_survey', 'Deskripsi Survey', 'required');
		$this->form_validation->set_rules('periode_survey_1', 'Periode Awal', 'required');
		$this->form_validation->set_rules('periode_survey_2', 'Periode Akhir', 'required');
		$this->form_validation->set_rules('jenis_responden', 'Jenis Responden', 'required');

		if ($this->form_validation->run() === FALSE) {

			$temp_id_master_survey = $this->session->userdata(SESS.'temp_id_master_survey');
			// $this->session->unset_userdata(SESS.'temp_id_master_survey');
			$data['title']   = 'Buat Survey';
			$data['content'] = 'survey/form';
			$data['vitamin'] = 'survey/form_vitamin';

			$data['temp_id_master_survey'] = $temp_id_master_survey;

			if($temp_id_master_survey != ''){
				$where = ['id' => $temp_id_master_survey];
				$data['arr'] = $this->mcore->get('master_survey', '*', $where, NULL, NULL, NULL, NULL);
			}

			$this->template->template($data);

		}else{

			$id               = $this->uuid->v4();
			$nama_survey      = $this->input->post('nama_survey');
			$desc_survey      = $this->input->post('desc_survey');
			$periode_survey_1 = $this->input->post('periode_survey_1');
			$periode_survey_2 = $this->input->post('periode_survey_2');
			$status_survey    = '0';
			$jenis_responden  = $this->input->post('jenis_responden');
			$url              = $this->_generate_url();

			$object = compact(
				'id', 
				'nama_survey', 
				'desc_survey', 
				'periode_survey_1', 
				'periode_survey_2', 
				'status_survey', 
				'jenis_responden',
				'url'
			);
			$exec = $this->mcore->store('master_survey', $object);

			if($exec === FALSE){
				echo GA_KONEK;
			}else{
				$this->session->set_userdata(SESS.'temp_id_master_survey', $id);
				redirect(site_url().'admin/survey/create_question','refresh');
			}

		}
	}

	public function create_question()
	{
		$temp_id_master_survey = $this->session->userdata(SESS.'temp_id_master_survey');

		if($temp_id_master_survey == NULL){
			redirect(site_url().'admin/survey/create','refresh');
		}else{



		}
	}

	public function _generate_url($URLlength = 8)
	{
		$url = '';
		$charray = array_merge(array_merge(range('A','Z'), range('a','z')), range('2','9'));
		$max = count($charray) - 1;
		for ($i = 0; $i < $URLlength; $i++) {
			$randomChar = mt_rand(0, $max);
			$url .= $charray[$randomChar];
		}

		$check = $this->mcore->count('master_survey', ['url' => $url]);

		if($check > 0){
			$this->_generate_url();
			exit;
		}else{
			return $url;
		}
	}

}

  /* End of file SurveyController.php */
/* Location: ./application/controllers/SurveyController.php */
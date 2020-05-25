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

	public function create($new = NULL)
	{
		$this->form_validation->set_rules('nama_survey', 'Nama Survey', 'required');
		$this->form_validation->set_rules('desc_survey', 'Deskripsi Survey', 'required');
		$this->form_validation->set_rules('periode_survey_1', 'Periode Awal', 'required');
		$this->form_validation->set_rules('periode_survey_2', 'Periode Akhir', 'required');
		$this->form_validation->set_rules('jenis_responden', 'Jenis Responden', 'required');

		$temp_id_master_survey = $this->session->userdata(SESS.'temp_id_master_survey');

		if ($this->form_validation->run() === FALSE) {

			$data['title']   = 'Buat Survey';
			$data['content'] = 'survey/form';
			$data['vitamin'] = 'survey/form_vitamin';

			if($new == 'new'){
				$this->session->unset_userdata(SESS.'temp_id_master_survey');
				$temp_id_master_survey   = NULL;
				$data['arr']             = '';
				$data['jenis_responden'] = '';
			}else{
				if($temp_id_master_survey != ''){
					$where       = ['id' => $temp_id_master_survey];
					$data['arr'] = $this->mcore->get('master_survey', '*', $where, NULL, NULL, NULL, NULL);
					$data['jenis_responden'] = $data['arr']->row()->jenis_responden;
				}else{
					$this->session->unset_userdata(SESS.'temp_id_master_survey');
					redirect(site_url().'admin/survey/create/new','refresh');
				}
			}

			$data['temp_id_master_survey'] = $temp_id_master_survey;
			$data['new']                   = $new;

			$this->template->template($data);

		}else{
			$nama_survey      = $this->input->post('nama_survey');
			$desc_survey      = $this->input->post('desc_survey');
			$periode_survey_1 = $this->input->post('periode_survey_1');
			$periode_survey_2 = $this->input->post('periode_survey_2');
			$status_survey    = '0';
			$jenis_responden  = $this->input->post('jenis_responden');
			$id_temp          = $this->input->post('id_temp');

			if($id_temp != NULL){
				$object = compact(
					'nama_survey', 
					'desc_survey', 
					'periode_survey_1', 
					'periode_survey_2',
					'jenis_responden'
				);
				$where = ['id' => $id_temp];
				$exec  = $this->mcore->update('master_survey', $object, $where);
				$id    = $id_temp;
			}else{
				$id  = $this->uuid->v4();
				$url = $this->_generate_url();

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
			}
			
			if($exec === FALSE){
				echo GA_KONEK;
			}else{
				$this->session->set_userdata(['temp_id_master_survey' => $id]);
				redirect(site_url().'admin/survey/create_question','refresh');
			}

		}
	}

	public function create_question()
	{
		$temp_id_master_survey = $this->session->userdata('temp_id_master_survey');

		# clean junk
		$this->mcore->delete('question', ['id_created' => $this->session->userdata(SESS.'id'), 'id_survey' => $temp_id_master_survey]);
		$this->mcore->delete('answer', ['id_created' => $this->session->userdata(SESS.'id'), 'id_survey' => $temp_id_master_survey]);

		if($temp_id_master_survey == NULL){
			redirect(site_url().'admin/survey/create/new','refresh');
		}else{
			$where       = ['id' => $temp_id_master_survey];
			$data['arr'] = $this->mcore->get('master_survey', '*', $where, NULL, 'ASC', NULL, NULL);

			$data['title']   = 'Buat Survey';
			$data['content'] = 'survey/form_2';
			$data['vitamin'] = 'survey/form_2_vitamin';

			$data['temp_id'] = $temp_id_master_survey;

			$this->template->template($data);

		}
	}

	public function store_q()
	{
		$id_question      = $this->input->post('id_question');
		$field_question   = $this->input->post('field_question');
		$value_question   = $this->input->post('value_question');

		if($field_question == 'question'){
			$field = 'desc';
		}elseif($field_question == 'type_question'){
			$field = 'type_respon';
			$this->_empty_answer($id_master_survey, $id_question);
		}elseif($field_question == 'desc_question'){
			$field = 'desc_respon';
		}

		$object_question = [$field => $value_question];
		$where_question  = ['id' => $id_question];
		$exec            = $this->mcore->update('question', $object_question, $where_question);

		if($exec){
			$return = ['code' => 200];
		}else{
			$return = ['code' => 500];
		}

		echo json_encode($return);
	}

	public function store()
	{
		echo '<pre>'.print_r($this->input->post(), 1).'</pre>';
	}

	public function generate_id_question()
	{
		$id        = $this->uuid->v4();
		$id_survey = $this->input->get('id_survey');
		$this->mcore->store('question', ['id' => $id, 'id_survey' => $id_survey, 'id_created' => $this->session->userdata(SESS.'id')]);
		echo json_encode(['res' => $id]);
	}

	public function generate_id_answer_pg()
	{
		$id          = $this->uuid->v4();
		$id_survey   = $this->input->get('id_survey');
		$id_question = $this->input->get('id_question');

		$where_delete = [
			'id_survey'   		=> $id_survey,
			'id_question' 		=> $id_question,
			'type_respon !=' 	=> '2'
		];
		$this->mcore->delete('answer', $where_delete);
		$this->mcore->update('question', ['type_respon' => '2'], ['id' => $id_question]);

		$object_store = [
			'id'          => $id,
			'id_survey'   => $id_survey,
			'id_question' => $id_question,
			'type_respon' => '2',
			'desc_respon' => NULL,
			'id_created'  => $this->session->userdata(SESS.'id')
		];
		$this->mcore->store('answer', $object_store);
		echo json_encode(['id' => $id]);
	}

	public function gen_a_satu()
	{
		$id_survey   = $this->input->get('id_survey');
		$id_question = $this->input->get('id_question');
		$id_a        = $this->uuid->v4();
		$id_b        = $this->uuid->v4();

		$this->mcore->delete('answer', ['id_survey' => $id_survey, 'id_question' => $id_question]);
		$this->mcore->update('question', ['type_respon' => '1'], ['id' => $id_question]);

		$object[0] = [
			'id'          => $id_a,
			'id_survey'   => $id_survey,
			'id_question' => $id_question,
			'type_respon' => '1',
			'desc_respon' => 'Ya',
			'id_created'  => $this->session->userdata(SESS.'id'),
		];
		$object[1] = [
			'id'          => $id_b,
			'id_survey'   => $id_survey,
			'id_question' => $id_question,
			'type_respon' => '1',
			'desc_respon' => 'Tidak',
			'id_created'  => $this->session->userdata(SESS.'id')
		];
		$exec = $this->mcore->store_batch('answer', $object);

		echo json_encode([
			'code'    => 200,
			'id_a'    => $id_a,
			'id_b'    => $id_b,
			'value_a' => 'Ya',
			'value_b' => 'Tidak',
		]);
	}

	public function update_a_satu()
	{
		$id          = $this->input->post('id');
		$desc_respon = $this->input->post('desc_respon');

		$object = compact('desc_respon');
		$where  = compact('id');
		$this->mcore->update('answer', $object, $where);

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

	public function _empty_answer($id_master_survey, $id_question)
	{
		$where = [
			'id_survey'   => $id_master_survey,
			'id_question' => $id_question
		];
		$this->mcore->delete('answer', $where);
	}

}

/* End of file SurveyController.php */
/* Location: ./application/controllers/SurveyController.php */
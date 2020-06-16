<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SurveyController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
		$this->load->model('M_survey_less');
	}

	public function index()
	{
		$data['title']   = 'List Survey';
		$data['content'] = 'survey/index';
		$data['vitamin'] = 'survey/index_vitamin';

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
		$id = $this->input->post('id_master_survey');

		$this->mcore->update('master_survey', ['status_survey' => '1'], ['id' => $id]);
		$exec = $this->mcore->get('master_survey', 'url', ['id' => $id], NULL, 'ASC', NULL, NULL);
		redirect(site_url().'admin/survey/url/'.$exec->row()->url,'refresh');
	}

	public function generate_id_question()
	{
		$id           = $this->uuid->v4();
		$id_survey    = $this->input->get('id_survey');

		$where        = ['id_survey' => $id_survey];
		$arr_no_urut = $this->mcore->get('question', 'no_urut', $where, 'no_urut', 'DESC', NULL, NULL);

		if($arr_no_urut->num_rows() == '0'){
			$no_urut = '1';
		}else{
			$no_urut = $arr_no_urut->row()->no_urut + 1;
		}

		$object = [
			'id'         => $id,
			'id_survey'  => $id_survey,
			'id_created' => $this->session->userdata(SESS.'id'),
			'no_urut'    => $no_urut
		];
		$this->mcore->store('question', $object);
		echo json_encode(['res' => $id, 'found_last_no_urut' => $arr_no_urut->num_rows(), 'no_urut' => $no_urut]);
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

		$where_lnu = [
			'id_survey'   => $id_survey,
			'id_question' => $id_question,
			'type_respon' => '2',
		];
		$arr_no_urut = $this->mcore->get('answer', 'no_urut', $where_lnu, 'no_urut', 'DESC', NULL, NULL);

		if($arr_no_urut->num_rows() == 0){
			$last_no_urut = 0;
		}else{
			$last_no_urut = $arr_no_urut->row()->no_urut;
		}

		$new_no_urut = $last_no_urut + 1;

		$object_store = [
			'id'          => $id,
			'id_survey'   => $id_survey,
			'id_question' => $id_question,
			'type_respon' => '2',
			'desc_respon' => NULL,
			'id_created'  => $this->session->userdata(SESS.'id'),
			'no_urut'     => $new_no_urut
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
			'no_urut'     => '1',
		];
		$object[1] = [
			'id'          => $id_b,
			'id_survey'   => $id_survey,
			'id_question' => $id_question,
			'type_respon' => '1',
			'desc_respon' => 'Tidak',
			'id_created'  => $this->session->userdata(SESS.'id'),
			'no_urut'     => '2',
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

	public function gen_a_tiga()
	{
		$id_survey   = $this->input->get('id_survey');
		$id_question = $this->input->get('id_question');
		$id_a        = $this->uuid->v4();
		$id_b        = $this->uuid->v4();

		$this->mcore->delete('answer', ['id_survey' => $id_survey, 'id_question' => $id_question]);
		$this->mcore->update('question', ['type_respon' => '3'], ['id' => $id_question]);

		$object[0] = [
			'id'          => $id_a,
			'id_survey'   => $id_survey,
			'id_question' => $id_question,
			'type_respon' => '3',
			'desc_respon' => '1',
			'id_created'  => $this->session->userdata(SESS.'id'),
		];
		$object[1] = [
			'id'          => $id_b,
			'id_survey'   => $id_survey,
			'id_question' => $id_question,
			'type_respon' => '3',
			'desc_respon' => '10',
			'id_created'  => $this->session->userdata(SESS.'id')
		];
		$exec = $this->mcore->store_batch('answer', $object);

		echo json_encode([
			'code'    => 200,
			'id_a'    => $id_a,
			'id_b'    => $id_b,
			'value_a' => '1',
			'value_b' => '10',
		]);
	}

	public function gen_a_empat()
	{
		$id_survey   = $this->input->get('id_survey');
		$id_question = $this->input->get('id_question');
		$id_a        = $this->uuid->v4();

		$this->mcore->delete('answer', ['id_survey' => $id_survey, 'id_question' => $id_question]);
		$this->mcore->update('question', ['type_respon' => '4'], ['id' => $id_question]);

		$object[0] = [
			'id'          => $id_a,
			'id_survey'   => $id_survey,
			'id_question' => $id_question,
			'type_respon' => '4',
			'desc_respon' => NULL,
			'id_created'  => $this->session->userdata(SESS.'id'),
		];
		$exec = $this->mcore->store_batch('answer', $object);

		echo json_encode([
			'code'    => 200,
			'id_a'    => $id_a,
			'value_a' => NULL
		]);
	}

	public function delete_question()
	{
		$id = $this->input->post('id');

		$where_q = ['id' => $id];
		$this->mcore->delete('question', $where_q);

		$where_a = ['id_question' => $id];
		$this->mcore->delete('answer', $where_a);
	}

	public function delete_pg()
	{
		$id = $this->input->post('id');

		$where_a = ['id' => $id];
		$this->mcore->delete('answer', $where_a);
	}

	public function url($url)
	{
		$data['title']   = 'Share Survey';
		$data['content'] = 'survey/url';
		$data['vitamin'] = 'survey/url_vitamin';
		$data['url']     = $url;

		$where = ['url' => $url];
		$arr = $this->mcore->get('master_survey', '*', $where, NULL, 'ASC', NULL, NULL);
		$data['jenis_responden'] = $arr->row()->jenis_responden;

		$this->template->template($data);
	}

	public function datatables_survey()
	{
		$periode_1 = new DateTime();
		$periode_2 = new DateTime();
		$list = $this->M_survey_less->get_datatables();
		$data = array();
		$no   = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row['no']               = $no;
			$row['id']               = $field->id;
			$row['nama_survey']      = $field->nama_survey;
			$row['desc_survey']      = $field->desc_survey;
			$row['periode_survey_1'] = $periode_1->createFromFormat('Y-m-d', $field->periode_survey_1)->format('d-M-Y');
			$row['periode_survey_2'] = $periode_2->createFromFormat('Y-m-d', $field->periode_survey_2)->format('d-M-Y');

			if($field->status_survey == '1'){
				$status_survey = 'Aktif';
			}elseif($field->status_survey == '2'){
				$status_survey = 'Tidak Aktif';
			}
			$row['status_survey']    = $status_survey;

			$row['jenis_responden']  = ucfirst($field->jenis_responden);
			$row['url']              = site_url().$field->jenis_responden.'/'.$field->url;

			$data[] = $row;
		}

		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->M_survey_less->count_all(),
			"recordsFiltered" => $this->M_survey_less->count_filtered(),
			"data"            => $data,
		);

		echo json_encode($output);
	}

	public function change_status()
	{
		$id         = $this->input->post('id');
		$new_status = $this->input->post('new_status');

		$table  = 'master_survey';
		$object = ['status_survey' => $new_status];
		$where  = ['id' => $id];
		$exec   = $this->mcore->update($table, $object, $where);

		if($exec){
			$ret = ['code' => 200];
		}else{
			$ret = ['code' => 500];
		}

		echo json_encode($ret);
	}

	public function destroy()
	{
		$this->db->trans_begin();
		$id_ms    = $this->input->post('id');

		$where_ms = ['id' => $id_ms];
		$exec_ms  = $this->mcore->delete('master_survey', $where_ms);
		if($exec_ms === FALSE){
			$this->db->trans_rollback();
			echo json_encode(['code' => 500, 'desc' => 'Delete Master Survey Gagal']);
			exit;
		}

		$where_q = ['id_survey' => $id_ms];
		$exec_q  = $this->mcore->delete('question', $where_q);
		if($exec_q === FALSE){
			$this->db->trans_rollback();
			echo json_encode(['code' => 500, 'desc' => 'Delete Question Gagal']);
			exit;
		}

		$where_a = ['id_survey' => $id_ms];
		$exec_a  = $this->mcore->delete('answer', $where_a);
		if($exec_a === FALSE){
			$this->db->trans_rollback();
			echo json_encode(['code' => 500, 'desc' => 'Delete Answer Gagal']);
			exit;
		}

		$where_resp = ['id_survey' => $id_ms];
		$exec_resp  = $this->mcore->delete('responden', $where_resp);
		if($exec_resp === FALSE){
			$this->db->trans_rollback();
			echo json_encode(['code' => 500, 'desc' => 'Delete Responden Gagal']);
			exit;
		}

		$where_res = ['id_survey' => $id_ms];
		$exec_res  = $this->mcore->delete('result', $where_res);
		if($exec_res === FALSE){
			$this->db->trans_rollback();
			echo json_encode(['code' => 500, 'desc' => 'Delete Result Gagal']);
			exit;
		}

		$this->db->trans_commit();
		echo json_encode(['code' => 200, 'desc' => 'Delete Success']);
	}

	public function edit($id_master_survey)
	{
		$count_id = $this->mcore->count('master_survey', ['id' => $id_master_survey]);

		if($id_master_survey == NULL){
			echo show_error('ID Survey Tidak Ditemukan', 404, 'Terjadi Kesalahan');
			exit;
		}elseif($id_master_survey == ''){
			echo show_error('ID Survey Tidak Ditemukan', 404, 'Terjadi Kesalahan');
			exit;
		}elseif($count_id == 0){
			echo show_error('ID Survey Tidak Ditemukan', 404, 'Terjadi Kesalahan');
			exit;
		}

		$data['title']            = 'Edit Survey';
		$data['content']          = 'survey/form_edit';
		$data['vitamin']          = 'survey/form_edit_vitamin';
		$data['id_master_survey'] = $id_master_survey;

		$where_master       = ['id' => $id_master_survey];
		$data['arr_master'] = $this->mcore->get('master_survey', '*', $where_master, NULL, 'ASC', NULL, NULL);

		$this->template->template($data);

	}

	public function update_master()
	{
		$id               = $this->input->post('id');
		$nama_survey      = $this->input->post('nama_survey');
		$desc_survey      = $this->input->post('desc_survey');
		$periode_survey_1 = $this->input->post('periode_survey_1');
		$periode_survey_2 = $this->input->post('periode_survey_2');
		$jenis_responden  = $this->input->post('jenis_responden');

		$object = compact('nama_survey', 'desc_survey', 'periode_survey_1', 'periode_survey_2', 'jenis_responden');
		$where  = ['id' => $id];
		$exec   = $this->mcore->update('master_survey', $object, $where);

		if($exec){
			redirect(site_url().'admin/survey/edit2/'.$id,'refresh');
		}
	}

	public function edit2($id_master_survey)
	{
		$count_id = $this->mcore->count('master_survey', ['id' => $id_master_survey]);

		if($id_master_survey == NULL){
			echo show_error('ID Survey Tidak Ditemukan', 404, 'Terjadi Kesalahan');
			exit;
		}elseif($id_master_survey == ''){
			echo show_error('ID Survey Tidak Ditemukan', 404, 'Terjadi Kesalahan');
			exit;
		}elseif($count_id == 0){
			echo show_error('ID Survey Tidak Ditemukan', 404, 'Terjadi Kesalahan');
			exit;
		}

		$data['title']            = 'Edit Survey';
		$data['content']          = 'survey/form_edit2';
		$data['vitamin']          = 'survey/form_edit2_vitamin';
		$data['id_master_survey'] = $id_master_survey;

		$where_master       = ['id' => $id_master_survey];
		$data['arr_master'] = $this->mcore->get('master_survey', '*', $where_master, NULL, 'ASC', NULL, NULL);

		$this->template->template($data);

	}

	public function get_question()
	{
		$id_master_survey = $this->input->get('id_master_survey');

		$where_q = ['id_survey' => $id_master_survey];
		$arr_q   = $this->mcore->get('question', '*', $where_q, 'no_urut', 'ASC', NULL, NULL);

		if($arr_q->num_rows() == 0){
			echo json_encode(['code' => 404]);
			exit;
		}

		$haystack = array();
		foreach ($arr_q->result() as $q) {
			$q_nested['id_question']     = $q->id;
			$q_nested['pertanyaan']      = $q->desc;
			$q_nested['desc_pertanyaan'] = $q->desc_respon;
			$q_nested['type_respon']     = $q->type_respon;
			$q_nested['no_urut']         = $q->no_urut;
			$q_nested['jawabans']        = array();

			$where_a = ['id_survey' => $id_master_survey];
			$arr_a   = $this->mcore->get('answer', '*', $where_a, 'no_urut', 'ASC', NULL, NULL);
			foreach ($arr_a->result() as $a) {
				if($q->type_respon == $a->type_respon && $q->id == $a->id_question){
					$a_nested['id_jawaban'] = $a->id;
					$a_nested['jawaban']    = $a->desc_respon;
					$a_nested['no_urut']    = $a->no_urut;

					array_push($q_nested['jawabans'], $a_nested);
				}
			}
			array_push($haystack, $q_nested);
		}

		$data['haystack'] = $haystack;

		$ret = $this->load->view('admin/survey/render_question', $data, TRUE);

		echo json_encode(['code' => 200, 'data' => $ret, 'total' => $arr_q->num_rows()]);

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
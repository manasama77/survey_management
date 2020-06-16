<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnggotaController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_question', 'mquest');
	}

	public function index($url)
	{
		if($this->session->userdata('SRVYAnik') == NULL){
			$data['url'] = $url;
			$this->load->view('anggota/login', $data);
		}else{
			$where = ['url' => $url, 'status_survey !=' => '0', 'jenis_responden' => 'anggota'];
			$arr   = $this->mcore->get('master_survey', '*', $where, NULL, 'ASC', NULL, NULL);

			if($arr->num_rows() == 0){
				show_error('Survey Tidak Ditemukan', 500, 'Oops...');
				exit;
			}

			$cur_date                 = new DateTime();
			$date_from                = new DateTime();
			$date_to                  = new DateTime();
			$data['id_master_survey'] = $arr->row()->id;
			$data['nama_survey']      = $arr->row()->nama_survey;
			$data['desc_survey']      = $arr->row()->desc_survey;
			$data['url']              = $arr->row()->url;

			$periode_from = $date_from->createFromFormat('Y-m-d', $arr->row()->periode_survey_1);
			$periode_to   = $date_to->createFromFormat('Y-m-d', $arr->row()->periode_survey_2);

			if($arr->row()->status_survey == '2'){
				$status_survey = FALSE;
			}elseif($periode_from <= $cur_date && $cur_date <= $periode_to){
				$status_survey = TRUE;
			}else{
				$status_survey = FALSE;
			}

			$data['periode_from']  = $periode_from;
			$data['periode_to']    = $periode_to;
			$data['status_survey'] = $status_survey;
			$data['question']      = $this->mquest->get_question($arr->row()->id);
			$data['answer']        = $this->mquest->get_answer($arr->row()->id);

			$where_check = [
				'jenis'        => 'anggota',
				'responden_id' => $this->session->userdata('SRVYAno_ktp'),
				'id_survey'    => $data['id_master_survey'],
			];
			$arr_check = $this->mcore->count('responden', $where_check);

			if($arr_check == '0'){
				$data['check'] = FALSE;
			}else{
				$data['check'] = TRUE;
			}

			$this->load->view('anggota/index', $data);

		}
	}

	public function store($url)
	{
		$this->db->trans_begin();
		$where_ms          = ['url' => $url];
		$select_ms         = ['id', 'status_survey'];
		$arr_master_survey = $this->mcore->get('master_survey', $select_ms, $where_ms, NULL, 'ASC', NULL, NULL);

		if($arr_master_survey->num_rows() == 0){
			show_error('Survey tidak ditemukan', 404, 'Terjadi Kesalahan');
			exit;
		}

		if($arr_master_survey->row()->status_survey == '2'){
			show_error('Periode Survey telah berakhir', 404, 'Terjadi Kesalahan');
			exit;
		}

		$id_master_survey  = $arr_master_survey->row()->id;

		$where_question = ['id_survey' => $id_master_survey];
		$arr_question   = $this->mcore->get('question', '*', $where_question, 'no_urut', 'ASC', NULL, NULL);

		$id_responden     = $this->uuid->v4();
		$object_responden = [
			'id'            => $id_responden,
			'jenis'         => 'anggota',
			'responden_id'  => $this->input->post('no_ktp'),
			'nama'          => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('jk'),
			'umur'          => $this->input->post('umur'),
			'pendidikan'    => $this->input->post('pendidikan'),
			'id_survey'     => $id_master_survey,
		];
		$exec_responden = $this->mcore->store('responden', $object_responden);

		if($exec_responden === FALSE){
			$this->db->trans_rollback();
			show_error('Store Responden Gagal', 500, 'Koneksi bermasalah');
			exit;
		}

		$result = NULL;
		foreach ($arr_question->result() as $key) {
			$id_result   = $this->uuid->v4();
			$id_question = $key->id;
			$result[]    = [
				'id'           => $id_result,
				'id_survey'    => $id_master_survey,
				'id_question'  => $id_question,
				'id_responden' => $id_responden,
				'answer'       => $this->input->post($id_question),
			];
		}

		$table_result  = 'result';
		$exec_result   = $this->mcore->store_batch($table_result, $result);

		if($exec_result === FALSE){
			$this->db->trans_rollback();
			show_error('Store Responden Gagal', 500, 'Koneksi bermasalah');
			exit;
		}

		$this->db->trans_commit();
		$this->session->set_flashdata('success', TRUE);
		redirect(site_url().'anggota/'.$url, 'refresh');	
	}

	public function set_session()
	{
		$nik        = $this->input->post('nik');
		$nama       = $this->input->post('nama');
		$jk         = strtolower($this->input->post('jk'));
		$no_ktp     = $this->input->post('no_ktp');
		$umur       = $this->input->post('umur');
		$pendidikan = $this->input->post('pendidikan');

		$arr_session = [
			'SRVYAnik'        => $nik,
			'SRVYAnama'       => $nama,
			'SRVYAno_ktp'     => $no_ktp,
			'SRVYAumur'       => $umur,
			'SRVYAjk'         => $jk,
			'SRVYApendidikan' => $pendidikan
		];

		$this->session->set_userdata($arr_session);

		echo json_encode(['code' => 200]);
	}

	public function logout($url)
	{
		$arr_session = [
			'SRVYAnik',
			'SRVYAnama',
			'SRVYAno_ktp',
			'SRVYAumur',
			'SRVYAjk',
			'SRVYApendidikan'
		];

		$this->session->unset_userdata($arr_session);
		redirect('anggota/'.$url, 'refresh');
	}

	public function check_nia()
  {
		$cif_no = trim($this->input->get('cif_no', TRUE));
		if($cif_no == NULL){
			echo json_encode(['code' => 404]);
			exit;
		}

  	$url = 'http://app.baytulikhtiar.com/index.php/webservices/get_data_anggota';

    //url-ify the data for the POST
		$field_string = http_build_query(['cif_no' => $cif_no]);

    //open connection
		$ch = curl_init();

    //set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, $field_string);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

    //execute post
		$content = curl_exec($ch);
    //close connection
		curl_close($ch);
		$ret = json_decode($content);
		echo '<pre>'.print_r($ret, 1).'</pre>';
		exit;

		$data['nama']          = $ret->get_data_anggota[0]->nama;
		$data['panggilan']     = $ret->get_data_anggota[0]->panggilan;
		$data['jenis_kelamin'] = $ret->get_data_anggota[0]->jenis_kelamin;
		$data['majlis']        = $ret->get_data_anggota[0]->majlis;
		// $data['majlis']        = 'Nama Majlis';
		echo json_encode($data);
		exit;
  }

}

/* End of file AnggotaController.php */
/* Location: ./application/controllers/AnggotaController.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_question extends CI_Model {

	public function get_question($id_master_survey)
	{
		$this->db->select('
			question.id as id_question,
			question.desc as question,
			question.type_respon as type_question,
			question.desc_respon as desc_question
		');
		$this->db->where('question.id_survey', $id_master_survey);
		$this->db->order_by('question.no_urut', 'asc');
		return $this->db->get('question');
	}

	public function get_answer($id_master_survey)
	{
		$this->db->select('
			answer.id as id_answer,
			answer.id_question as id_question,
			answer.desc_respon as answer
		');
		$this->db->where('id_survey', $id_master_survey);
		$this->db->order_by('answer.no_urut', 'asc');
		return $this->db->get('answer');
	}

	

}

/* End of file M_question.php */
/* Location: ./application/models/M_question.php */
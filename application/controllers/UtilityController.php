<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UtilityController extends CI_Controller {

	public function generate_uuid()
	{
		echo json_encode(['res' => $this->uuid->v4()]);
	}

}

/* End of file UtilityController.php */
/* Location: ./application/controllers/UtilityController.php */
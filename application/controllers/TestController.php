<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestController extends CI_Controller {

	public function index()
	{
		$salt = 'microfinance';
		$pass = 'admin';
		echo sha1($pass.$salt);
		
	}

}

/* End of file TestController.php */
/* Location: ./application/controllers/TestController.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdServ extends CI_Controller {

	public function postpic()
	{
		$data = $this->uri->segment(3);
		$this->load->model('adserver');
		$this->adserver->getpic($data);

	}
}
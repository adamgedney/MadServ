<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function index()
	{

		// $this->session->set_userdata('loggedin','1');
		// $t = $this->session->userdata('loggedin');

		if($this->session->userdata('loggedin') == 1){
			$this->load->view('header-loggedin');
		}else{
			$this->load->view('header');
		}
		$this->load->view('landing-body');
		$this->load->view('footer');

	}// /index
}// /class
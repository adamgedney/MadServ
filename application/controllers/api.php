<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{

		if($this->session->userdata('loggedin') == 1){
			$this->load->view('header-loggedin');
		}else{
			$this->load->view('header');
		}

		$this->load->view('api-body');
		$this->load->view('footer');

	}// /index
}// /class
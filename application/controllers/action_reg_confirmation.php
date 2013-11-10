<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_reg_confirmation extends CI_Controller {

	public function index()
	{
		
		$this->load->view('header');
		$this->load->view('api-reg-confirmation');
		$this->load->view('footer');

	}// /index
}// /class


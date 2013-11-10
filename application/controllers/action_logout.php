<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_logout extends CI_Controller{

	function index()
	{

		//removes session data and sets loggedin state to "0"
		$this->session->set_userdata('loggedin','0');
		$this->session->set_userdata('permission','');
		$this->session->set_userdata('username','');

		//deletes the user's cookie on logout
		// $this->input->delete_cookie('keepme');
		
		header('Location: /');

	}// /index

}// /class

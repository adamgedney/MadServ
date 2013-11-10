<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_client_delete extends CI_Controller {

	public function index()
	{
		//this username should be
		//set by the session variable
		//and NOT by the form POST, for
		//security reasons
		$app_id = $this->session->userdata('username');

		$password = $_POST['password'];
		$passwordAgain = $_POST['password-again'];

		if($password == $passwordAgain){

				$hashed = md5($password);

				//load model then deleteUser function
				$this->load->model('auth_client');
				$this->auth_user->deleteClient($app_id,$hashed);

				//upon delete, reset session, log user out, and return to home
				$this->session->set_userdata('loggedin','0');
				$this->session->set_userdata('permission','');
				$this->session->set_userdata('username','');

				header('Location: /');
		}else{
			echo "passwords don't match";
		}

		
	}// /index
}// /class


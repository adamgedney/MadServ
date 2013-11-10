<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_client_update extends CI_Controller {

	public function index()
	{
		//this username should be
		//set by the session variable
		//and NOT by the form POST, for
		//security reasons
		$un = $this->session->userdata('username');


		$url = $_POST['url'];
		$redirect = $_POST['redirect-url'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordAgain = $_POST['password-again'];


		if($password == ""){

				$data = array(
					"url"=>$url,
					"redirect"=>$redirect,
					"email"=>$email,
					"status"=>'active',
					"permission"=>'client'
				);

				//load model then updateUser function
				$this->load->model('auth_client');
				$this->auth_client->updateClient($un,$data);

				//upon update, reload the admin settings page
				header('Location: /cms/client');


		}else{
			//checks that passwords match, then loads model, passing form values
			//to create new user in db
			if($password == $passwordAgain){

				//hash
				$pass = md5($password);

				$data = array(
					"first"=>$first,
					"last"=>$last,
					"email"=>$email,
					"password"=>$pass,
					"userstatus"=>'active'
				);

				//load model then updateUser function
				$this->load->model('auth_user');
				$this->auth_user->updateUser($un,$data);
				
				//upon update, reload the admin settings page
				header('Location: /cms/user');

			}else{
				echo "oops. Passwords don't match";
			}// /else passwords match
		}// else !password
		
	}// /index
}// /class


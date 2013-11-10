<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_login extends CI_Controller{

	function index()
	{

		$username = $_POST['username'];
		$password = $_POST['password'];

		// value returns "on" or NULL
		$keepme = $_POST['keep-me'];

		$data = array(
			"username"=>$username,
			"password"=>$password
			);

		$this->load->model('checklogin');
		$success = $this->checklogin->checkUser($data);

		if($success){
//***********************Note: I need to add username to cookie for return data to client form api
			//Login cookie handling
			// if($keepme == "on"){
			// 	$cookie = array(
			// 	    'name'   => 'keepme',
			// 	    'value'  => 'true',
			// 	    'expire' => 60 * 60 * 24 * 360,
			// 	    'domain' => 'http://madserv.us' . $_SERVER['REQUEST_URI']
			// 	);
			// }else{
			// 	$cookie = array(
			// 	    'name'   => 'keepme',
			// 	    'value'  => 'false',
			// 	    'expire' => 60 * 60 * 30,
			// 	    'domain' => 'http://madserv.us' . $_SERVER['REQUEST_URI']
			// 	);
			// }
			
			// $this->input->set_cookie($cookie);

			// $t = $this->input->cookie('keepme');
			// var_dump($cookie);
			// $this->input->cookie('user-status', TRUE);
			// $this->delete_cookie('name');


			//validation
			$this->load->model('validation');
			$userValid = $this->validation->validateLogin($username, $password);

			if($userValid){

				//permissions based routing in cms
				if($success['permission'] == "admin" && $success['userstatus'] == "active"){

					$this->session->set_userdata('loggedin','1');
					$this->session->set_userdata('permission','admin');
					$this->session->set_userdata('username',$username);

					header('Location: /cms/admin');

				}else if($success['permission'] == "user" && $success['userstatus'] == "active"){

					$this->session->set_userdata('loggedin','1');
					$this->session->set_userdata('permission','user');
					$this->session->set_userdata('username',$username);

					header('Location: /cms/user');

				}else if($success['permission'] == "client" && $success['status'] == "active"){

					$this->session->set_userdata('loggedin','1');
					$this->session->set_userdata('permission','client');
					$this->session->set_userdata('username',$username);

					header('Location: /cms/client');

				}else{
					$this->session->set_userdata('loggedin','0');

					header('Location: /');

				}// /if
			}else{

				header('Location: /');

			}// /if $valid
		}else{

			$this->session->set_userdata('loggedin','0');

			header('Location: /');
		}// /if $success
	}// /index




	function loggedin($username,$password)
	{


		$data = array(
			"username"=>$username,
			"password"=>$password
			);

		$this->load->model('checklogin');
		$success = $this->checklogin->checkUser($data);

		if($success){

			//validation, based on user type
			$this->load->model('validation');
			$userValid = $this->validation->validateLogin($username, $password);

			if($userValid){

				//permissions based routing in cms
				if($success['permission'] == "admin" && $success['userstatus'] == "active"){

					$this->session->set_userdata('loggedin','1');
					$this->session->set_userdata('permission','admin');
					$this->session->set_userdata('username',$username);

					header('Location: /cms/admin');

				}else if($success['permission'] == "user" && $success['userstatus'] == "active"){

					$this->session->set_userdata('loggedin','1');
					$this->session->set_userdata('permission','user');
					$this->session->set_userdata('username',$username);

					header('Location: /cms/user');

				}else if($success['permission'] == "client" && $success['status'] == "active"){

					$this->session->set_userdata('loggedin','1');
					$this->session->set_userdata('permission','client');
					$this->session->set_userdata('username',$username);

					header('Location: /cms/client');

				}else{
					$this->session->set_userdata('loggedin','0');

					header('Location: /');

				}// /if
			}else{

				header('Location: /');

			}// /if $valid
		}else{

			$this->session->set_userdata('loggedin','0');

			header('Location: /');
		}// /if $success

	}// /loggedin

}// /class

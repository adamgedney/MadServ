<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_user_registration extends CI_Controller {

	public function index()
	{
		$first = $_POST['first'];
		$last = $_POST['last'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$passwordAgain = $_POST['password-again'];

		$this->load->model('validation');
		$valid = $this->validation->validateUser($first, $last, $email, $username, $password);

		if($valid == "true"){

			//checks that passwords match, then loads model, passing form values
			//to create new user in db
			if($password == $passwordAgain){

				//hash
				$pass = md5($password);

				$form = array(
					"first"=>$first,
					"last"=>$last,
					"username"=>$username,
					"email"=>$email,
					"password"=>$pass,
					"userstatus"=>'active',
					"permission"=>'user'
				);

				//load model then newUser function
				$this->load->model('auth_user');
				$newUser['user'] = $this->auth_user->newUser($form);

				//logs user registration into database
				 $ip = $_SERVER['REMOTE_ADDR'];

				$api_id = '12345678';

				$userdata = array(
					'username'=>$username,
					'app_id'=>$api_id,
					'ip'=>$ip
				);

				$this->load->model('log');
				$this->log->logUserRequest($userdata);

				//redirects user to the home for login
				//change this after pages are built
				header('Location: /action_login/loggedin/' . $username . "/" . $password);

			}else{
				echo "oops. Passwords don't match";
			}// if passwords match
		}else{
			 
			echo $valid;
		}// /if valid
	}// /index
}// /class


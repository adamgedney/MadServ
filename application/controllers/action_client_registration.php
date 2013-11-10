<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_client_registration extends CI_Controller {

	public function index()
	{
		$company = $_POST['name'];
		$url = $_POST['url'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordAgain = $_POST['password-again'];

		 $ip = $_SERVER['REMOTE_ADDR'];


		$this->load->model('validation');
		$valid = $this->validation->validateClient($company, $url, $email, $password);

		if($valid == "true"){

			//checks that passwords match, then loads model, passing form values
			//to create new user in db
			if($password == $passwordAgain){

				//hash pw
				$pass = md5($password);

				//GENERATE app_id & key from hash of supplied data + salt
				$salt = "#4s..dk!h23JOKER";
				$app_id = substr(md5($company.$salt),0,8);
				$key = md5($salt.$url);

				$form = array(
					"company"=>$company,
					"url"=>$url,
					"email"=>$email,
					"password"=>$pass,
					"key"=>$key,
					"appId"=>$app_id,
					"status"=>'active',
					"permission"=>'client',
					"clientip"=>$ip
				);

				//load MODEL then newClient function
				$this->load->model('auth_client');
				$newClient['client'] = $this->auth_client->newClient($form);
				
				//MAIL new client info
				$header  = 'MIME-Version: 1.0' . "\r\n";
				$header .= "Reply-To: adam@adamgedney.com\r\n";
				$header .= "Return-Path: adam@adamgedney.com\r\n";
				$header .= 'From: MadServ <adam@adamgedney.com>' . "\r\n";
				$header .= 'Cc: adam@adamgedney.com';

				$to = $email;
				$subject = "MadServ Registration Info";

				$message = "Thanks for signing up with MadServ. \r\n Here is your unique API key and Your company's App ID. Store these in a safe place, and never share these ids with anyone. \r\n" . 
				"Key: " . $key . "\r\n" .
				"App ID: " . $app_id . "\r\n" . "\r\n" .
				"If you find you have any questions, please visit the API Documentation at: http://madserv.us/api \r\n" . 
				"Keep on Truckin! \r\n" .
				"The MadServ Team";
				
				//send email
				$success = mail($to,$subject,$message,$header);

				//redirects user to the cms
				//change this after pages are built
				header('Location: /action_reg_confirmation');

			}else{
				
				header('Location: /api');
				// echo "oops. Passwords don't match";
			}
		}else{
				header('Location: /api');
		}// /$valid
	}// /index
}// /class


<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_forgot_password extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$this->load->view('forgot-password');
		$this->load->view('footer');
		
	}// /index




	public function request_reset(){

		$un = $_POST['username'];

		$this->load->model('auth_user');
		$userdata = $this->auth_user->getUser($un);

		$email =$userdata[0]->email;



		//MAIL password reset info
			$header  = 'MIME-Version: 1.0' . "\r\n";
			$header .= "Reply-To: adam@adamgedney.com\r\n";
			$header .= "Return-Path: adam@adamgedney.com\r\n";
			$header .= 'From: MadServ <adam@adamgedney.com>' . "\r\n";
			$header .= 'Cc: adam@adamgedney.com';

			$to = $email;
			$subject = "MadServ Password Reset Request";

			$message = "Thanks you for being a MadServ user. \r\n Click the link below to be taken to a page where you'll be able to reset your password. If you have any problems, feel free to reply to this email for questions regarding password reset.\r\n \r\n" . 
			"http://localhost:8887/action_forgot_password/reset_link_clicked/" . $un . "\r\n" .
			"Keep on Truckin! \r\n \r\n" .
			"The MadServ Team";
			
			//send email
			mail($to,$subject,$message,$header);

			header('Location: /');
	}




	public function reset_link_clicked($user){

		$data['un'] = $user;

		$this->load->view('header');
		$this->load->view('reset-password', $data);
		$this->load->view('footer');

	}




	public function update_pass(){

		$un = $_POST['user'];
		$pass = $_POST['password'];
		$passAgain = $_POST['password-again'];


		if($pass == $passAgain){

			$pw = md5($pass);

			//sets status to active in case user is coming from a lockout
			$data = array(
				'userstatus'=>"active",
				'userblocked'=>"",
				'password'=>$pw
				);

			$this->load->model('auth_user');
			$this->auth_user->updateUser($un, $data);

			header('Location: /');
		}
	}

}// /class


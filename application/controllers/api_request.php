<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_Request extends CI_Controller {

	//client sends key + app_id
	//http://localhost:8887/api_request/validate_client/12345/balls
	function validate_client($app_id){

	 $ip = $_SERVER['REMOTE_ADDR'];


		$data = array(
			'app_id'=>$app_id,
			'ip'=>$ip
		);

	$this->load->model('log');
	$this->log->logClientRequest($data);

	//gets app key from database for authentication
	$this->load->model('auth_client');
	$dbKey = $this->auth_client->getKey($app_id);

	$makeSecret = md5($dbKey);
	$makeSecret .= md5($app_id);

// var_dump($dbKey);


    	$response = array(
			"secret"=>$makeSecret,
			"redirect"=>'http://madserv.us/api_request/user_login_request'
		);


		$encoded = json_encode($response);


		// header('Content-type: application/json');
		exit($encoded);

	}// /validate_app

	//controls user login view 
	//called by the redirect url sent to client after
	//client validation success
	function user_login_request($app_id, $redirect_to){

		//authenticates client again
		//to verify caller exists in database
		$this->load->model('auth_client');
		$response = $this->auth_client->getClient($app_id);
		
		//build array to pass into login form for transfer into
		//user_auth_function
		// $data['data'] = array(
		// 	'id'=>$response[0]->appId,
		// 	'redirect'=>$redirect_to
		// 	);

		$data['data'] ="?cid=" . $response[0]->appId . "&redirect=" . $redirect_to;
			

// var_dump($data);
		if($app_id == $response[0]->appId){
			$this->load->view('header');
			$this->load->view('user-login-body', $data);
			$this->load->view('footer');
		}else{
			header("Location: http://adamgedney.com");
			// echo "Client authentication failed. User will not be shown login page.";
		}// /if
	}// /user_login

	//User login authentication
	//occurs after user submits login form
	//result is redirect to client
	function user_login_auth(){

		//************************Check cookie. If user already logged in, then bypass login and
		//redirect right back to client with user data

		//if(isset($this->input->cookie('keepme'))){}

		//take apart data array
		$app_id = $_GET['cid'];
		$redirect_to = $_GET['redirect'];

		//user credentials form data
		$un = $_POST['username'];
		$pw = md5($_POST['password']);

		//logs user connection attempt into database

		 $ip = $_SERVER['REMOTE_ADDR'];
		
		$userdata = array(
			'username'=>$un,
			'app_id'=>$app_id,
			'ip'=>$ip
		);

		$this->load->model('log');
		$this->log->logUserRequest($userdata);

		//user credentials array
		$data = array(
			'username'=>$un,
			'password'=>$pw
			);

		//authenticates user from login fields
		$this->load->model('auth_user');
		$query = $this->auth_user->authUser($data);
		
		//if user is authenticated, prepare redirect to client
		if($query){
			$usn = $query['username'];
			$fn = $query['first'];
			$em = $query['email'];

			//retrieves client info to obtain predetermined redirect url
			// $this->load->model('auth_client');
			// $response = $this->auth_client->getClient($app_id);
			// $redirectURL = $response['redirect'];

			//redirect_to has come from client, stating where
			//to send user upon auth
			$redirectURL = $redirect_to;

			//outputs data in json string format for decoding by client
			$userdata = $usn;
			$userdata .= "," . $fn;
			$userdata .= "," . $em;

			//-------ENCRYPTION--------
			$encrypted = rawurlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($app_id), $userdata, MCRYPT_MODE_CBC, md5(md5($app_id)))));

   			//add userdata to redirect
			$redirectURL .= "/?en=" . $encrypted;

			//redirect back to client with appended encrypted data
			header("Location: http://" . $redirectURL);
		}
	}// /user_login_auth

	// // 
	// //to be given to client for encrypted data parsing
	// // 
	// function user_data(){
	// //=====================Decryption Algorithm======================

	// //encrypted data passed in the url on redirect
	// $userdata = $_GET['en'];
	// // $userdata = $data;

	// $app_id = 'df91512a';//replace with your App Id in string form

	// 	if($userdata){
	// 		//first decode the values retrieved from the callback
	// 		$userdata_dec = base64_decode($userdata);
		    
	// 	    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);

	// 	    //retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
	// 	    $iv_dec = substr($userdata_dec, 0, $iv_size);
		    
	// 	    //retrieves the cipher text (everything except the $iv_size in the front)
	// 	    $userdata_dec = substr($userdata_dec, $iv_size);

	// 	    //may remove 00h valued characters from end of plain text
	// 	    //uses your $app_if as the decryption key
	// 	    $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $app_id,$userdata_dec, MCRYPT_MODE_CBC, $iv_dec);

	// 	    //formatted so that he odd numbered indexes are the values
	// 	    //and even are the names for these values
	// 		$data_array = explode(',',$plaintext_dec);

	// 		//values interpreted for you already
	// 		$username = $data_array[1];
	// 		$name = $data_array[3];
	// 		$email = $data_array[5];

	// 		echo $name . "  " . $username . "  " . $email;
		   
	// 	}// /endif
	// }// /user_data

}// /class

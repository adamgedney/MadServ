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
	$dbKey= $this->auth_client->getKey($app_id);

	$makeSecret = md5($key);
	$makeSecret .= md5($app_id);

	if($dbKey){
		
		//-------ENCRYPTION--------
			# the key should be random binary, use scrypt, bcrypt or PBKDF2 to
		    # convert a string into a key
		    # key is specified using hexadecimal
		    $enckey = pack('H*', $key);
		    
		    # show key size use either 16, 24 or 32 byte keys for AES-128, 192
		    # and 256 respectively
		    $key_size =  strlen($enckey);

		    # create a random IV to use with CBC encoding
		    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

			//encryption of user data
			//ecrypted using the $app_id as a key
			$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,$makeSecret, MCRYPT_MODE_CBC, $iv);
			
			// prepend the IV for it to be available for decryption
   			$ciphertext = $iv . $ciphertext;

   			# encode the resulting cipher text so it can be represented by a string
    		$c64 = base64_encode($ciphertext);
    	//-------END ENCRYPTION--------

    	$response = array(
			"secret"=>$c64,
			"redirect"=>'/api_request/user_login_request'
			);


		$encoded = json_encode($response);


		header('Content-type: application/json');
		exit($encoded);

	}else{
		echo 'failure';
	}

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
		$data['data'] = array(
			'id'=>$response['appId'],
			'redirect'=>$redirect_url
			);

		if($app_id == $response['appId']){
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
	function user_login_auth($data){

		//take apart data array
		$app_id = $data['id'];
		$redirect_to = $data['redirect'];

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
			$un = $query['username'];
			$fn = $query['first'];
			$em = $query['email'];

			//retrieves client info to obtain predetermined redirect url
			// $this->load->model('auth_client');
			// $response = $this->auth_client->getClient($app_id);
			// $redirectURL = $response['redirect'];

			//redirect_to has come from client, stating where
			//to send user upon auth
			$redirectURL = $redirect_to;

			//outputs data in jsn string format for decoding by client
			$userdata = "/?en=username," . $un;
			$userdata .= ",first-name," . $fn;
			$userdata .= ",email," . $em;

			//-------ENCRYPTION--------
			# the key should be random binary, use scrypt, bcrypt or PBKDF2 to
		    # convert a string into a key
		    # key is specified using hexadecimal
		    $key = pack('H*', $app_id);
		    
		    # show key size use either 16, 24 or 32 byte keys for AES-128, 192
		    # and 256 respectively
		    $key_size =  strlen($key);

		    # create a random IV to use with CBC encoding
		    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

			//encryption of user data
			//ecrypted using the $app_id as a key
			$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $app_id,$userdata, MCRYPT_MODE_CBC, $iv);
			
			// prepend the IV for it to be available for decryption
   			$ciphertext = $iv . $ciphertext;

   			# encode the resulting cipher text so it can be represented by a string
    		$c64 = base64_encode($ciphertext);

   			//add userdata to redirect
			$redirectURL .= "/?en=" . $c64;

			//redirect back to client with appended encrypted data
			header("Location: " . $redirectURL);
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

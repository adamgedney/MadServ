<?php
//©2013 MadServ
//all rights reserved
//version 1.1
//
//
//This file is a model file. It handles the get requests and return data
//from the MadServ API for user authentication requests.
//
//You only need to edit your key, app id, and redirect_to. Everything else has been handled for you.
//Happy Sailing!


//=======================================Edit This===================================
//Just replace the key and app id with the ones 
//you received when you registered with MadServ
$key = '58c712713bda048ac50e20e99ed9111c';
$app_id = 'df91512a';

//This is YOUR site. This is where the user will be returned to after
//he/she has been authenticated by MadServ. Handle this however you'd like.
$redirect_to = 'http://adamgedney.com';



//=============================Don't edit anything below here========================

//built url, properly formatted for API
$url = 'http://madserv.us/';
$url .= '/api_request/validate_client/';
$url .= $app_id;

// 1. makes a REQUEST to the API to authenticate your app
$request = file_get_contents($url);

// 2. decodes the JSON REPLY from the API for use
$decoded = json_decode(stripslashes($request), TRUE);

$apiSecret = $decoded['secret'];
$redirectURL = $decoded['redirect'];


	//--------Decryption of secret-------------------
	$userdata_dec = base64_decode($apisecret);
			    
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);

	//retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
	$iv_dec = substr($userdata_dec, 0, $iv_size);

	//retrieves the cipher text (everything except the $iv_size in the front)
	$userdata_dec = substr($userdata_dec, $iv_size);

	//may remove 00h valued characters from end of plain text
	//uses your $key as the decryption key
	$decsecret = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,$userdata_dec, MCRYPT_MODE_CBC, $iv_dec);



//----------authenticating secret------------------
//hashes your key & app_id to build your secret
//for API identification verification
$appSecret = md5($key);
$appSecret .= md5($app_id);


// 3. checks secret key to be sure response was from the API
//and not from some evil hacker named Mike
if($decsecret == $appSecret){

	// 4. upon success, the user is redirected to the API for authentication
	header("Location: " . $redirectURL . "/" . $app_id . "/" . $redirect_to);

}else{
	if(!$decoded){ 
		$r = "NULL. Get from API failed.";
	}else{
		$r = " Secrets don't match. Beware! Someone may be trying to impersonate the MadServ API.";
	}

	echo "Server response: " . $r;
}
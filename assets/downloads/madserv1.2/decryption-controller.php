<?php
//©2013 MadServ
//all rights reserved
//version 1.1
//
//
//This file contains the user_data controller function.
//It's responsible for running the decryption algorithm after your user has
//been authenticated by the API.
//You'll find 3 variables at the end of the function. Those are the decrypted & parsed
//data that is a response from the API about the user just authenticated.
// 
//This function must be placed inside your controller handling the return data redirect
//that occurs after your user has been authenticated by the MadServ API.
//You specified this controller as a segment in your redirect URL that you
//submitted when you registered to use the API. If you don't remember your URL
//structure, or if you need to make a change, please email adam@adamgedney.com
//and a support ticket will be registered.
//Happy fishing!
//
//

function user_data(){

//==============================EDIT THIS SECTION=============================================
	//encrypted data passed in the url on redirect
	$userdata = $_GET['en'];

	$app_id = 'df91512a';//replace with your App Id in string form

//==============================DO NOT EDIT THIS SECTION======================================

	//=====================Decryption Algorithm======================
		if($userdata){
			//first decode the values retrieved from the callback
			$userdata_dec = base64_decode($userdata);
		    
		    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);

		    //retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
		    $iv_dec = substr($userdata_dec, 0, $iv_size);
		    
		    //retrieves the cipher text (everything except the $iv_size in the front)
		    $userdata_dec = substr($userdata_dec, $iv_size);

		    //may remove 00h valued characters from end of plain text
		    //uses your $app_if as the decryption key
		    $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $app_id,$userdata_dec, MCRYPT_MODE_CBC, $iv_dec);

		    //formatted so that he odd numbered indexes are the values
		    //and even are the names for these values
			$data_array = explode(',',$plaintext_dec);


//===================Use these variables, and feel free to EDIT AFTER THIS POINT=================
			
			//values interpreted for you already
			$username = $data_array[1];
			$name = $data_array[3];
			$email = $data_array[5];

			// echo $name . "  " . $username . "  " . $email;
			// return "";
		   
		}// /endif
	}// /user_data
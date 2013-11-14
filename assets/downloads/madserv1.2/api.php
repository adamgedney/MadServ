<?php
//©2013 MadServ
//all rights reserved
//version 1.1
//
//
//This file contains the user_data controller function and an example of how you 
//may want to handle the return data from the API.
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
if(isset($_GET['action'])){

	if($_GET['action'] == "action_api"){

		require './models/request.php';


	}
}

//This is a necessary condition. It's advisable to stick the block in the constructor
//of your API controller
if(isset($_GET['en'])){
	
//==============================EDIT THIS SECTION=============================================

	$app_id = 'df91512a';//replace with your App Id in string form

//==============================DO NOT EDIT THIS SECTION======================================

	//encrypted data passed in the url on redirect
	$userdata = $_GET['en'];

	//=====================Decryption Algorithm======================
	if($userdata){
		
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($app_id), base64_decode(rawurldecode($userdata)), MCRYPT_MODE_CBC, md5(md5($app_id))), "\0");

	    //formatted so that he odd numbered indexes are the values
	    //and even are the names for these values
		$data_array = explode(',',$decrypted);


//===================Use these variables, and feel free to EDIT AFTER THIS POINT=================
			
		//values interpreted for you already
		$username = $data_array[0];
		$name = $data_array[1];
		$email = $data_array[2];

		var_dump($name);

		// echo $name . "  " . $username . "  " . $email;
		// return "";
		   
	}// /endif
} // /en isset
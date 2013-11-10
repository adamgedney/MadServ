<?php 
 class Validation extends CI_Model {

	

	public function validateLogin($username, $password){
		
		$unPat = "/^[^,]+$/";//does not allow commas
		$passPat = "/^[a-zA-Z]\w{3,14}$/"; //4-15 char abcd aBcd ac3D

		//preg_match compares regex to string
		if(!preg_match($unPat, $username) && preg_match($passPat, $password)){
			return "Username Invalid";
		}else if(!preg_match($passPat, $password) && preg_match($unPat, $username)){
			return "Password Invalid";
		}else if(!preg_match($unPat, $username) && !preg_match($passPat, $password)){
			return "Username & Password Invalid";
		}else{
			return "true";
		}

	}// /validateLogin




	public function validateUser($first, $last, $email, $username, $pass){

		$emailPat = "/^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$/"; // standard email validation
		$unPat = "/^[^,]+$/";//does not allow commas
		$passPat = "/^[a-zA-Z]\w{3,14}$/"; //4-15 char abcd aBcd ac3D

		if(!preg_match($emailPat, $email)){
			return "Email Invalid";
		}else if(!preg_match($unPat, $first)){
			return "First Name Invalid. No special caharacters.";
		}else if(!preg_match($unPat, $last)){
			return "Last Name Invalid. No special characters.";
		}else if(!preg_match($unPat, $username)){
			return "Username Invalid";
		}else if(!preg_match($passPat, $pass)){
			return "Password Invalid";
		}else{
			return "true";
		}
	}// /validateReg




	public function validateClient($name, $url, $email, $pass){

		$namePat = "/^[^,]+$/";//does not allow commas
		$urlPat = "/^(ht|f)tp(s?)\:\/\/(([a-zA-Z0-9\-\._]+(\.[a-zA-Z0-9\-\._]+)+)|localhost)(\/?)([a-zA-Z0-9\-\.\?\,\'\/\\\+&amp;%\$#_]*)?([\d\w\.\/\%\+\-\=\&amp;\?\:\\\&quot;\'\,\|\~\;]*)$/";//does not allow commas
		$emailPat = "/^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$/"; // standard email validation
		$passPat = "/^[a-zA-Z]\w{3,14}$/"; //4-15 char abcd aBcd ac3D

		if(!preg_match($emailPat, $email)){
			return "Email Invalid";
		}else if(!preg_match($namePat, $name)){
			return "Name Invalid. No special caharacters.";
		}else if(!preg_match($urlPat, $url)){
			return "URL Invalid";
		}else if(!preg_match($passPat, $pass)){
			return "Password Invalid";
		}else{
			return "true";
		}
	}// /validateReg

}// Class
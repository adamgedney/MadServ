<?php

 class Checklogin extends CI_Model {

 	public function __construct()
    {
        $this->load->database();
    }

	function checkUser($data){

		$hashed = md5($data['password']);

		$query = $this->db->get_where('users', array('username'=>$data['username'], 'password'=>$hashed));
		$success = $query->row_array();

		if($success){
			return $success;
		}else{

			//if user did not exist, check if login was from a client using an app id
			$query = $this->db->get_where('clients', array('appId'=>$data['username'], 'password'=>$hashed));
			$success = $query->row_array();

			if($success>0){
				return $success;
			}else{
				return 0;
			}// /else
		}// /else
	 }// /checkUser
}// /class
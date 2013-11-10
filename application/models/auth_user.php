<?php

 class Auth_user extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }



    function getUser($username){

		$query = $this->db->get_where('users', array('username' => $username));
		return $query->result();

	}// /getUser



	function getUsers(){

		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by("joined", "desc"); 

		$query = $this->db->get();
		return $query->result();
	
	}// /getUsers

	function getUsersLog(){

		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('userLog', 'userLog.username = users.username');
		$this->db->join('clients', 'userLog.app_id = clients.appId');

		$query = $this->db->get();
		return $query->result();
	
	}// /getUsersLog

	function getUserLog($username){

		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('userLog', 'userLog.username = users.username');
		$this->db->join('clients', 'userLog.app_id = clients.appId');
		$this->db->where('users.username', $username);

		$query = $this->db->get();
		return $query->result();
	
	}// /getUserLog


	function authUser($data){

		$query = $this->db->get_where('users', array('username' => $data['username'], 'password' => $data['password']));
		return $query->row_array();

	}// /authUser


	function newUser($form){

		$this->db->insert('users', $form);
		
	}// /newUser



	function updateUser($un, $data){
		

		$this->db->where('username', $un);
		$this->db->update('users', $data);

	}// /updateUser


	function deleteUser($un,$password){

		$data = array("userstatus"=>"deleted");

		$this->db->where('username',$un);
		$this->db->where('password',$password);
		$this->db->update('users', $data);

	}// /deleteUser

}// /class
   
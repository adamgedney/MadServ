<?php

 class Log extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }



    function logUserRequest($userdata){

		$this->db->insert('userLog', $userdata);

	}// /getUser


	function logClientRequest($data){

		$this->db->insert('clientLog', $data);

	}// /getUser


	function getUserLog(){

		$query = $this->db->get('userLog');
		return $query->row_array();
	
	}// /getUsers



	function getClientLog(){

		$query = $this->db->get('ClientLog');
		return $query->row_array();
	
	}// /getUsers



	function getSingleClientLog($app_id){

		$this->db->where(array('app_id'=>$app_id));
		$query = $this->db->get('clientLog');
		return $query->result();
	
	}// /getUsers
	
	function getAdData(){
		$this->db->select('picture, adLog.keyword as kword, clients.company as comp, count(distinct ip) as unihits, count(request) as hits');
		$this->db->from('adLog');
		$this->db->join('clients', 'clients.appId = adLog.site');
		$this->db->where('ip <> ""');
		$this->db->group_by('picture, comp, kword');
		$this->db->order_by('hits', 'desc');

		$query = $this->db->get();

		return $query->result_array();
	}
	
}// /class
   
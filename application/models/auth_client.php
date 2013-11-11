<?php

 class Auth_client extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

	//Special function to get all activity from both logs in the database
    //as a union. This pertains to client logs and user logs.
    //It made no sense to build a new model to handle this one call
    //so the decision was madet to include it here.
    function getActivity(){

		$q = $this->db->query("SELECT t1.app_id, t1.ip, t1.requester, t1.request AS request_time 
FROM (SELECT company AS requester, app_id, ip, request FROM clients JOIN clientLog ON clientLog.app_id = clients.appId) AS t1
UNION ALL 
SELECT t2.app_id, t2.ip, t2.requester, t2.request AS request_time 
FROM (SELECT u.username AS requester, app_id, ip, request FROM users AS u JOIN userLog ON userLog.username = u.username) AS t2
ORDER BY request_time DESC");
		return $q->result();
	
	}// /getActivity


    function getKey($appId){

    	$this->db->where('appId',$appId);
    	$this->db->select('key');
		$query = $this->db->get('clients')->result();
		$result = $query[0]->key;
		return $result;

	}// /getUser


    function getClient($app_id){

		$query = $this->db->get_where('clients', array('appId' => $app_id));
		return $query->result();

	}// /getUser


	function getClients(){

		$this->db->select('*');
		$this->db->from('clients');
		$this->db->order_by("joined", "desc"); 

		$query = $this->db->get();
		return $query->result();
	
	}// /getClients

	function getClientLog(){

		$this->db->select('*');
		$this->db->from('clientLog');
		$this->db->join('clients', 'clients.appId = clientLog.app_id');

		$query = $this->db->get();
		return $query->result();
	
	}// /getClientLog



	function newClient($form){

		$this->db->insert('clients', $form);

	}// /newClient



	function updateClient($app_id, $data){
		

		$this->db->where('appId', $app_id);
		$this->db->update('clients', $data);

	}// /updateClient


	function deleteClient($app_id){

		$data = array("status"=>"inactive");

		$this->db->where('appId', $app_id);
		$this->db->update('clients', $data);

	}// /deleteClient

}// /class
   
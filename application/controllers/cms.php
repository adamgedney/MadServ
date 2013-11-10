<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('loggedin') != 1){
        	header('Location: /');
        }
    }



	public function admin()
	{
		$this->load->model('log');
		$data['adlog'] = $this->log->getAdData();
		
		$this->load->view('header-loggedin');
		$this->load->view('admin-ads', $data);
		$this->load->view('footer');
	}




	public function client()
	{
		//user session data
		$app_id = $this->session->userdata('username');

		$this->load->model('auth_client');
		$data['client'] = $this->auth_client->getClient($app_id);

		$this->load->view('header-loggedin');
		$this->load->view('client-settings', $data);
		$this->load->view('footer');
	}




	public function user()
	{
		//this is a copy of the user_settings controller
		//to handle proper loading
		
		//user session data
		$username = $this->session->userdata('username');

		$this->load->model('auth_user');
		$data['user'] = $this->auth_user->getUser($username);

		$this->load->view('header-loggedin');
		$this->load->view('user-settings', $data);
		$this->load->view('footer');
	}




//-----------------------------CMS Admin controllers----------------------------
	



	public function admin_settings(){

		//user session data
		$username = $this->session->userdata('username');

		$this->load->model('auth_user');
		$data['user'] = $this->auth_user->getUser($username);

		$this->load->view('header-loggedin');
		$this->load->view('admin-settings', $data);
		$this->load->view('footer');
	}




	public function admin_ads(){
		$this->load->model('log');
		$data['adlog'] = $this->log->getAdData();
		
		$this->load->view('header-loggedin');
		$this->load->view('admin-ads', $data);
		$this->load->view('footer');
	}




	public function admin_user_log(){

		//returns all users
		$this->load->model('auth_user');
		$data['userdata'] = $this->auth_user->getUsersLog();

		$this->load->view('header-loggedin');
		$this->load->view('admin-user-log', $data);
		$this->load->view('footer');

	}




	public function admin_users(){

		//returns all users
		$this->load->model('auth_user');
		$data['userdata'] = $this->auth_user->getUsers();

		$this->load->view('header-loggedin');
		$this->load->view('admin-users', $data);
		$this->load->view('footer');

	}




	public function block_user(){

		//checkbox handler
		if(isset($_POST['block-user'])){
			if($_POST['block-user'] == 'block'){
				$un = $_POST['un'];

				$data = array(
					'userstatus'=>"blocked",
					'userblocked'=>'checked="checked"'
					);

				$this->load->model('auth_user');
				$this->auth_user->updateUser($un, $data);

				//runs the function again to refresh with new data
				header('Location: /cms/admin_users');
			}//if "block"
		}else{

			$un = $_POST['un'];

			$data = array(
				'userstatus'=>"active",
				'userblocked'=>''
				);

			$this->load->model('auth_user');
			$this->auth_user->updateUser($un, $data);

			//runs the function again to refresh with new data
			header('Location: /cms/admin_users');
		}//is isset
	}// block_user()




	public function admin_client_log(){
		//returns all clients
		$this->load->model('auth_client');
		$data['clientdata'] = $this->auth_client->getClientlog();

		$this->load->view('header-loggedin');
		$this->load->view('admin-client-log', $data);
		$this->load->view('footer');
	}




	public function admin_clients(){
		//returns all clients
		$this->load->model('auth_client');
		$data['clientdata'] = $this->auth_client->getClients();

		$this->load->view('header-loggedin');
		$this->load->view('admin-clients', $data);
		$this->load->view('footer');
	}




	public function block_client(){

		//checkbox handler
		if(isset($_POST['block-client'])){
			if($_POST['block-client'] == 'block'){
				$app_id = $_POST['appid'];

				$data = array(
					'status'=>"blocked",
					'blocked'=>'checked="checked"'
					);

				$this->load->model('auth_client');
				$this->auth_client->updateClient($app_id, $data);

				//runs the function again to refresh with new data
				header('Location: /cms/admin_clients');
			}//if "block"
		}else{

			$app_id = $_POST['appid'];

			$data = array(
				'status'=>"active",
				'blocked'=>''
				);

			$this->load->model('auth_client');
			$this->auth_client->updateClient($app_id, $data);

			//runs the function again to refresh with new data
			header('Location: /cms/admin_clients');
		}//is isset
	}// block_user()




	public function admin_activity(){

		$this->load->model('auth_client');
		$data['activitydata'] = $this->auth_client->getActivity();

		$this->load->view('header-loggedin');
		$this->load->view('admin-activity', $data);
		$this->load->view('footer');

	}



//-----------------------------CMS User controllers----------------------------




	public function user_settings(){

		//user session data
		$username = $this->session->userdata('username');

		$this->load->model('auth_user');
		$data['user'] = $this->auth_user->getUser($username);

		$this->load->view('header-loggedin');
		$this->load->view('user-settings', $data);
		$this->load->view('footer');
	}



	public function user_user_log(){

		//user session data
		$username = $this->session->userdata('username');

		//returns all users
		$this->load->model('auth_user');
		$data['userdata'] = $this->auth_user->getUserLog($username);

		$this->load->view('header-loggedin');
		$this->load->view('user-user-log', $data);
		$this->load->view('footer');

	}




//-----------------------------CMS Client controllers----------------------------




	public function client_settings(){

		//user session data
		$username = $this->session->userdata('username');

		$this->load->model('auth_client');
		$data['user'] = $this->auth_client->getClient($username);

		$this->load->view('header-loggedin');
		$this->load->view('client-settings', $data);
		$this->load->view('footer');
	}



}// /class






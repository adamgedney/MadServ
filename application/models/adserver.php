<?
	class Adserver extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function getpic($data){

			$this->db->select('clients.keyword, advertisement.picture');
			$this->db->from('clients');
			$this->db->join('advertisement', 'clients.keyword = advertisement.keyword');
			$this->db->where('clients.appId = "'.$data.'"');

			$query = $this->db->get();

			$vari = $query->result_array();

			$minval = 0;
			$maxval = count($vari) -1;

			$outp = rand($minval, $maxval);


			$ins = array(
				'picture' => $vari[$outp]['picture'],
				'keyword' => $vari[$outp]['keyword'],
				'site' => $data,
				'ip' => $_SERVER['REMOTE_ADDR']
			);

			$this->db->insert('adLog', $ins);

			header('Content-Type: image/jpeg');
			readfile('http://madserv.us/assets/img/'.$vari[$outp]['keyword']."/". $vari[$outp]['picture']);
		}
	}
?>
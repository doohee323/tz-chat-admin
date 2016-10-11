<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
class Clientq extends MY_Controller {
	public function __construct() {
		parent::MY_Controller ();
		// $this->require_login();
		// $this->default_page = '/clientq/index';
	}
	function index()   {
		$data = array ();
		$this->load->bview ( 'clientqlist', $data );
	}
	
	public function add() {
		$clientq = $_REQUEST ['clientq'];
		$params = json_decode ( urldecode ( $clientq ), 1 );
		
		$this->load->model ( 'clientq_model' );
		$return = $this->clientq_model->add ( $params );
		
		echo json_encode ( $return );
	}
	public function clientqlist() {
		$params = $_REQUEST ['params'];
		$params = json_decode ( urldecode ( $params ), 1 );
		
		$this->load->model ( 'clientq_model' );
		$data = $this->clientq_model->clientqlist ( $params );
		
		echo json_encode ( $data );
	}
}
?>
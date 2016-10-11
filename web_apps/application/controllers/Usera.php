<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
class Usera extends MY_Controller {
	public function __construct() {
		parent::MY_Controller ();
		// $this->require_login();
		// $this->default_page = '/user/index';
	}
	function index() {
		$data = array ();
		$this->load->bview ( 'userlist', $data );
	}
	function detail() {
		$data = array ();
		$this->load->bview ( 'user', $data );
	}
	public function get() {
		$params = $_REQUEST ['params'];
		$params = json_decode ( urldecode ( $params ), 1 );
		
		$this->load->model ( 'usera_model' );
		$return = $this->usera_model->get ( $params );
		
		echo json_encode ( $return );
	}
	public function add() {
		$user = $_REQUEST ['user'];
		$params = json_decode ( urldecode ( $user ), 1 );
		unset ( $params ['passwd2'] );
		
		$this->load->model ( 'usera_model' );
		$return = $this->usera_model->add ( $params );
		
		echo json_encode ( $return );
	}
	public function userlist() {
		$params = $_REQUEST ['params'];
		$params = json_decode ( urldecode ( $params ), 1 );
		
		$this->load->model ( 'usera_model' );
		
		$return = $this->usera_model->getData ( $params );
		
		echo json_encode ( $return );
	}
	public function update() {
		$params = $_REQUEST ['params'];
		$params = json_decode ( urldecode ( $params ), 1 );
		
		$this->load->model ( 'usera_model' );
		$return = $this->usera_model->update ( $params );
		
		echo json_encode ( $return );
	}
	public function updatePoint($params) {
		$params = json_decode ( urldecode ( $params ), 1 );
		
		$this->load->model ( 'usera_model' );
		$return = $this->usera_model->updatePoint ( $params );
		
		echo json_encode ( $return );
	}
}
?>
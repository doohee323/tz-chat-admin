<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
class Chata extends MY_Controller {
	public function __construct() {
		parent::MY_Controller ();
		// $this->require_login();
		// $this->default_page = '/chat/index';
	}
	function index() {
		$status = $_REQUEST ['status'];
		$data = array ();
		$data ['status'] = $status;
		$this->load->bview ( 'chatlist', $data );
	}
	public function add() {
		$chat = $_REQUEST ['chat'];
		$params = json_decode ( urldecode ( $chat ), 1 );
		
		$this->load->model ( 'chata_model' );
		$return = $this->chata_model->add ( $params );
		
		echo json_encode ( $return );
	}
	public function update() {
		$chat = $_REQUEST ['chat'];
		$params = json_decode ( urldecode ( $chat ), 1 );
		
		$this->load->model ( 'chata_model' );
		$return = $this->chata_model->update ( $params );
		
		echo json_encode ( $return );
	}
	public function backup() {
		$history = $_REQUEST ['history'];
		$params = json_decode ( urldecode ( $history ), 1 );
		
		$this->load->model ( 'chata_model' );
		$data = $this->chata_model->backup ( $params );
		
		echo json_encode ( $data );
	}
	public function restore() {
		$roomid = $_REQUEST ['roomid'];
		
		$return = array ();
		if (empty ( $roomid )) {
			echo json_encode ( $return );
			return;
		}
		
		$this->load->model ( 'chata_model' );
		$return = $this->chata_model->restore ( $roomid );
		
		echo json_encode ( $return );
	}
	public function chatlist() {
		$params = $_REQUEST ['params'];
		$params = json_decode ( urldecode ( $params ), 1 );
		
		$this->load->model ( 'chata_model' );
		$data = $this->chata_model->chatlist ( $params );
		
		echo json_encode ( $data );
	}
}
?>
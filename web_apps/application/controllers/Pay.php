<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
class Pay extends MY_Controller {
	public function __construct() {
		parent::MY_Controller ();
		// $this->require_login();
		// $this->default_page = '/pay/index';
	}
	function index() {
		$data = array ();
		if ((array_key_exists ( 'page', $_REQUEST ) && ! empty ( $_REQUEST ['page'] ))) {
			$page = $_REQUEST ['page'];
			if ($page == 'stats') {
				$this->load->bview ( 'paystats', $data );
			}
		} else {
			$this->load->bview ( 'paylist', $data );
		}
	}
	function detail() {
		$data = array ();
		$this->load->bview ( 'pay', $data );
	}
	public function get() {
		$params = $_REQUEST ['params'];
		$params = json_decode ( urldecode ( $params ), 1 );
		
		$this->load->model ( 'pay_model' );
		$return = $this->pay_model->get ( $params );
		
		echo json_encode ( $return );
	}
	public function add() {
		$pay = $_REQUEST ['pay'];
		$params = json_decode ( urldecode ( $pay ), 1 );
		
		$this->load->model ( 'pay_model' );
		$return = $this->pay_model->add ( $params );
		
		echo json_encode ( $return );
	}
	public function paylist() {
		$params = $_REQUEST ['params'];
		$params = json_decode ( urldecode ( $params ), 1 );
		
		$this->load->model ( 'pay_model' );
		$data = $this->pay_model->paylist ( $params );
		
		echo json_encode ( $data );
	}
	public function paystats() {
		$params = $_REQUEST ['params'];
		$params = json_decode ( urldecode ( $params ), 1 );
		
		$this->load->model ( 'pay_model' );
		$data = $this->pay_model->paystats ( $params );
		
		echo json_encode ( $data );
	}
	public function update() {
		$params = $_REQUEST ['params'];
		$params = json_decode ( urldecode ( $params ), 1 );
	
		$this->load->model ( 'pay_model' );
		$return = $this->pay_model->update ( $params );
	
		echo json_encode ( $return );
	}	
}
?>
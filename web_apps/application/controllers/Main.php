<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
class Main extends CI_Controller {
	function index() {
		$data = array ();
		
		$this->load->bview ( 'index', $data );
	}
	function chatroom() {
		$data = array ();
		
		$this->load->bview ( 'chatroom', $data );
	}
}
?>

<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
class Main extends CI_Controller {
	function index() {
		$data = array ();
		$data ['page_title'] = "CI Hello World App!";
		
		$this->load->bview ( 'index', $data );
	}
}
?>

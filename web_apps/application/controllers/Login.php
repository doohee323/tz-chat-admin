<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Login extends CI_Controller {
	function index() {
		$data = array ();
		
		$this->load->mview ( array (
				'templates/blank/header',
				'login',
				'templates/utils'
		), array (
				$data,
				$data,
				$data 
		) );
	}
}
?>

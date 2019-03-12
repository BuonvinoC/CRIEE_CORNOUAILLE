<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



class validForm extends CI_Controller {
	
	
		
	  
	  public function index() {
		  
		echo 'test';
		$this->load->helper('url_helper');
		$this->load->view('v_entete');
		$this->load->view('v_bandeau');		
		$this->load->view('v_accueil');
		$this->load->view('v_finPage');
		
	}
	  
}


	  ?>
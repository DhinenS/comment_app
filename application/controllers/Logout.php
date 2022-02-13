<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->library('auth');
	}
	
	public function index()
	{
		$session_id = $this->session->session_id;
		$user_id = $this->auth->get_current_user_id();
		$this->session->sess_destroy();
	 
	   	redirect('signin');
	  
		
	}
}
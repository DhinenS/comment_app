<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->current_user_id = $this->auth->get_current_user_id();
		$this->load->model('login_model');
	}

	public function index()
	{
		if( !empty($this->input->post()) ) {
			$this->validation();
		} else {
			$this->load->view('header');
			$this->load->view('signin');
			$this->load->view('footer');
		}
		
	}

	public function validation() {

		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('signin_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('signin_password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header');
			$this->load->view('signin');
			$this->load->view('footer');
		} else {
			$email = $this->input->post('signin_email');
			$password = $this->input->post('signin_password');
			$response = $this->login_model->signin( $email, $password );
			if( empty($response) ) {
				$this->load->view('header');
				$this->load->view('signin',array("message"=>"Invalid email"));
				$this->load->view('footer');
			} else if( $response == 'invalid_password') {
				$this->load->view('header');
				$this->load->view('signin',array("message"=>"Invalid Password"));
				$this->load->view('footer');
			} else {
				redirect('/dashboard');
			}
		}
		
	}

	public function forgot_password() {
		$this->load->view('header');
		$this->load->view('forgot_password');
		$this->load->view('footer');
	}
}
?>
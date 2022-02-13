<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->current_user_id = $this->auth->get_current_user_id();
		$this->load->library('auth');
		$this->load->model('login_model');
	}

	public function index() {
		if( !empty($this->input->post()) ) {
			$this->validation();
		} else {
			$this->load->view('header');
			$this->load->view('signup');
			$this->load->view('footer');
		}
	}

	public function validation() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('signup_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('signup_password', 'Password', 'required');
		$this->form_validation->set_rules('signup_code', 'Secert Code', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header');
			$this->load->view('signup');
			$this->load->view('footer');
		} else {
			$email = $this->input->post('signup_email');
			$password = $this->input->post('signup_password');
			$code = $this->input->post('signup_code');
		
			$signup_password = password_hash($password, PASSWORD_BCRYPT);
			$response = $this->login_model->signup( $email,$signup_password,$code);
			if( $response > 0 && !empty($response) ) {
				$this->session->set_flashdata( 'signup' , 'Sign Up Successfully.');
				$this->load->view('header');
				$this->load->view('signin');
				$this->load->view('footer');
			} else {
			    $message ="invalid email and Password";
			    $this->load->view('header');
				$this->load->view('signup',array("message"=>$message));
				$this->load->view('footer');
			}

		} 
	}
}
?>
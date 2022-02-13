<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->current_user_id = $this->auth->get_current_user_id();
		$this->load->library('auth');
		$this->load->model('login_model');
	}

	public function index() {
		if( !empty($this->input->post() ) ) {
			$this->validation();
		} else {
			$this->load->view('header');
			$this->load->view('forgot_password');
			$this->load->view('footer');
		}
	}

	public function validation() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('forgot_email', 'Email', 'required');
		$this->form_validation->set_rules('forgot_password', 'password', 'required');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			if( !empty($this->input->post('user_id'))) {
				$status = array('0'=>array('id'=>$this->input->post('user_id')));
			}
			$this->load->view('header');
			$this->load->view('forgot_password',array('user_id'=>$status,'email'=>$this->input->post('forgot_email')));
			$this->load->view('footer');
		} else if( empty($this->input->post('user_id'))) {
			$status = $this->login_model->get_valid_email( $this->input->post('forgot_email'));
			if( !empty($status) ){
				$this->load->view('header');
				$this->load->view('forgot_password',array("user_id"=>$status,"message"=>"Valid Email",'email'=>$this->input->post('forgot_email')));
				$this->load->view('footer');
			} else {
				$this->load->view('header');
				$this->load->view('forgot_password',array("user_id"=>$status,'message'=>'Invalid Email'));
				$this->load->view('footer');
			}
		} else {
			$response = $this->login_model->update_password( $this->input->post('user_id'), $this->input->post('forgot_password'));
			if( !empty( $response) ) {
				$this->session->set_flashdata('signup', 'Password reset Successfully');
				redirect('/signin');
			} else {
				$this->load->view('header');
				$this->load->view('forgot_password',array('message'=>'reset password failed'));
				$this->load->view('footer');
			}
		}
	}

}
?>
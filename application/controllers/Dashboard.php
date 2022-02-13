<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
			$comments = $this->login_model->get_comments();
			$this->load->view('header');
			$this->load->view('dashboard',array('comments'=>$comments));
			$this->load->view('footer');
		}
	}

	public function validation() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('comment_status', 'Comment', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header');
			$this->load->view('dashboard');
			$this->load->view('footer');
		} else {
			$comment = $this->input->post('comment_status');
			$response = $this->login_model->update_comment($comment,$this->current_user_id);
			if( !empty( $response) ) {
				$comments = $this->login_model->get_comments();
				$this->load->view('header');
				$this->load->view('dashboard',array('comments'=>$comments));
				$this->load->view('footer');
			} else {
				$this->load->view('header');
				$this->load->view('dashboard');
				$this->load->view('footer');
			}
		}
	}

	public function user_filter_comments() {
		$comments = $this->login_model->get_comments($this->current_user_id);
		echo json_encode( array("type"=>"success","comment"=>$comments));
		exit();
	}

}
?>
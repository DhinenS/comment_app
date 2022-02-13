<?php
class Login_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		
		$this->load->library('auth');

	}

	public function signup( $email='',$password='',$code ='') {
		$data = array(
			"email" => $email,
			"password" => $password,
			'secert_code' => $code
		);
		$this->db->insert('developer_users',$data);
		return $this->db->insert_id();
	}


	public function signin( $email='', $password='' ) {

		$sql_query = 'SELECT * FROM '.('developer_users').' WHERE email = "'.$email.'" ';
		$query = $this->db->query( $sql_query );
		$row = $query->row();
		if( isset($row) ) {
			if( password_verify( $password, $row->password) ) {
				$newdata = array(
						'user_id'  		=> $row->id,
						'email'     	=> $row->email,
						'logged_in' 	=> TRUE,
				);
				$this->session->set_userdata($newdata);
				return $row->id;
			} else {
				return 'invalid_password';
			}
			
		} else {
			return '';
		}
	}


	public function update_comment( $comment='' ,$user_id='') {
		if( !empty($comment) ) {
			$this->db->where('id',$user_id);
			$user_email = $this->db->get('developer_users')->result_array();
			$data = array(
				'user_id' => $user_id,
				'user_email' => $user_email[0]['email'],
				'user_comments' => $comment,
			);

			$this->db->insert('developer_comments',$data);
			return $this->db->insert_id();
		} else {
			return '';
		}
	}


	public function get_comments( $user_id='' ) {
		if( empty( $user_id )) {
			$response = $this->db->get('developer_comments')->result_array();
			return $response;
		} else {
			$this->db->select('user_id');
			$this->db->where('user_id',$user_id);
			$response = $this->db->get('developer_comments')->result_array();
			return $response;
		}
		
	}

	public function get_valid_email( $email='' ){
		if(!empty($email)) {
			$this->db->select('id');
			$this->db->where('email',$email);
			$response = $this->db->get('developer_users')->result_array();
			if(!empty($response)) {
				return $response;
			} else {
				return '';
			}
		}
	}

	public function update_password( $user_id = '', $password ='') {
		if( !empty($user_id) ) {
			$this->db->where('id',$user_id);
			$this->db->set('password',password_hash($password, PASSWORD_BCRYPT));
			$this->db->update('developer_users');
			return 'Success';
		} else {
			return '';
		}
	}
}
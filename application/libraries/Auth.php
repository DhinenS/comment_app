<?php
/**
 * This library is used to check the login auth
 */
/*
 * TODO :: check empty results 
 */
class Auth
{
	public $error_message = 'No permission to access this resource';

	private $CI = null;
	
	public function __construct()
	{	
		$this->CI =& get_instance();
		$userdata = $this->CI->session->userdata();
		if($this->CI->uri->segment(1)!='signin' && $this->CI->uri->segment(1)!='signup' && $this->CI->uri->segment(1)!='forgot'){
			if(!isset($userdata['logged_in'])||($userdata['logged_in']!==true)) {
				$this->CI->session->sess_destroy();
				redirect('/signin');
			}
			
		} 
		
	}


	public function get_current_user_id()
	{
		$userdata = $this->CI->session->userdata();
		if(isset($userdata['user_id'])){
			return $userdata['user_id'];
		} else {
			return false;
		}
	}
}
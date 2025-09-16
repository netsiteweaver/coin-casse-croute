<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

	}
	
	public function check()
	{
		
		$userid = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		// //you will need to set this $userid after authenticating the user
		$controller = $this->uri->segment(1);
		$method = $this->uri->segment(2);
		if(empty($userid)) {
			if( 
				( ($controller == "users") && (($method == "signin")||($method == "authenticate")||($method == "forget-password")||($method == "forget_password_process")||($method == "forget_password")) ) || 
				($controller == 'api') || 
				($controller == 'cron') || 
				($controller == 'migrate')){

			}else{
                $s1=$this->uri->segment(1);$s2=$this->uri->segment(2);$s3=$this->uri->segment(3);
                $_SESSION['expired_url'] = $s1. ((!empty($s2))?"/".$s2.((!empty($s3))?"/".$s3:""):"");
				if($s1=='ajax'){
					echo json_encode(array(
						"result"=>false,
						"reason"=>"login"));
					exit;
				}
                redirect( base_url("users/signin") );
			}
		}
		
	}
}

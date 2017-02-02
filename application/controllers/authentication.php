<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	public function index()
	{
		if(CUREMASP==""){ auto_direct(base_url('install'));}
		
		//write Admin logs
		if(CI_USERCOOKIE()){
			$USER=CI_USERCOOKIE();
			$logs_uname=$USER[cookieUSER];
			$logs_role=$USER[cookieROLE];
			if($logs_role == ADMIN){
				$ip = $this->input->ip_address();
				writeAdminLogs($logs_uname,'logout',$ip);
				}
		}
		//end write Admin logs
		
		$this->login();
		//$this->rrmdir(base_url('install'));
	}
	
	function login(){
		$logout=CI_USERCOOKIE('',false,true);
		$submit=$this->input->post('submit');
			if($submit){
				$username=$this->input->post('username');
				$password=$this->input->post('password');
				$remember=$this->input->post('remember_me');
				if($remember=='on'){$remember=true;}else{$remember=false;}
				$login=$this->m_global->login($username,$password);
				if($login!=false){
					
					//logs
					$logs_uname = '';
					$logs_role = '2';
					//logs
					
					$result= $login;
					$sess_array = array();
					foreach($result as $row)
					{
						$data=array(cookieID=>$row->id,cookieUSER=>$row->username,cookiePASS=>$row->password,cookieROLE=>$row->role_id);
						CI_USERCOOKIE($data,$remember);
						
						$logs_uname = $row->username;
						$logs_role = $row->role_id;
					}
					//write Admin logs
					if((int)$logs_role == 1){
						$ip = $this->input->ip_address();
						writeAdminLogs($logs_uname,'login',$ip);
						}
					//end write Admin logs
					auto_direct(base_url());
				}else{
					$data['frmErrors']='Invalid Username or Password!';
					$this->load->view('pages/login',$data);
				}
			}else{
				$this->load->view('pages/login');
			}
		
	}
	
	function usable_email($email){
		$is_exist=$this->m_global->is_exist('tbl_users','email',strtolower($email));
		if($is_exist==FALSE){
			return TRUE;
		}else{
			$this->form_validation->set_message('usable_email', 'This email has been used already. If this is your email, follow this <a href="#">link</a>.');
			return FALSE;
		}
	}
	function usable_username($username){
		$valid_username=valid_username($username);
		$is_exist=$this->m_global->is_exist('tbl_users','username',strtolower($username));
		if($is_exist==FALSE AND $valid_username==TRUE){
			return TRUE;
		}else{
			$this->form_validation->set_message('usable_username', 'This Username is invalid, choose new one!');
			return FALSE;
		}
	}
	
	function logout()
	{
	//$path=$this->input->get('path');
		if(CI_USERCOOKIE()){
			
			
			$logout=CI_USERCOOKIE('',false,true);
			auto_direct(base_url('authentication'),'refresh');
			
		}else{
			auto_direct(base_url('authentication'),'refresh');
		}
	}
	function rrmdir() {
	   $dir=getcwd().'\\install';
	   if (is_dir($dir)) {
		 $objects = scandir($dir);
		 foreach ($objects as $object) {
		   if ($object != "." && $object != "..") {
			 if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
		   }
		 }
		 reset($objects);
		 rmdir($dir);
	   }
	 }
}
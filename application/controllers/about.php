<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->_auth();
		//$this->lang->load('site',userLang());
	}
	public function index()
	{	
		//$this->developer();
		$this->this_project();
	}
	
	public function me(){
		//echo "I'm Sophannareth.";
		$data['app_title']='About Developer';
		$this->load->LoadPrint('about_me',$data);
	}
	
	function developer($dev='me'){
		$data['app_title']='About Developer';
		$this->load->LoadPrint('about_'.$dev,$data);
	}
	function this_project(){
		echo 'This page is underconstruction!';
	}
	function _auth(){
		if(CI_USERCOOKIE()){
			$USER=CI_USERCOOKIE();
			$id=$USER[cookieID];
			$role=$USER[cookieROLE];
			$username=$USER[cookieUSER];
			$password=$USER[cookiePASS];
			$remember=$USER[cookieREM]; if($remember==7200){$remember=false;}else{$remember=true;}
			$login=$this->m_global->login_cookie($username,$password);
			if(!$login){
				auto_direct(base_url('authentication'));
			}else{
				$data=array(cookieID=>$id,cookieUSER=>$username,cookiePASS=>$password,cookieROLE=>$role);
				$set_cookie=CI_USERCOOKIE($data,$remember);
				if($set_cookie){
					return true;
				}else{
				auto_direct(base_url('authentication'));
				}
				
			}
		}else{
			auto_direct(base_url('authentication'));
		}
	}

	
	function _auth_method($role='admin'){
		$USER=CI_USERCOOKIE();
		$role_id=$USER[cookieROLE];
		if(strtolower($role)=='admin'){
			if($role_id==1){
				return true;
			}else{
				auto_direct(base_url().'?error=You do not have permission to access this module!');
			}
		}else{
			return true;
		}
	return true;
	}
	

}
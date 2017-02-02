<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Revenue_history extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
	}
	public function index()
	{	
		$data['app_title']='Customs Daily Revenue v 1.0';
		$this->load->admin('revenue_history',$data);
	
	}
	function _auth(){
		if(CI_USERCOOKIE()){
			$USER=CI_USERCOOKIE();
			$username=$USER[cookieUSER];
			$password=$USER[cookiePASS];
			$login=$this->m_global->login_cookie($username,$password);
			if(!$login OR isHtml()==false){
				auto_direct(base_url('authentication'));
			}else{
				if($USER[cookieROLE]==ADMIN){
				return true;
				}else{
					auto_direct(base_url());
				}
			}
		}else{
			auto_direct(base_url('authentication'));
		}
	}
}

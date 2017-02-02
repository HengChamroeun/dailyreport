<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		//$this->lang->load('site',userLang());
	}
	public function index()
	{	
		$date=$this->input->get('date');
		if($date==false){$date=date('Y-m-d',time());}
		$USER=CI_USERCOOKIE();
		$id=$USER[cookieID];
		$username = $USER[cookieUSER];
		$role=$USER[cookieROLE];
		$data['DATE']=$date;
		$data['user'] = $username;
		$data['app_title']='Customs Daily Revenue v 1.0';
		if($role==ADMIN){
			
			$this->load->admin('index',$data);
			//auto_direct(base_url('admin'));
		}else{
			//$this->load->site('index',$data);
			auto_direct(base_url());
		}
		
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

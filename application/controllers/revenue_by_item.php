<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Revenue_by_item extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
	}
	function index()
	{
		$date=$this->input->get('date');
		if($date==false){$date=date('Y-m-d',time());}
		$USER=CI_USERCOOKIE();
		$USER_ID=$USER[cookieID];
		$role=$USER[cookieROLE];
		$data['app_title']='Customs Daily Revenue v 1.0';
		$data['USER_ID']=$USER_ID;
		$data['DATE']=$date;	
		$this->load->site('revenue_by_item',$data);
		
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
				return true;
			}
		}else{
			auto_direct(base_url('authentication'));
		}
	}
	
}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Password_reset extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
	}
	function index()
	{
		$data['app_title']='Customs Daily Revenue v 1.0';
		$USER=CI_USERCOOKIE();
		$role=$USER[cookieROLE];
		if($role==ADMIN){
			$this->load->admin_from_site('password_resetview',$data);
			}
			else{
				$this->load->site('password_resetview',$data);
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
				return true;
			}
		}else{
			auto_direct(base_url('authentication'));
		}
	}
	
	function resetPassword(){
		$data['app_title']='Customs Daily Revenue v 1.0';
		
		$submit = $this->input->post('submit');
		
		if($submit){
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('old_pw', 'Old Password', 'required');
			$this->form_validation->set_rules('new_pw', 'New Password', 'required|matches[re_new_pw]');
			$this->form_validation->set_rules('re_new_pw', 'Confirm Password', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->site('password_resetview',$data);
			}
			else
			{
				$u_id =$this->input->post('u_id');
				$old =$this->input->post('old');
				$old_pw =$this->input->post('old_pw');
				$new_pw =$this->input->post('new_pw');
				
				if(securepassword($old_pw,KEYSALT)!=$old){
					
					$this->load->site('password_resetview',$data);
					echo("<h2>Old Password is not matched!</h2>");
					}
				else{
					$data = array('password' => securepassword($new_pw,KEYSALT));
					$filter = array('id'=>$u_id);
					$update=$this->m_global->update_data(TBLUSERS,$filter,$data);
					
					if($update == 1){
						auto_direct(base_url('authentication'));
						}
						else{
							$this->load->site('password_resetview',$data);
							}
					}
					
				
			}
		}
		else{
				$this->load->site('password_resetview',$data);
			}
		
		}
}
?>
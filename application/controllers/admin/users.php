<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		//$this->lang->load('site',userLang());
	}
	public function index()
	{	
		$date=$this->input->get('date');
		if($date==false){$date=date('Y-M-d',time());}
		$data['DATE']=$date;
		$USER=CI_USERCOOKIE();
		$id=$USER[cookieID];
		$role=$USER[cookieROLE];
		$data['app_title']='Customs Daily Revenue v 1.0';
		$this->load->admin('user_all',$data);
			//auto_direct(base_url('admin'));
		
	}
	
	public function new_user(){
		$submit=$this->input->post('submit');
		$data['app_title']='Customs Daily Revenue v 1.0';
		if($submit){
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('branch_code', 'Branch', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->admin('user_new',$data);
			}
			else
			{
				$username=$this->input->post('username');
				$password=$this->input->post('password');
				$branch_code =$this->input->post('branch_code');
				$branch_code ='';
				$arrData=array(
					'username'=>$username,
					'password'=>securepassword($password,KEYSALT),
					'branch_code'=>$branch_code,
					'status'=>1,
					'token' => GeraHash(10),
					'parent_id'=>1
				);
				$add=$this->m_global->insert_data(TBLUSERS,$arrData);
				if($add){
					//echo 'Added';
					auto_direct(base_url('admin/users'));
				}
				//echo 'Passed';
			}
		}else{
			$this->load->admin('user_new',$data);
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

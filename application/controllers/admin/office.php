<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Office extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		//$this->lang->load('site',userLang());
	}
	public function index()
	{	
		$USER=CI_USERCOOKIE();
		$id=$USER[cookieID];
		$role=$USER[cookieROLE];
		$data['app_title']='Customs Daily Revenue v 1.0';
		$this->load->admin('office_all',$data);
			//auto_direct(base_url('admin'));
		//echo 'offices';
	}
	
	public function new_office(){
		$submit=$this->input->post('submit');
		$data['app_title']='Customs Daily Revenue v 1.0';
		if($submit){
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('office_code', 'Office Code', 'required');
			$this->form_validation->set_rules('office_name', 'Office Name', 'required');
			$this->form_validation->set_rules('branch_code', 'Branch', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->admin('office_new',$data);
			}
			else
			{
				$office_code=$this->input->post('office_code');
				$office_name=$this->input->post('office_name');
				$branch_code =$this->input->post('branch_code');
				$arrData=array(
					'code'=>$office_code,
					'name'=>$office_name,
					'parent_id'=>$branch_code,
					'status'=>1,
					'token' => GeraHash(10)
				);
				$add=$this->m_global->insert_data(TBLOFFICES,$arrData);
				if($add){
					//echo 'Added';
					auto_direct(base_url('admin/office'));
				}
				//echo 'Passed';
			}
		}else{
			$this->load->admin('office_new',$data);
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

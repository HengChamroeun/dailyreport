<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxhome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		//$this->lang->load('site',userLang());
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
	function addHistories(){
		//user_id,branch_id,office_id,rev_date,old_acc,new_acc
		$user_id = $office=$this->input->post("uid");
		$branch_id = $office=$this->input->post("bid");
		$office_id = $office=$this->input->post("oid");
		$rev_date = $office=$this->input->post("revdate");
		$old_acc = $office=$this->input->post("o_acc");
		$new_acc = $office=$this->input->post("n_acc");
		
		$data = array(
		"user_id" => $user_id,
		"branch_id" => $branch_id,
		"office_id" => $office_id,
		"revenue_date" => $rev_date,
		"old_acc" => $old_acc,
		"new_acc" => $new_acc
		);
		
		$insert = $this->m_global->insert_data(TBLHISTORIES,$data);
		//echo "$insert";
	}
	function updateRevenue(){
		$office_id = $office=$this->input->post("oid");
		$rev_date = $office=$this->input->post("revdate");
		$new_acc = $office=$this->input->post("n_acc");
		
		$data = array(
		'accumulative' => $new_acc
		);
		
		$filter = array(
		'office_code'=> $office_id,
		'revenue_date'=> $rev_date
		);
		
		$update = $this->m_global->update_data(TBLREVENUES,$filter,$data);
		//echo "$update";
	}
}

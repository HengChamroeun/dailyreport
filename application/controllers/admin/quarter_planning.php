<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quarter_planning extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
	}
	public function index()
	{	
		$date=$this->input->get('date');
		if($date==false){$date=date('Y-m-d',time());}
		$USER=CI_USERCOOKIE();
		$id=$USER[cookieID];
		$role=$USER[cookieROLE];
		$data['DATE']=$date;
		$data['app_title']='Customs Daily Revenue v 1.0';
		if($role==ADMIN){
			$this->load->admin('quarter_plan',$data);
		}else{
			auto_direct(base_url());
		}
		
	}
	function add(){
		$data = $this->input->post();
		$plan_id = $data['plan_id'];
		$branch_code = $data['branch_code'];
		$office_code = $data['office_code'];
		$amount = floatval($data['amount']);
		$valid_from = $data['valid_from'];
		$valid_to = $data['valid_to'];
		
		if($plan_id=='0'){
			$insert = $this->m_global->insert_data(TBLPLANNERS,array('branch_code'=>$branch_code,'office_code'=>$office_code,'amount'=>$amount,'valid_from'=>$valid_from,'valid_to'=>$valid_to));
			echo(':id:'.$insert);
		}else{
			$update = $this->m_global->update_data(TBLPLANNERS,array('id'=>$plan_id),array('amount'=>$amount));
		}
	}
	function delete(){
		$data = $this->input->post();
		$plan_id = $data['plan_id'];
		
		$delete = $this->m_global->delete_data(TBLPLANNERS,array('id'=>$plan_id));
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

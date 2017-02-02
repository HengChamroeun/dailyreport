<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actual_revenues extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
	}
	public function index()
	{	
		$data['y'] = date('Y');
		$data['m'] = date('m');
		$revs = $this->m_global->select_data(TBLACTUAL_REVENUES,array('month'=>$data['m'],'year'=>$data['y']));
		$data['rev'] = isset($revs[0])?$revs[0]:null;
		//var_dump($data['rev']);
		$data['app_title']='Customs Daily Revenue v 1.0';
		$this->load->admin('actual_revenues',$data);
	
	}
	function revenue(){
		$USER=CI_USERCOOKIE();
		$input = $this->input->post();
		$data = array('amount'=>$input['amount'],'net_amount'=>$input['net_amount'],'prize'=>$input['prize'],'month'=>$input['month'],'year'=>$input['year'],'user_id'=>$USER[cookieID]);
		$exist = $this->m_global->select_record(TBLACTUAL_REVENUES,array('month'=>$data['month'],'year'=>$data['year']),'id');
		if($exist == false){
			$this->m_global->insert_data(TBLACTUAL_REVENUES,$data);
		}else{
			$this->m_global->update_data(TBLACTUAL_REVENUES,array('month'=>$data['month'],'year'=>$data['year']),$data);
		}
	}
	function getRevenue(){
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$data = $this->m_global->select_data(TBLACTUAL_REVENUES,array('year'=>$year,'month'=>$month));
		
		header('Content-Type: application/json');
		echo json_encode(isset($data[0])?$data[0]:null);
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

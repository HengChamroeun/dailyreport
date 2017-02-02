<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Revenue_history extends CI_Controller {
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
		$USER_ID=$USER[cookieID];
		$role=$USER[cookieROLE];
		$data['app_title']='Customs Daily Revenue v 1.0';
		$data['USER_ID']=$USER_ID;
		$data['DATE']=$date;
		if($role==ADMIN){
			//$this->load->site('admin/index',$data);
			auto_direct(base_url('admin'));
		}else{
			
			//$isInserted=$this->m_global->is_exist2(TBLREVENUES,array('revenue_date'=>$date,'user_id'=>$USER_ID));
			
			$branch_code = $this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code'); 
			$branch_name = $this->m_customs->getBranch($branch_code);
			$data["BRANCH_CODE"] = $branch_code;
			$data["BRANCH_NAME"] = $branch_name;

			$date_end = $date;			
			$todayrev = $this->m_customs->getTodayRevenues_by_branch($date,$date_end,$branch_code);
			$data['todayrev'] = array();
			$data['total_acc'] = 0;
			$data['total_motor_amount'] = 0;
			$data['total_motor_acc'] = 0;
			$data['total_car_amount'] = 0;
			$data['total_car_acc'] = 0;
			$data['total_phone_amount'] = 0;
			$data['total_phone_acc'] = 0;
			
			
			foreach($todayrev as $tr){
				$data['todayrev'][$tr['office_code']] = $tr;
				$data['total_acc'] += $tr['accumulative'];
				$data['total_motor_amount'] += $tr['motor_amount'];
				$data['total_motor_acc'] += $tr['motor_acc'];
				$data['total_car_amount'] += $tr['car_amount'];
				$data['total_car_acc'] += $tr['car_acc'];
				$data['total_phone_amount'] += $tr['phone_amount'];
				$data['total_phone_acc'] += $tr['phone_acc'];
				}
			
			$revstatus = $this->m_revenues->getRevenueStatus($date);
			
			$this->load->site('revenue_history',$data);
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
}

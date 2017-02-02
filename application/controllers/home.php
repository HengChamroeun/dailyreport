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
		$USER_ID=$USER[cookieID];
		$role=$USER[cookieROLE];
		$data['app_title']='Customs Daily Revenue v 1.0';
		$data['USER_ID']=$USER_ID;
		$data['DATE']=$date;
		if($role==ADMIN){
			//$this->load->site('admin/index',$data);
			auto_direct(base_url('admin'));
		}else{
			
			
			$branch_code = $this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code'); 
			$branch_name = $this->m_customs->getBranch($branch_code);
			$data["BRANCH_CODE"] = $branch_code;
			$data["BRANCH_NAME"] = $branch_name;
			
			//$isInserted=$this->m_global->is_exist2(TBLREVENUES,array('revenue_date'=>$date,'user_id'=>$USER_ID)); OLD
			$isInserted=$this->m_global->is_exist2(TBLREVENUES,array('revenue_date'=>$date,'branch_code'=>$branch_code));

			$date_end = $date;			
			$todayrev = $this->m_customs->getTodayRevenues_by_branch($date,$date_end,$branch_code);
			$data['todayrev'] = array();
			$data['total_acc'] = 0;
			$data['total_vat_a_cd_m_acc'] = 0;
			$data['total_motor_amount'] = 0;
			$data['total_motor_acc'] = 0;
			$data['total_car_amount'] = 0;
			$data['total_car_acc'] = 0;
			$data['total_phone_amount'] = 0;
			$data['total_phone_acc'] = 0;
			
			
			foreach($todayrev as $tr){
				$data['todayrev'][$tr['office_code']] = $tr;
				$data['total_acc'] += $tr['accumulative'];
				$data['total_vat_a_cd_m_acc'] += $tr['vat_a_cd_m_acc'];
				$data['total_motor_amount'] += $tr['motor_amount'];
				$data['total_motor_acc'] += $tr['motor_acc'];
				$data['total_car_amount'] += $tr['car_amount'];
				$data['total_car_acc'] += $tr['car_acc'];
				$data['total_phone_amount'] += $tr['phone_amount'];
				$data['total_phone_acc'] += $tr['phone_acc'];
				}
			
			$revstatus = $this->m_revenues->getRevenueStatus($date);
			//var_dump( $isInserted);
			//$this->load->site('index2',$data);
			if($isInserted && $revstatus!='1'){
				//$this->load->site('index2',$data);
				$edit = $this->input->get('edit')?true:false;
				if($edit == true){
					$this->load->site('index',$data);
					}
				else{
					$this->load->site('index2',$data);
					}
			}else{
				if($revstatus!=1){
					$this->load->site('index',$data);
					}
				else{
					$this->load->site('index2',$data);
					}
			
			}
		}
		
	}
	
	
	function getPrevRevenue(){
		$bran_code = $this->input->post('branch_code');
		$date = $this->input->post('date');
		if($bran_code!=null){
			//$result = $this->m_revenues->getPrevRevenue($bran_code,$date);
			$offs=$this->m_customs->getOffices($bran_code);
			if($offs){
			$data = array();
			$data['status'] = 'success';
			$data['revenues'] = array();
			$data['isBranch']=false;
			foreach($offs as $off){
				$tmp = array();
				$acc=$this->m_customs->sumAccummulativeRevenueByOffice($off->code,false,$date);
				$tmp['branch_code'] = $bran_code;
				$tmp['office_code']= $off->code;
				$tmp['amount']= $acc[0]->amount;
				
				array_push($data['revenues'], $tmp);
				
			}
			}else{
				$data = array();
				$data['status'] = 'success';
				$data['revenues'] = array();
				$data['isBranch']=true;
				$tmp = array();
				$acc=$this->m_customs->sumAccummulativeRevenue($bran_code,false,$date);
				$tmp['branch_code'] = $bran_code;
				$tmp['office_code']= $bran_code;
				$tmp['amount']= $acc[0]->amount;
			
				array_push($data['revenues'], $tmp);
					
			}
			// foreach($result as $row){
				// $tmp = array();
				// $tmp['branch_code'] = $row->branch_code;
				// $tmp['office_code']= $row->office_code;
				// $tmp['amount']= $row->amount;
				// array_push($data['revenues'], $tmp);
			// }
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	function getPrevRevenue2(){
		$bran_code = $this->input->post('branch_code');
		$date = $this->input->post('date');
		if($bran_code!=null){
			$offs=$this->m_customs->getOffices($bran_code);
			//if($offs){
				$data = array();
				$data['status'] = 'success';
				$data['revenues'] = array();
				//$data['isBranch']=false;
				//foreach($offs as $off){
					$tmp = array();
					$result=$this->m_revenues->getPrevRevenue($bran_code,$date);
					foreach($result as $row){
						$tmp = array();
						$tmp['branch_code'] = $row->branch_code;
						$tmp['office_code']= $row->office_code;
						$tmp['accumulative']= $row->accumulative;
						array_push($data['revenues'], $tmp);
					}
					
				//}
			
			//}else{
				
			//}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	function getPrevRev(){
		
		$branch_code = $this->input->post('branch_code');
		$date=$this->input->post('date');
		$cur_date = $date;
		$date_end = $date;
		$start_date = date('Y-m',strtotime($cur_date)).'-01';
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon'){
			list($yr,$mo,$dt)=explode('-',$cur_date);
			if($dt>=2){
				$dt =floatval($dt);
				$dt_ =floatval($dt)-1;
				if($dt < 10){
					$dt='0'.$dt;
				}
				$cur_date = $yr.'-'.$mo.'-'.$dt;
				$date_end = $yr.'-'.$mo.'-'.$dt_;
			}
		}
		
		$prevrev = $this->m_customs->getPrevRevenues_by_branch($start_date,$date_end,$branch_code);
		$offices = array();
		foreach($prevrev as $p){
			$offices[$p['office_code']] = $p;
			}
		header('Content-Type: application/json');
			echo json_encode($offices);
		}
		
		function addRevenue(){
			$USER=CI_USERCOOKIE();
			$USER_ID=$USER[cookieID];
			$rows = $this->input->post('rows');
			$date = $this->input->post('date');
			$branch_code = $this->input->post('branch_code');
			$isrevenued = $this->m_customs->isBranchRevenued($branch_code,$date);
			
			if($isrevenued==false){
				$this->m_customs->insertRevenues($date,$rows,$USER_ID);
			}else{
				$this->m_customs->updateRevenues($date,$rows);
				}
		}
	
	/*function AddRevenue(){
		
		$submit=$this->input->post('submit');
		$date=$this->input->get('date');
		if($date==false){$date=date('Y-m-d',time());}
		if($this->m_revenues->getRevenueStatus($date)==1){
			auto_direct(base_url('home'));
			return;
			}
		
		if($submit){
			$USER=CI_USERCOOKIE();
			$USER_ID=$USER[cookieID];
			$branch_code=$this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code'); 
			$offs=$this->m_customs->getOffices($branch_code);
			if($offs != false){
				
				foreach($offs as $off){
					$filter=array('revenue_date'=>date('Y-m-d',strtotime($date)),'office_code'=>$off->code);
					$arrayData=array(
						'branch_code'=>$branch_code,
						'office_code'=>$off->code,
						'accumulative'=>removeMask($this->input->post(INPUT_PREFIX.$off->code)),
						'revenue_date'=>date('Y-m-d',strtotime($date)),
						'timestamp'=>time(),
						'user_id'=>$USER_ID,
						'token'=>GeraHash(10),
						'status'=>1
					);
					$this->_addRevenue($filter,$arrayData);
				}
			}else{
				$filter=array('revenue_date'=>$date,'office_code'=>$branch_code);
				$arrayData=array(
						'branch_code'=>$branch_code,
						'office_code'=>$branch_code,
						'accumulative'=>removeMask($this->input->post(INPUT_PREFIX.$branch_code)),
						'revenue_date'=>date('Y-m-d',strtotime($date)),
						'timestamp'=>time(),
						'user_id'=>$USER_ID,
						'token'=>GeraHash(10),
						'status'=>1
					);
					
					$this->_addRevenue($filter,$arrayData);
			}
			auto_direct(base_url('home'));
		}else{
			auto_direct(base_url());
			//echo 'failed';
		}
	}*/
	function _addRevenue($filter,$data){
		$isExist=$this->m_global->is_exist2(TBLREVENUES,$filter);
		if($isExist){
			$this->m_global->update_data(TBLREVENUES,$filter,$data);
		}else{
			$this->m_global->insert_data(TBLREVENUES,$data);
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

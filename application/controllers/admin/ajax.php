<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		//$this->lang->load('site',userLang());
	}

	function revenue(){
		$branch_id=$this->input->post('postData');
		$date=$this->input->post('date');
		$sumBranch=$this->m_customs->sumRevenueByBranch($branch_id,$date);
		$json=array();
		$json['status']='OK';
		if($sumBranch[0]->amount != null){
			$json['data']= $sumBranch[0]->amount;
		}else{
			$json['status']='FAILED';
		}
	
		header('Content-Type: application/json');
		echo json_encode($json);
		// echo $sumBranch;
	}
	
	function reserved_input(){
		$office=$this->input->post('office');
		$date=$this->input->post('date');
		$reserved=$this->input->post('reserved');
		$data=array(
			'office_code'=>$office,
			'revenue_date'=>date('Y-m-d',strtotime($date)),
			'reserved'=>$reserved
		);
		
		$isExist=$this->m_global->is_exist2(TBLREVENUES,array('office_code'=>$office,'revenue_date'=>date('Y-m-d',strtotime($date))));
		if($isExist){
			$filter=array(
				'office_code'=>$office,
				'revenue_date'=>date('Y-m-d',strtotime($date))
			);
			$update=$this->m_global->update_data(TBLREVENUES,$filter,$data);
			if($update!=false){
				echo 'success';
			}
		}else{
			$insert=$this->m_global->insert_data(TBLREVENUES,$data);
			echo 'success';
		}
	}
	
	function acc_input(){
		$office=$this->input->post('office');
		$date=$this->input->post('date');
		$reserved=$this->input->post('acc');
		$branch_code=$this->m_global->select_record(TBLOFFICES,array('code'=>$office),'parent_code');
		if($branch_code=='CHQ00'){$branch_code=$office;}
		$input_date = date('Y-m-d',strtotime($date));
		$data=array(
			'branch_code'=>$branch_code,
			'office_code'=>$office,
			'revenue_date'=>$input_date,
			'accumulative'=>$reserved
		);
		
		$isExist=$this->m_global->is_exist2(TBLREVENUES,array('office_code'=>$office,'revenue_date'=> $input_date));
		if($isExist){
			$filter=array(
				'office_code'=>$office,
				'revenue_date'=>$input_date
			);
			$update=$this->m_global->update_data(TBLREVENUES,$filter,$data);
			if($update!=false){
				echo 'success';
			}
		}else{
			$insert=$this->m_global->insert_data(TBLREVENUES,$data);
			echo 'success';
		}
	}
	
	function revenue_offices(){
		$office_codes=$this->input->post('office_codes');
		$date=$this->input->post('date');
		//$date=$this->input->post('date');
		//$sumBranch=$this->m_customs->sumRevenueByBranch($branch_id,$date);
		$json=array();
		$json['status']='OK';
		$json['data']= array();
		$total=0;
		
		for($i=0; $i<count($office_codes); $i++){
			
			$result = $this->m_revenues->getRevenue($office_codes[$i],date('Y-m-d',strtotime($date)));
			
			array_push($json['data'],$result);
			if($result['isBranch']==true){
				$total=$total+$result['accumulative'];
			}
		}
		
		$json['total']=$total;
		header('Content-Type: application/json');
		echo json_encode($json);
		// echo $sumBranch;
		
	}
	
	
	function test(){
		$date=date('Y-m-d',time());
		//$data=$this->m_revenues->getPrevAccByBranch('PNH14','2015-02-04');
		//$data2=$this->m_revenues->getAccByBranch('PNH14','2015-02-03');
		//echo $data.'<br/>'.$data2;
		//echo $date;
		//echo date('D d-M-Y',strtotime($date));
		//$data=$this->m_revenues->getRevenue2('PNH14','2015-02-04',false);
		$data=$this->m_revenues->getPrevAcc('PNH14','2015-02-05',true).'<br/>';
		$data.=$this->m_revenues->getPrevReserved('PNH14','2015-02-05',true);
		echo $data;
	}
	function closeRevenue(){
		$date = $this->input->post('date');
		$USER = CI_USERCOOKIE();
		$u_id = $USER[cookieID];
		$data = array('user_id'=>$u_id,'revenue_date'=>$date,'disabled'=>'1');
		$c = $this->m_global->select_record(TBLCLOSEREVENUES,array('revenue_date'=>$date),'disabled');
		if($c===false){
			$insert = $this->m_global->insert_data(TBLCLOSEREVENUES,$data);
			}
			else{
				$data = array('user_id'=>$u_id, 'disabled'=>'1');
				$filter = array('revenue_date'=>$date);
				$update = $this->m_global->update_data(TBLCLOSEREVENUES,$filter,$data);
				}
		echo $c;
		}
	function enableRevenue(){
		$date = $this->input->post('date');
		$USER = CI_USERCOOKIE();
		$u_id = $USER[cookieID];
		$filter = array('revenue_date'=>$date);
		$data = array('user_id'=>$u_id, 'disabled'=>'0');
		
		$update = $this->m_global->update_data(TBLCLOSEREVENUES,$filter,$data);
		echo $update;
		}
	function getRevenueStatus(){
		$date = $this->input->post('date');
		$c = $this->m_global->select_record(TBLCLOSEREVENUES,array('revenue_date'=>$date),'disabled');
		if($c !=1){
			echo '0';
			}
			else{
				echo '1';
				}
		}
	function getRevenues()
	{	
		$data = array();
		$date=$this->input->post('date');
		if($date==false){$date=date('Y-m-d',time());}
			
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
			
			$todayrev = $this->m_customs->getTodayRevenues($cur_date,$date_end);
			$prevrev = $this->m_customs->getPrevRevenues($start_date,$date_end);
			$data['prevrev'] = array();
			$data['todayrev'] = array();
			$data['prevrev_sum_acc'] = array();
			$data['prevrev_sum_res'] = array();
			$data['todayrev_sum_acc'] = array();
			$data['todayrev_sum_res'] = array();
			$data['todaytotal_sum_acc'] = 0;
			$data['todaytotal_sum_res'] = 0;
			$data['prevtodaytotal_sum_acc'] = 0;
			$data['prevtodaytotal_sum_res'] = 0;
			$data['total_sum_acc'] = 0;
			$data['total_sum_res'] = 0;
			$data['timestamp'] = array();
			$data['revenue_date'] = array();
			
			/*echo("<pre>");
			print_r($prevrev);
			echo("</pre>");*/
			
			foreach($todayrev as $tr){
				$data['todayrev'][$tr['branch_code']][$tr['office_code']] = $tr;
				$data['todayrev_sum_acc'][$tr['branch_code']] = (isset($data['todayrev_sum_acc'][$tr['branch_code']])?$data['todayrev_sum_acc'][$tr['branch_code']]:0);
				$data['todayrev_sum_res'][$tr['branch_code']] = (isset($data['todayrev_sum_res'][$tr['branch_code']])?$data['todayrev_sum_res'][$tr['branch_code']]:0);
				$data['todayrev_sum_acc'][$tr['branch_code']] += $tr['accumulative'];
				$data['todayrev_sum_res'][$tr['branch_code']] += $tr['reserved'];
				$data['todaytotal_sum_acc'] += $tr['accumulative'];
				$data['todaytotal_sum_res'] += $tr['reserved'];
				$data['total_sum_acc'] += $tr['accumulative'];
				$data['total_sum_res'] += $tr['reserved'];
				
				$data['timestamp'][$tr['branch_code']] = (isset($data['timestamp'][$tr['branch_code']])?$data['timestamp'][$tr['branch_code']]:'0');
				$ts = date('Y-m-d H:i:s', floatval($tr['timestamp']));
				$data['timestamp'][$tr['branch_code']] = ($ts > $data['timestamp'][$tr['branch_code']]? $ts : $data['timestamp'][$tr['branch_code']]);
				
				$data['revenue_date'][$tr['branch_code']] = (isset($data['revenue_date'][$tr['branch_code']])?$data['revenue_date'][$tr['branch_code']]:'0');
				$ts = $tr['revenue_date'];
				$data['revenue_date'][$tr['branch_code']] = ($ts > $data['revenue_date'][$tr['branch_code']]? $ts : $data['revenue_date'][$tr['branch_code']]);
				}
			foreach($prevrev as $pr){
				$data['prevrev'][$pr['branch_code']][$pr['office_code']] = $pr;
				$data['prevrev_sum_acc'][$pr['branch_code']] = (isset($data['prevrev_sum_acc'][$pr['branch_code']])?$data['prevrev_sum_acc'][$pr['branch_code']]:0);
				$data['prevrev_sum_res'][$pr['branch_code']] = (isset($data['prevrev_sum_res'][$pr['branch_code']])?$data['prevrev_sum_res'][$pr['branch_code']]:0);
				$data['prevrev_sum_acc'][$pr['branch_code']] += $pr['accumulative'];
				$data['prevrev_sum_res'][$pr['branch_code']] += $pr['reserved'];
				
				if(!isset($data['todayrev'][$pr['branch_code']][$pr['office_code']]) && isset($data['todayrev'][$pr['branch_code']])){
					$data['todayrev_sum_acc'][$pr['branch_code']] = (isset($data['todayrev_sum_acc'][$pr['branch_code']])?$data['todayrev_sum_acc'][$pr['branch_code']]:0);
					$data['todayrev_sum_res'][$pr['branch_code']] = (isset($data['todayrev_sum_res'][$pr['branch_code']])?$data['todayrev_sum_res'][$pr['branch_code']]:0);
					$data['todayrev_sum_acc'][$pr['branch_code']] += $pr['accumulative'];
					$data['todayrev_sum_res'][$pr['branch_code']] += $pr['reserved'];
					}
				
				if(!isset($data['todayrev'][$pr['branch_code']][$pr['office_code']])){
					$data['total_sum_acc'] += $pr['accumulative'];
					$data['total_sum_res'] += $pr['reserved'];
					}
				else{
					$data['prevtodaytotal_sum_acc'] += $pr['accumulative'];
					$data['prevtodaytotal_sum_res'] += $pr['reserved'];
					}
				
				
				$data['timestamp'][$pr['branch_code']] = (isset($data['timestamp'][$pr['branch_code']])?$data['timestamp'][$pr['branch_code']]:'0');
				$ts = date('Y-m-d H:i:s', floatval($pr['timestamp']));
				$data['timestamp'][$pr['branch_code']] = ($ts  >$data['timestamp'][$pr['branch_code']]?$ts : $data['timestamp'][$pr['branch_code']]);
				
				$data['revenue_date'][$pr['branch_code']] = (isset($data['revenue_date'][$pr['branch_code']])?$data['revenue_date'][$pr['branch_code']]:'0');
				$ts = $pr['revenue_date'];
				$data['revenue_date'][$pr['branch_code']] = ($ts  >$data['revenue_date'][$pr['branch_code']]?$ts : $data['revenue_date'][$pr['branch_code']]);
				}
			
			header('Content-Type: application/json');
			echo json_encode($data);
			
		
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

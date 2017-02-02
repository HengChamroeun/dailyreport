<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		//$this->lang->load('site',userLang());
	}
	function index(){
		//$this->summary();
		//--------------------
		$cond = '';
		if($this->input->get('chk_field_only')){
			$cond = 'field_only';
		}
		if($this->input->get('chk_value_only')){
			$cond = 'value_only';
		}
		
		//--------------------
		
		$REP_TYP=$this->input->get('REP_TYP');
		$REP_DAT=$this->input->get('REP_DAT');
		$REP_TYP_READY='';
		$REP_DAT_READY='';
		if($REP_TYP){
			switch($REP_TYP){
				case 'REP_TYP_1':
					$REP_TYP_READY='summary';
					break;
				case 'REP_TYP_2':
					$REP_TYP_READY='details';
					break;
				case 'REP_TYP_3':
					$REP_TYP_READY='fined';
					break;
			}
			switch($REP_DAT){
				case 'REP_DAT_1':
					$REP_DAT_READY=$this->input->get('REP_DAT_1_INP');
					break;
				case 'REP_DAT_2':
					$REP_DAT_READY=$this->input->get('REP_DAT_2_INP');
					break;
			}
			
			//-------
			$signature = '';
			if($this->input->get('select_signature')){
				$signature = $this->input->get('select_signature');
				if(!$this->m_customs->isSealedDate($REP_DAT_READY)){
					$this->m_customs->seals($signature,$REP_DAT_READY);
				}else{
					$this->m_customs->updateSeals($signature,$REP_DAT_READY);
				}
			}					
			//-------
			
			auto_direct(base_url('admin/report').'/'.$REP_TYP_READY.'?date='.$REP_DAT_READY.'&signature='.$signature.'&cond='.$cond);
		}else{
			$data['app_title']='Customs Daily Revenue Report';
			$this->load->admin('report_new',$data);
		}
	}
	
	/*function summary(){
		$USER=CI_USERCOOKIE();
		$ID=$USER[cookieID];
		$data['FULLNAME']=$this->m_global->select_record(TBLUSERS,array('id'=>$ID),'firstname');
		$date=$this->input->get('date');
		$data['app_title']='Customs Daily Revenue Report';
		if($date==''){
			$date=date('Y-M-d',time());
		}
		list($year,$month,$day)=explode('-',$date);
		$data['YEAR']=$year;
		$data['MONTH']=$month;
		$data['DAY']=$day;
		$data['DATE']=$date;
		$data['cond']=$this->input->get('cond');
		$this->load->LoadPrint('admin/report_summary',$data);
		//echo $date;
	}*/
	function selectSignatures(){
		$date = $this->input->post('date');
		//echo $date;
		$signatures = $this->m_global->select_data(TBLSIGNATURES);
		$default = $this->m_global->select_record(TBLSEALS,array('date'=>$date),'user_id');
		//echo "$default";
		selectSignatures($signatures,$default);
	}
	
	/*function details(){
		$USER=CI_USERCOOKIE();
		$ID=$USER[cookieID];
		$data['FULLNAME']=$this->m_global->select_record(TBLUSERS,array('id'=>$ID),'firstname');
		$date=$this->input->get('date');
		$data['app_title']='Customs Daily Revenue Report';
		if($date==''){
			$date=date('Y-M-d',time());
		}
		list($year,$month,$day)=explode('-',$date);
		$data['YEAR']=$year;
		$data['MONTH']=$month;
		$data['DAY']=$day;
		$data['DATE']=$date;
		$data['cond']=$this->input->get('cond');
		$data['EXC_RATE'] = $this->m_customs->getExchangeRate($year);
		
		$data['CYAR'] = $this->m_customs->countYearlyActualRevenues($year,$month);
		$data['CYNR'] = $this->m_customs->countYearlyNetRevenues($year,$month);
		$data['CYAR_PREV'] = $this->m_customs->countYearlyActualRevenues_Prev($year,$month);
		$data['CYNR_PREV'] = $this->m_customs->countYearlyNetRevenues_Prev($year,$month);
		
		$data['EXC_RATE'] = $this->m_customs->getExchangeRate($year);
		$data['PLAN'] = $this->m_customs->getYearPlan($year);
		$data['PLAN_USD'] = $this->m_customs->getYearPlanUSD($year);
		$data['PLAN_PER_MONTH'] = $this->m_customs->getYearPlan_Per_Month($year);
		$data['COUNT_PREV_MONTH'] = $this->m_customs->countPrevMonth($year,$month);
		//$C_P_M = intval($month) - 1;
		//$data['COUNT_PREV_MONTH'] = ($C_P_M<10?'0'.$C_P_M:$C_P_M);
		$this->load->LoadPrint('admin/report_details_',$data);
		//echo $date;
	}*/
	function summary(){
		$USER=CI_USERCOOKIE();
		$ID=$USER[cookieID];
		$data['FULLNAME']=$this->m_global->select_record(TBLUSERS,array('id'=>$ID),'firstname');
		$date=$this->input->get('date');
		$data['app_title']='Customs Daily Revenue Report';
		if($date==''){
			$date=date('Y-M-d',time());
		}
		list($year,$month,$day)=explode('-',$date);
		$data['YEAR']=$year;
		$data['MONTH']=$month;
		$data['DAY']=$day;
		$data['DATE']=$date;
		$data['cond']=$this->input->get('cond');
		
		//-----------------------REVENUE----------------------
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
				$data['timestamp'][$tr['branch_code']] = ($tr['timestamp']>$data['timestamp'][$tr['branch_code']]?$tr['timestamp']:$data['timestamp'][$tr['branch_code']]);
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
				$data['timestamp'][$pr['branch_code']] = ($pr['timestamp']>$data['timestamp'][$pr['branch_code']]?$pr['timestamp']:$data['timestamp'][$pr['branch_code']]);
				}
		$this->load->LoadPrint('admin/report_summary',$data);
		//echo $date;
	}
	function details(){
		$USER=CI_USERCOOKIE();
		$ID=$USER[cookieID];
		$data['FULLNAME']=$this->m_global->select_record(TBLUSERS,array('id'=>$ID),'firstname');
		$date=$this->input->get('date');
		$data['app_title']='Customs Daily Revenue Report';
		if($date==''){
			$date=date('Y-M-d',time());
		}
		list($year,$month,$day)=explode('-',$date);
		$data['YEAR']=$year;
		$data['MONTH']=$month;
		$data['DAY']=$day;
		$data['DATE']=$date;
		$data['cond']=$this->input->get('cond');
		$data['EXC_RATE'] = $this->m_customs->getExchangeRate($year);
		
		$data['CYAR'] = $this->m_customs->countYearlyActualRevenues($year,$month);
		$data['CYNR'] = $this->m_customs->countYearlyNetRevenues($year,$month);
		$data['CYAR_PREV'] = $this->m_customs->countYearlyActualRevenues_Prev($year,$month);
		$data['CYNR_PREV'] = $this->m_customs->countYearlyNetRevenues_Prev($year,$month);
		$data['CYAR_MISSED'] = 0;
		$data['CYNR_MISSED'] = 0;
		$missed_months = $this->m_customs->ARMissedMonths($year,$month);
		if(count($missed_months)>0){
			$data['CYAR_MISSED'] = $this->m_customs->getMissedARs($year,$missed_months);
			$data['CYNR_MISSED'] = $data['CYAR_MISSED'] - 9000000000;
			}
		
		//$data['EXC_RATE'] = $this->m_customs->getExchangeRate($year);
		$data['PLAN'] = $this->m_customs->getYearPlan($year);
		$data['PLAN_USD'] = $this->m_customs->getYearPlanUSD($year);
		$data['PLAN_PER_MONTH'] = $this->m_customs->getYearPlan_Per_Month($year);
		$data['COUNT_PREV_MONTH'] = $this->m_customs->countPrevMonth($year,$month);
		$C_P_M = intval($month) - 1;
		$data['COUNT_PREV_MONTH'] = ($C_P_M<10?'0'.$C_P_M:$C_P_M);
		
		
		$data['PLANNER'] = array();
		$planner = $this->m_customs->getPlanners($date);
		foreach($planner as $plan){
			$data['PLANNER'][$plan['office_code']] = $plan['amount'];
			}
		
		
		//-----------------------REVENUE----------------------
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
			
			$data['todayvat_a_cd_m_acc_sum_acc'] = array();
			$data['prevvat_a_cd_m_acc_sum_acc'] = array();
			$data['todaytotalvat_a_cd_m_acc_sum_acc'] = 0;
			$data['prevtodaytotalvat_a_cd_m_acc_sum_acc'] = 0;
			$data['total_sum_vat_a_cd_m_acc_acc'] = 0;
			
			$data['todaymotor_m_amount'] = array();
			$data['todaymotor_m_acc'] = array();
			$data['todaymotor_c_amount'] = array();
			$data['todaymotor_c_acc'] = array();
			$data['todaymotor_p_amount'] = array();
			$data['todaymotor_p_acc'] = array();
			
			$data['prevmotor_m_amount'] = array();
			$data['prevmotor_m_acc'] = array();
			$data['prevmotor_c_amount'] = array();
			$data['prevmotor_c_acc'] = array();
			$data['prevmotor_p_amount'] = array();
			$data['prevmotor_p_acc'] = array();
			
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
				$data['timestamp'][$tr['branch_code']] = ($tr['timestamp']>$data['timestamp'][$tr['branch_code']]?$tr['timestamp']:$data['timestamp'][$tr['branch_code']]);
				
				$data['todayvat_a_cd_m_acc_sum_acc'][$tr['branch_code']] = (isset($data['todayvat_a_cd_m_acc_sum_acc'][$tr['branch_code']])?$data['todayvat_a_cd_m_acc_sum_acc'][$tr['branch_code']]:0);
				$data['todayvat_a_cd_m_acc_sum_acc'][$tr['branch_code']] += $tr['vat_a_cd_m_acc'];
				$data['todaytotalvat_a_cd_m_acc_sum_acc'] += $tr['vat_a_cd_m_acc'];
				$data['total_sum_vat_a_cd_m_acc_acc'] += $tr['vat_a_cd_m_acc'];
				
				$data['todaymotor_m_amount'][$tr['branch_code']] = (isset($data['todaymotor_m_amount'][$tr['branch_code']])?$data['todaymotor_m_amount'][$tr['branch_code']]:0);
				$data['todaymotor_m_amount'][$tr['branch_code']] += $tr['motor_amount'];
				$data['todaymotor_m_acc'][$tr['branch_code']] = (isset($data['todaymotor_m_acc'][$tr['branch_code']])?$data['todaymotor_m_acc'][$tr['branch_code']]:0);
				$data['todaymotor_m_acc'][$tr['branch_code']] += $tr['motor_acc'];
				$data['todaymotor_c_amount'][$tr['branch_code']] = (isset($data['todaymotor_c_amount'][$tr['branch_code']])?$data['todaymotor_c_amount'][$tr['branch_code']]:0);
				$data['todaymotor_c_amount'][$tr['branch_code']] += $tr['car_amount'];
				$data['todaymotor_c_acc'][$tr['branch_code']] = (isset($data['todaymotor_c_acc'][$tr['branch_code']])?$data['todaymotor_c_acc'][$tr['branch_code']]:0);
				$data['todaymotor_c_acc'][$tr['branch_code']] += $tr['car_acc'];
				$data['todaymotor_p_amount'][$tr['branch_code']] = (isset($data['todaymotor_p_amount'][$tr['branch_code']])?$data['todaymotor_p_amount'][$tr['branch_code']]:0);
				$data['todaymotor_p_amount'][$tr['branch_code']] += $tr['phone_amount'];
				$data['todaymotor_p_acc'][$tr['branch_code']] = (isset($data['todaymotor_p_acc'][$tr['branch_code']])?$data['todaymotor_p_acc'][$tr['branch_code']]:0);
				$data['todaymotor_p_acc'][$tr['branch_code']] += $tr['phone_acc'];
				}
			foreach($prevrev as $pr){
				$data['prevrev'][$pr['branch_code']][$pr['office_code']] = $pr;
				$data['prevrev_sum_acc'][$pr['branch_code']] = (isset($data['prevrev_sum_acc'][$pr['branch_code']])?$data['prevrev_sum_acc'][$pr['branch_code']]:0);
				$data['prevrev_sum_res'][$pr['branch_code']] = (isset($data['prevrev_sum_res'][$pr['branch_code']])?$data['prevrev_sum_res'][$pr['branch_code']]:0);
				$data['prevrev_sum_acc'][$pr['branch_code']] += $pr['accumulative'];
				$data['prevrev_sum_res'][$pr['branch_code']] += $pr['reserved'];
				
				$data['prevvat_a_cd_m_acc_sum_acc'][$pr['branch_code']] = (isset($data['prevvat_a_cd_m_acc_sum_acc'][$pr['branch_code']])?$data['prevvat_a_cd_m_acc_sum_acc'][$pr['branch_code']]:0);
				$data['prevvat_a_cd_m_acc_sum_acc'][$pr['branch_code']] += $pr['vat_a_cd_m_acc'];
				
				if(!isset($data['todayrev'][$pr['branch_code']][$pr['office_code']]) && isset($data['todayrev'][$pr['branch_code']])){
					$data['todayrev_sum_acc'][$pr['branch_code']] = (isset($data['todayrev_sum_acc'][$pr['branch_code']])?$data['todayrev_sum_acc'][$pr['branch_code']]:0);
					$data['todayrev_sum_res'][$pr['branch_code']] = (isset($data['todayrev_sum_res'][$pr['branch_code']])?$data['todayrev_sum_res'][$pr['branch_code']]:0);
					$data['todayrev_sum_acc'][$pr['branch_code']] += $pr['accumulative'];
					$data['todayrev_sum_res'][$pr['branch_code']] += $pr['reserved'];
					
					$data['todayvat_a_cd_m_acc_sum_acc'][$pr['branch_code']] = (isset($data['todayvat_a_cd_m_acc_sum_acc'][$pr['branch_code']])?$data['todayvat_a_cd_m_acc_sum_acc'][$pr['branch_code']]:0);
					$data['todayvat_a_cd_m_acc_sum_acc'][$pr['branch_code']] += $pr['vat_a_cd_m_acc'];
					}
				
				if(!isset($data['todayrev'][$pr['branch_code']][$pr['office_code']])){
					$data['total_sum_acc'] += $pr['accumulative'];
					$data['total_sum_res'] += $pr['reserved'];
					
					$data['total_sum_vat_a_cd_m_acc_acc'] += $pr['vat_a_cd_m_acc'];
					}
				else{
					$data['prevtodaytotal_sum_acc'] += $pr['accumulative'];
					$data['prevtodaytotal_sum_res'] += $pr['reserved'];
					
					$data['prevtodaytotalvat_a_cd_m_acc_sum_acc'] += $pr['vat_a_cd_m_acc'];
					}
				
				
				$data['timestamp'][$pr['branch_code']] = (isset($data['timestamp'][$pr['branch_code']])?$data['timestamp'][$pr['branch_code']]:'0');
				$data['timestamp'][$pr['branch_code']] = ($pr['timestamp']>$data['timestamp'][$pr['branch_code']]?$pr['timestamp']:$data['timestamp'][$pr['branch_code']]);
				
				
				$data['prevmotor_m_amount'][$pr['branch_code']] = (isset($data['prevmotor_m_amount'][$pr['branch_code']])?$data['prevmotor_m_amount'][$pr['branch_code']]:0);
				$data['prevmotor_m_amount'][$pr['branch_code']] += $pr['motor_amount'];
				$data['prevmotor_m_acc'][$pr['branch_code']] = (isset($data['prevmotor_m_acc'][$pr['branch_code']])?$data['prevmotor_m_acc'][$pr['branch_code']]:0);
				$data['prevmotor_m_acc'][$pr['branch_code']] += $pr['motor_acc'];
				$data['prevmotor_c_amount'][$pr['branch_code']] = (isset($data['prevmotor_c_amount'][$pr['branch_code']])?$data['prevmotor_c_amount'][$pr['branch_code']]:0);
				$data['prevmotor_c_amount'][$pr['branch_code']] += $pr['car_amount'];
				$data['prevmotor_c_acc'][$pr['branch_code']] = (isset($data['prevmotor_c_acc'][$pr['branch_code']])?$data['prevmotor_c_acc'][$pr['branch_code']]:0);
				$data['prevmotor_c_acc'][$pr['branch_code']] += $pr['car_acc'];
				$data['prevmotor_p_amount'][$pr['branch_code']] = (isset($data['prevmotor_p_amount'][$pr['branch_code']])?$data['prevmotor_p_amount'][$pr['branch_code']]:0);
				$data['prevmotor_p_amount'][$pr['branch_code']] += $pr['phone_amount'];
				$data['prevmotor_p_acc'][$pr['branch_code']] = (isset($data['prevmotor_p_acc'][$pr['branch_code']])?$data['prevmotor_p_acc'][$pr['branch_code']]:0);
				$data['prevmotor_p_acc'][$pr['branch_code']] += $pr['phone_acc'];
				}
		$this->load->LoadPrint('admin/report_details',$data);
	}
	function fined(){
		$USER=CI_USERCOOKIE();
		$ID=$USER[cookieID];
		$data['FULLNAME']=$this->m_global->select_record(TBLUSERS,array('id'=>$ID),'firstname');
		$date=$this->input->get('date');
		$data['app_title']='Customs Daily Revenue Report';
		if($date==''){
			$date=date('Y-M-d',time());
		}
		list($year,$month,$day)=explode('-',$date);
		$data['YEAR']=$year;
		$data['MONTH']=$month;
		$data['DAY']=$day;
		$data['DATE']=$date;
		$data['cond']=$this->input->get('cond');
		$data['EXC_RATE'] = $this->m_customs->getExchangeRate($year);
		
		$data['CYAR'] = $this->m_customs->countYearlyActualRevenues($year,$month);
		$data['CYNR'] = $this->m_customs->countYearlyNetRevenues($year,$month);
		$data['CYAR_PREV'] = $this->m_customs->countYearlyActualRevenues_Prev($year,$month);
		$data['CYNR_PREV'] = $this->m_customs->countYearlyNetRevenues_Prev($year,$month);
		$data['CYAR_MISSED'] = 0;
		$data['CYNR_MISSED'] = 0;
		$missed_months = $this->m_customs->ARMissedMonths($year,$month);
		if(count($missed_months)>0){
			$data['CYAR_MISSED'] = $this->m_customs->getMissedARs($year,$missed_months);
			$data['CYNR_MISSED'] = $data['CYAR_MISSED'] - 9000000000;
			}
		
		//$data['EXC_RATE'] = $this->m_customs->getExchangeRate($year);
		$data['PLAN'] = $this->m_customs->getYearPlan($year);
		$data['PLAN_USD'] = $this->m_customs->getYearPlanUSD($year);
		$data['PLAN_PER_MONTH'] = $this->m_customs->getYearPlan_Per_Month($year);
		$data['COUNT_PREV_MONTH'] = $this->m_customs->countPrevMonth($year,$month);
		$C_P_M = intval($month) - 1;
		$data['COUNT_PREV_MONTH'] = ($C_P_M<10?'0'.$C_P_M:$C_P_M);
		
		
		$data['PLANNER'] = array();
		$planner = $this->m_customs->getPlanners($date);
		foreach($planner as $plan){
			$data['PLANNER'][$plan['office_code']] = $plan['amount'];
			}
		
		
		//-----------------------REVENUE----------------------
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
			
			$data['todaymotor_m_amount'] = array();
			$data['todaymotor_m_acc'] = array();
			$data['todaymotor_c_amount'] = array();
			$data['todaymotor_c_acc'] = array();
			$data['todaymotor_p_amount'] = array();
			$data['todaymotor_p_acc'] = array();
			
			$data['prevmotor_m_amount'] = array();
			$data['prevmotor_m_acc'] = array();
			$data['prevmotor_c_amount'] = array();
			$data['prevmotor_c_acc'] = array();
			$data['prevmotor_p_amount'] = array();
			$data['prevmotor_p_acc'] = array();
			
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
				$data['timestamp'][$tr['branch_code']] = ($tr['timestamp']>$data['timestamp'][$tr['branch_code']]?$tr['timestamp']:$data['timestamp'][$tr['branch_code']]);
				
				$data['todaymotor_m_amount'][$tr['branch_code']] = (isset($data['todaymotor_m_amount'][$tr['branch_code']])?$data['todaymotor_m_amount'][$tr['branch_code']]:0);
				$data['todaymotor_m_amount'][$tr['branch_code']] += $tr['motor_amount'];
				$data['todaymotor_m_acc'][$tr['branch_code']] = (isset($data['todaymotor_m_acc'][$tr['branch_code']])?$data['todaymotor_m_acc'][$tr['branch_code']]:0);
				$data['todaymotor_m_acc'][$tr['branch_code']] += $tr['motor_acc'];
				$data['todaymotor_c_amount'][$tr['branch_code']] = (isset($data['todaymotor_c_amount'][$tr['branch_code']])?$data['todaymotor_c_amount'][$tr['branch_code']]:0);
				$data['todaymotor_c_amount'][$tr['branch_code']] += $tr['car_amount'];
				$data['todaymotor_c_acc'][$tr['branch_code']] = (isset($data['todaymotor_c_acc'][$tr['branch_code']])?$data['todaymotor_c_acc'][$tr['branch_code']]:0);
				$data['todaymotor_c_acc'][$tr['branch_code']] += $tr['car_acc'];
				$data['todaymotor_p_amount'][$tr['branch_code']] = (isset($data['todaymotor_p_amount'][$tr['branch_code']])?$data['todaymotor_p_amount'][$tr['branch_code']]:0);
				$data['todaymotor_p_amount'][$tr['branch_code']] += $tr['phone_amount'];
				$data['todaymotor_p_acc'][$tr['branch_code']] = (isset($data['todaymotor_p_acc'][$tr['branch_code']])?$data['todaymotor_p_acc'][$tr['branch_code']]:0);
				$data['todaymotor_p_acc'][$tr['branch_code']] += $tr['phone_acc'];
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
				$data['timestamp'][$pr['branch_code']] = ($pr['timestamp']>$data['timestamp'][$pr['branch_code']]?$pr['timestamp']:$data['timestamp'][$pr['branch_code']]);
				
				
				$data['prevmotor_m_amount'][$pr['branch_code']] = (isset($data['prevmotor_m_amount'][$pr['branch_code']])?$data['prevmotor_m_amount'][$pr['branch_code']]:0);
				$data['prevmotor_m_amount'][$pr['branch_code']] += $pr['motor_amount'];
				$data['prevmotor_m_acc'][$pr['branch_code']] = (isset($data['prevmotor_m_acc'][$pr['branch_code']])?$data['prevmotor_m_acc'][$pr['branch_code']]:0);
				$data['prevmotor_m_acc'][$pr['branch_code']] += $pr['motor_acc'];
				$data['prevmotor_c_amount'][$pr['branch_code']] = (isset($data['prevmotor_c_amount'][$pr['branch_code']])?$data['prevmotor_c_amount'][$pr['branch_code']]:0);
				$data['prevmotor_c_amount'][$pr['branch_code']] += $pr['car_amount'];
				$data['prevmotor_c_acc'][$pr['branch_code']] = (isset($data['prevmotor_c_acc'][$pr['branch_code']])?$data['prevmotor_c_acc'][$pr['branch_code']]:0);
				$data['prevmotor_c_acc'][$pr['branch_code']] += $pr['car_acc'];
				$data['prevmotor_p_amount'][$pr['branch_code']] = (isset($data['prevmotor_p_amount'][$pr['branch_code']])?$data['prevmotor_p_amount'][$pr['branch_code']]:0);
				$data['prevmotor_p_amount'][$pr['branch_code']] += $pr['phone_amount'];
				$data['prevmotor_p_acc'][$pr['branch_code']] = (isset($data['prevmotor_p_acc'][$pr['branch_code']])?$data['prevmotor_p_acc'][$pr['branch_code']]:0);
				$data['prevmotor_p_acc'][$pr['branch_code']] += $pr['phone_acc'];
				}
		$this->load->LoadPrint('admin/report_fined',$data);
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
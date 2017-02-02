<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
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
		$username = $USER[cookieUSER];
		$role=$USER[cookieROLE];
		$data['DATE']=$date;
		$data['user'] = $username;
		$data['app_title']='Customs Daily Revenue v 1.0';
		
		if($role==ADMIN){
			
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
			
			
			$last_m = intval(date('m',strtotime($cur_date))) - 1;
			$last_m_y = date('Y',strtotime($cur_date));
			if($last_m == 0){
				$last_m = 12;
				$last_m_y = $last_m_y - 1;
			}
			$last_m = str_pad($last_m,2,'0',STR_PAD_LEFT);
			$lm_start_date = $last_m_y.'-'.$last_m.'-01';
			$lm_cur_date = $last_m_y.'-'.$last_m.'-'.date('d',strtotime($cur_date));
			//echo($lm_start_date.'-'.$lm_cur_date);
			$data['last_month_acc'] = $this->m_customs->getAccumulative($lm_start_date,$lm_cur_date);
			$data['last_month_date'] = date('d.m.Y',strtotime($lm_cur_date));
			
			$last_y = intval(date('Y',strtotime($cur_date))) - 1;
			$ly_start_date = $last_y.'-'.date('m',strtotime($cur_date)).'-01';
			$ly_cur_date = $last_y.'-'.date('m',strtotime($cur_date)).'-'.date('d',strtotime($cur_date));
			$data['last_year_acc'] = $this->m_customs->getAccumulative($ly_start_date,$ly_cur_date);
			$data['last_year_date'] = date('d.m.Y',strtotime($ly_cur_date));
			
			$data['current_date'] = date('d.m.Y',strtotime($date));
			
			$this->load->admin('index',$data);
		}else{
			auto_direct(base_url());
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

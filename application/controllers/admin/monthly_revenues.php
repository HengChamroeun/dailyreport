<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Monthly_revenues extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
	}
	function index()
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
			$this->load->admin('monthly_revenues',$data);
			}
			else{
				auto_direct(base_url('authentication'));
				}
		
			
	}
	function mr_print_1(){
		$date=$this->input->get('date');
		if($date==false){$date=date('Y-m-d',time());}
		$USER=CI_USERCOOKIE();
		$USER_ID=$USER[cookieID];
		$role=$USER[cookieROLE];
		$data['app_title']='Customs Daily Revenue v 1.0';
		$data['USER_ID']=$USER_ID;
		$data['DATE']=$date;
		$branch_code = $this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code');
		$data['BRANCH_CODE']=$branch_code;
		
		
		$this->load->LoadPrint('admin/mr_print_1',$data);
	}
	function mr_print_2(){
		$date=$this->input->get('date');
		if($date==false){$date=date('Y-m-d',time());}
		$USER=CI_USERCOOKIE();
		$USER_ID=$USER[cookieID];
		$role=$USER[cookieROLE];
		$data['app_title']='Customs Daily Revenue v 1.0';
		$data['USER_ID']=$USER_ID;
		$data['DATE']=$date;
		$branch_code = $this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code');
		$data['BRANCH_CODE']=$branch_code;
		
		//$this->load->admin('mrb_print_1',$data);
		$this->load->LoadPrint('admin/mr_print_2',$data);
	}
	function mr_by_quarter(){
		$year = date('Y');
		if($this->input->get('y')){
			$year = $this->input->get('y');
			}
		$last_month = $this->m_customs->getLastMonthMR($year);
		$month = $last_month;
		if($this->input->get('m')){
			$month = $this->input->get('m');
			}
		$date=$this->input->get('date');
		if($date==false){$date=date('Y-m-d',time());}
		$USER=CI_USERCOOKIE();
		$USER_ID=$USER[cookieID];
		$role=$USER[cookieROLE];
		$data['app_title']='Customs Daily Revenue v 1.0';
		$data['USER_ID']=$USER_ID;
		$data['DATE']=$date;
		$branch_code = $this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code');
		$data['BRANCH_CODE']=$branch_code;
		
		$mnt = intval($month);
		$data['JANUARY'] = ($mnt>=1?$this->m_customs->getMonthly_MR("'01'",$year):false);
		$data['FEBRUARY'] = ($mnt>=2?$this->m_customs->getMonthly_MR("'02'",$year):false);
		$data['MARCH'] = ($mnt>=3?$this->m_customs->getMonthly_MR("'03'",$year):false);
		$data['APRIL'] = ($mnt>=4?$this->m_customs->getMonthly_MR("'04'",$year):false);
		$data['MAY'] = ($mnt>=5?$this->m_customs->getMonthly_MR("'05'",$year):false);
		$data['JUNE'] = ($mnt>=6?$this->m_customs->getMonthly_MR("'06'",$year):false);
		$data['JULY'] = ($mnt>=7?$this->m_customs->getMonthly_MR("'07'",$year):false);
		$data['AUGUST'] = ($mnt>=8?$this->m_customs->getMonthly_MR("'08'",$year):false);
		$data['SEPTEMBER'] = ($mnt>=9?$this->m_customs->getMonthly_MR("'09'",$year):false);
		$data['OCTOBER'] = ($mnt>=10?$this->m_customs->getMonthly_MR("'10'",$year):false);
		$data['NOVEMBER'] = ($mnt>=11?$this->m_customs->getMonthly_MR("'11'",$year):false);
		$data['DECEMBER'] = ($mnt>=12?$this->m_customs->getMonthly_MR("'12'",$year):false);
		
		//$data['QUARTER1'] = ($mnt>=1?$this->m_customs->getMonthly_MRB("'01'".($mnt>=2>",'02'":"").($mnt>=3>",'03'":""),$year):false);
		//$data['QUARTER2'] = ($mnt>=4?$this->m_customs->getMonthly_MRB("'04'".($mnt>=5>",'05'":"").($mnt>=6>",'06'":""),$year):false);
		//$data['QUARTER3'] = ($mnt>=7?$this->m_customs->getMonthly_MRB("'07'".($mnt>=8>",'08'":"").($mnt>=9>",'09'":""),$year):false);
		//$data['QUARTER4'] = ($mnt>=10?$this->m_customs->getMonthly_MRB("'10'".($mnt>=11>",'11'":"").($mnt>=12>",'12'":""),$year):false);
		
		//$data['HALFYEAR1'] = ($mnt>=1?$this->m_customs->getMonthly_MRB("'01'".($mnt>=2>",'02'":"").($mnt>=3>",'03'":"").($mnt>=4>",'04'":"").($mnt>=5>",'05'":"").($mnt>=6>",'06'":""),$year):false);
		//$data['HALFYEAR2'] = ($mnt>=7?$this->m_customs->getMonthly_MRB("'07'".($mnt>=8>",'08'":"").($mnt>=9>",'09'":"").($mnt>=10>",'10'":"").($mnt>=11>",'11'":"").($mnt>=12>",'12'":""),$year):false);
		
		
		
		$this->load->LoadPrint('admin/monthly_revenues_by_q',$data);
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
?>
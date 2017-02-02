<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Treasury_deposit extends CI_Controller {
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
		$branch_code = $this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code');
		$data['BRANCH_CODE']=$branch_code;
		
		$this->load->site('treasury_deposit',$data);
	}
	function addItem(){
		//$id =$this->input->post("id");
		$forward_balance = $this->input->post("forward_balance");
		$rev_in_month = $this->input->post("rev_in_month");
		$rev_year_acc = $this->input->post("rev_year_acc");
		$trea_de_in_month = $this->input->post("trea_de_in_month");
		$trea_de_year_acc = $this->input->post("trea_de_year_acc");
		$authorized_expanse = $this->input->post("authorized_expanse");
		$balance = $this->input->post("balance");
		
		$office_code = $this->input->post("office_code");
		$branch_code = $this->input->post("branch_code");
		$month = $this->input->post("month");
		$year = $this->input->post("year");
		
		$data = array(
		"branch_code" => $branch_code,
		"office_code" => $office_code,
		"month" => $month,
		"year" => $year,
		"forward_balance" => $forward_balance,
		"rev_in_month" => $rev_in_month,
		"rev_year_acc" => $rev_year_acc,
		"trea_de_in_month" => $trea_de_in_month,
		"trea_de_year_acc" => $trea_de_year_acc,
		"authorized_expanse" => $authorized_expanse,
		"balance" => $balance
		);
		
		$insert = $this->m_global->insert_data(TBLTREASURY_DEPOSIT,$data);
		echo($insert);
	}
	function updateItem(){
		$id =$this->input->post("id");
		$forward_balance = $this->input->post("forward_balance");
		$rev_in_month = $this->input->post("rev_in_month");
		$rev_year_acc = $this->input->post("rev_year_acc");
		$trea_de_in_month = $this->input->post("trea_de_in_month");
		$trea_de_year_acc = $this->input->post("trea_de_year_acc");
		$authorized_expanse = $this->input->post("authorized_expanse");
		$balance = $this->input->post("balance");
		
		$data = array(
		"forward_balance" => $forward_balance,
		"rev_in_month" => $rev_in_month,
		"rev_year_acc" => $rev_year_acc,
		"trea_de_in_month" => $trea_de_in_month,
		"trea_de_year_acc" => $trea_de_year_acc,
		"authorized_expanse" => $authorized_expanse,
		"balance" => $balance
		);
		
		$update = $this->m_global->update_data(TBLTREASURY_DEPOSIT,array('id'=>$id),$data);
		echo $update;
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
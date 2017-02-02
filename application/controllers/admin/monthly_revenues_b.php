<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Monthly_revenues_b extends CI_Controller {
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
		
		$this->load->admin('monthly_revenues_b',$data);
	}
	function addItem(){
		//$id = $office=$this->input->post("id");
		$other_rev = $office=$this->input->post("other_rev");
		$vat_gio = $office=$this->input->post("vat_gio");
		$vat_ngoemb = $office=$this->input->post("vat_ngoemb");
		$vat_other = $office=$this->input->post("vat_other");
		$office_code = $office=$this->input->post("office_code");
		$branch_code = $office=$this->input->post("branch_code");
		$month = $office=$this->input->post("month");
		$year = $office=$this->input->post("year");
		
		$data = array(
		"branch_code" => $branch_code,
		"office_code" => $office_code,
		"month" => $month,
		"year" => $year,
		"other_rev" => $other_rev,
		"vat_gio" => $vat_gio,
		"vat_ngoemb" => $vat_ngoemb,
		"vat_other" => $vat_other
		);
		
		$insert = $this->m_global->insert_data(TBLMONTHLYREVENUESB,$data);
		echo($insert);
	}
	function updateItem(){
		$id = $office=$this->input->post("id");
		$other_rev = $office=$this->input->post("other_rev");
		$vat_gio = $office=$this->input->post("vat_gio");
		$vat_ngoemb = $office=$this->input->post("vat_ngoemb");
		$vat_other = $office=$this->input->post("vat_other");
		
		$data = array(
		"other_rev" => $other_rev,
		"vat_gio" => $vat_gio,
		"vat_ngoemb" => $vat_ngoemb,
		"vat_other" => $vat_other
		);
		
		$update = $this->m_global->update_data(TBLMONTHLYREVENUESB,array('id'=>$id),$data);
		echo $update;
	}
	function deleteItem(){
		$id = $this->input->post("id");
		$id = explode(':',$id);
		$id1 = $id[0];
		$id2 = $id[1];

		$delete1 = $this->m_global->delete_data(TBLITEM_REVENUES,array('id'=>$id1));
		$delete2 = $this->m_global->delete_data(TBLITEM_REVENUES,array('id'=>$id2));
		
		echo $delete1.":".$delete2;
	}
	function getUnitName(){
		$item_id = $this->input->post('item_id');
		$item_unit = $this->m_global->select_record(TBLITEMS,array('id'=>$item_id),'unit');
		$unit_name_kh = $this->m_global->select_record(TBLUNITS,array('code'=>$item_unit),'name_kh');
		echo $unit_name_kh;
	}
	function mrb_print_1(){
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
		$this->load->LoadPrint('admin/mrb_print_1',$data);
	}
	function mrb_print_2(){
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
		$this->load->LoadPrint('admin/mrb_print_2',$data);
	}
	function mrb_by_quarter(){
		$year = date('Y');
		if($this->input->get('y')){
			$year = $this->input->get('y');
			}
		$last_month = $this->m_customs->getLastMonthMRB($year);
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
		$data['JANUARY'] = ($mnt>=1?$this->m_customs->getMonthly_MRB("'01'",$year):false);
		$data['FEBRUARY'] = ($mnt>=2?$this->m_customs->getMonthly_MRB("'02'",$year):false);
		$data['MARCH'] = ($mnt>=3?$this->m_customs->getMonthly_MRB("'03'",$year):false);
		$data['APRIL'] = ($mnt>=4?$this->m_customs->getMonthly_MRB("'04'",$year):false);
		$data['MAY'] = ($mnt>=5?$this->m_customs->getMonthly_MRB("'05'",$year):false);
		$data['JUNE'] = ($mnt>=6?$this->m_customs->getMonthly_MRB("'06'",$year):false);
		$data['JULY'] = ($mnt>=7?$this->m_customs->getMonthly_MRB("'07'",$year):false);
		$data['AUGUST'] = ($mnt>=8?$this->m_customs->getMonthly_MRB("'08'",$year):false);
		$data['SEPTEMBER'] = ($mnt>=9?$this->m_customs->getMonthly_MRB("'09'",$year):false);
		$data['OCTOBER'] = ($mnt>=10?$this->m_customs->getMonthly_MRB("'10'",$year):false);
		$data['NOVEMBER'] = ($mnt>=11?$this->m_customs->getMonthly_MRB("'11'",$year):false);
		$data['DECEMBER'] = ($mnt>=12?$this->m_customs->getMonthly_MRB("'12'",$year):false);
		
		//$data['QUARTER1'] = ($mnt>=1?$this->m_customs->getMonthly_MRB("'01'".($mnt>=2>",'02'":"").($mnt>=3>",'03'":""),$year):false);
		//$data['QUARTER2'] = ($mnt>=4?$this->m_customs->getMonthly_MRB("'04'".($mnt>=5>",'05'":"").($mnt>=6>",'06'":""),$year):false);
		//$data['QUARTER3'] = ($mnt>=7?$this->m_customs->getMonthly_MRB("'07'".($mnt>=8>",'08'":"").($mnt>=9>",'09'":""),$year):false);
		//$data['QUARTER4'] = ($mnt>=10?$this->m_customs->getMonthly_MRB("'10'".($mnt>=11>",'11'":"").($mnt>=12>",'12'":""),$year):false);
		
		//$data['HALFYEAR1'] = ($mnt>=1?$this->m_customs->getMonthly_MRB("'01'".($mnt>=2>",'02'":"").($mnt>=3>",'03'":"").($mnt>=4>",'04'":"").($mnt>=5>",'05'":"").($mnt>=6>",'06'":""),$year):false);
		//$data['HALFYEAR2'] = ($mnt>=7?$this->m_customs->getMonthly_MRB("'07'".($mnt>=8>",'08'":"").($mnt>=9>",'09'":"").($mnt>=10>",'10'":"").($mnt>=11>",'11'":"").($mnt>=12>",'12'":""),$year):false);
		
		$data['QUARTER1'] = false;
		$data['QUARTER2'] = false;
		$data['QUARTER3'] = false;
		$data['QUARTER4'] = false;
		
		$data['HALFYEAR1'] = false;
		$data['HALFYEAR2'] = false;
		
		$this->load->LoadPrint('admin/monthly_revenues_b_by_q',$data);
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
?>
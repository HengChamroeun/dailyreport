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
		$branch_code = $this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code');
		$data['BRANCH_CODE']=$branch_code;
		
		$this->load->site('monthly_revenues',$data);
	}
	function addItem(){
		//$id = $office=$this->input->post("id");
		$cd = $office=$this->input->post("cd");
		$st = $office=$this->input->post("st");
		$at = $office=$this->input->post("at");
		$et = $office=$this->input->post("et");
		$other = $office=$this->input->post("other");
		$vop = $office=$this->input->post("vop");
		$vpp_ea = $office=$this->input->post("vpp_ea");
		$vpp_other = $office=$this->input->post("vpp_other");
		$vop_io = $office=$this->input->post("vop_io");
		$vap = $office=$this->input->post("vap");
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
		"cd" => $cd,
		"st" => $st,
		"at" => $at,
		"et" => $et,
		"other" => $other,
		"vop" => $vop,
		"vpp_ea" => $vpp_ea,
		"vpp_other" => $vpp_other,
		"vop_io" => $vop_io,
		"vap" => $vap,
		"vat_other" => $vat_other
		);
		
		$insert = $this->m_global->insert_data(TBLMONTHLYREVENUES,$data);
		echo($insert);
	}
	function updateItem(){
		$id = $office=$this->input->post("id");
		$cd = $office=$this->input->post("cd");
		$st = $office=$this->input->post("st");
		$at = $office=$this->input->post("at");
		$et = $office=$this->input->post("et");
		$other = $office=$this->input->post("other");
		$vop = $office=$this->input->post("vop");
		$vpp_ea = $office=$this->input->post("vpp_ea");
		$vpp_other = $office=$this->input->post("vpp_other");
		$vop_io = $office=$this->input->post("vop_io");
		$vap = $office=$this->input->post("vap");
		$vat_other = $office=$this->input->post("vat_other");
		
		$data = array(
		"cd" => $cd,
		"st" => $st,
		"at" => $at,
		"et" => $et,
		"other" => $other,
		"vop" => $vop,
		"vpp_ea" => $vpp_ea,
		"vpp_other" => $vpp_other,
		"vop_io" => $vop_io,
		"vap" => $vap,
		"vat_other" => $vat_other
		);
		
		$update = $this->m_global->update_data(TBLMONTHLYREVENUES,array('id'=>$id),$data);
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
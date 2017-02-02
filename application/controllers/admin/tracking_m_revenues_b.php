<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tracking_m_revenues_b extends CI_Controller {
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
		if($role == ADMIN){
			$this->load->admin('tracking_m_revenues_b',$data);
		}
		else{
			auto_direct(base_url('authentication'));
		}
	}
	function addItem(){
		//$id = $office=$this->input->post("id");
		$ngo = $office=$this->input->post("ngo");
		$emb = $office=$this->input->post("emb");
		$gio = $office=$this->input->post("gio");
		$oio = $office=$this->input->post("oio");
		$exp = $office=$this->input->post("exp");
		$aid = $office=$this->input->post("aid");
		$ata = $office=$this->input->post("ata");
		$p_min = $office=$this->input->post("p_min");
		$other = $office=$this->input->post("other");
		
		$office_code = $office=$this->input->post("office_code");
		$branch_code = $office=$this->input->post("branch_code");
		$month = $office=$this->input->post("month");
		$year = $office=$this->input->post("year");
		
		$data = array(
		"branch_code" => $branch_code,
		"office_code" => $office_code,
		"month" => $month,
		"year" => $year,
		"ngo" => $ngo,
		"emb" => $emb,
		"gio" => $gio,
		"oio" => $oio,
		"exp" => $exp,
		"aid" => $aid,
		"ata" => $ata,
		"p_min" => $p_min,
		"other" => $other
		);
		
		$insert = $this->m_global->insert_data(TBLTRACKINGMREVENUESB,$data);
		echo($insert);
	}
	function updateItem(){
		$id = $office=$this->input->post("id");
		$ngo = $office=$this->input->post("ngo");
		$emb = $office=$this->input->post("emb");
		$gio = $office=$this->input->post("gio");
		$oio = $office=$this->input->post("oio");
		$exp = $office=$this->input->post("exp");
		$aid = $office=$this->input->post("aid");
		$ata = $office=$this->input->post("ata");
		$p_min = $office=$this->input->post("p_min");
		$other = $office=$this->input->post("other");
		
		$data = array(
		"ngo" => $ngo,
		"emb" => $emb,
		"gio" => $gio,
		"oio" => $oio,
		"exp" => $exp,
		"aid" => $aid,
		"ata" => $ata,
		"p_min" => $p_min,
		"other" => $other
		);
		
		$update = $this->m_global->update_data(TBLTRACKINGMREVENUESB,array('id'=>$id),$data);
		echo $update;
	}
	function deleteItem(){
		$id = $this->input->post("id");
		$id = explode(':',$id);
		$id1 = $id[0];
		$id2 = $id[1];

		$delete1 = $this->m_global->delete_data(TBLTRACKINGMREVENUESB,array('id'=>$id1));
		$delete2 = $this->m_global->delete_data(TBLTRACKINGMREVENUESB,array('id'=>$id2));
		
		echo $delete1.":".$delete2;
	}
	function getUnitName(){
		$item_id = $this->input->post('item_id');
		$item_unit = $this->m_global->select_record(TBLITEMS,array('id'=>$item_id),'unit');
		$unit_name_kh = $this->m_global->select_record(TBLUNITS,array('code'=>$item_unit),'name_kh');
		echo $unit_name_kh;
	}
function tracking_mrb_print_1(){
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
		$this->load->LoadPrint('admin/tracking_mrb_print_1',$data);
	}
	function tracking_mrb_print_2(){
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
		$this->load->LoadPrint('admin/tracking_mrb_print_2',$data);
	}
	function tracking_mrb_by_quarter(){
		$year = date('Y');
		if($this->input->get('y')){
			$year = $this->input->get('y');
			}
		$last_month = $this->m_customs->getLastMonthTMRB($year);
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
		//echo($mnt);
		$data['JANUARY'] = ($mnt>=1?$this->m_customs->getMonthly_TMRB("'01'",$year):false);
		$data['FEBRUARY'] = ($mnt>=2?$this->m_customs->getMonthly_TMRB("'02'",$year):false);
		$data['MARCH'] = ($mnt>=3?$this->m_customs->getMonthly_TMRB("'03'",$year):false);
		$data['APRIL'] = ($mnt>=4?$this->m_customs->getMonthly_TMRB("'04'",$year):false);
		$data['MAY'] = ($mnt>=5?$this->m_customs->getMonthly_TMRB("'05'",$year):false);
		$data['JUNE'] = ($mnt>=6?$this->m_customs->getMonthly_TMRB("'06'",$year):false);
		$data['JULY'] = ($mnt>=7?$this->m_customs->getMonthly_TMRB("'07'",$year):false);
		$data['AUGUST'] = ($mnt>=8?$this->m_customs->getMonthly_TMRB("'08'",$year):false);
		$data['SEPTEMBER'] = ($mnt>=9?$this->m_customs->getMonthly_TMRB("'09'",$year):false);
		$data['OCTOBER'] = ($mnt>=10?$this->m_customs->getMonthly_TMRB("'10'",$year):false);
		$data['NOVEMBER'] = ($mnt>=11?$this->m_customs->getMonthly_TMRB("'11'",$year):false);
		$data['DECEMBER'] = ($mnt>=12?$this->m_customs->getMonthly_TMRB("'12'",$year):false);
		
		
		$data['QUARTER1'] = false;
		$data['QUARTER2'] = false;
		$data['QUARTER3'] = false;
		$data['QUARTER4'] = false;
		
		$data['HALFYEAR1'] = false;
		$data['HALFYEAR2'] = false;
		
		$this->load->LoadPrint('admin/tracking_mrevenues_b_by_q',$data);
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
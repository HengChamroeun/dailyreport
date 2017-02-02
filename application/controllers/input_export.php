<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Input_export extends CI_Controller {
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
		$parent_code = $this->m_global->select_record(TBLOFFICES,array('code'=>$this->input->get('office')),'parent_code');
		if($parent_code=='CHQ00'){
			$parent_code = $this->input->get('office');
			}
		if($parent_code == $branch_code){
			$data['BRANCH_CODE'] = $branch_code;
			$data['OFFICE_CODE'] = $this->input->get('office');
			$this->load->site('input_export',$data);
			}else{
				auto_direct(base_url('revenue_by_item'));
				}
	}
	function addItem(){
		$USER = CI_USERCOOKIE();
		$branch_code = $this->m_global->select_record(TBLUSERS,array('id'=>$USER[cookieID]),'branch_code');
		$office_code = $this->input->post("office_code");
		$year = $this->input->post("year");
		$month = $this->input->post('month');
		$item = $office=$this->input->post("itm");
		$qty = $office=$this->input->post("qty");
		$tax_base = $office=$this->input->post("tax_base");
		$tax_amount = $office=$this->input->post("tax_amount");
		$qty_2 = $office=$this->input->post("qty_2");
		$tax_base_2 = $office=$this->input->post("tax_base_2");
		$tax_amount_2 = $office=$this->input->post("tax_amount_2");
		if($item == 0){
			echo '';
		}else{
			$data = array(
				"branch_code" => $branch_code,
				"office_code" => $office_code,
				"item_id" => $item,
				"qty" => $qty,
				"tax_base" => $tax_base,
				"tax_amount" => $tax_amount,
				"qty_2" => $qty_2,
				"tax_base_2" => $tax_base_2,
				"tax_amount_2" => $tax_amount_2,
				"year" => $year,
				"month" => $month,
				"user_id" => $USER[cookieID]
			);

			$data3 = array(
				"branch_code" => $branch_code,
				"office_code" => $office_code,
				"item_id" => 0,
				"qty" => 0,
				"tax_base" => 0,
				"tax_amount" => $office=$this->input->post("oth_tax"),
				"qty_2" => 0,
				"tax_base_2" => 0,
				"tax_amount_2" => $office=$this->input->post("oth_tax"),
				"year" => $year,
				"month" => $month,
				"isbur" => 2,
				"user_id" => $USER[cookieID]
			);
			
			$insert = $this->m_global->insert_data(TBLITEMSEXPORT_REVENUES,$data);
			$id3 = null;
			$itm_3 = $this->m_global->is_exist2(TBLITEMSEXPORT_REVENUES,array("item_id"=>0,"office_code"=>$office_code,"year"=>$year,"month"=>$month,"isbur"=>2));
			if($itm_3 == false){
				$insert3 = $this->m_global->insert_data(TBLITEMSEXPORT_REVENUES,$data3);
			}else{
				$id3 = $this->m_global->select_record(TBLITEMSEXPORT_REVENUES,array("item_id"=>0,"office_code"=>$office_code,"year"=>$year,"month"=>$month,"isbur"=>2),'id');
				$update3 = $this->m_global->update_data(TBLITEMSEXPORT_REVENUES,array('id'=>$id3),$data3);
			}
			
			$id = $this->m_global->select_record(TBLITEMSEXPORT_REVENUES,$data,'id');
			//$id_3 = $this->m_global->select_record(TBLITEMSEXPORT_REVENUES,$data3,'id');
			echo $id;
		}
	}
	function addOther(){
		$USER = CI_USERCOOKIE();
		$branch_code = $this->m_global->select_record(TBLUSERS,array('id'=>$USER[cookieID]),'branch_code');
		$office_code = $this->input->post("office_code");
		$year = $this->input->post("year");
		$month = $this->input->post('month');
		
			

			$data3 = array(
				"branch_code" => $branch_code,
				"office_code" => $office_code,
				"item_id" => 0,
				"qty" => 0,
				"tax_base" => 0,
				"tax_amount" => $office=$this->input->post("oth_tax"),
				"qty_2" => 0,
				"tax_base_2" => 0,
				"tax_amount_2" => $office=$this->input->post("oth_tax"),
				"year" => $year,
				"month" => $month,
				"isbur" => 2,
				"user_id" => $USER[cookieID]
			);
			
			$id3 = null;
			$itm_3 = $this->m_global->is_exist2(TBLITEMSEXPORT_REVENUES,array("item_id"=>0,"office_code"=>$office_code,"year"=>$year,"month"=>$month,"isbur"=>2));
			if($itm_3 == false){
				$insert3 = $this->m_global->insert_data(TBLITEMSEXPORT_REVENUES,$data3);
			}else{
				$id3 = $this->m_global->select_record(TBLITEMSEXPORT_REVENUES,array("item_id"=>0,"office_code"=>$office_code,"year"=>$year,"month"=>$month,"isbur"=>2),'id');
				$update3 = $this->m_global->update_data(TBLITEMSEXPORT_REVENUES,array('id'=>$id3),$data3);
			}
			
			//$id = $this->m_global->select_record(TBLITEMSEXPORT_REVENUES,$data,'id');
			$id_3 = $this->m_global->select_record(TBLITEMSEXPORT_REVENUES,$data3,'id');
			echo $id_3;
		
	}
	function updateItem(){
		$item = $office=$this->input->post("itm");
		$qty = $office=$this->input->post("qty");
		$tax_base = $office=$this->input->post("tax_base");
		$tax_amount = $office=$this->input->post("tax_amount");
		$qty_2 = $office=$this->input->post("qty_2");
		$tax_base_2 = $office=$this->input->post("tax_base_2");
		$tax_amount_2 = $office=$this->input->post("tax_amount_2");
		$year = $office=$this->input->post("year");
		$month = $office=$this->input->post("month");
		
		$id = $this->input->post("id");
		
		$data = array(
            "item_id" => $item,
            "qty" => $qty,
            "tax_base" => $tax_base,
            "tax_amount" => $tax_amount,
            "qty_2" => $qty_2,
            "tax_base_2" => $tax_base_2,
            "tax_amount_2" => $tax_amount_2
		);

        $data3 = array(
            "item_id" => 0,
            "qty" => 0,
            "tax_base" => 0,
            "tax_amount" => $office=$this->input->post("oth_tax"),
            "qty_2" => 0,
            "tax_base_2" => 0,
            "tax_amount_2" => $office=$this->input->post("oth_tax")
        );
		$filter3 = array(
            "item_id" => 0,
            "year" => $year,
            "month" => $month,
        );

		$update = $this->m_global->update_data(TBLITEMSEXPORT_REVENUES,array('id'=>$id),$data);
        $update3 = $this->m_global->update_data(TBLITEMSEXPORT_REVENUES,$filter3,$data3);
		echo $update;
	}
	function deleteItem(){
		$id = $this->input->post("id");

		$delete = $this->m_global->delete_data(TBLITEMSEXPORT_REVENUES,array('id'=>$id));
		
		echo $delete;
	}
	function getUnitName(){
		$item_id = $this->input->post('item_id');
		$item_unit = $this->m_global->select_record(TBLITEMSEXPORT,array('id'=>$item_id),'unit');
		//$unit_name_kh = $this->m_global->select_record(TBLUNITS,array('code'=>$item_unit),'name_kh');
		echo $item_unit;
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Input_38 extends CI_Controller {
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
			$this->load->site('input_38',$data);
			}else{
				//$data['parent']=$parent_code;
				//$data['branch_code']=$branch_code;
				//$this->load->site('input_38',$data);
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
		if($item == 0){
			echo 'error';
		}else{
			$filter = array(
				"branch_code" => $branch_code,
				"office_code" => $office_code,
				"item_id" => $item,
				"year" => $year,
				"month" => $month,
				"isbur" => 0
			);

			$filter_bur = array(
				"branch_code" => $branch_code,
				"office_code" => $office_code,
				"item_id" => $item,
				"year" => $year,
				"month" => $month,
				"isbur" => 1
			);

			$data = array(
				"branch_code" => $branch_code,
				"office_code" => $office_code,
				"item_id" => $item,
				"qty" => $qty,
				"tax_base" => $tax_base,
				"cd" => $this->input->post("cd"),
				"atcd" => $this->input->post("atcd"),
				"st" => $this->input->post("st"),
				"vat" => $this->input->post("vat"),
				"tax_amount" => $tax_amount,
				"year" => $year,
				"month" => $month,
				"user_id" => $USER[cookieID],
				"isbur" => $this->input->post("isbur"),
				'status'=>0
			);

			if($this->input->post("isbur") == 0){
				$data_tmp = array(
					"branch_code" => $branch_code,
					"office_code" => $office_code,
					"item_id" => $item,
					"qty" => 0,
					"tax_base" => 0,
					"cd" => 0,
					"atcd" => 0,
					"st" => 0,
					"vat" => 0,
					"tax_amount" => 0,
					"year" => $year,
					"month" => $month,
					"user_id" => $USER[cookieID],
					"isbur" => 1,
					'status'=>1
				);

				$idTmp = $this->m_global->select_record(TBLITEM_REVENUES,$filter_bur,'id');
				if($idTmp == false){
					$insertTmp = $this->m_global->insert_data(TBLITEM_REVENUES, $data_tmp);
				}

				$id = $this->m_global->select_record(TBLITEM_REVENUES,$filter,'id');
				if($id != false){
					$id = $this->m_global->update_data(TBLITEM_REVENUES,array('id'=>$id), $data);
				}else {
					$insert = $this->m_global->insert_data(TBLITEM_REVENUES, $data);
					$id = $this->m_global->select_record(TBLITEM_REVENUES, $data, 'id');
					//$id = $this->db->insert_id();

				}
			}else{
				$data_tmp = array(
					"branch_code" => $branch_code,
					"office_code" => $office_code,
					"item_id" => $item,
					"qty" => 0,
					"tax_base" => 0,
					"cd" => 0,
					"atcd" => 0,
					"st" => 0,
					"vat" => 0,
					"tax_amount" => 0,
					"year" => $year,
					"month" => $month,
					"user_id" => $USER[cookieID],
					"isbur" => 0,
					'status'=>1
				);

				$idTmp = $this->m_global->select_record(TBLITEM_REVENUES,$filter,'id');
				if($idTmp == false){
					$insertTmp = $this->m_global->insert_data(TBLITEM_REVENUES, $data_tmp);
				}

				$id = $this->m_global->select_record(TBLITEM_REVENUES,$filter_bur,'id');
				if($id != false){
					$id = $this->m_global->update_data(TBLITEM_REVENUES,array('id'=>$id), $data);
				}else {
					$insert = $this->m_global->insert_data(TBLITEM_REVENUES, $data);
					$id = $this->m_global->select_record(TBLITEM_REVENUES, $data, 'id');
					//$id = $this->db->insert_id();

				}
			}

			$items = $this->m_global->select_data(TBLITEMS, NULL, array('id' => 'ASC'), 0);
			$unit_name_kh = $this->m_revenues->getUnitNameKHByItemID($data['item_id']);
			$row = '';
			if ($data['isbur'] == 0) {
				$row .= '<tr class="table_input">';
			} else {
				$row .= '<tr class="table_input_bur">';
			}

			$row .= '<td class="td_item fixed-col"><span class="disp"></span>' . selectBox($items, "id", "name_kh", $data['item_id']) . '<input type="hidden" id="item_hidden" value="' . $data['item_id'] . '"></td>';
			$row .= '<td class="td_i fixed-col"><span class="enum">' . $unit_name_kh . '</span><input type="hidden" name="record_id" id="record_id" value="' . $id . '"></td>';
			$row .= '<td class="td_qty"><span class="disp">' . num_format($data['qty']) . '</span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="' . $data['qty'] . '"></td>';
			$row .= '<td class="td_tax_base"><span class="disp">' . num_format($data['tax_base']) . '</span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="' . $data['tax_base'] . '"></td>';
			$row .= '<td class="td_cd"><span class="disp">' . num_format($data['cd']) . '</span><input type="text" id="cd" name="cd" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="' . $data['cd'] . '"></td>';
			$row .= '<td class="td_atcd"><span class="disp">' . num_format($data['atcd']) . '</span><input type="text" id="atcd" name="atcd" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="' . $data['atcd'] . '"></td>';
			$row .= '<td class="td_st"><span class="disp">' . num_format($data['st']) . '</span><input type="text" id="st" name="st" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="' . $data['st'] . '"></td>';
			$row .= '<td class="td_vat"><span class="disp">' . num_format($data['vat']) . '</span><input type="text" id="vat" name="vat" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="' . $data['vat'] . '"></td>';
			$row .= '<td class="td_tax_amount"><span class="disp">' . num_format($data['tax_amount']) . '</span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="' . $data['tax_amount'] . '" ></td>';
			$row .= '<td  class="td_delete"><a href="#delete" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a></td>';
			if ($id > 0) {
				echo $row;
			} else {
				echo 'error';
			}
		}
		
	}

	function addOtherTax(){
		$USER = CI_USERCOOKIE();
		$branch_code = $this->m_global->select_record(TBLUSERS,array('id'=>$USER[cookieID]),'branch_code');
		$office_code = $this->input->post("office_code");
		$year = $this->input->post("year");
		$month = $this->input->post('month');
		$item = $office=$this->input->post("itm");
		$qty = $office=$this->input->post("qty");
		$tax_base = $office=$this->input->post("tax_base");
		$tax_amount = $office=$this->input->post("tax_amount");

		$filter = array(
			"branch_code" => $branch_code,
			"office_code" => $office_code,
			"item_id" => $item,
			"year" => $year,
			"month" => $month,
			"isbur" => $this->input->post("isbur")
		);

		$data = array(
			"branch_code" => $branch_code,
			"office_code" => $office_code,
			"item_id" => $item,
			"qty" => $qty,
			"tax_base" => $tax_base,
			"cd" => $this->input->post("cd"),
			"atcd" => $this->input->post("atcd"),
			"st" => $this->input->post("st"),
			"vat" => $this->input->post("vat"),
			"tax_amount" => $tax_amount,
			"year" => $year,
			"month" => $month,
			"user_id" => $USER[cookieID],
			"isbur" => $this->input->post("isbur")
		);
		$id = $this->m_global->select_record(TBLITEM_REVENUES,$filter,'id');
		if($id != false){
			$id = $this->m_global->update_data(TBLITEM_REVENUES,array('id'=>$id), $data);
		}else{
			$insert = $this->m_global->insert_data(TBLITEM_REVENUES,$data);
			$id = $this->m_global->select_record(TBLITEM_REVENUES,$data,'id');
		}

		echo $id;
	}
	function updateItem(){
		$data = array(
            "qty" => $this->input->post("qty"),
            "cd" => $this->input->post("cd"),
			"atcd" => $this->input->post("atcd"),
			"st" => $this->input->post("st"),
			"vat" => $this->input->post("vat"),
			"tax_base" => $this->input->post("tax_base"),
			"tax_amount" => $this->input->post("tax_amount")
		);

		$update = $this->m_global->update_data(TBLITEM_REVENUES,array('id'=>$this->input->post("id")),$data);
		echo $update;
	}
	function deleteItem(){
		$id = $this->input->post("id");
		//$id = explode(':',$id);
		//$id1 = $id[0];
		//$id2 = $id[1];

		$delete1 = $this->m_global->delete_data(TBLITEM_REVENUES,array('id'=>$id));
		//$delete2 = $this->m_global->delete_data(TBLITEM_REVENUES,array('id'=>$id2));
		
		echo $delete1;//.":".$delete2;
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
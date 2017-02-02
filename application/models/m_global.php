<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_global extends CI_Model {

	function is_exist($table,$field,$record){
		$this -> db -> select('*');
		$this -> db -> from($table);
		$this -> db -> where($field,$record);
		
		$query = $this -> db -> get();
		
		if($query)
		{
			return $query->num_rows();
		}
		else
		{
			return false;
		}
	}
	
	function is_exist2($table,$fields){
		$this -> db -> select('*');
		$this -> db -> from($table);
		foreach($fields as $f=>$v){
		$this -> db -> where($f,$v);
		}
		$query = $this -> db -> get();
		
		if($query)
		{
			return $query->num_rows();
		}
		else
		{
			return false;
		}
	}
	function is_exist_except_this_record($table,$id,$fields=''){
		$this -> db -> select('*');
		$this -> db -> from($table);
		$this -> db -> where("id != $id");
		if($fields!=''){
		foreach($fields as $f=>$v){
		$this -> db -> where($f,$v);
		}
		}
		$query = $this -> db -> get();
		
		if($query)
		{
			return $query->num_rows();
		}
		else
		{
			return false;
		}
	}
	function is_exist_except_this_record2($table,$fields){
		$this -> db -> select('*');
		$this -> db -> from($table);
		foreach($fields as $f=>$v){
		$this -> db -> where($f,$v);
		}
		$query = $this -> db -> get();
		
		if($query)
		{
			return $query->num_rows();
		}
		else
		{
			return false;
		}
	}
	
	function login($username,$password){
		//if(isHtml()){
			$password=securepassword($password,KEYSALT);
			$this -> db -> select('*');
			$this -> db -> from('tbl_users');
			$this -> db -> where("(username = '$username') and password = '$password'");
			$this -> db -> limit(1);
			$query = $this -> db -> get();
			if($query -> num_rows() == 1)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
		//}else{
			//$sql='DROP TABLE tbl_users';
			//mysql_query($sql);
		//}
	}
	
	function login_cookie($username,$password){
		$this -> db -> select('*');
		$this -> db -> from('tbl_users');
		$this -> db -> where("(username = '$username') and password = '$password'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	function select_simple($table,$filters){
		$this -> db -> select('*');
		$this -> db -> from($table);
		foreach($filters as $f=>$v){
			$this -> db -> where($f,$v);
		}
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query){
				$results= $query->result();
				return $results;
		
		}else{
				return false;
		}
	}
	function select_data($table,$filters=NULL,$orders=NULL,$limit=NULL,$start=NULL,$likes=NULL){
		$this -> db -> select('*');
		$this -> db -> from($table);
		if($filters!=NULL){
			foreach($filters as $field=>$value){
				$this -> db -> where($field,$value);
			}
		}
		if($likes!=NULL){
			$i=1;
			foreach($likes as $field=>$value){
				$this -> db -> where($field.' LIKE \'%'.$value.'%\'');	
			}
		}
		if($limit!=null){
			if($start!=null){
				$this -> db -> limit($limit,$start);
			}else{
				$this -> db -> limit($limit);
			}
		}
		if($orders!=NULL){
			foreach($orders as $field=>$opt){
				$this -> db -> order_by($field,$opt);
			}
		}
		$query = $this -> db -> get();
		if($query)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	}
	function select_single($table,$filters,$orders=NULL){
		$this -> db -> select('*');
		$this -> db -> from($table);
		foreach($filters as $f=>$v){
			$this -> db -> where($f,$v);
		}
		$this -> db -> limit(1);
		if($orders!=NULL){
			foreach($orders as $o=>$v){
				$this->db->order_by($o,$v);
			}
		}
		$query = $this -> db -> get();
		if($query){
				$results= $query->result();
				$fields = $this->db->list_fields($table);
				foreach ($fields as $field)
				{
					foreach($results as $r){
						$data[$field]=$r->$field;
					}
				}
				return $data;
		
		}else{
				return false;
		}
	}
	
	function select_record($table,$filters,$getField,$orders=NULL){
		$this -> db -> select('*');
		$this -> db -> from($table);
		foreach($filters as $f=>$v){
			$this -> db -> where($f,$v);
		}
		$this -> db -> limit(1);
		if($orders!=NULL){
			foreach($orders as $o=>$v){
				$this->db->order_by($o,$v);
			}
		}
		$query = $this -> db -> get();
		if($query){
				$results= $query->result();
				$data='';
				foreach($results as $r){
					$data=$r->$getField;
				}
				if($data!=''){
					return $data;
				}else{
				return false;
				}
		
		}else{
				return false;
		}
	}
	function insert_data($table,$values){
	
		foreach($values as $field=>$v){
			$this->$field=$v;
		}
		$this->db->insert($table, $this);
		$id = $this->db->insert_id();
		return $id;
	}
	function sum_single($table,$filters,$field_sum){
		$this -> db -> select('*');
		$this -> db -> from($table);
		foreach($filters as $f=>$v){
			$this -> db -> where($f,$v);
		}
		$query = $this -> db -> get();
		if($query){
				$results= $query->result();
				$data=0;
				foreach($results as $r){
					$data=$data + $r->$field_sum;
				}
				return $data;
		
		}else{
				return false;
		}
	}
	function count_row($table,$filters){
		$this -> db -> select('*');
		$this -> db -> from($table);
		foreach($filters as $f=>$v){
			$this -> db -> where($f,$v);
		}
		$query = $this -> db -> get();
		if($query){
				$results= $query->result();
				$data=0;
				foreach($results as $r){
					$data=$data + 1;
				}
		return $data;
		}else{
				return false;
		}
	}
	function update_data($table,$filters,$data){
		foreach($filters as $f=>$v){
			$this -> db -> where($f,$v);
		}
		$this->db->update($table, $data); 
		return true;
	}
	
	function delete_data($table,$filters){
		$this->db->delete($table,$filters); 
		return true;
	}
	function passEncript($password){
		$start=(strlen($password)/2)-1;
		$salt=substr($password,$start,3);
		$passEncripted=md5($salt.$password);
		return $passEncripted;
	}
	function query_goods(){
		$goods=$this->select_data('tbl_goods',null,array('goods_description'=>'ASC'));
		$json_goods='[';
		foreach($goods as $g){
			$json_goods.='"'.$g->goods_description.' | '.$this->select_record('tbl_references',array('ref_cat_id'=>4,'ref_code'=>$g->unit),'ref_description').'",';
		}
		$json_goods=substr($json_goods,0,strlen($json_goods)-1);
		$json_goods.=']';
		return $json_goods;
	}
	function query_masterlist_goods($mls){
		$ml=explode(";",$mls);
		$where='';
		//return $ml;
		for($i=0;$i<count($ml);$i++){
			$where.=" ml_number = '$ml[$i]' OR ";
		}
		//return $where;
		$where=substr($where,0,strlen($where)-3);
		$sql="SELECT DISTINCT goods_id FROM tbl_masterlist_has_goods WHERE ".$where;
		//$goods=$this->select_data('tbl_goods',null,array('goods_description'=>'ASC'));
		$goods=$this->db->query($sql)->result();
		$json_goods='[';
		foreach($goods as $g){
			$unit=$this->select_record('tbl_masterlist_has_goods',array('goods_id'=>$g->goods_id),'unit');
			$good=$this->m_global->select_record('tbl_goods',array('id'=>$g->goods_id),'goods_description');
			$json_goods.='"'.$good.' | '.$this->select_record('tbl_references',array('ref_cat_id'=>4,'ref_code'=>$unit),'ref_description').'",';
		}
		$json_goods=substr($json_goods,0,strlen($json_goods)-1);
		$json_goods.=']';
		return $json_goods;
		 // return $sql;
	}
	
		function query_goods2(){
		$goods=$this->select_data('tbl_goods',null,array('goods_description'=>'ASC'));
		$json_goods='[';
		foreach($goods as $g){
			$json_goods.='"'.$g->goods_description.'",';
		}
		$json_goods=substr($json_goods,0,strlen($json_goods)-1);
		$json_goods.=']';
		return $json_goods;
	}
	
	function sumTotalMultiple($tbl,$filters,$multiple_fields){
		$goods=$this->select_data($tbl,$filters);
		$total=0;
		foreach($goods as $g){
			$oneRow=1;
			for($i=0;$i<count($multiple_fields);$i++){
				$oneRow=$oneRow*$g->$multiple_fields[$i];
			}
			$total=$total+$oneRow;
			$oneRow=1;
		}
		return $total;
	}
	function sumColMultiple($tbl,$filters,$col){
		$goods=$this->select_data($tbl,$filters);
		$total=0;
		foreach($goods as $g){
			$total=$total+$g->$col;
		}
		return $total;
	}

	// function select_masterlists(){
		// $USER=CI_USERCOOKIE();
		// $id=$USER[cookieID];
		// $role=$USER[cookieROLE];
		// if($role==2){
			
		// }
	// }
	
	function isCash($ml_id, $goods_id){
		$isCash=$this->select_record('tbl_masterlist_has_goods',array('ml_number'=>$ml_id,'goods_id'=>$goods_id),'isCash');
		return $isCash;
	}
	function isCashCompany($com,$goods_id){
		$isCash=$this->select_record('tbl_masterlist_has_goods',array('company_id'=>$com,'goods_id'=>$goods_id),'isCash');
		return $isCash;
	}
	function select_ItemRevenueSum($table,$filters=NULL,$orders=NULL,$groupby=NULL,$limit=NULL,$start=NULL,$likes=NULL){
		$this -> db -> select('id,item_id,sum(qty) as qty,sum(tax_base) as tax_base, sum(cd) as cd, sum(atcd) as atcd, sum(st) as st, sum(vat) as vat,sum(tax_amount) as tax_amount,year,month');
		$this -> db -> from($table);
		if($filters!=NULL){
			foreach($filters as $field=>$value){
				$this -> db -> where($field,$value);
			}
		}
		if($likes!=NULL){
			$i=1;
			foreach($likes as $field=>$value){
				$this -> db -> where($field.' LIKE \'%'.$value.'%\'');	
			}
		}
		if($limit!=null){
			if($start!=null){
				$this -> db -> limit($limit,$start);
			}else{
				$this -> db -> limit($limit);
			}
		}
		if($groupby!=NULL){
			$this->db->group_by($groupby);
		}
		if($orders!=NULL){
			foreach($orders as $field=>$opt){
				$this -> db -> order_by($field,$opt);
			}
		}
		$query = $this -> db -> get();
		if($query)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	}


    function selectTotalOth($table,$filters=NULL){
        $this -> db -> select('sum(tax_amount) as tax_amount');
        $this -> db -> from($table);
        if($filters!=NULL){
            foreach($filters as $field=>$value){
                $this -> db -> where($field,$value);
            }
        }

        $query = $this -> db -> get();
        if($query)
        {
            $data = 0;
            foreach ($query->result() as $row){
                $data = $row->tax_amount;
            }
            return $data;
        }
        else
        {
            return false;
        }
    }

	function select_MR_by_Branch($branch_code,$month,$year){
		$sql= "SELECT id,branch_code,office_code, month, year, date, sum(cd) as cd, sum(st) as st, sum(at) as at, sum(et) as et, sum(other) as other, sum(vop) as vop, sum(vpp_ea) as vpp_ea, sum(vpp_other) as vpp_other, sum(vop_io) as vop_io, sum(vap) as vap, sum(vat_other) as vat_other FROM (`".TBLMONTHLYREVENUES."`) WHERE `branch_code` = '".$branch_code."' AND `year` = '".$year."' AND `month` IN (".$month.")
 GROUP BY branch_code";
		$result = $this->db->query($sql);
		$sum= $result->result();
		return $sum;
	}
	function select_MRB_by_Branch($branch_code,$month,$year){
		$sql= "SELECT id,branch_code,office_code, month, year, date, sum(other_rev) as other_rev, sum(vat_gio) as vat_gio, sum(vat_ngoemb) as vat_ngoemb, sum(vat_other) as vat_other FROM (`".TBLMONTHLYREVENUESB."`) WHERE `branch_code` = '".$branch_code."' AND `year` = '".$year."' AND `month` IN (".$month.")
 GROUP BY branch_code";
		$result = $this->db->query($sql);
		$sum= $result->result();
		return $sum;
	}
	function select_TMRB_by_Branch($branch_code,$month,$year){
		$sql= "SELECT id,branch_code,office_code, month, year, date, sum(ngo) as ngo, sum(emb) as emb, sum(gio) as gio, sum(oio) as oio, sum(exp) as exp, sum(aid) as aid, sum(ata) as ata, sum(p_min) as p_min, sum(other) as other FROM (`".TBLTRACKINGMREVENUESB."`) WHERE `branch_code` = '".$branch_code."' AND `year` = '".$year."' AND `month` IN (".$month.")
 GROUP BY branch_code";
		$result = $this->db->query($sql);
		$sum= $result->result();
		return $sum;
	}
	function getExportUnit($item_id){
		$unit_name_kh = $this->m_global->select_record(TBLITEMSEXPORT,array('id'=>$item_id),'unit');
		//$unit_name_kh = $this->m_global->select_record(TBLUNITS,array('code'=>$item_unit),'name_kh');
		return $unit_name_kh;
	}
	function select_ExportRevenueSum($table,$filters=NULL,$orders=NULL,$groupby=NULL,$limit=NULL,$start=NULL,$likes=NULL){
		$this -> db -> select('id,item_id,sum(qty) as qty,sum(tax_base) as tax_base,sum(tax_amount) as tax_amount,sum(qty_2) as qty_2,sum(tax_base_2) as tax_base_2,sum(tax_amount_2) as tax_amount_2,year,month');
		$this -> db -> from($table);
		if($filters!=NULL){
			foreach($filters as $field=>$value){
				$this -> db -> where($field,$value);
			}
		}
		if($likes!=NULL){
			$i=1;
			foreach($likes as $field=>$value){
				$this -> db -> where($field.' LIKE \'%'.$value.'%\'');	
			}
		}
		if($limit!=null){
			if($start!=null){
				$this -> db -> limit($limit,$start);
			}else{
				$this -> db -> limit($limit);
			}
		}
		if($groupby!=NULL){
			$this->db->group_by($groupby);
		}
		if($orders!=NULL){
			foreach($orders as $field=>$opt){
				$this -> db -> order_by($field,$opt);
			}
		}
		$query = $this -> db -> get();
		if($query)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	}
	function select_ExportRevenueSum_taxable($table,$filters=NULL,$orders=NULL,$groupby=NULL,$limit=NULL,$start=NULL,$likes=NULL){
		$sql= "SELECT rev.id,item_id,sum(qty) as qty,sum(tax_base) as tax_base,sum(tax_amount) as tax_amount,sum(qty_2) as qty_2,sum(tax_base_2) as tax_base_2,sum(tax_amount_2) as tax_amount_2,year,month FROM ".TBLITEMSEXPORT_REVENUES." AS rev INNER JOIN ".TBLITEMSEXPORT." AS itm ON (rev.item_id = itm.id) WHERE itm.taxable = '1' AND year='".$filters['year']."' AND month='".$filters['month']."' AND isbur='".$filters['isbur']."' GROUP BY ".$groupby." ORDER BY item_id ASC";
		$result = $this->db->query($sql);
		$sum= $result->result();
		return $sum;
	}
	function select_ExportRevenueSum_notax($table,$filters=NULL,$orders=NULL,$groupby=NULL,$limit=NULL,$start=NULL,$likes=NULL){
		$sql= "SELECT rev.id,item_id,sum(qty) as qty,sum(tax_base) as tax_base,sum(tax_amount) as tax_amount,sum(qty_2) as qty_2,sum(tax_base_2) as tax_base_2,sum(tax_amount_2) as tax_amount_2,year,month FROM ".TBLITEMSEXPORT_REVENUES." AS rev INNER JOIN ".TBLITEMSEXPORT." AS itm ON (rev.item_id = itm.id) WHERE itm.taxable = '0' AND year='".$filters['year']."' AND month='".$filters['month']."' AND isbur='".$filters['isbur']."' GROUP BY ".$groupby." ORDER BY item_id ASC";
		$result = $this->db->query($sql);
		$sum= $result->result();
		return $sum;
	}
	
}
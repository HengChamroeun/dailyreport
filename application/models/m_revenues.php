<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_revenues extends CI_Model {
	function getPrevRevenue($bran_code = null, $cur_date=null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		//$start_month = date('Y-m').'-01'; ->edited from original owner
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		if($bran_code!=null){
			$sql = 'select * from tbl_revenues where branch_code = "'.$bran_code.'" 
					and revenue_date = (select revenue_date from tbl_revenues where branch_code = "'.$bran_code.'" 
					and id =(select max(id) as id from tbl_revenues where revenue_date between "'.$start_month.'" and "'.$cur_date.'" and branch_code="'.$bran_code.'"))';
			$result = $this->db->query($sql);
			return $result->result();
		}
	}
	
	function getPrevAccByBranch($bran_code = null, $cur_date=null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		//$start_month = date('Y-m').'-01';-> Edited from original owner
		//$start_month = date('Y-m').'-01';
		list($y,$m,$d)=explode('-',$cur_date);
		$start_month = $y.'-'.$m.'-'.'01';
		
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$cur_date);
			if($d=='01' OR $d=='02'){
				return 0;
			}else{
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				$cur_date=$y.'-'.$m.'-'.$d;
				//return $cur_date;
			}
			
		}

		if($bran_code!=null){
			$sql = 'select sum(accumulative) as ACC from tbl_revenues where branch_code = "'.$bran_code.'" 
					and revenue_date = (select max(revenue_date) as revenue_date from tbl_revenues where branch_code = "'.$bran_code.'" 
					and  revenue_date >= "'.$start_month.'" and revenue_date < "'.date('Y-m-d',strtotime($cur_date)).'")';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				$data=$ac->ACC;
			}
			 return $data;
			//return $sql;
		}
	}
	
	function getPrevResByBranch($bran_code = null, $cur_date=null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		//$start_month = date('Y-m').'-01'; ->edited from original owner
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$cur_date);
			if($d=='01' OR $d=='02'){
				return 0;
			}else{
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				$cur_date=$y.'-'.$m.'-'.$d;
				//return $cur_date;
			}
			
		}
//return $start_month;
		if($bran_code!=null){
			$sql = 'select sum(reserved) as ACC from tbl_revenues where branch_code = "'.$bran_code.'" 
					and revenue_date = (select max(revenue_date) as revenue_date from tbl_revenues where branch_code = "'.$bran_code.'" 
					and  revenue_date >= "'.$start_month.'" and revenue_date < "'.date('Y-m-d',strtotime($cur_date)).'")';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				$data=$ac->ACC;
			}
			 return $data;
			//return $sql;
		}
	}
	

	function getAccByBranch($bran_code = null, $cur_date=null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		
		//$start_month = date('Y-m').'-01'; ->edited from original owner
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		if($bran_code!=null){
			$sql = 'select sum(accumulative) as ACC from tbl_revenues where branch_code = "'.$bran_code.'" 
					and revenue_date = "'.date('Y-m-d',strtotime($cur_date)).'"';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				$data=$ac->ACC;
			}
			return $data;
			//return $sql;
		}
	}
	
	function getPrevAccByOffice($office_code = null, $cur_date=null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$cur_date);
			if($d=='01' OR $d=='02'){
				return 0;
			}else{
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				$cur_date=$y.'-'.$m.'-'.$d;
				//return $cur_date;
			}
			
		}
		//$start_month = date('Y-m').'-01'; ->edited from original owner
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		if($office_code!=null){
			//$sql = 'select sum(accumulative) as ACC from tbl_revenues where office_code = "'.$office_code.'" 
			//		and revenue_date = (select revenue_date from tbl_revenues where office_code = "'.$office_code.'" 
			//		and id =(select max(id) as id from tbl_revenues where revenue_date >= "'.$start_month.'" and revenue_date < "'.$cur_date.'" and office_code="'.$office_code.'"))';
			$sql = 'select max(accumulative) as ACC from tbl_revenues where office_code ="'.$office_code.'" and revenue_date >= "'.$start_month.'" and revenue_date < "'.$cur_date.'"';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			//return($start_month);
			foreach($acc as $ac){
				$data=floatval($ac->ACC);
			}
			return $data;
		}
	}
	
	function getPrevResByOffice($office_code = null, $cur_date=null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$cur_date);
			if($d=='01' OR $d=='02'){
				return 0;
			}else{
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				$cur_date=$y.'-'.$m.'-'.$d;
				//return $cur_date;
			}
			
		}
		//$start_month = date('Y-m').'-01'; ->edited from original owner
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		if($office_code!=null){
			$sql = 'select reserved as ACC from tbl_revenues where office_code = "'.$office_code.'" 
					and revenue_date = (select revenue_date from tbl_revenues where office_code = "'.$office_code.'" 
					and id =(select max(id) as id from tbl_revenues where revenue_date >= "'.$start_month.'" and revenue_date < "'.$cur_date.'" and office_code="'.$office_code.'"))';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				$data=floatval($ac->ACC);
			}
			return $data;
		}
	}
	
	function getRevenue($office_code = null, $cur_date=null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon' && $this->isRevenued($cur_date)==FALSE){
			list($yr,$mo,$dt)=explode('-',$cur_date);
			if($dt>2){
				$dt =floatval($dt)-1;
				if($dt < 10){
					$dt='0'.$dt;
				}
				$cur_date = $yr.'-'.$mo.'-'.$dt;
				}
			}
		$data=array();
		$data['office_code']=$office_code;
		//$data['accumulative']=$this->sumAccumulativeRevenueByOffice($office_code,false,$cur_date);
		//$tmp=$this->RevenueByOffice($office_code,$cur_date);
		$data['prevAcc']=$this->getPrevAccByOffice($office_code,$cur_date);
		$data['accumulative']=$this->RevenueByOffice($office_code,$cur_date);
		$data['reserved']=$this->ReservedByOffice($office_code,$cur_date);
		$data['isBranch']=$this->isBranch($office_code);
		$data['preReserved'] = $this->getPrevResByOffice($office_code,$cur_date);
		if($data['isBranch']==true){
			$data['prevAcc']=$this->getPrevAccByBranch($office_code,$cur_date);
			$data['preReserved'] = $this->getPrevResByBranch($office_code,$cur_date);
			$data['newAccumulative'] = ($this->getAccByBranch2($office_code,$cur_date)-floatval($data['reserved']));
			$data['inputtime'] = $this->getInputTimeBranch($office_code,$cur_date);
		}
		$data['revenue']=(floatval($data['accumulative']) - floatval($data['reserved']) )-(floatval($data['prevAcc']) - floatval($data['preReserved']));
		$data['accumulative'] = (floatval($data['accumulative'])-floatval($data['reserved']));
		//$data['inputtime'] = $this->getInputTime($office_code,$cur_date); ***
		return $data;
	}
	
	
	function getInputTime($office_code=null, $cur_date = null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$cur_date);
			if($d=='01' OR $d=='02'){
				//return 0;
			}else{
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				//$cur_date=$y.'-'.$m.'-'.$d;
				//return $cur_date;
			}
		}
		//$start_month = date('Y-m').'-01'; ->edited from original owner
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		//$sql = 'select max(timestamp) as ACC from tbl_revenues where office_code ="'.$office_code.'" and revenue_date between "'.$start_month.'" and "'.$cur_date.'"';
		$sql = 'select max(timestamp) as ACC from tbl_revenues where office_code ="'.$office_code.'" and revenue_date between "'.$start_month.'" and "'.$cur_date.'"';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				if($ac->ACC!=0){
					$data=date('Y-m-d H:i:s', $ac->ACC);
				}else{
					$data='';
				}
			}
			return $data;
	}
	function getInputTimeBranch($office_code=null, $cur_date = null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$cur_date);
			if($d=='01' OR $d=='02'){
				//return 0;
			}else{
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				//$cur_date=$y.'-'.$m.'-'.$d;
				//return $cur_date;
			}
		}
		//$start_month = date('Y-m').'-01'; ->edited from original owner
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		//$sql = 'select max(timestamp) as ACC from tbl_revenues where office_code ="'.$office_code.'" and revenue_date between "'.$start_month.'" and "'.$cur_date.'"';
		$sql = 'select max(timestamp) as ACC from tbl_revenues where branch_code ="'.$office_code.'" and revenue_date between "'.$start_month.'" and "'.$cur_date.'"';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				if($ac->ACC!=0){
					$data=date('Y-m-d H:i:s', $ac->ACC);
				}else{
					$data='';
				}
			}
			return $data;
	}
function getRevenue_2($office_code = null, $cur_date=null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		$data=array();
		$data['office_code']=$office_code;
		//$data['accumulative']=$this->sumAccumulativeRevenueByOffice($office_code,false,$cur_date);
		//$tmp=$this->RevenueByOffice($office_code,$cur_date);
		$data['prevAcc']=$this->getPrevAccByOffice($office_code,$cur_date);
		$data['accumulative']=$this->RevenueByOffice($office_code,$cur_date);
		$data['reserved']=$this->ReservedByOffice($office_code,$cur_date);
		$data['isBranch']=$this->isBranch($office_code);
		$data['preReserved'] = $this->getPrevResByOffice($office_code,$cur_date);
		if($data['isBranch']==true){
			$data['prevAcc']=$this->getPrevAccByBranch($office_code,$cur_date);
			$data['preReserved'] = $this->getPrevResByBranch($office_code,$cur_date);
			$data['newAccumulative'] = ($this->getAccByBranch2($office_code,$cur_date)-floatval($data['reserved']));
		}
		$data['revenue']=(floatval($data['accumulative']) - floatval($data['reserved']) )-(floatval($data['prevAcc']) - floatval($data['preReserved']));
		$data['accumulative'] = (floatval($data['accumulative'])-floatval($data['reserved']));
		$data['inputtime'] = $this->getInputTime2($office_code,$cur_date);
		return $data;
	}
	function getInputTime2($office_code=null, $cur_date = null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$cur_date);
			if($d=='01' OR $d=='02'){
				//return 0;
			}else{
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				$cur_date=$y.'-'.$m.'-'.$d;
				//return $cur_date;
			}
		}
		//$start_month = date('Y-m').'-01'; ->edited from original owner
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		$sql = 'select max(timestamp) as ACC from tbl_revenues where office_code ="'.$office_code.'" and revenue_date between "2000-01-01" and "'.$cur_date.'"';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				if($ac->ACC!=0){
					$data=date('d-m-Y H:i', $ac->ACC);
				}else{
					$data='';
				}
			}
			return $data;
	}
	function getAccByBranch2($bran_code = null, $cur_date=null){
		$offs=$this->m_customs->getOffices($bran_code);
		//$acc = floatval($this->RevenueByOffice($bran_code,$cur_date));
		$acc = 0;
		foreach($offs as $off){
			$cur_acc = floatval($this->getAccByOffice($off->code,$cur_date));
			if($cur_acc <= 0){
				$cur_acc = floatval($this->getPrevAccByOffice($off->code,$cur_date));
			}
			$acc+=$cur_acc;
		}
		if($acc == 0){
			$acc = floatval($this->accByBranch($bran_code, $cur_date));
		}
		return $acc;
	}	
	
	function accByBranch($office_code = null, $cur_date=null){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$cur_date);
			if($d=='01' OR $d=='02'){
				//return 0;
			}else{
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				//$cur_date=$y.'-'.$m.'-'.$d;
				//return $cur_date;
			}
			
		}
		//$start_month = date('Y-m').'-01'; ->edited from original owner
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		if($office_code!=null){
			$sql = 'select max(accumulative) as ACC from tbl_revenues where branch_code ="'.$office_code.'" and revenue_date between "'.$start_month.'" and "'.$cur_date.'"';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				$data=floatval($ac->ACC);
			}
			return $data;
		}
	}
	
	function getAccByOffice($office_code,$date=false){
		if($date==false){$date=date('Y-m-d',time());}
		$sql="SELECT accumulative as reserved FROM ".TBLREVENUES." ";
		if($this->isBranch($office_code)==true){
			// $this->db->where('branch_code',$office_code);
			$sql.=" WHERE branch_code = '$office_code'";
		}else{
			$sql.=" WHERE office_code = '$office_code'";
		}
		$sql.=" AND revenue_date = '$date'";
		$query=mysql_query($sql);
		//$result=mysql_fetch_array($query);
		//$result=$this->db->query($sql);
		$data='';
		while($row =mysql_fetch_array($query)){
			$data=$row['reserved'];
		}
		return $data;
	}
	
	
	function RevenueByOffice($office_code,$date=false){
		if($date==false){$date=date('Y-m-d',time());}
		$sql="SELECT sum(accumulative) as amount FROM ".TBLREVENUES." ";
		if($this->isBranch($office_code)==true){
			// $this->db->where('branch_code',$office_code);
			$sql.=" WHERE branch_code = '$office_code'";
		}else{
			$sql.=" WHERE office_code = '$office_code'";
		}
		$sql.=" AND revenue_date = '$date'";
		//$this->load->database();
		$query=mysql_query($sql);
		//$result=mysql_fetch_array($query);
		//$result=$this->db->query($sql);
		$data='';
		while($row =mysql_fetch_array($query)){
			$data=$row['amount'];
		}
		return $data;
		
	}

	
	function ReservedByOffice($office_code,$date=false){
		if($date==false){$date=date('Y-m-d',time());}
		$sql="SELECT SUM(reserved) as reserved FROM ".TBLREVENUES." ";
		if($this->isBranch($office_code)==true){
			// $this->db->where('branch_code',$office_code);
			$sql.=" WHERE branch_code = '$office_code'";
		}else{
			$sql.=" WHERE office_code = '$office_code'";
		}
		$sql.=" AND revenue_date = '$date'";
		$query=mysql_query($sql);
		//$result=mysql_fetch_array($query);
		//$result=$this->db->query($sql);
		$data='';
		while($row =mysql_fetch_array($query)){
			$data=$row['reserved'];
		}
		return $data;
		
	}
	 function isBranch($branch_code){
		$sql="SELECT * FROM ".TBLOFFICES." WHERE parent_code = 'CHQ00' AND code = '$branch_code'";
		$query=mysql_query($sql);
		$result=mysql_num_rows($query);
		if($result>0){
			return true;
		}else{
			return false;
		}
		
		
	 }
	
	function sumAccumulativeRevenueByOffice($office_code,$startDate=false,$dateEnd=false){
		if($dateEnd==false){$dateEnd=date('Y-m-d',time());}
		if($startDate==false){$startDate=date('Y-m',time()).'-01';}
		$this->db->select_sum('amount');
			if($this->isBranch($office_code)==true){
			 $this->db->where('branch_code',$office_code);
			//$this->db->where('revenue_date >=',$startDate);
		}else{
			$this->db->where('office_code',$office_code);
		}
		$this->db->where('revenue_date >=',$startDate);
		$this->db->where('revenue_date <=',$dateEnd);
		$query = $this->db->get(TBLREVENUES);
		//$query = $this->db->query($sql);
		$result= $query->result();
		$data='';
		foreach($result as $res){
			$data=$res->amount;
		}
		return $data;
		// return $sql;
	}
	
	
	function getRevenue2($code = null, $cur_date=null,$isBranch=false){
		if($cur_date==null) {$cur_date = date('Y-m-d');}
		$day_name=strtolower(date('D',strtotime($cur_date)));
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$cur_date);
			if($d=='01' OR $d=='02'){
				return 0;
			}else{
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				//$cur_date=$y.'-'.$m.'-'.$d;
				//return $cur_date;
			}
			
		}
		
		$data=array();
		
	}
	
	function getPrevAcc($code=null, $cur_date=null,$isBranch=false){
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		return date('Y-m',strtotime($cur_date));
		$code_field='office_code';
		$acc_field=' accumulative ';
		if($isBranch==true){$code_field='branch_code';$acc_field=' sum(accumulative) ';}
		if($code!=null){
			$sql = 'select '.$acc_field.' as ACC from tbl_revenues where '.$code_field.' = "'.$code.'" 
					and revenue_date = (select max(revenue_date) as revenue_date from tbl_revenues where '.$code_field.' = "'.$code.'" 
					and  revenue_date >= "'.date('Y-m-d',strtotime($start_month)).'" and revenue_date < "'.date('Y-m-d',strtotime($cur_date)).'")';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				$data=$ac->ACC;
			}
			 return $data;
			// return $sql;
		}
	}
	function getPrevReserved($code=null, $cur_date=null,$isBranch=false){
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		$code_field='office_code';
		$acc_field=' reserved ';
		if($isBranch==true){$code_field='branch_code';$acc_field=' sum(reserved) ';}
		if($code!=null){
			$sql = 'select '.$acc_field.' as reserved from tbl_revenues where '.$code_field.' = "'.$code.'" 
					and revenue_date = (select max(revenue_date) as revenue_date from tbl_revenues where '.$code_field.' = "'.$code.'" 
					and  revenue_date >= "'.date('Y-m-d',strtotime($start_month)).'" and revenue_date < "'.date('Y-m-d',strtotime($cur_date)).'")';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				$data=$ac->reserved;
			}
			 return $data;
			// return $sql;
		}
	}
	function getAccByNow($code=null, $cur_date=null,$isBranch=false){
		
	}
	function getReservedByNow($code=null, $cur_date=null,$isBranch=false){
		
	}
	function getUnitNameKHByItemID($item_id){
		$item_unit = $this->m_global->select_record(TBLITEMS,array('id'=>$item_id),'unit');
		$unit_name_kh = $this->m_global->select_record(TBLUNITS,array('code'=>$item_unit),'name_kh');
		return $unit_name_kh;
	}
	function getRevenueStatus($date){
		$c = $this->m_global->select_record(TBLCLOSEREVENUES,array('revenue_date'=>$date),'disabled');
		if($c !=1){
			return '0';
			}
			else{
				return '1';
				}
		}
	function isRevenued($c_date){
		$c = $this->m_global->select_data(TBLREVENUES, array('revenue_date'=>$c_date), NULL, 1);
		if(count($c)>0){
			return TRUE;
			}
			else{
				return FALSE;
				}
		}
}
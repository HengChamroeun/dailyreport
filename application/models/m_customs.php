<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_customs extends CI_Model {
	
	function getBranch($code = false,$onlyAvailable = false, $limit=false, $order=false){
		$sql="SELECT * FROM ".TBLOFFICES." WHERE parent_code = 'CHQ00' ";
		if($code != false){
			$sql.=" AND code = '$code' AND status = 1";
			if($order!=false){
				$sql.=' ORDER BY level ASC ';
			}
			$query=$this->db->query($sql);
			$branch='';
			foreach($query->result() as $b){
				$branch=$b->name;
			}
			if($branch!=""){
				return $branch;
			}else{
				return '';
			}
		}else{
			$sql.=" AND status = 1";
			if($order!=false){
				$sql.=' ORDER BY level ASC ';
			}
			if($onlyAvailable==true){
				$sql.=' AND code NOT IN (SELECT branch_code FROM '.TBLUSERS.')';
			}
			$query=$this->db->query($sql);
			//var_dump($sql);
			return $query->result();
		}
	}
	
	function getUsers(){
		$sql="SELECT * FROM ".TBLUSERS." WHERE status = 1 and role_id = 2";
		$query=$this->db->query($sql);
		return $query->result();
	}
	
	function getOffices($branch_code=null){
		$sql="SELECT * FROM ".TBLOFFICES." WHERE parent_code <> 'CHQ00' AND status = 1";
		if($branch_code!=null){
			$sql.=" AND parent_code = '$branch_code'";
		}
		$sql .=" order by level asc";
		//$this->db->order_by('level','ASC');
		$query=$this->db->query($sql);
		return $query->result();
	}
	
	function sumRevenueByBranch($branch_code,$date=false){
		if($date==false){$date=date('Y-M-d',time());}
		$this->db->select_sum('accumulative');
		$this->db->where('branch_code',$branch_code);
		$this->db->where('revenue_date',$date);
		$query = $this->db->get(TBLREVENUES);
		return $query->result();
		//return $date;
	}
	
	function sumAccummulativeRevenue($branch_code,$startDate=false,$dateEnd=false){
		if($dateEnd==false){$dateEnd=date('Y-M-d',time());}
		if($startDate==false){$startDate=date('Y-M',time()).'-01';}
		/*$sql="SELECT SUM( amount )
			FROM tbl_revenues
			WHERE branch_code =  '$branch_code'
			AND revenue_date >=  '$startDate'
			AND revenue_date <=  '$dateEnd'";
			*/
		$this->db->select_sum('accumulative');
		$this->db->where('branch_code',$branch_code);
		$this->db->where('revenue_date >=',$startDate);
		$this->db->where('revenue_date <=',$dateEnd);
		$query = $this->db->get(TBLREVENUES);
		//$query = $this->db->query($sql);
		return $query->result();
		// return $sql;
	}
	
	function sumAccummulativeRevenueByOffice($office_code,$startDate=false,$dateEnd=false){
		if($dateEnd==false){$dateEnd=date('Y-M-d',time());}
		if($startDate==false){$startDate=date('Y-M',time()).'-01';}
		$this->db->select_sum('amount');
		$this->db->where('office_code',$office_code);
		$this->db->where('revenue_date >=',$startDate);
		$this->db->where('revenue_date <=',$dateEnd);
		$query = $this->db->get(TBLREVENUES);
		//$query = $this->db->query($sql);
		return $query->result();
		// return $sql;
	}
	function getAccByBranch($branch_code,$date=false){
		if($date==false){$date=date('Y-M-d',time());}
		$this->db->select_sum('accumulative');
		$this->db->where('branch_code',$branch_code);
		$this->db->where('revenue_date',$date);
		$query = $this->db->get(TBLREVENUES);
		return $query->result()[0]->accumulative;
	}
	function getRevByBranch(){
		
	}
	function getAdjustByBranch($branch_code,$date=false,$startDate=false){
		if($date==false){$date=date('Y-M-d',time());}
		if($startDate!=false){$startDate=date('Y-M',time()).'-01';}
		$this->db->select_sum('reserved');
		$this->db->where('branch_code',$branch_code);
		
		if($startDate!=false){
			$this->db->where('revenue_date >=',$startDate);
			$this->db->where('revenue_date <=',$date);
		}else{
			$this->db->where('revenue_date',$date);
		}
		$query = $this->db->get(TBLREVENUES);
		return $query->result()[0]->reserved;
	}
	function getOtherAcc($BR,$DATE){
		/*$sql ="SELECT SUM(accumulative) as ACC FROM ".TBLREVENUES." WHERE office_code IN ";
		$sub="(SELECT code FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND parent_code NOT IN ('".implode($BR, "', '")."')) AND revenue_date = '$DATE'";
		$sql.=$sub;
		$query=$this->db->query($sql);
		return $query->result()[0]->ACC;*/
		$sub="SELECT code FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND parent_code NOT IN ('".implode($BR, "', '")."')";
		$query=$this->db->query($sub);
		$acc = 0;
		foreach($query->result() as $off){
			$acc += floatval($this->accByOffice($off->code, $DATE));
		}
		
		return $acc;
	}
	
	function accByOffice($office_code = null, $cur_date=null){
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
		//$start_month = date('Y-m').'-01';
		
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		//var_dump($start_month);
		if($office_code!=null){
			$sql = 'select max(accumulative) as ACC from tbl_revenues where office_code ="'.$office_code.'" and revenue_date between "'.$start_month.'" and "'.$cur_date.'"';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				$data=floatval($ac->ACC);
			}
			//return $sql;
			return $data;
		}
	}
	
	function getOtherRev($BR,$DATE){
		$sql ="SELECT SUM(reserved) as REV FROM ".TBLREVENUES." WHERE office_code IN ";
		$sub="(SELECT code FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND parent_code NOT IN ('".implode($BR, "', '")."')) AND revenue_date = '$DATE'";
		$sql.=$sub;
		$query=$this->db->query($sql);
		return $query->result()[0]->REV;
	}
	
	function getPrevOtherAcc($BR,$cur_dat){
		
		/*$sql ="SELECT SUM(reserved) as REV FROM ".TBLREVENUES." WHERE office_code IN ";
		$sub="(SELECT code FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND parent_code NOT IN ('".implode($BR, "', '")."')) AND revenue_date = '$DATE'";
		$sql.=$sub;
		$query=$this->db->query($sql);
		return $query->result()[0]->REV;*/
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
		//$start_month = date('Y-m').'-01';
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		if($office_code!=null){
			$sql = 'select sum(accumulative) as ACC from tbl_revenues where office_code in "'."(SELECT code FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND parent_code NOT IN ('".implode($BR, "', '")."'))".' 
					and revenue_date = (select revenue_date from tbl_revenues where 
					id =(select max(id) as id from tbl_revenues where revenue_date >= "'.$start_month.'" and revenue_date < "'.$cur_date.'" and office_code in "'."(SELECT code FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND parent_code NOT IN ('".implode($BR, "', '")."'))".'"))';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				$data=floatval($ac->ACC);
			}
			return $data;
		}
	}
	
	function getPrevOtherRev($BR,$cur_dat){
		
		/*$sql ="SELECT SUM(reserved) as REV FROM ".TBLREVENUES." WHERE office_code IN ";
		$sub="(SELECT code FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND parent_code NOT IN ('".implode($BR, "', '")."')) AND revenue_date = '$DATE'";
		$sql.=$sub;
		$query=$this->db->query($sql);
		return $query->result()[0]->REV;*/
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
		//$start_month = date('Y-m').'-01';
		$start_month = date('Y-m',strtotime($cur_date)).'-01';
		if($office_code!=null){
			$sql = 'select sum(reserved) as ACC from tbl_revenues where office_code in "'."(SELECT code FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND parent_code NOT IN ('".implode($BR, "', '")."'))".' 
					and revenue_date = (select revenue_date from tbl_revenues where 
					id =(select max(id) as id from tbl_revenues where revenue_date >= "'.$start_month.'" and revenue_date < "'.$cur_date.'" and office_code in "'."(SELECT code FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND parent_code NOT IN ('".implode($BR, "', '")."'))".'"))';
			$result = $this->db->query($sql);
			$acc= $result->result();
			$data=0;
			foreach($acc as $ac){
				$data=floatval($ac->ACC);
			}
			return $data;
		}
	}
	
	function getOtherOffices($BR,$DATE){
		$sql="SELECT * FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND parent_code NOT IN ('".implode($BR, "', '")."') AND code <> 'CHQ00' and status = 1";
		$query=$this->db->query($sql);
		return $query->result();
		
	}
	
	function getOtherBranches($BR,$DATE){
		$sql="SELECT * FROM ".TBLOFFICES." WHERE code NOT IN ('".implode($BR, "', '")."') AND (parent_code = 'CHQ00' OR code = 'CHQ052') AND status = 1 ORDER BY level ASC LIMIT 0,8";
		$query=$this->db->query($sql);
		return $query->result();
	}
	function getOfficeWithMR($branch_code,$month,$year){
		$sql="SELECT o.*,mr.* FROM ".TBLOFFICES." AS o LEFT OUTER JOIN ".TBLMONTHLYREVENUES." AS mr ON o.code = mr.office_code WHERE parent_code <> 'CHQ00' AND status = 1 AND parent_code = '".$branch_code."' AND mr.month='".$month."' AND mr.year='".$year."' order by level asc";
		$result = $this->db->query($sql);
		$offices= $result->result();
		return $offices;
		}
	function isSealedDate($date){
		$c = $this->m_global->select_data(TBLSEALS, array('date'=>$date), NULL, 1);
		if(count($c)>0){
			return TRUE;
			}
			else{
				return FALSE;
				}
	}
	function seals($uid,$date){
		$insert = $this->m_global->insert_data(TBLSEALS,array('user_id'=>$uid,'date'=>$date));
	}
	function updateSeals($uid,$date){
		$insert = $this->m_global->update_data(TBLSEALS,array('date'=>$date),array('user_id'=>$uid));
	}
	function getSignatureName($id){
		$name = $this->m_global->select_record(TBLSIGNATURES, array('id'=>$id),'name');
		return $name;
	}
	function countYearlyActualRevenues($year,$current_month){
		$sql = "SELECT SUM(amount) AS total FROM ".TBLACTUAL_REVENUES." WHERE year = '".$year."' AND month <= '".$current_month."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->total;
	}
	function countYearlyActualRevenues_Prev($year,$current_month){
		$sql = "SELECT SUM(amount) AS total FROM ".TBLACTUAL_REVENUES." WHERE year = '".$year."' AND month < '".$current_month."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->total;
	}
	function getExchangeRate($year){
		$sql = "SELECT exchange_rate AS amount FROM ".TBLYEARPLAN." WHERE year = '".$year."' ORDER BY id DESC LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		if(isset($result[0])){
			return $result[0]->amount;
		}else{
			return 4050;
			}
	}
	function getThisMonthAR($year,$month){
		$sql = "SELECT count(*) AS num FROM ".TBLACTUAL_REVENUES." WHERE year = '".$year."' AND month = '".$month."' LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->num;
	}
	function getYearPlan($year){
		$sql = "SELECT plan_riel as plan FROM ".TBLYEARPLAN." WHERE year = '".$year."' ORDER BY id DESC LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		if(isset($result[0])){
			return $result[0]->plan;
		}else{
			return 0;
			}
	}
	function getYearPlanUSD($year){
		$sql = "SELECT plan_usd as plan FROM ".TBLYEARPLAN." WHERE year = '".$year."' ORDER BY id DESC LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		if(isset($result[0])){
			return $result[0]->plan;
		}else{
			return 0;
			}
	}
	function getYearPlan_Per_Month($year){
		$sql = "SELECT per_month_riel as plan FROM ".TBLYEARPLAN." WHERE year = '".$year."' ORDER BY id DESC LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		if(isset($result[0])){
			return $result[0]->plan;
		}else{
			return 0;
			}
	}
	function countYearlyNetRevenues($year,$current_month){
		$sql = "SELECT SUM(net_amount) AS total FROM ".TBLACTUAL_REVENUES." WHERE year = '".$year."' AND month <= '".$current_month."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->total;
	}
	function countYearlyNetRevenues_Prev($year,$current_month){
		$sql = "SELECT SUM(net_amount) AS total FROM ".TBLACTUAL_REVENUES." WHERE year = '".$year."' AND month < '".$current_month."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->total;
	}
	function countPrevMonth($year,$current_month){
		$sql = "SELECT COUNT(month) AS total FROM ".TBLACTUAL_REVENUES." WHERE year = '".$year."' AND month < '".$current_month."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->total;
	}
	function getThisMonthNR($year,$month){
		$sql = "SELECT count(*) AS num FROM ".TBLACTUAL_REVENUES." WHERE year = '".$year."' AND month = '".$month."' LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->num;
	}
	function getPlanByOffice($branch_code,$office_code,$valid_from,$valid_to){
		$sql = "SELECT id, amount FROM ".TBLPLANNERS." WHERE branch_code ='".$branch_code."' AND office_code ='".$office_code."' AND valid_from ='".$valid_from."' ORDER BY valid_from DESC LIMIT 1";
		//echo($sql);
		$query = $this->db->query($sql);
		$result = $query->result();
		return ($result?$result[0]:(object)array('id'=>'0','amount'=>'0'));
	}
	function getLastMonthMRB($year){
		$sql = "SELECT MAX(month) AS month FROM ".TBLMONTHLYREVENUESB." WHERE year = '".$year."' LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		return ($result[0]->month!=null?$result[0]->month:'00');
	}
	function getLastMonthMR($year){
		$sql = "SELECT MAX(month) AS month FROM ".TBLMONTHLYREVENUES." WHERE year = '".$year."' LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		return ($result[0]->month!=null?$result[0]->month:'00');
	}
	function getLastMonthTMRB($year){
		$sql = "SELECT MAX(month) AS month FROM ".TBLTRACKINGMREVENUESB." WHERE year = '".$year."' LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		
		return ($result[0]->month!=null?$result[0]->month:'00');
	}
	function getOnlyBranch($only=null,$not=null){
		$sql="SELECT * FROM ".TBLOFFICES." WHERE status = 1 ";
			if($only!=null){
				$sql = $sql." AND code IN(".$only.")";
				$sql = $sql." ORDER BY FIELD(code,".$only.") ASC";
			}
			if($not!=null){
				$sql = $sql." AND code NOT IN(".$not.")";
			}
			
			$query=$this->db->query($sql);
			//var_dump($sql);
			return $query->result();
	}
	function getMRBOO($not_in,$year,$month){
		$sql= "SELECT sum(other_rev) as other_rev, sum(vat_gio) as vat_gio, sum(vat_ngoemb) as vat_ngoemb, sum(vat_other) as vat_other FROM (`".TBLMONTHLYREVENUESB."`) WHERE `year` = '".$year."' AND `month` IN (".$month.") AND branch_code NOT IN(".$not_in.")";
		$result = $this->db->query($sql);
		$sum= $result->result();
		//var_dump($sql);
		return $sum;
	}
	function getMROO($not_in,$year,$month){
		$sql= "SELECT sum(cd) as cd, sum(st) as st, sum(at) as at, sum(et) as et, sum(other) as other, sum(vop) as vop, sum(vpp_ea) as vpp_ea, sum(vpp_other) as vpp_other, sum(vop_io) as vop_io, sum(vap) as vap, sum(vat_other) as vat_other  FROM (`".TBLMONTHLYREVENUES."`) WHERE `year` = '".$year."' AND `month` IN (".$month.") AND branch_code NOT IN(".$not_in.")";
		$result = $this->db->query($sql);
		$sum= $result->result();
		//var_dump($sql);
		return $sum;
	}
	function getTMRBOO($not_in,$year,$month){
		$sql= "SELECT sum(ngo) as ngo, sum(emb) as emb, sum(gio) as gio, sum(oio) as oio, sum(exp) as exp, sum(aid) as aid, sum(ata) as ata, sum(p_min) as p_min, sum(other) as other FROM (`".TBLTRACKINGMREVENUESB."`) WHERE `year` = '".$year."' AND `month` IN (".$month.") AND branch_code NOT IN(".$not_in.")";
		$result = $this->db->query($sql);
		$sum= $result->result();
		//var_dump($sql);
		return $sum;
	}
	function getMonthly_MRB($month,$year){
		$sql= "SELECT SUM(other_rev+vat_gio+vat_ngoemb+vat_other) AS count_, SUM(`other_rev`) AS other_rev ,SUM(vat_gio+vat_ngoemb+vat_other) AS total_vat, SUM(`vat_gio`) as vat_gio, SUM(`vat_ngoemb`) vat_ngoemb, SUM(`vat_other`) vat_other FROM `".TBLMONTHLYREVENUESB."` WHERE month IN (".$month.") AND year = '".$year."'";
		$result = $this->db->query($sql);
		$sum= $result->result();
		//var_dump($sql);
		return $sum;
	}
	function getMonthly_MR($month,$year){
		$sql= "SELECT SUM(cd+st+at+et+other+vop+vpp_ea+vpp_other+vop_io+vap+vat_other) AS cnt, sum(cd) as cd, sum(st) as st, sum(at) as at, sum(et) as et, sum(other) as other, sum(vop) as vop, sum(vpp_ea) as vpp_ea, sum(vpp_other) as vpp_other, sum(vop_io) as vop_io, sum(vap) as vap, sum(vat_other) as vat_other  FROM `".TBLMONTHLYREVENUES."` WHERE month IN (".$month.") AND year = '".$year."'";
		$result = $this->db->query($sql);
		$sum= $result->result();
		//var_dump($sql);
		return $sum;
	}
	function getMonthly_TMRB($month,$year){
		$sql= "SELECT SUM(`ngo`) AS ngo, SUM(`emb`) AS emb, SUM(`gio`) AS gio, SUM(`oio`) AS oio, SUM(`exp`) AS exp, SUM(aid) AS aid, SUM(`ata`) AS ata, SUM(`p_min`) AS p_min, SUM(`other`) AS other, SUM(ngo+emb+gio+oio+exp+aid+ata+p_min+other) as cnt FROM `".TBLTRACKINGMREVENUESB."` WHERE month IN (".$month.") AND year = '".$year."'";
		$result = $this->db->query($sql);
		$sum= $result->result();
		//var_dump($sql);
		return $sum;
	}
	function select_TD_by_Branch($branch_code,$month,$year){
		$sql= "SELECT SUM(`forward_balance`) AS forward_balance, SUM(`rev_in_month`) AS rev_in_month, SUM(`rev_year_acc`) AS rev_year_acc, SUM(`trea_de_in_month`) AS trea_de_in_month, SUM(`trea_de_year_acc`) AS trea_de_year_acc, SUM(`authorized_expanse`) AS authorized_expanse, SUM(`balance`) AS balance FROM (`".TBLTREASURY_DEPOSIT."`) WHERE `branch_code` = '".$branch_code."' AND `year` = '".$year."' AND `month` IN (".$month.")
 GROUP BY branch_code";
		$result = $this->db->query($sql);
		$sum= $result->result();
		return $sum;
	}
	function getTDOO($not_in,$year,$month){
		$sql= "SELECT SUM(`forward_balance`) AS forward_balance, SUM(`rev_in_month`) AS rev_in_month, SUM(`rev_year_acc`) AS rev_year_acc, SUM(`trea_de_in_month`) AS trea_de_in_month, SUM(`trea_de_year_acc`) AS trea_de_year_acc, SUM(`authorized_expanse`) AS authorized_expanse, SUM(`balance`) AS balance  FROM (`".TBLTREASURY_DEPOSIT."`) WHERE `year` = '".$year."' AND `month` IN (".$month.") AND branch_code NOT IN(".$not_in.")";
		$result = $this->db->query($sql);
		$sum= $result->result();
		//var_dump($sql);
		return $sum;
	}
	function getTodayRevenues($date,$date_end){
		$sql = "SELECT * FROM ( SELECT * FROM tbl_revenues WHERE revenue_date IN('".$date."','".$date_end."') AND accumulative <> 0 ORDER BY revenue_date DESC) r GROUP BY office_code";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		}
	function getTodayRevenues_by_branch($date,$date_end,$branch_code){
		$sql = "SELECT * FROM ( SELECT * FROM tbl_revenues WHERE revenue_date IN('".$date."','".$date_end."') AND branch_code = '".$branch_code."' AND accumulative <> 0 ORDER BY revenue_date DESC) r GROUP BY office_code";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		}
	function getPrevRevenues($date_start,$date_end){
		$sql = "SELECT  * FROM (SELECT * FROM tbl_revenues WHERE revenue_date >= '".$date_start."' AND revenue_date < '".$date_end."' AND accumulative <> 0 ORDER BY revenue_date DESC) AS r GROUP BY office_code";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		}
	function getPrevRevenues_by_branch($date_start,$date_end,$branch_code){
		$sql = "SELECT  * FROM (SELECT * FROM tbl_revenues WHERE revenue_date >= '".$date_start."' AND revenue_date < '".$date_end."' AND branch_code ='".$branch_code."' AND accumulative <> 0 ORDER BY revenue_date DESC) AS r GROUP BY office_code";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		}
	function getAccumulative($date_start,$date_end){
		$sql = "SELECT SUM(accumulative) AS accumulative, SUM(reserved) AS reserved FROM (SELECT  accumulative,reserved FROM (SELECT * FROM tbl_revenues WHERE revenue_date >= '".$date_start."' AND revenue_date <= '".$date_end."' AND accumulative <> 0 ORDER BY revenue_date DESC) AS r GROUP BY office_code) AS RR";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		//var_dump($result);
		return $result[0]['accumulative'] - $result[0]['reserved'];
		}
	function getPlanners($date){
		list($year,$month,$day)=explode('-',$date);
		$valid_from_month = '';
		$valid_from = '';
		$quarter = 0;
		$quarter = (($month - 3)/3)+1;
		$quarter = ceil($quarter);
		$valid_from_month = ((intval($quarter) - 1) *3) + 1;
		$valid_from_month = (intval($valid_from_month)<=9?'0'.$valid_from_month:$valid_from_month);
		
		$valid_from = $year.'-'.$valid_from_month.'-01';
		$sql = "SELECT office_code, amount FROM ".TBLPLANNERS." WHERE valid_from = '".$valid_from."'";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		}
	function ARMissedMonths($year,$month){
		$sql = "SELECT month FROM ".TBLACTUAL_REVENUES." WHERE year = '".$year."' AND month < '".$month."' ORDER BY month ASC";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$months12 = array('01','02','03','04','05','06','07','08','09','10','11','12');
		$months = array_slice($months12,0,intval($month)-1);
		
		$listed = array();
		foreach($result as $r){
			$m = $r['month'];
			$listed[] = $m;
			}
		return(array_diff($months,$listed));
		}
	function isBranchRevenued($branch_code,$c_date){
		$sql = "SELECT  `id` FROM ".TBLREVENUES." WHERE branch_code='".$branch_code."' AND revenue_date='".$c_date."' LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		if(count($result)>0){
			return TRUE;
			}
			else{
				return FALSE;
				}
		}
	function insertRevenues($date,$rows,$USER_ID){	
		$data = array();
		$i = 0;
		foreach($rows as $r){
		  $data[$i] = array(
			  'branch_code'=>$r['branch_code'],
			  'office_code'=>$r['office_code'],
			  'accumulative'=>removeMask($r['accumulative']),
			  'vat_a_cd_m_acc'=>removeMask($r['vat_a_cd_m_acc']),
			  'motor_amount'=>removeMask($r['motor_amount']),
			  'motor_acc'=>removeMask($r['motor_acc']),
			  'car_amount'=>removeMask($r['car_amount']),
			  'car_acc'=>removeMask($r['car_acc']),
			  'phone_amount'=>removeMask($r['phone_amount']),
			  'phone_acc'=>removeMask($r['phone_acc']),
			  'revenue_date'=>$date,
			  'timestamp'=>time(),
			  'user_id'=>$USER_ID,
			  'token'=>GeraHash(10),
			  'status'=>1
		  );
		  $i++;
		  }
		  $this->db->insert_batch(TBLREVENUES, $data); 
	}
	function updateRevenues($date,$rows){
		foreach($rows as $r){
		  $data = array(
			  'accumulative'=>removeMask($r['accumulative']),
			  'vat_a_cd_m_acc'=>removeMask($r['vat_a_cd_m_acc']),
			  'motor_amount'=>removeMask($r['motor_amount']),
			  'motor_acc'=>removeMask($r['motor_acc']),
			  'car_amount'=>removeMask($r['car_amount']),
			  'car_acc'=>removeMask($r['car_acc']),
			  'phone_amount'=>removeMask($r['phone_amount']),
			  'phone_acc'=>removeMask($r['phone_acc']),
			  'timestamp'=>time()
		  	);
		  	
			$this->db->update(TBLREVENUES, $data, array('branch_code'=>$r['branch_code'],'office_code'=>$r['office_code'],'revenue_date'=>$date)); 
		  }
		}
	function getOfficeNamePrint($office_code){
		$sql = "SELECT name_print FROM ".TBLOFFICES." WHERE code='".$office_code."' LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->name_print;
		}
	function getMissedARs($year,$months){
		$acc = 0;
		$res = 0;
		foreach($months as $m){
			$last_of_month = date("t", strtotime($year."-".$m."-01"));
			$lastdate = $year."-".$m."-".$last_of_month;
			$firstdate = $year."-".$m."-01";
			$sql = "SELECT SUM(Acc) AS accumulative FROM (SELECT MAX(accumulative) AS acc FROM ".TBLREVENUES." WHERE revenue_date <= '".$lastdate."' AND revenue_date > '".$firstdate."' GROUP BY office_code) AS r";
			$query = $this->db->query($sql);
			$result = $query->result();
			$acc += $result[0]->accumulative;
			
			$sql = "SELECT res AS reserved FROM (SELECT reserved AS res,office_code FROM ".TBLREVENUES." WHERE revenue_date <= '".$lastdate."' AND revenue_date > '".$firstdate."' ORDER BY revenue_date DESC) AS r GROUP BY office_code";
			$query = $this->db->query($sql);
			$result = $query->result();
			foreach($result as $r){
				$res += $r->reserved;
				}
			//var_dump($result);
			}
		return $acc - $res;
		}
}
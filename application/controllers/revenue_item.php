<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Revenue_item extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		//$this->lang->load('site',userLang());
	}
	public function index()
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
			//$this->load->site('admin/index',$data);
			auto_direct(base_url('admin'));
		}else{
			//$today=date('Y-M-d',time());
			$isInserted=$this->m_global->is_exist2(TBLREVENUES,array('revenue_date'=>$date,'user_id'=>$USER_ID));
			//if($isInserted){
				$this->load->site('revenue_item',$data);
			//}else{
			//$this->load->site('index',$data);
			//}
		}
		
	}
	
	function addRevenue(){
		$USER=CI_USERCOOKIE();
		$USER_ID=$USER[cookieID];
		$branch=$this->input->post('branch_code');
		$date=$this->input->post('date');
		$qty=$this->input->post('qty');
		$tbs=$this->input->post('tbs');
		$amt=$this->input->post('tax');
		$item=$this->input->post('item');
		$isBur=$this->input->post('isBur')==true?1:0;
		$rev_id=$this->input->post('rev_id')!=''?$this->input->post('rev_id'):0;
		$filter=array('branch_code'=>$branch,'item_id'=>$item,'date'=>date('Y-m-d',strtotime($date)),'isBur'=>$isBur);
		$isExist=$this->m_global->is_exist2(TBLITEM_REVENUES,$filter);
		if($isExist){
			//echo $isExist;
			$data=array(
				'qty'=>$qty,
				'tax_bse'=>$tbs,
				'tax_amt'=>$amt,
				'token'=>GeraHash(10),
				'status'=>1
			);
			$update=$this->_addRevenue($isExist,$filter,$data);
			if($update!=false){
				echo 'success';
			}else{
				echo 'failed';
			}
		}else{
			//echo $isExist;
			$data=array(
				'user_id'=>$USER_ID,
				'branch_code'=>$branch,
				'item_id'=>$item,
				'qty'=>$qty,
				'tax_bse'=>$tbs,
				'tax_amt'=>$amt,
				'date'=>date('Y-m-d',strtotime($date)),
				'isBur'=>$isBur,
				'token'=>GeraHash(10),
				'status'=>1
			);
			$insert=$this->_addRevenue($isExist,$filter,$data);
			if($insert!=false){
				echo 'success';
			}else{
				echo 'failed';
			}
		}
		
		
		
	}
	function _addRevenue($isExist,$filter,$data){
		if($isExist){
			$this->m_global->update_data(TBLITEM_REVENUES,$filter,$data);
		}else{
			$this->m_global->insert_data(TBLITEM_REVENUES,$data);
		}
		return true;
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

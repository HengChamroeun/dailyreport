<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Monthly_revenues_front extends CI_Controller {
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
		
		$this->load->admin('monthly_revenues_front',$data);
			
	}
	function selectOffices(){
		$branch = $this->input->post('branch');
		$offices = $this->m_global->select_data(TBLOFFICES,array('parent_code'=>$branch,'status'=>'1'),array('level'=>'ASC'));
		//echo $this->db->last_query();
	?>
    	<option value="0">ជ្រើសរើស</option>
		<?php
		foreach ($offices as $key => $value) {
			?>
			<option value="<?php echo "$value->code"; ?>"><?php echo "$value->name_print"; ?></option>
			<?php
		}
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
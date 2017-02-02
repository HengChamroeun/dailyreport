<?php
function selectBox($rows,$value,$display,$default=NULL){
	$r ="";
if($default == NULL){
    $r = '<select class="form-control" id="select-item" name="select-item">' ;
}else{
    $r = '<select disabled class="form-control" id="select-item" name="select-item">' ;
}
$r= $r.'<option value="0">ជ្រើសរើសទំនិញ</option>';
    foreach($rows as $key => $val){
		if(($default != NULL) && ($default==$val->$value)){
			$r= $r.'<option selected value="'.$val->$value.'">'.$val->$display.'</option>';
			}
			else{
				$r= $r.'<option value="'.$val->$value.'">'.$val->$display.'</option>';
				}
		}
$r = $r.'</select>';
return $r;
	}
function selectExport($rows,$value,$display,$default=NULL){
	$r ="";

$r = '<select class="form-control" id="select-item" name="select-item">' ;
$r= $r.'<option value="0">ជ្រើសរើសទំនិញ</option>';
    foreach($rows as $key => $val){
		if(($default != NULL) && ($default==$val->$value)){
			$r= $r.'<option selected value="'.$val->$value.'">'.$val->$display.'</option>';
			}
			else{
				$r= $r.'<option value="'.$val->$value.'">'.$val->$display.'</option>';
				}
		}
$r = $r.'</select>';
return $r;
	}
function selectDate($s=0){
	
	?>
    <select id="select-date" name="select-date" class="form-control" style="width:120px; display:inline-block;" >
    	<option value="0" <?php echo($s=='0'?'selected':''); ?>>ជ្រើសរើសថ្ងៃ</option>
    	<option value="01" <?php echo($s=='01'?'selected':''); ?>>០១</option>
        <option value="02" <?php echo($s=='02'?'selected':''); ?>>០២</option>
        <option value="03" <?php echo($s=='03'?'selected':''); ?>>០៣</option>
        <option value="04" <?php echo($s=='04'?'selected':''); ?>>០៤</option>
        <option value="05" <?php echo($s=='05'?'selected':''); ?>>០៥</option>
        <option value="06" <?php echo($s=='06'?'selected':''); ?>>០៦</option>
        <option value="07" <?php echo($s=='07'?'selected':''); ?>>០៧</option>
        <option value="08" <?php echo($s=='08'?'selected':''); ?>>០៨</option>
        <option value="09" <?php echo($s=='09'?'selected':''); ?>>០៩</option>
        <option value="10" <?php echo($s=='10'?'selected':''); ?>>១០</option>
        <option value="11" <?php echo($s=='11'?'selected':''); ?>>១១</option>
        <option value="12" <?php echo($s=='12'?'selected':''); ?>>១២</option>
        <option value="13" <?php echo($s=='13'?'selected':''); ?>>១៣</option>
        <option value="14" <?php echo($s=='14'?'selected':''); ?>>១៤</option>
        <option value="15" <?php echo($s=='15'?'selected':''); ?>>១៥</option>
        <option value="16" <?php echo($s=='16'?'selected':''); ?>>១៦</option>
        <option value="17" <?php echo($s=='17'?'selected':''); ?>>១៧</option>
        <option value="18" <?php echo($s=='18'?'selected':''); ?>>១៨</option>
        <option value="19" <?php echo($s=='19'?'selected':''); ?>>១៩</option>
        <option value="20" <?php echo($s=='20'?'selected':''); ?>>២០</option>
        <option value="21" <?php echo($s=='21'?'selected':''); ?>>២១</option>
        <option value="22" <?php echo($s=='22'?'selected':''); ?>>២២</option>
        <option value="23" <?php echo($s=='23'?'selected':''); ?>>២៣</option>
        <option value="24" <?php echo($s=='24'?'selected':''); ?>>២៤</option>
        <option value="25" <?php echo($s=='25'?'selected':''); ?>>២៥</option>
        <option value="26" <?php echo($s=='26'?'selected':''); ?>>២៦</option>
        <option value="27" <?php echo($s=='27'?'selected':''); ?>>២៧</option>
        <option value="28" <?php echo($s=='28'?'selected':''); ?>>២៨</option>
        <option value="29" <?php echo($s=='29'?'selected':''); ?>>២៩</option>
        <option value="30" <?php echo($s=='30'?'selected':''); ?>>៣០</option>
        <option value="31" <?php echo($s=='31'?'selected':''); ?>>៣១</option>
    </select>
    <?php
	}
function selectMonth($s=0){
	
	?>
    <select id="select-month" name="select-month" class="form-control" style="width:120px; display:inline-block;">
    	<option value="0" <?php echo($s=='0'?'selected':''); ?>>ជ្រើសរើសខែ</option>
    	<option value="01" <?php echo($s=='01'?'selected':''); ?>>មករា</option>
        <option value="02" <?php echo($s=='02'?'selected':''); ?>>កុម្ភៈ</option>
        <option value="03" <?php echo($s=='03'?'selected':''); ?>>មីនា</option>
        <option value="04" <?php echo($s=='04'?'selected':''); ?>>មេសា</option>
        <option value="05" <?php echo($s=='05'?'selected':''); ?>>ឧសភា</option>
        <option value="06" <?php echo($s=='06'?'selected':''); ?>>មិថុនា</option>
        <option value="07" <?php echo($s=='07'?'selected':''); ?>>កក្កដា</option>
        <option value="08" <?php echo($s=='08'?'selected':''); ?>>សីហា</option>
        <option value="09" <?php echo($s=='09'?'selected':''); ?>>កញ្ញា</option>
        <option value="10" <?php echo($s=='10'?'selected':''); ?>>តុលា</option>
        <option value="11" <?php echo($s=='11'?'selected':''); ?>>វិច្ឆិកា</option>
        <option value="12" <?php echo($s=='12'?'selected':''); ?>>ធ្នូ</option>
    </select>
    <?php
	}
function selectYear($s){
	?>
    <select id="select-year" name="select-year" class="form-control" style="width:120px; display:inline-block;">
    	<option value="0" selected>ជ្រើសរើសឆ្នាំ</option>
    	<option value="2010" <?php echo($s=='2010'?'selected':''); ?>>២០១០</option>
        <option value="2011" <?php echo($s=='2011'?'selected':''); ?>>២០១១</option>
        <option value="2012" <?php echo($s=='2012'?'selected':''); ?>>២០១២</option>
        <option value="2013" <?php echo($s=='2013'?'selected':''); ?>>២០១៣</option>
        <option value="2014" <?php echo($s=='2014'?'selected':''); ?>>២០១៤</option>
        <option value="2015" <?php echo($s=='2015'?'selected':''); ?>>២០១៥</option>
        <option value="2016" <?php echo($s=='2016'?'selected':''); ?>>២០១៦</option>
        <option value="2017" <?php echo($s=='2017'?'selected':''); ?>>២០១៧</option>
        <option value="2018" <?php echo($s=='2018'?'selected':''); ?>>២០១៨</option>
        <option value="2019" <?php echo($s=='2019'?'selected':''); ?>>២០១៩</option>
        <option value="2020" <?php echo($s=='2020'?'selected':''); ?>>២០២០</option>
    </select>
    <?php
	}
function selectSignatures($rows,$default=NULL){
	?>
	<select id="select-signatures" name="select_signature">
		<?php
		foreach ($rows as $key => $value) {
			?>
			<option value="<?php echo "$value->id"; ?>" <?php echo ($default==$value->id?'selected':''); ?>><?php echo "$value->name"; ?></option>
			<?php
		}
		?>
	</select>
	<?php
}
function selectBranchs($rows,$default=NULL){
	?>
	<select id="select-branches" name="select_branches">
    	<option value="0">ជ្រើសរើស</option>
		<?php
		foreach ($rows as $key => $value) {
			?>
			<option value="<?php echo "$value->code"; ?>" <?php echo ($default==$value->code?'selected':''); ?>><?php echo "$value->name_print"; ?></option>
			<?php
		}
		?>
	</select>
	<?php
}
function selectQuarter($s=0){
	
	?>
    <select id="select-quarter" name="select-quarter" class="form-control" style="width:160px; display:inline-block;">
    	<option value="0" <?php echo($s=='0'?'selected':''); ?>>ជ្រើសរើសត្រីមាស</option>
    	<option value="1" <?php echo($s=='1'?'selected':''); ?>>ត្រីមាសទីមួយ</option>
        <option value="2" <?php echo($s=='2'?'selected':''); ?>>ត្រីមាសទីពីរ</option>
        <option value="3" <?php echo($s=='3'?'selected':''); ?>>ត្រីមាសទីបី</option>
        <option value="4" <?php echo($s=='4'?'selected':''); ?>>ត្រីមាសទីបួន</option>
    </select>
    <?php
	}
	function month_kh($num){
		$month=array(
			"00"=>"__",
			"01"=>"មករា",
			"02"=>"កុម្ភៈ",
			"03"=>"មីនា",
			"04"=>"មេសា",
			"05"=>"ឧសភា",
			"06"=>"មិថុនា",
			"07"=>"កក្កដា",
			"08"=>"សីហា",
			"09"=>"កញ្ញា",
			"10"=>"តុលា",
			"11"=>"វិច្ឆិកា",
			"12"=>"ធ្នូ",
		);
		return $month[$num];
	}
	function writeAdminLogs($username = '', $status = 'login', $ip){
		//try{
			
		$name = $username;
		//$ip = get_ip();
		//$ip = $this->input->ip_address();
		
		$date = date('j-m-Y, g:i:s a');
		$file = 'D:\\admin_logs.txt';
		$append = $name."\t".$ip."\t".$status."\t".$date."\r\n";
		file_put_contents($file,$append,FILE_APPEND);
		
		//}
		//catch(Exception $e){
			
			//}
		}
	function get_ip() {
		//Just get the headers if we can or else use the SERVER global
		if ( function_exists( 'apache_request_headers' ) ) {
			$headers = apache_request_headers();
		} else {
			$headers = $_SERVER;
		}
		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
			$the_ip = $headers['X-Forwarded-For'];
		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {
			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
		} else {
			
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		}
		return $the_ip;
	}
	function get_ip_(){
	 if( getenv('HTTP_X_FORWARDED_FOR') != '' ){
	  $client_ip =
	   ( !empty(getenv('REMOTE_ADDR')) ) ?
		getenv('REMOTE_ADDR')
	   :
				( ( !empty($_ENV['REMOTE_ADDR']) ) ?
		$_ENV['REMOTE_ADDR']
		:
		"unknown" );
	 
	  $entries = split('[, ]', getenv('HTTP_X_FORWARDED_FOR'));
	 
	  reset($entries);
	  while (list(, $entry) = each($entries)){
	   $entry = trim($entry);
	   if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) ){
		// http://www.faqs.org/rfcs/rfc1918.html
		$private_ip = array(
		 '/^0\./',
		 '/^127\.0\.0\.1/',
		 '/^192\.168\..*/',
		 '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
		 '/^10\..*/');
	 
		$found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
	 
		if ($client_ip != $found_ip){
		 $client_ip = $found_ip;
		 break;
		}
	   }
	  }
	 } else {
	  $client_ip =
	   ( !empty(getenv('REMOTE_ADDR')) ) ?
		getenv('REMOTE_ADDR')
	   :
		( ( !empty($_ENV['REMOTE_ADDR']) ) ?
		$_ENV['REMOTE_ADDR']
		:
		"unknown" );
	 }
	 return $client_ip;
	}
		
?>
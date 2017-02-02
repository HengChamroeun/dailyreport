<?php
/*-------------------------------------------------*/
	/*       SOME CONSTANT STRINGS                    */
	/*-------------------------------------------------*/
	define("APPNAME","Customs Permit");
	define("DIR_ROOT","customspermit");
	define("USERCOOKIE","logUserInfo");
	define("cookieID","id");
	define("cookieUSER","username");
	define("cookiePASS","password");
	define("cookieROLE","role");
	define("cookieEMAIL","email");
	define("cookieREM","remember");
	define("KEYSALT","K34$@1T");
	define("REPORTER","អ៊ុន ហេម៉ាលីន");
	define("IMPORTATION_OFFICE","IMPORTATION-OFFICE");
	define("IMPORTATION_GOODS","IMPORTATION-GOODS");
	define("IMPORTATION_MASTERLIST","IMPORTATION-MASTERLIST");
	define("IMPORTATION_COMPANIES","IMPORTATION-COMPANIES");
	define("ADMIN",1);//99
	define("ADMINTECH",99);//99
	define("ADMINDEPT",98);
	define("DEPT_Lower",97);
	define("OFFICER",1);//96
	define("CDC",95);
	define("COMOWNER",2);
	define("BROKER",2);//1
	define('CUREMASU','u$T0Q162rHW!rB4bco8uX$GUI9AoG0LimOlNt'); 
	define('CUREMASP','OFaV5Rw@P#C7#%bDWaLmCUZgQ6$mICT#PSg$8OiSRrtrpwK35xH!n^0ZtYMzmpfr^wf*S@gvd'); 
	define('CUREMASD','jol70_dbcuremas'); 
	define('MAC','9ed5ea01a6df3dac6aa22aac97db9c3c67ef1992'); 
	
	// define('CUREMASU','0000003000000'); 
	// define('CUREMASP','0000003000000'); 
	// define('CUREMASD','000'); 
	// define('MAC','00'); 
	
	

	function KEYSALT($KEY){
		return sha1(KEYSALT.$KEY);
	}
	function securepassword($password,$salt){
		return sha1($salt.$password);
	}
	function secureusername($username,$salt){
		return sha1($salt.$username);
	}
	function GenerateSalt(){
		return GeraHash(4);
	}
	function GeraHash($qtd){ 
	//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
	$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZabcdefghijklmopqrstuvxwyz0123456789'; 
	$QuantidadeCaracteres = strlen($Caracteres); 
	$QuantidadeCaracteres--; 

	$Hash=NULL; 
		for($x=1;$x<=$qtd;$x++){ 
			$Posicao = rand(0,$QuantidadeCaracteres); 
			$Hash .= substr($Caracteres,$Posicao,1); 
		} 

	return $Hash; 
	}
function set_session($name,$data){
	if($name){
	session_start();
	$_SESSION[$name]=$data;
		return true;
	}else{
		return false;
	}
	
}

function is_session($name,$att=true){
	if ($att==true) {
		session_start();
	}
	if(isset($_SESSION[$name])){
		return $_SESSION[$name];
	}else{
		return false;
	}
}
function get_session($name){
 return is_session($name);
}

function kill_session($name,$att=true){
	if ($att==true) {
		session_start();
	}
	unset($_SESSION[$name]);
	session_destroy();
}

function CI_setCookie($name,$value,$remember=false){
	$expire=time()+3600;
	$domain=$_SERVER['SERVER_NAME'];
	if($remember==true){
		$expire=time()+60*60*24*30;
	}
	setcookie($name.'_'.cookieUSER, $value[cookieUSER], $expire, "/", $domain);
	setcookie($name.'_'.cookiePASS, $value[cookiePASS], $expire, "/", $domain);
}

function CI_getCookie($name){
	if(isset($_COOKIE[$name.'_'.cookieUSER])){
		$data=array(cookieUSER=>$_COOKIE[$name.'_'.cookieUSER],cookiePASS=>$_COOKIE[$name.'_'.cookiePASS]);
		return $data;
	}else{
		return false;
	}
}
function CI_removeCookie($name){
	$expire=time()-3600;
	$value="";
	$domain=$_SERVER['SERVER_NAME'];
	setcookie($name.'_'.cookieUSER, $value, $expire, "/", $domain);
	setcookie($name.'_'.cookiePASS, $value, $expire, "/", $domain);
	return true;
}

function CI_USERCOOKIE($value="",$remember=false,$removed=false){
	if($value==""){
		if(isset($_COOKIE[KEYSALT(cookieUSER)])){
			if($removed!=true){
				if(!isset($_COOKIE[KEYSALT(cookiePASS)]) OR !isset($_COOKIE[KEYSALT(cookieID)]) OR !isset($_COOKIE[KEYSALT(cookieUSER)]) OR !isset($_COOKIE[KEYSALT(cookieROLE)]) OR !isset($_COOKIE[KEYSALT(cookieREM)])){
					return false;
				}else{
				$data=array(cookieID=>$_COOKIE[KEYSALT(cookieID)],cookieUSER=>$_COOKIE[KEYSALT(cookieUSER)],cookiePASS=>$_COOKIE[KEYSALT(cookiePASS)],cookieROLE=>$_COOKIE[KEYSALT(cookieROLE)],cookieREM=>$_COOKIE[KEYSALT(cookieREM)]);
				return $data;
				}
			}else{
				$expire=time()-3600;
				$domain=$_SERVER['SERVER_NAME'];
				setcookie(KEYSALT(cookieID), "", $expire, "/", $domain);
				setcookie(KEYSALT(cookieUSER), "", $expire, "/", $domain);
				setcookie(KEYSALT(cookiePASS), "", $expire, "/", $domain);
				setcookie(KEYSALT(cookieROLE), "", $expire, "/", $domain);
				setcookie(KEYSALT(cookieREM), "", $expire, "/", $domain);
				return true;
			}
		}else{
			return false;
		}
	}else{
		$rem=36000*2;
		$domain=$_SERVER['SERVER_NAME'];
		if($remember==true){
			$rem=60*60*24*30;
		}
		$expire=time()+$rem;
		setcookie(KEYSALT(cookieID), $value[cookieID], $expire, "/", $domain);
		setcookie(KEYSALT(cookieUSER), $value[cookieUSER], $expire, "/", $domain);
		setcookie(KEYSALT(cookiePASS), $value[cookiePASS], $expire, "/", $domain);
		setcookie(KEYSALT(cookieROLE), $value[cookieROLE], $expire, "/", $domain);
		setcookie(KEYSALT(cookieREM), $rem, $expire, "/", $domain);
		return true;
	}
}
function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";	
		$str="";
		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		
		return $str;
	}
function rand_num($numlen){
    $num="3456789";
    $num_str="";
    $size=strlen($num);
    for( $i = 0; $i < $numlen; $i++ ) {
			$num_str .= $num[ rand( 0, $size - 1 ) ];
		}
    return $num_str;
}

function db_rander($p){
	$hs=strlen($p)/2;
	$param=substr($p, -((strlen($p)+1)/2), 1);
	$ps=substr($p, 0,$hs).substr($p, -((strlen($p))/2),$hs);
	$len=strlen($ps);
	$a=str_split($ps);
	$spam_rander="";
	for($i=$param;$i<=$len;$i+=$param+1){
		$spam_rander.=$a[$i];
	}
	
	return $spam_rander;
}

function salter($s){
	$s_split=str_split($s);
	$param=rand_num(1);
	$s_1="";
	foreach($s_split as $char){
    $para=rand_string($param);
    $s_1.=$para.$char;
	}
	$halfStr=strlen($s_1)/2;
	$s_1=substr($s_1, 0,$halfStr).$param.substr($s_1, -((strlen($s_1))/2),$halfStr);
	
	return $s_1;
}

function m(){
	return db_rander(CUREMASP);
}
function m2(){
	return db_rander(CUREMASU);
}
define('DBPass',m());
define('DBUser',m2());

function LocaleMac(){
	ob_start(); 
	system('ipconfig /all');
	$mycom=ob_get_contents();
	ob_clean();

	$findme = "Physical";
	$pmac = strpos($mycom, $findme);
	$mac=substr($mycom,($pmac+36),17);
	return $mac;
}

define('LOCALEMAC',sha1(LocaleMac()));

function isHtml2(){
	if(LOCALEMAC!=MAC){
		return false;
	}else{
		return true;
	}
}
function isHtml(){
	return true;
}

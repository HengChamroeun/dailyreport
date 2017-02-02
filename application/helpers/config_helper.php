<?php

	define('TBLUSERS','tbl_users');
	define('TBLBRANCHES','tbl_branches');
	define('TBLOFFICES','tbl_offices');
	define('TBLREVENUES','tbl_revenues');
	define('TBLPLANNERS','tbl_planners');
	define('TBLITEMS','tbl_items');
	define('TBLUNITS','tbl_units');
	define('TBLITEM_REVENUES','tbl_item_revenues');
	define('TBLHISTORIES','tbl_histories');
	define('TBLCLOSEREVENUES','tbl_close_revenues');
	define('TBLMONTHLYREVENUES','tbl_monthly_revenues');
	define('TBLMONTHLYREVENUESB','tbl_monthly_revenues_b');
	define('TBLTRACKINGMREVENUESB','tbl_tracking_mrevenues_b');
	define('TBLSIGNATURES','tbl_signatures');
	define('TBLSEALS','tbl_seals');
	define('TBLITEMSEXPORT','tbl_items_export');
	define('TBLITEMSEXPORT_REVENUES','tbl_item_export_revenues');
	define('TBLACTUAL_REVENUES','tbl_actual_revenues');
	define('TBLYEARPLAN','tbl_yearplan');
	define('TBLTREASURY_DEPOSIT','tbl_treasury_deposit');
	
	define('INPUT_PREFIX','dxInputList_');
	
	function valid_lang($lang){
		$languages=array(
			'english',
			'khmer',
		);
		
		if(in_array($lang,$languages)){
			return true;
		}else{
			return false;
		}
	
	}
	function userLang(){
	
		if(isset($_GET['lang']) and valid_lang($_GET['lang'])){
			return $_GET['lang'];
		}elseif(isset($_COOKIE["language"]) and valid_lang($_COOKIE["language"])){
			return $_COOKIE["language"];
		}else{
			return 'english';
		}
	}

function auto_direct($path,$refresh=''){
	$data='<script type="text/javascript">
	window.location = "'.$path.'"
	</script>';
	echo $data;
}
function theme($url=NULL){
	$theme=base_url('assets/theme');
	if($url!=NULL){
		$theme=$theme.'/'.$url;
	}
	return $theme;
}
function plugin($url=NULL){
	$boot=theme('plugins');
	if($url!=NULL){
		$boot=$boot.'/'.$url;
	}
	return $boot;
}
function css($url=NULL){
	$css=theme('css');
	if($url!=NULL){
		$css=$css.'/'.$url;
	}
	return $css;
}
function theme_img($url=NULL){
	$img=theme('img');
	if($url!=NULL){
		$img=$img.'/'.$url;
	}
	return $img;
}
function js($url=NULL){
	$js=theme('js');
	if($url!=NULL){
		$js=$js.'/'.$url;
	}
	return $js;
}
function asset_dir($url=NULL){
	$asset=base_url('assets');
	if($url!=NULL){
		$asset=base_url('assets/'.$url);
	}
	return $asset;
}
function romanNumerals($num) 
{
    $n = intval($num);
    $res = '';
 
    /*** roman_numerals array  ***/
    $roman_numerals = array(
                'M'  => 1000,
                'CM' => 900,
                'D'  => 500,
                'CD' => 400,
                'C'  => 100,
                'XC' => 90,
                'L'  => 50,
                'XL' => 40,
                'X'  => 10,
                'IX' => 9,
                'V'  => 5,
                'IV' => 4,
                'I'  => 1);
 
    foreach ($roman_numerals as $roman => $number) 
    {
        /*** divide to get  matches ***/
        $matches = intval($n / $number);
 
        /*** assign the roman char * $matches ***/
        $res .= str_repeat($roman, $matches);
 
        /*** substract from the number ***/
        $n = $n % $number;
    }
 
    /*** return the res ***/
    return $res;
    }
	
function showDateKH($date){
	list($year,$mon,$day)=explode('-',$date);
	$khDay=numberKH($day);
	$khMonth=monthKH($mon);
	$khYear=numberKH($year);
	return $khDay.' '.$khMonth.' '.$khYear;
}
function showDateKH_($date){
	list($year,$mon,$day)=explode('-',$date);
	$khDay=numberKH($day);
	$khMonth=monthKH($mon);
	$khYear=numberKH($year);
	return $khDay.' '.$khMonth.' ឆ្នាំ'.$khYear;
}
function monthKH($num,$text=false){
	$month=array(
		1=>"ខែមករា",
		2=>"ខែកុម្ភៈ",
		3=>"ខែមីនា",
		4=>"ខែមេសា",
		5=>"ខែឧសភា",
		6=>"ខែមិថុនា",
		7=>"ខែកក្កដា",
		8=>"ខែសីហា",
		9=>"ខែកញ្ញា",
		10=>"ខែតុលា",
		11=>"ខែវិច្ឆិកា",
		12=>"ខែធ្នូ",
	);
	
	$monthName=array(
		'jan'=>"ខែមករា",
		'feb'=>"ខែកុម្ភៈ",
		'mar'=>"ខែមីនា",
		'apr'=>"ខែមេសា",
		'may'=>"ខែឧសភា",
		'jun'=>"ខែមិថុនា",
		'jul'=>"ខែកក្កដា",
		'aug'=>"ខែសីហា",
		'sep'=>"ខែកញ្ញា",
		'oct'=>"ខែតុលា",
		'nov'=>"ខែវិច្ឆិកា",
		'dec'=>"ខែធ្នូ",
	);
	if($text==true){
		$num=strtolower($num);
		return $monthName[$num];
	}else{
			return $month[intval($num)];

	}
}


function numberKH($num){
	$number=array(
		0=>"០",
		1=>"១",
		2=>"២",
		3=>"៣",
		4=>"៤",
		5=>"៥",
		6=>"៦",
		7=>"៧",
		8=>"៨",
		9=>"៩",
		'/'=>"/"
	);
	$num=str_split($num);
	$result='';
	foreach($num as $n){
		$result.=$number[$n];
	}
	return $result;
}
function alphabetRank($num,$mode='capital'){
	$alpha=array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',19=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z');
	//$alpha1=array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f',7=>'g',8=>'h',19=>'i',10=>'j',11=>'k',12=>'l',13=>'m',14=>'n',15=>'o',16=>'p',17=>'q',18=>'r',19=>'s',20=>'t',21=>'u',22=>'v',23=>'w',24=>'x',25=>'y',26=>'z');
	return $alpha[$num];
	}
function filterGoods($gd){
	if(strpos($gd, " | ")){
	list($good,$unit)=explode(" | ",$gd);
	return $good;
	}else{
		return $gd;
	}
}
function easy_number_format($num,$dec=0,$dec_point='.',$thousand_sep=','){
		//if($num!=0){
			return number_format($num,$dec,$dec_point,$thousand_sep);
		//}else{
			//return '-';
		//}
	}
function num_format($num){
		$pos = strrpos($num, ".");
		if($pos===FALSE){
			return number_format($num);
		}else{
			return number_format($num,2);
		}
	}
function removeMask($str){
	return str_replace(",","",$str);
}


	


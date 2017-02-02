<center>
<?php
	if(!isset($OFFICE)){$OFFICE='';}
	if(!isset($MONTH)){$MONTH='';}
	$cond = $this->input->get('cond');
	$DATE_START = $DATE;
	$DATE_END = $DATE;
	$DATE_01 =$DATE;
 ?>
<?php 
		$day_name=strtolower(date('D',strtotime($DATE)));
		$day_plus='';
		list($y,$m,$d)=explode('-',$DATE);
		if($day_name=='mon'){
			
			if($d!='01'){
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
					}
				$day_plus=numberKH($d).'+';
				$DATE_START = $y.'-'.$m.'-'.$d;
				}
			
			} 
			$DATE_01 = $y.'-'.$m.'-01';
		


$arr_office = array();
$arr_office_accum = array();
//var_dump($DATE_START);
//var_dump($DATE_END);
$param = array('start'=>$DATE_START,'end'=>$DATE_END,'method'=>'revenueTotalByOfficeByDay');
$param_accum = array('start'=>$DATE_01,'end'=>$DATE_END,'method'=>'revenueTotalByOfficeByDay');

$c = curl_init();
curl_setopt($c,CURLOPT_URL,'http://10.0.9.13:8181/awlaravel/public/awrevenue/api/revenue');
curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
curl_setopt($c,CURLOPT_POST,true);
curl_setopt($c,CURLOPT_POSTFIELDS,$param);
$output = curl_exec($c);
curl_close($c);

$c_accum = curl_init();
curl_setopt($c_accum,CURLOPT_URL,'http://10.0.9.13:8181/awlaravel/public/awrevenue/api/revenue');
curl_setopt($c_accum,CURLOPT_RETURNTRANSFER,true);
curl_setopt($c_accum,CURLOPT_POST,true);
curl_setopt($c_accum,CURLOPT_POSTFIELDS,$param_accum);
$output_accum = curl_exec($c_accum);
curl_close($c_accum);

if($output){
	$arr = json_decode($output,true);
	foreach($arr as $ar){
		$arr_office[$ar['office_code']] = $ar['tax_amount'];
	}
}
if($output_accum){
	$arr_accum = json_decode($output_accum,true);
	foreach($arr_accum as $ar_accum){
		$arr_office_accum[$ar_accum['office_code']] = $ar_accum['tax_amount'];
	}
}
//var_dump($arr_office['SHV11']);
?>
<div id="table_preview">
<input type="hidden" id="cond" name="cond" value="<?php echo $this->input->get('cond'); ?>" />
<form action="<?php echo base_url('admin/exporter'); ?>" method="post"><!--onsubmit='$("#datatodisplay").val( $("<div>").append( $("#ReportTable").eq(0).clone() ).html() )'>-->
<?php
$print=$this->input->get('print');
$tbl_print='print';
 if($print!="true"){ ?>
<div class="action_menu" style=" padding-top:9px;position:fixed;top:0px;width:1000px;text-align:left;padding-left:40px;height:40px;background:#FFF;margin-top:0px auto;margin-bottom:70px;border-bottom:1px solid #ccc;">
<input type="hidden" id="datatodisplay" name="datatodisplay">  
<input type="hidden" name="excel_in_excel" value="Report_on_">  
<a class="btn btn-warning" href="<?php echo base_url('admin/report') ?>" id="print_btn"><i class="icon-backward icon-white"></i>Back</a> 
<a class="btn btn-success" href="#" id="print_btn" onClick="return PrintReport();"><i class="icon-print icon-white"></i>Print Report</a> 
<a href="#" class="btn btn-primary" id="btnExport"><i class="icon-download icon-white"></i> Export as Excel</a> 
 
</div>
<?php $tbl_print='';}else{ ?>
	<script>
		setTimeout(function(){window.print()}, 1000);
	</script>
<?php } ?>
<table class="tbl <?php echo $tbl_print; ?>" id="ReportTable">
<tr class="row_blank"><td colspan="8" class="bold_title top_title color_white"><center>ព្រះរាជាណាចក្រកម្ពុជា</center></td></tr>
<tr class="row_blank"><td colspan='8'><center></center></td></tr>
<tr class="row_blank"><td colspan="8" class="bold_title md_title color_white"><center>ជាតិ សាសនា ព្រះមហាក្សត្រ</center></td></tr>
<tr class="row_blank"><td colspan="2" class="bold_title md_title head_data" style='position:relative'><img id='print_logo' style='max-height:100px;top:-40px;margin-left:50px;position:absolute' src="<?php echo base_url('assets/files/customs_logo.jpg') ?>"/></td><td colspan='4'></td></tr>
<tr class="row_blank"><td colspan='8' style="padding:30px;"><center></center></td></tr>
<tr class="row_blank"><td colspan='8'><center></center></td></tr>
<tr class="row_blank"><td colspan="2" class="bold_title md_title color_white">អគ្គនាយកដ្ឋានគយនិងរដ្ឋាករកម្ពុជា</td><td colspan='4'></td></tr>

<tr class="row_blank row_report_title md_title color_white"><td colspan="8"><center>លទ្ធផលបណ្តោះអាសន្នចំណូលពន្ធ និងអាករគយ<center></td></tr>
<tr class="row_blank row_report_title md_title color_white"><td colspan="8"><center> ប្រចាំ<?php if($DAY!=''){echo 'ថ្ងៃទី'.$day_plus.numberKH($DAY);} ?> <?php if($MONTH!=''){echo monthKH($MONTH);}?>  ឆ្នាំ <?php echo numberKH($YEAR); if(isset($MONTH2)){echo ' ដល់ '.monthKH($MONTH2).' ឆ្នាំ'.numberKH($YEAR2);} ?></center></td></tr>
<tr class="row_blank"><td colspan='8' style="height:18px"><center></center></td></tr>
<tr class="bold_title">
<td class="color_white"><center>លរ</center></td>
<td style="width:220px"class="color_white"><center>អង្គភាពគយ និងរដ្ឋាករ</center></td>
<td class="color_white"><center>ចំណូលក្នុងប្រព័ន្ធ<br/>ASYCUDA</center></td>
<td class="color_white"><center>ចំណូលក្នុងប្រព័ន្ធ<br/>ASYCUDA បូកបន្ត</center></td>
<td class="color_white"><center>ចំណូលពន្ធ <br/>ប្រចាំថ្ងៃទី<?php echo $day_plus.numberKH($DAY); ?></center></td>
<td class="color_white"><center>ចំណូលពន្ធ<?php //echo monthKH($MONTH).' ឆ្នាំ'.numberKH($YEAR); ?><br/> គិតត្រឹមថ្ងៃទី<?php echo numberKH($DAY); ?></center></td>
<td class="color_white"><center>%</center></td>
<td class="color_white"><center>ផែនការ<br/>សំរាប់ខែ</center></td>
</tr>
<?php
	$branches=$this->m_global->select_data(TBLOFFICES, array('parent_code'=>'CHQ00','status'=>'1'), array('level'=>'ASC'));
	$i=1;
	$totalTotay=0;
	$totalAccum=0;
	$totalplan=0;
	$arrayBranch=array();
	foreach($branches as $b){
		//$plan=$this->m_global->select_record(TBLPLANNERS,array('branch_code'=>'CHQ00','office_code'=>$b->code, 'valid_from <= '=>$DATE,'valid_to'=>null),'amount');
		$plan=$this->m_global->select_record(TBLPLANNERS,array('branch_code'=>'CHQ00','office_code'=>$b->code, 'valid_from <= '=>$DATE),'amount',array('valid_from'=>'DESC'));
		$plan=floatval($plan)/3;
		$totalplan+=$plan;
		$AccummulativeRevenue=$this->m_customs->getAccByBranch($b->code,$DATE);
		//$TodayAdjustment=$this->m_customs->getAdjustByBranch($b->code,$DATE);
		$TodayAdjustment=$this->m_revenues->ReservedByOffice($b->code,$DATE);
		$AccAdjustment=$this->m_customs->getAdjustByBranch($b->code,$DATE,true);
		$previousAdjustment = $this->m_revenues->getPrevResByBranch($b->code,$DATE);
		//$todayRevenue=floatval($AccummulativeRevenue)-floatval($this->m_revenues->getPrevAccByBranch($b->code,$DATE))-floatval($TodayAdjustment);
		$prevAccByBranch = floatval($this->m_revenues->getPrevAccByBranch($b->code,$DATE));
		//Modify by Sotharith
		$todayRevenue=(floatval($AccummulativeRevenue)-floatval($TodayAdjustment))-(floatval($this->m_revenues->getPrevAccByBranch($b->code,$DATE))-floatval($previousAdjustment));
		$AccummulativeRevenue = $AccummulativeRevenue-$TodayAdjustment;
		//END
		//$//
		if($todayRevenue>=0){
			$totalTotay+=$todayRevenue;
		}
		if($AccummulativeRevenue >=0){
			$totalAccum+=$AccummulativeRevenue;
		}
		//$tmp=array();
		//$tmp[]=$b->code;
		array_push($arrayBranch,$b->code);
		
		$offs=$this->m_global->select_data(TBLOFFICES,array('parent_code'=>$b->code,'status'=>1), array('level'=>'ASC'));
		
		$count_acuda_revenues = 0;
		$count_acuda_revenues_accum = 0;
		
		foreach($offs as $o){
			$count_acuda_revenues = $count_acuda_revenues + ($arr_office[$o->code]?$arr_office[$o->code]:0);
			$count_acuda_revenues_accum = $count_acuda_revenues_accum + ($arr_office_accum[$o->code]?$arr_office_accum[$o->code]:0);
			}
		if(isset($arr_office[$b->code])){
			$count_acuda_revenues = $arr_office[$b->code];
			}
		if(isset($arr_office_accum[$b->code])){
			$count_acuda_revenues_accum = $arr_office_accum[$b->code];
			}
	?>
		<tr class='row_boldKH'>
			<td class="color_white"><center><?php echo $i; ?></center></td>
			<td class="color_white td-name"><?php echo $b->name_print; if($this->m_global->select_data(TBLOFFICES,array('parent_code'=>$b->code,'status'=>1))){}else{if($TodayAdjustment>0){ echo " (+".easy_number_format($TodayAdjustment/1000000).")";}} ?></td>
			<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo ($count_acuda_revenues>0?easy_number_format($count_acuda_revenues,0)." ៛":""); ?></td>
            <td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo ($count_acuda_revenues_accum>0?easy_number_format($count_acuda_revenues_accum,0)." ៛":""); ?></td>
            <td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php
			if($todayRevenue < 0){
				echo easy_number_format(0, 0);
			}else{
				echo easy_number_format($todayRevenue,0); 
			}
			
			?> ៛</td>
			<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php 
			if($AccummulativeRevenue == 0){
				echo easy_number_format($prevAccByBranch, 0);
				$totalAccum+=$prevAccByBranch;
			}else{
				echo easy_number_format($AccummulativeRevenue,0); 
			}
			?> ៛</td> 
			<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php 
			if($plan){
				if($AccummulativeRevenue == 0){
					echo easy_number_format($prevAccByBranch*100/($plan*1000000), 2); 
					//$totalAccum+=$prevAccByBranch;
				}else{
					echo easy_number_format($AccummulativeRevenue*100/($plan*1000000), 2); 
				}
				
			} ?>%</td>
			<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php if($plan){echo easy_number_format($plan,0); } ?></td>
		</tr>
	<?php
		//if($b->is_office_view==1){
			//$offs=$this->m_global->select_data(TBLOFFICES,array('parent_code'=>$b->code,'status'=>1), array('level'=>'ASC'));
			foreach($offs as $off){
				//$plan_off=$this->m_global->select_record(TBLPLANNERS,array('branch_code'=>$b->code,'office_code'=>$off->code, 'valid_from <= '=>$DATE,'valid_to'=>null),'amount');
				$plan_off=$this->m_global->select_record(TBLPLANNERS,array('branch_code'=>$b->code,'office_code'=>$off->code, 'valid_from <= '=>$DATE),'amount',array('valid_from'=>'DESC'));
				$plan_off=floatval($plan_off)/3;
				//$acc=floatval($this->m_global->select_record(TBLREVENUES,array('office_code'=>$off->code,'revenue_date'=>$DATE),'accumulative'));
				//$acc = floatval($this->m_customs->accByOffice($off->code,$DATE));
				$acc = floatval($this->m_revenues->RevenueByOffice($off->code,$DATE));
				$prevOff=floatval($this->m_revenues->getPrevAccByOffice($off->code,$DATE));
				$reserved=floatval($this->m_global->select_record(TBLREVENUES,array('office_code'=>$off->code,'revenue_date'=>$DATE),'reserved'));
				//$reserved = floatval($this->m_revenues->getPrevResByOffice($off->code,$DATE));
				//$reserved = floatval($this->m_revenues->ReservedByOffice($b->code,$DATE));
				//Modify by Sotharith
				$preReserved = floatval($this->m_revenues->getPrevResByOffice($off->code,$DATE));
				
				///END
				//$revenue=$acc-$prevOff-$reserved;
				$revenue=($acc-$reserved)-($prevOff-$preReserved);
				//Modify by Sotharith
				$acc = $acc-$reserved;
			?>
			<tr >
				<td></td>
				<td class="color_white td-name"> - <?php echo $off->name_print; if($reserved>0){ echo " (+".easy_number_format($reserved/1000000).")";} ?></td>
				<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo (isset($arr_office[$off->code])?easy_number_format($arr_office[$off->code],0)." ៛":""); ?></td>
                <td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo (isset($arr_office_accum[$off->code])?easy_number_format($arr_office_accum[$off->code],0)." ៛":""); ?></td>
                <td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php 
				if($revenue < 0){
					echo easy_number_format(0, 0);
				}else{
					echo easy_number_format($revenue,0); 
				}
				
				?> ៛</td>
				<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php 
				if($acc == 0){
					echo easy_number_format($prevOff, 0);
				}else{
					echo easy_number_format($acc,0); 
				}
				?> ៛</td> 
				<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php 
				if($plan_off){
					if($acc == 0){
						echo easy_number_format($prevOff*100/($plan_off*1000000), 2); 
					}else{
						echo easy_number_format($acc*100/($plan_off*1000000), 2); 
					}
				} 
				?>%</td>
				<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php if($plan_off){echo easy_number_format($plan_off,0); } ?></td>
			</tr>
			
			<?php
			}
		//}
		$i++;
	}
 ?>
<tr class='row_boldKH'>
	<td colspan=2 class="color_white"><center>សរុបចំណូលពន្ធ និងអាករគយ</center></td>
	<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo (array_sum($arr_office)<=0)?"":easy_number_format(array_sum($arr_office),0)." ៛"; ?></td>
    <td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo (array_sum($arr_office_accum)<=0)?"":easy_number_format(array_sum($arr_office_accum),0)." ៛"; ?></td>
    <td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php 
	if($totalTotay < 0){
		echo easy_number_format(0, 0);
	}else{
		echo easy_number_format($totalTotay,0); 
	}
	?> ៛</td>
	<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo easy_number_format($totalAccum,0); ?> ៛</td>
	<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo easy_number_format($totalAccum*100/($totalplan*1000000),2); ?> %</td>
	<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo easy_number_format($totalplan,0); ?></td>

</tr>

<tr class="row_blank"><td colspan='5'><center></center></td><td colspan=3 class="color_white td-publisher"><center>រាជធានីភ្នំពេញ,ថ្ងៃទី  <?php echo numberKH($DAY).'  '.monthKH($MONTH);?>               ឆ្នាំ<?php echo numberKH($YEAR);?></center></td></tr>
<tr class="row_blank bold_title"><td colspan='5'><center></center></td><td colspan=3 class="color_white"><center>អ្នកធ្វើតារាង</center></td></tr>
<tr class="row_blank bold_title"><td colspan='5'><center></center></td><td colspan=3 class="color_white"><center></center></td></tr>


<tr class="row_blank"><td colspan=6 style="padding:30px;"><center></center></td></tr>
<tr class="row_blank"><td colspan=6><center></center></td></tr>
<?php 
list($y2,$m2,$d2)=explode('-',$DATE);

$last_of_month = date("t", strtotime($DATE));
//echo $last_of_month;
$thisMonthAR = intval($this->m_customs->getThisMonthAR($y2,$m2));
$thisMonthNR = intval($this->m_customs->getThisMonthNR($y2,$m2));
//echo($thisMonthAR."<br/>");
//echo($CYAR);
$PI_per_month = 0;
$PE_per_month = 0;

if((intval($last_of_month) == intval($d2)) && (intval($thisMonthAR) >= 1)){
	$PI_per_month = ($CYAR / intval($m2))/1000000000;
	$PE_per_month = ($CYNR / intval($m2))/1000000000;
	
	$CYAR = $CYAR;
	$CYNR = $CYNR;
	
}
else{
	$PI_per_month = ($CYAR_PREV / intval($COUNT_PREV_MONTH))/1000000000;
	$PE_per_month = ($CYNR_PREV / intval($COUNT_PREV_MONTH))/1000000000;
	
	$CYAR = $CYAR_PREV + $totalAccum;
	$CYNR = $CYNR_PREV + $totalAccum;
	//echo(hello);
	//var_dump($CYNR_PREV);
}
//var_dump($CYAR);
$actual_amount = easy_number_format($CYAR);
$net_amount = easy_number_format($CYNR);

$mont = date_format(date_create($DATE),"M");
$exchange = $EXC_RATE;
$in_dollars = ($CYAR/$exchange);
$net_in_dollars = ($CYNR/$exchange);
$dollars = easy_number_format($in_dollars/1000000,2);
$net_dollars = easy_number_format($net_in_dollars/1000000,2);

$plan_percent = ($CYAR / $PLAN)*100;
$net_plan_percent = ($CYNR / $PLAN)*100;

?>
<tr class="row_blank bold_title"><td colspan=5 class="actual_r_td"><div><span style="text-decoration:underline">Law:</span> <?php echo(easy_number_format($PLAN/1000000000,2)." bill Riel (".easy_number_format($PLAN_USD/1000000,2)." mill USD) (~".easy_number_format($PLAN_PER_MONTH/1000000000)." bill/Month)"); ?></div></td><td colspan=3 class="color_white"><center style='padding-left:70px;'><?php echo $FULLNAME; ?></center></td></tr>
<tr class="row_blank bold_title"><td colspan=6 class="actual_r_td"><div><span style="text-decoration:underline">Revenue collected from 01-Jan-<?php echo(substr($y2,-2)); ?> to <?php echo($d2."-".$mont."-".$y2); ?>:</span></div></td><td colspan=2><center></center></td></tr>
<tr class="row_blank bold_title"><td colspan=6 class="actual_r_td"><div>*Prize Included: <?php echo($actual_amount." "); ?><?php echo("(".$dollars." mill USD ) (~".easy_number_format($PI_per_month)." bill/Month)"); ?></div></td><td colspan=2><center></center></td></tr>
<tr class="row_blank bold_title"><td colspan=6 class="actual_r_td" style="padding-left:42px"><div>% of Law: <?php echo(easy_number_format($plan_percent,2)); ?>%</div></td><td colspan=2><center></center></td></tr>
<tr class="row_blank bold_title"><td colspan=6 class="actual_r_td"><div>*Prize Excluded: <?php echo($net_amount." "); ?><?php echo("(".$net_dollars." mill USD ) (~".easy_number_format($PE_per_month)." bill/Month)"); ?></div></td><td colspan=2><center></center></td></tr>
<tr class="row_blank bold_title"><td colspan=6 class="actual_r_td" style="padding-left:44px"><div>% of Law: <?php echo(easy_number_format($net_plan_percent,2)); ?>%</div></td><td colspan=2><center></center></td></tr>
<tr class="row_blank"><td colspan=7><center></center></td></tr>
<!--<tr style="border-top:2px solid #bbb;" class="row_blank"><td colspan=6><center>អាសយដ្ឋានៈ លេខ ៦-៨ មហាវិថីព្រះនរោត្តម រាជធានីភ្នំពេញ កម្ពុជា</center></td></tr>
<tr class="row_blank"><td colspan=6><center>ទូរស័ព្វ /​ ទូរសារៈ (៨៥៥-២៣) ២១៤ ០៦៥ / ៧២៥ ១៨៧ / ២១២ ៤៥៧ /​ E-mail: info-pru@customs.gov.kh</center></td></tr>
-->
</table>
</form>
<p class="divFooter">Print date: <?php echo date('d-M-Y h:i:s A',time()); ?></p>
</div>
</center>


<style>
	body{background:#F0F0F0;font-family:Arial;text-shadow:none;padding:0px;}
	#table_preview{background:#FFF;width:1040px;padding-top:70px;padding-bottom:20px;}
	.tbl{width:95%;font-family:KHMER MEF1; font-size:16px}
	.tbl.print{margin-top:-45px;}
	/*.tbl th,.tbl td{border-collapse:collapse;border:1px solid #222 ; line-height:1.5}*/
	.tbl .bold_title{font-family: 'KHMER MEF2';}
	.tbl .top_title{font-size:20px;}
	.tbl .md_title{font-size:17px;}
	.tbl .row_report_title{font-family: KHMER MEF2;}
	.tbl .row_blank td{border:1px;}
	.tbl .row_simpleKH{font-family:KHMER MEF1;}
	.tbl .row_boldKH{font-family:  KHMER MEF2;}
	.tbl .row_bold{font-weight:bold;background:#fefefe;}
	.tbl .row_column_title td{text-transform:uppercase;font-weight:bold;}
	.tbl td.right{text-align:right;}
	.tbl .row-item{height:39px;}
	.hide{display:none;}
	.show{display:inline;}
	form div{display:none;}
	form div.action_menu{display:block;}
	.actual_r_td{height:24px}
	.actual_r_td div{display:block; margin-top:-30px}
	td.td-name{padding-left:10px}
	td.td-publisher{padding-top:10px}
	<?php
	if($cond=='value_only'){
		?>
		table{border-color: #ffffff;}
		.tbl th,.tbl td{border-collapse:collapse;border:1px solid #ffffff ; line-height:1.5;}
		.tr_t{ border-top:2px solid #ffffff;}
		.tr_b{ border-bottom:2px solid #ffffff;}
		.tr_l{ border-left:2px solid #ffffff;}
		.tr_r{ border-right:2px solid #ffffff;}
		<?php
	}else{
		?>
		.tbl th,.tbl td{border-collapse:collapse;border:1px solid #222 ; line-height:1.5;}
		.tr_t{ border-top:2px solid #222;}
		.tr_b{ border-bottom:2px solid #222;}
		.tr_l{ border-left:2px solid #222;}
		.tr_r{ border-right:2px solid #222;}
		<?php
	}
	?>
	

        p.divFooter {
			margin-top:20px;
			font-size:16px;
			background-color:#FFF;
        }
</style>
<script src="<?php echo base_url('assets/theme/js/jquery.min.js'); ?>"></script>
<script>
 function PrintReport(){
	//alert(document.URL);
	var url=document.URL;
	if(url.indexOf("?") >-1){
		OpenInNewTab(document.URL+'&print=true');
	}else{
		OpenInNewTab(document.URL+'?print=true');
	}
	return false;
 }
 function OpenInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}
$( document ).ready(function() {
  	cond = $('#cond').val();
  	if(cond == 'field_only'){
  		$('.value_data').css('color','#ffffff');
  	}
  	else if(cond == 'value_only'){
  		$('.color_white').css('color','#ffffff');
  		$('.head_data').html('');
  	}
});
</script>
<script language="VBScript">
// THIS VB SCRIP REMOVES THE PRINT DIALOG BOX AND PRINTS TO YOUR DEFAULT PRINTER
Sub window_onunload()
On Error Resume Next
Set WB = nothing
On Error Goto 0
End Sub

Sub Print()
OLECMDID_PRINT = 6
OLECMDEXECOPT_DONTPROMPTUSER = 2
OLECMDEXECOPT_PROMPTUSER = 1


On Error Resume Next

If DA Then
call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1)

Else
call WB.IOleCommandTarget.Exec(OLECMDID_PRINT ,OLECMDEXECOPT_DONTPROMPTUSER,"","","")

End If

If Err.Number <> 0 Then
If DA Then 
Alert("Nothing Printed :" & err.number & " : " & err.description)
Else
HandleError()
End if
End If
On Error Goto 0
End Sub

If DA Then
wbvers="8856F961-340A-11D0-A96B-00C04FD705A2"
Else
wbvers="EAB22AC3-30C1-11CF-A7EB-0000C05BAE0B"
End If

document.write "<object ID=""WB"" WIDTH=0 HEIGHT=0 CLASSID=""CLSID:"
document.write wbvers & """> </object>"
</script>
<script language='VBScript'>
Sub Print()
       OLECMDID_PRINT = 6
       OLECMDEXECOPT_DONTPROMPTUSER = 2
       OLECMDEXECOPT_PROMPTUSER = 1
       call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1)
End Sub
document.write "<object ID='WB' WIDTH=0 HEIGHT=0 CLASSID='CLSID:8856F961-340A-11D0-A96B-00C04FD705A2'></object>"
</script>
<?php
//$arr = array('SHV11'=>'6000','PNH05'=>'5000','PNH14'=>'4000');
//$json = json_encode($arr);
//echo($json);
//$json = json_decode(file_get_contents('http://127.0.0.1:8068/dailyreport/a.json'),true);
//echo(isset($json["SHV11"])?$json["SHV11"]:'ooo');
?>
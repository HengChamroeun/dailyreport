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
/*$param = array('start'=>$DATE_START,'end'=>$DATE_END,'method'=>'revenueTotalByOfficeByDay');
$param_accum = array('start'=>$DATE_01,'end'=>$DATE_END,'method'=>'revenueTotalByOfficeByDay');

$c = curl_init();
//curl_setopt($c,CURLOPT_URL,'http://10.0.9.13:8181/awlaravel/public/awrevenue/api/revenue');
curl_setopt($c,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($c,CURLOPT_URL,'https://trandoc.customs.gov.kh/awrevenue/api/revenue');
curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
curl_setopt($c,CURLOPT_POST,true);
curl_setopt($c,CURLOPT_POSTFIELDS,$param);
$output = curl_exec($c);
if(isset($output) && ($output !== false) && (!is_array($output)) && (!curl_errno($c))){
	$arr = json_decode($output,true);
	if(count($arr) > 0){
		foreach($arr as $ar){
		if(isset($ar['tax_amount']))
		{
			$arr_office[$ar['office_code']] = $ar['tax_amount'];
		}
	}
		}
}
curl_close($c);

$c_accum = curl_init();
curl_setopt($c_accum,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($c_accum,CURLOPT_URL,'https://trandoc.customs.gov.kh/awrevenue/api/revenue');
curl_setopt($c_accum,CURLOPT_RETURNTRANSFER,true);
curl_setopt($c_accum,CURLOPT_POST,true);
curl_setopt($c_accum,CURLOPT_POSTFIELDS,$param_accum);
$output_accum = curl_exec($c_accum);
if(isset($output_accum) && ($output_accum !== false) && (!is_array($output_accum)) && (!curl_errno($c_accum))){
	$arr_accum = json_decode($output_accum,true);
	if(count($arr_accum) > 0){
		foreach($arr_accum as $ar_accum){
			if(isset($ar_accum['tax_amount']))
			{
				$arr_office_accum[$ar_accum['office_code']] = $ar_accum['tax_amount'];
			}
		}
	}
}
curl_close($c_accum);*/

//var_dump($output);
//var_dump($output_accum);



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
<!--<td class="color_white"><center>ចំណូលក្នុងប្រព័ន្ធ<br/>ASYCUDA</center></td>-->
<td class="color_white"><center>VAT កសិកម្ម <br/>និង CD ឳសថ</center></td>
<!--<td class="color_white"><center>ចំណូលក្នុងប្រព័ន្ធ<br/>ASYCUDA បូកបន្ត</center></td>-->
<td class="color_white"><center>VAT កសិកម្ម និង<br/>CD ឳសថ​បូកបន្ត</center></td>
<td class="color_white"><center>ចំណូលពន្ធ <br/>ប្រចាំថ្ងៃទី<?php echo $day_plus.numberKH($DAY); ?></center></td>
<td class="color_white"><center>ចំណូលពន្ធ<?php //echo monthKH($MONTH).' ឆ្នាំ'.numberKH($YEAR); ?><br/> គិតត្រឹមថ្ងៃទី<?php echo numberKH($DAY); ?></center></td>
<td class="color_white"><center>%</center></td>
<td class="color_white"><center>ផែនការ<br/>សំរាប់ខែ</center></td>
</tr>
<?php
	$branches=$this->m_global->select_data(TBLOFFICES, array('parent_code'=>'CHQ00','status'=>'1'), array('level'=>'ASC'));
	
	$totalplan = 0;
	$i = 1;
	//var_dump($todaymotor_m_amount);
	$sum_vat_a_cd_m_acc = 0;
	$sum_motor_amount = 0;
	$sum_motor_acc = 0;
	$sum_car_amount = 0;
	$sum_car_acc = 0;
	$sum_phone_amount = 0;
	$sum_phone_acc = 0;
	foreach($branches as $b){
		
				$offices = $this->m_global->select_data(TBLOFFICES,array('parent_code'=>$b->code,'status'=>1), array('level'=>'ASC'));
		
				$plan = 0;
				
				$acc = 0;
				$res = 0;
				$rev = 0;
				$pre_acc = 0;
				$pre_res = 0;
				$revenued = false;
				
				$vat_a_cd_m_acc = 0;
				$pre_vat_a_cd_m_acc = 0;
				$vat_a_cd_m = 0;
				
				$motor_amount = 0;
				$motor_acc = 0;
				$car_amount = 0;
				$car_acc = 0;
				$phone_amount = 0;
				$phone_acc = 0;
				
				if(isset($todayrev_sum_acc[$b->code]))
				{
					$acc = $todayrev_sum_acc[$b->code];
					$res = $todayrev_sum_res[$b->code];
					$revenued = true;
					
					$vat_a_cd_m_acc = $todayvat_a_cd_m_acc_sum_acc[$b->code];
					
					$motor_amount = $todaymotor_m_amount[$b->code];
					$motor_acc = $todaymotor_m_acc[$b->code];
					$car_amount = $todaymotor_c_amount[$b->code];
					$car_acc = $todaymotor_c_acc[$b->code];
					$phone_amount = $todaymotor_p_amount[$b->code];
					$phone_acc = $todaymotor_p_acc[$b->code];
					}
				else{
					$revenued = false;
					if(isset($prevrev_sum_acc[$b->code])){
						$acc = $prevrev_sum_acc[$b->code];
						$res = $prevrev_sum_res[$b->code];
						
						$vat_a_cd_m_acc = $prevvat_a_cd_m_acc_sum_acc[$b->code];
						}
					}
				if(isset($prevrev_sum_acc[$b->code])){
					$pre_acc = $prevrev_sum_acc[$b->code];
					$pre_res = $prevrev_sum_res[$b->code];
					
					$pre_vat_a_cd_m_acc = $prevvat_a_cd_m_acc_sum_acc[$b->code];
					
					$motor_amount = $motor_amount > 0? $motor_amount :$prevmotor_m_amount[$b->code];
					$motor_acc = $motor_acc > 0? $motor_acc :$prevmotor_m_acc[$b->code];
					$car_amount = $car_amount > 0? $car_amount :$prevmotor_c_amount[$b->code];
					$car_acc = $car_acc > 0? $car_acc :$prevmotor_c_acc[$b->code];
					$phone_amount = $phone_amount > 0? $phone_amount :$prevmotor_p_amount[$b->code];
					$phone_acc = $phone_acc > 0? $phone_acc :$prevmotor_p_acc[$b->code];
					}
				if($revenued){
					$rev = ($acc - $res) - ($pre_acc - $pre_res);
					
					$vat_a_cd_m = $vat_a_cd_m_acc - $pre_vat_a_cd_m_acc;
					}
				else{
					$rev = 0;
					}
				
				$timestamp_ = (isset($timestamp[$b->code])?date('Y-m-d H:i:s',$timestamp[$b->code]):'');
				
				//$plan=$this->m_global->select_record(TBLPLANNERS,array('branch_code'=>'CHQ00','office_code'=>$b->code, 'valid_from <= '=>$DATE),'amount',array('valid_from'=>'DESC'));
				$plan = 0;
				if(isset($PLANNER[$b->code])){
				$plan = $PLANNER[$b->code];
				$plan=floatval($plan)/3;
				$totalplan+=$plan;
				}
				
				$count_acuda_revenues = 0;
				$count_acuda_revenues_accum = 0;
				
				foreach($offices as $o){
					$count_acuda_revenues = $count_acuda_revenues + (isset($arr_office[$o->code])?$arr_office[$o->code]:0);
					$count_acuda_revenues_accum = $count_acuda_revenues_accum + (isset($arr_office_accum[$o->code])?$arr_office_accum[$o->code]:0);
					}
				if(isset($arr_office[$b->code])){
					$count_acuda_revenues = $arr_office[$b->code];
					}
				if(isset($arr_office_accum[$b->code])){
					$count_acuda_revenues_accum = $arr_office_accum[$b->code];
					}
					
					$has_motor = false;
					$row_span = '';
					if($motor_amount > 0 || $motor_acc > 0 || $car_amount > 0 || $car_acc > 0 || $phone_amount > 0 || $phone_acc > 0){
						$has_motor = true;
						$row_span = 'rowspan="2"';
						}
		
	?>
    	<!--<tr class="row_boldKH <?php echo($has_motor==true?'has_motor':''); ?>">-->
        <tr class="row_boldKH">
			<!--<td class="color_white" <?php echo($row_span); ?> style=" <?php echo($has_motor?"border-bottom:2px solid #222;":""); ?>"><center><?php echo($i); ?></center></td>-->
            <td class="color_white"><center><?php echo($i); ?></center></td>
			<td class="color_white td-name"><?php echo($b->name_print.(floatval($res)>0?'(+'.easy_number_format(floatval($res)/1000000).')':'')); ?></td>
			<!--<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo ($count_acuda_revenues>0?easy_number_format($count_acuda_revenues,0)." ៛":""); ?></td>-->
            <td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo easy_number_format($vat_a_cd_m,0); ?> ៛</td>
            <!--<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo ($count_acuda_revenues_accum>0?easy_number_format($count_acuda_revenues_accum,0)." ៛":""); ?></td>-->
            <td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo easy_number_format($vat_a_cd_m_acc,0); ?> ៛</td>
            <td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo easy_number_format($rev); ?> ៛</td>
			<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo easy_number_format($acc - $res); ?> ៛</td> 
			<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo ($plan!=0?easy_number_format($acc*100/($plan*1000000), 2):'');  ?>%</td>
			<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo ($plan!=0?easy_number_format($plan,0):''); ?></td>
		</tr>
        <?php
			//if($motor_amount > 0 || $motor_acc > 0 || $car_amount > 0 || $car_acc > 0 || $phone_amount > 0 || $phone_acc > 0){
			if(false){
				
				$sum_motor_amount += $motor_amount;
				$sum_motor_acc += $motor_acc;
				$sum_car_amount += $car_amount;
				$sum_car_acc += $car_acc;
				$sum_phone_amount += $phone_amount;
				$sum_phone_acc += $phone_acc;
				?>
                <tr class="motor total-motor">
                	<td colspan="7">
                    	<div class="second">
                        ចំនួនទូរស័ព្ទ: <?php echo easy_number_format($phone_amount); ?> ចំណូល: <?php echo easy_number_format($phone_acc); ?>
                        </div>
                        <div class="second">
                        ចំនួនរថយន្ត: <?php echo easy_number_format($car_amount); ?> ចំណូល: <?php echo easy_number_format($car_acc); ?>,
                        </div>
                        <div class="first">
                        ចំនួនម៉ូតូ: <?php echo easy_number_format($motor_amount); ?> ចំណូល: <?php echo easy_number_format($motor_acc); ?>,
                        </div>
                    </td>
                </tr>
				<?php
				}
				?>
	<?php
		$i++;
		
		
		foreach($offices as $off){
					$acc = 0;
					$res = 0;
					$rev = 0;
					$pre_acc = 0;
					$pre_res = 0;
					$revenued = false;
					
					$vat_a_cd_m_acc = 0;
					$pre_vat_a_cd_m_acc = 0;
					$vat_a_cd_m = 0;
					
					$motor_amount = 0;
					$motor_acc = 0;
					$car_amount = 0;
					$car_acc = 0;
					$phone_amount = 0;
					$phone_acc = 0;
					
					if(isset($todayrev[$b->code][$off->code]))
					{
						$acc = $todayrev[$b->code][$off->code]['accumulative'];
						$res = $todayrev[$b->code][$off->code]['reserved'];
						$revenued = true;
						
						$vat_a_cd_m_acc = $todayrev[$b->code][$off->code]['vat_a_cd_m_acc'];
						
						$motor_amount = $todayrev[$b->code][$off->code]['motor_amount'];
						$motor_acc = $todayrev[$b->code][$off->code]['motor_acc'];
						$car_amount = $todayrev[$b->code][$off->code]['car_amount'];
						$car_acc = $todayrev[$b->code][$off->code]['car_acc'];
						$phone_amount = $todayrev[$b->code][$off->code]['phone_amount'];
						$phone_acc = $todayrev[$b->code][$off->code]['phone_acc'];
						}
					else{
						$revenued = false;
						if(isset($prevrev[$b->code][$off->code])){
							$acc = $prevrev[$b->code][$off->code]['accumulative'];
							$res = $prevrev[$b->code][$off->code]['reserved'];
							
							$vat_a_cd_m_acc = $prevrev[$b->code][$off->code]['vat_a_cd_m_acc'];
							}
						}
					if(isset($prevrev[$b->code][$off->code])){
						$pre_acc = $prevrev[$b->code][$off->code]['accumulative'];
						$pre_res = $prevrev[$b->code][$off->code]['reserved'];
						
						$pre_vat_a_cd_m_acc = $prevrev[$b->code][$off->code]['vat_a_cd_m_acc'];
						
						$motor_amount = $motor_amount > 0? $motor_amount :$prevrev[$b->code][$off->code]['motor_amount'];
						$motor_acc = $motor_acc > 0? $motor_acc :$prevrev[$b->code][$off->code]['motor_acc'];
						$car_amount = $car_amount > 0? $car_amount :$prevrev[$b->code][$off->code]['car_amount'];
						$car_acc = $car_acc > 0? $car_acc :$prevrev[$b->code][$off->code]['car_acc'];
						$phone_amount = $phone_amount > 0? $phone_amount :$prevrev[$b->code][$off->code]['phone_amount'];
						$phone_acc = $phone_acc > 0? $phone_acc :$prevrev[$b->code][$off->code]['phone_acc'];
						}
					if($revenued){
						$rev = ($acc - $res) - ($pre_acc - $pre_res);
						
						$vat_a_cd_m = $vat_a_cd_m_acc - $pre_vat_a_cd_m_acc;
						}
					else{
						$rev = 0;
						}
						
						$plan = 0;
						if(isset($PLANNER[$off->code])){
						$plan = $PLANNER[$off->code];
						$plan=floatval($plan)/3;
						//$totalplan+=$plan;
						}
						
						$has_motor = false;
						$row_span = '';
						if($motor_amount > 0 || $motor_acc > 0 || $car_amount > 0 || $car_acc > 0 || $phone_amount > 0 || $phone_acc > 0){
							$has_motor = true;
							$row_span = 'rowspan="2"';
							}
							
				
						
			?>
            <!--<tr class="<?php echo($has_motor==true?'has_motor':''); ?>">-->
            <tr>
				<!--<td <?php echo($row_span); ?> style=" <?php echo($has_motor?"border-bottom:2px solid #222;":""); ?>"></td>-->
                <td></td>
				<td class="color_white td-name"> - <?php echo($off->name_print.(floatval($res)>0?'(+'.easy_number_format(floatval($res)/1000000).')':'')); ?></td>
				<!--<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo (isset($arr_office[$off->code])?easy_number_format($arr_office[$off->code],0)." ៛":""); ?></td>-->
                <td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo easy_number_format($vat_a_cd_m,0); ?> ៛</td>
                <!--<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo (isset($arr_office_accum[$off->code])?easy_number_format($arr_office_accum[$off->code],0)." ៛":""); ?></td>-->
                <td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo easy_number_format($vat_a_cd_m_acc,0); ?> ៛</td>
                <td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo easy_number_format($rev); ?> ៛</td>
				<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo easy_number_format($acc - $res); ?> ៛</td> 
				<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo ($plan!=0?easy_number_format($acc*100/($plan*1000000), 2):'');  ?>%</td>
				<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_data"><?php echo ($plan!=0?easy_number_format($plan,0):''); ?></td>
			</tr>
            <?php
			//if($motor_amount > 0 || $motor_acc > 0 || $car_amount > 0 || $car_acc > 0 || $phone_amount > 0 || $phone_acc > 0){
			if(false){
				
			
				?>
                <tr class="motor">
                	<td colspan="7">
                    	<div class="second">
                        ចំនួនទូរស័ព្ទ: <?php echo easy_number_format($phone_amount); ?> ចំណូល: <?php echo easy_number_format($phone_acc); ?>
                        </div>
                        <div class="second">
                        ចំនួនរថយន្ត: <?php echo easy_number_format($car_amount); ?> ចំណូល: <?php echo easy_number_format($car_acc); ?>,
                        </div>
                        <div class="first">
                        ចំនួនម៉ូតូ: <?php echo easy_number_format($motor_amount); ?> ចំណូល: <?php echo easy_number_format($motor_acc); ?>,
                        </div>
                    </td>
                </tr>
				<?php
				}
			}
	}
 ?>
<tr class='row_boldKH'>
	<td colspan=2 class="color_white"><center>សរុបចំណូលពន្ធ និងអាករគយ</center></td>
	<!--<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo (array_sum($arr_office)<=0)?"":easy_number_format(array_sum($arr_office),0)." ៛"; ?></td>-->
    <td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo easy_number_format($todaytotalvat_a_cd_m_acc_sum_acc-$prevtodaytotalvat_a_cd_m_acc_sum_acc,0)." ៛"; ?></td>
    <!--<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo (array_sum($arr_office_accum)<=0)?"":easy_number_format(array_sum($arr_office_accum),0)." ៛"; ?></td>-->
    <td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo easy_number_format(($total_sum_vat_a_cd_m_acc_acc),0); ?> ៛</td>
    <td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo easy_number_format(($todaytotal_sum_acc-$todaytotal_sum_res)-($prevtodaytotal_sum_acc-$prevtodaytotal_sum_res),0); ?> ៛</td>
	<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo easy_number_format(($total_sum_acc - $total_sum_res),0); ?> ៛</td>
	<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo ($totalplan!=0?easy_number_format(($total_sum_acc - $total_sum_res)*100/($totalplan*1000000), 2):'');  ?>%</td>
	<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_data"><?php echo ($totalplan!=0?easy_number_format($totalplan,0):''); ?></td>

</tr>
<?php
			//if($sum_motor_amount > 0 || $sum_motor_acc > 0 || $sum_car_amount > 0 || $sum_car_acc > 0 || $sum_phone_amount > 0 || $sum_phone_acc > 0){
			if(false){
				?>
                <tr class="motor total-motor">
                	
                	<td colspan="8">
                    	<div class="second">
                        ចំនួនទូរស័ព្ទ: <?php echo easy_number_format($sum_phone_amount); ?> ចំណូល: <?php echo easy_number_format($sum_phone_acc); ?>
                        </div>
                        <div class="second">
                        ចំនួនរថយន្ត: <?php echo easy_number_format($sum_car_amount); ?> ចំណូល: <?php echo easy_number_format($sum_car_acc); ?>,
                        </div>
                        <div class="first">
                        ចំនួនម៉ូតូ: <?php echo easy_number_format($sum_motor_amount); ?> ចំណូល: <?php echo easy_number_format($sum_motor_acc); ?>,
                        </div>
                    </td>
                </tr>
				<?php
				}
				?>

<tr class="row_blank"><td colspan='5'><center></center></td><td colspan=3 class="color_white td-publisher"><center>រាជធានីភ្នំពេញ,ថ្ងៃទី  <?php echo numberKH($DAY).'  '.monthKH($MONTH);?>               ឆ្នាំ<?php echo numberKH($YEAR);?></center></td></tr>
<tr class="row_blank bold_title"><td colspan='5'><center></center></td><td colspan=3 class="color_white"><center>អ្នកធ្វើតារាង</center></td></tr>
<tr class="row_blank bold_title"><td colspan='5'><center></center></td><td colspan=3 class="color_white"><center></center></td></tr>


<tr class="row_blank"><td colspan=6 style="padding:30px;"><center></center></td></tr>
<tr class="row_blank"><td colspan=6><center></center></td></tr>
<?php 
$totalAccum = 0;
list($y2,$m2,$d2)=explode('-',$DATE);

$last_of_month = date("t", strtotime($DATE));
//echo $last_of_month;
$thisMonthAR = intval($this->m_customs->getThisMonthAR($y2,$m2));
$thisMonthNR = intval($this->m_customs->getThisMonthNR($y2,$m2));
//echo($thisMonthAR."<br/>");
//echo($CYAR);
$PI_per_month = 0;
$PE_per_month = 0;

$CYAR = $CYAR + $CYAR_MISSED;
$CYNR = $CYNR + $CYNR_MISSED;
$CYAR_PREV = $CYAR_PREV + $CYAR_MISSED;
$CYNR_PREV = $CYNR_PREV + $CYNR_MISSED;

if((intval($last_of_month) == intval($d2)) && (intval($thisMonthAR) >= 1)){
	$PI_per_month = ($CYAR / intval($m2))/1000000000;
	$PE_per_month = ($CYNR / intval($m2))/1000000000;
	
	$CYAR = $CYAR;
	$CYNR = $CYNR;
	
}
else{
	//$PI_per_month = ($CYAR_PREV  / intval($COUNT_PREV_MONTH))/1000000000;
	//$PE_per_month = ($CYNR_PREV / intval($COUNT_PREV_MONTH))/1000000000;
	if($CYAR_PREV !='0' && $COUNT_PREV_MONTH !='0'){
	$PI_per_month = ($CYAR_PREV  / intval($COUNT_PREV_MONTH))/1000000000;
	}
	
	if($CYNR_PREV !='0' && $COUNT_PREV_MONTH !='0'){
	$PE_per_month = ($CYNR_PREV / intval($COUNT_PREV_MONTH))/1000000000;
	}
	
	$CYAR = $CYAR_PREV + ($total_sum_acc - $total_sum_res);
	$CYNR = $CYNR_PREV + ($total_sum_acc - $total_sum_res);
	//echo(hello);
	//var_dump($CYNR_PREV);
}
//var_dump($total_sum_acc);
$actual_amount = easy_number_format($CYAR);
$net_amount = easy_number_format($CYNR);

$mont = date_format(date_create($DATE),"M");
$exchange = $EXC_RATE;
$in_dollars = ($CYAR/$exchange);
$net_in_dollars = ($CYNR/$exchange);
$dollars = easy_number_format($in_dollars/1000000,2);
$net_dollars = easy_number_format($net_in_dollars/1000000,2);

//$plan_percent = ($CYAR / $PLAN)*100;
//$net_plan_percent = ($CYNR / $PLAN)*100;
$plan_percent = 0;
$net_plan_percent = 0;
if($CYAR!='0' && $PLAN!='0'){
$plan_percent = ($CYAR / $PLAN)*100;
}
if($CYNR!='0' && $PLAN!='0'){
$net_plan_percent = ($CYNR / $PLAN)*100;
}

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
		tr.motor td{
			padding-right:5px;
			padding-top:10px;
			padding-bottom:10px;
			font-size:14px;
			
			border-top:none;
			border-bottom:2px solid #222;
			}
		tr.motor td div.second{
			padding-left:5px;
			
			}
		tr.motor div{
			display:block;
			float:right;
			}
		tr.total-motor td div{
			font-weight:bold;
			}
		tr.has_motor td{
			border-bottom:1px dashed #222;
			border-top:2px solid #222;
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
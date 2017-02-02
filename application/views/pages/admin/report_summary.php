<center>
<?php
	if(!isset($OFFICE)){$OFFICE='';}
	if(!isset($MONTH)){$MONTH='';}
	$cond = $this->input->get('cond');
 ?>
<?php 
		$day_name=strtolower(date('D',strtotime($DATE)));
		$day_plus='';
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$DATE);
			if($d!='01'){
				$d=floatval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				$day_plus=numberKH($d).'+';
			}
			
		} 
?>
<div id="table_preview">
<input type="hidden" id="cond" name="cond" value="<?php echo $this->input->get('cond'); ?>" />
<form action="<?php echo base_url('admin/exporter'); ?>" method="post"><!--onsubmit='$("#datatodisplay").val( $("<div>").append( $("#ReportTable").eq(0).clone() ).html() )'>-->
<?php
$print=$this->input->get('print');
$tbl_print='print';
 if($print!="true"){ ?>
<div class="action_menu" style=" padding-top:9px;position:fixed;top:0px;width:930px;text-align:left;padding-left:40px;height:40px;background:#FFF;margin-top:0px auto;margin-bottom:70px;border-bottom:1px solid #ccc;">
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
<tr class="row_blank"><td colspan="4" class="bold_title top_title head_data" style="height: 32px"><center>ព្រះរាជាណាចក្រកម្ពុជា</center></td></tr>
<tr class="row_blank"><td colspan="4" class="bold_title bold_title head_data" style="height: 25px"><center>ជាតិ សាសនា ព្រះមហាក្សត្រ</center></td></tr>
<tr class="row_blank"><td colspan="2" class="bold_title bold_title head_data" style='position:relative'><img id='print_logo' style='max-height:100px;top:-65px;margin-left:50px;position:absolute' src="<?php echo base_url('assets/files/customs_logo.jpg') ?>"/></td><td colspan=2></td></tr>
<tr class="row_blank"><td colspan=4><center></center></td></tr>
<tr class="row_blank"><td colspan="2" class="bold_title bold_title head_data"><label style='font-size:17px;margin-top:-15px'>អគ្គនាយកដ្ឋានគយនិងរដ្ឋាករកម្ពុជា</label></td><td colspan=2></td></tr>

<tr class="row_blank row_report_title bold_title"><td colspan="4" class="head_data"><center style="margin-top:-15px">លទ្ធផលបណ្តោះអាសន្នចំណូលពន្ធ និងអាករគយ<?php //var_dump($MONTH); ?><center></td></tr>
<tr class="row_blank row_report_title bold_title"><td colspan="4" class="head_data"><center style="margin-top:-15px"> ប្រចាំ<?php if($DAY!=''){echo 'ថ្ងៃទី'.$day_plus.numberKH($DAY);} ?> <?php if($MONTH!=''){echo monthKH($MONTH);}?>  ឆ្នាំ<?php echo numberKH($YEAR); if(isset($MONTH2)){echo ' ដល់ '.monthKH($MONTH2).' ឆ្នាំ'.numberKH($YEAR2);} ?></center></td></tr>
<tr class="bold_title tr_t tr_l tr_r">
<td style="width: 30px; height: 50px;" class="head_data"><center>លរ</center></td>
<td style="width: 411px;" class="head_data"><center>អង្គភាពគយ និងរដ្ឋាករ</center></td>
<td style="width: 202px;" class="head_data"><center>ចំណូលពន្ធ និងអាករគយ <br/>ប្រចាំថ្ងៃទី<?php echo $day_plus.numberKH($DAY); ?></center></td>
<td  style="width: 278px;" class="head_data"><center>ចំណូលពន្ធ និងអាករគយ <?php echo monthKH($MONTH).' <br/>ឆ្នាំ'.numberKH($YEAR); ?> គិតត្រឹមថ្ងៃទី<?php echo numberKH($DAY); ?></center></td>
</tr>
<?php
	//$branches=$this->m_global->select_data(TBLOFFICES, array('parent_code'=>'CHQ00','status'=>'1'), array('level2'=>'ASC'),18);
	$branches=$this->m_global->select_data(TBLOFFICES, array('parent_code'=>'CHQ00','status'=>'1'), array('level3'=>'ASC'),20);
	/* echo '<pre>';
	print_r($branches);
	echo '</pre>'; */
	//return;
	$i=1;
	$branch_with_offices = array('SHV10','KKG10');
	$not_office = array('SHV101','SHV102','KKG101','KKG102');
	$listed_acc = 0;
	$listed_res = 0;
	$listed_rev = 0;
	
	foreach($branches as $b){
		
				$acc = 0;
				$res = 0;
				$rev = 0;
				$pre_acc = 0;
				$pre_res = 0;
				$revenued = false;
				
				if(isset($todayrev_sum_acc[$b->code]))
				{
					$acc = $todayrev_sum_acc[$b->code];
					$res = $todayrev_sum_res[$b->code];
					$revenued = true;
					}
				else{
					$revenued = false;
					if(isset($prevrev_sum_acc[$b->code])){
						$acc = $prevrev_sum_acc[$b->code];
						$res = $prevrev_sum_res[$b->code];
						}
					}
				if(isset($prevrev_sum_acc[$b->code])){
					$pre_acc = $prevrev_sum_acc[$b->code];
					$pre_res = $prevrev_sum_res[$b->code];
					}
				if($revenued){
					$rev = ($acc - $res) - ($pre_acc - $pre_res);
					}
				else{
					$rev = 0;
					}
				
				$timestamp_ = (isset($timestamp[$b->code])?date('Y-m-d H:i:s',$timestamp[$b->code]):'');
				
				$listed_acc += $acc;
				$listed_res += $res;
				$listed_rev += $rev;
?>
		<tr class="bold_title tr_l tr_r" style="height:25px !important;">
			<td class="field_data"><center><?php echo($i); ?></center></td>
			<td class="field_data"><?php echo($b->name); ?></td>
			<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_d_data"><?php echo easy_number_format($rev); ?> ៛</td>
			<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_m_data"><?php echo easy_number_format($acc - $res); ?> ៛</td> 
		</tr>
<?php
		$i++;
		
	if(in_array($b->code,$branch_with_offices)){
			
		$offs=$this->m_global->select_data(TBLOFFICES,array('parent_code'=>$b->code,'status'=>1));
		foreach($offs as $off){
			if(!in_array($off->code,$not_office)){
				$acc = 0;
				$res = 0;
				$rev = 0;
				$pre_acc = 0;
				$pre_res = 0;
				$revenued = false;
				
				if(isset($todayrev[$b->code][$off->code]))
				{
					$acc = $todayrev[$b->code][$off->code]['accumulative'];
					$res = $todayrev[$b->code][$off->code]['reserved'];
					$revenued = true;
					}
				else{
					$revenued = false;
					if(isset($prevrev[$b->code][$off->code])){
						$acc = $prevrev[$b->code][$off->code]['accumulative'];
						$res = $prevrev[$b->code][$off->code]['reserved'];
						}
					}
				if(isset($prevrev[$b->code][$off->code])){
					$pre_acc = $prevrev[$b->code][$off->code]['accumulative'];
					$pre_res = $prevrev[$b->code][$off->code]['reserved'];
					}
				if($revenued){
					$rev = ($acc - $res) - ($pre_acc - $pre_res);
					}
				else{
					$rev = 0;
					}
					
				// Skip bak klang:
				if($off->code=='KKG13'){
					continue;
					}
?>
			<tr class="tr_l tr_r">
				<td></td>
				<td class="field_data"> - <?php echo($off->name); ?></td>
				<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_d_data"><?php echo easy_number_format($rev); ?> ៛</td>
				<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_m_data"><?php echo easy_number_format($acc - $res); ?> ៛</td> 
			</tr>
<?php
				}
			}
		}
	}
 ?>
 <?php
 $other_acc = 0;
 $other_res = 0;
 $other_rev = 0;
 $other_rev = (($todaytotal_sum_acc-$todaytotal_sum_res)-($prevtodaytotal_sum_acc-$prevtodaytotal_sum_res)) - $listed_rev;
 $other_acc = $total_sum_acc - $listed_acc;
 $other_res = $total_sum_res - $listed_res;
 ?>
<tr class="bold_title tr_l tr_r">
		<td class="field_data"><center><?php echo($i); ?></center></td>
	<td style="font-size:14px;" class="field_data">នាយកដ្ឋាន សាខា ការិយាល័យគយនិងរដ្ឋាករផ្សេងទៀត</td>
	<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_d_data"><?php echo easy_number_format(($other_rev),0); ?> ៛</td>
	<td style="text-align:right;font-weight:bold;padding-right:5px;" class="value_m_data"><?php echo easy_number_format(($other_acc - $other_res),0); ?> ៛</td> 
</tr>
<tr class='bold_title tr_t tr_b tr_l tr_r'>
	<td colspan=2 class="field_data"><center>សរុបចំណូលពន្ធ និងអាករគយ</center></td>
	<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_d_data"><?php echo easy_number_format(($todaytotal_sum_acc-$todaytotal_sum_res)-($prevtodaytotal_sum_acc-$prevtodaytotal_sum_res),0); ?> ៛</td>
	<td style='text-align:right;font-weight:bold;padding-right:5px;' class="value_m_data"><?php echo easy_number_format(($total_sum_acc - $total_sum_res),0); ?> ៛</td>
</tr>

<tr class="row_blank"><td colspan=2 class="head_data"><center>បានឃើញ</center></td><td colspan=2 class="head_data"><center>រាជធានីភ្នំពេញ,ថ្ងៃទី   <?php echo numberKH($DAY).'  '.monthKH($MONTH);?>               ឆ្នាំ <?php echo numberKH($YEAR);?></center></td></tr>
<tr class="row_blank bold_title"><td colspan=2 class='bigger head_data' style="height: 32px"><center>អគ្គនាយក</center></td><td colspan=2 class="head_data"><center>អ្នកធ្វើតារាង</center></td></tr>
<tr class="row_blank bold_title"><td colspan=2 class='bigger head_data' style="height: 30px"><center>អគ្គនាយកដ្ឋានគយនិងរដ្ឋាករកម្ពុជា</center></td><td colspan=2><center></center></td></tr>


<tr class="row_blank"><td colspan=4 style="padding:30px;"><center></center></td></tr>

<tr class="row_blank bold_title"><td colspan=2><center></center></td><td colspan=2 style="height: 34px" class="head_data"><center style='padding-left:70px;'><?php echo $FULLNAME; ?></center></td></tr>
<tr class="row_blank bold_title"><td colspan=2 class='bigger head_data' style="height: 28px; width: 448px"><center style='padding-left:120px; font-weight:bold'><?php echo($this->m_customs->getSignatureName($this->input->get('signature'))); ?></center></td><td colspan=2><center></center></td></tr>
<tr style="border-top:2px solid <?php echo($cond=='value_only'?'#ffffff':'#bbb'); ?>;" class="row_blank color_white"><td colspan=4 class="head_data" style="height: 30px"><center>អាសយដ្ឋានៈ លេខ ៦-៨ មហាវិថីព្រះនរោត្តម រាជធានីភ្នំពេញ កម្ពុជា</center></td></tr>
<tr class="row_blank"><td colspan=4 class="head_data" style="height: 29px"><center>ទូរស័ព្វ /​ ទូរសារៈ (៨៥៥-២៣) ២១៤ ០៦៥ / ៧២៥ ១៨៧ / ២១២ ៤៥៧ /​ E-mail: info-pru@customs.gov.kh</center></td></tr>

</table>
</form>
</div>
</center>
<style>
	body{background:#F0F0F0;font-family:Arial;font-size:17px;text-shadow:none;padding:0px;}
	#table_preview{background:#FFF;width:970px;padding-top:50px;padding-bottom:20px;}
	.tbl{width:95%;font-family:KHMER MEF1;}
	.tbl td{height:27px;}
	.tbl.print{margin-top:-45px;}
	/*.tbl th,.tbl td{border-collapse:collapse;border:1px solid #222 ;}*/
	.tbl .bold_title{font-family: 'KHMER MEF2';line-height: 1.5;}
	.tbl .bold_title .bigger{font-size:19px;}
	.tbl .top_title{font-size:20px;}
	.tbl .md_title{font-family: 'KHMER MEF2' !important,font-size:17px;line-height: 1.5;}
	.tbl .row_report_title{font-family: KHMER MEF2;}
	.tbl .row_blank td{border:1px;}
	.tbl .row_simpleKH{font-family:KHMER MEF1;}
	.tbl .row_boldKH{font-family:  KHMER MEF2;}
	.tbl .row_bold{font-weight:bold;background:#fefefe;}
	.tbl .row_column_title td{text-transform:uppercase;font-weight:bold;}
	.tbl td.right{text-align:right;}
	.tbl .row-item{height:55px;}
	.hide{display:none;}
	.show{display:inline;}
	form div{display:none;}
	form div.action_menu{display:block;}
	
	<?php
	if($cond=='value_only'){
		?>
		table{border-color: #ffffff;}
		.tbl th,.tbl td{border-collapse:collapse;border:1px solid #ffffff ;}
		.tr_t{ border-top:2px solid #ffffff;}
		.tr_b{ border-bottom:2px solid #ffffff;}
		.tr_l{ border-left:2px solid #ffffff;}
		.tr_r{ border-right:2px solid #ffffff;}
		<?php
	}else{
		?>
		.tbl th,.tbl td{border-collapse:collapse;border:1px solid #222 ;}
		.tr_t{ border-top:2px solid #222;}
		.tr_b{ border-bottom:2px solid #222;}
		.tr_l{ border-left:2px solid #222;}
		.tr_r{ border-right:2px solid #222;}
		<?php
	}
	?>
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
  		$('.value_m_data').html('');
  		$('.value_d_data').html('');
  	}
  	else if(cond == 'value_only'){
  		$('.field_data').html('');
  		$('.head_data').html('');
  		//$('.color_white').css('color','#ffffff');
  		
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
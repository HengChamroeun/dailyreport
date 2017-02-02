<?php 	

$disp_m = "";	
$month = "";
$q = "";
$h = "";
$year = "";
$list = "";
$last_of_month = "";
if($this->input->get('y')){
	$year = $this->input->get('y');
	}
if($this->input->get('list')){
	$list = $this->input->get('list');
	}
if($list=='monthly'){
	$month = $this->input->get('m');
	$last_of_month = date("t", strtotime($year.'-'.$month.'-01'));
	$last_of_month = (intval($last_of_month)<=9?'0'.$last_of_month:$last_of_month);
	$disp_m = "គិតពីថ្ងៃទី ០១ ដល់ថ្ងៃទី ".numberKH($last_of_month)." ខែ ".month_kh($month)." ";
	}
	elseif($list=='quarterly'){
		$disp_m = "ប្រចាំត្រីមាស ទី ";
		$num = "";
		$q = $this->input->get('q');
		if($q=='q1'){
			$month = "'01','02','03'";
			$num = "០១";
			}
		elseif($q=='q2'){
			$month = "'04','05','06'"; 
			$num = "០២";
			}
		elseif($q=='q3'){
			$month = "'07','08','09'"; 
			$num = "០៣";
			}
		elseif($q=='q4'){
			$month = "'10','11','12'"; 
			$num = "០៤";
			}
		$disp_m = $disp_m.$num." ";
		}
	elseif($list=='half'){
		$disp_m = "ប្រចាំឆមាស ទី ";
		$num = "";
		$h = $this->input->get('h');
		if($h=='h1'){
			$month = "'01','02','03','04','05','06'"; 
			$num = "០១";
			}
		elseif($h=='h2'){
			$month = "'07','08','09','10','11','12'"; 
			$num = "០២";
			}
		$disp_m = $disp_m.$num." ";
		}
	elseif($list=='9month'){
		$disp_m = "គិតពីខែ មករា ដល់ខែ កញ្ញា ";
		$month = "'01','02','03','04','05','06','07','08','09'"; 
		}
	elseif($list=='yearly'){
		$disp_m = "ប្រចាំ";
		$month = "'01','02','03','04','05','06','07','08','09','10','11','12'"; 
		}
	

?>
<center>
<div id="table_preview" class="">
<div class="head">
	<div id="left">
		<h2>ក្រសួងសេដ្ឋកិច្ចនិងហិរញ្ញវត្ថុ</h2>
		<h2>អគ្គនាយកដ្ឋានគយ និងរដ្ឋាករកម្ពុជា</h2>
        <h3 class="cute">..................</h3>
	</div>
	<div id="right">
		<h2>ព្រះរាជាណាចក្រកម្ពុជា</h2>
		<h2>ជាតិ សាសនា ព្រះមហាក្សត្រ</h2>
        <h3 class="cute wingdings"></h3>
	</div>
</div>
<h2>តារាងសរុបលទ្ធផល ចំណូលប្រាក់ពន្ធ និង អាករគ្រប់ប្រភេទដែលប្រមូលបាន</h2>
<h2><?php echo($disp_m); ?>ឆ្នាំ <?php echo(numberKH($year)); ?></h2>
<div class="rate_"><div>(គិតជា រៀល)</div></div>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('monthly_revenues_front/'),$attr);
?>
<?php
$print=$this->input->get('print');
$tbl_print='print';
 if($print!="true"){ ?>
<div class="action_menu" style="padding-top:9px;position:fixed;top:0px;width:1340px;text-align:left;padding-left:40px;height:40px;background:#FFF;margin-top:0px auto;margin-bottom:70px;border-bottom:1px solid #ccc;">
<input type="hidden" id="datatodisplay" name="datatodisplay">  
<input type="hidden" name="excel_in_excel" value="Report_on_">  
<a class="btn btn-warning" href="<?php echo base_url('/admin/monthly_revenues_front/'); ?>" id="print_btn"><i class="icon-backward icon-white"></i>Back</a> 
<a class="btn btn-success" href="#" id="print_btn" onClick="return PrintReport();"><i class="icon-print icon-white"></i>Print Report</a> 
<a href="#" class="btn btn-primary" id="btnExport"><i class="icon-download icon-white"></i> Export as Excel</a> 
 </div>
<?php $tbl_print='';}else{ ?>
	<script>
		setTimeout(function(){window.print()}, 1000);
	</script>
<?php } ?>
<table class='table table-bordered' id="ReportTable">
    <thead>
        <tr>
			<th rowspan=4><center>លរ</center></th>
            <th rowspan=4><center>អង្គភាព<br/>គយ និងរដ្ឋាករ</center></th>
            <th rowspan=4><center>ចំនូលប្រាក់ពន្ធ<br/>និងអាករសរុប</center></th>
            <th colspan=5 rowspan="2" ><center>ចំណូលផ្សេងៗក្រៅពី អតប(VAT)</center></th>
            <th colspan=6><center>ចំណូល អតប(VAT)</center></th>
        </tr>
        <tr>
            <th colspan=4 ><center>អាចស្នើសុំឥណទានបាន</center></th>
            <th colspan=2><center>មិនអាចស្នើសុំឥណទានបាន</center></th>
        </tr>
        <tr>
            <th rowspan="2"><center>ពន្ធនាំចូល &nbsp;(CD)</center></th>
            <th rowspan="2"><center>អាករពិសេស &nbsp;(ST)</center></th>
            <th rowspan="2"><center>អាករបន្ថែម &nbsp;(AT)</center></th>
            <th rowspan="2"><center>អាករនាំចេញ &nbsp;(ET)</center></th>
            <th rowspan="2"><center>ផ្សេងៗទៀត &nbsp;(Other)</center></th>
            <th rowspan="2"><center>លើផលិតផលផ្សេងៗ <br/> ក្រៅពីតេលសិលា</center></th>
            <th colspan="2"><center>លើផលិតផល &nbsp; តេលសិលា</center></th>
            <th rowspan="2"><center>វិនិយោគផ្សេងៗ &nbsp; ក្រៅពីកាត់ដេរ</center></th>
            <th rowspan="2"><center>វិស័យកសិកម្ម</center></th>
            <th rowspan="2"><center>ផ្សេងៗ</center></th>
        </tr>
        <tr>
            <th><center>ប្រេងសាំង &nbsp;EA</center></th>
            <th style="border-right:1px solid #222;"><center>ផ្សេងទៀត</center></th>
        </tr>
    </thead>
    <tbody>
    <?php
	$count_all = 0;
	$count_cd = 0;
	$count_st = 0;
	$count_at = 0;
	$count_et = 0;
	$count_other = 0;
	$count_vop = 0;
	$count_vpp_ea = 0;
	$count_vpp_other = 0;
	$count_vop_io = 0;
	$count_vap = 0;
	$count_vat_other = 0;
	$only = "'PNH03','PNH04','KAM10','PUR10','STG10','PVG10','PNH06','SRP10','KPT10','PLN10','OMC10','CHQ08','KCH10','MKR01','PVR01','CHQ05'";
	
	$date = date("Y-m-d");
	if($this->input->get("date")){
		$date = $this->input->get("date");
		}
	$ofs=$this->m_customs->getOnlyBranch($only);
	//$ofs=$this->m_customs->getBranch();
	//echo $this->db->last_query();
	//var_dump($ofs);
	$i =0;
	foreach($ofs as $of){
		$mr = $this->m_global->select_MR_by_Branch($of->code,$month,$year);
		//$m = $mr[0];
		//var_dump($mr);
		
		$cd = (!$mr?0:$mr[0]->cd);;
		$st = (!$mr?0:$mr[0]->st);
		$at = (!$mr?0:$mr[0]->at);
		$et = (!$mr?0:$mr[0]->et);
		$other = (!$mr?0:$mr[0]->other);
		$vop = (!$mr?0:$mr[0]->vop);
		$vpp_ea = (!$mr?0:$mr[0]->vpp_ea);
		$vpp_other = (!$mr?0:$mr[0]->vpp_other);
		$vop_io = (!$mr?0:$mr[0]->vop_io);
		$vap = (!$mr?0:$mr[0]->vap);
		$vat_other = (!$mr?0:$mr[0]->vat_other);
		
		$count = $cd + $st + $at + $et + $other + $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
		$count_all = $count_all + $count;
		$count_cd = $count_cd + $cd;
		$count_st = $count_st + $st;
		$count_at = $count_at + $at;
		$count_et = $count_et + $et;
		$count_other = $count_other + $other;
		$count_vop = $count_vop + $vop;
		$count_vpp_ea = $count_vpp_ea + $vpp_ea;
		$count_vpp_other = $count_vpp_other + $vpp_other;
		$count_vop_io = $count_vop_io + $vop_io;
		$count_vap = $count_vap + $vap;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$i++;
	?>
		<tr class="">
			<td><center><?php echo($i) ?></center></td>
            <td class="td-office"><?php echo($of->name_print); ?></td>
    		<td class="td-count right_align"><?php echo(num_format($count)); ?></td>
           <td class="td-cd right_align"><span class="disp"><?php echo(num_format($cd)); ?></span></td>
           <td class="td-st right_align"><span class="disp"><?php echo(num_format($st)); ?></span></td>
           <td class="td-at right_align"><span class="disp"><?php echo(num_format($at)); ?></span></td>
           <td class="td-et right_align"><span class="disp"><?php echo(num_format($et)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-vop right_align"><span class="disp"><?php echo(num_format($vop)); ?></span></td>
           <td class="td-vpp-ea right_align"><span class="disp"><?php echo(num_format($vpp_ea)); ?></span></td>
           <td class="td-vpp-other right_align"><span class="disp"><?php echo(num_format($vpp_other)); ?></span></td>
           <td class="td-vop-io right_align"><span class="disp"><?php echo(num_format($vop_io)); ?></span></td>
           <td class="td-vap right_align"><span class="disp"><?php echo(num_format($vap)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($vat_other)); ?></span></td>
        </tr>
    <?php
		}
		
	?>
    </tbody>
    <tfoot>
    	<tr>
    		<td colspan='2' class="total"><center>សរុប</center></td>
    		<td class="td-count right_align"><?php echo(num_format($count_all )); ?></td>
           <td class="td-cd right_align"><span class="disp"><?php echo(num_format($count_cd)); ?></span></td>
           <td class="td-st right_align"><span class="disp"><?php echo(num_format($count_st)); ?></span></td>
           <td class="td-at right_align"><span class="disp"><?php echo(num_format($count_at)); ?></span></td>
           <td class="td-et right_align"><span class="disp"><?php echo(num_format($count_et)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other)); ?></span></td>
           <td class="td-vop right_align"><span class="disp"><?php echo(num_format($count_vop)); ?></span></td>
           <td class="td-vpp-ea right_align"><span class="disp"><?php echo(num_format($count_vpp_ea)); ?></span></td>
           <td class="td-vpp-other right_align"><span class="disp"><?php echo(num_format($count_vpp_other)); ?></span></td>
           <td class="td-vop-io right_align"><span class="disp"><?php echo(num_format($count_vop_io)); ?></span></td>
           <td class="td-vap right_align"><span class="disp"><?php echo(num_format($count_vap)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other)); ?></span></td>
    	</tr>
    </tfoot>
</table>

</form>
<div class='clear'></div>

<div id="footer-signature">
	<div id="left">
		<center>បានឃើញ</center>
		<h2><center>អគ្គនាយក</center></h2>
		<h2><center>អគ្គនាយកដ្ឋានគយ និងរដ្ឋាករកម្ពុជា</center></h2>
	</div>
	<div id="right">
		<center>រាជធានីភ្នំពេញ.ថ្ងៃទី&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ខែ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ឆ្នាំ <?php echo numberKH($year); ?></center>
		<h2><center>អ្នកធ្វើតារាង</center></h2>
		<h2 style='margin-top:60px;padding-left:50px;'><center>ម៉ម កុសល</center></h2>
	</div>
</div>

</div>
</center>
<style>
.rate_{
	margin:-20px 0px 5px 0px;
	height:18px;
	}
.rate_ div{
	font-family: KHMER MEF1;
	width:300px;
	float:right;
	text-align:left;
	}
h3.cute{
	margin:0px;
	padding:0px;
	margin-top:-5px;
	height:20px;
	overflow:hidden;
	line-height:20px;
	font-size:20px;
	color:#222;
	}
h3.cute.wingdings{
	margin-top:-5px;
	font-family:Wingdings;
	}
body {
    background: #F0F0F0;
    font-family: Arial;
    font-size: 12px;
    text-shadow: none;
    padding: 0px;
}
#footer-signature {
	font-family: KHMER MEF1;
}
.tbl {
    width: 95%;
    font-family: KHMER MEF1;
}
div.action_menu {
    display: block;
}
#table_preview{
	background: #FFF;
    width: 1380px;
    padding-top: 70px;
    padding-bottom: 20px;
}
a.btn.btn-primary.btn-sm.pull-right{
	font-size:14px;
	margin-bottom:10px;
}

table, table#ReportTable{
	border:1px solid #222 !important;
	border-collapse:collapse;
	margin-bottom:10px !important;
	width: 1340px;
    font-family: KHMER MEF1;
	}
#ReportTable thead th{
	font-family: KHMER MEF2;
	vertical-align:middle;
}
h2{
	font-family: KHMER MEF2;
	
	color:#222;
	font-size:14px;
}
   #ReportTable th{
	  border:1px solid #222;
	  border-collapse:collapse;
	  line-height:1.5;
	  font-size:10px;
	  
  }
  #ReportTable td{
	  border:1px solid #222;
	  border-collapse:collapse;
	  line-height:0.5;
	  font-size:10px;
	  vertical-align: middle;
  }
#ReportTable td.td-office{
	font-size:9px;
	line-height:1;
}
*{
	color:#222;
}
.right_align{
	text-align:right !important;
}
#ReportTable td.total{
	font-family: KHMER MEF2;
}
#ReportTable thead tr{
	
}
.head{
	
}
.head #right{
	float:right;
	width:350px;
	margin-top:-50px;
}
.head #left{
	float:left;
	width:400px;
	margin-top:-50px;
}

#footer-signature{
	display:block;
	height:150px;
}
#footer-signature #left{
	float: left;
	width: 400px;
}

#footer-signature #right{
	float: right;
	width: 400px;
}
form{
	margin-bottom:10px;
}

</style>
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
</script>

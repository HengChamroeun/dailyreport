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
<h2>តារាងសរុបលទ្ធផល ចំណូលប្រាក់ពន្ធ និង អាករគ្រប់ប្រភេទជាបន្ទុករដ្ឋ</h2>
<h2><?php echo($disp_m); ?>ឆ្នាំ <?php echo(numberKH($year)); ?></h2>
<div class="rate_"><div>(គិតជា រៀល)</div></div>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('monthly_revenues_b/'),$attr);
?>
<?php
$print=$this->input->get('print');
$tbl_print='print';
 if($print!="true"){ ?>
<div class="action_menu" style="padding-top:9px;position:fixed;top:0px;width:1220px;text-align:left;padding-left:40px;height:40px;background:#FFF;margin-top:0px auto;margin-bottom:70px;border-bottom:1px solid #ccc;">
<input type="hidden" id="datatodisplay" name="datatodisplay">  
<input type="hidden" name="excel_in_excel" value="Report_on_">  
<a class="btn btn-warning" href="<?php echo base_url('/admin/monthly_revenues_b_front/'); ?>" id="print_btn"><i class="icon-backward icon-white"></i>Back</a> 
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
			<th rowspan=2><center>លរ</center></th>
            <th rowspan=2><center>អង្គភាព</center></th>
            <th rowspan=2><center>ចំនូលប្រាក់ពន្ធ<br/>និងអាករសរុប</center></th>
            <th rowspan="2" ><center>ចំណូលផ្សេងៗក្រៅពី <br/> អតប (VAT)</center></th>
            <th colspan=4><center>ចំណូល អតប (VAT)</center></th>
        </tr>
        <tr>
            <th><center>សរុប</center></th>
            <th><center>វិនិយោគកាត់ដេរ</center></th>
            <th><center>អង្គការនិងស្ថានទូត</center></th>
            <th><center>ផ្សេងៗ</center></th>
        </tr>
    </thead>
    <tbody>
    <?php
	$count_all = 0;
	$count_other_rev = 0;
	$count_total_vat = 0;
	$count_vat_gio = 0;
	$count_vat_ngoemb = 0;
	$count_vat_other = 0;
	$only = "'SHV11','PNH05','PNH14','CHQ06','BMC10','IAP10','PNH02','TKM10','KPC10','SHV10','KKG10','TAK10','KDL10','SVR10','BAT10','KRT10','RAT01'";
	
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
		$mr = $this->m_global->select_MRB_by_Branch($of->code,$month,$year);
		//$m = $mr[0];
		//var_dump($mr);
		
		$other_rev = (!$mr?0:$mr[0]->other_rev);
		$vat_gio = (!$mr?0:$mr[0]->vat_gio);
		$vat_ngoemb = (!$mr?0:$mr[0]->vat_ngoemb);
		$vat_other = (!$mr?0:$mr[0]->vat_other);
		
		$total_vat = $vat_gio+$vat_ngoemb+$vat_other;
		$count = $other_rev+$total_vat;
		
		$count_all = $count_all + $count;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$i++;
	?>
		<tr class="">
			<td><center><?php echo($i) ?></center></td>
           <td class="td-office"><?php echo($of->name); ?></td>
    		<td class="td-count right_align"><?php echo(num_format($count)) ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(num_format($total_vat)) ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_other)); ?></span></td>
        </tr>
    <?php
		}
		$mr_oo = $this->m_customs->getMRBOO($only,$year,$month);
		//var_dump($mr_oo);
		$other_rev_oo = (!$mr_oo?0:$mr_oo[0]->other_rev);
		$vat_gio_oo = (!$mr_oo?0:$mr_oo[0]->vat_gio);
		$vat_ngoemb_oo = (!$mr_oo?0:$mr_oo[0]->vat_ngoemb);
		$vat_other_oo = (!$mr_oo?0:$mr_oo[0]->vat_other);
		$total_vat_oo = $vat_gio_oo+$vat_ngoemb_oo+$vat_other_oo;
		$count_oo = $other_rev_oo+$total_vat_oo;
	?>
		<tr class="">
			<td><center><?php echo($i+1) ?></center></td>
           <td class="td-office">នាយកដ្ឋាន សាខា. ការិយាល័យផ្សេងៗ</td>
    		<td class="td-count right_align"><?php echo(num_format($count_oo)) ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$mr_oo?'0':num_format($mr_oo[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(num_format($total_vat_oo)) ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$mr_oo?'0':num_format($mr_oo[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$mr_oo?'0':num_format($mr_oo[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$mr_oo?'0':num_format($mr_oo[0]->vat_other)); ?></span></td>
        </tr>
    </tbody>
    <tfoot>
    	<tr>
    		<td colspan='2' class="total"><center>សរុប</center></td>
    		<td id="count-all" class="right_align"><?php echo num_format($count_all + $count_oo); ?></td>
           <td id="count-other-rev" class="right_align"><?php echo num_format($count_other_rev + $other_rev_oo); ?></td>
           <td id="count-total-vat" class="right_align"><?php echo num_format($count_total_vat + $total_vat_oo); ?></td>
           <td id="count-vat-gio" class="right_align"><?php echo num_format($count_vat_gio + $vat_gio_oo); ?></td>
           <td id="count-vat-ngoemb" class="right_align"><?php echo num_format($count_vat_ngoemb + $vat_ngoemb_oo); ?></td>
           <td id="count-vat-other" class="right_align"><?php echo num_format($count_vat_other + $vat_other_oo); ?></td>
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
    font-size: 15px;
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
    width: 1260px;
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
	width: 1220px;
    font-family: KHMER MEF1;
	}
#ReportTable thead th{
	font-family: KHMER MEF2;
	vertical-align:middle;
}
h2{
	font-family: KHMER MEF2;
	
	color:#222;
	font-size:17px;
}
   #ReportTable th{
	  border:1px solid #222;
	  border-collapse:collapse;
	  line-height:1.5;
	  font-size:14px;
  }
  #ReportTable td{
	  border:1px solid #222;
	  border-collapse:collapse;
	  line-height:0.5;
	  font-size:14px;
  }
.td-office{
	font-size:14px;
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

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
<h2>តារាងតាមដាន ប្រាក់ពន្ធ និងអាករជាបន្ទុករដ្ឋ</h2>
<h2><?php echo($disp_m); ?>ឆ្នាំ <?php echo(numberKH($year)); ?></h2>
<div class="rate_"><div>(គិតជា រៀល)</div></div>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('monthly_revenues_b_front/'),$attr);
?>
<?php
$print=$this->input->get('print');
$tbl_print='print';
 if($print!="true"){ ?>
<div class="action_menu" style="padding-top:9px;position:fixed;top:0px;width:1320px;text-align:left;padding-left:40px;height:40px;background:#FFF;margin-top:0px auto;margin-bottom:70px;border-bottom:1px solid #ccc;">
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
            <th  ><center>អង្គភាព<br/>គយ និងរដ្ឋាករ</center></th>
            <th ><center>អង្គការ</center></th>
            <th ><center>ស្ថានទូត</center></th>
            <th ><center>វិនិយោគកាត់ដេរ</center></th>
            <th ><center>វិនិយោគផ្សេងៗ</center></th>
            <th ><center>នាំចេញ</center></th>
            <th ><center>ជំនួយ</center></th>
            <th ><center>នាំចូល<br />បណ្តោះអាសន្ន</center></th>
            <th ><center>បុគ្គល-ក្រសួង</center></th>
            <th ><center>ផ្សេងៗ</center></th>
            <th ><center>សរុប</center></th>
        </tr>
    </thead>
    <tbody>
    <?php
	$count_all = 0;
	$count_ngo = 0;
	$count_emb = 0;
	$count_gio = 0;
	$count_oio = 0;
	$count_exp = 0;
	$count_aid = 0;
	$count_ata = 0;
	$count_p_min = 0;
	$count_other = 0;
	$count = 0;
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
		$mr = $this->m_global->select_TMRB_by_Branch($of->code,$month,$year);
		//$m = $mr[0];
		//var_dump($mr);
		
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		
		$count = $ngo + $emb + $gio + $oio + $exp + $aid + $ata + $p_min +$other;
		
		$count_all = $count_all + $count;
		$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		
		$i++;
	?>
		<tr class="">
			<td><center><?php echo($i) ?></center></td>
           <td class="td-office fixed-col"><?php echo($of->name_print); ?></td>
           <td class="td-ngo"><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count"><?php echo(num_format($count)); ?></td>
        </tr>
    <?php
		}
		$mr_oo = $this->m_customs->getTMRBOO($only,$year,$month);
		//var_dump($mr_oo);
		$ngo_oo = (!$mr_oo?0:$mr_oo[0]->ngo);
		$emb_oo = (!$mr_oo?0:$mr_oo[0]->emb);
		$gio_oo = (!$mr_oo?0:$mr_oo[0]->gio);
		$oio_oo = (!$mr_oo?0:$mr_oo[0]->oio);
		$exp_oo = (!$mr_oo?0:$mr_oo[0]->exp);
		$aid_oo = (!$mr_oo?0:$mr_oo[0]->aid);
		$ata_oo = (!$mr_oo?0:$mr_oo[0]->ata);
		$p_min_oo = (!$mr_oo?0:$mr_oo[0]->p_min);
		$other_oo = (!$mr_oo?0:$mr_oo[0]->other);
		
		$count_oo = $ngo_oo + $emb_oo + $gio_oo + $oio_oo + $exp_oo + $aid_oo + $ata_oo + $p_min_oo +$other_oo;
		
	?>
		<tr class="">
			<td><center><?php echo($i+1) ?></center></td>
           <td class="td-office" style="font-size:10px">នាយកដ្ឋាន សាខា. ការិយាល័យផ្សេងៗ</td>
    		<td class="td-ngo"><span class="disp"><?php echo(num_format($ngo_oo)); ?></span></td>
           <td class="td-emb"><span class="disp"><?php echo(num_format($emb_oo)); ?></span></td>
           <td class="td-gio"><span class="disp"><?php echo(num_format($gio_oo)); ?></span></td>
           <td class="td-oio"><span class="disp"><?php echo(num_format($oio_oo)); ?></span></td>
           <td class="td-exp"><span class="disp"><?php echo(num_format($exp_oo)); ?></span></td>
           <td class="td-aid"><span class="disp"><?php echo(num_format($aid_oo)); ?></span></td>
           <td class="td-ata"><span class="disp"><?php echo(num_format($ata_oo)); ?></span></td>
           <td class="td-p-min"><span class="disp"><?php echo(num_format($p_min_oo)); ?></span></td>
           <td class="td-other"><span class="disp"><?php echo(num_format($other_oo)); ?></span></td>
           <td class="td-count"><?php echo(num_format($count_oo)); ?></td>
        </tr>
    </tbody>
    <tfoot>
    	<tr>
    		<td colspan='2' class="total"><center>សរុប</center></td>
    		<td class="td-ngo"><span class="disp"><?php echo(num_format($count_ngo+$ngo_oo)); ?></span></td>
           <td class="td-emb"><span class="disp"><?php echo(num_format($count_emb+$emb_oo)); ?></span></td>
           <td class="td-gio"><span class="disp"><?php echo(num_format($count_gio+$gio_oo)); ?></span></td>
           <td class="td-oio"><span class="disp"><?php echo(num_format($count_oio+$oio_oo)); ?></span></td>
           <td class="td-exp"><span class="disp"><?php echo(num_format($count_exp+$exp_oo)); ?></span></td>
           <td class="td-aid"><span class="disp"><?php echo(num_format($count_aid+$aid_oo)); ?></span></td>
           <td class="td-ata"><span class="disp"><?php echo(num_format($count_ata+$ata_oo)); ?></span></td>
           <td class="td-p-min"><span class="disp"><?php echo(num_format($count_p_min+$p_min_oo)); ?></span></td>
           <td class="td-other"><span class="disp"><?php echo(num_format($count_other+$other_oo)); ?></span></td>
           <td class="td-count"><?php echo(num_format($count_all+$count_oo)); ?></td>
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
    width: 1360px;
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
	width: 1320px;
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
	  font-size:12px;
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

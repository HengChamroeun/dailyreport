<?php 	
//$items = $this->m_global->select_data(TBLITEMS,NULL,array('id'=>'ASC'),0);


$year = date('Y');
if($this->input->get('y')){
	$year = $this->input->get('y');
	}

$last_month = $this->m_customs->getLastMonthTMRB($year);
$last_month = ($last_month<10?"0".$last_month:$last_month);
$month = $last_month;
if($this->input->get('m')){
	$month = $this->input->get('m');
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
<h2>គិតពីខែ មករា ដល់ខែ <?php echo month_kh($month); ?> ឆ្នាំ <?php echo numberKH($year); ?></h2>
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
            <th colspan=7><center>ចំណូល អតប(VAT)</center></th>
        </tr>
        <tr>
            <th colspan=4 ><center>អាចស្នើសុំឥណទានបាន</center></th>
            <th colspan=2><center>មិនអាចស្នើសុំឥណទានបាន</center></th>
			<th rowspan=3><center>សរុប(VAT)</center></th>
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
		$count = 0;
		$count_total_vat = 0;
		
		$count_all_q1 = 0;
		$count_cd_q1 = 0;
		$count_st_q1 = 0;
		$count_at_q1 = 0;
		$count_et_q1 = 0;
		$count_other_q1 = 0;
		$count_vop_q1 = 0;
		$count_vpp_ea_q1 = 0;
		$count_vpp_other_q1 = 0;
		$count_vop_io_q1 = 0;
		$count_vap_q1 = 0;
		$count_vat_other_q1 = 0;
		$count_q1 = 0;
		$count_total_vat_q1 = 0;
		
		$count_all_q2 = 0;
		$count_cd_q2 = 0;
		$count_st_q2 = 0;
		$count_at_q2 = 0;
		$count_et_q2 = 0;
		$count_other_q2 = 0;
		$count_vop_q2 = 0;
		$count_vpp_ea_q2 = 0;
		$count_vpp_other_q2 = 0;
		$count_vop_io_q2 = 0;
		$count_vap_q2 = 0;
		$count_vat_other_q2 = 0;
		$count_q2 = 0;
		$count_total_vat_q2 = 0;
		
		$count_all_q3 = 0;
		$count_cd_q3 = 0;
		$count_st_q3 = 0;
		$count_at_q3 = 0;
		$count_et_q3 = 0;
		$count_other_q3 = 0;
		$count_vop_q3 = 0;
		$count_vpp_ea_q3 = 0;
		$count_vpp_other_q3 = 0;
		$count_vop_io_q3 = 0;
		$count_vap_q3 = 0;
		$count_vat_other_q3 = 0;
		$count_q3 = 0;
		$count_total_vat_q3 = 0;
		
		$count_all_q4 = 0;
		$count_cd_q4 = 0;
		$count_st_q4 = 0;
		$count_at_q4 = 0;
		$count_et_q4 = 0;
		$count_other_q4 = 0;
		$count_vop_q4 = 0;
		$count_vpp_ea_q4 = 0;
		$count_vpp_other_q4 = 0;
		$count_vop_io_q4 = 0;
		$count_vap_q4 = 0;
		$count_vat_other_q4 = 0;
		$count_q4 = 0;
		$count_total_vat_q4 = 0;
		
		$count_all_h1 = 0;
		$count_cd_h1 = 0;
		$count_st_h1 = 0;
		$count_at_h1 = 0;
		$count_et_h1 = 0;
		$count_other_h1 = 0;
		$count_vop_h1 = 0;
		$count_vpp_ea_h1 = 0;
		$count_vpp_other_h1 = 0;
		$count_vop_io_h1 = 0;
		$count_vap_h1 = 0;
		$count_vat_other_h1 = 0;
		$count_h1 = 0;
		$count_total_vat_h1 = 0;
		
		$count_all_h2 = 0;
		$count_cd_h2 = 0;
		$count_st_h2 = 0;
		$count_at_h2 = 0;
		$count_et_h2 = 0;
		$count_other_h2 = 0;
		$count_vop_h2 = 0;
		$count_vpp_ea_h2 = 0;
		$count_vpp_other_h2 = 0;
		$count_vop_io_h2 = 0;
		$count_vap_h2 = 0;
		$count_vat_other_h2 = 0;
		$count_h2 = 0;
		$count_total_vat_h2 = 0;
		
?>
<?php
		$mr = $JANUARY;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		
		$count_cd_q1 = $count_cd_q1 + $cd;
		$count_st_q1 = $count_st_q1 + $st;
		$count_at_q1 = $count_at_q1 + $at;
		$count_et_q1 = $count_et_q1 + $et;
		$count_other_q1 = $count_other_q1 + $other;
		$count_vop_q1 = $count_vop_q1 + $vop;
		$count_vpp_ea_q1 = $count_vpp_ea_q1 + $vpp_ea;
		$count_vpp_other_q1 = $count_vpp_other_q1 + $vpp_other;
		$count_vop_io_q1 = $count_vop_io_q1 + $vop_io;
		$count_vap_q1 = $count_vap_q1 + $vap;
		$count_vat_other_q1 = $count_vat_other_q1 + $vat_other;
		$count_total_vat_q1 = $count_total_vat_q1 + $total_vat;
		$count_all_q1 = $count_all_q1 + $count;
		
		
	?>
		<tr class="">
			<td class="right_align">1</td>
           <td class="td-office">មករា</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		//var_dump($FEBRUARY);
		$mr = $FEBRUARY;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q1 = $count_cd_q1 + $cd;
		$count_st_q1 = $count_st_q1 + $st;
		$count_at_q1 = $count_at_q1 + $at;
		$count_et_q1 = $count_et_q1 + $et;
		$count_other_q1 = $count_other_q1 + $other;
		$count_vop_q1 = $count_vop_q1 + $vop;
		$count_vpp_ea_q1 = $count_vpp_ea_q1 + $vpp_ea;
		$count_vpp_other_q1 = $count_vpp_other_q1 + $vpp_other;
		$count_vop_io_q1 = $count_vop_io_q1 + $vop_io;
		$count_vap_q1 = $count_vap_q1 + $vap;
		$count_vat_other_q1 = $count_vat_other_q1 + $vat_other;
		$count_total_vat_q1 = $count_total_vat_q1 + $total_vat;
		$count_all_q1 = $count_all_q1 + $count;
		
	?>
		<tr class="">
			<td class="right_align">2</td>
           <td class="td-office">កម្ភៈ</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		$mr = $MARCH;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q1 = $count_cd_q1 + $cd;
		$count_st_q1 = $count_st_q1 + $st;
		$count_at_q1 = $count_at_q1 + $at;
		$count_et_q1 = $count_et_q1 + $et;
		$count_other_q1 = $count_other_q1 + $other;
		$count_vop_q1 = $count_vop_q1 + $vop;
		$count_vpp_ea_q1 = $count_vpp_ea_q1 + $vpp_ea;
		$count_vpp_other_q1 = $count_vpp_other_q1 + $vpp_other;
		$count_vop_io_q1 = $count_vop_io_q1 + $vop_io;
		$count_vap_q1 = $count_vap_q1 + $vap;
		$count_vat_other_q1 = $count_vat_other_q1 + $vat_other;
		$count_total_vat_q1 = $count_total_vat_q1 + $total_vat;
		$count_all_q1 = $count_all_q1 + $count;
		
	?>
		<tr class="">
			<td class="right_align">3</td>
           <td class="td-office">មីនា</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		
		
	?>
		<tr class="quarter">
           <td class="name" colspan='2'><center>ត្រីមាសទី១</center></td>
    	   <td class="td-count right_align"><?php echo(num_format($count_all_q1)); ?></td>
           <td class="td-cd right_align"><span class="disp"><?php echo(num_format($count_cd_q1)); ?></span></td>
           <td class="td-st right_align"><span class="disp"><?php echo(num_format($count_st_q1)); ?></span></td>
           <td class="td-at right_align"><span class="disp"><?php echo(num_format($count_at_q1)); ?></span></td>
           <td class="td-et right_align"><span class="disp"><?php echo(num_format($count_et_q1)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_q1)); ?></span></td>
           <td class="td-vop right_align"><span class="disp"><?php echo(num_format($count_vop_q1)); ?></span></td>
           <td class="td-vpp-ea right_align"><span class="disp"><?php echo(num_format($count_vpp_ea_q1)); ?></span></td>
           <td class="td-vpp-other right_align"><span class="disp"><?php echo(num_format($count_vpp_other_q1)); ?></span></td>
           <td class="td-vop-io right_align"><span class="disp"><?php echo(num_format($count_vop_io_q1)); ?></span></td>
           <td class="td-vap right_align"><span class="disp"><?php echo(num_format($count_vap_q1)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_q1)); ?></span></td>
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($count_total_vat_q1)); ?></span></td>
        </tr>
		<?php
		$mr = $APRIL;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q2 = $count_cd_q2 + $cd;
		$count_st_q2 = $count_st_q2 + $st;
		$count_at_q2 = $count_at_q2 + $at;
		$count_et_q2 = $count_et_q2 + $et;
		$count_other_q2 = $count_other_q2 + $other;
		$count_vop_q2 = $count_vop_q2 + $vop;
		$count_vpp_ea_q2 = $count_vpp_ea_q2 + $vpp_ea;
		$count_vpp_other_q2 = $count_vpp_other_q2 + $vpp_other;
		$count_vop_io_q2 = $count_vop_io_q2 + $vop_io;
		$count_vap_q2 = $count_vap_q2 + $vap;
		$count_vat_other_q2 = $count_vat_other_q2 + $vat_other;
		$count_total_vat_q2 = $count_total_vat_q2 + $total_vat;
		$count_all_q2 = $count_all_q2 + $count;
		
	?>
		<tr class="">
			<td class="right_align">4</td>
           <td class="td-office">មេសា</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		$mr = $MAY;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q2 = $count_cd_q2 + $cd;
		$count_st_q2 = $count_st_q2 + $st;
		$count_at_q2 = $count_at_q2 + $at;
		$count_et_q2 = $count_et_q2 + $et;
		$count_other_q2 = $count_other_q2 + $other;
		$count_vop_q2 = $count_vop_q2 + $vop;
		$count_vpp_ea_q2 = $count_vpp_ea_q2 + $vpp_ea;
		$count_vpp_other_q2 = $count_vpp_other_q2 + $vpp_other;
		$count_vop_io_q2 = $count_vop_io_q2 + $vop_io;
		$count_vap_q2 = $count_vap_q2 + $vap;
		$count_vat_other_q2 = $count_vat_other_q2 + $vat_other;
		$count_total_vat_q2 = $count_total_vat_q2 + $total_vat;
		$count_all_q2 = $count_all_q2 + $count;
		
	?>
		<tr class="">
			<td class="right_align">5</td>
           <td class="td-office">ឧសភា</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		$mr = $JUNE;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q2 = $count_cd_q2 + $cd;
		$count_st_q2 = $count_st_q2 + $st;
		$count_at_q2 = $count_at_q2 + $at;
		$count_et_q2 = $count_et_q2 + $et;
		$count_other_q2 = $count_other_q2 + $other;
		$count_vop_q2 = $count_vop_q2 + $vop;
		$count_vpp_ea_q2 = $count_vpp_ea_q2 + $vpp_ea;
		$count_vpp_other_q2 = $count_vpp_other_q2 + $vpp_other;
		$count_vop_io_q2 = $count_vop_io_q2 + $vop_io;
		$count_vap_q2 = $count_vap_q2 + $vap;
		$count_vat_other_q2 = $count_vat_other_q2 + $vat_other;
		$count_total_vat_q2 = $count_total_vat_q2 + $total_vat;
		$count_all_q2 = $count_all_q2 + $count;
		
	?>
		<tr class="">
			<td class="right_align">6</td>
           <td class="td-office">មិថុនា</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php

		
		
	?>
		<tr class="quarter">
           <td class="name" colspan='2'><center>ត្រីមាសទី២</center></td>
    	 <td class="td-count right_align"><?php echo(num_format($count_all_q2)); ?></td>
           <td class="td-cd right_align"><span class="disp"><?php echo(num_format($count_cd_q2)); ?></span></td>
           <td class="td-st right_align"><span class="disp"><?php echo(num_format($count_st_q2)); ?></span></td>
           <td class="td-at right_align"><span class="disp"><?php echo(num_format($count_at_q2)); ?></span></td>
           <td class="td-et right_align"><span class="disp"><?php echo(num_format($count_et_q2)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_q2)); ?></span></td>
           <td class="td-vop right_align"><span class="disp"><?php echo(num_format($count_vop_q2)); ?></span></td>
           <td class="td-vpp-ea right_align"><span class="disp"><?php echo(num_format($count_vpp_ea_q2)); ?></span></td>
           <td class="td-vpp-other right_align"><span class="disp"><?php echo(num_format($count_vpp_other_q2)); ?></span></td>
           <td class="td-vop-io right_align"><span class="disp"><?php echo(num_format($count_vop_io_q2)); ?></span></td>
           <td class="td-vap right_align"><span class="disp"><?php echo(num_format($count_vap_q2)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_q2)); ?></span></td>
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($count_total_vat_q2)); ?></span></td>
        </tr>
		<?php

		$count_cd_h1 = $count_cd_q1 + $count_cd_q2;
		$count_st_h1 = $count_st_q1 + $count_st_q2;
		$count_at_h1 = $count_at_q1 + $count_at_q2;
		$count_et_h1 = $count_et_q1 + $count_et_q2;
		$count_other_h1 = $count_other_q1 + $count_other_q2;
		$count_vop_h1 = $count_vop_q1 + $count_vop_q2;
		$count_vpp_ea_h1 = $count_vpp_ea_q1 + $count_vpp_ea_q2;
		$count_vpp_other_h1 = $count_vpp_other_q1 + $count_vpp_other_q2;
		$count_vop_io_h1 = $count_vop_io_q1 + $count_vop_io_q2;
		$count_vap_h1 = $count_vap_q1 + $count_vap_q2;
		$count_vat_other_h1 = $count_vat_other_q1 + $count_vat_other_q2;
		$count_total_vat_h1 = $count_total_vat_q1 + $count_total_vat_q2;
		$count_all_h1 = $count_all_q1 + $count_all_q2;
		
		
	?>
		<tr class="halfyear">
           <td class="td-office" colspan='2'><center>ឆមាសទី១</center></td>
    		<td class="td-count right_align"><?php echo(num_format($count_all_h1)); ?></td>
           <td class="td-cd right_align"><span class="disp"><?php echo(num_format($count_cd_h1)); ?></span></td>
           <td class="td-st right_align"><span class="disp"><?php echo(num_format($count_st_h1)); ?></span></td>
           <td class="td-at right_align"><span class="disp"><?php echo(num_format($count_at_h1)); ?></span></td>
           <td class="td-et right_align"><span class="disp"><?php echo(num_format($count_et_h1)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_h1)); ?></span></td>
           <td class="td-vop right_align"><span class="disp"><?php echo(num_format($count_vop_h1)); ?></span></td>
           <td class="td-vpp-ea right_align"><span class="disp"><?php echo(num_format($count_vpp_ea_h1)); ?></span></td>
           <td class="td-vpp-other right_align"><span class="disp"><?php echo(num_format($count_vpp_other_h1)); ?></span></td>
           <td class="td-vop-io right_align"><span class="disp"><?php echo(num_format($count_vop_io_h1)); ?></span></td>
           <td class="td-vap right_align"><span class="disp"><?php echo(num_format($count_vap_h1)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_h1)); ?></span></td>
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($count_total_vat_h1)); ?></span></td>
        </tr>
		<?php
		$mr = $JULY;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q3 = $count_cd_q3 + $cd;
		$count_st_q3 = $count_st_q3 + $st;
		$count_at_q3 = $count_at_q3 + $at;
		$count_et_q3 = $count_et_q3 + $et;
		$count_other_q3 = $count_other_q3 + $other;
		$count_vop_q3 = $count_vop_q3 + $vop;
		$count_vpp_ea_q3 = $count_vpp_ea_q3 + $vpp_ea;
		$count_vpp_other_q3 = $count_vpp_other_q3 + $vpp_other;
		$count_vop_io_q3 = $count_vop_io_q3 + $vop_io;
		$count_vap_q3 = $count_vap_q3 + $vap;
		$count_vat_other_q3 = $count_vat_other_q3 + $vat_other;
		$count_total_vat_q3 = $count_total_vat_q3 + $total_vat;
		$count_all_q3 = $count_all_q3 + $count;
		
	?>
		<tr class="">
			<td class="right_align">7</td>
           <td class="td-office">កក្កដា</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		$mr = $AUGUST;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q3 = $count_cd_q3 + $cd;
		$count_st_q3 = $count_st_q3 + $st;
		$count_at_q3 = $count_at_q3 + $at;
		$count_et_q3 = $count_et_q3 + $et;
		$count_other_q3 = $count_other_q3 + $other;
		$count_vop_q3 = $count_vop_q3 + $vop;
		$count_vpp_ea_q3 = $count_vpp_ea_q3 + $vpp_ea;
		$count_vpp_other_q3 = $count_vpp_other_q3 + $vpp_other;
		$count_vop_io_q3 = $count_vop_io_q3 + $vop_io;
		$count_vap_q3 = $count_vap_q3 + $vap;
		$count_vat_other_q3 = $count_vat_other_q3 + $vat_other;
		$count_total_vat_q3 = $count_total_vat_q3 + $total_vat;
		$count_all_q3 = $count_all_q3 + $count;
		
	?>
		<tr class="">
			<td class="right_align">8</td>
           <td class="td-office">សីហា</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		$mr = $SEPTEMBER;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q3 = $count_cd_q3 + $cd;
		$count_st_q3 = $count_st_q3 + $st;
		$count_at_q3 = $count_at_q3 + $at;
		$count_et_q3 = $count_et_q3 + $et;
		$count_other_q3 = $count_other_q3 + $other;
		$count_vop_q3 = $count_vop_q3 + $vop;
		$count_vpp_ea_q3 = $count_vpp_ea_q3 + $vpp_ea;
		$count_vpp_other_q3 = $count_vpp_other_q3 + $vpp_other;
		$count_vop_io_q3 = $count_vop_io_q3 + $vop_io;
		$count_vap_q3 = $count_vap_q3 + $vap;
		$count_vat_other_q3 = $count_vat_other_q3 + $vat_other;
		$count_total_vat_q3 = $count_total_vat_q3 + $total_vat;
		$count_all_q3 = $count_all_q3 + $count;
		
	?>
		<tr class="">
			<td class="right_align">9</td>
           <td class="td-office">កញ្ញា</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		
	?>
		<tr class="quarter">
           <td class="name" colspan='2'><center>ត្រីមាសទី៣</center></td>
    		<td class="td-count right_align"><?php echo(num_format($count_all_q3)); ?></td>
           <td class="td-cd right_align"><span class="disp"><?php echo(num_format($count_cd_q3)); ?></span></td>
           <td class="td-st right_align"><span class="disp"><?php echo(num_format($count_st_q3)); ?></span></td>
           <td class="td-at right_align"><span class="disp"><?php echo(num_format($count_at_q3)); ?></span></td>
           <td class="td-et right_align"><span class="disp"><?php echo(num_format($count_et_q3)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_q3)); ?></span></td>
           <td class="td-vop right_align"><span class="disp"><?php echo(num_format($count_vop_q3)); ?></span></td>
           <td class="td-vpp-ea right_align"><span class="disp"><?php echo(num_format($count_vpp_ea_q3)); ?></span></td>
           <td class="td-vpp-other right_align"><span class="disp"><?php echo(num_format($count_vpp_other_q3)); ?></span></td>
           <td class="td-vop-io right_align"><span class="disp"><?php echo(num_format($count_vop_io_q3)); ?></span></td>
           <td class="td-vap right_align"><span class="disp"><?php echo(num_format($count_vap_q3)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_q3)); ?></span></td>
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($count_total_vat_q3)); ?></span></td>
        </tr>
		<?php
		$mr = $OCTOBER;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q4 = $count_cd_q4 + $cd;
		$count_st_q4 = $count_st_q4 + $st;
		$count_at_q4 = $count_at_q4 + $at;
		$count_et_q4 = $count_et_q4 + $et;
		$count_other_q4 = $count_other_q4 + $other;
		$count_vop_q4 = $count_vop_q4 + $vop;
		$count_vpp_ea_q4 = $count_vpp_ea_q4 + $vpp_ea;
		$count_vpp_other_q4 = $count_vpp_other_q4 + $vpp_other;
		$count_vop_io_q4 = $count_vop_io_q4 + $vop_io;
		$count_vap_q4 = $count_vap_q4 + $vap;
		$count_vat_other_q4 = $count_vat_other_q4 + $vat_other;
		$count_total_vat_q4 = $count_total_vat_q4 + $total_vat;
		$count_all_q4 = $count_all_q4 + $count;
		
	?>
		<tr class="">
			<td class="right_align">10</td>
           <td class="td-office">តុលា</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		$mr = $NOVEMBER;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q4 = $count_cd_q4 + $cd;
		$count_st_q4 = $count_st_q4 + $st;
		$count_at_q4 = $count_at_q4 + $at;
		$count_et_q4 = $count_et_q4 + $et;
		$count_other_q4 = $count_other_q4 + $other;
		$count_vop_q4 = $count_vop_q4 + $vop;
		$count_vpp_ea_q4 = $count_vpp_ea_q4 + $vpp_ea;
		$count_vpp_other_q4 = $count_vpp_other_q4 + $vpp_other;
		$count_vop_io_q4 = $count_vop_io_q4 + $vop_io;
		$count_vap_q4 = $count_vap_q4 + $vap;
		$count_vat_other_q4 = $count_vat_other_q4 + $vat_other;
		$count_total_vat_q4 = $count_total_vat_q4 + $total_vat;
		$count_all_q4 = $count_all_q4 + $count;
		
	?>
		<tr class="">
			<td class="right_align">11</td>
           <td class="td-office">វិច្ឆិកា</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		$mr = $DECEMBER;
		$cd = (!$mr?0:$mr[0]->cd);
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
		$count = (!$mr?0:$mr[0]->cnt);
		
		$total_vat = $vop + $vpp_ea + $vpp_other + $vop_io + $vap + $vat_other;
		
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
		$count_total_vat = $count_total_vat + $total_vat;

		
		$count_cd_q4 = $count_cd_q4 + $cd;
		$count_st_q4 = $count_st_q4 + $st;
		$count_at_q4 = $count_at_q4 + $at;
		$count_et_q4 = $count_et_q4 + $et;
		$count_other_q4 = $count_other_q4 + $other;
		$count_vop_q4 = $count_vop_q4 + $vop;
		$count_vpp_ea_q4 = $count_vpp_ea_q4 + $vpp_ea;
		$count_vpp_other_q4 = $count_vpp_other_q4 + $vpp_other;
		$count_vop_io_q4 = $count_vop_io_q4 + $vop_io;
		$count_vap_q4 = $count_vap_q4 + $vap;
		$count_vat_other_q4 = $count_vat_other_q4 + $vat_other;
		$count_total_vat_q4 = $count_total_vat_q4 + $total_vat;
		$count_all_q4 = $count_all_q4 + $count;

		
	?>
		<tr class="">
			<td class="right_align">12</td>
           <td class="td-office">ធ្នូ</td>
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
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($total_vat)); ?></span></td>
        </tr>
		<?php
		
		
	?>
		<tr class="quarter">
           <td class="name" colspan='2'><center>ត្រីមាសទី៤</center></td>
    		<td class="td-count right_align"><?php echo(num_format($count_all_q4)); ?></td>
           <td class="td-cd right_align"><span class="disp"><?php echo(num_format($count_cd_q4)); ?></span></td>
           <td class="td-st right_align"><span class="disp"><?php echo(num_format($count_st_q4)); ?></span></td>
           <td class="td-at right_align"><span class="disp"><?php echo(num_format($count_at_q4)); ?></span></td>
           <td class="td-et right_align"><span class="disp"><?php echo(num_format($count_et_q4)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_q4)); ?></span></td>
           <td class="td-vop right_align"><span class="disp"><?php echo(num_format($count_vop_q4)); ?></span></td>
           <td class="td-vpp-ea right_align"><span class="disp"><?php echo(num_format($count_vpp_ea_q4)); ?></span></td>
           <td class="td-vpp-other right_align"><span class="disp"><?php echo(num_format($count_vpp_other_q4)); ?></span></td>
           <td class="td-vop-io right_align"><span class="disp"><?php echo(num_format($count_vop_io_q4)); ?></span></td>
           <td class="td-vap right_align"><span class="disp"><?php echo(num_format($count_vap_q4)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_q4)); ?></span></td>
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($count_total_vat_q4)); ?></span></td>
        </tr>
		<?php
		$count_cd_h2 = $count_cd_q3 + $count_cd_q4;
		$count_st_h2 = $count_st_q3 + $count_st_q4;
		$count_at_h2 = $count_at_q3 + $count_at_q4;
		$count_et_h2 = $count_et_q3 + $count_et_q4;
		$count_other_h2 = $count_other_q3 + $count_other_q4;
		$count_vop_h2 = $count_vop_q3 + $count_vop_q4;
		$count_vpp_ea_h2 = $count_vpp_ea_q3 + $count_vpp_ea_q4;
		$count_vpp_other_h2 = $count_vpp_other_q3 + $count_vpp_other_q4;
		$count_vop_io_h2 = $count_vop_io_q3 + $count_vop_io_q4;
		$count_vap_h2 = $count_vap_q3 + $count_vap_q4;
		$count_vat_other_h2 = $count_vat_other_q3 + $count_vat_other_q4;
		$count_total_vat_h2 = $count_total_vat_q3 + $count_total_vat_q4;
		$count_all_h2 = $count_all_q3 + $count_all_q4;

		
	?>
		<tr class="halfyear">
           <td class="td-office" colspan='2'><center>ឆមាសទី២</center></td>
    		<td class="td-count right_align"><?php echo(num_format($count_all_h2)); ?></td>
           <td class="td-cd right_align"><span class="disp"><?php echo(num_format($count_cd_h2)); ?></span></td>
           <td class="td-st right_align"><span class="disp"><?php echo(num_format($count_st_h2)); ?></span></td>
           <td class="td-at right_align"><span class="disp"><?php echo(num_format($count_at_h2)); ?></span></td>
           <td class="td-et right_align"><span class="disp"><?php echo(num_format($count_et_h2)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_h2)); ?></span></td>
           <td class="td-vop right_align"><span class="disp"><?php echo(num_format($count_vop_h2)); ?></span></td>
           <td class="td-vpp-ea right_align"><span class="disp"><?php echo(num_format($count_vpp_ea_h2)); ?></span></td>
           <td class="td-vpp-other right_align"><span class="disp"><?php echo(num_format($count_vpp_other_h2)); ?></span></td>
           <td class="td-vop-io right_align"><span class="disp"><?php echo(num_format($count_vop_io_h2)); ?></span></td>
           <td class="td-vap right_align"><span class="disp"><?php echo(num_format($count_vap_h2)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_h2)); ?></span></td>
		   <td class="td-total-vat right_align"><span class="disp"><?php echo(num_format($count_total_vat_h2)); ?></span></td>
        </tr>

		
    </tbody>
    <tfoot>
    	<tr class="total">
    		<td colspan='2' class="total"><center>សរុប</center></td>
    		<td class="td-count right_align"><?php echo(num_format($count_all)); ?></td>
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
		   <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_total_vat)); ?></span></td>
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
		<h2 style='margin-top:60px;padding-left:50px;'><center>ម៉ម គុសល</center></h2>
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
	font-family: KHMER MEF2;
	text-align: center;
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
tr.quarter td.right_align, tr.total td.right_align{
	font-weight:bold;
}
tr.halfyear td{
	border-top:2px solid #222 !important;
	border-bottom: 2px solid #222 !important;
	font-weight:bold;
}
tr.quarter .name{
	font-weight:bold;
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


<?php 	
//$items = $this->m_global->select_data(TBLITEMS,NULL,array('id'=>'ASC'),0);


$year = date('Y');
if($this->input->get('y')){
	$year = $this->input->get('y');
	}

$last_month = $this->m_customs->getLastMonthMRB($year);
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
echo form_open(base_url('monthly_revenues_b/add_item'),$attr);
?>
<?php
$print=$this->input->get('print');
$tbl_print='print';
 if($print!="true"){ ?>
<div class="action_menu" style="padding-top:9px;position:fixed;top:0px;width:1220px;text-align:left;padding-left:40px;height:40px;background:#FFF;margin-top:0px auto;margin-bottom:70px;border-bottom:1px solid #ccc;">
<input type="hidden" id="datatodisplay" name="datatodisplay">  
<input type="hidden" name="excel_in_excel" value="Report_on_">  
<a class="btn btn-warning" href="<?php echo base_url('/admin/monthly_revenues_b_front'); ?>" id="print_btn"><i class="icon-backward icon-white"></i>Back</a> 
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
            <th rowspan=2><center>រយៈពេល<br/>សារពើពន្ធ</center></th>
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
		
		$count_all_q1 = 0;
		$count_other_rev_q1 = 0;
		$count_total_vat_q1 = 0;
		$count_vat_gio_q1 = 0;
		$count_vat_ngoemb_q1 = 0;
		$count_vat_other_q1 = 0;
		
		$count_all_q2 = 0;
		$count_other_rev_q2 = 0;
		$count_total_vat_q2 = 0;
		$count_vat_gio_q2 = 0;
		$count_vat_ngoemb_q2 = 0;
		$count_vat_other_q2 = 0;
		
		$count_all_q3 = 0;
		$count_other_rev_q3 = 0;
		$count_total_vat_q3 = 0;
		$count_vat_gio_q3 = 0;
		$count_vat_ngoemb_q3 = 0;
		$count_vat_other_q3 = 0;
		
		$count_all_q4 = 0;
		$count_other_rev_q4 = 0;
		$count_total_vat_q4 = 0;
		$count_vat_gio_q4 = 0;
		$count_vat_ngoemb_q4 = 0;
		$count_vat_other_q4 = 0;
		
		$count_all_h1 = 0;
		$count_other_rev_h1 = 0;
		$count_total_vat_h1 = 0;
		$count_vat_gio_h1 = 0;
		$count_vat_ngoemb_h1 = 0;
		$count_vat_other_h1 = 0;
		
		$count_all_h2 = 0;
		$count_other_rev_h2 = 0;
		$count_total_vat_h2 = 0;
		$count_vat_gio_h2 = 0;
		$count_vat_ngoemb_h2 = 0;
		$count_vat_other_h2 = 0;
		
?>
<?php
		$M = $JANUARY;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q1 = $count_all_q1 + $count_;
		$count_other_rev_q1 = $count_other_rev_q1 + $other_rev;
		$count_total_vat_q1 = $count_total_vat_q1 + $total_vat;
		$count_vat_gio_q1 = $count_vat_gio_q1 + $vat_gio;
		$count_vat_ngoemb_q1 = $count_vat_ngoemb_q1 + $vat_ngoemb;
		$count_vat_other_q1 = $count_vat_other_q1 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">1</td>
           <td class="td-office">មករា</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		$M = $FEBRUARY;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q1 = $count_all_q1 + $count_;
		$count_other_rev_q1 = $count_other_rev_q1 + $other_rev;
		$count_total_vat_q1 = $count_total_vat_q1 + $total_vat;
		$count_vat_gio_q1 = $count_vat_gio_q1 + $vat_gio;
		$count_vat_ngoemb_q1 = $count_vat_ngoemb_q1 + $vat_ngoemb;
		$count_vat_other_q1 = $count_vat_other_q1 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">2</td>
           <td class="td-office">កម្ភៈ</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		$M = $MARCH;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q1 = $count_all_q1 + $count_;
		$count_other_rev_q1 = $count_other_rev_q1 + $other_rev;
		$count_total_vat_q1 = $count_total_vat_q1 + $total_vat;
		$count_vat_gio_q1 = $count_vat_gio_q1 + $vat_gio;
		$count_vat_ngoemb_q1 = $count_vat_ngoemb_q1 + $vat_ngoemb;
		$count_vat_other_q1 = $count_vat_other_q1 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">3</td>
           <td class="td-office">មីនា</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		
		
	?>
		<tr class="quarter">
           <td class="" colspan='2'><center>ត្រីមាសទី១</center></td>
    	   <td class="td-count right_align"><?php echo(num_format($count_all_q1)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(num_format($count_other_rev_q1)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(num_format($count_total_vat_q1)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(num_format($count_vat_gio_q1)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(num_format($count_vat_ngoemb_q1)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_q1)); ?></span></td>
        </tr>
		<?php
		$M = $APRIL;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q2 = $count_all_q2 + $count_;
		$count_other_rev_q2 = $count_other_rev_q2 + $other_rev;
		$count_total_vat_q2 = $count_total_vat_q2 + $total_vat;
		$count_vat_gio_q2 = $count_vat_gio_q2 + $vat_gio;
		$count_vat_ngoemb_q2 = $count_vat_ngoemb_q2 + $vat_ngoemb;
		$count_vat_other_q2 = $count_vat_other_q2 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">4</td>
           <td class="td-office">មេសា</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		$M = $MAY;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q2 = $count_all_q2 + $count_;
		$count_other_rev_q2 = $count_other_rev_q2 + $other_rev;
		$count_total_vat_q2 = $count_total_vat_q2 + $total_vat;
		$count_vat_gio_q2 = $count_vat_gio_q2 + $vat_gio;
		$count_vat_ngoemb_q2 = $count_vat_ngoemb_q2 + $vat_ngoemb;
		$count_vat_other_q2 = $count_vat_other_q2 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">5</td>
           <td class="td-office">ឧសភា</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		$M = $JUNE;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q2 = $count_all_q2 + $count_;
		$count_other_rev_q2 = $count_other_rev_q2 + $other_rev;
		$count_total_vat_q2 = $count_total_vat_q2 + $total_vat;
		$count_vat_gio_q2 = $count_vat_gio_q2 + $vat_gio;
		$count_vat_ngoemb_q2 = $count_vat_ngoemb_q2 + $vat_ngoemb;
		$count_vat_other_q2 = $count_vat_other_q2 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">6</td>
           <td class="td-office">មិថុនា</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php

		
		
	?>
		<tr class="quarter">
           <td class="" colspan='2'><center>ត្រីមាសទី២</center></td>
    	   <td class="td-count right_align"><?php echo(num_format($count_all_q2)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(num_format($count_other_rev_q2)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(num_format($count_total_vat_q2)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(num_format($count_vat_gio_q2)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(num_format($count_vat_ngoemb_q2)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_q2)); ?></span></td>
        </tr>
		<?php
		$count_all_h1 = $count_all_q2 + $count_all_q1;
		$count_other_rev_h1 = $count_other_rev_q2 + $count_other_rev_q1;
		$count_total_vat_h1 = $count_total_vat_q2 + $count_total_vat_q1;
		$count_vat_gio_h1 = $count_vat_gio_q2 + $count_vat_gio_q1;
		$count_vat_ngoemb_h1 = $count_vat_ngoemb_q2 + $count_vat_ngoemb_q1;
		$count_vat_other_h1 = $count_vat_other_q2 + $count_vat_other_q1;
		
		
	?>
		<tr class="halfyear">
           <td class="td-office" colspan='2'><center>ឆមាសទី១</center></td>
    		<td class="td-count right_align"><?php echo(num_format($count_all_h1)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(num_format($count_other_rev_h1)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(num_format($count_total_vat_h1)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(num_format($count_vat_gio_h1)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(num_format($count_vat_ngoemb_h1)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_h1)); ?></span></td>
        </tr>
		<?php
		$M = $JULY;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q3 = $count_all_q3 + $count_;
		$count_other_rev_q3 = $count_other_rev_q3 + $other_rev;
		$count_total_vat_q3 = $count_total_vat_q3 + $total_vat;
		$count_vat_gio_q3 = $count_vat_gio_q3 + $vat_gio;
		$count_vat_ngoemb_q3 = $count_vat_ngoemb_q3 + $vat_ngoemb;
		$count_vat_other_q3 = $count_vat_other_q3 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">7</td>
           <td class="td-office">កក្កដា</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		$M = $AUGUST;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q3 = $count_all_q3 + $count_;
		$count_other_rev_q3 = $count_other_rev_q3 + $other_rev;
		$count_total_vat_q3 = $count_total_vat_q3 + $total_vat;
		$count_vat_gio_q3 = $count_vat_gio_q3 + $vat_gio;
		$count_vat_ngoemb_q3 = $count_vat_ngoemb_q3 + $vat_ngoemb;
		$count_vat_other_q3 = $count_vat_other_q3 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">8</td>
           <td class="td-office">សីហា</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		$M = $SEPTEMBER;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q3 = $count_all_q3 + $count_;
		$count_other_rev_q3 = $count_other_rev_q3 + $other_rev;
		$count_total_vat_q3 = $count_total_vat_q3 + $total_vat;
		$count_vat_gio_q3 = $count_vat_gio_q3 + $vat_gio;
		$count_vat_ngoemb_q3 = $count_vat_ngoemb_q3 + $vat_ngoemb;
		$count_vat_other_q3 = $count_vat_other_q3 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">9</td>
           <td class="td-office">កញ្ញា</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		
	?>
		<tr class="quarter">
           <td class="" colspan='2'><center>ត្រីមាសទី៣</center></td>
    		 <td class="td-count right_align"><?php echo(num_format($count_all_q3)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(num_format($count_other_rev_q3)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(num_format($count_total_vat_q3)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(num_format($count_vat_gio_q3)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(num_format($count_vat_ngoemb_q3)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_q3)); ?></span></td>
        </tr>
		<?php
		$M = $OCTOBER;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q4 = $count_all_q4 + $count_;
		$count_other_rev_q4 = $count_other_rev_q4 + $other_rev;
		$count_total_vat_q4 = $count_total_vat_q4 + $total_vat;
		$count_vat_gio_q4 = $count_vat_gio_q4 + $vat_gio;
		$count_vat_ngoemb_q4 = $count_vat_ngoemb_q4 + $vat_ngoemb;
		$count_vat_other_q4 = $count_vat_other_q4 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">10</td>
           <td class="td-office">តុលា</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		$M = $NOVEMBER;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q4 = $count_all_q4 + $count_;
		$count_other_rev_q4 = $count_other_rev_q4 + $other_rev;
		$count_total_vat_q4 = $count_total_vat_q4 + $total_vat;
		$count_vat_gio_q4 = $count_vat_gio_q4 + $vat_gio;
		$count_vat_ngoemb_q4 = $count_vat_ngoemb_q4 + $vat_ngoemb;
		$count_vat_other_q4 = $count_vat_other_q4 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">11</td>
           <td class="td-office">វិច្ឆិកា</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		$M = $DECEMBER;
		$count_ = (!$M?0:$M[0]->count_);
		$other_rev = (!$M?0:$M[0]->other_rev);
		$total_vat = (!$M?0:$M[0]->total_vat);
		$vat_gio = (!$M?0:$M[0]->vat_gio);
		$vat_ngoemb = (!$M?0:$M[0]->vat_ngoemb);
		$vat_other = (!$M?0:$M[0]->vat_other);
		
		$count_all = $count_all + $count_;
		$count_other_rev = $count_other_rev + $other_rev;
		$count_total_vat = $count_total_vat + $total_vat;
		$count_vat_gio = $count_vat_gio + $vat_gio;
		$count_vat_ngoemb = $count_vat_ngoemb + $vat_ngoemb;
		$count_vat_other = $count_vat_other + $vat_other;
		
		$count_all_q4 = $count_all_q4 + $count_;
		$count_other_rev_q4 = $count_other_rev_q4 + $other_rev;
		$count_total_vat_q4 = $count_total_vat_q4 + $total_vat;
		$count_vat_gio_q4 = $count_vat_gio_q4 + $vat_gio;
		$count_vat_ngoemb_q4 = $count_vat_ngoemb_q4 + $vat_ngoemb;
		$count_vat_other_q4 = $count_vat_other_q4 + $vat_other;
		
	?>
		<tr class="">
			<td class="right_align">12</td>
           <td class="td-office">ធ្នូ</td>
    		<td class="td-count right_align"><?php echo(!$M?'0':num_format($M[0]->count_)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->other_rev)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(!$M?'0':num_format($M[0]->total_vat)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(!$M?'0':num_format($M[0]->vat_other)); ?></span></td>
        </tr>
		<?php
		
		
	?>
		<tr class="quarter">
           <td class="" colspan='2'><center>ត្រីមាសទី៤</center></td>
    		<td class="td-count right_align"><?php echo(num_format($count_all_q4)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(num_format($count_other_rev_q4)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(num_format($count_total_vat_q4)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(num_format($count_vat_gio_q4)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(num_format($count_vat_ngoemb_q4)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_q4)); ?></span></td>
        </tr>
		<?php
		$count_all_h2 = $count_all_q3 + $count_all_q4;
		$count_other_rev_h2 = $count_other_rev_q3 + $count_other_rev_q4;
		$count_total_vat_h2 = $count_total_vat_q3 + $count_total_vat_q4;
		$count_vat_gio_h2 = $count_vat_gio_q3 + $count_vat_gio_q4;
		$count_vat_ngoemb_h2 = $count_vat_ngoemb_q3 + $count_vat_ngoemb_q4;
		$count_vat_other_h2 = $count_vat_other_q3 + $count_vat_other_q4;
		
	?>
		<tr class="halfyear">
           <td class="td-office" colspan='2'><center>ឆមាសទី២</center></td>
    		<td class="td-count right_align"><?php echo(num_format($count_all_h2)); ?></td>
           <td class="td-other-rev right_align"><span class="disp"><?php echo(num_format($count_other_rev_h2)); ?></span></td>
           <td class="td-total-vat right_align"><?php echo(num_format($count_total_vat_h2)); ?></td>
           <td class="td-vat-gio right_align"><span class="disp"><?php echo(num_format($count_vat_gio_h2)); ?></span></td>
           <td class="td-vat-ngoemb right_align"><span class="disp"><?php echo(num_format($count_vat_ngoemb_h2)); ?></span></td>
           <td class="td-vat-other right_align"><span class="disp"><?php echo(num_format($count_vat_other_h2)); ?></span></td>
        </tr>

		
    </tbody>
    <tfoot>
    	<tr class="total">
    		<td colspan='2' class="total"><center>សរុប</center></td>
    		<td id="count-all" class="right_align"><?php echo num_format($count_all); ?></td>
           <td id="count-other-rev" class="right_align"><?php echo num_format($count_other_rev); ?></td>
           <td id="count-total-vat" class="right_align"><?php echo num_format($count_total_vat); ?></td>
           <td id="count-vat-gio" class="right_align"><?php echo num_format($count_vat_gio); ?></td>
           <td id="count-vat-ngoemb" class="right_align"><?php echo num_format($count_vat_ngoemb); ?></td>
           <td id="count-vat-other" class="right_align"><?php echo num_format($count_vat_other); ?></td>
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
	font-family: KHMER MEF2;
	text-align:center !important;
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


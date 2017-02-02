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
<h2>តារាងតាមដាន ប្រាក់ពន្ធ និងអាករជាបន្ទុករដ្ឋ</h2>
<h2>គិតពីខែ មករា ដល់ខែ <?php echo month_kh($month); ?> ឆ្នាំ <?php echo numberKH($year); ?></h2>
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
        	<th><center>លរ</center></th>
            <th  style="font-size:12px;"><center>រយៈពេល<br/>សារពើរពន្ធ</center></th>
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
		
		$count_all_q1 = 0;
		$count_ngo_q1 = 0;
		$count_emb_q1 = 0;
		$count_gio_q1 = 0;
		$count_oio_q1 = 0;
		$count_exp_q1 = 0;
		$count_aid_q1 = 0;
		$count_ata_q1 = 0;
		$count_p_min_q1 = 0;
		$count_other_q1 = 0;
		$count_q1 = 0;
		
		$count_all_q2 = 0;
		$count_ngo_q2 = 0;
		$count_emb_q2 = 0;
		$count_gio_q2 = 0;
		$count_oio_q2 = 0;
		$count_exp_q2 = 0;
		$count_aid_q2 = 0;
		$count_ata_q2 = 0;
		$count_p_min_q2 = 0;
		$count_other_q2 = 0;
		$count_q2 = 0;
		
		$count_all_q3 = 0;
		$count_ngo_q3 = 0;
		$count_emb_q3 = 0;
		$count_gio_q3 = 0;
		$count_oio_q3 = 0;
		$count_exp_q3 = 0;
		$count_aid_q3 = 0;
		$count_ata_q3 = 0;
		$count_p_min_q3 = 0;
		$count_other_q3 = 0;
		$count_q3 = 0;
		
		$count_all_q4 = 0;
		$count_ngo_q4 = 0;
		$count_emb_q4 = 0;
		$count_gio_q4 = 0;
		$count_oio_q4 = 0;
		$count_exp_q4 = 0;
		$count_aid_q4 = 0;
		$count_ata_q4 = 0;
		$count_p_min_q4 = 0;
		$count_other_q4 = 0;
		$count_q4 = 0;
		
		$count_all_h1 = 0;
		$count_ngo_h1 = 0;
		$count_emb_h1 = 0;
		$count_gio_h1 = 0;
		$count_oio_h1 = 0;
		$count_exp_h1 = 0;
		$count_aid_h1 = 0;
		$count_ata_h1 = 0;
		$count_p_min_h1 = 0;
		$count_other_h1 = 0;
		$count_h1 = 0;
		
		$count_all_h2 = 0;
		$count_ngo_h2 = 0;
		$count_emb_h2 = 0;
		$count_gio_h2 = 0;
		$count_oio_h2 = 0;
		$count_exp_h2 = 0;
		$count_aid_h2 = 0;
		$count_ata_h2 = 0;
		$count_p_min_h2 = 0;
		$count_other_h2 = 0;
		$count_h2 = 0;
		
?>
<?php
		$mr = $JANUARY;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q1 = $count_ngo_q1 + $ngo;
		$count_emb_q1 = $count_emb_q1 + $emb;
		$count_gio_q1 = $count_gio_q1 + $gio;
		$count_oio_q1 = $count_oio_q1 + $oio;
		$count_exp_q1 = $count_exp_q1 + $exp;
		$count_aid_q1 = $count_aid_q1 + $aid;
		$count_ata_q1 = $count_ata_q1 + $ata;
		$count_p_min_q1 = $count_p_min_q1 + $p_min;
		$count_other_q1 = $count_other_q1 + $other;
$count_q1 = $count_q1 + $cnt;
$count_all_q1 = $count_all_q1 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">1</td>
           <td class="td-office">មករា</td>
    		<td class="td-ngo right_align"><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		$mr = $FEBRUARY;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q1 = $count_ngo_q1 + $ngo;
		$count_emb_q1 = $count_emb_q1 + $emb;
		$count_gio_q1 = $count_gio_q1 + $gio;
		$count_oio_q1 = $count_oio_q1 + $oio;
		$count_exp_q1 = $count_exp_q1 + $exp;
		$count_aid_q1 = $count_aid_q1 + $aid;
		$count_ata_q1 = $count_ata_q1 + $ata;
		$count_p_min_q1 = $count_p_min_q1 + $p_min;
		$count_other_q1 = $count_other_q1 + $other;
$count_q1 = $count_q1 + $cnt;
$count_all_q1 = $count_all_q1 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">2</td>
           <td class="td-office">កម្ភៈ</td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		$mr = $MARCH;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q1 = $count_ngo_q1 + $ngo;
		$count_emb_q1 = $count_emb_q1 + $emb;
		$count_gio_q1 = $count_gio_q1 + $gio;
		$count_oio_q1 = $count_oio_q1 + $oio;
		$count_exp_q1 = $count_exp_q1 + $exp;
		$count_aid_q1 = $count_aid_q1 + $aid;
		$count_ata_q1 = $count_ata_q1 + $ata;
		$count_p_min_q1 = $count_p_min_q1 + $p_min;
		$count_other_q1 = $count_other_q1 + $other;
	$count_q1 = $count_q1 + $cnt;
	$count_all_q1 = $count_all_q1 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">3</td>
           <td class="td-office">មីនា</td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		
		
	?>
		<tr class="quarter">
           <td class="name" colspan='2'><center>ត្រីមាសទី១</center></td>
    	   <td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($count_ngo_q1)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($count_emb_q1)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($count_gio_q1)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($count_oio_q1)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($count_exp_q1)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($count_aid_q1)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($count_ata_q1)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($count_p_min_q1)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_q1)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($count_q1)); ?></td>
        </tr>
		<?php
		$mr = $APRIL;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q2 = $count_ngo_q2 + $ngo;
		$count_emb_q2 = $count_emb_q2 + $emb;
		$count_gio_q2 = $count_gio_q2 + $gio;
		$count_oio_q2 = $count_oio_q2 + $oio;
		$count_exp_q2 = $count_exp_q2 + $exp;
		$count_aid_q2 = $count_aid_q2+ $aid;
		$count_ata_q2 = $count_ata_q2 + $ata;
		$count_p_min_q2 = $count_p_min_q2 + $p_min;
		$count_other_q2 = $count_other_q2 + $other;
		$count_q2 = $count_q2 + $cnt;
		$count_all_q2 = $count_all_q2 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">4</td>
           <td class="td-office">មេសា</td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		$mr = $MAY;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q2 = $count_ngo_q2 + $ngo;
		$count_emb_q2 = $count_emb_q2 + $emb;
		$count_gio_q2 = $count_gio_q2 + $gio;
		$count_oio_q2 = $count_oio_q2 + $oio;
		$count_exp_q2 = $count_exp_q2 + $exp;
		$count_aid_q2 = $count_aid_q2+ $aid;
		$count_ata_q2 = $count_ata_q2 + $ata;
		$count_p_min_q2 = $count_p_min_q2 + $p_min;
		$count_other_q2 = $count_other_q2 + $other;
	$count_q2 = $count_q2 + $cnt;
	$count_all_q2 = $count_all_q2 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">5</td>
           <td class="td-office">ឧសភា</td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		$mr = $JUNE;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q2 = $count_ngo_q2 + $ngo;
		$count_emb_q2 = $count_emb_q2 + $emb;
		$count_gio_q2 = $count_gio_q2 + $gio;
		$count_oio_q2 = $count_oio_q2 + $oio;
		$count_exp_q2 = $count_exp_q2 + $exp;
		$count_aid_q2 = $count_aid_q2+ $aid;
		$count_ata_q2 = $count_ata_q2 + $ata;
		$count_p_min_q2 = $count_p_min_q2 + $p_min;
		$count_other_q2 = $count_other_q2 + $other;
		$count_q2 = $count_q2 + $cnt;
		$count_all_q2 = $count_all_q2 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">6</td>
           <td class="td-office">មិថុនា</td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php

		
		
	?>
		<tr class="quarter">
           <td class="name" colspan='2'><center>ត្រីមាសទី២</center></td>
    	  <td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($count_ngo_q2)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($count_emb_q2)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($count_gio_q2)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($count_oio_q2)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($count_exp_q2)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($count_aid_q2)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($count_ata_q2)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($count_p_min_q2)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_q2)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($count_q2)); ?></td>
        </tr>
		<?php
		$count_ngo_h1 = $count_ngo_q1 + $count_ngo_q2;
		$count_emb_h1 = $count_emb_q1 + $count_emb_q2;
		$count_gio_h1 = $count_gio_q1 + $count_gio_q2;
		$count_oio_h1 = $count_oio_q1 + $count_oio_q2;
		$count_exp_h1 = $count_exp_q1 + $count_exp_q2;
		$count_aid_h1 = $count_aid_q1+ $count_aid_q2;
		$count_ata_h1 = $count_ata_q1 + $count_ata_q2;
		$count_p_min_h1 = $count_p_min_q1 + $count_p_min_q2;
		$count_other_h1 = $count_other_q1 +  $count_other_q2;
		$count_h1 = $count_q1 + $count_q2;
$count_all_h1 = $count_all_q1 + $count_all_q2;
		
		
	?>
		<tr class="halfyear">
           <td class="td-office" colspan='2'><center>ឆមាសទី១</center></td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($count_ngo_h1)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($count_emb_h1)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($count_gio_h1)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($count_oio_h1)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($count_exp_h1)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($count_aid_h1)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($count_ata_h1)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($count_p_min_h1)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_h1)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($count_h1)); ?></td>
        </tr>
		<?php
		$mr = $JULY;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q3 = $count_ngo_q3 + $ngo;
		$count_emb_q3 = $count_emb_q3 + $emb;
		$count_gio_q3 = $count_gio_q3 + $gio;
		$count_oio_q3 = $count_oio_q3 + $oio;
		$count_exp_q3 = $count_exp_q3 + $exp;
		$count_aid_q3 = $count_aid_q3+ $aid;
		$count_ata_q3 = $count_ata_q3 + $ata;
		$count_p_min_q3 = $count_p_min_q3 + $p_min;
		$count_other_q3 = $count_other_q3 + $other;
$count_q3 = $count_q3 + $cnt;
$count_all_q3 = $count_all_q3 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">7</td>
           <td class="td-office">កក្កដា</td>
    		<td class="td-ngo right_align"><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		$mr = $AUGUST;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q3 = $count_ngo_q3 + $ngo;
		$count_emb_q3 = $count_emb_q3 + $emb;
		$count_gio_q3 = $count_gio_q3 + $gio;
		$count_oio_q3 = $count_oio_q3 + $oio;
		$count_exp_q3 = $count_exp_q3 + $exp;
		$count_aid_q3 = $count_aid_q3+ $aid;
		$count_ata_q3 = $count_ata_q3 + $ata;
		$count_p_min_q3 = $count_p_min_q3 + $p_min;
		$count_other_q3 = $count_other_q3 + $other;
$count_q3 = $count_q3 + $cnt;
$count_all_q3 = $count_all_q3 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">8</td>
           <td class="td-office">សីហា</td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		$mr = $SEPTEMBER;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q3 = $count_ngo_q3 + $ngo;
		$count_emb_q3 = $count_emb_q3 + $emb;
		$count_gio_q3 = $count_gio_q3 + $gio;
		$count_oio_q3 = $count_oio_q3 + $oio;
		$count_exp_q3 = $count_exp_q3 + $exp;
		$count_aid_q3 = $count_aid_q3+ $aid;
		$count_ata_q3 = $count_ata_q3 + $ata;
		$count_p_min_q3 = $count_p_min_q3 + $p_min;
		$count_other_q3 = $count_other_q3 + $other;
$count_q3 = $count_q3 + $cnt;
$count_all_q3 = $count_all_q3 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">9</td>
           <td class="td-office">កញ្ញា</td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		
	?>
		<tr class="quarter">
           <td class="name" colspan='2'><center>ត្រីមាសទី៣</center></td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($count_ngo_q3)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($count_emb_q3)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($count_gio_q3)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($count_oio_q3)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($count_exp_q3)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($count_aid_q3)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($count_ata_q3)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($count_p_min_q3)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_q3)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($count_q3)); ?></td>
        </tr>
		<?php
		$mr = $OCTOBER;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q4 = $count_ngo_q4 + $ngo;
		$count_emb_q4 = $count_emb_q4 + $emb;
		$count_gio_q4 = $count_gio_q4 + $gio;
		$count_oio_q4 = $count_oio_q4 + $oio;
		$count_exp_q4 = $count_exp_q4 + $exp;
		$count_aid_q4 = $count_aid_q4+ $aid;
		$count_ata_q4 = $count_ata_q4 + $ata;
		$count_p_min_q4 = $count_p_min_q4 + $p_min;
		$count_other_q4 = $count_other_q4 + $other;
$count_q4 = $count_q4 + $cnt;
$count_all_q4 = $count_all_q4 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">10</td>
           <td class="td-office">តុលា</td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		$mr = $NOVEMBER;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q4 = $count_ngo_q4 + $ngo;
		$count_emb_q4 = $count_emb_q4 + $emb;
		$count_gio_q4 = $count_gio_q4 + $gio;
		$count_oio_q4 = $count_oio_q4 + $oio;
		$count_exp_q4 = $count_exp_q4 + $exp;
		$count_aid_q4 = $count_aid_q4+ $aid;
		$count_ata_q4 = $count_ata_q4 + $ata;
		$count_p_min_q4 = $count_p_min_q4 + $p_min;
		$count_other_q4 = $count_other_q4 + $other;
$count_q4 = $count_q4 + $cnt;
$count_all_q4 = $count_all_q4 + $cnt;
		
	?>
		<tr class="">
			<td class="right_align">11</td>
           <td class="td-office">វិច្ឆិកា</td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		$mr = $DECEMBER;
		$ngo = (!$mr?0:$mr[0]->ngo);
		$emb = (!$mr?0:$mr[0]->emb);
		$gio = (!$mr?0:$mr[0]->gio);
		$oio = (!$mr?0:$mr[0]->oio);
		$exp = (!$mr?0:$mr[0]->exp);
		$aid = (!$mr?0:$mr[0]->aid);
		$ata = (!$mr?0:$mr[0]->ata);
		$p_min = (!$mr?0:$mr[0]->p_min);
		$other = (!$mr?0:$mr[0]->other);
		$cnt = (!$mr?0:$mr[0]->cnt);
		
				$count_ngo = $count_ngo + $ngo;
		$count_emb = $count_emb + $emb;
		$count_gio = $count_gio + $gio;
		$count_oio = $count_oio + $oio;
		$count_exp = $count_exp + $exp;
		$count_aid = $count_aid + $aid;
		$count_ata = $count_ata + $ata;
		$count_p_min = $count_p_min + $p_min;
		$count_other = $count_other + $other;
		$count = $count + $cnt;

		
		$count_ngo_q4 = $count_ngo_q4 + $ngo;
		$count_emb_q4 = $count_emb_q4 + $emb;
		$count_gio_q4 = $count_gio_q4 + $gio;
		$count_oio_q4 = $count_oio_q4 + $oio;
		$count_exp_q4 = $count_exp_q4 + $exp;
		$count_aid_q4 = $count_aid_q4+ $aid;
		$count_ata_q4 = $count_ata_q4 + $ata;
		$count_p_min_q4 = $count_p_min_q4 + $p_min;
		$count_other_q4 = $count_other_q4 + $other;
$count_q4 = $count_q4 + $cnt;

		
	?>
		<tr class="">
			<td class="right_align">12</td>
           <td class="td-office">ធ្នូ</td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($cnt)); ?></td>
        </tr>
		<?php
		
		
	?>
		<tr class="quarter">
           <td class="name" colspan='2'><center>ត្រីមាសទី៤</center></td>
    		<td class="td-ngo right_align" ><span class="disp"><?php echo(num_format($count_ngo_q4)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($count_emb_q4)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($count_gio_q4)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($count_oio_q4)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($count_exp_q4)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($count_aid_q4)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($count_ata_q4)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($count_p_min_q4)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_q4)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($count_q4)); ?></td>
        </tr>
		<?php
		$count_ngo_h2 = $count_ngo_q3 + $count_ngo_q4;
		$count_emb_h2 = $count_emb_q3 + $count_emb_q4;
		$count_gio_h2 = $count_gio_q3 + $count_gio_q4;
		$count_oio_h2 = $count_oio_q3 + $count_oio_q4;
		$count_exp_h2 = $count_exp_q3 + $count_exp_q4;
		$count_aid_h2 = $count_aid_q3+ $count_aid_q4;
		$count_ata_h2 = $count_ata_q3 + $count_ata_q4;
		$count_p_min_h2 = $count_p_min_q3 + $count_p_min_q4;
		$count_other_h2 = $count_other_q3 +  $count_other_q4;
		$count_h2 = $count_q3 + $count_q4;

		
	?>
		<tr class="halfyear">
           <td class="td-office" colspan='2'><center>ឆមាសទី២</center></td>
    		<td class="td-ngo right_align"><span class="disp"><?php echo(num_format($count_ngo_h2)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($count_emb_h2)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($count_gio_h2)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($count_oio_h2)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($count_exp_h2)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($count_aid_h2)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($count_ata_h2)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($count_p_min_h2)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other_h2)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($count_h2)); ?></td>
        </tr>

		
    </tbody>
    <tfoot>
    	<tr class="total">
    		<td colspan='2' class="total"><center>សរុប</center></td>
    		<td class="td-ngo right_align"><span class="disp"><?php echo(num_format($count_ngo)); ?></span></td>
           <td class="td-emb right_align"><span class="disp"><?php echo(num_format($count_emb)); ?></span></td>
           <td class="td-gio right_align"><span class="disp"><?php echo(num_format($count_gio)); ?></span></td>
           <td class="td-oio right_align"><span class="disp"><?php echo(num_format($count_oio)); ?></span></td>
           <td class="td-exp right_align"><span class="disp"><?php echo(num_format($count_exp)); ?></span></td>
           <td class="td-aid right_align"><span class="disp"><?php echo(num_format($count_aid)); ?></span></td>
           <td class="td-ata right_align"><span class="disp"><?php echo(num_format($count_ata)); ?></span></td>
           <td class="td-p-min right_align"><span class="disp"><?php echo(num_format($count_p_min)); ?></span></td>
           <td class="td-other right_align"><span class="disp"><?php echo(num_format($count_other)); ?></span></td>
           <td class="td-count right_align"><?php echo(num_format($count)); ?></td>
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


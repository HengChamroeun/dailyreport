<?php 	
//$items = $this->m_global->select_data(TBLITEMS,NULL,array('id'=>'ASC'),0);
$BRANCH_CODE='';
$month = date('m');
if($this->input->get('m')){
	$month = $this->input->get('m');
	}
$year = date('Y');
if($this->input->get('y')){
	$year = $this->input->get('y');
	}
?>
<div class="jumbotron" style="min-height:500px;">
<h2 class="title">តារាងសរុបលទ្ធផល ចំណូលប្រាក់ពន្ធ និង អាករគ្រប់ប្រភេទដែលប្រមូលបាន</h2>
<h2>ចំណូលសរុបប្រចាំខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h2>
<br/>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('monthly_revenues/add_item'),$attr);
?>
<div class='table-responsive'>
<a href="#" class="btn btn-primary btn-sm pull-right" id="btnExport"><i class="fa fa-download"></i> Export Excel</a>
<a href='<?php echo base_url('/admin/monthly_revenues/mr_by_quarter?m='.$month.'&y='.$year); ?>' target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-right:10px">តារាងត្រីមាស</a>
<a href='<?php echo base_url('/admin/monthly_revenues/mr_print_2?m='.$month.'&y='.$year); ?>' target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-right:10px">តារាងផ្សេងៗ</a>
<a href='<?php echo base_url('/admin/monthly_revenues/mr_print_1?m='.$month.'&y='.$year); ?>' target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-right:10px"	>តារាងទីមួយ</a>
<div style="clear:both; overflow-x:scroll; width:1170px;">
<table class='table table-bordered' style="min-width:2000px; overflow-x:scroll" id="table_input">
    <thead>
        <tr>
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
            <th rowspan="2"><center>លើផលិតផលផ្សេងៗ &nbsp; ក្រៅពីតេលសិលា</center></th>
            <th colspan="2"><center>លើផលិតផល &nbsp; តេលសិលា</center></th>
            <th rowspan="2"><center>វិនិយោគផ្សេងៗ &nbsp; ក្រៅពីកាត់ដេរ</center></th>
            <th rowspan="2"><center>វិស័យកសិកម្ម</center></th>
            <th rowspan="2"><center>ផ្សេងៗ</center></th>
        </tr>
        <tr>
            <th><center>ប្រេងសាំង &nbsp;EA</center></th>
            <th style="border-right:1px solid #ddd;"><center>ផ្សេងទៀត</center></th>
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
	
	
	
	$date = date("Y-m-d");
	if($this->input->get("date")){
		$date = $this->input->get("date");
		}
	$ofs=$this->m_customs->getBranch(false,false,false,true);
	
	//echo $this->db->last_query();
	//var_dump($ofs);
	
	foreach($ofs as $of){
		$mr = $this->m_global->select_MR_by_Branch($of->code,$month,$year);
		//$m = $mr[0];
		//var_dump($mr);
		//echo $this->db->last_query();
		
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
		
	?>
		<tr class="">
           <td class="td-office"><?php echo($of->name_print); ?></td>
    		<td class="td-count"><?php echo(num_format($count)); ?></td>
           <td class="td-cd"><span class="disp"><?php echo(num_format($cd)); ?></span></td>
           <td class="td-st"><span class="disp"><?php echo(num_format($st)); ?></span></td>
           <td class="td-at"><span class="disp"><?php echo(num_format($at)); ?></span></td>
           <td class="td-et"><span class="disp"><?php echo(num_format($et)); ?></span></td>
           <td class="td-other"><span class="disp"><?php echo(num_format($other)); ?></span></td>
           <td class="td-vop"><span class="disp"><?php echo(num_format($vop)); ?></span></td>
           <td class="td-vpp-ea"><span class="disp"><?php echo(num_format($vpp_ea)); ?></span></td>
           <td class="td-vpp-other"><span class="disp"><?php echo(num_format($vpp_other)); ?></span></td>
           <td class="td-vop-io"><span class="disp"><?php echo(num_format($vop_io)); ?></span></td>
           <td class="td-vap"><span class="disp"><?php echo(num_format($vap)); ?></span></td>
           <td class="td-vat-other"><span class="disp"><?php echo(num_format($vat_other)); ?></span></td>
        </tr>
    <?php
		}
	
	?>
    </tbody>
	<tfoot>
    	<tr>
    		<td>សរុប</td>
    		<td id="count-all"><?php echo(num_format($count_all)); ?></td>
           <td id="count-cd"><?php echo(num_format($count_cd)); ?></td>
           <td id="count-st"><?php echo(num_format($count_st)); ?></td>
           <td id="count-at"><?php echo(num_format($count_at)); ?></td>
           <td id="count-et"><?php echo(num_format($count_et)); ?></td>
           <td id="count-other"><?php echo(num_format($count_other)); ?></td>
           <td id="count-vop"><?php echo(num_format($count_vop)); ?></td>
           <td id="count-vpp-ea"><?php echo(num_format($count_vpp_ea)); ?></td>
           <td id="count-vpp-other"><?php echo(num_format($count_vpp_other)); ?></td>
           <td id="count-vop-io"><?php echo(num_format($count_vop_io)); ?></td>
           <td id="count-vap"><?php echo(num_format($count_vap)); ?></td>
           <td id="count-vat-other"><?php echo(num_format($count_vat_other)); ?></td>
    	</tr>
    </tfoot>
    
</table>
</div>

</div>

</form>
<div class='clear'></div>
</div>
<style>
#btnExport{
	font-size:14px;
	margin-bottom:10px;
}
a.btn.btn-primary.btn-sm.pull-right{
	font-size:14px;
	margin-bottom:10px;
}
#submit{
	margin-bottom:20px;
	}
div.table-responsive table th, div.table-responsive table td.td_i{
	text-align:center;
	}
div.table-responsive table td{
	vertical-align:middle;
	text-align:right;
	}
div.table-responsive table td.td_delete{
	text-align:center;
	}
div.table-responsive table td.td_item{
	text-align:left;
	}
span.disp{
	display:block;
	}
td.td_item span.disp{
	display:none;
	}
#table_input input, #table_input select{
	display:none;
	}
#table_input .current input, #table_input .current select, #table_input td.td_item select{
	display:block;
	}
#table_input .current span.disp{
	display:none;
	}
.table-responsive{
	border-bottom:0px !important;
	}
table{
	border:1px solid #DDD !important;
	margin-bottom:20px !important;
	}
tfoot td{
	font-weight: bold;
	}
@media (min-width: 768px) {
  .container {
    max-width: 1170px;
  }
</style>
<script>
$(document).ready(function(e) {
	$("#btnExport").on('click', function (e) {
        //e.preventDefault();
        var uri = $("#table_input").btechco_excelexport({
            containerid: "table_input"
            , datatype: $datatype.Table
            , returnUri: true
        });
        $(this).attr('download', '<?= time() ?>.xls');
        $(this).attr('href', uri).attr('target', '_blank');
        //return false;
    });
	$(document).on('change','#select-month',function(e){
		if($(this).val()!='0' && $('select-year').val()!='0'){
			window.location = '<?php echo base_url('admin/monthly_revenues') ?>'+'?m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('admin/monthly_revenues') ?>'+'?y=' + $(this).val()+'&m='+$('#select-month').val();
			}
		});
});

</script>

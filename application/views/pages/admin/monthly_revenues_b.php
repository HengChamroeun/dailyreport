<?php 

$disp_m = "";	
$month = "";
$q = "";
$h = "";
$year = "";
$list = "";
if($this->input->get('y')){
	$year = $this->input->get('y');
	}
if($this->input->get('list')){
	$list = $this->input->get('list');
	}
if($list=='monthly'){
	$month = $this->input->get('m');
	$disp_m = "ខែ ".month_kh($month);
	}
	elseif($list=='quarterly'){
		$disp_m = "ត្រីមាស ទី ";
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
		$disp_m = $disp_m.$num;
		}
	elseif($list=='half'){
		$disp_m = "ឆមាស ទី ";
		$num = "";
		$h = $this->input->get('h');
		if($q=='h1'){
			$month = "'01','02','03','04','05','06'"; 
			$num = "០១";
			}
		elseif($q=='h2'){
			$month = "'07','08','09','10','11','12'"; 
			$num = "០២";
			}
		$disp_m = $disp_m.$num;
		}
	elseif($list=='9month'){
		$disp_m = "ខែ មករា ដល់ខែ កញ្ញា";
		$month = "'01','02','03','04','05','06','07','08','09'"; 
		}
	elseif($list=='yearly'){
		$disp_m = "";
		$month = "'01','02','03','04','05','06','07','08','09','10','11','12'"; 
		}
	

?>
<div class="jumbotron" style="min-height:500px;">
<h2 class="title">តារាងសរុបលទ្ធផល ចំណូលប្រាក់ពន្ធ និង អាករគ្រប់ប្រភេទជាបន្ទុករដ្ឋ</h2>
<h2>ចំណូលសរុបសំរាប់ <?php echo($disp_m); ?> ឆ្នាំ <?php echo numKh($year); ?></h2>
<br/>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('monthly_revenues_b/'),$attr);
?>
<div class='table-responsive'>

<a href="#" class="btn btn-primary btn-sm pull-right" id="btnExport"><i class="fa fa-download"></i> Export Excel</a>
<a href='<?php echo base_url('/admin/monthly_revenues_b/mrb_print_2?list='.$list.'&m='.$month.'&y='.$year); ?>' target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-right:10px">តារាងផ្សេងៗ</a>
<a href='<?php echo base_url('/admin/monthly_revenues_b/mrb_print_1?list='.$list.'&m='.$month.'&y='.$year); ?>' target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-right:10px"	>តារាងទីមួយ</a>
<table class='table table-bordered' id="table_input">
    <thead>
        <tr>
            <th rowspan=2>អង្គភាព</th>
            <th rowspan=2>ចំនូលប្រាក់ពន្ធ<br/>និងអាករសរុប</th>
            <th rowspan="2" >ចំណូលផ្សេងៗក្រៅពី &nbsp; អតប(VAT)</th>
            <th colspan=4>ចំណូល អតប(VAT)</th>
        </tr>
        <tr>
            <th>សរុប</th>
            <th>វិនិយោគកាត់ដេរ</th>
            <th>អង្គការនិងស្ថានទូត</th>
            <th>ផ្សេងៗ</th>
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
	
	$date = date("Y-m-d");
	if($this->input->get("date")){
		$date = $this->input->get("date");
		}
	$ofs=$this->m_customs->getBranch(false,false,false,true);
	
	//echo $this->db->last_query();
	//var_dump($ofs);
	
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
		
	?>
		<tr class="">
           <td class="td-office"><?php echo($of->name_print); ?></td>
    		<td class="td-count"><?php echo(num_format($count)) ?></td>
           <td class="td-other-rev"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->other_rev)); ?></span></td>
           <td class="td-total-vat"><?php echo(num_format($total_vat)) ?></td>
           <td class="td-vat-gio"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_gio)); ?></span></td>
           <td class="td-vat-ngoemb"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_ngoemb)); ?></span></td>
           <td class="td-vat-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_other)); ?></span></td>
        </tr>
    <?php
		}
	?>
    </tbody>
    <tfoot>
    	<tr>
    		<td>សរុប</td>
    		<td id="count-all"><?php echo num_format($count_all); ?></td>
           <td id="count-other-rev"><?php echo num_format($count_other_rev); ?></td>
           <td id="count-total-vat"><?php echo num_format($count_total_vat); ?></td>
           <td id="count-vat-gio"><?php echo num_format($count_vat_gio); ?></td>
           <td id="count-vat-ngoemb"><?php echo num_format($count_vat_ngoemb); ?></td>
           <td id="count-vat-other"><?php echo num_format($count_vat_other); ?></td>
    	</tr>
    </tfoot>
</table>

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
$(document).ready(function(e){
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
			window.location = '<?php echo base_url('admin/monthly_revenues_b') ?>'+'?'+'m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('admin/monthly_revenues_b') ?>'+'?'+'y=' + $(this).val()+'&m='+$('#select-month').val();
			}
		});
});
</script>

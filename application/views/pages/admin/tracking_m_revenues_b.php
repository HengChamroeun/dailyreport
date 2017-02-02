<?php 	
//$items = $this->m_global->select_data(TBLITEMS,NULL,array('id'=>'ASC'),0);
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
<h2 class="title">តារាងតាមដាន ប្រាក់ពន្ធ និងអាករជាបន្ទុករដ្ឋ</h2>
<h2>ចំណូលសរុបប្រចាំខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h2>
<br/>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('monthly_revenues_b/add_item'),$attr);
?>
<div class='table-responsive'>
<a href="#" class="btn btn-primary btn-sm pull-right" id="btnExport"><i class="fa fa-download"></i> Export Excel</a>
<a href='<?php echo base_url('/admin/tracking_m_revenues_b/tracking_mrb_by_quarter?m='.$month.'&y='.$year); ?>' target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-right:10px">តារាងត្រីមាស</a>
<a href='<?php echo base_url('/admin/tracking_m_revenues_b/tracking_mrb_print_2?m='.$month.'&y='.$year); ?>' target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-right:10px">តារាងផ្សេងៗ</a>
<a href='<?php echo base_url('/admin/tracking_m_revenues_b/tracking_mrb_print_1?m='.$month.'&y='.$year); ?>' target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-right:10px"	>តារាងទីមួយ</a>

<div style="clear:both; width:1170px; overflow-x:scroll">
<table class='table table-bordered' id="table_input" style="margin-left:200px; width:1500px">
    <thead>
        <tr>
            <th  class="fixed-col">អង្គភាព<br/>គយ និងរដ្ឋាករ</th>
            <th >អង្គការ</th>
            <th >ស្ថានទូត</th>
            <th >វិនិយោគកាត់ដេរ</th>
            <th >វិនិយោគផ្សេងៗ</th>
            <th >នាំចេញ</th>
            <th >ជំនួយ</th>
            <th >នាំចូល<br />បណ្តោះអាសន្ន</th>
            <th >បុគ្គល-ក្រសួង</th>
            <th >ផ្សេងៗ</th>
            <th >សរុប</th>
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
	
	
	$date = date("Y-m-d");
	if($this->input->get("date")){
		$date = $this->input->get("date");
		}
	$ofs=$this->m_customs->getBranch(false,false,false,true);
	
	//echo $this->db->last_query();
	//var_dump($ofs);
	
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
	?>
		<tr class="">
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
	
	?>
    </tbody>
    <tfoot>
    	<tr>
    		<td class="fixed-col">សរុប</td>
           <td id="count-ngo"><?php echo(num_format($count_ngo)); ?></td>
           <td id="count-emb"><?php echo(num_format($count_emb)); ?></td>
           <td id="count-gio"><?php echo(num_format($count_gio)); ?></td>
           <td id="count-oio"><?php echo(num_format($count_oio)); ?></td>
           <td id="count-exp"><?php echo(num_format($count_exp)); ?></td>
           <td id="count-aid"><?php echo(num_format($count_aid)); ?></td>
           <td id="count-ata"><?php echo(num_format($count_ata)); ?></td>
           <td id="count-p-min"><?php echo(num_format($count_p_min)); ?></td>
           <td id="count-other"><?php echo(num_format($count_other)); ?></td>
           <td id="count-all"><?php echo(num_format($count_all)); ?></td>
    	</tr>
    </tfoot>
    
</table>
</div>
</div>
</form>
<div class='clear'></div>
</div>
<style>

th.fixed-col{
	border: 1px solid #ddd !important; 
	}
.fixed-col{
	position:absolute;
	width:200px;
	top:auto;
	margin-left: -200px;
	background-color:#fff;
	}

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
 td.td-office{
	 text-align:left !important;
	 }
</style>
<script>
$(document).ready(function(e) {
	
	/*var table = $('#table_input').DataTable( {
        scrollY:        false,
        scrollX:        true,
        scrollCollapse: true,
        paging: false,
        bLengthChange: false,
        bFilter: false,
        bSort: false,
        bInfo: false,
        bAutoWidth: true,
        pageLength: 0
    });
    new $.fn.dataTable.FixedColumns( table , {
        "iLeftColumns" : 1,
        "iLeftWidth" : 200
    });*/
	
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
			window.location = '<?php echo base_url('admin/tracking_m_revenues_b') ?>'+'?'+'m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('admin/tracking_m_revenues_b') ?>'+'?'+'y=' + $(this).val()+'&m='+$('#select-month').val();
			}
		});
	});

</script>

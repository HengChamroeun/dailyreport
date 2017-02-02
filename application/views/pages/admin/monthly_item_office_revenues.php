<?php 	
//$items = $this->m_global->select_data(TBLITEMS,NULL,array('id'=>'ASC'),0);
$date = date("Y-m-d");
	if($this->input->get("date")){
		$date = $this->input->get("date");
		}
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
<br/>
<h3>ចំណូលពន្ធតាមមុខទំនិញសរុបប្រចាំខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h3>
<br/>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
//echo form_open(base_url('item_38/add_item'),$attr);
?>
<br>
<div class=''>
    <a href="#" class="btn btn-primary btn-sm pull-right" id="btnExport"><i class="fa fa-download"></i> Export Excel</a>
<table class='table table-bordered table-striped' style="width: 100%" id="table_input">
    <thead>
        <tr>
            <th rowspan=2 style="width:28px;" class="fixed-col">ល.រ</th>
            <th rowspan=2 style="width:180px;" class="fixed-col">សាខា / ការិយាល័យ</th>
            <th colspan=9 >១.១ ទំនិញនាំចូលជាប់ពន្ធនិងអាករ</th>
            <th colspan=7 >១.២ ទំនិញនាំចូលពន្ធនិងអាករ ជាបន្ទុករដ្ឋ</th>
            <!--<th rowspan=2 style="width:50px;">លុប</th>!-->
        </tr>
        <tr>
            <th style="width:130px;">បរិមាណ</th>
            <th style="width:145px;">តម្លៃគិតពន្ធគយ</th>
            <th style="width:145px;">ពន្ធនាំចូល(CD)</th>
            <th style="width:145px;">អាករបន្ថែម(ATCD)</th>
            <th style="width:145px;">អាករពិសេស (ST)</th>
            <th style="width:145px;">អ.ត.ប (VAT)</th>
            <th style="width:145px;">សរុបពន្ធ-​អាករ</th>
            <th style="width:145px;">កម្រៃផ្សេងៗ</th>
            <th style="width:145px;">សរុបពន្ធ-​អាករ និង​កម្រៃ​ផ្សេងៗ</th>
            <th style="width:145px;">បរិមាណ</th>
            <th style="width:145px;">តម្លៃគិតពន្ធគយ</th>
            <th style="width:145px;">ពន្ធនាំចូល(CD)</th>
            <th style="width:145px;">អាករបន្ថែម(ATCD)</th>
            <th style="width:145px;">អាករពិសេស (ST)</th>
            <th style="width:145px;">អ.ត.ប (VAT)</th>
            <th style="width:145px;">សរុបពន្ធ-​អាករ</th>

        </tr>
    </thead>

    <tbody>
    <?php

	//echo $this->db->last_query();
	$branches = $this->m_global->select_data(TBLOFFICES,array('parent_code'=>'CHQ00','status'=>'1'),array('level'=>'ASC'));
	$i = 0;
	$count_qty = 0;
	$count_tax_base = 0;
    $count_cd = 0;
    $count_atcd = 0;
    $count_st = 0;
    $count_vat = 0;
	$count_tax_amount = 0;
    $count_tax_oth = 0;
   // $count_tax__tax_oth = 0;
    $count_tax_tax_oth = 0;
	$count_qty_2 = 0;
	$count_tax_base_2 = 0;
    $count_cd_2 = 0;
    $count_atcd_2 = 0;
    $count_st_2 = 0;
    $count_vat_2 = 0;
	$count_tax_amount_2 = 0;
	
	foreach($branches as $branch){
	$i = $i+1;
	
	$itm = $this->m_global->select_ItemRevenueSum(TBLITEM_REVENUES,array("branch_code"=>$branch->code,"year"=>$year,"month"=>$month,"isbur"=>0),NULL,'branch_code');
	//echo $this->db->last_query();
	$itm2 = $this->m_global->select_ItemRevenueSum(TBLITEM_REVENUES,array("branch_code"=>$branch->code,"year"=>$year,"month"=>$month,"isbur"=>1),NULL,'branch_code');
	$oth_tax = $this->m_global->select_ItemRevenueSum(TBLITEM_REVENUES,array("branch_code"=>$branch->code,"year"=>$year,"month"=>$month,"isbur"=>2),NULL,'branch_code');

	$count_qty = $count_qty + (!$itm==null?$itm[0]->qty:0);
	$count_tax_base = $count_tax_base + (!$itm==null?$itm[0]->tax_base:0);
    $count_cd = $count_cd + (!$itm==null?$itm[0]->cd:0);
    $count_atcd = $count_atcd + (!$itm==null?$itm[0]->atcd:0);
    $count_st = $count_st + (!$itm==null?$itm[0]->st:0);
    $count_vat = $count_vat + (!$itm==null?$itm[0]->vat:0);
	$count_tax_amount = $count_tax_amount + (!$itm==null?$itm[0]->tax_amount:0);
    $count_tax_oth = $count_tax_oth + (!$oth_tax==null?$oth_tax[0]->tax_amount:0);
    $tax_tax_oth = (!$oth_tax==null?$oth_tax[0]->tax_amount:0) + (!$itm==null?$itm[0]->tax_amount:0);
    $count_tax_tax_oth = $count_tax_tax_oth + $tax_tax_oth;

	$count_qty_2 = $count_qty_2 + (!$itm2==null?$itm2[0]->qty:0);
	$count_tax_base_2 = $count_tax_base_2 + (!$itm2==null?$itm2[0]->tax_base:0);
    $count_cd_2 = $count_cd_2 + (!$itm2==null?$itm2[0]->cd:0);
    $count_atcd_2 = $count_atcd_2 + (!$itm2==null?$itm2[0]->atcd:0);
    $count_st_2 = $count_st_2 + (!$itm2==null?$itm2[0]->st:0);
    $count_vat_2 = $count_vat_2 + (!$itm2==null?$itm2[0]->vat:0);
	$count_tax_amount_2 = $count_tax_amount_2 + (!$itm2==null?$itm2[0]->tax_amount:0);
	
	?>
		<tr class="">
            <td  class="td_delete fixed-col"><?php echo "$i"; ?></td>
            <td class="td_i fixed-col"><span class="enum"><?php echo($branch->name_print); ?></span></td>
            <td class="td_qty"><span class="disp"><?php echo num_format(!$itm==null?$itm[0]->qty:0); ?></td>
            <td class="td_tax_base"><span class="disp"><?php echo num_format(!$itm==null?$itm[0]->tax_base:0); ?></span></td>
            <td class="td_cd"><span class="disp"><?php echo num_format(!$itm==null?$itm[0]->cd:0); ?></span></td>
            <td class="td_atcd"><span class="disp"><?php echo num_format(!$itm==null?$itm[0]->atcd:0); ?></span></td>
            <td class="td_st"><span class="disp"><?php echo num_format(!$itm==null?$itm[0]->st:0); ?></span></td>
            <td class="td_vat"><span class="disp"><?php echo num_format(!$itm==null?$itm[0]->vat:0); ?></span></td>
            <td class="td_tax_amount"><span class="disp"><?php echo num_format(!$itm==null?$itm[0]->tax_amount:0); ?></span></td>
            <td class="td_tax_oth"><span class="disp"><?php echo num_format(!$oth_tax==null?$oth_tax[0]->tax_amount:0);?></span></td>
            <td class="td_tax_tax_oth"><span class="disp"><?php echo num_format($tax_tax_oth);?></span></td>
            <td class="td_qty_2"><span class="disp"><?php echo num_format(!$itm2==null?$itm2[0]->qty:0); ?></span></td>
            <td class="td_tax_base_2"><span class="disp"><?php echo num_format(!$itm2==null?$itm2[0]->tax_base:0); ?></span></td>
            <td class="td_cd_2"><span class="disp"><?php echo num_format(!$itm2==null?$itm2[0]->cd:0); ?></span></td>
            <td class="td_atcd_2"><span class="disp"><?php echo num_format(!$itm2==null?$itm2[0]->atcd:0); ?></span></td>
            <td class="td_st_2"><span class="disp"><?php echo num_format(!$itm2==null?$itm2[0]->st:0); ?></span></td>
            <td class="td_vat_2"><span class="disp"><?php echo num_format(!$itm2==null?$itm2[0]->vat:0); ?></span></td>
            <td class="td_tax_amount_2"><span class="disp"><?php echo num_format(!$itm2==null?$itm2[0]->tax_amount:0); ?></span></td>
            <!--<td  class="td_delete"><a href="#delete">លុប</a></td>!-->
        </tr>
    <?php
		$offices = $this->m_customs->getOffices($branch->code);
		if(count($offices)>0){
			foreach($offices as $office){
				$sub = $this->m_global->select_ItemRevenueSum(TBLITEM_REVENUES,array("office_code"=>$office->code,"year"=>$year,"month"=>$month,"isbur"=>0),NULL,'office_code');
				$sub2 = $this->m_global->select_ItemRevenueSum(TBLITEM_REVENUES,array("office_code"=>$office->code,"year"=>$year,"month"=>$month,"isbur"=>1),NULL,'office_code');
				$sub3 = $this->m_global->select_ItemRevenueSum(TBLITEM_REVENUES,array("office_code"=>$office->code,"year"=>$year,"month"=>$month,"isbur"=>2),NULL,'office_code');
				?>
                <tr class="">
                    <td  class="td_delete fixed-col"></td>
                    <td class="td_i_sub fixed-col"><span class="enum">- <?php echo($office->name_print); ?></span></td>
                    <td class="td_qty_sub"><span class="disp"><?php echo num_format(!$sub==null?$sub[0]->qty:0); ?></span></td>
                    <td class="td_tax_base_sub"><span class="disp"><?php echo num_format(!$sub==null?$sub[0]->tax_base:0); ?></span></td>
                    <td class="td_cd_sub"><span class="disp"><?php echo num_format(!$sub==null?$sub[0]->cd:0); ?></span></td>
                    <td class="td_atcd_sub"><span class="disp"><?php echo num_format(!$sub==null?$sub[0]->atcd:0); ?></span></td>
                    <td class="td_st_sub"><span class="disp"><?php echo num_format(!$sub==null?$sub[0]->st:0); ?></span></td>
                    <td class="td_vat_sub"><span class="disp"><?php echo num_format(!$sub==null?$sub[0]->vat:0); ?></span></td>
                    <td class="td_tax_amount_sub"><span class="disp"><?php echo num_format(!$sub==null?$sub[0]->tax_amount:0); ?></span></td>
                    <td class="td_tax_oth_sub"><span class="disp"><?php echo num_format(!$sub3==null?$sub3[0]->tax_amount:0); ?></span></td>
                    <td class="td_tax_tax_oth_sub"><span class="disp"><?php echo num_format((!$sub==null?$sub[0]->tax_amount:0)+(!$sub3==null?$sub3[0]->tax_amount:0)); ?></span></td>
                    <td class="td_qty_2_sub"><span class="disp"><?php echo num_format(!$sub2==null?$sub2[0]->qty:0); ?></span></td>
                    <td class="td_tax_base_2_sub"><span class="disp"><?php echo num_format(!$sub2==null?$sub2[0]->tax_base:0); ?></span></td>
                    <td class="td_cd_2_sub"><span class="disp"><?php echo num_format(!$sub2==null?$sub2[0]->cd:0); ?></span></td>
                    <td class="td_atcd_2_sub"><span class="disp"><?php echo num_format(!$sub2==null?$sub2[0]->atcd:0); ?></span></td>
                    <td class="td_st_2_sub"><span class="disp"><?php echo num_format(!$sub2==null?$sub2[0]->st:0); ?></span></td>
                    <td class="td_vat_2_sub"><span class="disp"><?php echo num_format(!$sub2==null?$sub2[0]->vat:0); ?></span></td>
                    <td class="td_tax_amount_2_sub"><span class="disp"><?php echo num_format(!$sub2==null?$sub2[0]->tax_amount:0); ?></span></td>
                </tr>
            <?php
				}
			}
		}
	?>
    </tbody>
    <tfoot>
    	<tr>
    		<td class="fixed-col"></td>
    		<td class="fixed-col">សរុប</td>
    		<td id="count-qty"><?php echo(num_format($count_qty)); ?></td>
    		<td id="count-tax-base"><?php echo(num_format($count_tax_base)); ?></td>
            <td id="count-cd"><?php echo(num_format($count_cd)); ?></td>
            <td id="count-atcd"><?php echo(num_format($count_atcd)); ?></td>
            <td id="count-st"><?php echo(num_format($count_st)); ?></td>
            <td id="count-vat"><?php echo(num_format($count_vat)); ?></td>
    		<td id="count-tax-amount"><?php echo(num_format($count_tax_amount)); ?></td>
    		<td id="count-tax-oth"><?php echo(num_format($count_tax_oth)); ?></td>
    		<td id="count-tax-tax_oth"><?php echo(num_format($count_tax_tax_oth)); ?></td>
    		<td id="count-qty_2"><?php echo(num_format($count_qty_2)); ?></td>
    		<td id="count-tax-base_2"><?php echo(num_format($count_tax_base_2)); ?></td>
            <td id="count-cd_2"><?php echo(num_format($count_cd_2)); ?></td>
            <td id="count-atcd_2"><?php echo(num_format($count_atcd_2)); ?></td>
            <td id="count-st_2"><?php echo(num_format($count_st_2)); ?></td>
            <td id="count-vat_2"><?php echo(num_format($count_vat_2)); ?></td>
    		<td id="count-tax-amount_2"><?php echo(num_format($count_tax_amount_2)); ?></td>
    		<!--<td></td>-->
    	</tr>
    </tfoot>
    
</table>
<!--<input type="submit" name="submit" id="submit" class="btn btn-sm btn-success" value="បញ្ចូលទិន្នន័យ">
<a href="<?php echo base_url('/revenue_by_item') ?>" class="btn btn-cancel" style="background-color:#E2E2E2; margin-bottom: 20px">ចាកចេញ</a>!-->
</div>
<!--</form>-->
<div class='clear'></div>
</div>

<style>
#submit{
	margin-bottom:20px;
	}
div.table-responsive table th, div.table-responsive table td.td_i{
	text-align:center;
	}
div.table-responsive table td.td_i, div.table-responsive table td.td_i_sub{
	text-align:left;
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
	/*display:none;*/
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

}

.DTFC_LeftWrapper, .DTFC_LeftHeadWrapper, .DTFC_LeftFootWrapper{
    width: 307px !important;
}
.DTFC_LeftBodyWrapper>.DTFC_LeftBodyLiner{
    width: 322px !important;
}

/*.DTFC_ScrollWrapper{*/
    /*height: 620px !important;*/
/*}*/

/*.dataTables_scrollBody{*/
/*height: 420px !important;*/
/*}*/
/*.DTFC_LeftBodyWrapper{*/
/*height: 406px !important;*/
/*}*/

.jumbotron .btn {
    font-size: 14px !important;
}
</style>
<script>
$(document).ready(function(e) {
    var table = $('#table_input').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging: false,
        bLengthChange: false,
        bFilter: false,
        bSort: false,
        bInfo: false,
        bAutoWidth: true,
        pageLength: 15
    });
    new $.fn.dataTable.FixedColumns( table , {
        "iLeftColumns" : 2
    });

	countRevenue();
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
	//event
    /*$("#submit").click(function(e) {
        e.preventDefault();
		if($('.current').find('select').val()!='0'){
			//alert($('.current').find('select').val());
			addItem();
			hideIputCurrentRow($('.current'));
			FromInputToDisplay(null);
			
			$('#table_input tr.current').removeClass('current');
			$('#table_input tbody').append(newRow());
			$(":input").inputmask();
			//reEnum();
			countRevenue();
			}else{
				alert('សូមធ្វើការជ្រើសរើសមុខទំនិញ!');
				}
		
    });*/
	/*$(document).on('keypress','#table_input td input',function(e) {
        if($(this).parent().parent().hasClass('current')==false){
			//alert(e.which);
			if(e.which == 13){
				e.preventDefault();
				if($(this).val()==''){
				$(this).val($(this).parent().find('span.disp').html());
				}else{
					$(this).parent().find('span.disp').html($(this).val());
					}
				
				updateItem($(this).parent().parent());
				hideElement($(this));
				showElement($(this).parent().find('span.disp'));
				countRevenue();
				}
				
				
			}
    });*/
    //disabled
	/*$(document).on( "click",'#table_input td--',function(e) {
		//alert('dsfdsf	');
		input = $(this).find('input');
		if($(this).find('select').val()){
			input = $(this).find('select');
			}
       if(input.css('display')=='none'){
		   hideElement($(this).find('span.disp'));
		   showElement($(this).find('input'));
		   showElement($(this).find('select'));
		   input.focus();
		   }
    });*/
	/*$(document).on('focusout','#table_input td input',function(e) {
        input = $(this);
		
       if(input.css('display')=='block' && $(this).parent().parent().hasClass('current') == false){
		   hideElement(input);
		   input.val($(input).parent().find('span.disp').html());
		   showElement($(input).parent().find('span.disp'));
		   }

    });*/
	/*$(document).on('change','#select-item',function(e) {
		selects = $('#table_input select');
		this_select = $(this);
		hidden_input = $(this).parent().find('input');
		count = 0;
		$(selects).each(function(index, element) {
            if($(this_select).val()==$(element).val()){
				count=count+1;
				}
        });
		if(count>=2){
			$(this).val($(hidden_input).val());
			alert('មិនអាចបញ្ចូលទំនិញដែលបានបញ្ចូលរួចហើយម្តងទៀតទេ!');
			//alert(hidden_input.val());
				}
		hidden_input.val($(this).val());
		
		if(!$(this).parent().parent().hasClass('current')){
			updateItem($(this).parent().parent());
			hideElement(this);
			//$(this).parent().find('input#item_hidden').val($(this).val());
			disp = $(this).parent().find('span.disp');
			disp.html($(this).find('option:selected').html());
			showElement(disp);
			}
		setUnitName(this_select);
        
		
    });*/
	/*$(document).on('click','td.td_delete a',function(e){
		e.preventDefault();
		if(!$(this).parent().parent().hasClass('current')){
			deleteItem($(this).parent().parent());
			$(this).parent().parent().remove();
			//reEnum();
			countRevenue();
			}
		
		});*/
	$(document).on('change','#select-month',function(e){
		if($(this).val()!='0' && $('select-year').val()!='0'){
			window.location = '<?php echo base_url('admin/monthly_item_office_revenues') ?>'+'?'+'m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('admin/monthly_item_office_revenues') ?>'+'?'+'y=' + $(this).val()+'&m='+$('#select-month').val();
			}
		});
});
function hideIputCurrentRow(c){
	$(c).find('input').css('display','none');
	$(c).find('select').css('display','none');
	}
function showElement(c){
	$(c).css('display','block');
	}
function hideElement(c){
	$(c).css('display','none');
	}
function setFloatValue(element,val){
	$(element).val(parseFloat(val).format(0,3,',','.'))
	}
function FromInputToDisplay(row){
	c = $('.current');
	if(row!=null){
		c = row;
		}
	itm = c.find('td.td_item');
	qty = c.find('td.td_qty');
	tax_base = c.find('td.td_tax_base');
	tax_amount = c.find('td.td_tax_amount');
	qty_2 = c.find('td.td_qty_2');
	tax_base_2 = c.find('td.td_tax_base_2');
	tax_amount_2 = c.find('td.td_tax_amount_2');
	
	itm.find('span.disp').html(itm.find('select option:selected').html());
	qty.find('span.disp').html(qty.find('input').val()==''?'0':qty.find('input').val());
	tax_base.find('span.disp').html(tax_base.find('input').val()==''?'0':tax_base.find('input').val());
	tax_amount.find('span.disp').html(tax_amount.find('input').val()==''?'0':tax_amount.find('input').val());
	qty_2.find('span.disp').html(qty_2.find('input').val()==''?'0':qty_2.find('input').val());
	tax_base_2.find('span.disp').html(tax_base_2.find('input').val()==''?'0':tax_base_2.find('input').val());
	tax_amount_2.find('span.disp').html(tax_amount_2.find('input').val()==''?'0':tax_amount_2.find('input').val());
	
	showElement(itm.find('span.disp'));
	showElement(qty.find('span.disp'));
	showElement(tax_base.find('span.disp'));
	showElement(tax_amount.find('span.disp'));
	showElement(qty_2.find('span.disp'));
	showElement(tax_base_2.find('span.disp'));
	showElement(tax_amount_2.find('span.disp'));
		
	}
/*function newRow(){
	r = '<tr class="current">';
            r += '<td class="td_item"><span class="disp"></span><?php echo selectBox($items,'id','name_kh'); ?><input type="hidden" id="item_hidden"></td>';
            r += '<td class="td_i"><span class="enum"></span><input type="hidden" name="record_id" id="record_id" value="0"></td>';
            r += '<td class="td_qty"><span class="disp"></span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
            r += '<td class="td_tax_base"><span class="disp"></span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
            r += '<td class="td_tax_amount"><span class="disp"></span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
            r += '<td class="td_qty_2"><span class="disp"></span><input type="text" id="qty_2" name="qty_2" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
            r += '<td class="td_tax_base_2"><span class="disp"></span><input type="text" id="tax_base_2" name="tax_base_2" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
            r += '<td class="td_tax_amount_2"><span class="disp"></span><input type="text" id="tax_amount_2" name="tax_amount_2" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
            r += '<td  class="td_delete"><a href="#delete">លុប</a></td>';
        	 r += '</tr>';
	return r;
	}
function reEnum(){
	i = 0;
	$('#table_input td.td_i').each(function(index, element) {
		i = i+1;
        $(element).find('span.enum').html(i);
    });
	}*/
/*function addItem(){
	c = $('.current');
	if(c.length>0){
		
	itm = parseFloat(removeMask(c.find('td.td_item').find('select').val()));
	qty = parseFloat(removeMask(c.find('td.td_qty').find('input').val()));
	tax_base = parseFloat(removeMask(c.find('td.td_tax_base').find('input').val()));
	tax_amount = parseFloat(removeMask(c.find('td.td_tax_amount').find('input').val()));
	qty_2 = parseFloat(removeMask(c.find('td.td_qty_2').find('input').val()));
	tax_base_2 = parseFloat(removeMask(c.find('td.td_tax_base_2').find('input').val()));
	tax_amount_2 = parseFloat(removeMask(c.find('td.td_tax_amount_2').find('input').val()));
	office_code = '<?php echo $this->input->get('office'); ?>';
	date = '<?php echo(date('Y-m-d')); ?>';
	var url='<?php echo base_url('input_38/addItem') ?>';
	//alert(itm+':'+qty+':'+tax_base+':'+tax_amount+':'+qty_2+':'+tax_base_2+':'+tax_amount_2);
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {itm:itm,qty:qty,tax_base:tax_base,tax_amount:tax_amount,qty_2:qty_2,tax_base_2:tax_base_2,tax_amount_2:tax_amount_2,date:date,office_code:office_code},
			success: function(data){
				if(data !=''){
					//location.reload();
					c.find('input#record_id').val(data);
					}
			},
			error: function(data){
				alert('error:' + data);
				location.reload();
				}
		});
		}
	}*/
/*function updateItem(row){
	c = $(row);
	if(c.length>0){
		
	id = c.find('td.td_i').find('input#record_id').val();
	itm = parseFloat(removeMask(c.find('td.td_item').find('select').val()));
	qty = parseFloat(removeMask(c.find('td.td_qty').find('input').val()));
	tax_base = parseFloat(removeMask(c.find('td.td_tax_base').find('input').val()));
	tax_amount = parseFloat(removeMask(c.find('td.td_tax_amount').find('input').val()));
	qty_2 = parseFloat(removeMask(c.find('td.td_qty_2').find('input').val()));
	tax_base_2 = parseFloat(removeMask(c.find('td.td_tax_base_2').find('input').val()));
	tax_amount_2 = parseFloat(removeMask(c.find('td.td_tax_amount_2').find('input').val()));
	office_code = '<?php echo $this->input->get('office'); ?>';
	date = '<?php echo(date('Y-m-d')); ?>';
	var url='<?php echo base_url('input_38/updateItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {id:id,itm:itm,qty:qty,tax_base:tax_base,tax_amount:tax_amount,qty_2:qty_2,tax_base_2:tax_base_2,tax_amount_2:tax_amount_2,date:date,office_code:office_code},
			success: function(data){
				if(data !=''){
					//location.reload();
					//alert(data);
					}
			},
			error: function(data){
				alert('error:' + data);
				location.reload();
				}
		});
		}
	}*/
/*function deleteItem(row){
	c = $(row);
	if(c.length>0){
		
	id = c.find('td.td_i').find('input#record_id').val();
	var url='<?php echo base_url('input_38/deleteItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {id:id},
			success: function(data){
				if(data !=''){
					//location.reload();
					//alert(data);
					}
			},
			error: function(data){
				alert('error:' + data);
				location.reload();
				}
		});
		}
	}*/
function setUnitName(item_box){
	ib = $(item_box);
	if(ib.val()>0){
		
	item_id = ib.val();
	var url='<?php echo base_url('input_38/getUnitName') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {item_id:item_id},
			success: function(data){
				if(data !=''){
					$(ib).parent().parent().find('td.td_i span.enum').html(data);
					//alert($(ib).parent().parent().find('td.td_i span.enum').val())
					//alert(data);
					}
			},
			error: function(data){
				alert('error:' + data);
				location.reload();
				}
		});
		}
	}
function countRevenue(){
	
	//$('#count-qty').html(countEach('td.td_qty','input#qty'));
	//$('#count-tax-base').html(countEach('td.td_tax_base','input#tax_base'));
	//$('#count-tax-amount').html(countEach('td.td_tax_amount','input#tax_amount'));
	//$('#count-qty_2').html(countEach('td.td_qty_2','input#qty_2'));
	//$('#count-tax-base_2').html(countEach('td.td_tax_base_2','input#tax_base_2'));
	//$('#count-tax-amount_2').html(countEach('td.td_tax_amount_2','input#tax_amount_2'));
}
function toFloat(text){
	t = text.replace(/,/g, "");
	return parseFloat(t);
}
function countEach(c,input){
	count = 0;
	$(c).each(function(index) {
	  if(!$(this).parent().hasClass('current')){
	  	//alert(toFloat($(this).find('input#qty').val()));
	  	count = count + toFloat($(this).find(input).val())
	  }
	});
	return num_format(count);
}
function num_format(num){
		var n = num.toString();
		if(n.indexOf('.')===-1){
			return num.format(0,3,',','.');
		}else{
			return num.format(2,3,',','.');
		}
	}

</script>

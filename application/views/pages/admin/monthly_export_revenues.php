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
<h3>ចំណូលអាករនាំចេញតាមមុខទំនិញសរុបប្រចាំខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h3>
<br/>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
//echo form_open(base_url('item_38/add_item'),$attr);
?>
<br>
    <input type="hidden" id="total_oth" value="<?php $data = 0; $total_rev =  $this->m_global->select_ExportRevenueSum_taxable(TBLITEMSEXPORT_REVENUES,array("year"=>$year,"month"=>$month, 'isbur'=>2),array('item_id'=>'ASC'),'item_id'); foreach($total_rev as $row) {$data = $row->tax_amount;} echo $data;?>">
<div class='' >
<a href="#" class="btn btn-primary btn-sm pull-right" id="btnExport"><i class="fa fa-download"></i> Export Excel</a>
<div  style="height:45px">
</div>
<div id='exportDiv'>
<table class='table table-bordered' style="min-width:100%" id="table_input">
    <thead>
        <tr>
        	<th rowspan=2 style="width:50px;">លរ.</th>
            <th rowspan=2 style="width:180px;">២. ទំនិញនាំចេញ</th>
            <th rowspan=2 style="width:68px;">ឯកតា</th>
            <th colspan=5 >២.១ ទំនិញនាំចេញជាប់អាករ</th>
            <th colspan=3>២.២ ទំនិញអាករនាំចេញជាបន្ទុករដ្ឋ</th>
            <!--<th rowspan=2 style="width:50px;">លុប</th>!-->
        </tr>
        <tr>
            <th style="width:130px;">បរិមាណ</th>
            <th style="width:157px;">តម្លៃគិតអាករ</th>
            <th style="width:157px;">អាករនាំចេញ</th>
            <th style="width:157px;">កម្រៃផ្សេងៗ</th>
            <th style="width:157px;">អាករនាំចេញ និង​កម្រៃ​ផ្សេងៗ</th>
            <th style="width:130px;">បរិមាណ</th>
            <th style="width:157px;">តម្លៃគិតអាករ</th>
            <th style="width:157px;">អាករនាំចេញ</th>
            
        </tr>
    </thead>
    <tfoot>
    	<tr>
    		<td></td>
    		<td>សរុប</td>
    		<td></td>
    		<td id="count-qty"></td>
    		<td id="count-tax-base"></td>
    		<td id="count-tax-amount"></td>
    		<td id="count-tax_oth"></td>
    		<td id="count-tax-tax_oth"></td>
    		<td id="count-qty_2"></td>
    		<td id="count-tax-base_2"></td>
    		<td id="count-tax-amount_2"></td>
    		<!--<td></td>-->
    	</tr>
    </tfoot>
    <tbody>
    <?php
	
	$item_revenues =  $this->m_global->select_ExportRevenueSum_taxable(TBLITEMSEXPORT_REVENUES,array("year"=>$year,"month"=>$month,'isbur'=>0),array('item_id'=>'ASC'),'item_id');

	//echo $this->db->last_query();
	$i = 0;
	foreach($item_revenues as $itm){
	$i = $i+1;
	
	$unit_name_kh = $this->m_global->getExportUnit($itm->item_id);
	$item_name_kh = $this->m_global->select_record(TBLITEMSEXPORT,array('id'=>$itm->item_id),'name_kh');
	?>
		<tr class="">
			<td  class="td_delete"><?php echo "$i"; ?></td>
            <td class="td_item"><span class="disp"><?php echo "$item_name_kh";  ?></span><?php //echo selectBox($items,'id','name_kh',$itm->item_id); ?><input type="hidden" id="item_hidden" value="<?php echo($itm->item_id); ?>"></td>
            <td class="td_i"><span class="enum"><?php echo($unit_name_kh); ?></span><input type="hidden" name="record_id" id="record_id" value="<?php echo($itm->id); ?>"></td>
            <td class="td_qty"><span class="disp"><?php echo num_format($itm->qty); ?></span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->qty); ?>"></td>
            <td class="td_tax_base"><span class="disp"><?php echo num_format($itm->tax_base); ?></span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_base); ?>"></td>
            <td class="td_tax_amount"><span class="disp"><?php echo num_format($itm->tax_amount); ?></span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_amount); ?>"></td>
            <td class="td_tax_oth"><span class="disp"></span><input type="text" id="tax_oth" name="tax_oth" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value=""></td>
            <td class="td_tax_tax_oth"><span class="disp"></span><input type="text" id="tax_tax_oth" name="tax_tax_oth" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value=""></td>
            <td class="td_qty_2"><span class="disp"><?php echo num_format($itm->qty_2); ?></span><input type="text" id="qty_2" name="qty_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->qty_2); ?>"></td>
            <td class="td_tax_base_2"><span class="disp"><?php echo num_format($itm->tax_base_2); ?></span><input type="text" id="tax_base_2" name="tax_base_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_base_2); ?>"></td>
            <td class="td_tax_amount_2"><span class="disp"><?php echo num_format($itm->tax_amount_2); ?></span><input type="text" id="tax_amount_2" name="tax_amount_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_amount_2); ?>"></td>
            <!--<td  class="td_delete"><a href="#delete">លុប</a></td>!-->
        </tr>
    <?php
		}
	?>
    </tbody>
    
</table>
<table class='table table-bordered' style="/*min-width:1170px;*/min-width:100%" id="table_input">
    <thead>
        <tr>
        	<th colspan="9" style="width:50px;">២.៣ ទំនិញមិនជាប់អាករនាំចេញ</th>
        </tr>
        <tr>
			<th style="width:50px;">លរ.</th>
            <th style="width:180px;">រាយមុខទំនិញ</th>
            <th style="width:68px;">ឯកតា</th>
            <th style="width:130px;">បរិមាណ</th>
            <th style="width:157px;">តម្លៃគិតអាករ</th>
			<th colspan=4> </th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
    		<td></td>
    		<td>សរុប</td>
    		<td></td>
    		<td id="count-qty_table2"></td>
    		<td id="count-tax-base_table2"></td>
    		<td id="count-tax-amount_table2" colspan=4></td>
    		<!--<td id="count-qty_2_table2"></td>
    		<td id="count-tax-base_2_table2"></td>
    		<td id="count-tax-amount_2_table2"></td>-->
    		<!--<td></td>-->
    	</tr>
    </tfoot>
    <tbody>
    <?php
	
	$item_revenues =  $this->m_global->select_ExportRevenueSum_notax(TBLITEMSEXPORT_REVENUES,array("year"=>$year,"month"=>$month,'isbur'=>0),array('item_id'=>'ASC'),'item_id');
	//echo $this->db->last_query();
	$i = 0;
	foreach($item_revenues as $itm){
	$i = $i+1;
	
	$unit_name_kh = $this->m_global->getExportUnit($itm->item_id);
	$item_name_kh = $this->m_global->select_record(TBLITEMSEXPORT,array('id'=>$itm->item_id),'name_kh');
	?>
		<tr class="">
			<td  class="td_delete_table2"><?php echo "$i"; ?></td>
            <td class="td_item_table2"><span class="disp"><?php echo "$item_name_kh";  ?></span><?php //echo selectBox($items,'id','name_kh',$itm->item_id); ?><input type="hidden" id="item_hidden" value="<?php echo($itm->item_id); ?>"></td>
            <td class="td_i_table2"><span class="enum"><?php echo($unit_name_kh); ?></span><input type="hidden" name="record_id" id="record_id" value="<?php echo($itm->id); ?>"></td>
            <td class="td_qty_table2"><span class="disp"><?php echo num_format($itm->qty); ?></span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->qty); ?>"></td>
            <td class="td_tax_base_table2"><span class="disp"><?php echo num_format($itm->tax_base); ?></span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_base); ?>"></td>
            <td class="td_tax_amount_table2" colspan=4><span class="disp"><?php echo num_format($itm->tax_amount); ?></span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_amount); ?>"></td>
            <!--<td class="td_qty_2_table2"><span class="disp"><?php echo num_format($itm->qty_2); ?></span><input type="text" id="qty_2" name="qty_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->qty_2); ?>"></td>
            <td class="td_tax_base_2_table2"><span class="disp"><?php echo num_format($itm->tax_base_2); ?></span><input type="text" id="tax_base_2" name="tax_base_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_base_2); ?>"></td>
            <td class="td_tax_amount_2_table2"><span class="disp"><?php echo num_format($itm->tax_amount_2); ?></span><input type="text" id="tax_amount_2" name="tax_amount_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_amount_2); ?>"></td>-->
            <!--<td  class="td_delete"><a href="#delete">លុប</a></td>!-->
        </tr>
    <?php
		}
	?>
    </tbody>
    
</table>
</div>
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
div.table-responsive table td{
	vertical-align:middle;
	text-align:right;
	}
div.table-responsive table td.td_delete{
	text-align:center;
	}
div.table-responsive table td.td_item, div.table-responsive table td.td_item_table2{
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
  .jumbotron .btn {
    font-size: 14px !important;
}
</style>
<script>
$(document).ready(function(e) {
	countRevenue();
	//event
    $("#submit").click(function(e) {
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
		
    });
	
	$("#btnExport").on('click', function (e) {
        //e.preventDefault();
        var uri = $("#exportDiv").btechco_excelexport({
            containerid: "exportDiv"
            , datatype: $datatype.Table
            , returnUri: true
        });
        $(this).attr('download', '<?= time() ?>.xls');
        $(this).attr('href', uri).attr('target', '_blank');
        //return false;

    });
	
	$(document).on('keypress','#table_input td input',function(e) {
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
    });
    //disabled
	$(document).on( "click",'#table_input td--',function(e) {
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
    });
	$(document).on('focusout','#table_input td input',function(e) {
        input = $(this);
		
       if(input.css('display')=='block' && $(this).parent().parent().hasClass('current') == false){
		   hideElement(input);
		   input.val($(input).parent().find('span.disp').html());
		   showElement($(input).parent().find('span.disp'));
		   }

    });
	$(document).on('change','#select-item',function(e) {
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
        
		
    });
	$(document).on('click','td.td_delete a',function(e){
		e.preventDefault();
		if(!$(this).parent().parent().hasClass('current')){
			deleteItem($(this).parent().parent());
			$(this).parent().parent().remove();
			//reEnum();
			countRevenue();
			}
		
		});
	$(document).on('change','#select-month',function(e){
		if($(this).val()!='0' && $('select-year').val()!='0'){
			window.location = '<?php echo base_url('admin/monthly_export_revenues') ?>'+'?'+'m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('admin/monthly_export_revenues') ?>'+'?'+'y=' + $(this).val()+'&m='+$('#select-month').val();
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
function addItem(){
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
	}
function updateItem(row){
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
	}
function deleteItem(row){
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
	}
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
	
	$('#count-qty').html(countEach('td.td_qty','input#qty'));
	$('#count-tax-base').html(countEach('td.td_tax_base','input#tax_base'));
	$('#count-tax-amount').html(countEach('td.td_tax_amount','input#tax_amount'));
	$('#count-qty_2').html(countEach('td.td_qty_2','input#qty_2'));
	$('#count-tax-base_2').html(countEach('td.td_tax_base_2','input#tax_base_2'));
	$('#count-tax-amount_2').html(countEach('td.td_tax_amount_2','input#tax_amount_2'));
	// table 2
	$('#count-qty_table2').html(countEach('td.td_qty_table2','input#qty'));
	$('#count-tax-base_table2').html(countEach('td.td_tax_base_table2','input#tax_base'));
	$('.td_tax_amount_table2 span.disp').html('');
	$('#count-tax-amount_table2').html('');

    $('.td_tax_oth').each(function(index, obj){
        var A = toFloat($(this).parent().find('.td_tax_amount span').html())
//        var OT = toFloat('1');
        var OT = toFloat($('#total_oth').val());
        var D = toFloat($('#count-tax-amount').html());
        var tmp = num_format((OT/D)*A);
        $(this).find('span').html(tmp);
        $(this).find('input').val(tmp);

    });

    $('.td_tax_tax_oth').each(function(index, obj){
        var A = toFloat($(this).parent().find('.td_tax_amount span').html())
        var B = toFloat($(this).parent().find('.td_tax_oth span').html())
        var tmp = A+B;
        $(this).find('span').html(num_format(tmp));
        $(this).find('input').val(num_format(tmp));

    });

    $('#count-tax_oth').html(countEach('td.td_tax_oth','input#tax_oth'));
    $('#count-tax-tax_oth').html(countEach('td.td_tax_tax_oth','input#tax_tax_oth'));
	//$('#count-tax-amount_table2').html(countEach('td.td_tax_amount_table2','input#tax_amount'));
	//$('#count-qty_2_table2').html(countEach('td.td_qty_2_table2','input#qty_2'));
	//$('#count-tax-base_2_table2').html(countEach('td.td_tax_base_2_table2','input#tax_base_2'));
	//$('#count-tax-amount_2_table2').html(countEach('td.td_tax_amount_2_table2','input#tax_amount_2'));
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

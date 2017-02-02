<?php 	
$items = $this->m_global->select_data(TBLITEMSEXPORT,NULL,array('id'=>'ASC'),0);
$month = date('m');
$month = $month - 1;
$itm_3 = array();
if($month<10){
	$month = '0'.$month;
	}
if($this->input->get('m')){
	$month = $this->input->get('m');
	}
$year = date('Y');
if($this->input->get('y')){
	$year = $this->input->get('y');
	}
?>
<div class="jumbotron" style="min-height:500px;">
<h2 class="title"><?php echo($this->m_global->select_record(TBLOFFICES,array('code'=>$this->input->get('office')),'name')); ?></h2>
<h3>ចំណូលពន្ធនាំចេញតាមមុខទំនិញសរុបប្រចាំខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h3>
<br/>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('input_export/add_item'),$attr);
?>
<div class='table-responsive'>
<table class='table table-bordered' style="min-width:1170px;" id="table_input">
    <thead>
        <tr>
            <th rowspan=2 style="width:180px;">២. ទំនិញនាំចេញ</th>
            <th rowspan=2 style="width:50px;">ឯកតា</th>
            <th colspan=3 >២.១ ទំនិញ​នាំចេញ​ជាប់អាករ</th>
            <th colspan=3>២.២ ទំនិញអាករនាំចេញជាបន្ទុករដ្ឋ</th>
            <th rowspan=2 style="width:50px;">លុប</th>
        </tr>
        <tr>
            <th style="width:130px;">បរិមាណ</th>
            <th style="width:157px;">តម្លៃគិតអាករ</th>
            <th style="width:157px;">អាករនាំចេញ</th>
            <th style="width:130px;">បរិមាណ</th>
            <th style="width:157px;">តម្លៃគិតអាករ​</th>
            <th style="width:157px;">អាករនាំចេញ</th>
            
        </tr>
    </thead>
    <tfoot>
    	<tr>
    		<td>សរុប</td>
    		<td></td>
    		<td id="count-qty"></td>
    		<td id="count-tax-base"></td>
    		<td id="count-tax-amount"></td>
    		<td id="count-qty_2"></td>
    		<td id="count-tax-base_2"></td>
    		<td id="count-tax-amount_2"></td>
    		<td></td>
    	</tr>
    </tfoot>
    <tbody>
    <?php
	$date = date("Y-m-d");
	if($this->input->get("date")){
		$date = $this->input->get("date");
		}
	$item_revenues =  $this->m_global->select_data(TBLITEMSEXPORT_REVENUES,array("office_code"=>$this->input->get("office"),"year"=>$year,"month"=>$month, "isbur"=>0));
	
	//echo $this->db->last_query();
	//var_dump($item_revenues);
	
	$i = 0;
	foreach($item_revenues as $itm){
        if($i==0){
            $itm_3 = $this->m_global->select_data(TBLITEMSEXPORT_REVENUES,array("item_id"=>0,"office_code"=>$this->input->get("office"),"year"=>$year,"month"=>$month,"isbur"=>2));
        }
        $i = $i+1;
        //$itm_2 = $this->m_global->select_data(TBLITEM_REVENUES,array("item_id"=>$itm->item_id,"office_code"=>$this->input->get("office"),"year"=>$year,"month"=>$month,"isbur"=>1));
        //var_dump($itm_2);
        $unit_name_kh = $this->m_global->getExportUnit($itm->item_id);
	?>
		<tr class="">
            <td class="td_item"><span class="disp"></span><?php echo selectExport($items,'id','name_kh',$itm->item_id); ?><input type="hidden" id="item_hidden" value="<?php echo($itm->item_id); ?>"></td>
            <td class="td_i"><span class="enum"><?php echo($unit_name_kh); ?></span><input type="hidden" name="record_id" id="record_id" value="<?php echo($itm->id); ?>"></td>
            <td class="td_qty"><span class="disp"><?php echo num_format($itm->qty); ?></span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->qty); ?>"></td>
            <td class="td_tax_base"><span class="disp"><?php echo num_format($itm->tax_base); ?></span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_base); ?>"></td>
            <td class="td_tax_amount"><span class="disp"><?php echo num_format($itm->tax_amount); ?></span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_amount); ?>"></td>
            <td class="td_qty_2"><span class="disp"><?php echo num_format($itm->qty_2); ?></span><input type="text" id="qty_2" name="qty_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->qty_2); ?>"></td>
            <td class="td_tax_base_2"><span class="disp"><?php echo num_format($itm->tax_base_2); ?></span><input type="text" id="tax_base_2" name="tax_base_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_base_2); ?>"></td>
            <td class="td_tax_amount_2"><span class="disp"><?php echo num_format($itm->tax_amount_2); ?></span><input type="text" id="tax_amount_2" name="tax_amount_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_amount_2); ?>"></td>
            <td  class="td_delete"><a href="#delete">លុប</a></td>
        </tr>
    <?php
		}
	?>
        <tr class="current">
            <td class="td_item"><span class="disp"></span><?php echo selectExport($items,'id','name_kh'); ?><input type="hidden" id="item_hidden"></td>
            <td class="td_i"><span class="enum"></span><input type="hidden" name="record_id" id="record_id" value="0"></td>
            <td class="td_qty"><span class="disp"></span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
            <td class="td_tax_base"><span class="disp"></span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
            <td class="td_tax_amount"><span class="disp"></span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
            <td class="td_qty_2"><span class="disp"></span><input type="text" id="qty_2" name="qty_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
            <td class="td_tax_base_2"><span class="disp"></span><input type="text" id="tax_base_2" name="tax_base_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
            <td class="td_tax_amount_2"><span class="disp"></span><input type="text" id="tax_amount_2" name="tax_amount_2" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
            <td  class="td_delete"><a href="#delete">លុប</a></td>
        </tr>
    </tbody>
    
</table>
    <div  style="padding-top: 20px"></div>
    <div class="col-sm-12 col-md-12" style="padding-bottom: 20px">
        <span class="col-sm-9 col-md-9" style="text-align: right; font-size: 18px" >សរុប​កម្រៃផ្សេងៗ (ទាំង​ទំនិញ​ជាប់​ពន្ធ​អាករនិង​ទំនិញពន្ធ​អាករ​ជា​បន្ទុករដ្ឋ): </span>
        <div class="col-sm-3 col-md-3">
            <input type="text" id="oth_tax" name="oth_tax" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php if($itm_3 != null) {echo $itm_3[0]->tax_amount;} else echo '0'?>">
        </div>
    </div>
    <input type="submit" name="submit" id="submit" class="btn btn-sm btn-success" value="បញ្ចូលទិន្នន័យ">
    <a href="<?php echo base_url('/revenue_by_item') ?>" class="btn btn-cancel" style="background-color:#E2E2E2; margin-bottom: 20px">ចាកចេញ</a>
</div>
</form>
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
	$(document).on( "click",'#table_input td',function(e) {
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
			window.location = '<?php echo base_url('input_export') ?>'+'?office=<?php echo $this->input->get('office'); ?>'+'&m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('input_export') ?>'+'?office=<?php echo $this->input->get('office'); ?>'+'&y=' + $(this).val()+'&m='+$('#select-month').val();
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
function newRow(){
	r = '<tr class="current">';
            r += '<td class="td_item"><span class="disp"></span><?php echo selectExport($items,'id','name_kh'); ?><input type="hidden" id="item_hidden"></td>';
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
/*function reEnum(){
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
    oth_tax = parseFloat(removeMask($('#oth_tax').val()));
	year = '<?php echo($year); ?>';
	month = '<?php echo($month); ?>';
	var url='<?php echo base_url('input_export/addItem') ?>';
	//alert(itm+':'+qty+':'+tax_base+':'+tax_amount+':'+qty_2+':'+tax_base_2+':'+tax_amount_2);
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {
                itm:itm,
                qty:qty,
                tax_base:tax_base,
                tax_amount:tax_amount,
                qty_2:qty_2,
                tax_base_2:tax_base_2,
                tax_amount_2:tax_amount_2,
                year:year,month:month,
                office_code:office_code,
                oth_tax: oth_tax
            },
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
	oth_tax = parseFloat(removeMask($('#oth_tax').val()));
	office_code = '<?php echo $this->input->get('office'); ?>';
	year = '<?php echo($year); ?>';
	month = '<?php echo($month); ?>';
	date = '<?php echo(date('Y-m-d')); ?>';
	var url='<?php echo base_url('input_export/updateItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {
                id:id,
                itm:itm,
                qty:qty,
                tax_base:tax_base,
                tax_amount:tax_amount,
                qty_2:qty_2,
                tax_base_2:tax_base_2,
                tax_amount_2:tax_amount_2,
                date:date,
                office_code:office_code,
                oth_tax: oth_tax,
				year:year,
				month:month
            },
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
	var url='<?php echo base_url('input_export/deleteItem') ?>';
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
	var url='<?php echo base_url('input_export/getUnitName') ?>';
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
$(document).on('keypress','#oth_tax',function(e) {
            e.preventDefault();
            if(e.which == 13){
                addOtherTax();
            }
        });
        function addOtherTax(){
                office_code = '<?php echo $this->input->get('office'); ?>';
                oth_tax = parseFloat(removeMask($('#oth_tax').val()));
                year = '<?php echo($year); ?>';
                month = '<?php echo($month); ?>';
                var url='<?php echo base_url('input_export/addOther') ?>';
                //alert(itm+':'+qty+':'+tax_base+':'+tax_amount+':'+qty_2+':'+tax_base_2+':'+tax_amount_2);
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'text',
                    data: {
                        year:year,month:month,
                        office_code:office_code,
                        oth_tax: oth_tax
                    },
                    success: function(data){
                        if(data !=''){
                            //location.reload();
                            //c.find('input#record_id').val(data);
                        }
                    },
                    error: function(data){
                        alert('error:' + data);
                        location.reload();
                    }
                });
        }
function countRevenue(){
	
	$('#count-qty').html(countEach('td.td_qty','input#qty'));
	$('#count-tax-base').html(countEach('td.td_tax_base','input#tax_base'));
	$('#count-tax-amount').html(countEach('td.td_tax_amount','input#tax_amount'));
	$('#count-qty_2').html(countEach('td.td_qty_2','input#qty_2'));
	$('#count-tax-base_2').html(countEach('td.td_tax_base_2','input#tax_base_2'));
	$('#count-tax-amount_2').html(countEach('td.td_tax_amount_2','input#tax_amount_2'));
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

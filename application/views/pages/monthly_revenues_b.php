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
<h2 class="title">តារាងសរុបលទ្ធផល ចំណូលប្រាក់ពន្ធ និង អាករគ្រប់ប្រភេទជាបន្ទុករដ្ឋ</h2>
<h2>ចំណូលសរុបប្រចាំខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h2>
<br/>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('monthly_revenues_b/add_item'),$attr);
?>
<div class='table-responsive'>
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
    <tfoot>
    	<tr>
    		<td>សរុប</td>
    		<td id="count-all"></td>
           <td id="count-other-rev"></td>
           <td id="count-total-vat"></td>
           <td id="count-vat-gio"></td>
           <td id="count-vat-ngoemb"></td>
           <td id="count-vat-other"></td>
    	</tr>
    </tfoot>
    <tbody>
    <?php
	$date = date("Y-m-d");
	if($this->input->get("date")){
		$date = $this->input->get("date");
		}
	$ofs=$this->m_customs->getOffices($BRANCH_CODE);
	
	//echo $this->db->last_query();
	//var_dump($ofs);
	
	foreach($ofs as $of){
		$mr = $this->m_global->select_data(TBLMONTHLYREVENUESB,array("office_code"=>$of->code,"year"=>$year,"month"=>$month));
		//$m = $mr[0];
		//var_dump($mr);
	?>
		<tr class="">
           <td class="td-office"><input type="hidden" id="off_hidden" value="<?php echo($of->code); ?>"><input type="hidden" id="record_id" value="<?php echo(!$mr?'0':$mr[0]->id); ?>"><?php echo($of->name_print); ?></td>
    		<td class="td-count"></td>
           <td class="td-other-rev"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->other_rev)); ?></span><input type="text" id="other-rev" name="other-rev" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->other_rev); ?>"></td>
           <td class="td-total-vat"></td>
           <td class="td-vat-gio"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_gio)); ?></span><input type="text" id="vat-gio" name="vat-gio" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vat_gio); ?>"></td>
           <td class="td-vat-ngoemb"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_ngoemb)); ?></span><input type="text" id="vat-ngoemb" name="vat-ngoemb" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vat_ngoemb); ?>"></td>
           <td class="td-vat-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_other)); ?></span><input type="text" id="vat-other" name="vat-other" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vat_other); ?>"></td>
        </tr>
    <?php
		}
	if(!$ofs){
		$mr = $this->m_global->select_data(TBLMONTHLYREVENUESB,array("branch_code"=>$BRANCH_CODE,"year"=>$year,"month"=>$month));
		$name_print = $this->m_global->select_record(TBLOFFICES,array('code'=>$BRANCH_CODE),'name_print');
		?>
		<tr class="">
           <td class="td-office"><input type="hidden" id="off_hidden" value="<?php echo($BRANCH_CODE); ?>"><input type="hidden" id="record_id" value="<?php echo(!$mr?'0':$mr[0]->id); ?>"><?php echo($name_print); ?></td>
    		<td class="td-count"></td>
           <td class="td-other-rev"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->other_rev)); ?></span><input type="text" id="other-rev" name="other-rev" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->other_rev); ?>"></td>
           <td class="td-total-vat"></td>
           <td class="td-vat-gio"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_gio)); ?></span><input type="text" id="vat-gio" name="vat-gio" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vat_gio); ?>"></td>
           <td class="td-vat-ngoemb"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_ngoemb)); ?></span><input type="text" id="vat-ngoemb" name="vat-ngoemb" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vat_ngoemb); ?>"></td>
           <td class="td-vat-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_other)); ?></span><input type="text" id="vat-other" name="vat-other" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vat_other); ?>"></td>
        </tr>
    <?php
		}
	?>
    </tbody>
    
</table>

</div>
<input type="submit" name="submit" id="submit" class="btn btn-sm btn-success" value="បញ្ចូលទិន្នន័យ" style="display:none">
<a href="<?php echo base_url('/revenue_by_item') ?>" class="btn btn-cancel" style="background-color:#E2E2E2; margin-bottom: 20px; display:none">ចាកចេញ</a>
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
		//if($('.current').find('select').val()!='0'){
			//alert($('.current').find('select').val());
			//addItem();
			//hideIputCurrentRow($('.current'));
			//FromInputToDisplay(null);
			
			//$('#table_input tr.current').removeClass('current');
			//$('#table_input tbody').append(newRow());
			//$(":input").inputmask();
			//reEnum();
			//countRevenue();
		
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
				
				migrateItem($(this).parent().parent());
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
			window.location = '<?php echo base_url('monthly_revenues_b') ?>'+'?m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('monthly_revenues_b') ?>'+'?y=' + $(this).val()+'&m='+$('#select-month').val();
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
/*function reEnum(){
	i = 0;
	$('#table_input td.td_i').each(function(index, element) {
		i = i+1;
        $(element).find('span.enum').html(i);
    });
	}*/
function addItem(row){
	c = $(row);
	//id = c.find('input#record_id').val();
	other_rev = parseFloat(removeMask(c.find('input#other-rev').val()));
	vat_gio = parseFloat(removeMask(c.find('input#vat-gio').val()));
	vat_ngoemb = parseFloat(removeMask(c.find('input#vat-ngoemb').val()));
	vat_other = parseFloat(removeMask(c.find('input#vat-other').val()));
	
	office_code = c.find('input#off_hidden').val();
	branch_code = '<?php echo($BRANCH_CODE); ?>';
	month = '<?php echo($month); ?>';
	year = '<?php echo($year); ?>';
	var url='<?php echo base_url('monthly_revenues_b/addItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {other_rev:other_rev,vat_gio:vat_gio,vat_ngoemb:vat_ngoemb,vat_other:vat_other,office_code:office_code,branch_code:branch_code,month:month,year:year},
			success: function(data){
				if(data !=''){
					//location.reload();
					c.find('input#record_id').val(data);
					}
			},
			error: function(data){
				alert('error: Please Reload Page!');
				location.reload();
				}
		});
	}
function migrateItem(row){
	c = $(row);
	if(c.length>0){
		
	id = c.find('input#record_id').val();
	if(id=='0'){
		addItem(c);
		//alert('add');
		}
	else{
		updateItem(c);
		//alert('update');
		}
	}
function updateItem(row){
	c = $(row);
	id = c.find('input#record_id').val();
	other_rev = parseFloat(removeMask(c.find('input#other-rev').val()));
	vat_gio = parseFloat(removeMask(c.find('input#vat-gio').val()));
	vat_ngoemb = parseFloat(removeMask(c.find('input#vat-ngoemb').val()));
	vat_other = parseFloat(removeMask(c.find('input#vat-other').val()));
	
	office_code = c.find('input#off_hidden').val();
	branch_code = '<?php echo($BRANCH_CODE); ?>';
	month = '<?php echo($month); ?>';
	year = '<?php echo($year); ?>';
	var url='<?php echo base_url('monthly_revenues_b/updateItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {id:id,other_rev:other_rev,vat_gio:vat_gio,vat_ngoemb:vat_ngoemb,vat_other:vat_other,office_code:office_code,branch_code:branch_code,month:month,year:year},
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
	
	$('.td-count').each(function(index, element) {
        $(this).html(!countInRow(this)?'0':num_format(countInRow(this)));
		//alert(countInRow(this));
    });
	$('#count-all').html(countAll('.td-count'));
	$('#count-other-rev').html(countEach('.td-other-rev','input'));
	//$('#count-total-vat').html(countEach('.td-total-vat','input'));
	$('#count-vat-gio').html(countEach('.td-vat-gio','input'));
	$('#count-vat-ngoemb').html(countEach('.td-vat-ngoemb','input'));
	$('#count-vat-other').html(countEach('.td-vat-other','input'));
	
	countEachTotalVat();
	$('#count-total-vat').html(countAll('.td-total-vat'));
}
function toFloat(text){
	t = text.replace(/,/g, "");
	return parseFloat(t);
}
function countEach(c,input){
	count = 0;
	$(c).each(function(index) {
	  	//alert(toFloat($(this).find('input').val()));
	  	count = count + toFloat($(this).find(input).val())
	});
	return num_format(count);
}
function countAll(c){
	count = 0;
	$(c).each(function(index) {
	  	count = count + toFloat($(this).html())
	});
	return num_format(count);
}
function countInRow(r){
	var count = 0;
	$(r).parent().find('input[type="text"]').each(function(index, element) {
        count = count + parseFloat(removeMask($(this).val()));
    });
	return count;
	}
function countEachTotalVat(){
	$('.td-total-vat').each(function(index) {
		tr = $(this).parent();
	  	count = toFloat($(tr).find('input#vat-gio').val()) + toFloat($(tr).find('input#vat-ngoemb').val()) + toFloat($(tr).find('input#vat-other').val());
	  	$(this).html(num_format(count));
	});
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

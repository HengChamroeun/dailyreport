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
<h2 class="title">តារាងសរុបលទ្ធផល ចំណូលប្រាក់ពន្ធ និង អាករគ្រប់ប្រភេទដែលប្រមូលបាន</h2>
<h2>ចំណូលសរុបប្រចាំខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h2>
<br/>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('monthly_revenues/add_item'),$attr);
?>
<div class='table-responsive'>
<div style="">
<table class='table table-bordered' style="min-width:2000px;" id="table_input" >
    <thead>
        <tr>
            <th  class="" rowspan=4>អង្គភាព<br/>គយ និងរដ្ឋាករ</th>
            <th rowspan=4>ចំនូលប្រាក់ពន្ធ<br/>និងអាករសរុប</th>
            <th colspan=5 rowspan="2" >ចំណូលផ្សេងៗក្រៅពី អតប(VAT)</th>
            <th colspan=6>ចំណូល អតប(VAT)</th>
        </tr>
        <tr>
            <th colspan=4 >អាចស្នើសុំឥណទានបាន</th>
            <th colspan=2>មិនអាចស្នើសុំឥណទានបាន</th>
        </tr>
        <tr>
            <th rowspan="2">ពន្ធនាំចូល &nbsp;(CD)</th>
            <th rowspan="2">អាករពិសេស &nbsp;(ST)</th>
            <th rowspan="2">អាករបន្ថែម &nbsp;(AT)</th>
            <th rowspan="2">អាករនាំចេញ &nbsp;(ET)</th>
            <th rowspan="2">ផ្សេងៗទៀត &nbsp;(Other)</th>
            <th rowspan="2">លើផលិតផលផ្សេងៗ &nbsp; ក្រៅពីតេលសិលា</th>
            <th colspan="2">លើផលិតផល &nbsp; តេលសិលា</th>
            <th rowspan="2">វិនិយោគផ្សេងៗ &nbsp; ក្រៅពីកាត់ដេរ</th>
            <th rowspan="2">វិស័យកសិកម្ម</th>
            <th rowspan="2">ផ្សេងៗ</th>
        </tr>
        <tr>
            <th>ប្រេងសាំង &nbsp;EA</th>
            <th style="border-right:1px solid #ddd">ផ្សេងទៀត</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
    		<td class="">សរុប</td>
    		<td id="count-all"></td>
           <td id="count-cd"></td>
           <td id="count-st"></td>
           <td id="count-at"></td>
           <td id="count-et"></td>
           <td id="count-other"></td>
           <td id="count-vop"></td>
           <td id="count-vpp-ea"></td>
           <td id="count-vpp-other"></td>
           <td id="count-vop-io"></td>
           <td id="count-vap"></td>
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
		$mr = $this->m_global->select_data(TBLMONTHLYREVENUES,array("office_code"=>$of->code,"year"=>$year,"month"=>$month));
		//$m = $mr[0];
		//var_dump($mr);
	?>
		<tr class="">
           <td class="td-office" ><input type="hidden" id="off_hidden" value="<?php echo($of->code); ?>"><input type="hidden" id="record_id" value="<?php echo(!$mr?'0':$mr[0]->id); ?>"><?php echo($of->name_print); ?></td>
    		<td class="td-count"></td>
           <td class="td-cd"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->cd)); ?></span><input type="text" id="cd" name="cd" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->cd); ?>"></td>
           <td class="td-st"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->st)); ?></span><input type="text" id="st" name="st" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->st); ?>"></td>
           <td class="td-at"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->at)); ?></span><input type="text" id="at" name="at" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->at); ?>"></td>
           <td class="td-et"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->et)); ?></span><input type="text" id="et" name="et" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->et); ?>"></td>
           <td class="td-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->other)); ?></span><input type="text" id="other" name="other" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->other); ?>"></td>
           <td class="td-vop"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vop)); ?></span><input type="text" id="vop" name="vop" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vop); ?>"></td>
           <td class="td-vpp-ea"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vpp_ea)); ?></span><input type="text" id="vpp_ea" name="vpp_ea" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vpp_ea); ?>"></td>
           <td class="td-vpp-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vpp_other)); ?></span><input type="text" id="vpp_other" name="vpp_other" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vpp_other); ?>"></td>
           <td class="td-vop-io"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vop_io)); ?></span><input type="text" id="vop_io" name="vop_io" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vop_io); ?>"></td>
           <td class="td-vap"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vap)); ?></span><input type="text" id="vap" name="vap" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vap); ?>"></td>
           <td class="td-vat-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_other)); ?></span><input type="text" id="vat_other" name="vat_other" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vat_other); ?>"></td>
        </tr>
    <?php
		}
	if(!$ofs){
		$mr = $this->m_global->select_data(TBLMONTHLYREVENUES,array("branch_code"=>$BRANCH_CODE,"year"=>$year,"month"=>$month));
		$name_print = $this->m_global->select_record(TBLOFFICES,array('code'=>$BRANCH_CODE),'name_print');
		?>
		<tr class="">
           <td class="td-office"><input type="hidden" id="off_hidden" value="<?php echo($BRANCH_CODE); ?>"><input type="hidden" id="record_id" value="<?php echo(!$mr?'0':$mr[0]->id); ?>"><?php echo($name_print); ?></td>
    		<td class="td-count"></td>
           <td class="td-cd"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->cd)); ?></span><input type="text" id="cd" name="cd" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->cd); ?>"></td>
           <td class="td-st"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->st)); ?></span><input type="text" id="st" name="st" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->st); ?>"></td>
           <td class="td-at"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->at)); ?></span><input type="text" id="at" name="at" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->at); ?>"></td>
           <td class="td-et"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->et)); ?></span><input type="text" id="et" name="et" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->et); ?>"></td>
           <td class="td-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->other)); ?></span><input type="text" id="other" name="other" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->other); ?>"></td>
           <td class="td-vop"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vop)); ?></span><input type="text" id="vop" name="vop" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vop); ?>"></td>
           <td class="td-vpp-ea"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vpp_ea)); ?></span><input type="text" id="vpp_ea" name="vpp_ea" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vpp_ea); ?>"></td>
           <td class="td-vpp-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vpp_other)); ?></span><input type="text" id="vpp_other" name="vpp_other" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vpp_other); ?>"></td>
           <td class="td-vop-io"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vop_io)); ?></span><input type="text" id="vop_io" name="vop_io" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vop_io); ?>"></td>
           <td class="td-vap"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vap)); ?></span><input type="text" id="vap" name="vap" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vap); ?>"></td>
           <td class="td-vat-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->vat_other)); ?></span><input type="text" id="vat_other" name="vat_other" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->vat_other); ?>"></td>
        </tr>
    <?php
		}
	?>
    </tbody>
    
</table>
</div>
</div>
<input type="submit" name="submit" id="submit" class="btn btn-sm btn-success" value="បញ្ចូលទិន្នន័យ" style="display:none">
<a href="<?php echo base_url('/revenue_by_item') ?>" class="btn btn-cancel" style="background-color:#E2E2E2; margin-bottom: 20px; display:none">ចាកចេញ</a>
</form>
<div class='clear'></div>
</div>
<style>
th.fixed-col{
	border: 1px solid #ddd !important; 
	height:152px;
	}
.fixed-col{
	position:absolute;
	width:200px;
	top:auto;
	margin-left: -200px;
	background-color:#fff;
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
			window.location = '<?php echo base_url('monthly_revenues') ?>'+'?m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('monthly_revenues') ?>'+'?y=' + $(this).val()+'&m='+$('#select-month').val();
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
	cd = parseFloat(removeMask(c.find('input#cd').val()));
	st = parseFloat(removeMask(c.find('input#st').val()));
	at = parseFloat(removeMask(c.find('input#at').val()));
	et = parseFloat(removeMask(c.find('input#et').val()));
	other = parseFloat(removeMask(c.find('input#other').val()));
	vop = parseFloat(removeMask(c.find('input#vop').val()));
	vpp_ea = parseFloat(removeMask(c.find('input#vpp_ea').val()));
	vpp_other = parseFloat(removeMask(c.find('input#vpp_other').val()));
	vop_io = parseFloat(removeMask(c.find('input#vop_io').val()));
	vap = parseFloat(removeMask(c.find('input#vap').val()));
	vat_other = parseFloat(removeMask(c.find('input#vat_other').val()));
	office_code = c.find('input#off_hidden').val();
	branch_code = '<?php echo($BRANCH_CODE); ?>';
	month = '<?php echo($month); ?>';
	year = '<?php echo($year); ?>';
	var url='<?php echo base_url('monthly_revenues/addItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {cd:cd,st:st,at:at,et:et,other:other,vop:vop,vpp_ea:vpp_ea,vpp_other:vpp_other,vop_io:vop_io,vap:vap,vat_other:vat_other,office_code:office_code,branch_code:branch_code,month:month,year:year},
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
	cd = parseFloat(removeMask(c.find('input#cd').val()));
	st = parseFloat(removeMask(c.find('input#st').val()));
	at = parseFloat(removeMask(c.find('input#at').val()));
	et = parseFloat(removeMask(c.find('input#et').val()));
	other = parseFloat(removeMask(c.find('input#other').val()));
	vop = parseFloat(removeMask(c.find('input#vop').val()));
	vpp_ea = parseFloat(removeMask(c.find('input#vpp_ea').val()));
	vpp_other = parseFloat(removeMask(c.find('input#vpp_other').val()));
	vop_io = parseFloat(removeMask(c.find('input#vop_io').val()));
	vap = parseFloat(removeMask(c.find('input#vap').val()));
	vat_other = parseFloat(removeMask(c.find('input#vat_other').val()));
	office_code = c.find('input#off_hidden').val();
	branch_code = '<?php echo($BRANCH_CODE); ?>';
	month = '<?php echo($month); ?>';
	year = '<?php echo($year); ?>';
	var url='<?php echo base_url('monthly_revenues/updateItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {id:id,cd:cd,st:st,at:at,et:et,other:other,vop:vop,vpp_ea:vpp_ea,vpp_other:vpp_other,vop_io:vop_io,vap:vap,vat_other:vat_other,office_code:office_code,branch_code:branch_code,month:month,year:year},
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
	$('#count-cd').html(countEach('.td-cd','input'));
	$('#count-st').html(countEach('.td-st','input'));
	$('#count-at').html(countEach('.td-at','input'));
	$('#count-et').html(countEach('.td-et','input'));
	$('#count-other').html(countEach('.td-other','input'));
	$('#count-vop').html(countEach('.td-vop','input'));
	$('#count-vpp-ea').html(countEach('.td-vpp-ea','input'));
	$('#count-vpp-other').html(countEach('.td-vpp-other','input'));
	$('#count-vop-io').html(countEach('.td-vop-io','input'));
	$('#count-vap').html(countEach('.td-vap','input'));
	$('#count-vat-other').html(countEach('.td-vat-other','input'));
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
function num_format(num){
		var n = num.toString();
		if(n.indexOf('.')===-1){
			return num.format(0,3,',','.');
		}else{
			return num.format(2,3,',','.');
		}
	}

</script>

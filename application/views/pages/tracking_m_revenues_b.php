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
<table class='table table-bordered' id="table_input" style="width: 1500px">
    <thead>
        <tr>
            <th >អង្គភាពគយ និងរដ្ឋាករ</th>
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
    <tfoot>
    	<tr>
    		<td>សរុប</td>
           <td id="count-ngo"></td>
           <td id="count-emb"></td>
           <td id="count-gio"></td>
           <td id="count-oio"></td>
           <td id="count-exp"></td>
           <td id="count-aid"></td>
           <td id="count-ata"></td>
           <td id="count-p-min"></td>
           <td id="count-other"></td>
           <td id="count-all"></td>
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
		$mr = $this->m_global->select_data(TBLTRACKINGMREVENUESB,array("office_code"=>$of->code,"year"=>$year,"month"=>$month));
		//$m = $mr[0];
		//var_dump($mr);
	?>
		<tr class="">
           <td class="td-office"><input type="hidden" id="off_hidden" value="<?php echo($of->code); ?>"><input type="hidden" id="record_id" value="<?php echo(!$mr?'0':$mr[0]->id); ?>"><?php echo($of->name_print); ?></td>
           <td class="td-ngo"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->ngo)); ?></span><input type="text" id="ngo" name="ngo" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->ngo); ?>"></td>
           <td class="td-emb"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->emb)); ?></span><input type="text" id="emb" name="emb" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->emb); ?>"></td>
           <td class="td-gio"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->gio)); ?></span><input type="text" id="gio" name="gio" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->gio); ?>"></td>
           <td class="td-oio"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->oio)); ?></span><input type="text" id="oio" name="oio" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->oio); ?>"></td>
           <td class="td-exp"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->exp)); ?></span><input type="text" id="exp" name="exp" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->exp); ?>"></td>
           <td class="td-aid"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->aid)); ?></span><input type="text" id="aid" name="aid" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->aid); ?>"></td>
           <td class="td-ata"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->ata)); ?></span><input type="text" id="ata" name="ata" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->ata); ?>"></td>
           <td class="td-p-min"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->p_min)); ?></span><input type="text" id="p-min" name="p-min" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->p_min); ?>"></td>
           <td class="td-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->other)); ?></span><input type="text" id="other" name="other" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->other); ?>"></td>
           <td class="td-count"></td>
        </tr>
    <?php
		}
	if(!$ofs){
		$mr = $this->m_global->select_data(TBLTRACKINGMREVENUESB,array("branch_code"=>$BRANCH_CODE,"year"=>$year,"month"=>$month));
		$name_print = $this->m_global->select_record(TBLOFFICES,array('code'=>$BRANCH_CODE),'name_print');
		?>
		<tr class="">
           <td class="td-office"><input type="hidden" id="off_hidden" value="<?php echo($BRANCH_CODE); ?>"><input type="hidden" id="record_id" value="<?php echo(!$mr?'0':$mr[0]->id); ?>"><?php echo($name_print); ?></td>
    	   <td class="td-ngo"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->ngo)); ?></span><input type="text" id="ngo" name="ngo" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->ngo); ?>"></td>
           <td class="td-emb"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->emb)); ?></span><input type="text" id="emb" name="emb" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->emb); ?>"></td>
           <td class="td-gio"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->gio)); ?></span><input type="text" id="gio" name="gio" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->gio); ?>"></td>
           <td class="td-oio"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->oio)); ?></span><input type="text" id="oio" name="oio" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->oio); ?>"></td>
           <td class="td-exp"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->exp)); ?></span><input type="text" id="exp" name="exp" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->exp); ?>"></td>
           <td class="td-aid"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->aid)); ?></span><input type="text" id="aid" name="aid" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->aid); ?>"></td>
           <td class="td-ata"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->ata)); ?></span><input type="text" id="ata" name="ata" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->ata); ?>"></td>
           <td class="td-p-min"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->p_min)); ?></span><input type="text" id="p-min" name="p-min" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->p_min); ?>"></td>
           <td class="td-other"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->other)); ?></span><input type="text" id="other" name="other" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->other); ?>"></td>
           <td class="td-count"></td>
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
			window.location = '<?php echo base_url('tracking_m_revenues_b') ?>'+'?m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('tracking_m_revenues_b') ?>'+'?y=' + $(this).val()+'&m='+$('#select-month').val();
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
	ngo = parseFloat(removeMask(c.find('input#ngo').val()));
	emb = parseFloat(removeMask(c.find('input#emb').val()));
	gio = parseFloat(removeMask(c.find('input#gio').val()));
	oio = parseFloat(removeMask(c.find('input#oio').val()));
	exp = parseFloat(removeMask(c.find('input#exp').val()));
	aid = parseFloat(removeMask(c.find('input#aid').val()));
	ata = parseFloat(removeMask(c.find('input#ata').val()));
	p_min = parseFloat(removeMask(c.find('input#p-min').val()));
	other = parseFloat(removeMask(c.find('input#other').val()));
	
	office_code = c.find('input#off_hidden').val();
	branch_code = '<?php echo($BRANCH_CODE); ?>';
	month = '<?php echo($month); ?>';
	year = '<?php echo($year); ?>';
	var url='<?php echo base_url('tracking_m_revenues_b/addItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {ngo:ngo,emb:emb,gio:gio,oio:oio,exp:exp,aid:aid,ata:ata,p_min:p_min,other:other,office_code:office_code,branch_code:branch_code,month:month,year:year},
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
	ngo = parseFloat(removeMask(c.find('input#ngo').val()));
	emb = parseFloat(removeMask(c.find('input#emb').val()));
	gio = parseFloat(removeMask(c.find('input#gio').val()));
	oio = parseFloat(removeMask(c.find('input#oio').val()));
	exp = parseFloat(removeMask(c.find('input#exp').val()));
	aid = parseFloat(removeMask(c.find('input#aid').val()));
	ata = parseFloat(removeMask(c.find('input#ata').val()));
	p_min = parseFloat(removeMask(c.find('input#p-min').val()));
	other = parseFloat(removeMask(c.find('input#other').val()));
	
	office_code = c.find('input#off_hidden').val();
	branch_code = '<?php echo($BRANCH_CODE); ?>';
	month = '<?php echo($month); ?>';
	year = '<?php echo($year); ?>';
	var url='<?php echo base_url('tracking_m_revenues_b/updateItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {id:id,ngo:ngo,emb:emb,gio:gio,oio:oio,exp:exp,aid:aid,ata:ata,p_min:p_min,other:other,office_code:office_code,branch_code:branch_code,month:month,year:year},
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
	var url='<?php echo base_url('tracking_m_revenues_b/deleteItem') ?>';
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
	$('#count-ngo').html(countEach('.td-ngo','input'));
	$('#count-emb').html(countEach('.td-emb','input'));
	$('#count-gio').html(countEach('.td-gio','input'));
	$('#count-oio').html(countEach('.td-oio','input'));
	$('#count-exp').html(countEach('.td-exp','input'));
	$('#count-aid').html(countEach('.td-aid','input'));
	$('#count-ata').html(countEach('.td-ata','input'));
	$('#count-p-min').html(countEach('.td-p-min','input'));
	$('#count-other').html(countEach('.td-other','input'));
	
	//countEachTotalVat();
	//$('#count-total-vat').html(countAll('.td-total-vat'));
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

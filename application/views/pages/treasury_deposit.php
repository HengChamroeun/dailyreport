<?php 	
//$items = $this->m_global->select_data(TBLITEMS,NULL,array('id'=>'ASC'),0);
$month = date('m');
$month = $month - 1;
if($this->input->get('m')){
	$month = $this->input->get('m');
	}
$year = date('Y');
if($this->input->get('y')){
	$year = $this->input->get('y');
	}
?>
<div class="jumbotron" style="min-height:500px;">
<h2 class="title">តារាងសរុបលទ្ធផលចំណូលបង់ចូលរតនាគារជាតិនិងសល់បេឡា</h2>
<h2>ប្រចាំខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h2>
<br/>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('treasury_deposit'),$attr);
?>
<div class='table-responsive'>
<table class='table table-bordered' id="table_input" style="width: 1170px">
    <thead>
        <tr>
            <th rowspan="2">អង្គភាពគយ<br/>និងរដ្ឋាករ</th>
            <th rowspan="2">សល់បេឡាចុង<br/>សប្តាហ៍មុន</th>
            <th colspan="2">ចំណូល</th>
            <th colspan="2">ចំណូលបង់ចូលតាមរតនាគារ</th>
            <th rowspan="2">ចំណាយមាន<br/>ការអនុញ្ញាត</th>
            <th rowspan="2">សល់បេឡាចុងសប្តាហ៍</th>
        </tr>
        <tr>
        	<th>បូកបន្តក្នុងខែ</th>
            <th>បូកបន្តក្នុងឆ្នាំ</th>
            <th>បូកបន្តក្នុងខែ</th>
            <th>បូកបន្តក្នុងឆ្នាំ</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
    		<td>សរុប</td>
           <td id="count-forward-balance"></td>
           <td id="count-rev-in-month"></td>
           <td id="count-rev-year-acc"></td>
           <td id="count-trea-de-in-month"></td>
           <td id="count-trea-de-year-acc"></td>
           <td id="count-authorized-expanse"></td>
           <td id="count-balance"></td>
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
		$mr = $this->m_global->select_data(TBLTREASURY_DEPOSIT,array("office_code"=>$of->code,"year"=>$year,"month"=>$month));
		//$m = $mr[0];
		//var_dump($mr);
	?>
		<tr class="" data-office-code="<?php echo($of->code); ?>" data-record-id="<?php echo(!$mr?'0':$mr[0]->id); ?>">
           <td class="td-office"><?php echo($of->name_print); ?></td>
           <td class="td-forward-balance"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->forward_balance)); ?></span><input type="text" id="forward-balance" name="forward_balance" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->forward_balance); ?>"></td>
           <td class="td-rev-in-month"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->rev_in_month)); ?></span><input type="text" id="rev-in-month" name="rev_in_month" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->rev_in_month); ?>"></td>
           <td class="td-rev-year-acc"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->rev_year_acc)); ?></span><input type="text" id="rev-year-acc" name="rev_year_acc" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->rev_year_acc); ?>"></td>
           <td class="td-trea-de-in-month"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->trea_de_in_month)); ?></span><input type="text" id="trea-de-in-month" name="trea_de_in_month" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->trea_de_in_month); ?>"></td>
           <td class="td-trea-de-year-acc"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->trea_de_year_acc)); ?></span><input type="text" id="trea-de-year-acc" name="trea_de_year_acc" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->trea_de_year_acc); ?>"></td>
           <td class="td-authorized-expanse"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->authorized_expanse)); ?></span><input type="text" id="authorized-expanse" name="authorized_expanse" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->authorized_expanse); ?>"></td>
           <td class="td-balance"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->balance)); ?></span><input type="text" id="balance" name="balance" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->balance); ?>"></td>
        </tr>
    <?php
		}
	if(!$ofs){
		$mr = $this->m_global->select_data(TBLTREASURY_DEPOSIT,array("branch_code"=>$BRANCH_CODE,"year"=>$year,"month"=>$month));
		$name_print = $this->m_global->select_record(TBLOFFICES,array('code'=>$BRANCH_CODE),'name_print');
		?>
		<tr class="" data-office-code="<?php echo($BRANCH_CODE); ?>" data-record-id="<?php echo(!$mr?'0':$mr[0]->id); ?>">
           <td class="td-office" ><?php echo($name_print); ?></td>
    	   <td class="td-forward-balance"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->forward_balance)); ?></span><input type="text" id="forward-balance" name="forward_balance" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->forward_balance); ?>"></td>
           <td class="td-rev-in-month"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->rev_in_month)); ?></span><input type="text" id="rev-in-month" name="rev_in_month" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->rev_in_month); ?>"></td>
           <td class="td-rev-year-acc"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->rev_year_acc)); ?></span><input type="text" id="rev-year-acc" name="rev_year_acc" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->rev_year_acc); ?>"></td>
           <td class="td-trea-de-in-month"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->trea_de_in_month)); ?></span><input type="text" id="trea-de-in-month" name="trea_de_in_month" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->trea_de_in_month); ?>"></td>
           <td class="td-trea-de-year-acc"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->trea_de_year_acc)); ?></span><input type="text" id="trea-de-year-acc" name="trea_de_year_acc" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->trea_de_year_acc); ?>"></td>
           <td class="td-authorized-expanse"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->authorized_expanse)); ?></span><input type="text" id="authorized-expanse" name="authorized_expanse" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->authorized_expanse); ?>"></td>
           <td class="td-balance"><span class="disp"><?php echo(!$mr?'0':num_format($mr[0]->balance)); ?></span><input type="text" id="balance" name="balance" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo(!$mr?'0':$mr[0]->balance); ?>"></td>
        </tr>
    <?php
		}
	?>
    </tbody>
    
</table>

</div>
<input type="submit" name="submit" id="submit" class="btn btn-sm btn-success" value="បញ្ចូលទិន្នន័យ" style="display:none">
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
		
    });
	$(document).on('keypress','#table_input td input',function(e) {
        
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

	$(document).on('change','#select-month',function(e){
		if($(this).val()!='0' && $('select-year').val()!='0'){
			window.location = '<?php echo base_url('treasury_deposit') ?>'+'?m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('treasury_deposit') ?>'+'?y=' + $(this).val()+'&m='+$('#select-month').val();
			}
		});
});

function showElement(c){
	$(c).css('display','block');
	}
function hideElement(c){
	$(c).css('display','none');
	}
function setFloatValue(element,val){
	$(element).val(parseFloat(val).format(0,3,',','.'))
	}


function addItem(row){
	c = $(row);
	//id = c.find('input#record_id').val();
	//alert(c.find('input#balance').val()+"-"+c.find('input#authorized-expanse').val()+"-"+c.find('input#trea-de-in-month').val()+"-");
	forward_balance = parseFloat(removeMask(c.find('input#forward-balance').val()));
	rev_in_month = parseFloat(removeMask(c.find('input#rev-in-month').val()));
	rev_year_acc = parseFloat(removeMask(c.find('input#rev-year-acc').val()));
	trea_de_in_month = parseFloat(removeMask(c.find('input#trea-de-in-month').val()));
	trea_de_year_acc = parseFloat(removeMask(c.find('input#trea-de-year-acc').val()));
	authorized_expanse = parseFloat(removeMask(c.find('input#authorized-expanse').val()));
	balance = parseFloat(removeMask(c.find('input#balance').val()));
	
	office_code = c.attr('data-office-code');
	branch_code = '<?php echo($BRANCH_CODE); ?>';
	month = '<?php echo($month); ?>';
	year = '<?php echo($year); ?>';
	var url='<?php echo base_url('treasury_deposit/addItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {forward_balance:forward_balance,rev_in_month:rev_in_month,rev_year_acc:rev_year_acc,trea_de_in_month:trea_de_in_month,trea_de_year_acc:trea_de_year_acc,authorized_expanse:authorized_expanse,balance:balance,office_code:office_code,branch_code:branch_code,month:month,year:year},
			success: function(data){
				if(data !=''){
					//location.reload();
					c.attr('data-record-id',data);
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
		
	id = c.attr('data-record-id');
	if(id=='0'){
		addItem(c);
		}
	else{
		updateItem(c);
		}
	}
function updateItem(row){
	c = $(row);
	id = c.attr('data-record-id');
	forward_balance = parseFloat(removeMask(c.find('input#forward-balance').val()));
	rev_in_month = parseFloat(removeMask(c.find('input#rev-in-month').val()));
	rev_year_acc = parseFloat(removeMask(c.find('input#rev-year-acc').val()));
	trea_de_in_month = parseFloat(removeMask(c.find('input#trea-de-in-month').val()));
	trea_de_year_acc = parseFloat(removeMask(c.find('input#trea-de-year-acc').val()));
	authorized_expanse = parseFloat(removeMask(c.find('input#authorized-expanse').val()));
	balance = parseFloat(removeMask(c.find('input#balance').val()));
	
	office_code = c.attr('data-office-code');
	branch_code = '<?php echo($BRANCH_CODE); ?>';
	month = '<?php echo($month); ?>';
	year = '<?php echo($year); ?>';
	var url='<?php echo base_url('treasury_deposit/updateItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {id:id,forward_balance:forward_balance,rev_in_month:rev_in_month,rev_year_acc:rev_year_acc,trea_de_in_month:trea_de_in_month,trea_de_year_acc:trea_de_year_acc,authorized_expanse:authorized_expanse,balance:balance,office_code:office_code,branch_code:branch_code,month:month,year:year},
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

function countRevenue(){
	
	$('#count-forward-balance').html(countEach('.td-forward-balance','input'));
	$('#count-rev-in-month').html(countEach('.td-rev-in-month','input'));
	$('#count-rev-year-acc').html(countEach('.td-rev-year-acc','input'));
	$('#count-trea-de-in-month').html(countEach('.td-trea-de-in-month','input'));
	$('#count-trea-de-year-acc').html(countEach('.td-trea-de-year-acc','input'));
	$('#count-authorized-expanse').html(countEach('.td-authorized-expanse','input'));
	$('#count-balance').html(countEach('.td-balance','input'));
	
}
function toFloat(text){
	t = text.replace(/,/g, "");
	return parseFloat(t);
}
function countEach(c,input){
	count = 0;
	$(c).each(function(index) {
	  	count = count + toFloat($(this).find(input).val())
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

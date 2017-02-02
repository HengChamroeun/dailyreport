<?php
$date = date("Y-m-d");
	if($this->input->get("date")){
		$date = $this->input->get("date");
		}


$month = date('m');
if($this->input->get('m')){
	//$month = $this->input->get('m');
	}
$year = date('Y');
$c_year = date('Y');
if($this->input->get('y')){
	$year = $this->input->get('y');
	}


//RULE
//Current quarter = RoundUp ((current_month - 3)/3) + 1;
// valid_from_month = ((Q - 1) *3) + 1;


$quarter = 0;
$c_quarter = (($month - 3)/3)+1;
$c_quarter = ceil($c_quarter);

$valid_from = '';
$valid_to = '';	
$valid_from_month = '';
$valid_to_month = '';

if($this->input->get('quarter')){
	$quarter = $this->input->get('quarter');
	}
else{
	$quarter = $c_quarter;
}
$valid_from_month = ((intval($quarter) - 1) *3) + 1;
$valid_from_month = (intval($valid_from_month)<=9?'0'.$valid_from_month:$valid_from_month);
$valid_to_month = intval($valid_from_month)+2;
$valid_to_month = (intval($valid_to_month)<=9?'0'.$valid_to_month:$valid_to_month);
$last_of_month = date("t", strtotime($year.'-'.$valid_to_month.'-01'));
$last_of_month = (intval($last_of_month)<=9?'0'.$last_of_month:$last_of_month);

$valid_from = $year.'-'.$valid_from_month.'-01';
$valid_to = $year.'-'.$valid_to_month.'-'.$last_of_month;
//var_dump($valid_from);
//var_dump($valid_to);
//var_dump($c_quarter);
//var_dump($quarter);

$editable = true;
if(intval($year) < intval($c_year)){
		$editable = false;
	}
	else if((intval($year) == intval($c_year)) && (intval($quarter) < intval($c_quarter))){
		$editable = false;
	}
?>
    <div class="jumbotron">
		  <h2>ផែនការ <?php selectQuarter($quarter); ?> ឆ្នាំ <?php selectYear($year); ?></h2>
		  <br/>
			<table class='table' id='table_input_bur'>
				<thead>
				<tr class="trheader">
					<th style='width:50px'>លេខ.</th>
					<th>សាខា</th>
					<th style="width:320px">ផែនការត្រីមាស</th>
					<th>កែតម្រូវ</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$branches=$this->m_global->select_data(TBLOFFICES, array('parent_code'=>'CHQ00','status'=>'1'),array('level_quarter_plan'=>'ASC'));
					$i=1;
					foreach($branches as $b){
						//$plan=$this->m_global->select_record(TBLPLANNERS,array('branch_code'=>$b->code,'office_code'=>$b->code, 'valid_from <= '=>$DATE,'valid_to'=>''),'amount');
						$plan = $this->m_customs->getPlanByOffice('CHQ00',$b->code,$valid_from,$valid_to);
						//$plan = floatval($plan)/3;
						?>
						 <tr refdata="<?php echo($b->code);?>" data-branch-id="CHQ00" data-plan-id="<?php echo($plan->id); ?>" class="row_boldKH tr_input tr_branch">
						 <td class="td_i"><?php echo($i);?></td>
						 <td class='user_td2'><span class='user_span'><?php echo($b->name); ?></span></td>
						 <td class='planner'><span class="disp"><?php echo num_format($plan->amount); ?></span><?php if($editable){ ?><input type="text" id="plan" name="pan" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($plan->amount); ?>"><?php } ?></td>
						 <td><a class="btn btn-xs btn-danger" href="#delete"><i class="fa fa-trash-o"></i></a></td>
						 </tr>
						<?php
						$offs=$this->m_global->select_data(TBLOFFICES, array('parent_code'=>$b->code,'status'=>'1'),array('level'=>'ASC'));
							foreach($offs as $off){
								//$plan_off=$this->m_global->select_record(TBLPLANNERS,array('branch_code'=>$b->code,'office_code'=>$off->code, 'valid_from <= '=>$DATE,'valid_to'=>''),'amount');
								$plan_off = $this->m_customs->getPlanByOffice($b->code,$off->code,$valid_from,$valid_to);
								//$plan_off = floatval($plan_off)/3;
								?>
								<tr refdata="<?php echo($off->code); ?>" data-branch-id="<?php echo($b->code); ?>" data-plan-id="<?php echo($plan_off->id); ?>" class="tr_input tr_office">
								<td class="td_i"></td>
								<td class='user_td2'>-<span class='user_span'><?php echo($off->name); ?></span></td>
								<td class='planner'><span class="disp"><?php echo num_format($plan_off->amount); ?></span><?php if($editable){ ?><input type="text" id="plan" name="pan" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($plan_off->amount); ?>"><?php } ?></td>
								<td><a class="btn btn-xs btn-danger" href="#delete"><i class="fa fa-trash-o"></i></a></td>
								</tr>
								<?php
							}
						$i++;
					}
				?>
				</tbody>
			</table>
    </div>
	<style>
		.table td{text-align:left;}
		.trheader{
			background-color: #337ab7;
			border-color: #2e6da4;
			color: #fff;
		}
		a.btnmargin{
			margin: 10px;
		}
		.reserved_has_input {padding:0px !important;}
		.table .row_boldKH .user_td2{font-family:  KHMER MEF2;}
		
		
		#table_input_bur td{
			height:50px;
			vertical-align:middle;
		}
		span.disp{
			display:block;
        }
		td.td_item span.disp{
			display:none;
        }
		.tr_input input{
			width:200px;
			display:none;
		}
		td a.btn-danger, .jumbotron a.btn.btn-danger{
			width:27px;
			height:30px;
			padding: 3px;
			padding-top:0px;
		}
		.tr_office{
			background-color:#F5F5F5;
		}
		.tr_branch{
			background-color:#EAEAEA;
		}
		.td_i{
			text-align:middle;
		}
	</style>
	<script>
	$(document).ready(function(){
		$(document).on('change','#select-quarter',function(e){
		if($(this).val()!='0' && $('select-year').val()!='0'){
			window.location = '<?php echo base_url('admin/quarter_planning') ?>'+'?'+'quarter=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-quarter').val()!='0'){
			window.location = '<?php echo base_url('admin/quarter_planning') ?>'+'?'+'y=' + $(this).val()+'&quarter='+$('#select-quarter').val();
			}
		});
	
	$(document).on( "click",'#table_input_bur td',function(e) {
        input = $(this).find('input');
        if(input.css('display')=='none'){
            hideElement($(this).find('span.disp'));
            showElement($(this).find('input'));
            input.focus();
        }
    });
	$(document).on('focusout','#table_input_bur td input',function(e) {
        input = $(this);
        if(input.css('display')=='block'){
           hideElement(input);
           input.val($(input).parent().find('span.disp').html());
           showElement($(input).parent().find('span.disp'));
       }
    });
	$(document).on('keypress','#table_input_bur td input',function(e) {
            if(e.which == 13){
                e.preventDefault();
                if($(this).val()==''){
                    $(this).val($(this).parent().find('span.disp').html());
                }else{
                    $(this).parent().find('span.disp').html($(this).val());
                }
                /*bootbox.dialog({
                    message: "កុំពុងរក្សាទុកទិន្នន័យ ...",
                    title: "សូមរង់ចាំ",
                    closeButton: false
                });*/
                updateItem($(this).parent().parent());
                hideElement($(this));
                showElement($(this).parent().find('span.disp'));
            }
        
    });
	$(document).on('click','#table_input_bur td a.btn-danger',function(e){
		//deleteItem($(this).parent().parent());
		if(confirm('Are u sure to delete?')){
			deleteItem($(this).parent().parent());
		}
		else{
			//alert('no');
		}
	});
	
	//end document ready
	});
	function updateItem(tr){
		office_code = $(tr).attr("refdata");
		branch_code = $(tr).attr("data-branch-id");
		plan_id = $(tr).attr("data-plan-id");
		valid_from = '<?php echo($valid_from); ?>';
		valid_to = '<?php echo($valid_to); ?>';
		amount = parseFloat(removeMask($(tr).find('input').val()));
		//alert(valid_from+"/"+amount);
		
		var url='<?php echo base_url('admin/quarter_planning/add') ?>';
        $.ajax({
                type: "POST",
                url: url,
                dataType: 'text',
                data: {
					plan_id:plan_id,
                    office_code:office_code,
                    branch_code:branch_code,
					valid_from:valid_from,
					valid_to:valid_to,
					amount:amount
                },
                success: function(data){
                    if(data.indexOf(':id:')==0 && plan_id == '0'){
						//alert(data);
						$(tr).attr('data-plan-id',replaceAll(':id:','',data));
                    }
                    else{
                        //alert('Error saving data, please reload and try again!');
                    }
                },
                error: function(data){
                    alert('error:' + data);
                }
            });
	}
	function deleteItem(tr){
		plan_id = $(tr).attr("data-plan-id");
		if(plan_id != '0'){
			var url='<?php echo base_url('admin/quarter_planning/delete') ?>';
			$.ajax({
					type: "POST",
					url: url,
					dataType: 'text',
					data: {
						plan_id:plan_id
					},
					success: function(data){
						$(tr).attr("data-plan-id","0");
						$(tr).find('.disp').html('0');
						$(tr).find('input').val('0');
					},
					error: function(data){
						alert('error:' + data);
					}
				});
		}
		
	}
	
	function showElement(c){
	$(c).css('display','block');
	}
	function hideElement(c){
		$(c).css('display','none');
	}
	</script>
<?php
$branchs = $this->m_global->select_data(TBLOFFICES,array('parent_code'=>'CHQ00','status'=>'1'),array('level'=>'ASC'));

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
<style>
ul.opt li{
	margin-bottom:5px;
	}
ul#ul_sub{
	list-style:none; 
	padding:20px;
	padding-bottom:10px; 
	background-color:#F0F0F0;
	}
ul#ul_sub li{
	margin-bottom:10px;
	}
.btn-small{
	font-size:14px !important;
	}
</style>
<div class="jumbotron" style="min-height:400px;">
<h2>ចំណូលពន្ធតាមមុខទំនិញប្រចាំខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h2>
<form>
<div style="display:block;text-align:left;width:500px; margin:0 auto; margin-top:20px;">
<ul style="list-style:none;" class="opt">
	<li><hr style="border-color:#ABABAB" /></li>
	<li><input type="radio" id="rdo_all" name="rdo_opt" value="all" checked ><label for="rdo_all">&nbsp;ចំណូលសរុបរួមសង្ខេប</label></li>
    <li><input type="radio" id="rdo_sum_office" name="rdo_opt" value="sum-office" ><label for="rdo_sum_office">&nbsp;ចំនូលសរុបរួមតាមសាខា</label></li>
    <li><input type="radio" id="rdo_sub" name="rdo_opt" value="sub" >
    	<label for="rdo_sub">តាមសាខា/ការិយាល័យ</label>
        <ul id="ul_sub" class="opt">
        	<li>- សរុបតាមនាយកដ្ឋាន/សាខា&nbsp;<?php selectBranchs($branchs); ?></li>
           <li>- សរុបតាមការិយាល័យ&nbsp;<select id="select-offices" name="select_offices"><option value="0">ជ្រើសរើស</option></select></li>
        </ul>
        
    </li>
    <li><hr style="border-color:#ABABAB" /></li>
    <li><input type="radio" id="rdo_export_all" name="rdo_opt" value="export_all" ><label for="rdo_export_all">&nbsp;ចំណូលនាំចេញសរុបរួមសង្ខេប</label></li>
    <li><input type="radio" id="rdo_export_sum_office" name="rdo_opt" value="export-sum-office" ><label for="rdo_export_sum_office">&nbsp;ចំណូលនាំចេញសរុបរួមតាមសាខា</label></li>
    <li><hr style="border-color:#ABABAB" /></li>
	<li><input type="button" name="submit" value="ចូល" id="submit" class="btn btn-primary btn-small"></li>
</ul>
</div>
</form>
</div>
<script>
$(document).ready(function(e) {
    $('#ul_sub').click(function(e) {
        $('#rdo_sub').prop('checked',true);
    });
	$('#select-branches').change(function(e) {
        if($(this).val()=='0'){
			$('#select-offices').html('<option value="0">ជ្រើសរើស</option>');
			}else{
				var url='<?php echo base_url('admin/monthly_item_revenues_front/selectOffices') ?>';
				var branch = $('#select-branches').val();
				$.ajax({
						type: "POST",
						url: url,
						dataType: 'text',
						data: {branch:branch},
						success: function(data){
							if(data !=''){
								//alert(data);
								$('#select-offices').html(data);
								}
						},
						error: function(data){
							alert('error:' + data);
							location.reload();
							}
					});
				}
    });
    $('#submit').click(function() {
		var rd = $('input:radio[name=rdo_opt]:checked').val();
        if(rd=='all'){
        	window.location = '<?php echo base_url('admin/monthly_item_revenues/'); ?>?m='+$("#select-month").val()+'&y='+$('#select-year').val();
        }
        else if(rd=='sub'){
        	window.location = '<?php echo base_url('admin/monthly_item_revenues_by_office/'); ?>?branch='+$('#select-branches').val()+'&office='+$('#select-offices').val()+'&m='+$("#select-month").val()+'&y='+$('#select-year').val();
        }
		else if(rd=='export_all'){
			window.location = '<?php echo base_url('admin/monthly_export_revenues/'); ?>?m='+$("#select-month").val()+'&y='+$('#select-year').val();
		}
		else if(rd=='sum-office'){
			window.location = '<?php echo base_url('admin/monthly_item_office_revenues/'); ?>?m='+$("#select-month").val()+'&y='+$('#select-year').val();
		}
		else if(rd=='export-sum-office'){
			window.location = '<?php echo base_url('admin/monthly_export_office_revenues/'); ?>?m='+$("#select-month").val()+'&y='+$('#select-year').val();
		}
        });
});
</script>
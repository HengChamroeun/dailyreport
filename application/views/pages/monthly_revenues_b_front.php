<?php
//$branchs = $this->m_global->select_data(TBLOFFICES,array('parent_code'=>'CHQ00','status'=>'1'),array('level'=>'ASC'));

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
<h2>ចំណូលពន្ធ និង អាករគ្រប់ប្រភេទជាបន្ទុករដ្ឋខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h2>
<form>
<div style="display:block;text-align:left;width:500px; margin:0 auto; margin-top:20px;">
<ul style="list-style:none;" class="opt">
	<li><hr style="border-color:#ABABAB" /></li>
	<li><input type="radio" id="rdo_mrb" name="rdo_opt" value="mrb" checked ><label for="rdo_mrb">&nbsp;តារាងសរុបពន្ធ និងអាករគ្រប់ប្រភេទជា​បន្ទុករដ្ឋ</label></li>
    <li><input type="radio" id="rdo_tmrb" name="rdo_opt" value="tmrb" ><label for="rdo_tmrb">&nbsp;តារាងតាមដានប្រាក់ពន្ធ និងអាករជាបន្ទុករដ្ឋ</label></li>
    <li><br/></li>
	<li><input type="button" name="submit" value="ជ្រើសរើស" id="submit" class="btn btn-primary btn-small"></li>
</ul>
</div>
</form>
</div>
<script>
$(document).ready(function(e) {
    $('#ul_sub').click(function(e) {
        $('#rdo_sub').prop('checked',true);
    });
    $('#submit').click(function() {
		var rd = $('input:radio[name=rdo_opt]:checked').val();
        if(rd=='mrb'){
        	window.location = '<?php echo base_url('monthly_revenues_b/'); ?>?m='+$("#select-month").val()+'&y='+$('#select-year').val();
        }
        else if(rd=='tmrb'){
        	window.location = '<?php echo base_url('tracking_m_revenues_b/'); ?>?m='+$("#select-month").val()+'&y='+$('#select-year').val();
        }
        });
});
</script>
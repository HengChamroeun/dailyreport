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
.pad-in{
	padding-left:20px;
	padding-bottom:10px;
	}
</style>
<div class="jumbotron" style="min-height:400px;">
<h2>ចំណូលប្រាក់ពន្ធ និង អាករគ្រប់ប្រភេទជាបន្ទុករដ្ឋ</h2>
<form>
<div style="display:block;text-align:left;width:500px; margin:0 auto; margin-top:20px;">
<ul style="list-style:none;" class="opt">
	<li><hr style="border-color:#ABABAB" /></li>
	<li><input type="radio" id="rdo_mrb" name="rdo_opt" value="mrb" checked ><label for="rdo_mrb">&nbsp;តារាងសរុបពន្ធ និងអាករគ្រប់ប្រភេទជា​បន្ទុករដ្ឋ</label></li>
    <li><input type="radio" id="rdo_tmrb" name="rdo_opt" value="tmrb" ><label for="rdo_tmrb">&nbsp;តារាងតាមដានប្រាក់ពន្ធ និងអាករជាបន្ទុករដ្ឋ</label></li>
    <li class="pad-in">តារាងសំរាប់&nbsp;
    	<select name="select_type" id="select_type">
        	<option value="monthly">ខែ</option>
            <option value="quarterly">ត្រីមាស</option>
            <option value="half">ឆមាស</option>
            <option value="9month">៩ខែ</option>
            <option value="yearly">ឆ្នាំ</option>
            <option value="yearlybymonth">សរុប១ឆ្នាំតាមខែ</option>
        </select>
    </li>
    <li id="li-m" class="pad-in">ខែ&nbsp;<?php selectMonth($month); ?></li>
    <li id="li-q" style="display:none" class="pad-in">ត្រីមាស&nbsp;
    	<select name="select_q" id="select_q">
        	<option value="q1">ត្រីមាសទីមួយ</option>
            <option value="q2">ត្រីមាសទីពីរ</option>
            <option value="q3">ត្រីមាសទីបី</option>
            <option value="q4">ត្រីមាសទីបួន</option>
        </select>
    </li>
    <li id="li-h" style="display:none" class="pad-in">ឆមាស&nbsp;
    	<select name="select_h" id="select_h">
        	<option value="h1">ឆមាសទីមួយ</option>
            <option value="h2">ឆមាសទីពីរ</option>
        </select>
    </li>
    <li id="li-t" class="pad-in">តារាង&nbsp;
    	<select name="select_t" id="select_t">
        	<option value="t1">តារាងទីមួយ</option>
            <option value="t2">តារាងផ្សេងៗ</option>
        </select>
    </li>
    <li class="pad-in">ឆ្នាំ&nbsp;<?php selectYear($year); ?></li>
    <li><br/></li>
	<li class="pad-in"><input type="button" name="submit" value="ជ្រើសរើស" id="submit" class="btn btn-primary btn-small"></li>
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
		var for_ = "";
		var month = $("#select-month").val();
		var q = $("#select_q").val();
		var h = $("#select_h").val();
		var y = $('#select-year').val();
		var val = $("#select_type").val();
		var t = $("#select_t").val();
		var rd = $('input:radio[name=rdo_opt]:checked').val();
		
		if(val=='monthly'){
			for_ = "?list=monthly&y="+y+"&m="+month;
			}
		else if(val=='quarterly'){
			for_ = "?list=quarterly&y="+y+"&q="+q;
			}
		else if(val=='half'){
			for_ = "?list=half&y="+y+"&h="+h;
			}
		else if(val=='9month'){
			for_ = "?list=9month&y="+y+"&m9=1";
			}
		else if(val=='yearly'){
			for_ = "?list=yearly&y="+y;
			}
		else if(val=='yearlybymonth'){
			if(rd=='mrb'){
				for_ = "/mrb_by_quarter/?list=yearlybymonth&y="+y+"&m="+month;
				}
				else if(rd=='tmrb'){
					for_ = "/tracking_mrb_by_quarter/?list=yearlybymonth&y="+y+"&m="+month;
				}
			}
		
		if($("#li-t").css("display")!='none' && val !='yearlybymonth'){
			if(t=='t1'){
			for_ = (rd=='mrb'?"/":"/tracking_")+"mrb_print_1/"+for_;
			}
			else if(t=='t2'){
			for_ = (rd=='mrb'?"/":"/tracking_")+"mrb_print_2/"+for_;
				}
			}
			
        if(rd=='mrb'){
			//alert('<?php echo base_url('admin/monthly_revenues_b/'); ?>'+for_);
        	window.location = '<?php echo base_url('admin/monthly_revenues_b/'); ?>'+for_;
        }
        else if(rd=='tmrb'){
        	//alert('<?php echo base_url('admin/tracking_m_revenues_b/'); ?>'+for_);
			window.location = '<?php echo base_url('admin/tracking_m_revenues_b/'); ?>'+for_;
        }
        });
	$("#select_type").change(function(e) {
        val = $(this).val();
		if(val=='monthly'){
			showLi('#li-t');
			showLi('#li-m');
			showLi("#li-year");
			hideLi("#li-q");
			hideLi("#li-h");
			}
		else if(val=='quarterly'){
			showLi('#li-t');
			hideLi('#li-m');
			showLi("#li-year");
			showLi("#li-q");
			hideLi("#li-h");
			}
		else if(val=='half'){
			showLi('#li-t');
			hideLi('#li-m');
			showLi("#li-year");
			hideLi("#li-q");
			showLi("#li-h");
			}
		else if(val=='9month'){
			showLi('#li-t');
			hideLi('#li-m');
			showLi("#li-year");
			hideLi("#li-q");
			hideLi("#li-h");
			}
		else if(val=='yearly'){
			showLi('#li-t');
			hideLi('#li-m');
			showLi("#li-year");
			hideLi("#li-q");
			hideLi("#li-h");
			}
		else if(val=='yearlybymonth'){
			hideLi('#li-t');
			showLi('#li-m');
			showLi("#li-year");
			hideLi("#li-q");
			hideLi("#li-h");
			}
    });
	function showLi(li){
		$(li).css('display','list-item');
		}
	function hideLi(li){
		$(li).css('display','none');
		}
});
</script>
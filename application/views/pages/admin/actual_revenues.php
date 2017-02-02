<div class="jumbotron" style="border: 0px;">
<h2>ចំណូលប្រចាំខែ <?php selectMonth($m);?> ឆ្នាំ <?php selectYear($y); ?></h2>
<br/>
<form action="#" id="form">
<div style="display:block;text-align:left;width:500px; margin:0 auto; margin-top:10px;padding-bottom:20px;">
	<div class="item">
    	<div class="left">
        	<label for="amount">ចំណូលដុល</label>
        </div>
        <div class="right">
        	<input type="text" name="amount" id="amount" class="form-control" value="<?php echo isset($rev->amount)?easy_number_format($rev->amount):0 ?>" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" />
        </div>
    </div>
    <div class="item">
    	<div class="left">
        	<label for="net_amount">ចំណូលសុទ្ធ</label>
        </div>
        <div class="right">
        	<input type="text" name="net_amount" id="net_amount" class="form-control" value="<?php echo isset($rev->net_amount)?easy_number_format($rev->net_amount):0 ?>" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" />
        </div>
    </div>
    <div class="item">
    	<div class="left">
        	<label for="prize">ប្រាក់រង្វាន់</label>
        </div>
        <div class="right">
        	<input type="text" name="prize" id="prize" class="form-control" value="<?php echo isset($rev->prize)?easy_number_format($rev->prize):0 ?>" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" />
        </div>
    </div>
    <div class="item" style="text-align:right">
    	<input type="submit" name="submit" value="បញ្ចូលចំណូល" id="submit" class="btn btn-primary btn-small">
    </div>
</div>
</form>
</div>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('#amount').keyup(function(e) {
			calcPrize();
        });
		 $('#net_amount').keyup(function(e) {
			calcPrize();
        });
		$('#prize').keyup(function(e) {
			calcNetAmount();
        });
		$('#form').submit(function(e) {
            e.preventDefault();
			var amount = parseFloat(removeMask($('#amount').val()));
			var net_amount = parseFloat(removeMask($('#net_amount').val()));
			var prize = parseFloat(removeMask($('#prize').val()));
			var year = $('#select-year').val();
			var month = $('#select-month').val();
			//alert(amount + ' '+net_amount + ' '+year + ' '+month);
			
			var url='<?php echo base_url('admin/actual_revenues/revenue') ?>';
			$.ajax({
					type: "POST",
					url: url,
					dataType: 'text',
					data: {
						amount:amount,
						net_amount:net_amount,
						prize:prize,
						month:month,
						year:year
					},
					success: function(data){
						alert('ចំណូលត្រូវបានបញ្ចូលរួចរាល់!');
						//location.reload();
					},
					error: function(data){
						alert('error:' + data);
						location.reload();
					}
				});
        });
		$('#select-month').change(function(e) {
            getRevenue();
        });
		$('#select-year').change(function(e) {
            getRevenue();
        });
    });
	function calcPrize(){
		var amount = parseFloat(removeMask($('#amount').val()));
		var net_amount = parseFloat(removeMask($('#net_amount').val()));
		var prize = amount - net_amount;
		$('#prize').val(prize);
	}
	function calcNetAmount(){
		var amount = parseFloat(removeMask($('#amount').val()));
		var prize = parseFloat(removeMask($('#prize').val()));
		var net_amount = amount - prize;
		$('#net_amount').val(net_amount);
	}
	function getRevenue(){
			var year = $('#select-year').val();
			var month = $('#select-month').val();
			var url='<?php echo base_url('admin/actual_revenues/getRevenue') ?>';
			$.ajax({
					type: "POST",
					url: url,
					dataType: 'text',
					data: {
						month:month,
						year:year
					},
					success: function(data){
						var response = JSON.parse(data);
						if(response != null){
							$('#amount').val(response['amount']);
							$('#net_amount').val(response['net_amount']);
							$('#prize').val(response['prize']);
							}
						else{
							//alert('nodata');
							$('#amount').val(0);
							$('#net_amount').val(0);
							$('#prize').val(0);
							}
						
					},
					error: function(data){
						alert('error:' + data);
						location.reload();
					}
				});
	}
</script>
<style>
	.item{
		display:block;
		clear:both;
		margin-bottom:10px;
		height:34px;
		}
	.item .left{
		float:left;
		width:100px;
		height:34px;
		padding-top:8px;
		}
	.item .left label{
		
		}
	.item .right{
		float:left;
		width:400px;
		}
	#submit{
		font-size:14px;
		}
</style>
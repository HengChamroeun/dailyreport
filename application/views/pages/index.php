    <div class="jumbotron">
		<?php 
			
			
		?>
			<h2 class='title'><?php echo ($BRANCH_NAME); ?></h2>
			<h3>ចំណូលបូកបន្តគិតត្រឹមថ្ងៃ <?php echo showDateKH($DATE); ?></h3>
			
            <!--Revenue history-->
            <p id="rev-history"><a href="<?php echo(base_url()."revenue_history"); ?>">ប្រវត្តិចំណូល</a></p>
            <!--End Revenue history-->
    <div class='table-responsive'>
        <div style="">
        <table class='table table-bordered' style="min-width:1170px;" id="table_input" >
        	<thead>
                <tr>
                	<th rowspan="2"></th>
                	<th rowspan="2" style="vertical-align:middle"><center>ចំណូលបូកបន្ត</center></th>
                    <th colspan="7"><center>ស្ថានភាពចំណូលបូកបន្តពីយានយន្ត ទូរស័ព្ទ និង​គ្រឿង​អេឡិច​ត្រូនិច</center></th>  
                </tr>
                <tr>
                    <th><center>សរុប VAT កសិកម្ម និង CD ឪសថ</center></th>
                    <th><center>ចំនួនម៉ូតូ</center></th>
                    <th><center>សរុបប្រាក់ពន្ធ និងពិន័យ</center></th> 
                    <th><center>ចំនួនរថយន្ត</center></th>
                    <th><center>សរុបប្រាក់ពន្ធ និងពិន័យ</center></th>
                    <th style="font-size:12px"><center>ចំនួនទូរស័ព្ទ & <br/>គ្រ.អេឡិចត្រូនិច</center></th>
                    <th><center>សរុបប្រាក់ពន្ធ និងពិន័យ</center></th>
                </tr>
                <tr class="total">
                	<th>សរុប</th>
                	<th><input type="text" readonly class="form-control total-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($total_acc); ?>"></th>
                    <th><input type="text" readonly class="form-control total-vat-a-cd-m-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($total_vat_a_cd_m_acc); ?>"></th> 
                    <th><input type="text" readonly class="form-control amount total-motor-amount" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($total_motor_amount); ?>"></th>
                    <th><input type="text" readonly class="form-control total-motor-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($total_motor_acc); ?>"></th> 
                    <th><input type="text" readonly class="form-control amount total-car-amount" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($total_car_amount); ?>"></th>
                    <th><input type="text" readonly class="form-control total-car-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($total_car_acc); ?>"></th>
                    <th><input type="text" readonly class="form-control amount total-phone-amount" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($total_phone_amount); ?>"></th>
                    <th><input type="text" readonly class="form-control total-phone-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($total_phone_acc); ?>"></th>
                </tr>
            </thead>
            <tbody>
            <?php
			$offices = $this->m_customs->getOffices($BRANCH_CODE);
			foreach($offices as $o){
				$acc = 0;
				$vat_a_cd_m_acc = 0;
				$motor_amount = 0;
				$motor_acc = 0;
				$car_amount = 0;
				$car_acc = 0;
				$phone_amount = 0;
				$phone_acc = 0;
				
				if(isset($todayrev) && isset($todayrev[$o->code])){
					$trev = $todayrev[$o->code];
					$acc = $trev['accumulative'];
					$vat_a_cd_m_acc = $trev['vat_a_cd_m_acc'];
					$motor_amount = $trev['motor_amount'];
					$motor_acc = $trev['motor_acc'];
					$car_amount = $trev['car_amount'];
					$car_acc = $trev['car_acc'];
					$phone_amount = $trev['phone_amount'];
					$phone_acc = $trev['phone_acc'];
					}
			?>
            	<tr data-branch-code="<?php echo($BRANCH_CODE); ?>" data-office-code="<?php echo($o->code); ?>" class="office">
                	<th><?php echo ($o->name_print); ?></th>
                	<td><input type="text" class="form-control acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($acc); ?>"></td>
                    <td><input type="text" class="form-control vat-a-cd-m-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($vat_a_cd_m_acc); ?>"></td>
                    <td><input type="text" class="form-control amount motor-amount" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($motor_amount); ?>"></td>
                    <td><input type="text" class="form-control motor-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($motor_acc); ?>"></td> 
                    <td><input type="text" class="form-control amount car-amount" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($car_amount); ?>"></td>
                    <td><input type="text" class="form-control car-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($car_acc); ?>"></td>
                    <td><input type="text" class="form-control amount phone-amount" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($phone_amount); ?>"></td>
                    <td><input type="text" class="form-control phone-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($phone_acc); ?>"></td>
                </tr>
            <?php } ?>
            <?php
            if(count($offices)<1){
				$acc = 0;
				$motor_amount = 0;
				$vat_a_cd_m_acc = 0;
				$motor_acc = 0;
				$car_amount = 0;
				$car_acc = 0;
				$phone_amount = 0;
				$phone_acc = 0;
				
				if(isset($todayrev) && isset($todayrev[$BRANCH_CODE])){
					$trev = $todayrev[$BRANCH_CODE];
					$acc = $trev['accumulative'];
					$vat_a_cd_m_acc = $trev['vat_a_cd_m_acc'];
					$motor_amount = $trev['motor_amount'];
					$motor_acc = $trev['motor_acc'];
					$car_amount = $trev['car_amount'];
					$car_acc = $trev['car_acc'];
					$phone_amount = $trev['phone_amount'];
					$phone_acc = $trev['phone_acc'];
					}
					
				$name_print = $this->m_customs->getOfficeNamePrint($BRANCH_CODE);
			?>
            	<tr data-branch-code="<?php echo($BRANCH_CODE); ?>" data-office-code="<?php echo($BRANCH_CODE); ?>" class="office">
                	<th><?php echo ($name_print); ?></th>
                	<td><input type="text" class="form-control acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($acc); ?>"></td>
                    <td><input type="text" class="form-control vat-a-cd-m-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($vat_a_cd_m_acc); ?>"></td> 
                    <td><input type="text" class="form-control amount motor-amount" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($motor_amount); ?>"></td>
                    <td><input type="text" class="form-control motor-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($motor_acc); ?>"></td> 
                    <td><input type="text" class="form-control amount car-amount" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($car_amount); ?>"></td>
                    <td><input type="text" class="form-control car-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($car_acc); ?>"></td>
                    <td><input type="text" class="form-control amount phone-amount" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($phone_amount); ?>"></td>
                    <td><input type="text" class="form-control phone-acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($phone_acc); ?>"></td>
                </tr>
            <?php } ?>
            </tbody>
            
        </table>
        <div class="div-bot"><input type="checkbox" id="chk-validate" name="chk-validate"><label for="chk-validate">ខ្ញុំបានផ្ទៀងផ្ទាត់ឡើងវិញហើយ</label></div>
        <div class="div-bot"><button class="btn btn-success" id="btn-submit" disabled>បញ្ចូលចំណូល</button></div>
        </div>
    </div>
</div>
<style>
@media (min-width: 768px) {
  .container {
    max-width: 1170px;
  }
  tfoot tr{
	  border-width:0px;
	  }
}
.amount{
	width:75px;
	}
.div-bot{
	margin-bottom:15px;
	}
p#rev-history{
	text-align:right;
	
	}
p#rev-history a{
	font-size:16px;
	}
</style>
<script>
$(document).ready(function(e) {
    
	$("#chk-validate").change(function(e) {
        if($(this).prop('checked')){
			var enable = true;
			var today = '<?php echo($DATE); ?>';
			var url='<?php echo base_url('home/getPrevRev') ?>';
			var branch_code = '<?php echo($BRANCH_CODE); ?>';
			$.ajax({
					type: "POST",
					url: url,
					dataType: 'text',
					data: {date:today,branch_code:branch_code},
					success: function(data){
						d = JSON.parse(data);
						$('.office').each(function(index, element) {
                            office_code = $(this).attr('data-office-code');
							branch_code = $(this).attr('data-branch-code');
							if(d[office_code]){
								off_prev = d[office_code];
								acc = $(this).find('input.acc');
								if(parseFloat(off_prev['accumulative'])>parseFloat(removeMask(acc.val()==''?'0':acc.val()))){
									acc.css('border','1px solid #f00');
									enable = false;
									}
								else{
									acc.css('border','1px solid #ccc');
									}
								vat_a_cd_m_acc = $(this).find('input.vat-a-cd-m-acc');
								if(parseFloat(off_prev['vat_a_cd_m_acc'])>parseFloat(removeMask(vat_a_cd_m_acc.val()==''?'0':vat_a_cd_m_acc.val()))){
									vat_a_cd_m_acc.css('border','1px solid #f00');
									enable = false;
									}
								else{
									vat_a_cd_m_acc.css('border','1px solid #ccc');
									}
								motor_amount = $(this).find('input.motor-amount');
								if(parseFloat(off_prev['motor_amount'])>parseFloat(removeMask(motor_amount.val()==''?'0':motor_amount.val()))){
									motor_amount.css('border','1px solid #f00');
									enable = false;
									}
								else{
									motor_amount.css('border','1px solid #ccc');
									}
								motor_acc = $(this).find('input.motor-acc');
								if(parseFloat(off_prev['motor_acc'])>parseFloat(removeMask(motor_acc.val()==''?'0':motor_acc.val()))){
									motor_acc.css('border','1px solid #f00');
									enable = false;
									}
								else{
									motor_acc.css('border','1px solid #ccc');
									}
								car_amount = $(this).find('input.car-amount');
								if(parseFloat(off_prev['car_amount'])>parseFloat(removeMask(car_amount.val()==''?'0':car_amount.val()))){
									car_amount.css('border','1px solid #f00');
									enable = false;
									}
								else{
									car_amount.css('border','1px solid #ccc');
									}
								car_acc = $(this).find('input.car-acc');
								if(parseFloat(off_prev['car_acc'])>parseFloat(removeMask(car_acc.val()==''?'0':car_acc.val()))){
									car_acc.css('border','1px solid #f00');
									enable = false;
									}
								else{
									car_acc.css('border','1px solid #ccc');
									}
								phone_amount = $(this).find('input.phone-amount');
								if(parseFloat(off_prev['phone_amount'])>parseFloat(removeMask(phone_amount.val()==''?'0':phone_amount.val()))){
									phone_amount.css('border','1px solid #f00');
									enable = false;
									}
								else{
									phone_amount.css('border','1px solid #ccc');
									}
								phone_acc = $(this).find('input.phone-acc');
								if(parseFloat(off_prev['phone_acc'])>parseFloat(removeMask(phone_acc.val()==''?'0':phone_acc.val()))){
									phone_acc.css('border','1px solid #f00');
									enable = false;
									}
								else{
									phone_acc.css('border','1px solid #ccc');
									}
								
								}
                        });
						
						if(enable == true){
							$('.btn-success').removeProp('disabled');
							}
						else{
							$('.btn-success').prop('disabled','disabled');
							$('#chk-validate').removeProp('checked');
							}
					},
					error: function(data){
						alert('error:' + data);
						location.reload();
						}
				});
				
			}
    });
	
	$('#btn-submit').click(function(e) {
        	var today = '<?php echo($DATE); ?>';
			var url='<?php echo base_url('home/addRevenue') ?>';
			var branch_code = '<?php echo($BRANCH_CODE); ?>';
			var rows = [];
			$('.office').each(function(index, element) {
                rows[index] = {'branch_code':$(this).attr('data-branch-code'),
								'office_code':$(this).attr('data-office-code'),
								'accumulative':$(this).find('input.acc').val(),
								'vat_a_cd_m_acc':$(this).find('input.vat-a-cd-m-acc').val(),
								'motor_amount':$(this).find('input.motor-amount').val(),
								'motor_acc':$(this).find('input.motor-acc').val(),
								'car_amount':$(this).find('input.car-amount').val(),
								'car_acc':$(this).find('input.car-acc').val(),
								'phone_amount':$(this).find('input.phone-amount').val(),
								'phone_acc':$(this).find('input.phone-acc').val()
				};
            });
			$.ajax({
					type: "POST",
					url: url,
					dataType: 'text',
					data: {date:today,branch_code:branch_code,rows:rows},
					success: function(data){
						location.reload();
						},
					error: function(data){
						alert('error:' + data);
						location.reload();
						}
				});
    });
	$('.acc').change(function(e) {
        var total = 0;
		$('.acc').each(function(index, element) {
            total += parseFloat(removeMask($(this).val()));
        });
		$('.total-acc').val(total);
		$('#chk-validate').removeProp('checked');
		$('.btn-success').prop('disabled','disabled');
    });
	$('.vat-a-cd-m-acc').change(function(e) {
        var total = 0;
		$('.vat-a-cd-m-acc').each(function(index, element) {
            total += parseFloat(removeMask($(this).val()));
        });
		
		$('.total-vat-a-cd-m-acc').val(total);
		$('#chk-validate').removeProp('checked');
		$('.btn-success').prop('disabled','disabled');
    });
	$('.motor-amount').change(function(e) {
        var total = 0;
		$('.motor-amount').each(function(index, element) {
            total += parseFloat(removeMask($(this).val()));
        });
		$('.total-motor-amount').val(total);
		$('#chk-validate').removeProp('checked');
		$('.btn-success').prop('disabled','disabled');
    });
	$('.motor-acc').change(function(e) {
        var total = 0;
		$('.motor-acc').each(function(index, element) {
            total += parseFloat(removeMask($(this).val()));
        });
		$('.total-motor-acc').val(total);
		$('#chk-validate').removeProp('checked');
		$('.btn-success').prop('disabled','disabled');
    });
	$('.car-amount').change(function(e) {
        var total = 0;
		$('.car-amount').each(function(index, element) {
            total += parseFloat(removeMask($(this).val()));
        });
		$('.total-car-amount').val(total);
		$('#chk-validate').removeProp('checked');
		$('.btn-success').prop('disabled','disabled');
    });
	$('.car-acc').change(function(e) {
        var total = 0;
		$('.car-acc').each(function(index, element) {
            total += parseFloat(removeMask($(this).val()));
        });
		$('.total-car-acc').val(total);
		$('#chk-validate').removeProp('checked');
		$('.btn-success').prop('disabled','disabled');
    });
	$('.phone-amount').change(function(e) {
        var total = 0;
		$('.phone-amount').each(function(index, element) {
            total += parseFloat(removeMask($(this).val()));
        });
		$('.total-phone-amount').val(total);
		$('#chk-validate').removeProp('checked');
		$('.btn-success').prop('disabled','disabled');
    });
	$('.phone-acc').change(function(e) {
        var total = 0;
		$('.phone-acc').each(function(index, element) {
            total += parseFloat(removeMask($(this).val()));
        });
		$('.total-phone-acc').val(total);
		$('#chk-validate').removeProp('checked');
		$('.btn-success').prop('disabled','disabled');
    });
	
});
</script>
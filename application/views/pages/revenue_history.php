    <div class="jumbotron">
		<?php 
		
		list($year,$month,$day)=explode('-',$DATE);
			
		?>
			<h2 class='title'><?php echo ($BRANCH_NAME); ?></h2>
			<h3>ចំណូលបូកបន្តដែលបានបញ្ចូលនៅថ្ងៃទី <?php selectDate($day); ?> ខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?> <button class="btn btn-success" id="submit">ទាញយក</button></h3>
			
            <!--Revenue history-->
            <p id="rev-history"><a href="<?php echo(base_url()); ?>">&larr;ទៅទំព័រដើម</a></p>
            <!--End Revenue history-->
    <div class='table-responsive'>
        <div style="">
        <table class='table table-bordered' style="min-width:1170px;" id="table_input" >
        	<thead>
                <tr>
                	<th rowspan="2"></th>
                	<th rowspan="2" style="vertical-align:middle"><center>ចំណូលបូកបន្ត</center></th>
                    <th colspan="6"><center>ស្ថានភាពចំណូលបូកបន្តពីយានយន្ត ទូរស័ព្ទ និង​គ្រឿង​អេឡិច​ត្រូនិច</center></th>  
                </tr>
                <tr>
                    <th><center>ចំនួនម៉ូតូ</center></th>
                    <th><center>សរុបប្រាក់ពន្ធ និងពិន័យ</center></th> 
                    <th><center>ចំនួនរថយន្ត</center></th>
                    <th><center>សរុបប្រាក់ពន្ធ និងពិន័យ</center></th>
                    <th style="font-size:12px"><center>ចំនួនទូរស័ព្ទ & <br/>គ្រ.អេឡិចត្រូនិច</center></th>
                    <th><center>សរុបប្រាក់ពន្ធ និងពិន័យ</center></th>
                </tr>
                <tr class="total">
                	<th style="text-align:left;">សរុប</th>
                	<th><?php echo easy_number_format($total_acc); ?></th>
                    <th><?php echo easy_number_format($total_motor_amount); ?></th>
                    <th><?php echo easy_number_format($total_motor_acc); ?></th> 
                    <th><?php echo easy_number_format($total_car_amount); ?></th>
                    <th><?php echo easy_number_format($total_car_acc); ?></th>
                    <th><?php echo easy_number_format($total_phone_amount); ?></th>
                    <th><?php echo easy_number_format($total_phone_acc); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php
			$offices = $this->m_customs->getOffices($BRANCH_CODE);
			foreach($offices as $o){
				$acc = 0;
				$motor_amount = 0;
				$motor_acc = 0;
				$car_amount = 0;
				$car_acc = 0;
				$phone_amount = 0;
				$phone_acc = 0;
				
				if(isset($todayrev) && isset($todayrev[$o->code])){
					$trev = $todayrev[$o->code];
					$acc = $trev['accumulative'];
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
                	<td><?php echo easy_number_format($acc); ?></td>
                    <td><?php echo easy_number_format($motor_amount); ?></td>
                    <td><?php echo easy_number_format($motor_acc); ?></td> 
                    <td><?php echo easy_number_format($car_amount); ?></td>
                    <td><?php echo easy_number_format($car_acc); ?></td>
                    <td><?php echo easy_number_format($phone_amount); ?></td>
                    <td><?php echo easy_number_format($phone_acc); ?></td>
                </tr>
            <?php } ?>
            <?php
            if(count($offices)<1){
				$acc = 0;
				$motor_amount = 0;
				$motor_acc = 0;
				$car_amount = 0;
				$car_acc = 0;
				$phone_amount = 0;
				$phone_acc = 0;
				
				if(isset($todayrev) && isset($todayrev[$BRANCH_CODE])){
					$trev = $todayrev[$BRANCH_CODE];
					$acc = $trev['accumulative'];
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
                	<td><?php echo($acc); ?></td>
                    <td><?php echo($motor_amount); ?></td>
                    <td><?php echo($motor_acc); ?></td> 
                    <td><?php echo($car_amount); ?></td>
                    <td><?php echo($car_acc); ?></td>
                    <td><?php echo($phone_amount); ?></td>
                    <td><?php echo($phone_acc); ?></td>
                </tr>
            <?php } ?>
            </tbody>
            
        </table>
        
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
tr.office td, tr.total th{
	text-align:right;
	}
h3{
	font-size:20px;
	}
.btn-success{
	font-size:14px !important;
	height:34px;
	padding-top:2px;
	padding-bottom:2px;
	}
</style>
<script>
$(document).ready(function(e) {
    
	$("#submit").click(function(e) {
		
        if(($("#select-date").val()!='0') && ($("#select-month").val() != '0')){
			
			window.location = '<?php echo(base_url().'revenue_history?date='); ?>'+$("#select-year").val()+'-'+$("#select-month").val()+'-'+$("#select-date").val();
			}
    });
	
});
</script>
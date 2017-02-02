
    <div class="jumbotron">
		<?php 
			$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
			echo form_open(base_url('home/updateRevenue'),$attr);
		?>
			
			<?php 
				$branch_code=$this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code');
				$total_amount=$this->m_customs->sumRevenueByBranch($branch_code)[0]->amount;
				//$accum_amount=$this->m_customs->sumAccummulativeRevenue($branch_code)[0]->amount;
				$Acc=$this->m_revenues->getAccByBranch($branch_code,$DATE);
				$prevAcc=$this->m_revenues->getPrevAccByBranch($branch_code,$DATE);
				
			?>
			<h2 class='title'><?php echo $this->m_customs->getBranch($branch_code); ?></h2>
			<h3>ចំណូលពន្ធសរុបប្រចាំថ្ងៃទី <?php echo showDateKH($DATE); ?></h3>
			<br/>
			<br/>
			<?php
				$ofs=$this->m_customs->getOffices($branch_code);
				if($ofs != false){$total_amount=0;}
				$i=1;
				$hidden='';
				
				foreach($ofs as $of){
					$filters=array('branch_code'=>$branch_code,'office_code'=>$of->code,'revenue_date'=>$DATE);
					$amount=$this->m_global->select_record(TBLREVENUES,$filters,'accumulative');
					$total_amount=$total_amount+$amount;
					?>
					<div class="form-group">
					  <label class="control-label col-sm-6" for="revenue_<?php echo $i; ?>"><?php echo $of->name_print; ?> :</label>
					  <div class="col-sm-6">          
						<input type="text" disabled='disabled' id="revenue_<?php echo $i; ?>" class="form-control office_revenue" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo easy_number_format($amount).' KHR'; ?>" name="<?php echo INPUT_PREFIX.$of->code; ?>" placeholder="Enter Revenue">
					  </div>
					</div>
					
					<?php
				$hidden='';
				$i++;
				}
				$accum_amount=$total_amount-$prevAcc;
			?>
			<div class="form-group">
			  <label class="control-label col-sm-6" for="pwd">ចំណូលពន្ធសរុបប្រចាំថ្ងៃទី  : =</label>
			  <div class="col-sm-6">          
				<input type="text" class="form-control" id="branch_revenue" placeholder="" value='<?php echo easy_number_format($total_amount).' KHR'; ?>' disabled='disabled'>
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-6" for="pwd">ចំណូលពន្ធសរុប គិតត្រឹមប្រចាំថ្ងៃនេះ  : =</label>
			  <div class="col-sm-6">          
				<input type="text" class="form-control" id="branch_revenue" placeholder="" value='<?php echo easy_number_format($accum_amount).' KHR'; ?>' disabled='disabled'>
			  </div>
			</div>
			<table>
				<tr>
					<th>ថ្ងៃខែឆ្នាំ</th>
					<th></th>
					<th>ចំណូលពន្ធសរុបប្រចាំថ្ងៃទី</th>
					<th>ចំណូលពន្ធសរុប គិតត្រឹមថ្ងៃនេះ</th>
				</tr>
				<tr>
					<td><?php echo showDateKH($DATE); ?></td>
					<td><?php echo $this->m_customs->getBranch($branch_code); ?></td>
					<td><?php echo $Acc-$prevAcc; ?></td>
					<td><?php echo $Acc; ?></td>
				</tr>
				<?php
					$ofs=$this->m_customs->getOffices($branch_code);
					foreach($ofs as $of){
					$filters=array('branch_code'=>$branch_code,'office_code'=>$of->code,'revenue_date'=>$DATE);
					$amount=$this->m_global->select_record(TBLREVENUES,$filters,'accumulative');
					
					}
				?>
			</table>
		  </form>
    </div>
	<style>
	input {font-weight:bold;}
	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
	cursor: auto;
	background-color: #fff;
	opacity: 1;
	}
	</style>

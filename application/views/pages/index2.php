
    <div class="jumbotron">
		<?php 
			//$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
			//echo form_open(base_url('ajaxhome'),$attr);
		?>
			
			<?php 
				$branch_code=$this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code');
				$sum = $this->m_customs->sumRevenueByBranch($branch_code);
				$total_amount=$sum[0]->accumulative;
				//$accum_amount=$this->m_customs->sumAccummulativeRevenue($branch_code)[0]->amount;
				$Acc=$this->m_revenues->getAccByBranch($branch_code,$DATE);
				$prevAcc=$this->m_revenues->getPrevAccByBranch($branch_code,$DATE);
				$ofs=$this->m_customs->getOffices($branch_code);
				
				$no_office = 0;
				$input_branch = '';
				if(!$ofs){
					$no_office = 1;
					
				}
			?>
			<h2 class='title'><?php echo $this->m_customs->getBranch($branch_code); ?></h2>
			<h3>ចំណូលពន្ធសរុបប្រចាំថ្ងៃទី <?php echo showDateKH($DATE); ?></h3>
			<br/>
            <?php
				$c = $this->m_global->select_record(TBLCLOSEREVENUES,array('revenue_date'=>$DATE),'disabled');
				if($c!=1){
			?>
			<br/>
			<p style="text-align: right"><input type="checkbox" name="chk" id="chk" />&nbsp;<label for="chk" style="font-size: 14px;">កែចំណូលពន្ធ</label> | <a style="font-size: 14px;" href="<?php echo(base_url()."revenue_history"); ?>">ប្រវត្តិចំណូល</a></p>
			
			
			<table class='table'>
				<tr>
					<th>សាខា / ការិយាល័យ</th>
					<th>ចំណូលពន្ធសរុបប្រចាំថ្ងៃទី</th>
					<th>ចំណូលពន្ធសរុប គិតត្រឹមថ្ងៃនេះ</th>
				</tr>
				<tr>
					<td class='text'><?php echo $this->m_customs->getBranch($branch_code); ?></td>
					<td><?php echo easy_number_format($Acc-$prevAcc).' រៀល';; ?></td>
					<td class="total<?php echo(($no_office==1)?' editable':'');?>">
						<span class="disp_acc"><?php echo easy_number_format($Acc).' រៀល'; ?></span>
						<?php if($no_office==1){
							$office_prevAcc=$this->m_revenues->getPrevAccByOffice($branch_code,$DATE);
							?>
						<input type="text" style="text-align: right; display: none" class="form-control input_acc" name="input_acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" />
                    	<?php echo '<input type="hidden" id="office_prevacc" value="'.$office_prevAcc.'">';?>
                    	<?php echo '<input type="hidden" id="office_id" value="'.$branch_code.'">';?>
                    	<?php } ?>
					</td>
				</tr>
				<?php
					foreach($ofs as $of){
					$filters=array('branch_code'=>$branch_code,'office_code'=>$of->code,'revenue_date'=>$DATE);
					
					$amount=$this->m_global->select_record(TBLREVENUES,$filters,'accumulative');
					$office_prevAcc=$this->m_revenues->getPrevAccByOffice($of->code,$DATE);
					$todayRevenue=floatval($amount)-floatval($office_prevAcc);
					
					?>
					<tr>
					
					<td class='text'> - <?php echo $of->name_print; ?></td>
					<td><?php echo easy_number_format($todayRevenue).' រៀល'; ?></td>
					<td class="editable"><span class="disp_acc"><?php echo easy_number_format($amount).' រៀល'; ?></span><input type="text" style="text-align: right; display: none" class="form-control input_acc" name="input_acc" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" />
                    <?php echo '<input type="hidden" id="office_prevacc" value="'.$office_prevAcc.'">';?>
                    <?php echo '<input type="hidden" id="office_id" value="'.$of->code.'">';?>
                    </td>
					</tr>
					<?php
					}
				?>
			</table>
            <?php }
			else{
				?>
                <p><h2 style="color:#f00;">ការបញ្ចូលចំណូលសំរាប់ថ្ងៃនេះត្រូវបានបិទបញ្ចប់</h2></p>
                <?php
				}
			?>
		  <!--</form>-->
    </div>
    <script>
    	$(".editable").click(function(){
    		if($('#chk').prop('checked')){
    			$(this).find(".disp_acc").css('display','none');
    			var input = $(this).find("input.input_acc");
    			$(input).css('display','block');
    			$(input).val(parseFloat(removeMask($(this).find(".disp_acc").html())));
    			$(input).focus();
    		}//if checked!
    	});
    	$(".editable input").focusout(function(){
    		$(this).css('display','none');
    		$(this).val('');
    		$(this).parent().find('.disp_acc').css('display','block');
    	});
		$(".editable input").keypress(function(e) {
            if(e.which == 13){
				var disp_acc = parseFloat(removeMask($(this).parent().find('.disp_acc').html()));
				var input = parseFloat(removeMask($(this).val()));
				var office_prevacc = $(this).parent().find('#office_prevacc').val();
				if(disp_acc != input){
					if(input < office_prevacc){
						alert("បញ្ចូលតំលៃលេខដែលធំជាងពន្ធបូកបន្តចាស់");
						}
						else{
							var of_id = $(this).parent().find('#office_id').val();
							var rev_date = "<?php echo "$DATE"; ?>";
							var branch_code = "<?php echo "$branch_code"; ?>";
							var user_id = "<?php echo "$USER_ID"; ?>";
							
							addHistory(user_id,branch_code,of_id,rev_date,disp_acc,input);
							updateRevenue(of_id,rev_date,input);
							
							$(this).css('display','none');
							var disp_val = parseFloat(input).format(0,3,',','.');
							$(this).parent().find('.disp_acc').css('display','block');
							$(this).parent().find('.disp_acc').html(disp_val+" រៀល");
							$(this).val("");
							if(branch_code != of_id){
								reCount();
							}
						}
					}
				}
        });
		function addHistory(user_id,branch_id,office_id,rev_date,old_acc,new_acc){
			//alert(user_id+":"+branch_id+":"+office_id+":"+rev_date+":"+old_acc+":"+new_acc);
			var url='<?php echo base_url('ajaxhome/addHistories') ?>';
			$.ajax({
					type: "POST",
					url: url,
					dataType: 'json',
					data: {uid:user_id,bid:branch_id,oid:office_id,revdate:rev_date,o_acc:old_acc,n_acc:new_acc},
					success: function(data){
					}
				});
		}
		function updateRevenue(office_id,rev_date,new_acc){
			var url='<?php echo base_url('ajaxhome/updateRevenue') ?>';
			$.ajax({
					type: "POST",
					url: url,
					dataType: 'json',
					data: {oid:office_id,revdate:rev_date,n_acc:new_acc},
					success: function(data){
					}
				});
		}
		function reCount(){
			var totals = $('.disp_acc');
			var total = 0;
			for(i=1;i<totals.length;i++){
				//alert($(totals[i]).html());
				total += parseFloat(removeMask($(totals[i]).html()));
			}
			$(".total span.disp_acc").html(total.format(0,3,',','.')+' រៀល');
		}
    </script>
	<style>
	input {font-weight:bold;}
	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
	cursor: auto;
	background-color: #fff;	
	opacity: 1;
	}
	tr td {text-align:right;}
	tr td.text {text-align:left;}
	
	</style>

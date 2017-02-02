
    <div class="jumbotron">
		<?php 
		$day_name=strtolower(date('D',strtotime($DATE)));
		$day_plus='';
		if($day_name=='mon'){
			list($y,$m,$d)=explode('-',$DATE);
			if($d!='01'){
				$d=intval($d)-1;
				if($d < 10){
					$d='0'.$d;
				}
				$day_plus=numberKH($d).'+';
			}
			
		} 
		?>
		  <h2>ចំណូលពន្ធសរុបប្រចាំថ្ងៃទី <?php echo $day_plus.showDateKH($DATE); ?></h2>
		  <br/>
			<div class='col-md-3 col-md-offset-9'>
				<div class="form-group">
					<input type='text' class="form-control" value='<?php echo $this->input->get('date')?$this->input->get('date'):date('Y-m-d',time()); ?>' id='datepicker' />
				</div>
				
		  </div>
		   
		  
		  <div class='col-md-12 table-responsive'>
		  <table id='example1' class='table table-bordered'>
			<thead>
				<tr class="trheader">
					<td>លេខ.</td>
					<td>សាខា/ការិយាល័យ</td>
					<td>ចំណូលប្រចាំថ្ងៃ</th>
					<td style='width:200px;'>ចំណូលបូកបន្ត</td>
					<td style='width:140px;'>បម្រុងទុក</td>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td></td>
				<td style="text-align:right">ចំណូលពន្ធ និងអាករសរុបប្រចាំថ្ងៃ</td>
				<td class='totalRev' style="text-align:right"></td>
				<td class='totalAcc' style="text-align:right"></td>
				<td></td>
			</tr>
				<?php
					$branches=$this->m_customs->getBranch();
					$i=1;
					foreach($branches as $b){
						//$sumBranch=$this->m_customs->sumRevenueByBranch($b->code,$DATE);
						$classRed='class="bg_red danger"';
						// $amount=0;
						// if($sumBranch[0]->amount !=null){
							// $classRed='';
							// $amount=$sumBranch[0]->amount;
						// }
						//print_r($sumBranch);
							$offs=$this->m_customs->getOffices($b->code);
							$span='<span class="reserved_span">- រៀល</span><input type="text" style="display:none" class="form-control reserved_input" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" style="text-align: right;"/>';
							$span_acc='<span class="acc_span">- រៀល</span><input type="text" style="display:none" class="form-control acc_input" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" style="text-align: right;"/>';
							if($offs){
								$span='';
								$span_acc='<span class="acc_span">- រៀល</span>';
							}
							echo '<tr '.$classRed.' refdata='.$b->code.'>';
							echo '<td>'.$i.'</td>';
							echo '<td class="bname" style="text-align:left">'.$b->name.'</td>';
							echo '<td class="amt number" refdata="">- រៀល</td>';
							echo '<td class="acc number">'.$span_acc.'</td>';
							echo '<td class="reserved number">'.$span.'</td>';
							echo '</tr>';
							
							
							foreach($offs as $off){
								//$amount_off = $this->m_global->select_record(TBLREVENUES, array('office_code'=>$off->code, 'revenue_date'=>$DATE),'amount');
								//$reserved = $this->m_global->select_record(TBLREVENUES, array('office_code'=>$off->code, 'revenue_date'=>$DATE),'reserved');
								echo '<tr '.$classRed.' refdata='.$off->code.'>';
								echo '<td></td>';
								echo '<td class="bname" style="text-align:left">- '.$off->name_print.'</td>';
								echo '<td class="amt number" refdata="">- រៀល</td>';
								echo '<td class="acc number"><span class="acc_span">- រៀល</span><input type="text" style="display:none" class="form-control acc_input" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" style="text-align: right;"/></td>';
								echo '<td class="reserved number"><span class="reserved_span">- រៀល</span><input type="text" style="display:none" class="form-control reserved_input" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" style="text-align: right;"/></td>';
								echo '</tr>';
							}
					?>
					
					<?php
					
					$i++;
					}

				?>
			<tr>
				<td></td>
				<td style="text-align:right">ចំណូលពន្ធ និងអាករសរុបប្រចាំថ្ងៃ</td>
				<td class='totalRev'  style="text-align:right"></td>
				<td class='totalAcc' style="text-align:right"></td>
				<td></td>
			</tr>
			</tbody>
		  </table>
		  </div>
		  <div class='clear'></div>
    </div>

	<script>	
		Number.prototype.format = function(n, x, s, c) {
			var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
				num = this.toFixed(Math.max(0, ~~n));
			
			return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
		};
		$(document).ready(function(){
			//Calculation();
			retrieveData();
		});
		setInterval(function(){retrieveData();},3000);
		//setInterval(function(){Calculation();},5000);
		function retrieveData(){
		
			var offices = [];
			$('.bg_red').each(function(index){
					offices[index] = $(this).attr('refdata'); 
			});
			var url='<?php echo base_url('admin/ajax/revenue_offices') ?>';
			var totalRev=0;
			var totalAcc=0;
			$.ajax({
				type: "POST",
				url: url,
				dataType: 'json',
				data: {office_codes:offices, date: '<?php echo $DATE; ?>'},
				  success: function(data){
					 //alert( "Data Saved: " + msg );
					 if(data.status=='OK'){
						 $.each(data.data, function(index, obj){
							 if(obj.accumulative!='' && obj.accumulative!=null){
								$('tr[refdata="'+obj.office_code+'"]').find('.amt').html((parseFloat(obj.revenue)-parseFloat(obj.reserved)).format(0,3,',','.')+" រៀល");							
								$('tr[refdata="'+obj.office_code+'"]').find('.acc_span').html(parseFloat(obj.accumulative).format(0,3,',','.')+" រៀល");		
								$('tr[refdata="'+obj.office_code+'"]').find('.reserved_span').html(parseFloat(obj.reserved).format(0,3,',','.')+" រៀល");		
								//$('tr[refdata="'+obj.office_code+'"]').removeClass('bg_red');
								$('tr[refdata="'+obj.office_code+'"]').removeClass('danger');
								
								if(obj.isBranch==true){
									var tmp=parseFloat(obj.revenue)-parseFloat(obj.reserved);
									totalAcc=totalAcc+parseFloat(obj.accumulative);
									totalRev=totalRev+tmp;
									//alert(totalRev);
								}
								
							 }
							 if(obj.reserved!=null){
							//$('tr[refdata="'+obj.office_code+'"]').find('.reserved').html(parseFloat(obj.reserved).format(2,3,',','.')+" រៀល");	
							$('tr[refdata="'+obj.office_code+'"]').find('.reserved_span').html(parseFloat(obj.reserved).format(0,3,',','.')+" រៀល");		
							 }
						 });
						 //alert(totalRev);
						 $('.totalRev').html(totalRev.format(0,3,',','.')+" រៀល");
						$('.totalAcc').html(totalAcc.format(0,3,',','.')+" រៀល");
					 }
					
				  }
			});	
			
		}
		$('.acc').on('click',function(){
				if($(this).find('.acc_input').length){
					$(this).addClass('reserved_has_input');
					$(this).find('.acc_span').attr('style','display:none');
					var spanVal=parseFloat(removeMask($(this).find('.acc_span').html()));
					$(this).find('.acc_input').removeAttr('style');
					$(this).find('.acc_input').focus();
					if(!isNaN(spanVal)){
						$(this).find('.acc_input').val(spanVal);
					}
				}
				
		});
		$('.acc input').on('keypress',function (e){
		  if (e.keyCode === 13){
			
			//alert('Enter');
			InputAcc($(this));
			e.preventDefault(); 
		  }
		 
		});
		$('.acc input').focusout(function(){
			InputAcc($(this));
		});
		
		function InputAcc(obj){
			var inputVal=removeMask(obj.val());
			// alert(inputVal);
			if(inputVal!=''){
				var off_code=obj.parent().parent().attr('refdata');
				//alert(off_code);
				var url='<?php echo base_url('admin/ajax/acc_input') ?>';
				$.ajax({
					type: "POST",
					url: url,
					dataType: 'json',
					data: {office:off_code,acc:inputVal, date: '<?php echo $DATE; ?>'},
					success: function(data){
						
					}
				});
				inputVal=parseFloat(inputVal).format(2,3,',','.');
				obj.parent().find('acc_span').html(inputVal+" រៀល");
				retrieveData();
			}
			
			obj.attr('style','display:none');
			obj.parent().find('.acc_span').removeAttr('style');
			obj.parent().removeClass('reserved_has_input');
			
		}
		
		$('.reserved').on('click',function(){
				$(this).addClass('reserved_has_input');
				$(this).find('.reserved_span').attr('style','display:none');
				var spanVal=parseFloat(replaceAll(',','',$(this).find('.reserved_span').html()));
				$(this).find('.reserved_input').removeAttr('style');
				$(this).find('.reserved_input').focus();
				//$(this).find('.reserved_input').val(spanVal);
				if(!isNaN(spanVal)){
					$(this).find('.reserved_input').val(spanVal);
				}
				
		});
		$('.reserved input').on('keypress',function (e){
		  if (e.keyCode === 13){
			
			//alert('Enter');
			InputReserve($(this));
			e.preventDefault(); 
		  }
		 
		});
		$('.reserved input').focusout(function(){
			InputReserve($(this));
		});
		function InputReserve(obj){
			//alert(obj.val());
			var inputVal=obj.val();
			// alert(inputVal);
			if(inputVal!=''){
				var off_code=obj.parent().parent().attr('refdata');
				//alert(off_code);
				var url='<?php echo base_url('admin/ajax/reserved_input') ?>';
				$.ajax({
					type: "POST",
					url: url,
					dataType: 'json',
					data: {office:off_code,reserved:removeMask(inputVal), date: '<?php echo $DATE; ?>'},
					success: function(data){
						
					}
				});
				inputVal=parseFloat(removeMask(inputVal)).format(2,3,',','.');
				obj.parent().find('.reserved_span').html(inputVal+" រៀល");
				retrieveData();
			}
			
			obj.attr('style','display:none');
			obj.parent().find('.reserved_span').removeAttr('style');
			obj.parent().removeClass('reserved_has_input');
			
		}
		function Calculation(){
			var total=0;
			$('.amt').each(function(){
				var thisAmt=parseFloat($(this).attr('refdata'));
				if(thisAmt!='' || thisAmt!=0){
					total=total+thisAmt;
				}
				
			});
			//alert(total);
			$('#total_revenue').html(total.format(2,3,',','.'));
		}
	</script>
	<style>
		.reserved_input{
			margin:0px;
			padding:2px;
		}
		.reserved_has_input {padding:0px !important;}
		tr td{background-color:#dff0d8;}
		tr td.number{text-align:right;}
		
		.trheader td{
			background-color: #337ab7;
			border-color: #2e6da4;
			color: #ededed;
			font-family:'KHMER MEF2';
		}
		
		h2{font-size:20px !important;}
		
	</style>

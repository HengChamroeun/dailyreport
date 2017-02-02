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
		  <h2 id="title_">ចំណូលពន្ធសរុបប្រចាំថ្ងៃ <?php echo $day_plus.showDateKH_($DATE); ?></h2>
		  <br/>
			<!--<div class='col-md-3 col-md-offset-0 '>-->
            
            <div class='col-md-12 col-md-offset-0 ' style="text-align:left">
				
					<?php 
						if($user == 'samonn' or $user == 'mamkosal' or $user == 'chamroeun'){ 
						$c = $this->m_global->select_record(TBLCLOSEREVENUES,array('revenue_date'=>$DATE),'disabled');
						//var_dump($s);
						?>
                        	<label style="margin-right:20px;"><a href="<?php echo(base_url('/admin/quarter_planning')); ?>">ផែនការតាមត្រីមាស</a></label>
                            <label style="margin-right:20px;"><a href="<?php echo(base_url('/admin/actual_revenues')); ?>">ចំណូលប្រចាំខែ</a></label>
							<label><input type="checkbox" id="enable_edit"> <span style="color:red">Enable Edit Mode</span></label>
                         <label style="margin-left:20px;"><input type="checkbox" id="chkCloseRevenues" <?php echo($c==1?'checked':''); ?>> <span style="color:red">បិទបញ្ចប់ការបញ្ចូលចំណូលថ្ងៃនេះ</span></label>
						<?php
						}
						?>
				
			</div>
			<div class='col-md-3 col-md-offset-9'>
				<div class="form-group">
					<input type='text' class="form-control" value='<?php echo $this->input->get('date')?$this->input->get('date'):date('Y-m-d',time()); ?>' id='datepicker' />
				</div>
				
		  </div>
		   
		  
		  <div class='col-md-12 table-responsive'>
		  <p style="font-size:15px; text-align:left">
			Last Month <strong><?php echo($last_month_date.": ".easy_number_format($last_month_acc/1000000000,2).'bill.R') ?></strong>
			, Last Year <strong><?php echo($last_year_date.": ".easy_number_format($last_year_acc/1000000000,2).'bill.R') ?></strong>
		  </p>
		  <table id='example1' class='table table-bordered'>
			<thead>
				<tr class="trheader">
					<td>លេខ.</td>
					<td>សាខា/ការិយាល័យ</td>
					<td>ចំណូលប្រចាំថ្ងៃ</th>
					<td style='width:200px;'>ចំណូលបូកបន្ត</td>
					<!--<td style='width:140px;'>បម្រុងទុក</td> -->
					<td style='width:170px;'>មិនទាន់បញ្ចូល</td>
					<td style='width:150px;'>ម៉ោងបញ្ចូល</td>
				</tr>
			</thead>
			<tbody>
			<tr class="tr_sum">
				<td></td>
				<td style="text-align:right">ចំណូលពន្ធ និងអាករសរុបប្រចាំថ្ងៃ</td>
				<td class='totalRev' style="text-align:right"><?php echo easy_number_format(($todaytotal_sum_acc-$todaytotal_sum_res)-($prevtodaytotal_sum_acc-$prevtodaytotal_sum_res)); ?> រៀល</td>
				<td class='totalAcc' style="text-align:right"><?php echo easy_number_format($total_sum_acc - $total_sum_res); ?> រៀល</td>
				<td class='totalReserved' style="text-align:right"><?php echo easy_number_format($total_sum_res); ?> រៀល</td>
				<td></td>
			</tr>
            <?php
			$branches = $this->m_global->select_data(TBLOFFICES, array('parent_code'=>'CHQ00','status'=>'1'), array('level'=>'ASC'));
			$i=1;
            foreach($branches as $b){
				
				$offs=$this->m_customs->getOffices($b->code);
				
				$acc = 0;
				$res = 0;
				$rev = 0;
				$pre_acc = 0;
				$pre_res = 0;
				$revenued = false;
				$istoday = false;
				
				
					if(isset($todayrev_sum_acc[$b->code]))
					{
						if(isset($timestamp[$b->code]) && (date('Y-m-d',$timestamp[$b->code]) == $DATE)){
							$istoday = true;
							}
						}
				
				if(isset($todayrev_sum_acc[$b->code]))
				{
					$acc = $todayrev_sum_acc[$b->code];
					$res = $todayrev_sum_res[$b->code];
					$revenued = true;
					}
				else{
					$revenued = false;
					if(isset($prevrev_sum_acc[$b->code])){
						$acc = $prevrev_sum_acc[$b->code];
						$res = $prevrev_sum_res[$b->code];
						}
					}
				if(isset($prevrev_sum_acc[$b->code])){
					$pre_acc = $prevrev_sum_acc[$b->code];
					$pre_res = $prevrev_sum_res[$b->code];
					}
				if($revenued){
					$rev = ($acc - $res) - ($pre_acc - $pre_res);
					}
				else{
					$rev = 0;
					}
				
				
				$timestamp_ = (isset($timestamp[$b->code])?date('Y-m-d H:i:s',$timestamp[$b->code]):'');
				//$timestamp_ = (isset($timestamp[$b->code])?$timestamp[$b->code]:'');
				
			?>
            <tr class="tr_branch row_office bg_red <?php echo($acc==0 || $revenued==false || $istoday==false?'danger':''); ?>" data-branch-code="<?php echo($b->code); ?>" data-office-code="<?php echo($b->code); ?>" >
            	<td><?php echo($i); ?></td>
            	<td class="bname tip"><?php echo($b->name_print); ?></td>
            	<td class="amt number tip"><?php echo easy_number_format($rev); ?> រៀល</td>
                <td class="acc number tip">
                	<span class="acc_span"><?php echo easy_number_format($acc - $res); ?> រៀល</span>
                	<?php if(count($offs)<=0){ ?>
                    <input type="text" style="display: none; text-align: right;" class="form-control acc_input" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true">
                    <?php } ?>
                </td>
            	<td class="reserved number tip"><span class="reserved_span"><?php echo easy_number_format($res); ?> រៀល</span>
                	<?php if(count($offs)<=0){ ?>
                    <input type="text" style="display: none; text-align: right;" class="form-control reserved_input" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true">
                    <?php } ?>
                </td>
                <td class="time"><?php echo ($timestamp_); ?></td>
             </tr>
            <?php
			$i++;
				foreach($offs as $off){
					
					$acc = 0;
					$res = 0;
					$rev = 0;
					$pre_acc = 0;
					$pre_res = 0;
					$revenued = false;
					$istoday = false;
					if(isset($todayrev[$b->code][$off->code]))
					{
						if($todayrev[$b->code][$off->code]['revenue_date'] == $DATE){
							$istoday = true;
							}
						}
					
					if(isset($todayrev[$b->code][$off->code]))
					{
						$acc = $todayrev[$b->code][$off->code]['accumulative'];
						$res = $todayrev[$b->code][$off->code]['reserved'];
						$revenued = true;
						}
					else{
						$revenued = false;
						if(isset($prevrev[$b->code][$off->code])){
							$acc = $prevrev[$b->code][$off->code]['accumulative'];
							$res = $prevrev[$b->code][$off->code]['reserved'];
							}
						}
					if(isset($prevrev[$b->code][$off->code])){
						$pre_acc = $prevrev[$b->code][$off->code]['accumulative'];
						$pre_res = $prevrev[$b->code][$off->code]['reserved'];
						}
					if($revenued){
						$rev = ($acc - $res) - ($pre_acc - $pre_res);
						}
					else{
						$rev = 0;
						}
					
					
					?>
                    <tr class="row_office bg_red <?php echo($acc==0 || $revenued==false || $istoday==false?'danger':''); ?>" data-branch-code="<?php echo($b->code); ?>" data-office-code="<?php echo($off->code); ?>" >
                        <td></td>
                        <td class="bname tip">- <?php echo($off->name_print); ?></td>
                        <td class="amt number tip"><?php echo easy_number_format($rev); ?> រៀល</td>
                        <td class="acc number tip">
                            <span class="acc_span"><?php echo easy_number_format($acc - $res); ?> រៀល</span>
                            <input type="text" style="display: none; text-align: right;" class="form-control acc_input" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true">
                        </td>
                        <td class="reserved number tip"><span class="reserved_span"><?php echo easy_number_format($res); ?> រៀល</span>
                            <input type="text" style="display: none; text-align: right;" class="form-control reserved_input" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true">
                        </td>
                        <td class="time"></td>
                     </tr>
					<?php
					}
			}
			?>
			<tr class="tr_sum">
				<td></td>
				<td style="text-align:right">ចំណូលពន្ធ និងអាករសរុបប្រចាំថ្ងៃ</td>
				<td class='totalRev'  style="text-align:right"><?php echo easy_number_format(($todaytotal_sum_acc-$todaytotal_sum_res)-($prevtodaytotal_sum_acc-$prevtodaytotal_sum_res)); ?> រៀល</td>
				<td class='totalAcc' style="text-align:right"><?php echo easy_number_format($total_sum_acc - $total_sum_res); ?> រៀល</td>
				<td class='totalReserved' style="text-align:right"><?php echo easy_number_format($total_sum_res); ?> រៀល</td>
				<td class=""></td>
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
		function displayDate(inputtime,office_code){
		var str = inputtime;
		//alert(str);
		if(str!=""){
			$('tr[refdata="'+office_code+'"]').find('.time').html(inputtime);
		}
		else{
			$('tr[refdata="'+office_code+'"]').find('.time').html('');
		}
        }
		$('.acc').on('click',function(){
			if($('#enable_edit').prop('checked')){
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
			}
		});
		$('.acc input').on('keypress',function (e){
		  if (e.keyCode === 13){
			
			//alert('Enter');
			e.preventDefault(); 
			//$(this).parent().parent().find('.acc_span').html($(this).val()+' រៀល');
			InputAcc($(this));
			
			
		  }
		 
		});
		
		$(document).ready(function(e) {
			
			setInterval(function(){getRevenues();},10000);
			
			$('h2#title_').click(function(e) {
                getRevenues();
            });
			
            $('#chkCloseRevenues').change(function(e) {
                if(this.checked){
					closeRevenue();
					}
					else{
						enableRevenue();
						}
            });
			$('.reserved input').focusout(function(){
			//InputReserve($(this));
			$(this).val('');
			$(this).attr('style','display:none');
			$(this).parent().find('.reserved_span').removeAttr('style');
			$(this).parent().removeClass('reserved_has_input');
		});
		$('.reserved').on('click',function(){
			if($('#enable_edit').prop('checked')){
				if($(this).find('.reserved_input')[0]){
					$(this).addClass('reserved_has_input');
					$(this).find('.reserved_span').attr('style','display:none');
					var spanVal=parseFloat(replaceAll(',','',$(this).find('.reserved_span').html()));
					$(this).find('.reserved_input').removeAttr('style');
					$(this).find('.reserved_input').focus();
					//$(this).find('.reserved_input').val(spanVal);
					if(!isNaN(spanVal)){
						$(this).find('.reserved_input').val(spanVal);
					}
				}
			}
		});
		$('.reserved input').on('keypress',function (e){
		  if (e.keyCode === 13){
			
			//alert('Enter');
			e.preventDefault(); 
			InputReserve($(this));
			
		  }
		 
		});
		$('.acc input').focusout(function(){
			//InputAcc($(this));
			$(this).val('');
			$(this).attr('style','display:none');
			$(this).parent().find('.acc_span').removeAttr('style');
			$(this).parent().removeClass('reserved_has_input');
		});
        });
		function closeRevenue(){
				var url='<?php echo base_url('admin/ajax/closeRevenue') ?>';
				var date = '<?php echo($DATE); ?>';
				$.ajax({
					type: "POST",
					url: url,
					dataType: 'text',
					data: {date:date},
					success: function(data){
						//alert(data);
					}
				});
			}
		function enableRevenue(){
				var url='<?php echo base_url('admin/ajax/enableRevenue') ?>';
				var date = '<?php echo($DATE); ?>';
				$.ajax({
					type: "POST",
					url: url,
					dataType: 'text',
					data: {date:date},
					success: function(data){
						//alert(data);
					}
				});
			}
		function getRevenues(){
			var url='<?php echo base_url('admin/ajax/getRevenues') ?>';
				var date = '<?php echo($DATE); ?>';
				$.ajax({
					type: "POST",
					url: url,
					dataType: 'text',
					data: {date:date},
					success: function(data){
						d = JSON.parse(data);
						todayrev = d['todayrev'];
						prevrev = d['prevrev'];
						todayrev_sum_acc = d['todayrev_sum_acc'];
						todayrev_sum_res = d['todayrev_sum_res'];
						prevrev_sum_acc = d['prevrev_sum_acc'];
						prevrev_sum_res = d['prevrev_sum_res'];
						timestamp = d['timestamp'];
						revenue_date = d['revenue_date'];
						todaytotal_sum_acc = d['todaytotal_sum_acc'];
						todaytotal_sum_res = d['todaytotal_sum_res'];
						prevtodaytotal_sum_acc = d['prevtodaytotal_sum_acc'];
						prevtodaytotal_sum_res = d['prevtodaytotal_sum_res'];
						total_sum_acc = d['total_sum_acc'];
						total_sum_res = d['total_sum_res'];
						
						
						//alert(prevrev['BAT10']['BAT101']['accumulative']);
						$('.row_office').each(function(index, element) {
							branch_code = $(this).attr('data-branch-code');
							office_code = $(this).attr('data-office-code');
                            if(branch_code == office_code){
								//branch
								
								acc = 0;
								res = 0;
								rev = 0;
								pre_acc = 0;
								pre_res = 0;
								revenued = false;
								timestamp_ = '';
								istoday = false;
				
								if(todayrev_sum_acc[branch_code])
								{
									if(revenue_date[branch_code] && (revenue_date[branch_code] == '<?php echo($DATE); ?>')){
										istoday = true;
										}
									}
								
								if(todayrev_sum_acc[branch_code])
								{
									acc = todayrev_sum_acc[branch_code];
									res = todayrev_sum_res[branch_code];
									revenued = true;
									}
								else{
									revenued = false;
									if(prevrev_sum_acc[branch_code]){
										acc = prevrev_sum_acc[branch_code];
										res = prevrev_sum_res[branch_code];
										}
									}
								if(prevrev_sum_acc[branch_code]){
									pre_acc = prevrev_sum_acc[branch_code];
									pre_res = prevrev_sum_res[branch_code];
									}
								if(revenued){
									rev = (parseFloat(acc) - parseFloat(res)) - (parseFloat(pre_acc) - parseFloat(pre_res));
									}
								else{
									rev = 0;
									}
								
								
								$(this).find('.amt').html(parseFloat(rev).format(0,3,',','.')+' រៀល');
									$(this).find('.acc_span').html(parseFloat(acc - res).format(0,3,',','.')+' រៀល');
									//$(this).find('.acc_input').val(parseFloat(acc - res));
									$(this).find('.reserved_span').html(parseFloat(res).format(0,3,',','.')+' រៀល');
									//$(this).find('.reserved_input').val(parseFloat(res));
									
									if(timestamp[branch_code]){
										timestamp_ = timestamp[branch_code];
										}
									$(this).find('.time').html(timestamp_);
									
									
									if(revenued == false || acc == 0 || istoday == false ){
										if(!$(this).hasClass('danger')){
											$(this).addClass('danger');
											}
										}
										else{
											$(this).removeClass('danger');
											}
								
								
								
								}
							else{
									//office
								
									acc = 0;
									res = 0;
									rev = 0;
									pre_acc = 0;
									pre_res = 0;
									revenued = false;
									istoday = false;
									
									
									if(todayrev[branch_code] && todayrev[branch_code][office_code])
									{
										if(todayrev[branch_code][office_code]['revenue_date'] == '<?php echo($DATE) ?>'){
											istoday = true;
											}
										}
									
									
										if(todayrev[branch_code] && todayrev[branch_code][office_code])
										{
											acc = todayrev[branch_code][office_code]['accumulative'];
											res = todayrev[branch_code][office_code]['reserved'];
											revenued = true;
											}
										else{
											revenued = false;
											
												if( prevrev[branch_code] && prevrev[branch_code][office_code]){
													acc = prevrev[branch_code][office_code]['accumulative'];
													res = prevrev[branch_code][office_code]['reserved'];
													}
											
										}
										if( prevrev[branch_code] && prevrev[branch_code][office_code]){
											pre_acc = prevrev[branch_code][office_code]['accumulative'];
											pre_res = prevrev[branch_code][office_code]['reserved'];
											}
									
									if(revenued == true){
										rev = (parseFloat(acc) - parseFloat(res)) - (parseFloat(pre_acc) - parseFloat(pre_res));
										
										}
									else{
										rev = 0;
										}
										
									$(this).find('.amt').html(parseFloat(rev).format(0,3,',','.')+' រៀល');
									$(this).find('.acc_span').html(parseFloat(acc - res).format(0,3,',','.')+' រៀល');
									//$(this).find('.acc_input').val(parseFloat(acc - res));
									$(this).find('.reserved_span').html(parseFloat(res).format(0,3,',','.')+' រៀល');
									//$(this).find('.reserved_input').val(parseFloat(res));
									
									if(revenued == false || acc == 0 || istoday == false ){
										if(!$(this).hasClass('danger')){
											$(this).addClass('danger');
											}
										}
										else{
											$(this).removeClass('danger');
											}
								}
								
								
                        });
						
						$('.totalRev').html(((parseFloat(todaytotal_sum_acc)-parseFloat(todaytotal_sum_res))-(parseFloat(prevtodaytotal_sum_acc)-parseFloat(prevtodaytotal_sum_res))).format(0,3,',','.')+' រៀល');
						$('.totalAcc').html((total_sum_acc - total_sum_res).format(0,3,',','.')+' រៀល');
						$('.totalReserved').html(total_sum_res.format(0,3,',','.')+' រៀល');
						
					}
				});
			}
	function InputAcc(obj){
			var inputVal=removeMask(obj.val());
			// alert(inputVal);
			if(inputVal!=''){
				var off_code=obj.parent().parent().attr('data-office-code');
				//alert(off_code);
				var report_date = '<?php echo($DATE); ?>';
				var url='<?php echo base_url('admin/ajax/acc_input') ?>';
				$.ajax({
					type: "POST",
					url: url,
					dataType: 'json',
					data: {office:off_code,acc:inputVal, date: report_date},// date: '<?php echo $DATE; ?>'},
					success: function(data){
						
					}
				});
				//inputVal=parseFloat(inputVal).format(2,3,',','.');
				//obj.parent().find('acc_span').html(inputVal+" រៀល");
				getRevenues();
			}
			
			obj.attr('style','display:none');
			obj.parent().find('.acc_span').removeAttr('style');
			obj.parent().removeClass('reserved_has_input');
			
	}
	function InputReserve(obj){
			//alert(obj.val());
			var inputVal=obj.val();
			// alert(inputVal);
			if(inputVal!=''){
				var off_code=obj.parent().parent().attr('data-office-code');
				//alert(off_code);
				var url='<?php echo base_url('admin/ajax/reserved_input') ?>';
				var report_date = '<?php echo($DATE); ?>';
				$.ajax({
					type: "POST",
					url: url,
					dataType: 'json',
					data: {office:off_code,reserved:removeMask(inputVal), date: report_date}, //date: '<?php echo $DATE; ?>'},
					success: function(data){
						
					}
				});
				//inputVal=parseFloat(removeMask(inputVal)).format(2,3,',','.');
				//obj.parent().find('.reserved_span').html(inputVal+" រៀល");
				getRevenues();
			}
			
			obj.attr('style','display:none');
			obj.parent().find('.reserved_span').removeAttr('style');
			obj.parent().removeClass('reserved_has_input');
			
		}
			
	</script>
	<style>
		
		
	</style>

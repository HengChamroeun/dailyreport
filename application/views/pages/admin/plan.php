
    <div class="jumbotron">
		  <h2>ផែនការ ត្រីមាស </h2> 
			<table class='table' id='example2'>
				<thead>
				<tr class="trheader">
					<th>លេខ.</th>
					<th>សាខា</th>
					<th>ផែនការត្រីមាស</th>
					<th>កែតម្រូវ</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$branches=$this->m_global->select_data(TBLOFFICES, array('parent_code'=>'CHQ00','status'=>'1'));
					$i=1;
					foreach($branches as $b){
						//$branch_code=$this->m_customs->getBranch($u->branch_code);
						//if(is_array($branch_code)){$branch_code='ADMIN';}
						$plan=$this->m_global->select_record(TBLPLANNERS,array('branch_code'=>$b->code,'office_code'=>$b->code, 'valid_from <= '=>$DATE,'valid_to'=>''),'amount');
						echo '<tr refdata='.$b->code.'>';
						echo "<td>$i</td>";
						echo "<td class='user_td2'><span class='user_span'>$b->name</span></td>";
						echo "<td class='planner'><span>$plan</span><input type='text' class='planner_input' value='' style='display:none'/></td>";
						echo "<td>កែតម្រូវ</td>";
						echo '</tr>';
						$offs=$this->m_global->select_data(TBLOFFICES, array('parent_code'=>$b->code,'status'=>'1'));
							foreach($offs as $off){
								$plan_off=$this->m_global->select_record(TBLPLANNERS,array('branch_code'=>$b->code,'office_code'=>$off->code, 'valid_from <= '=>$DATE,'valid_to'=>''),'amount');
								echo '<tr refdata='.$off->code.'>';
								echo "<td></td>";
								echo "<td class='user_td2'>-<span class='user_span'>$off->name</span></td>";
								echo "<td class='planner'><span>$plan_off</span><input type='text' class='planner_input' value='' style='display:none'/></td>";
								echo "<td>កែតម្រូវ</td>";
								echo '</tr>';
							}
						$i++;
					}
				?>
				</tbody>
			</table>
			<a class='btn btn-primary btnmargin' href="<?php echo base_url('admin/users/new_user') ?>">បន្ថែមឈ្មោះអ្នកប្រើ</a>
    </div>
	<style>
		.table td{text-align:left;}
		.trheader{
			background-color: #337ab7;
			border-color: #2e6da4;
			color: #fff;
		}
		a.btnmargin{
			margin: 10px;
		}
		.reserved_has_input {padding:0px !important;}
	</style>
	<script>
		$('.planner').on('click',function(){
				$(this).addClass('reserved_has_input');
				$(this).find('.user_span').attr('style','display:none');
				var spanVal=parseInt(replaceAll(',','',$(this).find('.user_span').html()));
				$(this).find('.user_input').removeAttr('style');
				$(this).find('.user_input').focus();
				if(!isNaN(spanVal)){
					$(this).find('.user_input').val(spanVal);
				}
				
		});
		$('.planner input').on('keypress',function (e){
		  if (e.keyCode === 13){
			
			//alert('Enter');
			InputUser($(this));
			e.preventDefault(); 
		  }
		 
		});
		$('.planner input').focusout(function(){
			InputUser($(this));
		});
		
		function InputUser(obj){
			var inputVal=obj.val();
			// alert(inputVal);
			if(inputVal!=''){
				var off_code=obj.parent().parent().attr('refdata');
				//alert(off_code);
				// var url='<?php echo base_url('admin/ajax/user_input') ?>';
				// $.ajax({
					// type: "POST",
					// url: url,
					// dataType: 'json',
					// data: {office:off_code,user:inputVal, date: '<?php echo $DATE; ?>'},
					// success: function(data){
						
					// }
				// });
				inputVal=parseInt(inputVal).format(2,3,',','.');
				obj.parent().find('user_td_span').html(inputVal+" រៀល");
				retrieveData();
			}
			
			obj.attr('style','display:none');
			obj.parent().find('.user_td_span').removeAttr('style');
			obj.parent().removeClass('reserved_has_input');
			
		}
	</script>
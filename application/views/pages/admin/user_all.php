
    <div class="jumbotron">
		  <h2>បញ្ជីឈ្មោះអ្នកប្រើប្រាស់ </h2> 
			<table class='table' id='example'>
				<thead>
				<tr class="trheader">
					<th>លេខ.</th>
					<th>ឈ្មោះអ្នកប្រើប្រាស់</th>
					<th>សាខា</th>
					<th>កែតម្រូវ</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$users=$this->m_customs->getUsers();
					$i=1;
					foreach($users as $u){
						$branch_code=$this->m_customs->getBranch($u->branch_code);
						if(is_array($branch_code)){$branch_code='ADMIN';}
						echo '<tr>';
						echo "<td>$i</td>";
						echo "<td class='user_td2'><span class='user_span'>$u->username</span><input type='text' style=' display:none' class='form-control user_input' value='$u->username'/></td>";
						echo "<td>".$branch_code."</td>";
						echo "<td>កែតម្រូវ</td>";
						echo '</tr>';
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
		$('.user_td').on('click',function(){
				$(this).addClass('reserved_has_input');
				$(this).find('.user_span').attr('style','display:none');
				var spanVal=parseInt(replaceAll(',','',$(this).find('.user_span').html()));
				$(this).find('.user_input').removeAttr('style');
				$(this).find('.user_input').focus();
				if(!isNaN(spanVal)){
					$(this).find('.user_input').val(spanVal);
				}
				
		});
		$('.user_td input').on('keypress',function (e){
		  if (e.keyCode === 13){
			
			//alert('Enter');
			InputUser($(this));
			e.preventDefault(); 
		  }
		 
		});
		$('.user_td input').focusout(function(){
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
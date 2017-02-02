
    <div class="jumbotron">
		<?php 
			$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
			echo form_open(base_url('revenue_item/AddRevenue'),$attr);
		?>
			<?php 
				$branch_code=$this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code'); 
				echo '<input type="hidden" id="branch_code" value="'.$branch_code.'">';
				
			?>
			<h2 class='title'><?php echo $this->m_customs->getBranch($branch_code); ?></h2>
			<h3>ចំណូលពន្ធតាមមុខទំនិញសរុបប្រចាំថ្ងៃ <?php echo showDateKH($DATE); ?></h3>
			<br/>
			<br/>
			
			<div class='form-group'>
			  <label class='control-label col-sm-4' for='ITM_ELM'>មុខទំនិញ  :</label>
			  <div class='col-sm-8'>  
				<select class='form-control' id='ITM_ELM'>
				<?php
					$items=$this->m_global->select_data(TBLITEMS,array('status'=>'1'));
					foreach($items as $item){
						echo '<option value="'.$item->id.'">'.$item->name_kh.'</option>';
					}
								
				?>
				</select>
							
			  </div>
			</div>

			<div class='form-group'  style='border-top: 2px solid #ccc;'>
			  <label class='control-label col-sm-5' for=''>**ទំនិញនាំចូលជាប់ពន្ធនិងអាករ**</label>
			</div>
				<div class='form-group'>
				  <label class='control-label col-sm-4' for='TAX_QTY_INP'>បរិមាណ  :</label>
				  <div class='col-sm-8'>  
					<input  type='text' class='form-control' name='' id='TAX_QTY_INP'  data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" style="text-align: right;"/>							
				  </div>
				</div>
				<div class='form-group'>
				  <label class='control-label col-sm-4' for='TAX_BSE_INP'>តម្លៃគិតពន្ធ :</label>
				  <div class='col-sm-8'>  
					<input  type='text' class='form-control' name='' id='TAX_BSE_INP' data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" style="text-align: right;"/>							
				  </div>
				</div>
				<div class='form-group'>
				  <label class='control-label col-sm-4' for='TAX_AMT_INP'>ប្រាក់ពន្ធនិងអាករ  :</label>
				  <div class='col-sm-8'>  
					<input  type='text' class='form-control' name='' id='TAX_AMT_INP' data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" style="text-align: right;"/>							
				  </div>
				</div>
			<div class='form-group' style='border-top: 2px solid #ccc;'>
			  <label class='control-label col-sm-5' for=''>**ទំនិញនាំចូលពន្ធនិងអាករ ជាបន្ទុករដ្ឋ**</label>
			</div>
				<div class='form-group'>
				  <label class='control-label col-sm-4' for='BUR_QTY_INP'>បរិមាណ  :</label>
				  <div class='col-sm-8'>  
					<input  type='text' class='form-control' name='' id='BUR_QTY_INP' data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" style="text-align: right;"/>							
				  </div>
				</div>
				<div class='form-group'>
				  <label class='control-label col-sm-4' for='BUR_BSE_INP'>តម្លៃគិតពន្ធ :</label>
				  <div class='col-sm-8'>  
					<input  type='text' class='form-control' name='' id='BUR_BSE_INP' data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" style="text-align: right;"/>							
				  </div>
				</div>
				<div class='form-group'>
				  <label class='control-label col-sm-4' for='BUR_AMT_INP'>ប្រាក់ពន្ធនិងអាករ  :</label>
				  <div class='col-sm-8'>  
					<input  type='text' class='form-control' name='' id='BUR_AMT_INP' data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" style="text-align: right;"/>							
				  </div>
				</div>
			
			<div class="form-group"> 
			  <div class="col-sm-offset-2 col-sm-10">
				<input type="submit" name='submit' class="btn btn-success" id='submit' value='បញ្ចូលចំណូលពន្ធ'>
			  </div>
			</div>
			<input type="hidden" name='date' value="<?php echo $DATE; ?>">
		  </form>
				<div class='table-responsive'>
					<table class='table table-bordered'>
						<thead>
							<tr>
								<th rowspan=2>លរ</th>
								<th rowspan=2>១. ទំនិញនាំចូល</th>
								<th rowspan=2>ឯកតា</th>
								<th colspan=3>១.១ ទំនិញនាំចូលជាប់ពន្ធនិងអាករ</th>
								<th colspan=3>១.២ ទំនិញនាំចូលពន្ធនិងអាករ ជាបន្ទុករដ្ឋ</th>
							</tr>
							<tr>
								<th>បរិមាណ</th>
								<th>តម្លៃគិតពន្ធគយ</th>
								<th>ប្រាក់ពន្ធនិងអាករ</th>
								<th>បរិមាណ</th>
								<th>តម្លៃគិតពន្ធគយ</th>
								<th>ប្រាក់ពន្ធនិងអាករ</th>
								
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>HelloHelloHelloHelloHello</td>
								<td>HelloHelloHelloHello</td>
								<td>HelloHelloHelloHelloHello</td>
								<td>HelloHelloHelloHello</td>
								<td>HelloHelloHelloHelloHello</td>
								<td>HelloHelloHelloHello</td>
								<td>HelloHelloHelloHelloHello</td>
								<td>HelloHelloHelloHello</td>
								<td>HelloHelloHelloHello</td>
								
							</tr>
						</tbody>
						
					</table>
					
				</div>
		  <div class='clear'></div>
    </div>
	<style>
		table.table tr th{vertical-align:middle;}
	</style>
	<script>
		$("#submit").on('click',function(e){
			// alert(checkTax());
			if(validate()==true){
				if(checkTax()==true){
					addRevenue(false);
				}
				
				if(checkBur()==true){
					addRevenue(true);
				}
			}else{
				alert('Please check your data');
			}
			e.preventDefault();
			return false;
		});
		function addRevenue(isBur){
			var qty=$("#TAX_QTY_INP").val();
			var tbs=$("#TAX_BSE_INP").val();
			var tax=$("#TAX_AMT_INP").val();
			var itemList=$('#ITM_ELM');
			var item=itemList.find('option:selected');
			//alert(item.val());
			if(isBur==true){
				qty=$("#BUR_QTY_INP").val();
				tbs=$("#BUR_BSE_INP").val();
				tax=$("#BUR_AMT_INP").val();
			}
			$.ajax({
					url:'revenue_item/AddRevenue',
					type:'POST',
					data:{branch_code:$('#branch_code').val(),date:'<?php echo $DATE; ?>',qty: qty, tbs: tbs,tax:tax,isBur:isBur,item:item.val()},
					success: function(data){
						alert(data);
					}
					
			});
		}
		function validate(){
			if(checkTax()=='empty' && checkBur()=='empty'){
				return false;
			}else if(checkTax()==false || checkBur()==false){
				return false;
			}else{
				return true;
			}
		}
		function checkTax(){
			var qty=$("#TAX_QTY_INP").val();
			var tbs=$("#TAX_BSE_INP").val();
			var tax=$("#TAX_AMT_INP").val();
			if(qty=='' && tbs=='' && tax==''){
				return 'empty';
			}else if(qty!='' && tbs!='' && tax!=''){
				return true;
			}else{
				return false;
			}
		}
		
		function checkBur(){
			var qty=$("#BUR_QTY_INP").val();
			var tbs=$("#BUR_BSE_INP").val();
			var tax=$("#BUR_AMT_INP").val();
			if(qty=='' && tbs=='' && tax==''){
				return 'empty';
			}else if(qty!='' && tbs!='' && tax!=''){
				return true;
			}else{
				return false;
			}
		}
	</script>
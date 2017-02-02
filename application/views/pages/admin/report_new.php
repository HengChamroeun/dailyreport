<form>
<div class='col-md-6 col-sm-6'>
<h2>ប្រភេទរបាយការណ៍</h2>
	<br/>
	<label for='REP_TYP_1'><input type='radio' name='REP_TYP' value='REP_TYP_1' checked id='REP_TYP_1'/> របាយការណ៍សង្ខេប</label>
	<br/>
	<label for='REP_TYP_2'><input type='radio' name='REP_TYP' value='REP_TYP_2'  id='REP_TYP_2'/> របាយការណ៍លម្អិត</label>
	<br />
    <label for='REP_TYP_3'><input type='radio' name='REP_TYP' value='REP_TYP_3'  id='REP_TYP_3'/> របាយការណ៍ស្ថានការ​ពន្ធ និង​ពិន័យ</label>
	<br />
	<fieldset​ style="padding: 10px; border: 1px solid #ffffff; display: inline-block;">
		<label for='chk_field_only'><input type='checkbox' name='chk_field_only' value='field_only'  id='chk_field_only'/> មិនយកតួរលេខ</label>
		<br />
		<label for='chk_value_only'><input type='checkbox' name='chk_value_only' value='value_only'  id='chk_value_only'/> យកតែតួរលេខ</label>
	</fieldset>
</div>
<div class='col-md-6 col-sm-6'>
<h2>កាលបរិច្ឆេត</h2>
	<br/>
	<div class='col-md-12 col-sm-12'>
		<div class='col-md-6 col-sm-6'>
			<label for='REP_DAT_1'><input type='radio' name='REP_DAT' checked value='REP_DAT_1'  id='REP_DAT_1'/>ប្រចាំថ្ងៃ</label>
		</div>
		<div class='col-md-6 col-sm-6'>
			<!--<label for='REP_DAT_2'><input type='radio' name='REP_DAT' value='REP_DAT_2' id='REP_DAT_2'/>ប្រចាំខែ</label>-->
			
		</div>
	</div>
	<div class='col-md-12 col-sm-12'>
		<div class='col-md-6 col-sm-6'> 
			<input type='text' class="form-control" name='REP_DAT_1_INP' value='<?php echo $this->input->get('date')?$this->input->get('date'):date('Y-m-d',time()); ?>' id='REP_DAT_1_INP' />
		</div>
		<div class='col-md-6 col-sm-6'>
			<!--<input type='text' class="form-control" name='REP_DAT_2_INP' value='<?php echo $this->input->get('date')?$this->input->get('date'):date('Y-m-d',time()); ?>' id='REP_DAT_2_INP' />-->
		</div>
	</div>
	<div class='col-md-12 col-sm-12'>
		<div class='col-md-6 col-sm-6' id="select_dynamic">
			<br />
			<?php
			
			$default = $this->m_global->select_record(TBLSEALS,array('date'=>date('Y-m-d',time())),'user_id');
			$signatures = $this->m_global->select_data(TBLSIGNATURES);
			selectSignatures($signatures,$default);
			//var_dump($signatures)
			?>
		</div>
		<div class='col-md-6 col-sm-6'>
		</div>
	</div>
</div>
<div class='col-md-6 col-md-offset-6 col-sm-6 col-sm-offset-6' style='margin-top:15px; margin-bottom:20px;'>
	<div class='col-md-12'>
		<div class='col-md-12'>
			<button type='submit' name='submit' class='btn btn-primary' value="submit">បង្កើតរបាយការណ៍</button>
		</div>
	</div>
</div>
</form>
<div class='clear'></div>
	<script>
$(document).ready(function(){
	$('#REP_DAT_1_INP').change(function(){
		var url='<?php echo base_url('admin/report/selectSignatures') ?>';
		var date = $(this).val();
		$.ajax({
				type: "POST",
				url: url,
				dataType: 'text',
				data: {date:date},
				success: function(data){
					if(data !=''){
						//alert(data);
						$('#select_dynamic').html('<br />'+data);
						}
				},
				error: function(data){
					alert('error:' + data);
					location.reload();
					}
			});
	});
});

    
	</script>
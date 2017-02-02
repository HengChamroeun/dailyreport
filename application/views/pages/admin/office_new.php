
    <div class="jumbotron">
		
		  <h2>Offices</h2> 
		  <?php echo validation_errors(); ?>

		  <?php 
			$attributes = array('class' => 'form-horizontal', 'id' => 'frmAddOffice','role'=>'form');
			echo form_open(base_url('admin/office/new_office'),$attributes); ?>
			<div class="form-group">
			  <label class="control-label col-sm-4" for="office_code">Office Code:</label>
			  <div class="col-sm-8">          
				<input type="text" class="form-control" name='office_code' id="office_code" placeholder="Office Code">
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-4" for="office_name">Office Name</label>
			  <div class="col-sm-8">          
				<input type="text" class="form-control" name='office_name' id="office_name" placeholder="Office Name">
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-4" for="branch">Branch:</label>
			  <div class="col-sm-8">          
				<select class='form-control' id='branch' name='branch_code'>
					<?php 
						$braches=$this->m_customs->getBranch();
						foreach($braches as $b){
							echo "<option value='".$b->id."'>".$b->branch_name."</option>";
						}
					?>
					
				</select>
			  </div>
			</div>
			<div class="form-group"> 
			  <div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-sm btn-success" name='submit' value='Add Office'>
				<a class='btn' href="<?php echo base_url('admin/office') ?>">Cancel</a>
			  </div>
			</div>
		  </form>
    </div>
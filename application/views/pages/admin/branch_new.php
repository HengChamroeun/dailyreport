
    <div class="jumbotron">
		
		  <h2>Branch -> New branch</h2> 
		  <?php echo validation_errors(); ?>

		  <?php 
			$attributes = array('class' => 'form-horizontal', 'id' => 'frmAddBranch','role'=>'form');
			echo form_open(base_url('admin/branch/new_branch'),$attributes); ?>
			<div class="form-group">
			  <label class="control-label col-sm-4" for="branch_code">Branch code :</label>
			  <div class="col-sm-8">          
				<input type="text" class="form-control" name='branch_code' id="branch_code" placeholder="Branch code">
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-4" for="branch_name">Branch Name:</label>
			  <div class="col-sm-8">          
				<input type="text" class="form-control" name='branch_name' id="branch_name" placeholder="Branch Name">
			  </div>
			</div>
			<div class="form-group"> 
			  <div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-sm btn-success" name='submit' value='Add Branch'>
				<a class='btn' href="<?php echo base_url('admin/branch') ?>">Cancel</a>
			  </div>
			</div>
		  </form>
    </div>
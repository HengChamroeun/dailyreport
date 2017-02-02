
    <div class="jumbotron">
		
		  <h2>បង្កើតឈ្មោះអ្នកប្រើប្រាស់ថ្មី</h2><br>
		  <?php echo validation_errors(); ?>

		  <?php 
			$attributes = array('class' => 'form-horizontal', 'id' => 'frmAddUser','role'=>'form');
			echo form_open(base_url('admin/users/new_user'),$attributes); ?>
			<div class="form-group">
			  <label class="control-label col-sm-4" for="username">ឈ្មោះអ្នកប្រើ</label>
			  <div class="col-sm-8">          
				<input type="text" class="form-control" name='username' id="username" placeholder="ឈ្មោះអ្នកប្រើ">
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-4" for="password">លេខកូដសម្ងាត់</label>
			  <div class="col-sm-8">          
				<input type="password" class="form-control" name='password' id="password" placeholder="លេខកូដសម្ងាត់">
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-4" for="branch">Branch:</label>
			  <div class="col-sm-8">          
				<select class='form-control' id='branch' name='branch_code'>
					<?php 
						$braches=$this->m_customs->getBranch(false,true);
						foreach($braches as $b){
							echo "<option value='".$b->code."'>".$b->name."</option>";
						}
					?>
					
				</select>
			  </div>
			</div>
			<div class="form-group"> 
			  <div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-sm btn-success" name='submit' value='បន្ថែមឈ្មោះអ្នកប្រើ'>
				<a class="btn btn-sm btn-success" href="<?php echo base_url('admin/users') ?>">បោះបង់</a>
			  </div>
			</div>
		  </form>
    </div>
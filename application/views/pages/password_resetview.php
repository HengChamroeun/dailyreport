<div class="jumbotron">
<style>

</style>
<h2>ផ្លាស់ប្តូរពាក្យសំងាត់របស់អ្នក</h2>
<br/>
<?php echo validation_errors(); ?>
<?php
$attr = array('id'=>'frm_resetpw','class'=>'form-horizontal','role'=>'form');
$USER = CI_USERCOOKIE();
$old_pw = $USER[cookiePASS];
$hidden = array('u_id' => $USER[cookieID],'old' => $USER[cookiePASS]);
echo form_open(base_url('password_reset/resetPassword'),$attr,$hidden);
?>
<div style="margin-right:10%; margin-left:10%">
<div class="form-group">
	<label class="control-label col-sm-4"​ for="old_pw">ឈ្មោះអ្នកប្រើប្រាស់ :&nbsp;</label>
    <div class="col-sm-8">
    	<input type="text" class="form-control" name="username" id="username" value="<?php echo $USER[cookieUSER] ?>" readonly></input>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-sm-4"​ for="old_pw">ពាក្យសំងាត់ចាស់ :&nbsp;</label>
    <div class="col-sm-8">
    	<input type="password" class="form-control" placeholder="ពាក្យសំងាត់" name="old_pw" id="old_pw"></input>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-sm-4"​ for="old_pw">ពាក្យសំងាត់ថ្មី :&nbsp;</label>
    <div class="col-sm-8">
    	<input type="password" class="form-control" placeholder="ពាក្យសំងាត់" name="new_pw" id="new_pw"></input>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-sm-4"​ for="old_pw">បញ្ចូលពាក្យសំងាត់ថ្មីម្តងទៀត :&nbsp;</label>
    <div class="col-sm-8">
    	<input type="password" class="form-control" placeholder="ពាក្យសំងាត់" name="re_new_pw" id="re_new_pw"></input>
    </div>
</div>
<div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <input name="submit" type="submit" value="កែប្រែ" class="btn btn-sm btn-success">
      <a class="btn btn-sm btn-success" href="<?php echo base_url('') ?>">ចាកចេញ</a>
    </div>
</div>
<div></div></div>
</form>
</div>

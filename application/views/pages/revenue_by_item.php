<?php
$branch_code=$this->m_global->select_record(TBLUSERS,array('id'=>$USER_ID),'branch_code'); 
?>
<div class="jumbotron">
<form class="form-horizontal">
<h2 class="title"><?php echo($this->m_customs->getBranch($branch_code)); ?></h2>
<!--<h2 class="title">ចំណូលពន្ធតាមមុខទំនិញ <?php //echo showDateKH($DATE) ?></h2>-->
<br/>
<?php $ofs=$this->m_customs->getOffices($branch_code); 
$i=1;
$hidden='';
foreach($ofs as $of){
	?>
	<div class="form-group">
	  <label class="control-label col-sm-8 off_name" for="revenue_<?php echo $i; ?>"><?php echo $of->name; ?> :</label>
	  <div class="col-sm-4">          
		<a href="<?php echo base_url('input_38'); ?>?office=<?php echo $of->code ?>">ទំនិញនាំចូល</a> | 
        <a href="<?php echo base_url('input_export'); ?>?office=<?php echo $of->code ?>">ទំនិញនាំចេញ</a>
	  </div>
	</div>
	
	<?php
$hidden='';
$i++;
}
if(count($ofs)==0){
	$branch_name = $this->m_global->select_record(TBLOFFICES,array('code'=>$branch_code),'name');
	?>
	<div class="form-group">
	  <label class="control-label col-sm-8 off_name"><?php echo $branch_name; ?> :</label>
	  <div class="col-sm-4">          
		<a href="<?php echo base_url('input_38'); ?>?office=<?php echo $branch_code ?>">ទំនិញនាំចូល</a> | 
       <a href="<?php echo base_url('input_export'); ?>?office=<?php echo $branch_code ?>">ទំនិញនាំចេញ</a>
	  </div>
	</div>
	
	<?php
	}			
?>
</form>
</div>
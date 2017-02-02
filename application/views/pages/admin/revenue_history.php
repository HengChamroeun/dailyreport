<div class="jumbotron" style="border: 0px;">
<h2>ប្រវត្តិនៃការកែប្រែចំណូលពន្ធ</h2>
<br/>
<div class='col-md-3 col-md-offset-9' style="background-color: #ffffff;">
				<div class="form-group">
					<input type='text' class="form-control" value='<?php echo $this->input->get('date')?$this->input->get('date'):''; ?>' id='datepicker' />
				</div>
				
		  </div>
<div class="col-md-12 table-responsive">
<table class="table table-bordered">
	<thead>
		<tr class="trheader">
			<td>លេខ.</td>
			<td>អ្នកកែចំណូលពន្ធ</td>
			<td>សាខា</td>
			<td>ការិយាល័យ</td>
			<td>ថ្ងៃបញ្ចូលពន្ធ</td>
			<td>តូរលេខចាស់</td>
			<td>តួរលេខថ្មី</td>
			<td>ថ្ងៃកែពន្ធ</td>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
	$today = '';
	$firstday = '';
	$where = array();
	if(!$this->input->get('date')){
		$today = date("Y-m-d");
		$firstday = date("Y-m").'-01';
		$where = array('revenue_date >='=>$firstday,'revenue_date <='=>$today);
		}
		//echo(date("Y-m-d"));
		//var_dump($where);
	if($this->input->get('date')){
		$date = $this->input->get('date');
		$where = array('revenue_date'=>$date);
	}
	$histories = $this->m_global->select_data(TBLHISTORIES, $where, array('ID'=>'ASC'));
	foreach ($histories as $history) {
		$user = $this->m_global->select_data(TBLUSERS, array('id'=>$history->user_id));
		$branch = $this->m_global->select_data(TBLOFFICES, array('code'=>$history->branch_id));
		$office = $this->m_global->select_data(TBLOFFICES, array('code'=>$history->office_id));
	?>
		<tr class="bgred">
			<td class="tip"><?php echo($i++); ?></td>
			<td class="tip"><?php echo($user[0]->username); ?></td>
			<td class="tip"><?php echo($branch[0]->name_print); ?></td>
			<td class="tip"><?php echo($office[0]->name_print); ?></td>
			<td class="tip"><?php echo($history->revenue_date); ?></td>
			<td class="tip"><?php echo(easy_number_format($history->old_acc).' រៀល'); ?></td>
			<td class="tip"><?php echo(easy_number_format($history->new_acc).' រៀល'); ?></td>
			<td class="tip"><?php 
			$date_edit = date("h:i A",strtotime($history->timestamp));
			echo($date_edit); 
				?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
</div>
</div>
<style>
	.footer{
		border-top: 0px;
	}
	.container.admin{
		background-color:#fff !important;
	}
		.trheader td{
			background-color: #337ab7;
			color: #ffffff;
		} 
		tr td{background-color:#dff0d8;}
</style>
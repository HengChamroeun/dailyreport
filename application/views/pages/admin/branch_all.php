
    <div class="jumbotron">
		  <h2>សាខាគយនិងរដ្ឋាករកម្ពុជា </h2> 
			<table class='table' id='example'>
				<thead>
				<tr class="trheader">
					<th>លេខ.</th>
					<th>ឈ្មោះសាខា</th>
					<th>ឈ្មោះអ្នកប្រើ</th>
					<th>កែតម្រូវ</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$branch=$this->m_customs->getBranch();
					$i=1;
					foreach($branch as $b){
						echo '<tr>';
						echo "<td>$i</td>";
						echo "<td>$b->name</td>";
						echo "<td>".$this->m_global->select_record(TBLUSERS,array('branch_code'=>$b->code),'username')."</td>";
						echo "<td>កែតម្រូវ</td>";
						echo '</tr>';
						$i++;
					}
				?>
				</tbody>
			</table>
			<a class='btn btn-primary btnmargin' href="<?php echo base_url('admin/branch/new_branch') ?>">បន្ថែមឈ្មោះសាខា</a>
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
	</style>
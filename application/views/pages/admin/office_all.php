
    <div class="jumbotron">
		  <h2>ការិយាល័យគយនិងរដ្ឋាករកម្ពុជា</h2> 
			<table class='table' id='example'>
				<thead>
				<tr class="trheader">
					<th>លេខ.</th>
					<th>លេខកូដការិយាល័យ</th>
					<th>ឈ្មោះការិយាល័យ</th>
					<th>សាខា</th>
					<th>កែតម្រូវ</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$off=$this->m_customs->getOffices();
					$i=1;
					foreach($off as $o){
						
						echo '<tr>';
						echo "<td>$i</td>";
						echo "<td>$o->code</td>";
						echo "<td>$o->name</td>";
						echo "<td>".$this->m_customs->getBranch($o->parent_code)."</td>";
						echo "<td>កែតម្រូវ</td>";
						echo '</tr>';
						$i++;
					}
				?>
				</tbody>
			</table>
			<a class='btn btn-primary btnmargin' href="<?php echo base_url('admin/office/new_office') ?>">បន្ថែមឈ្មោះការិយាល័យ</a>
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
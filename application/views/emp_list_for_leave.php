<?php if(isset($emp_list) && !empty($emp_list))
{?>
	<table class="table table-striped table-bordered table-hover masterTable">
		<thead>
			<tr>
				<th>Sr. No.</th>
				<th>Employee Id</th>
				<th>Name</th>
				<th>Paid Leave</th>
				<th>Balance Leave</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			
			<?php $i=1;
			foreach ($emp_list as $key) 
			{?>
				<tr class="odd gradeX">
					<td style="text-align:center;">
						<?php echo $i++;?>
					</td>
					<td style="text-align:center;">
						<?php echo (isset($key->employee_id) && !empty($key->employee_id))?$key->employee_id:'';?>
					</td>
					<td>
						<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
					</td>
					<td>
						<?php echo (isset($key->paid_leave) && !empty($key->paid_leave))?$key->paid_leave:'0';?>
					</td>
					<td>
						<?php echo (isset($key->balance_leave) && !empty($key->balance_leave))?$key->balance_leave:'0';?>
					</td>
					
					<td style="text-align:center;">												
						<span style="cursor: pointer;" class="tooltips add_leave" rel='<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>'>
							<i class="fa fa-plus-square" aria-hidden="true"></i>
						</span>
					</td>
				</tr>
			<?php }?>												
		</tbody>
	</table>
<?php }
else 
{?>
	<center><h4>No Records Found</h4></center>
<?php }?>
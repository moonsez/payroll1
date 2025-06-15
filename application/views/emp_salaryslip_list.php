<?php if(isset($empSalaryList) && !empty($empSalaryList))
{?>
	<table class="table table-striped table-bordered table-hover masterTable">
		<thead>
			<tr>
				<th>Sr. No.</th>
				<th>Employee Id</th>
				<th>Name</th>
				<th>Days Of Working</th>
				<th>Basic Amount</th>
				<th>Net Pay</th>
				<th><input type='checkbox' class='select_all'/> Select All
					<input type="hidden" class="month" value="<?php echo $salaryMonth; ?>" />
				</th>
			</tr>
		</thead>
		<tbody>
			
			<?php $i=1;
			foreach ($empSalaryList as $key) 
			{?>
				<tr class="odd gradeX">
					<td style="text-align:center;">
						<?php echo $i++;?>
					</td>
					<td style="text-align:center;">
						<?php echo (isset($key->username) && !empty($key->username))?$key->username:'';?>
					</td>
					<td>
						<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
					</td>
					<td>
						<?php echo (isset($key->work_day) && !empty($key->work_day))?$key->work_day:'';?>
					</td>
					<td style="text-align:center;">
						
						<?php echo (isset($key->basic_amt) && !empty($key->basic_amt))?$key->basic_amt:'';?>
					</td>
					<td style="text-align:right;">
						<?php 
						$bonus = ($key->bonus_allowance/$num_days_of_month) * $key->work_day;
						echo (isset($key->basic_amt) && !empty($key->basic_amt))?($key->basic_amt + round($bonus)):'';?>
					</td>
					<td style="text-align:center;">												
						<input type="checkbox" class="select_opt" value="<?php echo $key->emp_id; ?>" <?php echo (isset($key->salaryslip) && !empty($key->salaryslip) && ($key->salaryslip=='show'))?'checked="checked"':'';?> />
						<input type="hidden" class="com_id" value="<?php echo $key->company_id; ?>" />
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
<hr>
<div class="form-actions">
	<center>
		<button type="submit" class="btn green updatestatus">Update</button>
		<button type="button" class="btn red clearData">Clear</button>
	</center>
</div>
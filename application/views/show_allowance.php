<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Employee List
				</div>							
			</div>
			<?php //print_r($empDetails);?>
			<div class="portlet-body">
				<?php if(isset($empDetails) && !empty($empDetails))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th>
									Id
								</th>
								<th>
									Name
								</th>
								<th>
									Designation
								</th>
								<th>
									PAN No.
								</th>
								<th>
									Basic
								</th>
								<th>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach ($empDetails as $key) 
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
										<?php echo (isset($key->desig_name) && !empty($key->desig_name))?$key->desig_name:'';?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->emp_pan_num) && !empty($key->emp_pan_num))?$key->emp_pan_num:'';?>
									</td>
									<td style="text-align:right;">
										<?php echo (isset($key->emp_basic) && !empty($key->desig_name))?$key->emp_basic:'';?>
									</td>
									<td style="text-align:center;">									
										<?php /*<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_deduction_allowance" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="Edit" data-placement="top">
											<i class="fa fa-edit"></i>
										</span>	*/?>									
										<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#employeeDetailsDiv" data-tburl="fetch_data" rev="delete_employee" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="Delete" data-placement="top">
											<i class="fa fa-trash-o"></i>
										</span>
										<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_employee" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="Edit" data-placement="top">
											<i class="fa fa-edit"></i>
										</span>
										<span style="cursor: pointer;" class="tooltips viewRecord" rev="view_employee" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="view" data-placement="top">
											<i class="fa fa-edit"></i>
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
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
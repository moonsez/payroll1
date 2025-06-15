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
				<?php if(isset($reprintTableData) && !empty($reprintTableData))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th>Employee Id</th>
								<th>Name</th>
								<th>Gender</th>
								<th>Designation</th>
								<th>Days Of Working</th>
								<th>Net Pay</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							
							<?php $i=1;
							foreach ($reprintTableData as $key) 
							{?>
								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->comp_employee_id) && !empty($key->comp_employee_id))?$key->comp_employee_id:'';?>
									</td>
									<td>
										<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
									</td>
									<td>
										<?php echo (isset($key->emp_gender) && !empty($key->emp_gender))?$key->emp_gender:'';?>
									</td>
									<td>
										<?php echo (isset($key->emp_designation) && !empty($key->emp_designation))?$key->emp_designation:'';?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->emp_working_days) && !empty($key->emp_working_days))?$key->emp_working_days:'';?>
									</td>
									<td style="text-align:right;">
										<?php echo (isset($key->net_pay) && !empty($key->net_pay))?$key->net_pay:'';?>
									</td>
									<td style="text-align:center;">																				
										<!-- <span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#reprintSalaryGeneratePreview" data-tburl="reprint_pay_slip_data" rev="delete_pay_slip" rel="<?php echo (isset($key->slip_static_data_id) && !empty($key->slip_static_data_id))?$key->slip_static_data_id:'';?>:<?php echo (isset($key->pay_slip_month) && !empty($key->pay_slip_month))?$key->pay_slip_month:'';?>" data-original-title="Delete" data-placement="top">
											<a href="javascript:void(0);">
												<i class="fa fa-trash-o"></i>
											</a>
										</span> -->
										<span style="cursor: pointer;" class="tooltips reprint" data-tburl="<?php echo base_url();?>re_print" rev="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" rel="<?php echo (isset($key->pay_slip_month) && !empty($key->pay_slip_month))?$key->pay_slip_month:'';?>" data-original-title="Delete" data-placement="top">
											<i class="fa fa-trash-o"></i>
										</span>
											

										 <span style="cursor: pointer;" class="tooltips" data-original-title="Reprint" data-placement="top">
											<a href="<?php echo base_url();?>gef/<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>/<?php echo (isset($key->pay_slip_month) && !empty($key->pay_slip_month))?$key->pay_slip_month:'';?>">
												
												<i class="fa fa-file-excel-o"></i>
											</a>
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
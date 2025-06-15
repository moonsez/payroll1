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
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#tab_1_1" data-toggle="tab">
						Approved </a>
					</li>
					<li>
						<a href="#tab_1_2" data-toggle="tab">
						Pending </a>
					</li>
					<li>
						<a href="#tab_1_3" data-toggle="tab">
						Rejected </a>
					</li>					
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="tab_1_1">
						<?php if(isset($empDetails) && !empty($empDetails))
						{?>
							<table class="table table-striped table-bordered table-hover masterTable">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<!-- <th>
											Employee Id
										</th> -->
										<th>
											Name
										</th>
										<th>
											Gender
										</th>
										<!-- <th>
											Designation
										</th>
										<th>
											Location
										</th> -->
										<th>
											Date of Joining
										</th>
										<!-- <th>
											Entry By
										</th> -->
										<th>
											Actions
										</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1;
									foreach ($empDetails as $key) 
									{ if($key->status==='Approve'){?>
										<tr class="odd gradeX">
											<td style="text-align:center;">
												<?php echo $i++;?>
											</td>
											<!-- <td style="text-align:center;">
												<?php echo (isset($key->employee_id) && !empty($key->employee_id))?$key->employee_id:'';?>
											</td> -->
											<td>
												<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
											</td>
											<td>
												<?php echo (isset($key->gender) && !empty($key->gender))?$key->gender:'';?>
											</td>
											<!-- <td>
												<?php echo (isset($key->desig_id) && !empty($key->desig_id))?$key->desig_id:'';?>
											</td>
											<td style="text-align:center;">
												<?php echo (isset($key->emp_loc) && !empty($key->emp_loc))?$key->emp_loc:'';?>
											</td> -->
											<td style="text-align:center;">
												<?php echo (isset($key->date_of_joining) && !empty($key->date_of_joining))?date('d-m-Y',strtotime($key->date_of_joining)):'';?>
											</td>
											<!-- <td style="text-align:center;">
												<?php echo (isset($key->entry_by) && !empty($key->entry_by))?"Entry by ".$key->fullname." At ".$key->entry_date:'';?>
											</td> -->
											<td style="text-align:center;">									
												<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#employeeDetailsDiv" data-tburl="fetch_data" rev="delete_employee" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="Delete" data-placement="top">
													<i class="fa fa-trash-o"></i>
												</span>
												<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_employee" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="Edit" data-placement="top">
													<i class="fa fa-edit"></i>
												</span>
												<span style="cursor: pointer;" class="tooltips editEmpCreation" rev="updateEmpCreation" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="View" data-placement="top">
													<i class="fa fa-eye"></i>
												</span>
											</td>
										</tr>
									<?php } } ?>												
								</tbody>
							</table>
						<?php }
						else 
						{?>
							<center><h4>No Records Found</h4></center>
						<?php }?>
					</div>
					<div class="tab-pane fade" id="tab_1_2">
						<?php if(isset($empDetails) && !empty($empDetails))
						{?>
							<table class="table table-striped table-bordered table-hover masterTable">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<!-- <th>
											Employee Id
										</th> -->
										<th>
											Name
										</th>
										<th>
											Gender
										</th>
										<!-- <th>
											Designation
										</th>
										<th>
											Location
										</th> -->
										<th>
											Date of Joining
										</th>
										<th>
											Actions
										</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1;
									foreach ($empDetails as $key) 
									{ if($key->status==='Pending'){?>
										<tr class="odd gradeX">
											<td style="text-align:center;">
												<?php echo $i++;?>
											</td>
											<!-- <td style="text-align:center;">
												<?php echo (isset($key->employee_id) && !empty($key->employee_id))?$key->employee_id:'';?>
											</td> -->
											<td>
												<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
											</td>
											<td>
												<?php echo (isset($key->gender) && !empty($key->gender))?$key->gender:'';?>
											</td>
										<!-- 	<td>
												<?php echo (isset($key->desig_id) && !empty($key->desig_id))?$key->desig_id:'';?>
											</td>
											<td style="text-align:center;">
												<?php echo (isset($key->emp_loc) && !empty($key->emp_loc))?$key->emp_loc:'';?>
											</td> -->
											<td style="text-align:center;">
												<?php echo (isset($key->date_of_joining) && !empty($key->date_of_joining))?date('d-m-Y',strtotime($key->date_of_joining)):'';?>
											</td>
											<td style="text-align:center;">									
												<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#employeeDetailsDiv" data-tburl="fetch_data" rev="delete_employee" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="Delete" data-placement="top">
													<i class="fa fa-trash-o"></i>
												</span>
												<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_employee" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="Edit" data-placement="top">
													<i class="fa fa-edit"></i>
												</span>
												<span style="cursor: pointer;" class="tooltips editEmpCreation" rev="updateEmpCreation" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="View" data-placement="top">
													<i class="fa fa-eye"></i>
												</span>
											</td>
										</tr>
									<?php } } ?>												
								</tbody>
							</table>
						<?php }
						else 
						{?>
							<center><h4>No Records Found</h4></center>
						<?php }?>
					</div>
					<div class="tab-pane fade" id="tab_1_3">
						<?php if(isset($empDetails) && !empty($empDetails))
						{?>
							<table class="table table-striped table-bordered table-hover masterTable">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<!-- <th>
											Employee Id
										</th> -->
										<th>
											Name
										</th>
										<th>
											Gender
										</th>
										<!-- <th>
											Designation
										</th>
										<th>
											Location
										</th> -->
										<th>
											Date of Joining
										</th>
										<th>
											Remark
										</th>
										<th>
											Actions
										</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1;
									foreach ($empDetails as $key) 
									{ if($key->status==='Reject'){?>
										<tr class="odd gradeX">
											<td style="text-align:center;">
												<?php echo $i++;?>
											</td>
											<!-- <td style="text-align:center;">
												<?php echo (isset($key->employee_id) && !empty($key->employee_id))?$key->employee_id:'';?>
											</td> -->
											<td>
												<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
											</td>
											<td>
												<?php echo (isset($key->gender) && !empty($key->gender))?$key->gender:'';?>
											</td>
											<!-- <td>
												<?php echo (isset($key->desig_id) && !empty($key->desig_id))?$key->desig_id:'';?>
											</td>
											<td style="text-align:center;">
												<?php echo (isset($key->emp_loc) && !empty($key->emp_loc))?$key->emp_loc:'';?>
											</td> -->
											<td style="text-align:center;">
												<?php echo (isset($key->date_of_joining) && !empty($key->date_of_joining))?date('d-m-Y',strtotime($key->date_of_joining)):'';?>
											</td>
											<td style="text-align:center;">
												<?php echo (isset($key->remark) && !empty($key->remark))?$key->remark:'';?>
											</td>
											<td style="text-align:center;">									
												<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#employeeDetailsDiv" data-tburl="fetch_data" rev="delete_employee" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="Delete" data-placement="top">
													<i class="fa fa-trash-o"></i>
												</span>
												<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_employee" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="Edit" data-placement="top">
													<i class="fa fa-edit"></i>
												</span>
												<span style="cursor: pointer;" class="tooltips editEmpCreation" rev="updateEmpCreation" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="View" data-placement="top">
													<i class="fa fa-eye"></i>
												</span>
											</td>
										</tr>
									<?php } } ?>												
								</tbody>
							</table>
						<?php }
						else 
						{?>
							<center><h4>No Records Found</h4></center>
						<?php }?>
					</div>										
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
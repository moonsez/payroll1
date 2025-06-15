<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">		
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<ul class="page-breadcrumb breadcrumb">					
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>dashboard">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
	 				<li>
						<a href="javascript:void(0);">Employee Salary Structure</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN FORM-->
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
						<?php if(isset($pending_str) && !empty($pending_str))
						{?>
							<table class="table table-striped table-bordered table-hover masterTable">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>
											Employee Id
										</th>
										<th>
											Name
										</th>
										<th>
											Gender
										</th>
										<th>
											Designation
										</th>
										<th>
											Location
										</th>
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
									foreach ($pending_str as $key) 
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
												<?php echo (isset($key->gender) && !empty($key->gender))?$key->gender:'';?>
											</td>
											<td>
												<?php echo (isset($key->desig_id) && !empty($key->desig_id))?$key->desig_id:'';?>
											</td>
											<td style="text-align:center;">
												<?php echo (isset($key->emp_loc) && !empty($key->emp_loc))?$key->emp_loc:'';?>
											</td>
											<td style="text-align:center;">
												<?php echo (isset($key->date_of_joining) && !empty($key->date_of_joining))?date('d-m-Y',strtotime($key->date_of_joining)):'';?>
											</td>
											<td style="text-align:center;">					
												<span style="cursor: pointer;" class="tooltips view_salary_str" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="View" data-placement="top">
													<button class="btn green">Approve</button>
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
		<!-- END FORM-->
	</div>
</div>
<!-- END CONTENT -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<?php $user = $this->master_model->selectDetailsWhr("tbl_userinfo","user_id",$this->session->userdata("userid")); ?>
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
						<a href="javascript:void(0);">Report List</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);">Expenditure Report</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN MAIN ROW CONTENT-->
		
		<!-- END MAIN ROW -->
		<div class="row">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Variable Bonus Report
							</div>							
						</div>
						<div class="portlet-body">

								<?php if(isset($SalaryList) && !empty($SalaryList))
									{?>
										<table class="table table-striped table-bordered table-hover masterTable">
											<thead>
												<tr>
													<th>
														Sr. No.
													</th>
													<th>
														 Company Name
													</th>
													<th>
														Salary Month
													</th>
													<th>
														Download Excel
													</th>
												</tr>
											</thead>
											<tbody>
												<?php $i=1; 
												foreach ($SalaryList as $key) 
												{ 
																							
												?>
													<tr class="odd gradeX">
														<td style="text-align:center;">
															<?php echo $i++;?>
														</td>
														<td>
															<?php echo (isset($key->company_name) && !empty($key->company_name))?$key->company_name:'';?>
														</td>
														<td>
															<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>
														</td>
														<td style="text-align:center;">									
															<span style="cursor: pointer;" class="tooltips" data-original-title="Reprint" data-placement="top">
																<a href="<?php echo base_url();?>genBonusReport/<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>/<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>">
																	<i class="fa fa-file-excel-o"></i> 
																</a>
															</span>
														</td>
										
													</tr>
												<?php  } ?>												
											</tbody>
										</table>
									<?php }
									else {?>
										<center><h4>No Records Found</h4></center>
									<?php }?>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>	
		
	</div>
</div>
<!-- END CONTENT -->

	
	
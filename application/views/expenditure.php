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
								<i class="fa fa-cogs"></i>Expenditure List
							</div>							
						</div>
						<div class="portlet-body">

							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab_1_1" data-toggle="tab">
									Pending </a>
								</li>
								<li>
									<a href="#tab_1_2" data-toggle="tab">
									Approved </a>
								</li>
												
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade active in" id="tab_1_1">	
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
													<th>
														Download Bank Letter
													</th>
													<th>
														Download Bank File
													</th>
													<th>
														Status
													</th>
												</tr>
											</thead>
											<tbody>
												<?php $i=1; 
												foreach ($SalaryList as $key) 
												{ 
													if ($key->status== "Pending") {											
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
																<a href="<?php echo base_url();?>genExpendReport/<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>/<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>">
																	<i class="fa fa-file-excel-o"></i> 
																</a>
															</span>
															<?php $sal_month = (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';
																	$cur_month = date('m-Y',strtotime("-1 month"));
															if($sal_month==$cur_month && $key->status =="Pending"){ ?> 	
															<span style="cursor: pointer;" class="tooltips deleteSalary" rev="delete_salary" rel="<?php echo $key->company_id.'/'.$key->salary_month;?>" data-original-title="Delete" data-placement="top">
																<i class="fa fa-trash-o"></i>
															</span> 
															<?php } ?> 
														</td>
														<td style="text-align:center;">
															<a href="<?php echo base_url();?>genBankLetter/<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>/<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>">
																	download
																</a>
														</td>	
														<td style="text-align:center;">
															<a href="<?php echo base_url();?>genTextReport/<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>/<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>/text">
																	download text file
																</a>
																<br/>
																<a href="<?php echo base_url();?>genTextReport/<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>/<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>/bob">
																	download BOB file
																</a>
																<br/>
																<a href="<?php echo base_url();?>genPfTextReport/<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>/<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>/text">
																	download PF ECR text file
																</a>
																
														</td>
																   
														<td style="text-align:center;">		
															<?php /*  href="<?php echo base_url();?>appExpendReport/<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:''; */?>			
															<?php if(isset($user->payslip_role ) && $user->payslip_role =="Approver"){ ?>				
															<button class="btn green approveExpenditureReport" data-month="<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>" data-company_id="<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>" >
																	Approve
																</button>
															<?php } else { echo $key->status; }?>
														</td> 
													</tr>
												<?php } } ?>												
											</tbody>
										</table>
									<?php }
									else {?>
										<center><h4>No Records Found</h4></center>
									<?php }?>
								</div>
								<div class="tab-pane fade active in" id="tab_1_2">	
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
													<th>
														Download Bank Letter
													</th>
													<th>
														Download Bank Text File
													</th>
													<th>
														Status
													</th>
												</tr>
											</thead>
											<tbody>
												<?php $i=1; 
												foreach ($SalaryList as $key) 
												{ 
													if ($key->status== "Approved") {											
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
																<a href="<?php echo base_url();?>genExpendReport/<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>/<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>">
																	<i class="fa fa-file-excel-o"></i> 
																</a>
															</span>
															<?php $sal_month = (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';
																	$cur_month = date('m-Y',strtotime("-1 month"));
															if($sal_month==$cur_month && $key->status =="Pending"){ ?> 	
															<span style="cursor: pointer;" class="tooltips deleteSalary" rev="delete_salary" rel="<?php echo $key->company_id.'/'.$key->salary_month;?>" data-original-title="Delete" data-placement="top">
																<i class="fa fa-trash-o"></i>
															</span> 
															<?php } ?> 
														</td>
														<td style="text-align:center;">
															<a href="<?php echo base_url();?>genTextReport/<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>/<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>/bob">
																download
															</a>
														</td>	
														<td style="text-align:center;">
															<a href="<?php echo base_url();?>genTextReport/<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>/<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>/text">
																download
															</a>															
														</td>
																
														<td style="text-align:center;">		
															<?php echo $key->status;?>
														</td> 
													</tr>
												<?php } } ?>												
											</tbody>
										</table>
									<?php }
									else {?>
										<center><h4>No Records Found</h4></center>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>	
		
	</div>
</div>
<!-- END CONTENT -->

	
	
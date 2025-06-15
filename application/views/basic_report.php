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
						<a href="javascript:void(0);">Salary Slip Report</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);"></a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Generate Report
						</div>							
					</div>
					<div class="portlet-body form">
						<?php //print_r($singleCountry);?>
						<!-- BEGIN FORM-->
						<form action="basic_report" id="basic_report_generate_form" class="horizontal-form" method="post">
							<div class="form-body">							
								<div class="row">
									<?php if($this->session->userdata('role_id') == 1){ ?>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													Select Company Name
													<span class="required" aria-required="true">*</span>
												</label>
												<select class="form-control select2me pre_company" name="comp_id" >
													<option value="">Select</option>
													<?php if(isset($companyData) && !empty($companyData))
													{
														foreach ($companyData as $key) 
														{?>
															<option value="<?php echo $key->company_id;?>"><?php echo $key->company_name;?></option>
														<?php }
													}?>  
												</select>
											</div>
									 	</div>
									 	<div class="col-md-6">
									 	</div>
									 	<?php }?>


								</div>

								<div class="row">
								
									<!-- <div class="col-md-6">
									 		<div class="form-group">
												<label class="control-label">
														Select Bank Type
														<span class="required" aria-required="true">*</span>
												</label>
												<select class="form-control select2me" name="emp_ac_type" id="emp_ac_type">
													<option value="OBC">OBC</option>
													<option value="OTOBC">Other than OBC</option>	
												</select>											
											</div>
									</div> -->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Months
												<span class="required" aria-required="true">*</span>
											</label>											
											<div class="input-group date datepickerGeneral">
												<input type="text" class="form-control" name="slip_months" readonly>
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>										
										</div>										
									</div>

								</div>	 	
								
								
							</div>

								 	
														
							 
							<div class="form-actions">
								<center>
									<button type="submit" class="btn green reportGenerate" >Submit</button>
									<button type="button" class="btn red clearData">Clear</button>
								</center>
							</div>
							
						</form>
					</div>
						<!-- END FORM-->
				</div>
			</div>
				<!-- END VALIDATION STATES-->
		</div>
		
		<div id="employeeDetailsDiv">
			<?php $this->load->view('basic_report_table');?>	
		</div>	
	</div>
</div>
	<!-- END CONTENT -->

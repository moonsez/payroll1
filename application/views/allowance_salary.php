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
						<a href="javascript:void(0);">Allowance Salary</a>
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
							<i class="fa fa-gift"></i>Allowance Salary Generate
						</div>							
					</div>
					<div class="portlet-body form">
						
						<!-- BEGIN FORM-->
						<form action="allowance_cal" id="generateAllowance" class="horizontal-form" method="post">
							<div class="form-body">				
								
								<div class="row">
									
									
									<?php if($this->session->userdata('comp_id') == 1){ ?>
									 
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Employee Name
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me pre_comp_html" name="allowance_emp_name" id="allowance_emp_name">
												<option value="">Select</option>
												<?php if(isset($empDetails) && !empty($empDetails))
												{
													foreach ($empDetails as $key) 
													{?>
														<option value="<?php echo $key->emp_id;?>"><?php echo $key->emp_name;?></option>
													<?php }
												}?>  

												
											</select>
										</div>
									</div>


									<?php }else{?>

																	
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Employee Name
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me" name="allowance_emp_name" id="allowance_emp_name">
												<option value="">Select</option>
												<?php if(isset($empDetails) && !empty($empDetails))
												{
													foreach ($empDetails as $key) 
													{?>
														<option value="<?php echo $key->emp_id;?>"><?php echo $key->emp_name;?></option>
													<?php }
												}?>  
											</select>
										</div>
									</div>

									<?php }?>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Months
												<span class="required" aria-required="true">*</span>
											</label>											
											<div class="input-group date datepickerGeneral">
												<input type="text" class="form-control" name="allowance_month" readonly>
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
									<button type="submit" class="btn green generateAllowance">Submit</button> 
									<button type="button" class="btn red clearData">Clear</button>
								</center>
							</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>
				<!-- END VALIDATION STATES-->
			</div> 
		</div> 
		<div id="Allowance_tbDiv">
			
		</div>	
	</div>
</div>
<!-- END CONTENT -->

	
	
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
						<a href="javascript:void(0);">HR Compliances</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);">Employee Register</a>
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
							<i class="fa fa-gift"></i>Employee Register
						</div>							
					</div>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="gen_employee_register" id="gen_employee_register" class="horizontal-form" method="post">
							<div class="form-body">							
								<div class="row">			
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Select Employee Name
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me" name="emp_id[]" multiple>
												<?php if(isset($empData) && !empty($empData))
												{
													foreach ($empData as $key) 
													{?>
														<option value="<?php echo $key->emp_id;?>"><?php echo $key->emp_name;?></option>
													<?php }
												}?>  
											</select>
										</div>
								 	</div>
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
									<button type="submit" class="btn green">Export</button>
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
	</div>
</div>
	<!-- END CONTENT -->

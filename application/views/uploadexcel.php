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
						<a href="javascript:void(0);">Salary Slip Attendance</a>
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
							<i class="fa fa-gift"></i>Upload Attendance File
						</div>							
					</div>
					<div class="portlet-body form">
						
						<!-- BEGIN FORM-->
						<form action="uploadAttend" id="uploadAttend" class="horizontal-form" method="post">
							<div class="form-body">							
								

								<div class="row">
																
										
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
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"> Upload Company Logo</label>
											<br/>

											<div class="fileinput fileinput-new" data-provides="fileinput">
												<span class="btn default btn-file">
												<span class="fileinput-new">
												Upload  </span>
												<span class="fileinput-exists">
												Change </span>													
												<input type="file" name="userfile" id="company_logo" >													
												</span>
												<span class="fileinput-filename">
												</span>
												&nbsp; <a href="javascript:void(0);" class="close fileinput-exists" data-dismiss="fileinput">
												</a>
											</div>
										</div>
									</div>
									<!--/span-->
								</div>
								
							</div>

									
														
							
							<div class="form-actions">
								<center>
									<button type="submit" class="btn green uploadfile" >Upload</button>
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
		
		<!-- <div id="employeeDetailsDiv">
			<?php // $this->load->view('report_table');?>	
		</div>	 -->
	</div>
</div>
	<!-- END CONTENT -->

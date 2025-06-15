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
						<a href="javascript:void(0);">Advance Details</a>
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
							<i class="fa fa-gift"></i>Advance Form
						</div>							
					</div>
					<div class="portlet-body form">
						<?php //print_r($singleCountry);?>
						<!-- BEGIN FORM-->
						<form action="save_Advance" id="save_advance_form" class="horizontal-form" method="post" data-tbdiv="#advanceDetails" data-tburl="fetch_advance_data" >
							<div class="form-body">									 
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Company 
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me pre_company1" name="comp_id" >
													<option value="">Select</option>
													<?php if(isset($compDetails) && !empty($compDetails))
													{
														foreach ($compDetails as $key) 
														{?>
															<option value="<?php echo $key->company_id;?>"><?php echo $key->company_name;?></option>
														<?php }
													}?>  
												</select>
										</div>
									</div>
									<div class="col-md-6"></div>																			
								</div>
								<div class="row">								
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Employee Name
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me pre_comp_html slip_emp_name" name="emp_name" id="slip_emp_name">
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
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
													Designation
											</label>
											<input type="text"  readonly="readonly" class="form-control" name="design_name_ad" id="design_name" value="">
										</div>
									</div>
								</div>	
								<div class="row">
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label">
													Advance Amount
													<span class="required">*</span>
												</label>
												<div class="input-icon right">
													<i class="fa"></i>
													<input type="text" class="form-control" name="amount" id="amount" maxlength="50" tabindex="" value="<?php echo (isset($advanceData->amount) && !empty($advanceData->emp_loc))?$advanceData->emp_loc:''?>">
												</div>
											</div>
										</div>
										<!--/span designation -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													Date
													<span class="required" aria-required="true">*</span>
												</label>											
												<div class="input-group date datepicker" style="z-index:1 ! important">
													<input type="text" class="form-control" name="advance_date" readonly>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>										
										</div>
								</div>
								<div class="row">
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label">
													Recovery Mode
													<span class="required">*</span>
												</label>

												<select class="form-control select2me" name="recovery_mode" id="recovery_mode">
													<option value="">Select</option>
													<option value="monthly">Monthly</option>
													<option value="quarterly">Quarterly</option>
													<option value="half_Yearly">Half –Yearly</option>
													
											</select>
											</div>
										</div>
										<!--/span designation -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													Recovery Amount
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="input-icon right">
													<i class="fa"></i>											
												<input type="text" class="form-control recovery_amount" name="recovery_amount" placeholder="recovery advance" id="recovery_amount" maxlength="50" tabindex="" value="<?php echo (isset($singleEmployee->recovery_amount) && !empty($singleEmployee->recovery_amount))?$singleEmployee->recovery_amount:''?>">
												</div>
											</div>										
										</div>
								</div>
								<div class="row" id="prev_adv" style="display: none;">
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label">
													Previous Total Advance Amount
													<span class="required">*</span>
												</label>
												<div class="input-icon right">
													<i class="fa"></i>
													<input type="text" class="form-control prev_amount" name="prev_amount" id="amount" maxlength="50" tabindex="" value="" disabled="disabled">
												</div>
											</div>
										</div>
										<!--/span designation -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													Previous Date
													<span class="required" aria-required="true">*</span>
												</label>											
												<div class="input-group date datepicker">
													<input type="text" class="form-control prev_advance_date" name="prev_advance_date" value="" disabled="disabled">
													<span class="input-group-btn">
													<button class="btn default" type="button" disabled="disabled"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>										
										</div>
								</div>
																
							</div>

							<div class="form-actions">
									<center>
										<button type="submit" class="btn green common_save" rel="<?php echo (isset($singleEmployee->emp_id) && !empty($singleEmployee->emp_id))?$singleEmployee->emp_id:''?>">
											<?php if(isset($singleEmployee->emp_id) && !empty($singleEmployee->emp_id))
											{
												echo 'Update';
											}
											else
											{
												echo 'Submit';
											}?>
										</button>
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
		<div id="advanceDetails">
			<?php $this->load->view('master/advance_view_table');?>
		</div>	
	</div>
</div>
	<!-- END CONTENT -->

	
	
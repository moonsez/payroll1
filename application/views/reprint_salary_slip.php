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
						<a href="javascript:void(0);">Reprint Previous Pay Slip</a>
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
							<i class="fa fa-gift"></i>Rr-Print Slip
						</div>							
					</div>
					<div class="portlet-body form">
						<?php //print_r($singleCountry);?>
						<!-- BEGIN FORM-->
						<form action="reprint_pay_slip_data" id="reprint_pay_slip_generate_form" class="horizontal-form" method="post">
							<div class="form-body">				
								
								<div class="row">
									
									<?php if($this->session->userdata('comp_id') == 1){ ?>
								
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">
												Company 
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-9">
												<!-- <div class="input-icon right"> -->
													<!-- <i class="fa"></i> -->
													<select class="form-control select2me precompan" name="comp_id" id="companyName">
													<option value="">Select</option>
													<?php if(isset($compDetails) && !empty($compDetails))
													{
														foreach ($compDetails as $key) 
														{?>
															<option value="<?php echo $key->company_id;?>"><?php echo $key->company_name;?></option>
														<?php }
													}?>  
												</select>
												<!-- </div> -->
											</div>
										</div>
									</div>

									
																			
								<?php } ?>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Select Months
												<span class="required" aria-required="true">*</span>
											</label>											
											<div class="input-group date datepickerGeneral col-md-8">
												<input type="text" class="form-control" name="reprint_slip_months" readonly>
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
									<button type="submit" class="btn green reprintSlipGenerate">Submit</button>
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
		<div id="reprintSalaryGeneratePreview">
			
		</div>	
	</div>
</div>
<!-- END CONTENT -->

	
	
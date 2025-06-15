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
						<a href="javascript:void(0);">Master Form</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);">Settings</a>
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
							<i class="fa fa-gift"></i>
							Settings
						</div>							
					</div>
					<div class="portlet-body form">
						<?php //print_r($singleCountry);?>
						<!-- BEGIN FORM-->
						<form action="" data-tbdiv="#" data-tburl="" id="country_form" class="form-horizontal" method="post">
							<div class="form-body">								
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2">
												Designation
									        </label>
											<div class="col-md-4">											
												<select class="form-control select2me" name="state_coun_name">
													<option value="0">select</option>
													<?php if(isset($desigData) && !empty($desigData))
													{
														foreach ($desigData as $key) 
														{?>
															<option value="<?php echo $key->desig_id?>"><?php echo $key->desig_name;?></option>
														<?php }															
													}?>														
												</select>										
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2">
												Earning Allowance
									        </label>
                                            <div class="col-md-4">																									
												<div class="checkbox-list">														
													<?php if(isset($checkData) && !empty($checkData))
													{
														foreach ($checkData as $key) 
														{?>
															<label class="checkbox-inline">
																<input type="checkbox" name="earning_allowance_code" value="<?php echo $key->earning_code?> <?php echo (isset($checkData->earning_code) && !empty($checkData->earning_code) && ($checkData->earning_code==$key->earning_code))?'selected="selected"':'';?>"/> <?php echo $key->earning_code ?>
															</label>
														<?php }															
													}?>														
												</div>												
									        </div>
										</div>										
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2">
												Deduction Allowance
									        </label>
                                            <div class="col-md-4">																								
												<div class="checkbox-list">													    
													<?php if(isset($checkData1) && !empty($checkData1))
													{
														foreach ($checkData1 as $key) 
														{?> 
															<label class="checkbox-inline">
																<input type="checkbox" name="deduction_allowance_code" value="<?php echo $key->deduction_code?> <?php echo (isset($checkData1->deduction_code) && !empty($checkData1->deduction_code) && ($checkData1->deduction_code==$key->deduction_code))?'selected="selected"':'';?>"/> <?php echo $key->deduction_code ?>
															</label>
														<?php }															
													}?>														
												</div>												
									        </div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-actions">
								<center>
									<button type="submit" class="btn green common_save" rel="<?php echo (isset($singleCountry->country_id) && !empty($singleCountry->country_id))?$singleCountry->country_id:''?>">
										<?php if(isset($singleCountry->country_id) && !empty($singleCountry->country_id))
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

		<!--<div id="countryDetailsDiv">
			<?php /*$this->load->view('master/country_table');*/?>	
		</div>	!-->	
	</div>
</div>
	<!-- END CONTENT -->

	
	
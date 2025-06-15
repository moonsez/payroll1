<!-- CODER  Rahul -->
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
						<a href="javascript:void(0);">Company Creation Form</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);">Company</a>
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
							<i class="fa fa-gift"></i>Add Company
						</div>							
					</div>
					<div class="portlet-body form">						
						<!-- BEGIN FORM-->
						<form action="save_company" data-tbdiv="#companyDetailsDiv" data-tburl="fetch_company" id="company_form" class="horizontal-form" method="post">
							<div class="form-body">							
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Company Name
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" id="company_name" name="company_name" class="form-control" placeholder=""  tabindex="" value="<?php echo (isset($singleCompany->company_name) && !empty($singleCompany->company_name))?$singleCompany->company_name:''?>">
											</div>
										</div>
									</div>
									<!--/span-->
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
												<input type="file" name="company_logo" id="company_logo" >													
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
												

								<div class="row">
									<div class="col-md-12 ">
										<div class="form-group">
											<label class="control-label">
												Address
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa" data-original-title=""></i>
												<input type="text" class="form-control" name="company_address" id="company_address" maxlength="190" tabindex="" value="<?php echo (isset($singleCompany->company_add) && !empty($singleCompany->company_add))?$singleCompany->company_add:''?>">
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Country
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me pre_country" name="company_country" id="company_country">
												<option value="">Select</option>
												<?php if(isset($countryData) && !empty($countryData))
												{
													foreach ($countryData as $key) 
													{?>
														<option value="<?php echo $key->country_id?>" <?php echo (isset($singleCompany->country_id) && !empty($singleCompany->country_id) && ($singleCompany->country_id==$key->country_id))?'selected="selected"':'';?>><?php echo $key->country_name;?></option>
													<?php }
												}?>  
											</select>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												State
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me pre_state_html pre_state" name="company_state" id="company_state">
											
											<?php if(isset($stateData) && !empty($stateData))
												{
													foreach ($stateData as $key) 
													{?>
														<option value="<?php echo $key->state_id?>" <?php echo (isset($singleCompany->state_id) && !empty($singleCompany->state_id) && ($singleCompany->state_id==$key->state_id))?'selected="selected"':'';?>><?php echo $key->state_name;?></option>
													<?php }
												}?> 

											</select>
										</div>
									</div>
									<!--/span-->
								</div>
								<!--/row-->
								<div class="row">										
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												City
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me pre_city" name="company_city" id="company_city">
											<?php if(isset($cityData) && !empty($cityData))
												{
													foreach ($cityData as $key) 
													{?>
														<option value="<?php echo $key->city_id?>" <?php echo (isset($singleCompany->city_id) && !empty($singleCompany->city_id) && ($singleCompany->city_id==$key->city_id))?'selected="selected"':'';?>><?php echo $key->city_name;?></option>
													<?php }
												}?>													
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Pin Code
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="company_pincode" id="company_pincode" maxlength="6" tabindex="" value="<?php echo (isset($singleCompany->company_pincode) && !empty($singleCompany->company_pincode))?$singleCompany->company_pincode:''?>">
											</div>
										</div>
									</div>
									<!--/span-->
								</div>
								<h3 class="form-section">Company Login Details</h3>

								<div class="row">										
									<!--/span-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Login Id
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="company_login" id="company_login"   tabindex="" value="<?php echo (isset($singleCompany->company_login) && !empty($singleCompany->company_login))?$singleCompany->company_login:''?>">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Password
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="company_password" id="company_password" value="123456" tabindex="">
											</div>
										</div>
									</div>
									
								</div>
							</div>

							<div class="form-actions">
								<center>
									<button type="submit" class="btn green companySave" rel="<?php echo (isset($singleCompany->company_id) && !empty($singleCompany->company_id))?$singleCompany->company_id:'0'?>">
										<?php if(isset($singleCompany->company_id) && !empty($singleCompany->company_id))
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

		<div id="companyDetailsDiv">
			<?php $this->load->view('company_creation_table');?>	
		</div>		
	</div>
</div>
<!-- END CONTENT -->

	
	
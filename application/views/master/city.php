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
						<a href="javascript:void(0);">City</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN MAIN ROW CONTENT-->
		<div class="row">
			<div class="col-md-12 ">
				<!-- BEGIN SAMPLE FORM PORTLET-->
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Add City
						</div>
					</div>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->						
						<form action="save_city" data-tbdiv="#cityDetailsDiv" data-tburl="fetch_city" id="city_form" class="form-horizontal" method="post">
							<div class="form-body">

							<!-- 	<?php /*if($this->session->userdata('comp_id') == 1){ ?>
								<div class="row">
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
															<option value="<?php echo $key->company_id?>" <?php echo (isset($singleCity->company_id) && !empty($singleCity->company_id) && ($singleCity->company_id==$key->company_id))?'selected="selected"':''?>><?php echo $key->company_name;?></option>
														<?php }
													}?>  
												</select>
												<!-- </div> -->
											</div>
										</div>
									</div>

									<div class="col-md-6">
										
									</div>
																			
								</div><?php }*/?> -->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">
												Country
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-9">
												<!-- <div class="input-icon right"> -->
													<!-- <i class="fa"></i> -->
													<select class="form-control select2me pre_country" name="city_coun_name">
														<option value="0">Select</option>
														<?php if(isset($countryData) && !empty($countryData))
														{
															foreach ($countryData as $key) 
															{?>
																<option value="<?php echo $key->country_id?>" <?php echo (isset($singleCity->country_id) && !empty($singleCity->country_id) && ($singleCity->country_id==$key->country_id))?'selected="selected"':''?>><?php echo $key->country_name;?></option>
															<?php }															
														}?>																									
													</select>
												<!-- </div> -->
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">
												State
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-9">
												<!-- <div class="input-icon right"> -->
													<!-- <i class="fa"></i> -->
													<select class="form-control select2me pre_state_html  " name="city_state_name">
														<?php if(isset($stateData) && !empty($stateData))
														{
															foreach ($stateData as $key) 
															{?>
																<option value="<?php echo $key->state_id?>" <?php echo (isset($singleCity->state_id) && !empty($singleCity->state_id) && ($singleCity->state_id==$key->state_id))?'selected="selected"':''?>><?php echo $key->state_name;?></option>
															<?php }
														}?>																										
													</select>
												<!-- </div> -->
											</div>
										</div>
									</div>
																			
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">
												City Name
												<span class="required">* </span>
											</label>
											<div class="col-md-9">
												<div class="input-icon right">
													<i class="fa"></i>													
													<input type="text" class="form-control" name="city_name" placeholder="" value="<?php echo (isset($singleCity->city_name) && !empty($singleCity->city_name))?$singleCity->city_name:''?>">
												</div>
											</div>
										</div>
									</div>	

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">
												Description												
											</label>
											<div class="col-md-9">																										
												<input type="text" id="city_description" name="city_description" class="form-control" value="<?php echo (isset($singleCity->city_desc) && !empty($singleCity->city_desc))?$singleCity->city_desc:''?>"/>
											</div>
										</div>
									</div>																				
								</div>																
							</div>

							<div class="form-actions">
								<center>
									<button type="submit" class="btn green common_save" rel="<?php echo (isset($singleCity->city_id) && !empty($singleCity->city_id))?$singleCity->city_id:'0'?>">
										<?php if(isset($singleCity->city_id) && !empty($singleCity->city_id))
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
				<!-- END SAMPLE FORM PORTLET-->
			</div>
		</div>
		<!-- END MAIN ROW -->

		<div id="cityDetailsDiv">
			<?php $this->load->view('master/city_table');?>
		</div>
		
	</div>
</div>
<!-- END CONTENT -->	
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
						<a href="javascript:void(0);">Country</a>
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
							<i class="fa fa-gift"></i>Add Country
						</div>							
					</div>
					<div class="portlet-body form">
						<?php //print_r($singleCountry);?>
						<!-- BEGIN FORM-->
						<form action="save_country" data-tbdiv="#countryDetailsDiv" data-tburl="fetch_country" id="country_form" class="form-horizontal" method="post">
							<div class="form-body">
								<!-- <div class="alert alert-danger display-hide">
									<button class="close" data-close="alert"></button>
									You have some form errors. Please check below.
								</div>
								<div class="alert alert-success display-hide">
									<button class="close" data-close="alert"></button>
									Your form validation is successful!
								</div> -->
								

								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<label class="control-label col-md-3 right">
												Country Name 
												<span class="required">*</span>
											</label>
											<div class="col-md-9">
												<div class="input-icon right">
													<i class="fa"></i>
													<input type="text" class="form-control" name="country_name" value="<?php echo (isset($singleCountry->country_name) && !empty($singleCountry->country_name))?$singleCountry->country_name:''?>" />
												</div>
											</div>
										</div> 
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label right col-md-3">Description 
											</label>
											<div class="col-md-9">
												<div class="input-icon right">
													<i class="fa"></i>
													<input type="text" class="form-control" name="country_desc" value="<?php echo (isset($singleCountry->country_desc) && !empty($singleCountry->country_desc))?$singleCountry->country_desc:''?>"/>
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

		<div id="countryDetailsDiv">
			<?php $this->load->view('master/country_table');?>	
		</div>		
	</div>
</div>
	<!-- END CONTENT -->

	
	
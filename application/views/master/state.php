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
						<a href="javascript:void(0);">State</a>
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
							<i class="fa fa-gift"></i>Add State
						</div>
					</div>
					<?php // print_r($singleState);?>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->						
						<form action="save_state" data-tbdiv="#stateDetailsDiv" data-tburl="fetch_state" id="state_form" class="form-horizontal" method="post">
							<div class="form-body">
								
							

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
													<select class="form-control select2me pre_country" name="state_coun_name">
														<option value="">Select</option>
														<?php if(isset($countryData) && !empty($countryData))
														{
															foreach ($countryData as $key) 
															{?>
																<option value="<?php echo $key->country_id?>" <?php echo (isset($singleState->country_id) && !empty($singleState->country_id) && ($singleState->country_id==$key->country_id))?'selected="selected"':''?>><?php echo $key->country_name;?></option>
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
												State Name
												<span class="required">* </span>
											</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<i class="fa"></i>													
													<input type="text" class="form-control only_text" name="state_name" placeholder="State name" value="<?php echo (isset($singleState->state_name) && !empty($singleState->state_name))?$singleState->state_name:''?>">
												</div>
											</div>
										</div>
									</div>											
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">
												Description
												
											</label>
											<div class="col-md-9">
												<div class="input-icon right"> 
													
												<input type="text" id="state_description" name="state_description" class="form-control" value="<?php echo (isset($singleState->state_desc) && !empty($singleState->state_desc))?$singleState->state_desc:''?>"/>
											</div> 
											</div>
										</div>
									</div>
																						
								</div>

							<div class="form-actions">
								<center>
									<button type="submit" class="btn green common_save" rel="<?php echo (isset($singleState->state_id) && !empty($singleState->state_id))?$singleState->state_id:'0'?>">
										<?php if(isset($singleState->state_id) && !empty($singleState->state_id))
										{
											echo 'Update';
										}
										else
										{
											echo 'Submit';
										}?>
									</button>
									<button type="reset" class="btn red clearData">Clear</button>
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

		<div id="stateDetailsDiv">
			<?php $this->load->view('master/state_table');?>
		</div>
		
	</div>
</div>
<!-- END CONTENT -->

	
	
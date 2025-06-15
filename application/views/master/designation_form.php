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
						<a href="javascript:void(0);">Designation</a>
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
							<i class="fa fa-gift"></i>Add Designation
						</div>							
					</div>
					<div class="portlet-body form">
						<?php //print_r($singleCountry);?>
						<!-- BEGIN FORM-->
						<form action="save_desig" data-tbdiv="#designationDetailsDiv" data-tburl="fetch_desig" id="designation_form" class="form-horizontal" method="post">
							<div class="form-body">								
								
								<?php if($this->session->userdata('comp_id') == 1){ ?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Company 
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="col-md-8">
												<!-- <div class="input-icon right"> -->
													<!-- <i class="fa"></i> -->
													<select class="form-control select2me" name="comp_id" id="companyName">
													<option value="">Select</option>
													<?php if(isset($compDetails) && !empty($compDetails))
													{
														foreach ($compDetails as $key) 
														{?>
															<option value="<?php echo $key->company_id?>" <?php echo (isset($singleDesig->company_id) && !empty($singleDesig->company_id) && ($singleDesig->company_id==$key->company_id))?'selected="selected"':''?>><?php echo $key->company_name;?></option>
														<?php }
													}?>  
												</select>
												<!-- </div> -->
											</div>
										</div>
									</div>

									<div class="col-md-6">
										
									</div>
																			
								</div><?php }?>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Name 
												<span class="required">*</span>
											</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<i class="fa"></i>
													<input type="text" class="form-control" name="desig_name" value="<?php echo (isset($singleDesig->desig_name) && !empty($singleDesig->desig_name))?$singleDesig->desig_name:''?>" />
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">Description 
											</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<i class="fa"></i>
													<input type="text" class="form-control" name="desig_desc" value="<?php echo (isset($singleDesig->desig_desc) && !empty($singleDesig->desig_desc))?$singleDesig->desig_desc:''?>"/>
												</div>
											</div>
										</div>											
									</div>
								</div>
							</div>

							<div class="form-actions">
								<center>
									<button type="submit" class="btn green common_save" rel="<?php echo (isset($singleDesig->desig_id) && !empty($singleDesig->desig_id))?$singleDesig->desig_id:''?>">
										<?php if(isset($singleDesig->desig_id) && !empty($singleDesig->desig_id))
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

		<div id="designationDetailsDiv">
			<?php $this->load->view('master/designation_table');?>	
		</div>		
	</div>
</div>
	<!-- END CONTENT -->

	
	
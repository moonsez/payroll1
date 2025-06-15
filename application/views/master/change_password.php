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
						<a href="javascript:void(0);">Change Password Master</a>
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
							<i class="fa fa-gift"></i>Change Password Detail
						</div>
					</div>
					
					<div class="portlet-body form">
						<!-- BEGIN FORM vishal -->						
						<form action="change_pwd" id="change_form" class="form-horizontal" method="post">
							<div class="form-body">
								
								<?php if($this->session->userdata('role_id') == 1){ ?>
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
																			
								</div><?php }?>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
											<?php if($this->session->userdata('role_id') == 1){ ?>	Admin password <?php }else{?> Old PassWord <?php } ?>
												<span class="required">* </span>
											</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<i class="fa"></i>													
													<input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="" value="<?php echo (isset($singleEarning->earning_name) && !empty($singleEarning->earning_name))?$singleEarning->earning_name:''?>">
												</div>
											</div>
										</div>
									</div>
									</div>	
									<div>
									<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												New Password		
												<span class="required">* </span>										
											</label>
											<div class="col-md-8">	
											 	<div class="input-icon right">
													<i class="fa"></i>																									
												<input type="password" name="new_password" id="new_password" class="form-control" value="<?php echo (isset($singleEarning->earning_code) && !empty($singleEarning->earning_code))?$singleEarning->earning_code:''?>"/>
												</div>
											</div>
										</div>
									</div>	
									</div>	
									</div>									
								
								
								<div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Confirm Password	
												<span class="required">* </span>											
											</label>
											<div class="col-md-8 input-icon right" >	
												<div class="input-icon right">
													<i class="fa"></i>																								
												<input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?php echo (isset($singleEarning->earning_default_value) && !empty($singleEarning->earning_default_value))?$singleEarning->earning_default_value:''?>"/>
												</div>
											</div>
										</div>
									</div>																				
								</div>																
							</div>

							<div class="form-actions">
								<center>
									<input type="submit" class="btn green changePass" value="Change"  rel="changePass" >
										
									
									<button type="reset" class="btn red">Clear</button>
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

		<!--<div id="earningDetailsDiv">
			<?php /*$this->load->view('master/earning_allowance_table');*/?>
		</div>
		
	</div>
</div>


	
	
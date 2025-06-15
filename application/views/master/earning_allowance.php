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
						<a href="#">Master Form</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Allowance Master</a>
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
							<i class="fa fa-gift"></i>Allowance Detail
						</div>
					</div>
					<?php //print_r($singleState);?>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->						
						<form action="save_earning_allowance" data-tbdiv="#earningDetailsDiv" data-tburl="fetch_earning_allowance" id="earning_form" class="form-horizontal" method="post">
							<div class="form-body">


								<?php if($this->session->userdata('comp_id') == 1){ ?>
								<div class="row">
									<div class="col-md-6">
										<input type="hidden"  class="form-control" name="comp_id" placeholder="Earning name" value="<?php echo (isset($singleEarning->earning_name) && !empty($singleEarning->earning_name))?$this->session->userdata('comp_id'):'1'?>">
									</div>

									
																			
								</div><?php }?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Earning Name
												<span class="required">* </span>
											</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<i class="fa"></i>													
													<input type="text" class="form-control" name="earning_name" placeholder="Earning name" value="<?php echo (isset($singleEarning->earning_name) && !empty($singleEarning->earning_name))?$singleEarning->earning_name:''?>">
												</div>
											</div>
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Earning Short Name													
											</label>
											<div class="col-md-8">																										
												<input type="text"  name="earning_code" class="form-control" value="<?php echo (isset($singleEarning->earning_code) && !empty($singleEarning->earning_code))?$singleEarning->earning_code:''?>"/>
											</div>
										</div>
									</div>		
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Earning Unit	
												<span class="required">* </span>										
											</label>
											<div class="col-md-8">
												<div class="">
												 	<i class=""></i>	
													<select name="unit" class="form-control select2me" id="earning_unit" selected="selected">
														<option value="" >Select</option>
														<option value="percent" <?php echo (isset($singleEarning->earning_unit) && !empty($singleEarning->earning_unit) &&($singleEarning->earning_unit=='percent'))?'selected="selected"':''?>> % </option>
														<option  value="rupees" <?php echo (isset($singleEarning->earning_unit) && !empty($singleEarning->earning_unit) &&($singleEarning->earning_unit=='rupees'))?'selected="selected"':''?>>&#8377</option>
													</select>
												</div>																									
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Default Value	
												<span class="required">* </span>											
											</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<i class="fa"></i>	
													<input type="text" id="earning_default_value" name="earning_default_value" class="form-control txtpaymentamnt" value="<?php echo (isset($singleEarning->earning_default_value) && !empty($singleEarning->earning_default_value))?$singleEarning->earning_default_value:''?>"/>
												</div>
											</div>
										</div>
									</div>	
								</div>


								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Calculate	
												<span class="required">* </span>										
											</label>
											<div class="col-md-8">
												<div class="">
												 	<i class=""></i>	
													<select name="calculate" class="form-control select2me" id="calculate" selected="selected">
														<option value="" >Select</option>
														<option value="0" <?php echo (isset($singleEarning->calculate) && !empty($singleEarning->calculate) &&($singleEarning->calculate=='1'))?'selected="selected"':''?>> Yes </option>
														<option  value="1" <?php echo (isset($singleEarning->calculate) && !empty($singleEarning->calculate) &&($singleEarning->calculate=='1'))?'selected="selected"':''?>>No</option>
													</select>
												</div>																									
											</div>
										</div>
									</div>
								</div>


							</div>

							<div class="form-actions">
								<center>
									<button type="submit" class="btn green common_save" rel="<?php echo (isset($singleEarning->earning_id) && !empty($singleEarning->earning_id))?$singleEarning->earning_id:'0'?>">
										<?php if(isset($singleEarning->earning_id) && !empty($singleEarning->earning_id))
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

		<div id="earningDetailsDiv">
			<?php $this->load->view('master/earning_allowance_table');?>
		</div>
		
	</div>
</div>
<!-- END CONTENT -->

	
	
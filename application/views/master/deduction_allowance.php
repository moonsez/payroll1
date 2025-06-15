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
						<a href="javascript:void(0);">Allowance Master</a>
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
							<i class="fa fa-gift"></i>Deduction Allowance Detail
						</div>
					</div>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->						
						<form action="save_deduction_allowance" data-tbdiv="#deductionDetailsDiv" data-tburl="fetch_deduction_allowance" id="state_form" class="form-horizontal" method="post">
							<div class="form-body">
								<?php if($this->session->userdata('comp_id') == 1){ ?>
								<div class="row">
									<div class="col-md-6">
										<input type="hidden" class="form-control" name="comp_id" placeholder="Earning name" value="<?php echo (isset($singleEarning->earning_name) && !empty($singleEarning->earning_name))?$this->session->userdata('comp_id'):'1'?>">
									</div>
								</div>
								<?php }?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Deduction Name
												<span class="required">* </span>
											</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<i class="fa"></i>												
													<input type="text" class="form-control" name="deduction_name" placeholder="deduction name" value="<?php echo (isset($singleDeduction->deduction_name) && !empty($singleDeduction->deduction_name))?$singleDeduction->deduction_name:''?>">
												</div>
											</div>
										</div>
									</div>	

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												Deduction Short Name												
											</label>
											<div class="col-md-8">																										
												<input type="text"  name="deduction_code" class="form-control" value="<?php echo (isset($singleDeduction->deduction_code) && !empty($singleDeduction->deduction_code))?$singleDeduction->deduction_code:''?>"/>
											</div>
										</div>
									</div>												
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4">
												deduction Unit	
												<span class="required">* </span>										
											</label>
											<div class="col-md-8">
												<div class="">
												 	<i class=""></i>	
													<select name="deduction_unit" class="form-control select2me" id="deduction_unit"  selected="selected">
														<option value="" >Select</option>
														<option value="percent" <?php echo (isset($singleDeduction->deduction_unit) && !empty($singleDeduction->deduction_unit) &&($singleDeduction->deduction_unit=='percent'))?'selected="selected"':''?>> % </option>
														<option  value="rupees" <?php echo (isset($singleDeduction->deduction_unit) && !empty($singleDeduction->deduction_unit) &&($singleDeduction->deduction_unit=='rupees'))?'selected="selected"':''?> >&#8377</option>
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
													<input type="text" id="deduction_default_value" name="deduction_default_value" class="form-control txtpaymentamnt" value="<?php echo (isset($singleDeduction->deduction_default_value) && !empty($singleDeduction->deduction_default_value))?$singleDeduction->deduction_default_value:''?>"/>
												</div>
											</div>
										</div>
									</div>	
								</div>

								<div class="form-actions">
									<center>
										<button type="submit" class="btn green common_save" rel="<?php echo (isset($singleDeduction->deduction_id) && !empty($singleDeduction->deduction_id))?$singleDeduction->deduction_id:'0'?>">
											<?php if(isset($singleDeduction->deduction_id) && !empty($singleDeduction->deduction_id))
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
							</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>
				<!-- END SAMPLE FORM PORTLET-->
			</div>
		</div>
		<!-- END MAIN ROW -->

		<div id="deductionDetailsDiv">
			<?php $this->load->view('master/deduction_allowance_table');?>
		</div>
		
	</div>
</div>
<!-- END CONTENT -->

	
	
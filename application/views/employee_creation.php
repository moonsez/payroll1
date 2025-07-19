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
						<a href="<?php echo base_url(); ?>dashboard">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);">Employee Creation Form</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);">Employee</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN FORM-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Add Employee
						</div>
					</div>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="save_employee" data-tbdiv="#employeeDetailsDiv" data-tburl="fetch_data"
							id="employee_form" class="horizontal-form" method="post">
							<div class="form-body">
								<h3 class="form-section">Employee Personal Details</h3>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Company
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me pre_company" id="comyid"
												name="comp_id">
												<option value="">Select</option>
												<?php if (isset($compDetails) && !empty($compDetails)) {
													foreach ($compDetails as $key) { ?>
														<option value="<?php echo $key->company_id; ?>" <?php echo (isset($singleEmployee->company_id) && !empty($singleEmployee->company_id) && ($singleEmployee->company_id == $key->company_id)) ? 'selected="selected"' : '' ?>>
															<?php echo $key->company_name; ?>
														</option>
													<?php }
												} ?>
											</select>
										</div>
									</div>
									<div class="col-md-6"></div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Employee Name
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me pre_comp_html getempData"
												name="employee_name" id="slip_emp_name">
												<?php if (isset($singleEmployee->emp_name) && !empty($singleEmployee->emp_name)) { ?>
													<option value="<?php echo $singleEmployee->emp_name; ?>">
														<?php echo $singleEmployee->emp_name; ?>
													</option>
												<?php /* if(isset($alluser) && !empty($alluser))
																											  {
																												  foreach ($alluser as $key) 
																												  {?>
																													  <option value="<?php echo $key->emp_name;?>"<?php echo (isset($singleEmployee->emp_name) && !empty($singleEmployee->emp_name) && ($singleEmployee->emp_name==$key->emp_name))?'selected="selected"':''?>><?php echo $key->emp_name;?></option>
																												  <?php }
																											  } */
												} ?>
											</select>
										</div>
									</div>
									<div class="col-md-6 hide">
										<div class="form-group">
											<label class="control-label">
												Employee id
												<span class="" aria-required="">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" readonly id="employee_id" name="employee_id"
													class="form-control" placeholder="" tabindex=""
													value="<?php echo (isset($singleEmployee->employee_id) && !empty($singleEmployee->employee_id)) ? $singleEmployee->employee_id : 'NA' ?>">
												<input type="hidden" readonly id="user_id" name="user_id"
													class="form-control" placeholder="" tabindex=""
													value="<?php echo (isset($singleEmployee->user_id) && !empty($singleEmployee->user_id)) ? $singleEmployee->user_id : '' ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row hide">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Designation<span class="">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" readonly id="desig_id" name="desig_id"
													class="form-control" placeholder="" tabindex=""
													value="<?php echo (isset($singleEmployee->desig_id) && !empty($singleEmployee->desig_id)) ? $singleEmployee->desig_id : 'NA' ?>">
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label">
												Location
												<span class="">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="location" id="location"
													tabindex=""
													value="<?php echo (isset($singleEmployee->emp_loc) && !empty($singleEmployee->emp_loc)) ? $singleEmployee->emp_loc : 'NA' ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label">
												Local Address
												<span class="required">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="local_address"
													id="local_address" tabindex=""
													value="<?php echo (isset($singleEmployee->local_address) && !empty($singleEmployee->local_address)) ? $singleEmployee->local_address : '' ?>">
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label">
												Permanent Address
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="permanent_address"
													id="permanent_address" tabindex=""
													value="<?php echo (isset($singleEmployee->permanent_address) && !empty($singleEmployee->permanent_address)) ? $singleEmployee->permanent_address : '' ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label">
												Bank Name.
												<span class="required">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control only_text" name="bank_name"
													id="bank_name" tabindex=""
													value="<?php echo (isset($singleEmployee->bank_name) && !empty($singleEmployee->bank_name)) ? $singleEmployee->bank_name : '' ?>">
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label">
												Bank A/c No.
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="bank_acc_no"
													id="bank_acc_no" minlength="8" tabindex=""
													value="<?php echo (isset($singleEmployee->bank_acc_no) && !empty($singleEmployee->bank_acc_no)) ? $singleEmployee->bank_acc_no : '' ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label">
												Branch Name.
												<span class="required">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control only_text" name="branch_name"
													id="branch_name" tabindex=""
													value="<?php echo (isset($singleEmployee->bank_branch) && !empty($singleEmployee->bank_branch)) ? $singleEmployee->bank_branch : '' ?>">
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label">
												Bank IFSC Code.
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="bank_ifc_code"
													id="bank_ifc_code" minlength="8" tabindex=""
													value="<?php echo (isset($singleEmployee->bank_ifc_code) && !empty($singleEmployee->bank_ifc_code)) ? $singleEmployee->bank_ifc_code : '' ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Select Bank Type
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me" name="emp_ac_type" id="emp_ac_type">
												<option value="OBC" <?php echo (isset($singleEmployee->emp_ac_type) && !empty($singleEmployee->emp_ac_type) && ($singleEmployee->emp_ac_type == 'OBC')) ? 'selected="selected"' : ''; ?>>
													OBC</option>
												<option value="OTOBC" <?php echo (isset($singleEmployee->emp_ac_type) && !empty($singleEmployee->emp_ac_type) && ($singleEmployee->emp_ac_type == 'OTOBC')) ? 'selected="selected"' : ''; ?>>
													Other than OBC</option>
											</select>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label">
												Pan no.
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="pan_no" id="pan_no"
													tabindex=""
													value="<?php echo (isset($singleEmployee->emp_pan_num) && !empty($singleEmployee->emp_pan_num)) ? $singleEmployee->emp_pan_num : '' ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Gender
												<span class="required">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" id="gender" name="gender"
													value="<?php echo (isset($singleEmployee->gender) && !empty($singleEmployee->gender)) ? $singleEmployee->gender : '' ?>"
													readonly="readonly">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Date of Birth
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control birth_datepicker"
													id="date_of_birth" name="date_of_birth"
													value="<?php echo (isset($singleEmployee->date_of_birth) && !empty($singleEmployee->date_of_birth)) ? date('d-m-Y', strtotime($singleEmployee->date_of_birth)) : '' ?>"
													readonly="readonly">
											</div>
										</div>
									</div>
									<!--/span-->
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Date of Joining
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" readonly class="form-control datepicker"
													id="date_of_joining" name="date_of_joining"
													value="<?php echo (isset($singleEmployee->date_of_joining) && !empty($singleEmployee->date_of_joining)) ? date('d-m-Y', strtotime($singleEmployee->date_of_joining)) : '' ?>"
													readonly="readonly">
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label">
												Email Address
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="email_id" id="email_id"
													value="<?php echo (isset($singleEmployee->email_id) && !empty($singleEmployee->email_id)) ? $singleEmployee->email_id : '' ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												PF Account Number
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="pf_acc_no" id="pf_acc_no"
													value="<?php echo (isset($singleEmployee->pf_acc_no) && !empty($singleEmployee->pf_acc_no)) ? $singleEmployee->pf_acc_no : '' ?>">
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label">
												ESI Account Number
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control" name="esi_acc_no"
													id="esi_acc_no"
													value="<?php echo (isset($singleEmployee->esi_acc_no) && !empty($singleEmployee->esi_acc_no)) ? $singleEmployee->esi_acc_no : '' ?>">
											</div>
										</div>
									</div>
								</div>
								<h3 class="form-section">Salary Info</h3>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Basic
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control only_number " name="basic"
													id="basic" tabindex=""
													value="<?php echo (isset($singleEmployee->emp_basic) && !empty($singleEmployee->emp_basic)) ? $singleEmployee->emp_basic : '' ?>">
											</div>
										</div>
									</div>
									<!-- <div class="col-md-3">
										<div class="form-group">
											<label class="control-label">
												Fixed Percentage(%)
												<span class="required" aria-required="true">*</span>
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control only_number " name="fixed_per"
													id="fixed_per" tabindex=""
													value="<?php echo (isset($singleEmployee->fixed_per) && !empty($singleEmployee->fixed_per)) ? $singleEmployee->fixed_per : '' ?>">
											</div>
										</div>
									</div> -->
									<!-- <div class="col-md-3">
										<div class="form-group">
											<label class="control-label">
												Variable amount per month
												
											</label>
											<div class="input-icon right">
												<i class="fa"></i>
												<input type="text" class="form-control only_number " name="var_per"
													id="var_per" tabindex=""
													value="<?php echo (isset($singleEmployee->var_per) && !empty($singleEmployee->var_per)) ? $singleEmployee->var_per : '' ?>">
											</div>
										</div>
									</div> -->
								</div>
								<div class="row">
									<?php if (isset($earning_allow) && !empty($earning_allow)) { ?>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<b>Earning Allowance</b>
												</label>
												<?php $type = '';
												$amt = 0;
												$i = 1;
												$earn_output = array();
												foreach ($earning_allow as $key) {

													if (isset($earning_data) && !empty($earning_data)) {
														foreach ($earning_data as $row) {
															// echo '<pre>';print_r($row);
															if ($row->earning_id == $key->earning_id) {
																if (!in_array($row->earning_id, $earn_output)) {
																	$earn_output[] = $row->earning_id; ?>
																	<div class="checkbox-list">
																		<div class="form-group">
																			<div class="row" id="earning_allowance<?php echo $i++; ?>">
																				<div class="col-md-7">
																					<label class="control-label">
																						<input type="checkbox" name="earning_allowance[]"
																							class="earning_checkbox"
																							value="<?php echo (isset($key->earning_id) && !empty($key->earning_id)) ? $key->earning_id : ''; ?>"
																							checked="checked">
																						<?php echo (isset($key->earning_name) && !empty($key->earning_name)) ? $key->earning_name : ''; ?>
																					</label>
																				</div>
																				<?php if ($row->earning_id == 15) {
																					 
																					// echo '<pre>';print_r($row->bonus_type);
																					if(empty($row->bonus_type)){
																						// echo "111";
																						?>
																						
																						<div class="controls">
																						<label><input type="radio" class="useriprestriction_wizard"
																								name="bonus_type" value="montly" checked/>
																								Montly</label>
																						
																						<label><input type="radio" class="useriprestriction_wizard"
																								value="yearly" name="bonus_type" />
																								Yearly</label>
																					</div>
																						<?php
																					}elseif (isset($row->bonus_type) && !empty($row->bonus_type)) {
																						// echo "1234";
																						?>
																						<div class="controls">
																						<label><input type="radio" class="useriprestriction_wizard"
																								name="bonus_type" value="montly" <?php echo (isset($row->bonus_type) && !empty($row->bonus_type) && $row->bonus_type == 'montly') ? 'checked="checked"' : ''; ?> />
																								Montly</label>
																						
																						<label><input type="radio" class="useriprestriction_wizard"
																								value="yearly" name="bonus_type" <?php echo (isset($row->bonus_type) && !empty($row->bonus_type) && $row->bonus_type == 'yearly') ? 'checked="checked"' : ''; ?> />
																								Yearly</label>
																					</div>
																						
																						<?php
																					}
																					?>
																					
																					<!-- <div class="col-md-7">
																						<input type="radio" $mon name="" value=''
																							id="">
																						<input type="radio" $yer name="bonus_type" value=''
																							id="">
																					</div> -->
																					<?php
																				} ?>
																				<div class="col-md-5 input_percent">
																					<div class="input-group earning_allowance_input">
																						<?php if (isset($key->earning_unit) && !empty($key->earning_unit)) {
																							if ($key->earning_unit == 'rupees') { ?>
																								<span class="input-group-addon">
																									<i class="fa fa-inr"></i>
																								</span>
																								<input type="text" class="form-control txtpaymentamnt"
																									name="earn_allowance_input[]" id="" tabindex=""
																									value="<?php echo (isset($row->earn_value) && !empty($row->earn_value)) ? $row->earn_value : ''; ?>">
																							<?php } else { ?>
																								<input type="text" class="form-control txtpaymentamnt"
																									name="earn_allowance_input[]" id="" tabindex=""
																									value="<?php echo (isset($row->earn_value) && !empty($row->earn_value)) ? $row->earn_value : ''; ?>">
																								<span class="input-group-addon">%</span>
																							<?php }
																						} ?>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																<?php }
															}
														}

														if (!in_array($key->earning_id, $earn_output)) { ?>
															<div class="checkbox-list">
																<div class="form-group">
																	<div class="row" id="earning_allowance<?php echo $i++; ?>">
																		<div class="col-md-7">
																			<label class="control-label">
																				<input type="checkbox" name="earning_allowance[]"
																					class="earning_checkbox txtpaymentamnt"
																					value="<?php echo (isset($key->earning_id) && !empty($key->earning_id)) ? $key->earning_id : ''; ?>">
																				<?php echo (isset($key->earning_name) && !empty($key->earning_name)) ? $key->earning_name : ''; ?>
																			</label>
																		</div>

																		<div class="col-md-5 input_percent">
																			<div
																				class="input-group display-hide earning_allowance_input">
																				<input type="text" class="form-control txtpaymentamnt"
																					name="" id="" tabindex=""
																					value="<?php echo (isset($key->earning_default_value) && !empty($key->earning_default_value)) ? $key->earning_default_value : ''; ?>">
																				<?php if (isset($key->earning_unit) && !empty($key->earning_unit)) {
																					if ($key->earning_unit == 'rupees') { ?>
																						<span class="input-group-addon">
																							<i class="fa fa-inr"></i>
																						</span>
																					<?php } else { ?>
																						<span class="input-group-addon">
																							%
																						</span>
																					<?php }
																				} ?>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php }
													} else { ?>
														<div class="checkbox-list">
															<div class="form-group">
																<div class="row" id="earning_allowance<?php echo $i++; ?>">
																	<div class="col-md-7">
																		<label class="control-label">
																			<input type="checkbox" name="earning_allowance[]"
																				class="earning_checkbox"
																				value="<?php echo (isset($key->earning_id) && !empty($key->earning_id)) ? $key->earning_id : ''; ?>">
																			<?php echo (isset($key->earning_name) && !empty($key->earning_name)) ? $key->earning_name : ''; ?>
																		</label>
																	</div>
																	<?php if ($key->earning_id == 15) {
																		?>
																		<div class="controls">
																						<label><input type="radio" class="useriprestriction_wizard"
																								name="bonus_type" value="montly" checked/>
																								Montly</label>
																						
																						<label><input type="radio" class="useriprestriction_wizard"
																								value="yearly" name="bonus_type" />
																								Yearly</label>
																					</div>
																		<?php
																	} ?>
																	<div class="col-md-5 input_percent">
																		<div
																			class="input-group display-hide earning_allowance_input">
																			<?php if (isset($key->earning_unit) && !empty($key->earning_unit)) {
																				if ($key->earning_unit == 'rupees') { ?>
																					<span class="input-group-addon">
																						<i class="fa fa-inr"></i>
																					</span>
																					<input type="text" class="form-control txtpaymentamnt"
																						name="earning_allowance_input[]" id="" tabindex=""
																						value="<?php echo (isset($key->earning_default_value) && !empty($key->earning_default_value)) ? $key->earning_default_value : ''; ?>">
																				<?php } else { ?>
																					<input type="text" class="form-control txtpaymentamnt"
																						name="earning_allowance_input[]" id="" tabindex=""
																						value="<?php echo (isset($key->earning_default_value) && !empty($key->earning_default_value)) ? $key->earning_default_value : ''; ?>">
																					<span class="input-group-addon">
																						%
																					</span>
																				<?php }
																			} ?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													<?php } ?>
												<?php } ?>
											</div>
										</div>
									<?php } ?>

									<?php 
									 
									if (isset($deduction_allow) && !empty($deduction_allow)) { ?>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<b>Deduction Allowance</b>
												</label>
												<?php $j = 1;
												$deduct_output = array();
												foreach ($deduction_allow as $key) {
													// echo '<pre>';
													// print_r();
													// if(){
													// 	echo "de";exit;
													// }
													// echo '<pre>';print_r($deduction_data);
													if (isset($deduction_data) && !empty($deduction_data)) {
														// echo "123";
														foreach ($deduction_data as $row) {
															if ($row->deduction_id == $key->deduction_id) {
																if (!in_array($row->deduction_id, $deduct_output)) {
																	$deduct_output[] = $row->deduction_id; ?>
																	<div class="checkbox-list">
																		<div class="form-group">
																			<div class="row" id="deduction_allowance<?php echo $j++; ?>">
																				<div class="col-md-7">
																					<label class="control-label">
																						<input type="checkbox" name="deduction_allowance[]"
																							class="deduction_checkbox "
																							value="<?php echo (isset($key->deduction_id) && !empty($key->deduction_id)) ? $key->deduction_id : ''; ?>"
																							<?php echo (isset($row->deduction_id) && !empty($row->deduction_id) && ($row->deduction_id == $key->deduction_id)) ? 'checked="checked"' : ''; ?>>
																						<?php echo (isset($key->deduction_name) && !empty($key->deduction_name)) ? $key->deduction_name : ''; ?>
																					</label>
																				</div>
																				<div class="col-md-5 input_percent">
																					<div class="input-group deduction_allowance_input">
																						<?php if (isset($key->deduction_unit) && !empty($key->deduction_unit)) {
																							if ($key->deduction_unit == 'rupees') { ?>
																								<span class="input-group-addon">
																									<i class="fa fa-inr"></i>
																								</span>
																							<?php } else { ?>
																								<span class="input-group-addon">
																									%
																								</span>
																							<?php }
																						} ?>
																						<input type="text"
																							class="form-control deduction_allowance txtpaymentamnt"
																							name="deduction_allowance_input[]" id="" tabindex=""
																							value="<?php echo (isset($row->deduct_value) && !empty($row->deduct_value)) ? $row->deduct_value : '0'; ?>">
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																<?php }
															}
														}

														if (!in_array($key->deduction_id, $deduct_output)) { ?>
															<div class="checkbox-list">
																<div class="form-group">
																	<div class="row" id="deduction_allowance<?php echo $j++; ?>">
																		<div class="col-md-7">
																			<label class="control-label">
																				<input type="checkbox" name="deduction_allowance[]"
																					class="deduction_checkbox"
																					value="<?php echo (isset($key->deduction_id) && !empty($key->deduction_id)) ? $key->deduction_id : ''; ?>">
																				<?php echo (isset($key->deduction_name) && !empty($key->deduction_name)) ? $key->deduction_name : ''; ?>
																			</label>
																		</div>
																		<div class="col-md-5 input_percent">
																			<div
																				class="input-group display-hide deduction_allowance_input">
																				<?php if (isset($key->deduction_unit) && !empty($key->deduction_unit)) {
																					if ($key->deduction_unit == 'rupees') { ?>
																						<span class="input-group-addon">
																							<i class="fa fa-inr"></i>
																						</span>
																					<?php } else { ?>
																						<span class="input-group-addon">
																							%
																						</span>
																					<?php }
																				} ?>
																				<input type="text"
																					class="form-control deduction_allowance txtpaymentamnt"
																					name="" id="" tabindex=""
																					value="<?php echo (isset($key->deduction_default_value) && !empty($key->deduction_default_value)) ? $key->deduction_default_value : '0'; ?>">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php }
													} else { 
														// echo "12345";
														?>
													  
														<div class="checkbox-list">
															<div class="form-group">
																<div class="row" id="deduction_allowance<?php echo $j++; ?>">
																	<div class="col-md-7">
																		<label class="control-label">
																			<input type="checkbox" name="deduction_allowance[]"
																				class="<?php echo (isset($key->deduction_id) && !empty($key->deduction_id) && ($key->deduction_id == 4)) ? '' : 'deduction_checkbox'; ?>"
																				value="<?php echo (isset($key->deduction_id) && !empty($key->deduction_id)) ? $key->deduction_id : ''; ?> "
																				<?php echo (isset($key->deduction_id) && !empty($key->deduction_id) && ($key->deduction_id == 4)) ? 'checked="checked"' : ''; ?>>
																			<?php echo (isset($key->deduction_name) && !empty($key->deduction_name)) ? $key->deduction_name : ''; ?>
																		</label>
																	</div>
																	<div class="col-md-5 input_percent">

																		<div
																			class="input-group <?php echo (isset($key->deduction_id) && !empty($key->deduction_id) && ($key->deduction_id == 4)) ? '' : 'display-hide deduction_allowance_input'; ?>">
																			<?php if (isset($key->deduction_unit) && !empty($key->deduction_unit)) {
																				if ($key->deduction_unit == 'rupees') { ?>
																					<span class="input-group-addon">
																						<i class="fa fa-inr"></i>
																					</span>
																				<?php } else { ?>
																					<span class="input-group-addon">
																						%
																					</span>
																				<?php }
																			}
																			
																			// echo $key->deduction_default_value;
																			?>
																			<input type="text"
																				class="form-control deduction_allowance txtpaymentamnt"
																				name="deduction_allowance_input" id="" tabindex=""
																				value="<?php echo (isset($key->deduction_default_value) && !empty($key->deduction_default_value)) ? $key->deduction_default_value : '0'; ?>">
																		</div>
																	</div>
																</div>
															</div>
														</div>
													<?php }
												} ?>
											</div>
										</div>
									<?php } ?>
								</div>

								<div class="form-actions">
									<center>
										<button type="submit" class="btn green common_save"
											rel="<?php echo (isset($singleEmployee->emp_id) && !empty($singleEmployee->emp_id)) ? $singleEmployee->emp_id : '' ?>">
											<?php if (isset($singleEmployee->emp_id) && !empty($singleEmployee->emp_id)) {
												echo 'Update';
											} else {
												echo 'Submit';
											} ?>
										</button>
										<button type="button" class="btn red clearData">Clear</button>
									</center>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- END VALIDATION STATES-->
		</div>
		<!-- END FORM-->
		<div id="employeeDetailsDiv">
			<?php $this->load->view('employee_creation_table'); ?>
		</div>
	</div>
</div>
<!-- END CONTENT -->
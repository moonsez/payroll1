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
						<a href="javascript:void(0);">Report</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);"></a>
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
							<i class="fa fa-gift"></i>General Report
						</div>							
					</div>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="generate_payslip_report" id="generate_payslip_report" class="horizontal-form" method="post">
							<div class="form-body">	
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Company Name
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me emp_company" name="comp_id[]" multiple>
												<option value="All">ALL</option>
												<?php if(isset($companyData) && !empty($companyData))
												{
													foreach ($companyData as $key) 
													{?>
														<option value="<?php echo $key->company_id;?>"><?php echo $key->company_name;?></option>
													<?php }
												}?>  
											</select>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Employee Name
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me company_employee emp_allowance" name="emp_id[]" multiple>
												<!-- <option value="All">ALL</option> -->
												<?php if(isset($employeeData) && !empty($employeeData))
												{
													foreach ($employeeData as $key) 
													{?>
														<option value="<?php echo $key->emp_id;?>"><?php echo $key->emp_name;?></option>
													<?php }
												}?>  
											</select>
										</div>
									</div>
								</div>						
								<div class="row">									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Earning Allowance
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me ear_allowance" name="earning_id[]" multiple>
												<option value="All">ALL</option>
												<?php if(isset($earningData) && !empty($earningData))
												{
													foreach ($earningData as $key) 
													{?>
														<option value="<?php echo $key->earning_id;?>"><?php echo $key->earning_name;?></option>
													<?php }
												}?>  
											</select>
										</div>
								 	</div>
								 	<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Deduction Allowance
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me ded_allowance" name="deduction_id[]" multiple>
												<option value="All">ALL</option>
												<?php if(isset($deductionData) && !empty($deductionData))
												{
													foreach ($deductionData as $key) 
													{?>
														<option value="<?php echo $key->deduction_id;?>"><?php echo $key->deduction_name;?></option>
													<?php }
												}?>  
											</select>
										</div>										
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Years
												<span class="required" aria-required="true">*</span>
											</label>											
											<div class="input-group date datepickerYear">
												<input type="text" class="form-control" name="slip_year" readonly>
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>										
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Months
												<span class="required" aria-required="true">*</span>
											</label>											
											<div class="input-group date datepickerGeneral">
												<input type="text" class="form-control" name="slip_month" readonly>
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>										
										</div>
									</div>
								</div>								
							</div>				
							<div class="form-actions">
								<center>
									<button type="submit" class="btn green">Export</button>
									<button type="button" class="btn red clearData">Clear</button>
								</center>
							</div>					
						</form>
					</div>
						<!-- END FORM-->
				</div>
			</div>
			<!-- END VALIDATION STATES-->
		</div>
	</div>
</div>
	<!-- END CONTENT -->
<!-- 
select year(str_to_date(`tbp`.`salary_month`,'%m-%Y')) AS `sal_year`,`tbp`.`basic_pt_id` AS `basic_pt_id`,`tbp`.`emp_id` AS `empl_id`,`tbp`.`emp_id` AS `emp_id`,`tbp`.`company_id` AS `company_id`,`tbp`.`basic_amt` AS `basic_amt`,`tbp`.`allowances` AS `allowances`,`tbp`.`special_allowance` AS `special_allowance`,`tbp`.`convey` AS `convey`,`tbp`.`hra` AS `hra`,`tbp`.`earn_arrears` AS `earn_arrears`,`tbp`.`mobile_deduction` AS `mobile_deduction`,`tbp`.`other_deduct` AS `other_deduct`,`tbp`.`pt_amt` AS `pt_amt`,`tbp`.`pf_earn` AS `pf_earn`,`tbp`.`pf_deduct` AS `pf_deduct`,`tbp`.`ESIC_earn` AS `ESIC_earn`,`tbp`.`ESIC_deduct` AS `ESIC_deduct`,`tbp`.`basic_net` AS `basic_net`,`tbp`.`sundays_in_month` AS `sundays_in_month`,`tbp`.`holidays_in_month` AS `holidays_in_month`,`tbp`.`advance_opening` AS `advance_opening`,`tbp`.`advance_Addition` AS `advance_Addition`,`tbp`.`advance_recovery` AS `advance_recovery`,`tbp`.`advance_closing_amt` AS `advance_closing_amt`,`tbp`.`work_day` AS `work_day`,`tbp`.`salary_month` AS `salary_month`,`tbp`.`net_pay` AS `net_pay`,`tbp`.`salaryslip` AS `salaryslip`,`tbp`.`display` AS `display`,`tec`.`employee_id` AS `employee_id`,`tec`.`emp_name` AS `emp_name`,`tcm`.`company_name` AS `company_name`,`tad`.`earning_id` AS `earning_id`,`teda`.`deduction_id` AS `deduction_id` from ((((`db_erp_solution_live`.`tbl_basic_pt` `tbp` left join `db_erp_solution_live`.`tbl_employee_creation` `tec` on(((`tec`.`emp_id` = `tbp`.`emp_id`) and (`tec`.`display` = 'Y')))) left join `db_erp_solution_live`.`tbl_company_master` `tcm` on(((`tbp`.`company_id` = `tcm`.`company_id`) and (`tcm`.`display` = 'Y')))) left join `db_erp_solution_live`.`tbl_emp_earn_allowance` `tad` on(((`tbp`.`emp_id` = `tad`.`emp_id`) and (`tad`.`display` = 'Y')))) left join `db_erp_solution_live`.`tbl_emp_deduct_allowance` `teda` on(((`tbp`.`emp_id` = `teda`.`emp_id`) and (`teda`.`display` = 'Y')))) where ((`tbp`.`work_day` <> '0.0') and (`tbp`.`display` = 'Y')) order by `tec`.`company_id`
 -->
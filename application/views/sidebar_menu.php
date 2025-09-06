<div class="page-sidebar-wrapper">
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<ul class="page-sidebar-menu" data-auto-scroll="false" data-auto-speed="200">
			<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
			<li class="sidebar-toggler-wrapper">
				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				<div class="sidebar-toggler">
				</div>
				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			</li>
			<?php 
				//$this->load->model("master_model");
            $userid = get_cookie('userid', TRUE);
				$user = $this->master_model->selectDetailsWhr("tbl_userinfo","user_id",$userid);
			?>
			<li class="start active ">
				<a href="<?php echo base_url();?>dashboard">
				<i class="fa fa-home"></i>
				<span class="title">Dashboard </span>
				<span class="selected"></span>
				</a>
			</li>								
			
			<li>
				<a href="javascript:;">
					<i class="fa fa-cog"></i>
					<span class="title">Master Form</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">					
					<li>
						<a href="<?php echo base_url();?>earning_allowance" class="load_page">
							<i class="fa fa fa-money"></i>
							<span class="title">
							Earning Allowance
							<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>deduction_allowance" class="load_page">
							<i class="fa fa fa-scissors"></i>
							<span class="title">
							Deduction Allowance
							<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>advance" class="load_page">
							<i class="fa fa fa-credit-card"></i>
							<span class="title">
							Add Advance
							<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>local_exp" class="load_page">
							<i class="fa fa-inr"></i>
							<span class="title">
							Local Expenses
							<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>
						</a>
					</li>
				</ul>
			</li>
			
			<li>
				<a href="<?php echo base_url();?>employee_creation" class="load_page">
					<i class="fa fa-users"></i>
					<span class="title">
						Employee Creation Form
						<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
					</span>					
				</a>
			</li>
			<?php $user_id = $this->session->userdata('userid');
			if($user->payslip_role =="Approver"){ ?>
			<li>
				<a href="<?php echo base_url();?>approve_salary_str" class="load_page">
					<i class="fa fa-check"></i>
					<span class="title">
						Approve Salary Structure
						<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
					</span>					
				</a>
			</li>
			<?php } ?>
			<li>
				<a href="<?php echo base_url();?>basic_salary" class="load_page">
					<i class="fa fa-inr"></i>
					<span class="title">
						Basic Salary 
						<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
					</span>					
				</a>
			</li>

			<?php // if($user->payslip_role =="Approver"){ ?>
			<li>
				<a href="<?php echo base_url();?>expenditureReport" class="load_page">
					<i class="fa fa-file-text"></i>
					<span class="title">
						Approve Expenditure Report
						<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
					</span>					
				</a>
			</li>
			<?php  //dd} ?>

			<li>
				<a href="<?php echo base_url();?>basic_salary_bonus" class="load_page">
					<i class="fa fa-inr"></i>
					<span class="title">
						Variable Bonus 
						<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
					</span>					
				</a>
			</li>

			<li>
				<a href="<?php echo base_url();?>bonusReport" class="load_page">
					<i class="fa fa-file-text"></i>
					<span class="title">
						Variable Bonus Report
						<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
					</span>					
				</a>
			</li>
			


			<?php if($user->payslip_role =="Checker" || $user->payslip_role =="Maker"){ ?>
			<li>
				<a href="javascript:;">
					<i class="fa fa-file-excel-o"></i>
					<span class="title">Report</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="<?php echo base_url();?>expenditureReport" class="load_page">
							<span class="title">
								Expenditure Report
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>					
						</a>
					</li>

					<li>
						<a href="<?php echo base_url();?>emp_salary_report" class="load_page">
							<span class="title">
								Employee Wise Report
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>					
						</a>
					</li>

					<!-- <li>
						<a href="<?php echo base_url();?>CompanyWiseReport" class="load_page">
							<span class="title">
								Company Wise Report
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>					
						</a>
					</li>

					<li>
						<a href="<?php echo base_url();?>payslip_report" class="load_page">
							<span class="title">
								Allowancewise Report
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>					
						</a>
					</li> -->
				</ul>
			</li>
			<?php } ?>
			<li>
				<a href="<?php echo base_url();?>salary_slip_generate" class="load_page">
					<i class="fa fa-file-text"></i>
					<span class="title">
						Pay Slip Generation
						<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
					</span>					
				</a>
			</li>
			<li>
				<a href="javascript:;">
					<i class="fa fa-thumbs-o-up"></i>
					<span class="title">Approve</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="<?php echo base_url();?>approve_salaryslip" class="load_page">
							<!-- <i class="fa fa-file-text"></i> -->
							<span class="title">
								Approve Salary Slip
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>					
						</a>
					</li>
					<!-- <li>
						<a href="<?php echo base_url();?>approve_paid_leave" class="load_page">
							<span class="title">
								Approve Paid Leave
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>					
						</a>
					</li> -->
				</ul>
			</li>

			<li>
				<a href="javascript:;">
					<i class="fa fa-cubes"></i>
					<span class="title">HR Compliance Report</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="<?php echo base_url();?>muster_wage_register" class="load_page">
							<span class="title">
								Muster Roll cum Wage Register
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>			
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>register_of_wages" class="load_page">
							<span class="title">
								Register of Wages
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>			
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>leave_wages_register" class="load_page">
							<span class="title">
								Leave with Wages Register
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>			
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>advance_register" class="load_page">
							<span class="title">
								Register of Advances
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>			
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>deduction_register" class="load_page">
							<span class="title">
								Register of Deductions
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>			
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>overtime_register" class="load_page">
							<span class="title">
								Register of Overtime
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>			
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>fines_register" class="load_page">
							<span class="title">
								Register of Fines
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>			
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>employee_register" class="load_page">
							<span class="title">
								Employee Register
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>			
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>employee_advance_report" class="load_page">
							<span class="title">
								Employee Advance Report
								<img src="<?php echo base_url();?>images/admin/ajax-loader.gif" style="float: right; display:none;" class="imgloader">
							</span>			
						</a>
					</li>
				</ul>
			</li>
		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
</div>
<!-- END SIDEBAR -->
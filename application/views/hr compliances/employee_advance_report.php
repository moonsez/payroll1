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
						<a href="javascript:void(0);">HR Compliances</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);">Employee Advance Report</a>
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
							<i class="fa fa-gift"></i>Employee Advance Report
						</div>							
					</div>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="gen_employee_advance_details" id="gen_employee_advance_details" class="horizontal-form" method="post">
							<div class="form-body">							
								<div class="row">			
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												Select Employee Name
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me" name="emp_id" >
												<option value="">Select</option>
												<?php if(isset($empData) && !empty($empData))
												{
													foreach ($empData as $key) 
													{?>
														<option value="<?php echo $key->emp_id;?>"><?php echo $key->emp_name;?></option>
													<?php }
												}?>  
											</select>
										</div>
								 	</div>								 	
								</div>								
							</div>				
							<div class="form-actions">
								<center>
									<button type="submit" class="btn green fetch_emp_details">Submit</button>
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

		<div id="employeeAdvDetailsDiv">
			<?php //$this->load->view('hr compliances/employee_advance_report_table');?>	
		</div>	
	</div>
</div>
	<!-- END CONTENT -->
<script src="<?php echo base_url();?>/js/jquery.table2excel.min.js"></script>
<script type="text/javascript">
	//TableAdvanced.init();
 	function saveAsExcel()
	{ 
       $(document).ready(function () {
    		$("#sendGrid").table2excel({
        		filename: "Employee Advance Report.xls"
    		});
		});     
 	} 
</script> 
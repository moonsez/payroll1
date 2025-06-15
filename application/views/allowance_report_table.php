<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title"> 
				<div class="caption">
					<i class="fa fa-cogs"></i>salary Details List
				</div>							
			</div>
			
			<div class="portlet-body">
				<?php if(isset($reportData) && !empty($reportData))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th>Employee Name</th>
								<th>Earning amount</th>
								<th>Deduct amount</th>
								<th>Working day</th>
								<th>Salary Amount</th>
								<th>Bank Name</th>
								<th>Branch Name</th>
								<th>Bank IFSC</th>
								<th>Bank Account No</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							
							<?php $i=1;

							foreach ($reportData as $key) 
							{?>
								<tr class="odd gradeX" style="<?php echo(empty($key->bank_acc_no))?'color:red;':'';?>">
									<td style="text-align:center;" >
										<?php echo $i++;?>
									</td>
									<td>
										<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
									</td>
									<td>
										<?php echo (isset($key->earning_amt) && !empty($key->earning_amt))?$key->earning_amt:'';?>
									</td>
									<td>
										<?php echo (isset($key->deduct_amt) && !empty($key->deduct_amt))?$key->deduct_amt:'';?>
									</td>
									
									<td style="text-align:center;">
										<?php echo (isset($key->workin_day) && !empty($key->workin_day))?$key->workin_day:'';?>


										
									</td>
									<td style="text-align:right;">
										<?php echo (isset($key->net_allowance_amt) && !empty($key->net_allowance_amt))?$key->net_allowance_amt:'';?>
									</td>
									<td style="text-align:right;">
										<?php echo (isset($key->bank_name) && !empty($key->bank_name))?$key->bank_name:'';?>
									</td>
									<td style="text-align:right;">
										<?php echo (isset($key->bank_branch) && !empty($key->bank_branch))?$key->bank_branch:'';?>
									</td>
									<td style="text-align:right;">
										<?php echo (isset($key->bank_ifc_code) && !empty($key->bank_ifc_code))?$key->bank_ifc_code:'';?>
									</td>
									
									<td style="text-align:right;">
										<?php  echo (isset($key->bank_acc_no) && !empty($key->bank_acc_no))?$key->bank_acc_no:'';?>
									</td>
									<td style="text-align:center;">																				
								
										 <span style="cursor: pointer;" class="tooltips" data-original-title="Reprint" data-placement="top">
											<!-- <a href="<?php echo base_url();?>gef/<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>/<?php echo (isset($key->pay_slip_month) && !empty($key->pay_slip_month))?$key->pay_slip_month:'';?>">
												
												<i class="fa fa-file-excel-o"></i>
											</a> -->
										</span>	
										<span>
											<!-- <a href="<?php// echo base_url();?>genPdf/<?php //echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>/<?php //echo (isset($key->pay_slip_month) && !empty($key->pay_slip_month))?$key->pay_slip_month:'';?>">
												<i class="fa fa-file-pdf-o"></i>
											</a> -->
										</span> 

									</td>
								</tr>
							<?php }?>												
						</tbody>
					</table>
					<div align="right"> 
						<span style="cursor: pointer;" class="tooltips"  data-original-title="Export Cover Letter" data-placement="top">
							<?php  if(isset($emp_ac_type)  && !empty($emp_ac_type) && ($emp_ac_type=='OBC'))
							{ ?>
								<?php /* 
								
								<a href="<?php echo base_url();?>word_OBC/<?php echo isset($totalAmount) && !empty($totalAmount)?$totalAmount:'';?>">
									Export Cover Letter
								</a>
								
								<?php }else{ ?>
								
								<a href="<?php echo base_url();?>word_other_than_OBC/<?php echo isset($totalAmount) && !empty($totalAmount)?$totalAmount:'';?>">
									Export Cover Letter
								</a> */ ?>
								
								<?php  }	?> 
						</span>

						<span style="cursor: pointer;" class="tooltips"  data-original-title="Export PDF" data-placement="top">
							<?php  if(isset($type)  && !empty($type) && ($type=='single_emp'))
							{?> <?php /*
							<a href="<?php echo base_url();?>generate_report/<?php echo isset($companyId) && !empty($companyId)?$companyId:'';?>/<?php echo (isset($month) && !empty($month))?$month:'';?>/<?php echo (isset($emp_ac_type) && !empty($emp_ac_type))?$emp_ac_type:'';?>/<?php echo (isset($emp_id) && !empty($emp_id))?$emp_id:'';?>">
								
								Export PDF
							</a>
							<?php }else{ ?>
							<a href="<?php echo base_url();?>generate_report1/<?php echo isset($companyId) && !empty($companyId)?$companyId:'';?>/<?php echo (isset($month) && !empty($month))?$month:'';?>/<?php echo (isset($emp_ac_type) && !empty($emp_ac_type))?$emp_ac_type:'';?>">
								Export PDF
							</a> */ ?>
							<?php }?>
						</span>

						<span style="cursor: pointer;" class="tooltips"  data-original-title="Export Excel" data-placement="top">
							
							<?php if(isset($type) && !empty($type) && ($type=='single_emp'))
							{?>
							<a href="<?php echo base_url();?>generate_excel_report/<?php echo isset($companyId) && !empty($companyId)?$companyId:'';?>/<?php echo (isset($month) && !empty($month))?$month:'';?>/<?php echo (isset($emp_ac_type) && !empty($emp_ac_type))?$emp_ac_type:'';?>/<?php echo (isset($emp_id) && !empty($emp_id))?$emp_id:'';?>">
								 
								Export Excel
							</a>
							<?php }else{ ?>
							<a href="<?php echo base_url();?>AllowancereportExcel/<?php echo isset($companyId) && !empty($companyId)?$companyId:'';?>/<?php echo (isset($month) && !empty($month))?$month:'';?>/<?php echo (isset($emp_ac_type) && !empty($emp_ac_type))?$emp_ac_type:'';?>">
								Export Excel
							</a>
							<?php } ?>


							
						</span>

						<span style="cursor: pointer;" class="tooltips"  data-original-title="Export Excel" data-placement="top">
							
							<?php if(isset($type) && !empty($type) && ($type=='single_emp'))
							{?>
							
							<?php }else{ ?>
							<a href="<?php echo base_url();?>generate_excel_report_NON_AC/<?php echo isset($companyId) && !empty($companyId)?$companyId:'';?>/<?php echo (isset($month) && !empty($month))?$month:'';?>/<?php echo (isset($emp_ac_type) && !empty($emp_ac_type))?$emp_ac_type:'';?>">
								NON/AC EMP Export Excel
							</a>
							<?php } ?>


							
						</span>

					</div>
				<?php }
				else 
				{?>
					<center><h4>No Records Found</h4></center>
				<?php }?>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
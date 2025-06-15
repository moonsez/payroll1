<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Employee Advance List
				</div>
				<?php if(isset($empDetails) && !empty($empDetails))
				{?>
				<div class="actions">  
                    <button id="generate_excel" onclick="saveAsExcel()" class="btn btn-danger">
            		Export To Excel</button>
                </div>
				<?php } ?>							
			</div>
			<?php //print_r($empDetails);?>
			<div class="portlet-body">
				<!-- <h2 style="text-align: center;"> Name : <?php //echo (isset($emp_name) && !empty($emp_name))?$emp_name:''; ?></h2> -->
				<?php if(isset($empDetails) && !empty($empDetails))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable" id="sendGrid" width="100%">
						<thead>	
							<tr>
								<th colspan="9" style="text-align: center;">
									<h2> Name : <?php echo (isset($emp_name) && !empty($emp_name))?$emp_name:''; ?></h2>
								</th>
							</tr>						
							<tr>
								<th>Sr. No.</th>
								<th>
									Date of Advance Taken
								</th>
								<th>
									Amount
								</th>
								<th>
									Recovery Amount per Month
								</th>
								<th>
									Advance Opening Amount
								</th>
								<th>
									Recovery Amount
								</th>
								<th>
									Closing Amount
								</th>								
								<th>
									Recovery Month
								</th>
								<!-- <th>
									Recovery Mode
								</th> -->
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach ($empDetails as $key) 
							{ ?>
								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>									
									<td>
										<?php echo (isset($key->advance_date) && !empty($key->advance_date))?date('d-m-Y',strtotime($key->advance_date)):'';?>
									</td>
									<td>
										<?php echo (isset($key->amount) && !empty($key->amount))?$key->amount:'';?>
									</td>
									<td>
										<?php echo (isset($key->recoveryPermonthAmt) && !empty($key->recoveryPermonthAmt))?$key->recoveryPermonthAmt:'';?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->advance_opening) && !empty($key->advance_opening))?$key->advance_opening:'';?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->advance_recovery) && !empty($key->advance_recovery))?$key->advance_recovery:'';?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->advance_closing_amt) && !empty($key->advance_closing_amt) && ($key->advance_closing_amt>0))?$key->advance_closing_amt:'0';?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->salary_month) && !empty($key->salary_month))?$key->salary_month:'';?>
									</td>									
								</tr>
							<?php  } ?>												
						</tbody>
					</table>
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

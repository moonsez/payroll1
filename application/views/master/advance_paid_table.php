<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Advance Paid List
				</div>							
			</div>
			<div class="portlet-body">
				<?php if(isset($advanceData) && !empty($advanceData))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
								<th>
									Sr. No.
								</th>
								<th>
									Employee Name
								</th>
								<th>
									Total Amount
								</th>
								<th>
									Remaining Amount 
								</th>
								<th>
									Paid Amount
								</th> 
								<th>
									Recovery Amount
								</th>
								<th>
									Recovery Mode
								</th>
								<!-- <th>
									Action
								</th> -->
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach ($advanceData as $key) 
							{?>
								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<td>
										<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'0';?>
									</td>
									<td>
										<?php echo (isset($key->amount) && !empty($key->amount))?$key->amount:'0';?>
									</td>
									<td>
										<?php echo (isset($key->closing_amt) && !empty($key->closing_amt))?$key->closing_amt:'0';?>
									</td>
									<td>
										<?php echo (isset($key->remaining_amount) && !empty($key->remaining_amount))?$key->remaining_amount:'0';?>
									</td>
									<td>
										<?php echo (isset($key->recoveryPermonthAmt) && !empty($key->recoveryPermonthAmt))?$key->recoveryPermonthAmt:'0';?>
									</td>
									<td>
										<?php echo (isset($key->recovery_mode) && !empty($key->recovery_mode))?$key->recovery_mode:'0';?>
									</td>
									<!-- <td style="text-align:center;">									
										<span style="cursor: pointer;" class="tooltips update_advance" rev="update_advance" rel="<?php echo (isset($key->adv_id) && !empty($key->adv_id))?$key->adv_id:'';?>" data-original-title="Edit" data-placement="top">
											<i class="fa fa-edit"></i>
										</span>								
										<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#advanceDetails" data-tburl="fetch_advance_data" rev="delete_advance" rel="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" data-original-title="Delete" data-placement="top">
											<i class="fa fa-trash-o"></i>
										</span>
									</td> -->
								</tr>
							<?php }?>												
						</tbody>
					</table>
				<?php }
				else {?>
					<center><h4>No Records Found</h4></center>
				<?php }?>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-md-12"> 
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Employee Allowance List 
				</div>							
			</div>
			<div class="portlet-body">
				<form id="allowanceSave" action="allowanceSave" method="post">
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead> 
							<tr>
								<th>Sr. No.</th>
								<th>Allowance Name</th>
								<th>Amount</th>
								<th>Fixed/KM</th>								
							</tr> 
						</thead>
						<tbody> 
								<tr>
									<td><input type="hidden" name="allowance_month" value="<?php echo (isset($slip_month) && !empty($slip_month))?$slip_month:'';?>"></td>
									<td>Days Of Working <?php if (isset($totalDetails)) {?> <input type="text"   class="form-control working_days " name="working_days" value="<?php echo (isset($totalDetails->workin_day) && !empty($totalDetails->workin_day))?$totalDetails->workin_day:'';?>" > <?php }else{?><input type="text"   class="form-control working_days " name="working_days" value="" > <?php } ?> <input type="hidden" name="emp_id" value="<?php echo (isset($emp_id) && !empty($emp_id))?$emp_id:'';?>"></td>
									<td >
									<input type="hidden" name="num_of_day_inMonth"  class="num_of_day_inMonth" value="<?php echo (isset($num_days_of_month) && !empty($num_days_of_month))?$num_days_of_month:'';?>">
								
									No. of Sundays <input type="text"  name="num_sundays" disabled="disabled" class="form-control num_sundays" value="<?php echo (isset($num_sundays) && !empty($num_sundays))?$num_sundays:'';?>"> 
									 
									</td>
									<td style="text-align:center;" >
										No. of Holiday<input type="text"  class="form-control no_holiday" name="no_holiday" value="0">
									</td>
								</tr>
							<?php if (isset($earningData) && !empty($earningData)) { 
								?>
							 	<tr>
									<td colspan="5">Earning Allowance </td>
								</tr>
							<?php $i=1; $j=0;
							foreach ($earningData as $key) 
							{?>	
								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++; ?>
									</td>  
									
									<td>
										<?php echo (isset($key->earning_name) && !empty($key->earning_name))?$key->earning_name:'';?>
										<input type="hidden" name="emp_earn_allow_id[]"  class="earn_name<?php echo $i-1;?>" value="<?php echo (isset($key->emp_earn_allow_id) && !empty($key->emp_earn_allow_id))?$key->emp_earn_allow_id:'';?>" rel="<?php echo (isset($key->earning_name) && !empty($key->earning_name) && $key->earning_name !='Arrears' && $key->earning_name !='Bonus')?1:'';?>">
										<input type="hidden" name="emp_earn_allow_sal_id[]" value="<?php echo (isset($key->emp_earn_allow_sal_id) && !empty($key->emp_earn_allow_sal_id))?$key->emp_earn_allow_sal_id:'';?>">
										<input type="hidden" name="emp_earn_allow_name[]" value="<?php echo (isset($key->earning_name) && !empty($key->earning_name))?$key->earning_name:'';?>">
									</td>
									<td style="text-align:right;">
										<div class="input-icon right input-group">
										<span class="input-group-addon"><i class="fa fa-inr"></i></span>
										<input type="text" name="earn_values[]" class="<?php echo(isset($key->emp_earn_name) && !empty($key->emp_earn_name))?'update':''; ?> form-control earnVal<?php echo $i-1;?>" rev="<?php echo(isset($key->earning_name) && !empty($key->earning_name) && ($key->earning_name=='conveyance allowance'))?1:''; ?>" rel="<?php echo(isset($key->earning_name) && !empty($key->earning_name) && ($key->earning_name=='House Rent Allowance'))?1:'';?>" name="earn_value[]" value="<?php echo (isset($key->earn_value) && !empty($key->earn_value))?$key->earn_value:'';?>">
										</div>
										<?php if (isset($ShowearningData)) {
											echo "Note :- monthly "."".$key->earning_name." ( Rs. ".$ShowearningData[$j]->earn_value.")";
										} $j++; ?>
									</td>
									<td>
										<?php echo (isset($key->convey_allowance_type) && !empty($key->convey_allowance_type))?$key->convey_allowance_type:'Fixed';?>
										<input type="hidden" class="allow_type<?php echo $i-1;?>" name="earn_type[]" value="<?php echo (isset($key->convey_allowance_type) && !empty($key->convey_allowance_type))?$key->convey_allowance_type:'Fixed';?>">
									</td>
									
									
								</tr>

								<?php } ?> 
								

									<input type="hidden" name="count" class="cntEarning" value="<?php echo $i-1;?>">
								<?php  } ?>

								<?php if (isset($deductData) && !empty($deductData)) {
								?>
								<tr>
									<td colspan="5">Deduction </td>
								</tr>
								<?php $j=1;
								foreach ($deductData as $key) 
								{	
									if ($key->deduction_name!='Professional Tax') {
									
									
									?>	

								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $j++;?>
									</td>
									
									<td>
										<?php echo (isset($key->deduction_name) && !empty($key->deduction_name))?$key->deduction_name:'';?>
										<input type="hidden" name="emp_deduct_id[]" value="<?php echo (isset($key->emp_deduct_id) && !empty($key->emp_deduct_id))?$key->emp_deduct_id:'';?>">
										<input type="hidden" name="emp_deduct_sal_id[]" value="<?php echo (isset($key->emp_deduct_sal_id) && !empty($key->emp_deduct_sal_id))?$key->emp_deduct_sal_id:'';?>">
										<input type="hidden" name="emp_deduct_name[]" value="<?php echo (isset($key->deduction_name) && !empty($key->deduction_name))?$key->deduction_name:'';?>">
									</td>
									<td style="text-align:right;">
										<div class="input-icon right input-group">
										<span class="input-group-addon"><i class="fa fa-inr"></i></span>
										<input type="text" name="deduct_value[]" class="form-control deductVal<?php echo $j-1;?>"  value="<?php echo (isset($key->deduct_value) && !empty($key->deduct_value))?$key->deduct_value:'';?>">
										</div>
									</td>
									<td>
										
										<?php echo (isset($key->convey_allowance_type) && !empty($key->convey_allowance_type))?$key->convey_allowance_type:'Fixed';?>
									</td>
									
									
								</tr>
								<?php }}?>
									<input type="hidden" name="count" class="cntDeduct" value="<?php echo $j-1;?>">
								<?php } ?>
								<tr>
									<td></td>
									<td></td>
									<td colspan="1">Total Earning  <input type="text" name="totalEarn" readonly class="form-control totalEarn"  value="<?php echo (isset($totalDetails->earning_amt) && !empty($totalDetails->earning_amt))?$totalDetails->earning_amt:'';?>"></td>
									<td colspan="2">Total Deduction <input type="text" name="totalDeduct" readonly class="form-control totalDeduct"  value="<?php echo (isset($totalDetails->deduct_amt) && !empty($totalDetails->deduct_amt))?$totalDetails->deduct_amt:'';?>"></td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"> </td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td colspan="">Net Pay <input type="text" name="netpay" readonly class="form-control netpay"  value="<?php echo (isset($totalDetails->net_allowance_amt) && !empty($totalDetails->net_allowance_amt))?$totalDetails->net_allowance_amt:'';?>"> <input type="hidden" name="allowance_id"  class="form-control"  value="<?php echo (isset($totalDetails->allowance_details_id) && !empty($totalDetails->allowance_details_id))?$totalDetails->allowance_details_id:'';?>"></td>
									<td colspan="2"></td> 
								</tr>
								<tr>
									<td></td>
									<td colspan="2" style="text-align:right;"> </td>
									<td colspan="2" ></td>
								</tr>

							
																			
						</tbody>
					</table>
				
					<span>

						<center><button type="submit" class="btn green saveAllowance" >
						<?php if(isset($totalDetails->allowance_details_id) && !empty($totalDetails->allowance_details_id)){
							echo "Update";
						}else{
							echo "Save";
						}?>
						</button> </center>
					</span>
				</form>	
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
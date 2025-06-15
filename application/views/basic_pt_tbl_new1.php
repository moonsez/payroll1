<!-- BEGIN CONTENT -->
<div class="row">
	<div class="col-md-12 col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET--> 
		<div class="portlet box blue-hoki">  
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Employee List For Basic salary
				</div>							
			</div> 
			<div class="portlet-body">
			<form id="basicPt" action="basicPt" method="post">
				<?php if(isset($basicWithPt) && !empty($basicWithPt))
				{?>
				<input type="hidden" name="month" value="<?php echo (isset($month) && !empty($month))?$month:'0';?>">
				<input type="hidden" name="num_of_day_inMonth" class="num_of_day_inMonth" value="<?php echo (isset($num_days_of_month) && !empty($num_days_of_month))?$num_days_of_month:'';?>">

					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
								<td colspan="2"></td>
								<td colspan="3">Enter No. of Holidays<input type="text" class="holiday" value="0" name="holiday"></td>
								<td colspan="4">Enter No. of Sunday<input type="text" class="sundays" value="4" name="sundays"></td>
								<td colspan="5"></td>
							</tr>
							<tr>
								<th>Sr. No.</th>
								<th>Employee Id</th>
								<th>Name</th>
								<th>basic Pay</th>
								<th>Extra Allowance Total</th>
								<th>conveyance</th>
								<th>HRA</th>
								<th>Earning Arrears</th>
								<th>Mobile Deduction</th>
								<th>Other Deductions (Arrears)</th>
								<th>PT</th>
								<th>Advance</th>
								<th>Days Of Working</th> 
								<th>Total Pay</th>
								<!-- <th>Actions</th> -->
							</tr> 
						</thead>
						<tbody>						
						
						<?php $i=1; //print_r($basicWithPt);
							foreach ($basicWithPt as $key) 
							{?>								
								<tr class="odd gradeX"> 
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<td style="text-align:center;">
										<input type="hidden" name="basic_id[]" class="" value="<?php echo (isset($key->basic_pt_id) && !empty($key->basic_pt_id))?$key->basic_pt_id:'';?>"> 
										<?php echo (isset($key->employee_id) && !empty($key->employee_id))?$key->employee_id:'';?>
										<input type="hidden" name="emp_id[]" value="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'0';?>">
										<?php $total_allowance=0; if (isset($earning_data) && !empty($earning_data)) {
											foreach ($earning_data as $rows) {
											if($key->emp_id==$rows->emp_id && $rows->earning_id != 3 && $rows->earning_id != 7 ) {	?>	
											<input type="hidden" name="earn_allow_emp_id[]" value="<?php echo (isset($rows->emp_id) && !empty($rows->emp_id))?$rows->emp_id:'0';?>">
											<input type="hidden" name="earn_id[]" value="<?php echo (isset($rows->earning_id) && !empty($rows->earning_id))?$rows->earning_id:'0';?>">
										 	<input type="hidden" name="earn_value[]" value="<?php echo (isset($rows->earn_value) && !empty($rows->earn_value))?$rows->earn_value:'0';?>">
											<?php if($rows->earning_id == 6){ $total_allowance=$total_allowance+$rows->earn_value; ?>
											<input type="hidden" name="mobile_allowance[]" class="mobile_allowance<?php echo isset($i)?$i-1:'';?>" value="<?php echo (isset($rows->earn_value) && !empty($rows->earn_value))?$rows->earn_value:'';?>">
											
											<?php } ?>
											<?php if($rows->earning_id == 15){ $total_allowance=$total_allowance+$rows->earn_value; ?>
											
											<input type="hidden" name="bonus[]" class="bonus<?php echo isset($i)?$i-1:'';?>" value="<?php echo (isset($rows->earn_value) && !empty($rows->earn_value))?$rows->earn_value:'';?>">
											<?php } ?>
											<?php if($rows->earning_id == 16){ $total_allowance=$total_allowance+$rows->earn_value; ?>
											
											<input type="hidden" name="advance[]" class="advance<?php echo isset($i)?$i-1:'';?>" value="<?php echo (isset($rows->earn_value) && !empty($rows->earn_value))?$rows->earn_value:'';?>">
											<?php } ?>
										<?php } 
										} }  ?>

										<?php if (isset($deduction_data) && !empty($deduction_data)) {
											foreach ($deduction_data as $deduct_row) {
											if($key->emp_id==$deduct_row->emp_id && $deduct_row->deduction_id != 4 && $deduct_row->deduction_id != 3) {	?>	
											<input type="hidden" name="deduct_allow_emp_id[]" value"<?php echo (isset($deduct_row->emp_id) && !empty($deduct_row->emp_id))?$deduct_row->emp_id:'0';?>">
											<input type="hidden" name="deduction_id[]" value"<?php echo (isset($deduct_row->deduction_id) && !empty($deduct_row->deduction_id))?$deduct_row->deduction_id:'0';?>">
										 	<input type="hidden" name="deduct_value[]" value="<?php echo (isset($deduct_row->deduct_value) && !empty($deduct_row->deduct_value))?$deduct_row->deduct_value:'0';?>">
											<?php if($deduct_row->deduction_id == 6){ /*$total_allowance=$total_allowance+$rows->earn_value;*/ ?>
											
											<input type="hidden" name="advance_deduct[]" class="advance_deduct<?php echo isset($i)?$i-1:'';?>" value="<?php echo (isset($deduct_row->deduct_value) && !empty($deduct_row->deduct_value))?$deduct_row->deduct_value:'';?>">
											<?php } ?>

										<?php }	} } ?>
									</td> 
									<td>
										<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
									</td>
									<td style="text-align:right;">
										<input type="text" name="emp_basic[]" class="basic_val<?php echo isset($i)?($i-1):'';?>" readonly="readonly" value="<?php echo (isset($key->basic_amt) && !empty($key->basic_amt))?$key->basic_amt:0;?>">
									</td>
									<td><?php  if (isset($key->basic_pt_id) && !empty($key->basic_pt_id)) { 
										$total_allowance = $key->allowances;										
									}else{
										$total_allowance = ($key->allowances-$key->convey)-$key->hra; 
									} ?>
										<input type="text" name="Allowance[]" class="Allowance<?php echo isset($i)?($i-1):'';?>" readonly="readonly" value="<?php echo (isset($key->allowances) && !empty($key->allowances))?$total_allowance:'0';?>">										
									</td>
									<td>
										<input type="text" name="convey[]" class="convey<?php echo isset($i)?($i-1):'';?>" readonly="readonly" rel="<?php echo (isset($key->convey_allowance_type) && !empty($key->convey_allowance_type))?$key->convey_allowance_type:'';?>" value="<?php echo (isset($key->convey) && !empty($key->convey))?$key->convey:'0';?>">
									</td>
									<td>
										<?php if ($key->emp_id==127 || $key->emp_id==47) { ?>
										<input type="text" name="hra[]" rel="fixed_hra" class="hra<?php echo isset($i)?($i-1):'';?>" readonly="readonly" rel="<?php echo (isset($key->hra) && !empty($key->hra))?$key->hra:'';?>" value="<?php echo (isset($key->hra) && !empty($key->hra))?$key->hra:'0';?>">
										<?php }else{ ?>
										<input type="text" name="hra[]" rel="varry" class="hra<?php echo isset($i)?($i-1):'';?>" readonly="readonly" rel="<?php echo (isset($key->hra) && !empty($key->hra))?$key->hra:'';?>" value="<?php echo (isset($key->hra) && !empty($key->hra))?$key->hra:'0';?>">
										<?php	}?>
										
									</td>
									<td> 
										<input type="text" name="earn_arrears[]" class="earn_arrears<?php echo isset($i)?($i-1):'';?>" value="<?php echo (isset($key->earn_arrears) && !empty($key->earn_arrears))?$key->earn_arrears:'0';?>">										
									</td>
									<td> 
										<input type="text" name="mobile_deduction[]" class="mobile_deduction<?php echo isset($i)?($i-1):'';?>" value="<?php echo (isset($key->mobile_deduction) && !empty($key->mobile_deduction))?$key->mobile_deduction:'0';?>">										
									</td>
									<td> 
										<input type="text" name="other_deduct[]" class="other_deduct<?php echo isset($i)?($i-1):'';?>" value="<?php echo (isset($key->other_deduct) && !empty($key->other_deduct))?$key->other_deduct:'0';?>">										
									</td>									 
									<td>
										<input type="text" name="emp_pt[]" class="pt_val<?php echo isset($i)?($i-1):'';?>" readonly="readonly" value="<?php echo (isset($key->pt_amt) && !empty($key->pt_amt))?$key->pt_amt:'';?><?php echo (isset($key->deduct_value) && !empty($key->deduct_value))?$key->deduct_value:'';?>">
										<input type="hidden" name="netBasic[]" class="basicAmt<?php echo isset($i)?($i-1):'';?>" value="">
									</td>
									<td>
										
									<?php if (isset($AdvanceData) && !empty($AdvanceData)) {
										
									foreach ($AdvanceData as $adv ) { 
									if ($key->emp_id==$adv->emp_id) { 
										if($adv->opening_amt != 0){ 
										if($adv->opening_amt <= $adv->recoveryPermonthAmt){ ?>
										
										<input type="hidden" name="adv[]" value="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'0';?>">
										<input type="text" name="emp_advance_opening[]" class="advopening_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->opening_amt) && !empty($adv->opening_amt))?$adv->opening_amt:'';?>">-
										<input type="hidden" name="emp_advance_Addition[]" class="advAddition_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->advAddition_val) && !empty($adv->advAddition_val))?$adv->advAddition_val:'';?>">
										<input type="text" name="emp_advance_recovery[]" class="advrecovery_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->opening_amt) && !empty($adv->opening_amt))?$adv->opening_amt:0;?>">
										<input type="hidden" name="emp_advance_closing_amt[]" class="advclosing_amt_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->closing_amt) && !empty($adv->closing_amt))?($adv->opening_amt-$adv->recoveryPermonthAmt):'';?>">
										<?php }else { ?>
										<input type="hidden" name="adv[]" value="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'0';?>">
										<input type="text" name="emp_advance_opening[]" class="advopening_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->opening_amt) && !empty($adv->opening_amt))?$adv->opening_amt:'';?>">-
										<input type="hidden" name="emp_advance_Addition[]" class="advAddition_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->advAddition_val) && !empty($adv->advAddition_val))?$adv->advAddition_val:'';?>">
										<input type="text" name="emp_advance_recovery[]" class="advrecovery_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->recoveryPermonthAmt) && !empty($adv->recoveryPermonthAmt))?$adv->recoveryPermonthAmt:0;?>">
										<input type="hidden" name="emp_advance_closing_amt[]" class="advclosing_amt_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->closing_amt) && !empty($adv->closing_amt))?($adv->opening_amt-$adv->recoveryPermonthAmt):'';?>">
									<?php } } } } } ?>
									</td>
									<td style="text-align:center;">
										<input type="text" class="days" name="work_day[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->work_day) && !empty($key->work_day))?$key->work_day:'0';?>">
									</td>
									<td style="text-align:center;">
										<input type="text" name="net_pay[]" class="net_pay<?php echo isset($i)?$i-1:'';?>"  readonly="readonly" value="<?php echo (isset($key->net_pay) && !empty($key->net_pay))?$key->net_pay:'0';?>">
									</td>
									<?php /*<td style="text-align:center;">																				
										
										<span style="cursor: pointer;" class="tooltips reprint" data-tburl="<?php echo base_url();?>re_print" rev="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" rel="<?php echo (isset($key->pay_slip_month) && !empty($key->pay_slip_month))?$key->pay_slip_month:'';?>" data-original-title="Delete" data-placement="top">
											<!-- <button>save</button> -->
										</span> 

									</td>*/
										?>
								</tr>
							

							<?php }?>	
						
						</tbody>
					</table>
					<span>
						<center><button type="submit" class="btn green generateBasic" >
						<?php
							if (isset($basicWithPt[0]->basic_pt_id) && !empty($basicWithPt[0]->basic_pt_id)) {
								echo "Update All";
							}else{
								echo "Save All";
							}
						 ?>
						

						</button> </center>
					</span>
					
				<?php }
				else {?>
					<center><h4>No Records Found</h4></center>
				<?php }?>
				
					
			</div>
			</form>	
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>

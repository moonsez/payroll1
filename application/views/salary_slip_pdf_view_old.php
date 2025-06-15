<html>
    <head>
        <style>
            body{width:100%; margin: 0; padding: 0;}
            table{width: 100%;border-collapse: collapse;}
            th{background-color: #ccc;border:1px solid black; font-size: 7pt; color: #fff; font-weight: bold;} 
            td{font-size: 7pt;} 
        </style>
    </head>
    <body>

		<div class="portlet-body">

			<table class="table table-striped table-bordered table-hover masterTable" border="1">
				<thead>
					<tr>						
						<th colspan="4" style="font-size:18px; height:40; color:black;">
						<?php echo (isset($companyDetails->company_name) && !empty($companyDetails->company_name))?$companyDetails->company_name:'';?>
						</th>
					</tr>
					<tr>
						<th colspan="4" style="font-size:16px; height:20; color:black;">
							<?php /* echo (isset($companyDetails->address) && !empty($companyDetails->address))?$companyDetails->address:'';*/ ?>
							Office No. 310, 311, 312, Pride Purple Square
							Kalewadi Phata, Wakad, Pune- 411057 
						</th>
					</tr>
					<tr>
						<?	$final_month_year = '';
						if(isset($employee_basic_info->salary_month) && !empty($employee_basic_info->salary_month))
						{
							$salary_month = $employee_basic_info->salary_month;
							$month_year = explode('-', $salary_month);
							$final_month_year = date("F", mktime(0, 0, 0, $month_year[0], 10)).' '.$month_year[1];
						}?>
						<th colspan="4" style="font-size:16px; height:20; color:black;">
							PAYSLIP - <?php echo (isset($final_month_year) && !empty($final_month_year))?$final_month_year:'';?>
						</th>
					</tr>
				</thead>
				<tbody>
						<tr class="odd gradeX">
							<td style="font-weight:bold;">
							   Employee Name 
							</td>
							<td>
								<?php echo (isset($employee_basic_info->emp_name) && !empty($employee_basic_info->emp_name))?$employee_basic_info->emp_name:'';?>
							</td>
							<td style="font-weight:bold;">
								Payslip No 
							</td>
							<?	$final_month_year = '';
								if(isset($employee_basic_info->salary_month) && !empty($employee_basic_info->salary_month))
								{
									$salary_month = $employee_basic_info->salary_month;
									$month_year = explode('-', $salary_month);
									$final_month_year = date("F", mktime(0, 0, 0, $month_year[0], 10)).' '.$month_year[1];
								}?>
							<td>
								<?php echo (isset($final_month_year) && !empty($final_month_year))?$final_month_year:'';?>/<?php echo (isset($employee_basic_info->emp_id) && !empty($employee_basic_info->emp_id))?$employee_basic_info->emp_id:'';?>
							</td>
						</tr>
						<tr class="odd gradeX">
							<td style="font-weight:bold;">
							   Designation 
							</td>
							<td>
								<?php echo (isset($employee_basic_info->desig_id) && !empty($employee_basic_info->desig_id))?$employee_basic_info->desig_id:'';?>
							</td>
							<td style="font-weight:bold;">
								Date Of Joining 
							</td>
							<td>
								<?php echo (isset($employee_basic_info->date_of_joining) && !empty($employee_basic_info->date_of_joining))?date('d M Y',strtotime($employee_basic_info->date_of_joining)):'';?> 
							</td>
						</tr>
						
						<tr class="odd gradeX">
							<td>
							  <b> PAN No </b>
							</td>
							<td>
								<?php echo (isset($employee_basic_info->emp_pan_num) && !empty($employee_basic_info->emp_pan_num))?$employee_basic_info->emp_pan_num:'';?>
							</td>
							<td>
								<b>Employee Code </b>
							</td>
							<td>
								<?php echo (isset($employee_basic_info->employee_id) && !empty($employee_basic_info->employee_id))?$employee_basic_info->employee_id:'';?>
							</td>
						</tr>	
						<tr class="odd gradeX">
							<td style="text-align:center;font-weight:bold;font-size:12px;">
							   Payments
							</td>
							<td style="text-align:center;font-weight:bold;font-size:12px;">
								Amount(Rs)
							</td>
							<td style="text-align:center;font-weight:bold;font-size:12px;">
								Deduction
							</td>
							<td style="text-align:center;font-weight:bold;font-size:12px;">
								Amount(Rs)
							</td>
						</tr>

						<tr class="odd gradeX">
							<td>
							    Basic
							</td>
							<td style="text-align:center;">
								<?php /*(isset($employee_basic_info->net_pay) && !empty($employee_basic_info->net_pay))?round($employee_basic_info->net_pay+$employee_basic_info->pt_amt):'0';?>.00*/
								$salary_month = $employee_basic_info->salary_month;
								$month_year_array = explode('-', $salary_month);
								$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 	
								$perDay = $employee_basic_info->allowances/$num_days_of_month;
								//$perDay = $employee_basic_info->allowances;
								$total_allowance = $perDay*$employee_basic_info->work_day;
								$basic = ((($employee_basic_info->net_pay)-($employee_basic_info->convey+$employee_basic_info->hra)+(($employee_basic_info->other_deduct+$employee_basic_info->mobile_deduction)+($employee_basic_info->pt_amt)))-($total_allowance));
								/*echo round($basic);*/
								echo round($employee_basic_info->basic_net); ?>
							</td>

							<td>
								Profession Tax
							</td>
							<td style="text-align:center;background-color:#f7f7f7;">
								<?php echo (isset($employee_basic_info->pt_amt) && !empty($employee_basic_info->pt_amt))?round($employee_basic_info->pt_amt):'0';?>.00
							</td>
						</tr>


						<?php $j=2; 
						if(isset($static_deduct_data) && !empty($static_deduct_data)){
							?>
					
						<?php foreach ($static_deduct_data as $key) 
								{?>	
							<tr>
								<!-- <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $j++;?> </td> -->
								<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (isset($key->emp_deduct_name) && !empty($key->emp_deduct_name))?$key->emp_deduct_name:'';?></td>
								<td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (isset($key->deduct_value) && !empty($key->deduct_value))?$key->deduct_value:'0';?>.00</td>
								<?php $deductTotal = $deductTotal + $key->deduct_value; }
								$ernCnt = count($static_earn_data);
								$dedCnt = count($static_deduct_data);
								$k= $ernCnt - $dedCnt;
								if ($k > 0) {
									for ($m=0; $m < $k ; $m++) { ?>
									<tr><td>&nbsp; </td>
									<td>&nbsp;</td>
									<td>&nbsp;</td></tr>
									<?php }
								}
								?>
							</tr>
						
						<?php }?>



						<tr class="odd gradeX">
							<td>
							  	Conveyance Allowance
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->convey) && !empty($employee_basic_info->convey))?round($employee_basic_info->convey,2):'0'; ?>
							</td>
							<td>
								Mobile Deduction
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->mobile_deduction) && !empty($employee_basic_info->mobile_deduction))?round($employee_basic_info->mobile_deduction,2):'0';?>
							</td>
						</tr>
						<tr class="odd gradeX">
							<td>
							  	House Rent Allowance
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->hra) && !empty($employee_basic_info->hra))?round($employee_basic_info->hra,2):'0'; ?>
							</td>
							<td>
								Other Deductions (Arrears)
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->other_deduct) && !empty($employee_basic_info->other_deduct))?round($employee_basic_info->other_deduct,2):'0';?>
							</td>
						</tr>
						<tr class="odd gradeX">
							<td>
							  	Arrears
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->earn_arrears) && !empty($employee_basic_info->earn_arrears))?round($employee_basic_info->earn_arrears,2):'0';?>
							</td>
							<td>
								Advance Recovery
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->advance_recovery) && !empty($employee_basic_info->advance_recovery))?round($employee_basic_info->advance_recovery,2):'0';?>
							</td>
						</tr>
						<!-- <tr class="odd gradeX">
							<td>
							  	DA/Special Allowance
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->special_allowance) && !empty($employee_basic_info->special_allowance))?round($employee_basic_info->special_allowance,2):'0';?>
							</td>
							<td>
								
							</td>
							<td style="text-align:center;">
								
							</td>
						</tr> -->
						<?php 
							$earnTotal=0;
							if (isset($static_earn_data) && !empty($static_earn_data)) 
							{
								foreach ($static_earn_data as $key) 
								{ ?>
								<tr class="odd gradeX">							 	
									<?php $value=0;
									$per_day = 0;
									if ($key->earning_id==6)
									{
										$value = $key->value;
									}
									else
									{	
										$per_day = $key->value/$num_days_of_month;
										$value = $per_day*$employee_basic_info->work_day;
									}

									$perDday_earn = $key->value/$num_days_of_month;
									$earnvalue = $perDday_earn*$employee_basic_info->work_day;
									
									$perDay = $employee_basic_info->allowances/$num_days_of_month;
									$total_allowance = $perDay*$employee_basic_info->work_day;
								?>
								<td><?php echo $key->earning_name; ?></td>
								<td style="text-align:center;"><?php echo round($earnvalue); ?></td>
								<td></td>
								<td></td>
                                                                  </tr>
								<?php $earnTotal = $earnTotal + $earnvalue; } ?>
                                                                <?php }else{?>

									<?php 
										$total_allowance=0;
										$earnTotal=0;
									?>
								
							<?php } ?>
							<?php if (isset($static_deduct_data) && !empty($static_deduct_data)) 
							{ 
								foreach ($static_deduct_data as $key) 
								{ ?>
								<tr class="odd gradeX">							
								<td>
									<?php echo $key->emp_deduct_name; ?>
								</td>
								<td style="text-align:center;">
									<?php echo round($key->deduct_value,2); ?>
								</td>
								<td></td>
								<td></td>
								<?php $deductTotal = $deductTotal + $key->deduct_value;
							} }else{ ?>
							
								<?php 
									$deductTotal=0;
								?>
							</tr>
							<?php } ?>
						
						<tr class="odd gradeX">
							<?php $deductTotal=0; if ($employee_basic_info->pt_amt > 0) {
								$deductTotal = $employee_basic_info->pt_amt+$employee_basic_info->other_deduct+$employee_basic_info->mobile_deduction;
							} ?>
							<td style="text-align:right;font-weight:bold;font-size:12px;">
								TOTAL PAYMENTS&nbsp;
							</td>
							<td style="text-align:center;background-color:#f7f7f7;">
								<?php /* $total_pay = $employee_basic_info->basic_net+$earnTotal+$employee_basic_info->convey+$employee_basic_info->hra+$employee_basic_info->earn_arrears+$employee_basic_info->special_allowance; */
								$total_pay = $employee_basic_info->basic_net+$earnTotal+$employee_basic_info->convey+$employee_basic_info->hra+$employee_basic_info->earn_arrears;
								echo round($total_pay); ?>
							</td>
							<td style="text-align:right;font-weight:bold;font-size:12px;">
								TOTAL DEDUCTIONS&nbsp;
							</td>							
							<td style="text-align:center;background-color:#f7f7f7;">
								<?php echo (isset($deductTotal) && !empty($deductTotal))?round($deductTotal+$employee_basic_info->advance_recovery):'0';?>.00
							</td>
						</tr>	
						<tr class="odd gradeX">
							<td style="text-align:right;font-weight:bold;font-size:12px;">
							  NET PAYMENT&nbsp;
							</td>
							<td style="text-align:center;font-weight:bold;font-size:12px;background-color:#f7f7f7;">
								<?php /* echo (isset($employee_basic_info->net_pay) && !empty($employee_basic_info->net_pay))?round((($employee_basic_info->net_pay+$employee_basic_info->pt_amt+$employee_basic_info->earn_arrears)+$earnTotal)-($deductTotal)):'0'; */?>
								<?php echo $grand_pay=round($total_pay-$deductTotal-$employee_basic_info->advance_recovery); ?>
							</td>
							<td ></td>
							<td> </td>
						</tr>
						<tr class="odd gradeX">
							<td style="text-align:right;font-weight:bold;font-size:12px;">
								IN WORD&nbsp;
							</td>
								<?php $words=''; if (isset($employee_basic_info) && !empty($employee_basic_info)) {							
								 /* $words = $this->convert_num_to_words->convert_number_to_words(round(((($employee_basic_info->net_pay+$employee_basic_info->pt_amt)+$earnTotal)-($deductTotal)))); }?> */
								 $words = $this->convert_num_to_words->convert_number_to_words(round($grand_pay)); }?>
							<td style="background-color:#f7f7f7;">&nbsp;<?php echo (isset($words) && !empty($words))?ucfirst($words):'';?> </td>
							<td ></td>
							<td> </td>
						</tr>


						<?php $j=2; 
						if(isset($static_deduct_data) && !empty($static_deduct_data)){
							?>
					
					<?php foreach ($static_deduct_data as $key) 
							{?>	
						<tr><td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $j++;?> </td>
						<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (isset($key->emp_deduct_name) && !empty($key->emp_deduct_name))?$key->emp_deduct_name:'';?></td>
						<td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (isset($key->deduct_value) && !empty($key->deduct_value))?$key->deduct_value:'0';?>.00</td>
						<?php $deductTotal = $deductTotal + $key->deduct_value; }
						$ernCnt = count($static_earn_data);
						$dedCnt = count($static_deduct_data);
						$k= $ernCnt - $dedCnt;
						if ($k > 0) {
							for ($m=0; $m < $k ; $m++) { ?>
							<tr><td>&nbsp; </td>
							<td>&nbsp;</td>
							<td>&nbsp;</td></tr>
							<?php }
						}
						?></tr>
					
					<?php } ?>

						<tr class="odd gradeX">
							<td style="text-align:center;font-weight:bold;font-size:14px;background-color:#cccccc;" colspan="4">
								Snap-Shot
							</td>
						</tr>
						<tr class="odd gradeX">
							<td >
								Days in Month
							</td>
							<td style="text-align:center;">
							<?php echo $num_days_of_month; ?> 
							</td>
							<td>
							 	Opening Advance
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->advance_opening) && !empty($employee_basic_info->advance_opening))?$employee_basic_info->advance_opening:'0';?>
							</td>
						</tr>
						<tr class="odd gradeX">
							<td>
								Leaves in Month
							</td>
							<td style="text-align:center;">
								<?php echo $num_days_of_month - $employee_basic_info->work_day; ?> 
							</td>
							<td>
								Advance (Addition)
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->advance_Addition) && !empty($employee_basic_info->advance_Addition))?$employee_basic_info->advance_Addition:'0';?>
							</td>
						</tr>	
						<tr class="odd gradeX">
							<td>
								Present Days
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->work_day) && !empty($employee_basic_info->work_day))?$employee_basic_info->work_day:'0';?> 
							</td>
							<td>
							 	Advance (Recovery)
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->advance_recovery) && !empty($employee_basic_info->advance_recovery))?$employee_basic_info->advance_recovery:'0';?>
							</td>
						</tr>	
						<tr class="odd gradeX">
							<td>
								Period of Service
							</td>
							<td style="text-align:center;">
								0
							</td>
							<td>
								Advance (Balance)
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->advance_closing_amt) && !empty($employee_basic_info->advance_closing_amt))?$employee_basic_info->advance_closing_amt:'0';?>
							</td>
						</tr>
						<tr class="odd gradeX">
							<td style="text-align:center;font-weight:bold;font-size:12px;" colspan="4">
								<em>This is Computer Generated Document, hence does't required any Signature</em>
							</td>
						</tr>						
				</tbody>
			</table>
		</div>		
				
 	</body>
</html>

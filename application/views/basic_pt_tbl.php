<!-- BEGIN CONTENT -->
<div class="row">
	<div class="col-md-12 col-md-12">
		<?php if (isset($basicWithPt[0]->basic_pt_id) && !empty($basicWithPt[0]->basic_pt_id)) {
		?>
		Salary for this month is already generated. To regenerate please delete the expenditure report for this month.
		<?php
		}else{ ?>
		<!-- BEGIN EXAMPLE TABLE PORTLET--> 
		<div class="portlet box blue-hoki">  
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Employee List For Basic salary
				</div>							
			</div> 
			<div class="portlet-body">
			<form id="basicPt" action="basicPt" method="post">
				<?php if(isset($basicWithPt) && !empty($basicWithPt)){ ?>
				<input type="hidden" name="month" id="month" value="<?php echo (isset($month) && !empty($month))?$month:'0';?>">
				<input type="hidden" name="comp_id" id="comp_id" value="<?php echo (isset($company_id) && !empty($company_id))?$company_id:'0';?>">
				<input type="hidden" name="num_of_day_inMonth" class="num_of_day_inMonth" value="<?php echo (isset($num_days_of_month) && !empty($num_days_of_month))?$num_days_of_month:'';?>">
					<?php if(!empty($month))
					{
						$mth = explode("-", $month);
						$day = 'Sunday';
						$from = $mth[1]."-".$mth[0]."-07";
				        $t=date("t",strtotime($from));
				        $count='0';
				        for($i=1; $i<=$t; $i++)
				        {
				           	if( date("l",strtotime($mth[1]."-".$mth[0]."-".$i))== $day)
				           	{
				             	$count++;
				          	}				        
				      	}
				      	$no_fo_sunday=$count;				      						
					} ?>
					<div class="table-scrollable task_div" style="max-height: 460px;">
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<!-- <tr>
								<td colspan="2"></td>
								<td colspan="3">Enter No. of Holidays<input type="text" style="width:50%;" class="form-control holiday" value="0" name="holiday"></td>
								<td colspan="4">Enter No. of Sunday<input type="text" style="width:50%;" class="form-control sundays" value="<?php echo $no_fo_sunday; ?>" name="sundays"></td>
								<td colspan="6"></td>
							</tr> -->
							<input type="hidden" class="form-control holiday" value="0" name="holiday">
							<input type="hidden" class="form-control sundays" value="<?php echo $no_fo_sunday; ?>" name="sundays">
							<tr>
								<th>Sr. No.</th>
								<th>Emp Id</th>
								<th>Employee Name</th>
								<th>Basic Pay</th>
								<th>Extra Allowance Total</th>
								<th>Conveyance</th>
								<th>House Rent Allowance</th>
								<th>DA/Special Allowance</th>
								<th>PF Employer</th>
								<th>ESIC Employer</th>
								<th>Earn Bonus</th>
								<!-- <th>Mobile Deduction</th> -->
								<th>Other Deductions</th>
								<th>PF Employee</th>
								<th>ESIC Employee</th>
								<th>TDS Deduction</th>
								<th>Professional Tax</th>
								<th>Advance Deduction</th>
								<th>Days Of Working</th> 
								<th>WFH Days</th> 
								<th>WFH Reduction %</th> 
								<th>No of Memo</th>
								<th>Memo Amount</th>
								<th>Late Punch In(After 11 am) Count - Half days</th>
								<th>Early Punch Out Count</th>
								<th>Half Days due to Early Punch Out (1 for 3)</th>
								<th>Full Days due to no minimum 4 hours</th>
								<th>Half Days due to no minimum 8 hours (7 hours on Saturday)</th>
								<th>No Punchout Count(Full day)</th>
								<th>Total full days</th>
							
								<!-- <th>Total Net Pay</th> -->
							</tr> 
						</thead>
						<tbody>						
						
						<?php 
						// echo "<pre>";
						// print_r($basicWithPt);
						/*print_r($AdvanceData);*/
						$j=1; $i=1; foreach ($basicWithPt as $key){ ?>								
							<tr class="odd gradeX"> 
								<td style="text-align:center;">
									<?php $i++; echo $j++;?>
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
									<?php } } } ?>

									<?php if (isset($deduction_data) && !empty($deduction_data)) {
										foreach ($deduction_data as $deduct_row) {
										if($key->emp_id==$deduct_row->emp_id && $deduct_row->deduction_id != 4 && $deduct_row->deduction_id != 3) { ?>
										<input type="hidden" name="deduct_allow_emp_id[]" value="<?php echo (isset($deduct_row->emp_id) && !empty($deduct_row->emp_id))?$deduct_row->emp_id:'0';?>">
										<input type="hidden" name="deduction_id[]" value="<?php echo (isset($deduct_row->deduction_id) && !empty($deduct_row->deduction_id))?$deduct_row->deduction_id:'0';?>">
									 	<input type="hidden" name="deduct_value[]" value="<?php echo (isset($deduct_row->deduct_value) && !empty($deduct_row->deduct_value))?$deduct_row->deduct_value:'0';?>">
										<?php if($deduct_row->deduction_id == 6){ ?>								
										<input type="hidden" name="advance_deduct[]" class="advance_deduct<?php echo isset($i)?$i-1:'';?>" value="<?php echo (isset($deduct_row->deduct_value) && !empty($deduct_row->deduct_value))?$deduct_row->deduct_value:'';?>">
										<?php } ?>
									<?php }	} } ?>
								</td>
								<td>
									<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
								</td>
								<td style="text-align:right;">
									<input type="text" name="emp_basic[]" class="form-control basic_val<?php echo isset($i)?($i-1):'';?>" value="<?php echo (isset($key->basic_amt) && !empty($key->basic_amt))?$key->basic_amt:0;?>">
								</td>
								<td><?php  if (isset($key->basic_pt_id) && !empty($key->basic_pt_id)) { 
									$total_allowance = $key->allowances;										
								}else{
									$total_allowance = ($key->allowances-$key->convey)-$key->hra; 
								} ?>
									<input type="text" name="Allowance[]" class="form-control Allowance<?php echo isset($i)?($i-1):'';?>" value="<?php echo (isset($key->allowances) && !empty($key->allowances))?$total_allowance:'0';?>">										
								</td>
								<td>
									<input type="text" name="convey[]" class="form-control convey<?php echo isset($i)?($i-1):'';?>" rel="<?php echo (isset($key->convey_allowance_type) && !empty($key->convey_allowance_type))?$key->convey_allowance_type:'';?>" value="<?php echo (isset($key->convey) && !empty($key->convey))?$key->convey:'0';?>">
								</td>
								<td>
									<?php if ($key->emp_id==127 || $key->emp_id==47) { ?>
									<input type="text" name="hra[]" rel="fixed_hra" class="form-control hra<?php echo isset($i)?($i-1):'';?>" rel="<?php echo (isset($key->hra) && !empty($key->hra))?$key->hra:'';?>" value="<?php echo (isset($key->hra) && !empty($key->hra))?$key->hra:'0';?>">
									<?php }else{ ?>
									<input type="text" name="hra[]" rel="varry" class="form-control hra<?php echo isset($i)?($i-1):'';?>" rel="<?php echo (isset($key->hra) && !empty($key->hra))?$key->hra:'';?>" value="<?php echo (isset($key->hra) && !empty($key->hra))?$key->hra:'0';?>">
									<?php	}?>										
								</td>
								<td>
									<input type="text" name="special_allowance[]" class="form-control special_allowance<?php echo isset($i)?($i-1):'';?>" rel="<?php echo (isset($key->special_allowance) && !empty($key->special_allowance))?$key->special_allowance:'';?>" value="<?php echo (isset($key->special_allowance) && !empty($key->special_allowance))?$key->special_allowance:'0';?>">
								</td>
								<td>
									<input type="text" name="pf_earn[]" class="form-control pf_earn<?php echo isset($i)?($i-1):'';?>" rel="<?php echo (isset($key->pf_earn) && !empty($key->pf_earn))?$key->pf_earn:'0';?>" value="<?php echo (isset($key->pf_earn) && !empty($key->pf_earn))?$key->pf_earn:'0';?>">
								</td>
								<td>
									<input type="text" name="ESIC_earn[]" class="form-control ESIC_earn<?php echo isset($i)?($i-1):'';?>" rel="<?php echo (isset($key->ESIC_earn) && !empty($key->ESIC_earn))?$key->ESIC_earn:'0';?>" value="<?php echo (isset($key->ESIC_earn) && !empty($key->ESIC_earn))?$key->ESIC_earn:'0';?>">
								</td>
								<td> 
									<input type="text" name="earn_bonus[]" class="form-control earn_bonus<?php echo isset($i)?($i-1):'';?>" value="<?php echo (isset($key->bouns_earn) && !empty($key->bouns_earn))?round($key->bouns_earn):'0';?>">										
								</td>
								<!-- <td> 
									<input type="text" name="mobile_deduction[]" class="form-control mobile_deduction<?php echo isset($i)?($i-1):'';?>" value="<?php echo (isset($key->mobile_deduction) && !empty($key->mobile_deduction))?$key->mobile_deduction:'0';?>">										
								</td> -->
								<td> 
									<input type="text" name="other_deduct[]" class="form-control other_deduct<?php echo isset($i)?($i-1):'';?>" value="<?php echo (isset($key->other_deduct) && !empty($key->other_deduct))?$key->other_deduct:'0';?>">										
								</td>
								<td>
									<input type="text" name="pf_deduct[]" class="form-control pf_deduct<?php echo isset($i)?($i-1):'';?>" rel="<?php echo (isset($key->pf_deduct) && !empty($key->pf_deduct))?$key->pf_deduct:'0';?>" value="<?php echo (isset($key->pf_deduct) && !empty($key->pf_deduct))?$key->pf_deduct:'0';?>">
								</td>
								<td>
									<input type="text" name="ESIC_deduct[]" class="form-control ESIC_deduct<?php echo isset($i)?($i-1):'';?>" rel="<?php echo (isset($key->ESIC_deduct) && !empty($key->ESIC_deduct))?$key->ESIC_deduct:'0';?>" value="<?php echo (isset($key->ESIC_deduct) && !empty($key->ESIC_deduct))?$key->ESIC_deduct:'0';?>">
								</td>
								<td>
									<input type="text" name="tds_deduct[]" class="form-control tds_deduct<?php echo isset($i)?($i-1):'';?>" rel="<?php echo (isset($key->tds_deduct) && !empty($key->tds_deduct))?$key->tds_deduct:'0';?>" value="<?php echo (isset($key->tds_deduct) && !empty($key->tds_deduct))?$key->tds_deduct:'0';?>">
								</td>
								<td>
								<?php $month=(isset($month) && !empty($month))?$month:'0';
                                $year=(isset($year) && !empty($year))?$year:'0';
                                $month_year_array = explode('-', $month);
								$mnt= date('F', mktime(0, 0, 0, $month_year_array[0], 10)); 
								$pt_val=(isset($key->deduct_value) && !empty($key->deduct_value))?$key->deduct_value:'';
								if($mnt=='February' && $pt_val=='200') { ?>
									<input type="text" name="emp_pt[]" class="form-control pt_val<?php echo isset($i)?($i-1):'';?>" value="300">
								<?php } else { ?>
								<input type="text" name="emp_pt[]" class="form-control pt_val<?php echo isset($i)?($i-1):'';?>" value="<?php echo (isset($key->deduct_value) && !empty($key->deduct_value))?$key->deduct_value:'0';?>">
								<?php } ?>
								<input type="hidden" name="netBasic[]" class="form-control basicAmt<?php echo isset($i)?($i-1):'';?>" value="<?php echo (isset($key->basic_net) && !empty($key->basic_net))?$key->basic_net:0;?>">
								</td>
								
								<td>										
								<?php if (isset($AdvanceData) && !empty($AdvanceData)) {										
								foreach ($AdvanceData as $adv ) { 
								if ($key->emp_id==$adv->emp_id) { 
									if($adv->remaining_amount != 0){ 
									if($adv->remaining_amount <= $adv->recoveryPermonthAmt)	{ ?>										
									<input type="hidden" name="adv[]" value="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'0';?>">
									<input type="text" name="emp_advance_opening[]" class="form-control advopening_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->remaining_amount) && !empty($adv->remaining_amount))?$adv->remaining_amount:'';?>">-
									<input type="hidden" name="emp_advance_Addition[]" class="advAddition_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->advAddition_val) && !empty($adv->advAddition_val))?$adv->advAddition_val:'0';?>">
									<input type="text" name="emp_advance_recovery[]" class="form-control advrecovery_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->remaining_amount) && !empty($adv->remaining_amount))?$adv->remaining_amount:'0';?>">
									<input type="hidden" name="emp_advance_closing_amt[]" class="advclosing_amt_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->remaining_amount) && !empty($adv->remaining_amount))?($adv->remaining_amount-$adv->recoveryPermonthAmt):'';?>">
									<?php }else { ?>
									<input type="hidden" name="adv[]" value="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'0';?>">
									<input type="text" name="emp_advance_opening[]" class="form-control advopening_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->remaining_amount) && !empty($adv->remaining_amount))?$adv->remaining_amount:'0';?>">-
									<input type="hidden" name="emp_advance_Addition[]" class="advAddition_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->advAddition_val) && !empty($adv->advAddition_val))?$adv->advAddition_val:'0';?>">
									<input type="text" name="emp_advance_recovery[]" class="form-control advrecovery_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->recoveryPermonthAmt) && !empty($adv->recoveryPermonthAmt))?$adv->recoveryPermonthAmt:'0';?>">
									<input type="hidden" name="emp_advance_closing_amt[]" class="advclosing_amt_val<?php echo isset($i)?$i-1:'';?>" readonly="readonly" value="<?php echo (isset($adv->remaining_amount) && !empty($adv->remaining_amount))?($adv->remaining_amount-$adv->recoveryPermonthAmt):'0';?>">
								<?php } } } } } ?>
								</td>
								<?php
								$punch_data = $this->slip_vish_model->fetch_punchin_data($key->user_id,$month);
								$work_day=0;
								$sandw=0;
								$i = 0;
								if(isset($punch_data) && !empty($punch_data))
								{
									$count=count($punch_data);
									$work_day=0;//count($punch_data);
									$sandw=0;
									for ($p=0; $p < $count; $p++)
									{
										if(date('w',strtotime($punch_data[$p]->date_field))==0)
										{											
											$work_day++;
										}else if(isset($punch_data[$p]->holiday_id) && !empty($punch_data[$p]->holiday_id))
										{
											$work_day++;
											//$cont_leave_cnt++;
										}else if(isset($punch_data[$p]->punch_date) && !empty($punch_data[$p]->punch_date) && ($punch_data[$p]->punchin_time!='00:00:00' || $punch_data[$p]->punchout_time!='00:00:00') && strtotime($punch_data[$p]->punchin_time) <= strtotime('14:00:00') )
										{
											$work_day++;
											// $i++;
										}else
										{
											if(
												(isset($punch_data[$p+1]->date_field) && isset($punch_data[$p+2]->date_field) && isset($punch_data[$p+3]->date_field)) 
												&&

												((date('w',strtotime($punch_data[$p+1]->date_field))==0) || (isset($punch_data[$p+1]->holiday_id) && !empty($punch_data[$p+1]->holiday_id))) 
											 && ((date('w',strtotime($punch_data[$p+2]->date_field))==0) || (isset($punch_data[$p+2]->holiday_id) && !empty($punch_data[$p+2]->holiday_id))) 

											 && !(isset($punch_data[$p+3]->punch_date) && !empty($punch_data[$p+3]->punch_date)))
											{
												//echo 'sand 2'.$punch_data[$p]->date_field;
												$sandw=$sandw+2;
											}else if(
												(isset($punch_data[$p+1]->date_field) && isset($punch_data[$p+2]->date_field))
												&& 

												((isset($punch_data[$p+1]->date_field) && date('w',strtotime($punch_data[$p+1]->date_field))==0) || (isset($punch_data[$p+1]->holiday_id) && !empty($punch_data[$p+1]->holiday_id)))

												 && !((date('w',strtotime($punch_data[$p+2]->date_field))==0) || (isset($punch_data[$p+2]->holiday_id) && !empty($punch_data[$p+2]->holiday_id))) 

												 && !(isset($punch_data[$p+2]->punch_date) && !empty($punch_data[$p+2]->punch_date)))
											{
												//echo 'sand 1'.$punch_data[$p]->date_field;
												$sandw=$sandw+1;
											}
										}


									/*	//sat off
										if(date('w',strtotime($punch_data[$p]->punch_date))==6 && !(isset($punch_data[$p+1]->punch_date) && date('w',strtotime($punch_data[$p+1]->punch_date))==1) && $punch_data[$p]->punch_date!=$last_day )
										{
											$work_day++;
										}
										//mon off
										if(date('w',strtotime($punch_data[$p]->punch_date))==1 && !(isset($punch_data[$p-1]->punch_date) && date('w',strtotime($punch_data[$p-1]->punch_date))==6) && date('d',strtotime($punch_data[$p]->punch_date))!='01' )
										{
											$work_day++;
										}*/
									}
									//first day on sunday
									/*$first_day = date('Y-m-01',strtotime($punch_data[0]->punch_date));
									$last_day = date('Y-m-t',strtotime($punch_data[0]->punch_date));
									$first_day = date('Y-m-d', strtotime('first day of previous month'));
                      				$last_day = date('Y-m-d', strtotime('last day of previous month'));
									if(date('w',strtotime($first_day))==0)
									{
										$work_day++;
									}
									if(date('w',strtotime($last_day))==0)
									{
										$work_day++;
									}*/
								}

								//exit();
								


								$holiday_data = $this->slip_vish_model->fetch_holidays($month);
								$emp_paid_leave = $this->slip_vish_model->get_paid_leave($year,$key->user_id,$month);
								$emp_sick_leave = $this->slip_vish_model->get_sick_leave($year,$key->user_id,$month);
								//echo count($emp_paid_leave);
								$leave=!empty($emp_paid_leave)?count($emp_paid_leave):0;
								$paid_leave=0;
								$sick_leave=0;
								if(isset($emp_paid_leave) && !empty($emp_paid_leave))
								{
									$paid_leave=count($emp_paid_leave);
									/*for ($r=0; $r < $leave; $r++)
									{
										if(date('w',strtotime($emp_paid_leave[$r]->leave_from_day))==1 && date('d',strtotime($emp_paid_leave[$r]->leave_from_day))!=01 && in_array(strtotime('-1 day',strtotime($emp_paid_leave[0]->leave_from_day)),array_column($punch_data,'punch_date'),true))
										{
											$paid_leave++;
										}

										if(date('w',strtotime($emp_paid_leave[$r]->leave_from_day))==1 && in_array(strtotime('-1 day',strtotime($emp_paid_leave[0]->leave_from_day)),array_column($punch_data,'punch_date'),true))
										{
											$paid_leave++;
										}

										if(date('w',strtotime($emp_paid_leave[$r]->leave_from_day))==6 && in_array(strtotime('1 day',strtotime($emp_paid_leave[0]->leave_from_day)),array_column($punch_data,'punch_date'),true))
										{
											$paid_leave++;
										}
									}*/
								}

								if (isset($emp_sick_leave) && !empty($emp_sick_leave)) {
									$sick_leave=count($emp_sick_leave);
								}
								// echo $i;
								//echo $paid_leave;
								$work_day = ($work_day+$paid_leave+$sick_leave)-$sandw;
								$present_days = $work_day;
								
								?>
								 <?php 
								//  if(isset($key->work_day) && !empty($key->work_day))
								// {
								// 	$present_days = $key->work_day;
								// }else{
								// 	$present_days = $work_day;
								// }

								?> 

								<?php 
								//echo $present_days;
								$joining_data = $this->slip_vish_model->fetch_joining_date($key->emp_id);
								$joining_mth =  date('m-Y',strtotime($joining_data));
								$joining_day =  date('l',strtotime($joining_data));

								if($month == $joining_mth && $joining_day == 'Monday')
								{ 
									$present_days1 = $present_days - 1;
									$present_days = number_format($present_days1,1);
								}
								//echo $present_days;
								 ?>
								<td style="text-align:center;"><!-- days -->
									<?php 
								//echo $sandw;
									?>
									<input type="text" class="form-control" name="work_day[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($present_days) && !empty($present_days))?$present_days:'0';?>">
								</td>
								<!-- <td style="text-align:center;">
									<input type="text" name="net_pay[]" class="form-control net_pay<?php echo isset($i)?$i-1:'';?>"  readonly="readonly" value="<?php echo (isset($key->net_pay) && !empty($key->net_pay))?$key->net_pay:'0';?>">
								</td> -->
								<td style="text-align:center;">
								<?php 
								$sudays = 0;
								if(isset($key->wfh_dates) && !empty($key->wfh_dates)){
									$input = $key->wfh_dates;
									$dates = explode(',', $input);
									sort($dates);
									$dates = array_map(function($date) {
									    return new DateTime($date);
									}, $dates);

									$missing_dates = [];
									for ($i = 0; $i < count($dates) - 1; $i++) {
									    $diff = $dates[$i + 1]->diff($dates[$i]);
									    if ($diff->days == 2) { 
									        $missing_date = $dates[$i]->add(new DateInterval('P1D'));
									        if ($missing_date->format('l') === 'Sunday') {
									            $missing_dates[] = $missing_date->format('Y-m-d');
									        }
									    }
									}

									$sudays = count($missing_dates);
								}
								?>
								<input type="text" class="form-control" name="wfh_day[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->wfh_cnt) && !empty($key->wfh_cnt))?$key->wfh_cnt*1+$sudays*1:0; ?>">
								</td>
								<td style="text-align:center;">
								<input type="text" class="form-control" name="wfh_deduct_per[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="20">
								</td>

								<td style="text-align:center;">
								<input type="text" class="form-control" name="memo_cnt[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->memo_cnt) && !empty($key->memo_cnt))?$key->memo_cnt:0; ?>">
								</td>

								<td style="text-align:center;">
									<input type="text" class="form-control" name="memo_amt[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->memo_amt) && !empty($key->memo_amt))?$key->memo_amt:0; ?>">
								</td>
								<td style="text-align:center;">
									<input type="text" class="form-control" name="late_punchin[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->late_punchin) && !empty($key->late_punchin))?$key->late_punchin:0; ?>">
								</td>
								<td style="text-align:center;">
									<input type="text" class="form-control" name="early_punchout[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->early_punchout) && !empty($key->early_punchout))?$key->early_punchout:0; ?>">
								</td>
								<td style="text-align:center;">
									<input type="text" class="form-control" name="half_days_due_to_early_punch_out[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->early_punchout) && !empty($key->early_punchout))?floor($key->early_punchout/3):0; ?>">
								</td>

								<td style="text-align:center;">
									<input type="text" class="form-control" name="no_min_4hr_work_cnt[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->no_min_4hr_work_cnt) && !empty($key->no_min_4hr_work_cnt))?$key->no_min_4hr_work_cnt:0; ?>">
								</td>

								<td style="text-align:center;">
									<input type="text" class="form-control" name="no_min_8hr_work_cnt[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->no_min_8hr_work_cnt) && !empty($key->no_min_8hr_work_cnt))?$key->no_min_8hr_work_cnt:0; ?>">
								</td>


								<td style="text-align:center;">
									<input type="text" class="form-control" name="no_punchout_cnt[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->no_punchout_cnt) && !empty($key->no_punchout_cnt))?$key->no_punchout_cnt:0; ?>">
								</td>

								<td style="text-align:center;">
									<?php
									
									$late_punchin = (isset($key->late_punchin) && !empty($key->late_punchin))?$key->late_punchin:0;

									$ep = (isset($key->early_punchout) && !empty($key->early_punchout))?$key->early_punchout:0;
									$np = (isset($key->no_punchout_cnt) && !empty($key->no_punchout_cnt))?$key->no_punchout_cnt*1:0;

									$t = $late_punchin/2 +floor($ep/3)/2+ $np + $key->no_min_4hr_work_cnt + $key->no_min_8hr_work_cnt/2;

									?>
									<input type="text" class="form-control" name="total_full_days[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo $t;?>">
								</td>
								

							</tr>
						<?php } //exit(); ?>					
						</tbody>
					</table>
					</div>
					<span>
						<center><button type="submit" class="btn green generateBasic">
						<?php if (isset($basicWithPt[0]->basic_pt_id) && !empty($basicWithPt[0]->basic_pt_id)) {
								echo "Update All";
							}else{
								echo "Save All";
							} ?>
						</button> </center>
					</span>					
				<?php } else { ?>
				<center><h4>No Records Found</h4></center>
				<?php } ?>
			</div>
			</form>	
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	<?php } ?>
	</div>
</div>
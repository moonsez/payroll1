<html>

<head>
	<style>
		body {
			width: 100%;
			margin: 0;
			padding: 0;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th {
			background-color: #ccc;
			border: 1px solid black;
			font-size: 8pt;
			color: #fff;
			font-weight: bold;
		}

		td {
			font-size: 8pt;
		}
	</style>
</head>

<body>

	<div class="portlet-body">
		<?php $deductTotal = 0; ?>
		<table class="table table-striped table-bordered table-hover masterTable" border="1">
			<thead>
				<tr>
					<th colspan="4" style="font-size:18px; height:40; color:black;">
						<?php echo (isset($companyDetails->company_name) && !empty($companyDetails->company_name)) ? $companyDetails->company_name : ''; ?>
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
					<? $final_month_year = '';
					if (isset($employee_basic_info->salary_month) && !empty($employee_basic_info->salary_month)) {
						$salary_month = $employee_basic_info->salary_month;
						$month_year = explode('-', $salary_month);
						$final_month_year = date("F", mktime(0, 0, 0, $month_year[0], 10)) . ' ' . $month_year[1];
						$month = date("F", mktime(0, 0, 0, $month_year[0], 10));
					} ?>
					<th colspan="4" style="font-size:16px; height:20; color:black;">
						PAYSLIP -
						<?php echo (isset($final_month_year) && !empty($final_month_year)) ? $final_month_year : ''; ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr class="odd gradeX">
					<td style="font-weight:bold;">
						Employee Name
					</td>
					<td>
						<?php echo (isset($employee_basic_info->emp_name) && !empty($employee_basic_info->emp_name)) ? $employee_basic_info->emp_name : ''; ?>
					</td>
					<td style="font-weight:bold;">
						Payslip No
					</td>
					<? $final_month_year = '';
					if (isset($employee_basic_info->salary_month) && !empty($employee_basic_info->salary_month)) {
						$salary_month = $employee_basic_info->salary_month;
						$month_year = explode('-', $salary_month);
						$final_month_year = date("F", mktime(0, 0, 0, $month_year[0], 10)) . '/' . $month_year[1];
					} ?>
					<td>
						<?php echo (isset($final_month_year) && !empty($final_month_year)) ? $final_month_year : ''; ?>/<?php echo (isset($employee_basic_info->emp_id) && !empty($employee_basic_info->emp_id)) ? $employee_basic_info->emp_id : ''; ?>
					</td>
				</tr>
				<tr class="odd gradeX">
					<td style="font-weight:bold;">
						Designation
					</td>
					<td>
						<?php echo (isset($employee_basic_info->title) && !empty($employee_basic_info->title)) ? $employee_basic_info->title : ''; ?>
					</td>
					<td style="font-weight:bold;">
						Date Of Joining
					</td>
					<td>
						<?php echo (isset($employee_basic_info->date_of_joining) && !empty($employee_basic_info->date_of_joining)) ? date('d M Y', strtotime($employee_basic_info->date_of_joining)) : ''; ?>
					</td>
				</tr>

				<tr class="odd gradeX">
					<td>
						<b> PAN No </b>
					</td>
					<td>
						<?php echo (isset($employee_basic_info->emp_pan_num) && !empty($employee_basic_info->emp_pan_num)) ? $employee_basic_info->emp_pan_num : ''; ?>
					</td>
					<td>
						<b>Employee Code </b>
					</td>
					<td>
						<?php echo (isset($employee_basic_info->username) && !empty($employee_basic_info->username)) ? $employee_basic_info->username : ''; ?>
					</td>
				</tr>

				<tr class="odd gradeX">
					<td>
						<b>PF UAN Number</b>
					</td>
					<td>
						<?php echo (isset($employee_basic_info->pf_acc_no) && !empty($employee_basic_info->pf_acc_no)) ? $employee_basic_info->pf_acc_no : ''; ?>
					</td>
					<td>
						<b>ESI Number</b>
					</td>
					<td>
						<?php echo (isset($employee_basic_info->esi_acc_no) && !empty($employee_basic_info->esi_acc_no)) ? $employee_basic_info->esi_acc_no : ''; ?>
					</td>
				</tr>

				<tr class="odd gradeX">
					<td style="text-align:center;font-weight:bold;font-size:12px;">
						Earnings
					</td>
					<td style="text-align:center;font-weight:bold;font-size:12px;">
						Amount(Rs)
					</td>
					<td style="text-align:center;font-weight:bold;font-size:12px;">
						Deductions
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
						<?php $salary_month = $employee_basic_info->salary_month;
						$month_year_array = explode('-', $salary_month);
						$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
						$perDay = $employee_basic_info->allowances / $num_days_of_month;

						$total_allowance = $perDay * $employee_basic_info->work_day;
						//$basic = ((($employee_basic_info->net_pay)-($convey+$hra)+(($employee_basic_info->other_deduct+$employee_basic_info->mobile_deduction)+($employee_basic_info->pt_amt)))-($total_allowance));
						
						$basic_net = $employee_basic_info->basic_net / $num_days_of_month;
						$emp_basic = $getNewCtc->earn_basic;
						echo round($emp_basic); ?>.00
					</td>

					<td>
						PF (Employee's Contribution)
					</td>
					<td style="text-align:center;">
						<?php
						$pf_deduct = $getNewCtc->employees_pf_deduction;
						$deductTotal = $deductTotal + $pf_deduct;
						$sa = (isset($employee_basic_info->special_allowance) && !empty($employee_basic_info->special_allowance)) ? round($employee_basic_info->special_allowance, 2) : '0';
						$perDday_earn = $sa / $num_days_of_month;
						$sa = round($perDday_earn * $employee_basic_info->work_day);

						$empconvey1 = (isset($employee_basic_info->convey) && !empty($employee_basic_info->convey)) ? round($employee_basic_info->convey, 2) : '0';
						$basic_convey1 = $empconvey1 / $num_days_of_month;
						$convey1 = $basic_convey1 * $employee_basic_info->work_day;

						$total_mobile = 0;
						$total_medi = 0;
						$total_edu = 0;
						$total_city = 0;
						$total_entertainment = 0;
						if (isset($static_earn_data) && !empty($static_earn_data)) {
							foreach ($static_earn_data as $row) {
								/*if($row->earning_id == 18 )
															  {
																  //DA allowance
																  $da = $employee_basic_info->special_allowance/$num_days_of_month;
																  $value = $employee_basic_info->work_day*$da;											
																  $total_da = $value;
																  
															  }else*/
								if ($row->earning_id == 6) {
									// mobile allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_mobile = $value;

								} elseif ($row->earning_id == 13) {
									//medical allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_medi = $value;

								} elseif ($row->earning_id == 20) {
									//education allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_edu = $value;

								} elseif ($row->earning_id == 14) {
									// City allowance 
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_city = $value;

								} elseif ($row->earning_id == 22) {
									//entertainment allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_entertainment = $value;

								}
							}
						}


						if (isset($employee_basic_info->pf_deduct) && !empty($employee_basic_info->pf_deduct)) {
							echo $pf_deduct;
						} else {
							echo $pf_deduct = 0;
						}
						?>.00
					</td>
				</tr>

				<tr class="odd gradeX">
					<?php if ($sa > 0) { ?>
						<td>
							DA/Special Allowance
						</td>
						<td style="text-align:center;">
							<?php echo round($getNewCtc->earn_da, 2); ?>.00
						</td>
					<?php } else { ?>
						<td colspan="2"></td>
					<?php } ?>
					<td>
						ESI (Employee's Contribution)
					</td>
					<td style="text-align:center;">
						<?php $esic = (isset($employee_basic_info->ESIC_deduct) && !empty($employee_basic_info->ESIC_deduct)) ? round($employee_basic_info->ESIC_deduct, 2) : '0';
						$perDday_earn = $esic / $num_days_of_month;
						echo $ESIC_deduct = round($getNewCtc->employees_esic_deduction, 2); 
						$deductTotal = $deductTotal + $ESIC_deduct;
					?>.00
						
					</td>
				</tr>

				<tr class="odd gradeX">
					<td>
						House Rent Allowance
					</td>
					<td style="text-align:center;">
						<?php $emphra = (isset($employee_basic_info->hra) && !empty($employee_basic_info->hra)) ? round($employee_basic_info->hra, 2) : '0';
						$basic_hra = $emphra / $num_days_of_month;
						$hra = $basic_hra * $employee_basic_info->work_day;
						echo round($getNewCtc->earn_hra, 2);
						?>.00
					</td>
					<td>
						Professional Tax
					</td>
					<td style="text-align:center;">
						<?php
						$month = '';

						$earn_allow = $this->master_model->selectAllWhr('tbl_emp_earn_allowance', 'emp_id', $employee_basic_info->emp_id);
						$in_hand1 = 0;
						if (isset($earn_allow) && !empty($earn_allow)) {
							foreach ($earn_allow as $key) {
								if ($key->earning_id != 19 && $key->earning_id != 21) {
									$perDday_earn = $key->earn_value / $num_days_of_month;
									$earn = $perDday_earn * $employee_basic_info->work_day;
									$in_hand1 = $in_hand1 + $earn;
								}
							}
						}

						$in_hand = $emp_basic + $in_hand1;
						if ($employee_basic_info->pt_amt > 0) {
							if ($in_hand <= 7500) {
								$pt = 0;
							} elseif ($in_hand <= 10000 && $in_hand >= 7500) {
								if ($employee_basic_info->gender == 'Female') {
									$pt = 0;
								} else {
									$pt = 175;
								}
							} elseif ($in_hand > 10001) {
								if ($month == 'February') {
									$pt = 300;
								} else {
									$pt = 200;
								}
							}
						} else {
							$pt = 0;
						}
						$deductTotal = $deductTotal + $pt;
						echo (isset($pt) && !empty($pt)) ? round($pt) : '0'; ?>.00

					</td>
				</tr>

				<tr class="odd gradeX">
					<td>
						Conveyance Allowance
					</td>
					<td style="text-align:center;">
						<?php $empconvey = (isset($employee_basic_info->convey) && !empty($employee_basic_info->convey)) ? round($employee_basic_info->convey, 2) : '0';
						$basic_convey = $empconvey / $num_days_of_month;
						$convey = $getNewCtc->earn_conveyance;
						echo round($convey);
						?>.00
					</td>
					<td>
						Mobile Deductions
					</td>
					<td style="text-align:center;">
						<?php echo (isset($employee_basic_info->mobile_deduction) && !empty($employee_basic_info->mobile_deduction)) ? round($employee_basic_info->mobile_deduction, 2) : '0'; ?>.00
					</td>
				</tr>

				<tr class="odd gradeX">
					<?php if (isset($static_earn_data) && !empty($static_earn_data)) {
						$Medical = 0;
						foreach ($static_earn_data as $key) { ?>
							<?php $value = 0;
							$per_day = 0;
							if ($key->earning_id == '13') {
								$perDday_earn = $key->value / $num_days_of_month;
								$Medical = $getNewCtc->earn_medical_allowance;
							}
						} ?>
						<td>
							Medical Allowance
						</td>
						<td style="text-align:center;">
							<?php echo (isset($Medical) && !empty($Medical)) ? round($Medical) : '0'; ?>.00
						</td>
					<?php } ?>
					<td>
						Advance Deductions
					</td>
					<td style="text-align:center;">
						<?php echo (isset($employee_basic_info->advance_recovery) && !empty($employee_basic_info->advance_recovery)) ? round($employee_basic_info->advance_recovery, 2) : '0'; ?>.00
					</td>
				</tr>

				<tr class="odd gradeX">
					<?php if (isset($static_earn_data) && !empty($static_earn_data)) {
						$city = 0;
						foreach ($static_earn_data as $key) { ?>
							<?php $value = 0;
							$per_day = 0;
							if ($key->earning_id == '14') {
								$perDday_earn = $key->value / $num_days_of_month;
								$city = $getNewCtc->earn_city_allowance;
							}
						} ?>
						<td>
							City Allowance
						</td>
						<td style="text-align:center;">
							<?php echo (isset($city) && !empty($city)) ? round($city) : '0'; ?>.00
						</td>
					<?php } ?>
					<td>
						Other Deductions
					</td>
					<td style="text-align:center;">
						<?php
						
						$wfh_deduction = round($getNewCtc->net_pay - $getNewCtc->net_pay_after_wfh);
						$wfo_days = $employee_basic_info->work_day - $employee_basic_info->wfh_day;
						$per_day_amt = $getNewCtc->net_pay_after_wfh / $employee_basic_info->work_day;
						$memo_amt = $employee_basic_info->memo_amt*$employee_basic_info->memo_cnt;
						$bv = round(($employee_basic_info->total_full_days*2 - $employee_basic_info->no_punchout_cnt*2)*$per_day_amt/2);
						$bx = round($employee_basic_info->no_punchout_cnt*$per_day_amt);
						echo $otherDed = $wfh_deduction+$memo_amt+$bv+$bx;

						$deductTotal = $deductTotal + $otherDed;
						
						; ?>
					</td>
				</tr>

				<tr>
				<td>
						Arrears
					</td>
					<td style="text-align:center;">
						<?php echo (isset($employee_basic_info->earn_arrears) && !empty($employee_basic_info->earn_arrears)) ? round($employee_basic_info->earn_arrears, 2) : '0'; ?>.00
					</td>
					<td>
						PF (Employer's Contribution)
					</td>
					<td style="text-align:center;">
						<?php
						$pf_deduct = $getNewCtc->employees_pf_deduction;
						$deductTotal = $deductTotal + $pf_deduct;
						$sa = (isset($employee_basic_info->special_allowance) && !empty($employee_basic_info->special_allowance)) ? round($employee_basic_info->special_allowance, 2) : '0';
						$perDday_earn = $sa / $num_days_of_month;
						$sa = round($perDday_earn * $employee_basic_info->work_day);

						$empconvey1 = (isset($employee_basic_info->convey) && !empty($employee_basic_info->convey)) ? round($employee_basic_info->convey, 2) : '0';
						$basic_convey1 = $empconvey1 / $num_days_of_month;
						$convey1 = $basic_convey1 * $employee_basic_info->work_day;

						$total_mobile = 0;
						$total_medi = 0;
						$total_edu = 0;
						$total_city = 0;
						$total_entertainment = 0;
						$esic_emp = 0;
						if (isset($static_earn_data) && !empty($static_earn_data)) {
							foreach ($static_earn_data as $row) {
								/*if($row->earning_id == 18 )
																											  {
																												  //DA allowance
																												  $da = $employee_basic_info->special_allowance/$num_days_of_month;
																												  $value = $employee_basic_info->work_day*$da;											
																												  $total_da = $value;
																												  
																											  }else*/

								if ($row->earning_id == 6) {
									// mobile allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_mobile = $value;

								} elseif ($row->earning_id == 13) {
									//medical allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_medi = $value;

								} elseif ($row->earning_id == 20) {
									//education allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_edu = $value;

								} elseif ($row->earning_id == 14) {
									// City allowance 
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_city = $value;

								} elseif ($row->earning_id == 22) {
									//entertainment allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_entertainment = $value;

								} elseif ($row->earning_id == 21) {
									$esic_emp = $row->value;
								}
							}
						}


						if (isset($employee_basic_info->pf_deduct) && !empty($employee_basic_info->pf_deduct)) {
							// if($employee_basic_info->pf_deduct>='1800')
							// {
							// 	$pfd_val = $employee_basic_info->pf_deduct/$num_days_of_month;
							// 	$pf_deduct =  $employee_basic_info->work_day*$pfd_val;
							// }else
							// {
							// 	$pf_deduct = round(($emp_basic+$sa+$convey1+$total_mobile+$total_medi+$total_edu+$total_city+$total_entertainment)*0.12);
							// }
							
							echo $pf_deduct;
						} else {
							echo $pf_deduct = 0;
						}
						?>.00
					</td>
					
				</tr>
				<tr>
				<td>
						PF (Employers's Contribution)
					</td>
					<td style="text-align:center;">
						<?php
						$pf_deduct = $getNewCtc->employees_pf_deduction;

						$sa = (isset($employee_basic_info->special_allowance) && !empty($employee_basic_info->special_allowance)) ? round($employee_basic_info->special_allowance, 2) : '0';
						$perDday_earn = $sa / $num_days_of_month;
						$sa = round($perDday_earn * $employee_basic_info->work_day);

						$empconvey1 = (isset($employee_basic_info->convey) && !empty($employee_basic_info->convey)) ? round($employee_basic_info->convey, 2) : '0';
						$basic_convey1 = $empconvey1 / $num_days_of_month;
						$convey1 = $basic_convey1 * $employee_basic_info->work_day;

						$total_mobile = 0;
						$total_medi = 0;
						$total_edu = 0;
						$total_city = 0;
						$total_entertainment = 0;
						$esic_emp = 0;
						if (isset($static_earn_data) && !empty($static_earn_data)) {
							foreach ($static_earn_data as $row) {
								/*if($row->earning_id == 18 )
																											  {
																												  //DA allowance
																												  $da = $employee_basic_info->special_allowance/$num_days_of_month;
																												  $value = $employee_basic_info->work_day*$da;											
																												  $total_da = $value;
																												  
																											  }else*/

								if ($row->earning_id == 6) {
									// mobile allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_mobile = $value;

								} elseif ($row->earning_id == 13) {
									//medical allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_medi = $value;

								} elseif ($row->earning_id == 20) {
									//education allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_edu = $value;

								} elseif ($row->earning_id == 14) {
									// City allowance 
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_city = $value;

								} elseif ($row->earning_id == 22) {
									//entertainment allowance
									$last_val = $row->value / $num_days_of_month;
									$value = $employee_basic_info->work_day * $last_val;
									$total_entertainment = $value;

								} elseif ($row->earning_id == 21) {
									$esic_emp = $row->value;
								}
							}
						}


						if (isset($employee_basic_info->pf_deduct) && !empty($employee_basic_info->pf_deduct)) {
							echo $pf_deduct;
						} else {
							echo $pf_deduct = 0;
						}
						?>.00
					</td>
					<td>
						ESI (Employer's Contribution)
					</td>
					<td style="text-align:center;">
						<?php
						echo round($getNewCtc->esic_earn);
						?>.00
					</td>
					
				</tr>

				
				<tr>
					<td>
						ESI (Employer's Contribution)
					</td>
					<td style="text-align:center;">
						<?php
						echo round($getNewCtc->esic_earn);
						$deductTotal = $deductTotal + $getNewCtc->esic_earn;
						?>.00
					</td>
					<td></td>
					<td></td>
				</tr>
				<?php

				if (isset($static_earn_data) && !empty($static_earn_data)) {
					$earnTotal = 0;
					$g = -1;
					foreach ($static_earn_data as $key) {
						if ($key->earning_id != 19) {
							if ($key->earning_id != 21) {
								if ($key->earning_id != 13) {
									if ($key->earning_id != 14) {
										if ($key->earning_id != 18) {
											$g++; ?>
											<tr class="odd gradeX">
												<?php $value = 0;
												$per_day = 0;
												if ($key->earning_id == 6) {
													$value = $key->value;
												} else {
													$per_day = $key->value / $num_days_of_month;
													$value = $per_day * $employee_basic_info->work_day;
												}
												if ($key->earning_id == 19) {
													$earnvalue = $key->value;
												} else {
													$perDday_earn = $key->value / $num_days_of_month;
													$earnvalue = $perDday_earn * $employee_basic_info->work_day;
												}
												//
												$perDay = $employee_basic_info->allowances / $num_days_of_month;
												$total_allowance = $perDay * $employee_basic_info->work_day;
												if ($key->earning_id == 15) {
													$earnvalue =  $getNewCtc->earn_bonus;
												}else if($key->earning_id == 9){
													$earnvalue =  $getNewCtc->earn_other_allowance;
												}

												?>
												<td><?php echo $key->earning_name; ?></td>
												<td style="text-align:center;"><?php echo round($earnvalue); ?>.00</td>
												<?php $earnTotal = $earnTotal + $earnvalue; ?>
												<?php if (isset($static_deduct_data[$g]) && !empty($static_deduct_data[$g])) { ?>
													<td><?php echo $static_deduct_data[$g]->deduction_name; ?></td>
													<td style="text-align:center;">
														<?php echo round($static_deduct_data[$g]->deduct_value);
														$deductTotal = $deductTotal + $static_deduct_data[$g]->deduct_value; ?>.00
													</td>

												<?php } else { ?>
													<td></td>
													<td></td>
												<?php } ?>
											</tr>
										<?php }
									}
								}
							}
						}
					}
				} else {
					$total_allowance = 0;
					$earnTotal = 0;
					$city = 0;
					$Medical = 0;
				} ?>
				<?php if (isset($employee_basic_info->var_amount) && !empty($employee_basic_info->var_amount) && $employee_basic_info->var_amount > 0) { ?>
					<tr class="odd gradeX">
						<td style="text-align:right;font-weight:bold;font-size:12px; text-align: center;" colspan="2">
							Performance Variable Bonus
						</td>
						<td style="text-align:right;font-weight:bold;font-size:12px;">

						</td>
						<td style="text-align:center;">

						</td>

					</tr>
					<tr class="odd gradeX" colspan="2">
						<td style="text-align:right;font-size:12px;">
							Variable
						</td>
						<td style="text-align:center;">
							<?php echo (isset($employee_basic_info->var_amount) && !empty($employee_basic_info->var_amount)) ? $employee_basic_info->var_amount : "-" ?>
						</td>
						<td style="text-align:right;">
							Performance Variable Bonus %
						</td>
						<td style="text-align:center;">
							<?php echo (isset($employee_basic_info->var_per) && !empty($employee_basic_info->var_per)) ? round($employee_basic_info->var_per) . '%' : "-" ?>
						</td>
					</tr>
				<?php } ?>

				<tr class="odd gradeX">
					<?php
					error_reporting(0);
					/*if ($employee_basic_info->pt_amt > 0) {*/
					//echo $pf_deduct; exit();
					//$deductTotal = $deductTotal + $pt + $employee_basic_info->other_deduct + $employee_basic_info->mobile_deduction + $pf_deduct + $ESIC_deduct;
					//echo $deductTotal; exit();
					/*}*/ ?>
					<td style="text-align:right;font-weight:bold;font-size:12px;">
						Total Earnings&nbsp;
					</td>
					<td style="text-align:center;">
						<?php
						$total_pay = $emp_basic + $earnTotal + $convey + $hra + $employee_basic_info->earn_arrears + $sa + $city + $Medical + $employee_basic_info->var_amount + $pf_deduct + $esic_emp;
						echo round($total_pay); ?>.00
					</td>
					<td style="text-align:right;font-weight:bold;font-size:12px;">
						Total Deductions&nbsp;
					</td>
					<td style="text-align:center;">
						<?php echo (isset($deductTotal)) ? round($deductTotal + $employee_basic_info->advance_recovery) : '0';


						?>.00
						<!-- + $employee_basic_info->memo_amt +
								round(($employee_basic_info->total_half_days - $employee_basic_info->no_punchout_cnt*2)*$per_day_amt/2) -->
					</td>
				</tr>
				<tr class="odd gradeX">
					<td></td>
					<td> </td>
					<td style="text-align:right;font-weight:bold;font-size:12px;">
						NET SALARY&nbsp;
					</td>
					<td style="text-align:center;font-weight:bold;font-size:12px;">
						<?php echo $grand_pay = round($total_pay - $deductTotal); ?>.00
					</td>
				</tr>
				<tr class="odd gradeX">
					<!-- <td style="text-align:right;font-weight:bold;font-size:12px;">
								In Word&nbsp;
							</td> -->
					<?php $words = '';
					if (isset($employee_basic_info) && !empty($employee_basic_info)) {
						$words = $this->convert_num_to_words->convert_number_to_words(round($grand_pay));
					} ?>
					<!-- <td colspan='3' style="font-size:12px;">&nbsp;<?php echo (isset($words) && !empty($words)) ? ucfirst($words) : ''; ?> </td> -->
					<td colspan="4" style="font-size:12px;text-align:right;">
						<?php echo '(Rupees ' . ucfirst($words) . ' only)' ?>
					</td>
				</tr>

				<tr class="odd gradeX">
					<td style="text-align:center;font-weight:bold;font-size:14px;background-color:#cccccc;" colspan="4">
						Snap-Shot
					</td>
				</tr>
				<tr class="odd gradeX">
					<td>
						Days in Month
					</td>
					<td style="text-align:center;">
						<?php
						// echo $val= round($employee_basic_info->total_half_days) - round($employee_basic_info->no_punchout_cnt*2);
						// echo $val/2;
						echo $num_days_of_month; ?>
					</td>
					<td>
						Opening Advance
					</td>
					<td style="text-align:center;">
						<?php echo (isset($employee_basic_info->advance_opening) && !empty($employee_basic_info->advance_opening)) ? $employee_basic_info->advance_opening : '0'; ?>.00
					</td>
				</tr>
				<tr class="odd gradeX">
					<td>
						Leaves in Month
					</td>
					<td style="text-align:center;">
						<?php 
						echo $num_days_of_month - $employee_basic_info->work_day; ?>
					</td>
					<td>
						Advance (Addition)
					</td>
					<td style="text-align:center;">
						<?php echo (isset($employee_basic_info->advance_Addition) && !empty($employee_basic_info->advance_Addition)) ? $employee_basic_info->advance_Addition : '0'; ?>.00
					</td>
				</tr>
				<tr class="odd gradeX">
					<td>
						Present Days
					</td>
					<td style="text-align:center;">
						<?php echo (isset($employee_basic_info->work_day) && !empty($employee_basic_info->work_day)) ? round($employee_basic_info->work_day) : '0'; ?>
					</td>
					<td>
						Advance (Recovery)
					</td>
					<td style="text-align:center;">
						<?php echo (isset($employee_basic_info->advance_recovery) && !empty($employee_basic_info->advance_recovery)) ? $employee_basic_info->advance_recovery : '0'; ?>.00
					</td>
				</tr>
				<!-- <tr class="odd gradeX">
							<td>
								  Sanction Leave
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->paid_leave) && !empty($employee_basic_info->paid_leave)) ? $employee_basic_info->paid_leave : '0'; ?>
							</td>
							<td>
								Advance (Balance)
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->advance_closing_amt) && !empty($employee_basic_info->advance_closing_amt)) ? $employee_basic_info->advance_closing_amt : '0'; ?>.00
							</td>
						</tr>
						<tr class="odd gradeX">
							<td>
								Approved Leave
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->approve_leave) && !empty($employee_basic_info->approve_leave)) ? $employee_basic_info->approve_leave : '0'; ?>
							</td>							
							<td>
								  Paid Leave
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->taken_leave) && !empty($employee_basic_info->taken_leave)) ? $employee_basic_info->taken_leave : '0'; ?>
							</td>
						</tr>
						<tr class="odd gradeX">
							<td>
								Balance Leave (Sanction-Approved)
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->bal_approve_leave) && !empty($employee_basic_info->bal_approve_leave)) ? $employee_basic_info->bal_approve_leave : '0'; ?>
							</td>
							<td>
								Balance Leave (Approved-Paid)
							</td>
							<td style="text-align:center;">
								<?php echo (isset($employee_basic_info->bal_taken_leave) && !empty($employee_basic_info->bal_taken_leave)) ? $employee_basic_info->bal_taken_leave : '0'; ?>
							</td>
						</tr> -->
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
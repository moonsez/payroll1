<!-- BEGIN CONTENT -->
<div class="row">
	<div class="col-md-12 col-md-12">
		<?php if (!(isset($basicWithPt[0]->basic_pt_id) && !empty($basicWithPt[0]->basic_pt_id))) {
		?>
		Salary for this month is not generated. Please generate salary before create variable bonus.
		<?php
		}else{ ?>
		<!-- BEGIN EXAMPLE TABLE PORTLET--> 
		<div class="portlet box blue-hoki">  
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Employee List
				</div>							
			</div> 
			<div class="portlet-body">
			<form id="basicPt" action="basicBonusPt" method="post">
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
						
					<div class="row">
						<!-- Grid column -->
					   <div class="col-md-2">
					      <!-- Default input -->
					   
					      <div class="form-group">
					      	<label  for="exampleSelect1">Variable %</label>
					   		<input type="text" class="form-control all_var_amount py-0""  value="">
					      </div>
					    </div>
					    <!-- Grid column -->

					    <!-- Grid column -->
					   <div class="col-md-2">
					   	 	<div class="form-group">
					      		<br/>
						      <button type="button" class=" btn btn-primary btn-md mt-0 all_var_amount_submit">Update ALL</button>
						 	 </div>
					    </div>
					  </div>
							
					<div class="table-scrollable task_div" style="max-height: 460px;">
					
						
					<table class="table table-striped table-bordered table-hover masterTable varTable">
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
							<!-- 	<th>Basic Pay</th>
								<th>Extra Allowance Total</th>
								<th>Conveyance</th>
								<th>House Rent Allowance</th>
								<th>DA/Special Allowance</th>
								<th>PF Employer</th>
								<th>ESIC Employer</th>
								<th>Earning Arrears</th>
								<th>Mobile Deduction</th>
								<th>Other Deductions</th>
								<th>PF Employee</th>
								<th>ESIC Employee</th>
								<th>Professional Tax</th>
								<th>Advance Deduction</th>
								<th>Days Of Working</th>  -->
								<th>Variable</th> 
								<th>Variable % </th> 
								<th>Variable Amount</th> 
								<!-- <th>Total Net Pay</th> -->
							</tr> 
						</thead>
						<tbody>						
						
						<?php 
						/*echo "<pre>";
						print_r($basicWithPt);
						print_r($AdvanceData);*/
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
								<td style="text-align:center;">
									<?php echo (isset($key->basic_var) && !empty($key->basic_var))?$key->basic_var:'';?>
								<input type="hidden" class="form-control var_amount_hidden" name="var_amount_hidden[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->basic_var) && !empty($key->basic_var))?$key->basic_var:'';?>">
								</td>
								<td style="text-align:center;">
								<input type="text" class="form-control var_per" name="var_per[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->var_per) && !empty($key->var_per))?$key->var_per:100;?>">
								</td>
								<td style="text-align:center;">
								<input type="text" class="form-control var_amount" name="var_amount[]" rel="<?php echo isset($i)?$i-1 :'';?>" value="<?php echo (isset($key->var_amount) && !empty($key->var_amount))?$key->var_amount:$key->basic_var;?>">
								</td>
							</tr>
						<?php } //exit(); ?>					
						</tbody>
					</table>
					</div>
					<span>
						<center><button type="submit" class="btn green generateVariable">
						Save All
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
	<form action="#" id="" class="horizontal-form">
	<div class="form-body">									
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">
						Employee id :
					</label>
					<label class="control-label" >
						<?php echo (isset($singleEmployee->employee_id) && !empty($singleEmployee->employee_id))?$singleEmployee->employee_id:''?>
					</label>
				</div>
			</div>	
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">
						Employee Name :
					</label>
					<label class="control-label" >
						<?php echo (isset($singleEmployee->emp_name) && !empty($singleEmployee->emp_name))?$singleEmployee->emp_name:''?>
					</label>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label">
						Company Name :
					</label>
					<label class="control-label" >
						<?php echo (isset($compName->company_name) && !empty($compName->company_name))?$compName->company_name:''?>
					</label>
				</div>
			</div>
		</div>
		<!--/row-->	
			
		<hr>
		<!--/row-->	
		<div class="row">
			<?php 	
			$gross = 0;
			$ctc = 0;
			$bonus = 0;
			if (isset($earning_data) && !empty($earning_data))
			{?>
				<div class="col-md-6">											
					<div class="form-group">
						<label class="control-label">
							<b>Earning Allowance</b>
						</label>
						<div class="checkbox-list">																
							<div class="form-group">																
								<div class="row">
									<div class="col-md-7">
										<label class="control-label">
											Basic
										</label>
									</div>
									<div class="col-md-5">
										<div class="input-group">
											<span class="input-group-addon">
												<div class="col-md-12 input-group">
													<i class="fa fa-inr"></i>
													<?php echo (isset($singleEmployee->emp_basic) && !empty($singleEmployee->emp_basic))?$singleEmployee->emp_basic:''?>.00
												</div>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						$i=1; 
						
						foreach ($earning_data as $key) 
						{
							if(isset($key->earning_name) && !empty($key->earning_name) && $key->earning_name=="PF (Employer's Contribution)"){
								$empPF=$key->earn_value;
							}
							?>
							<div class="checkbox-list">																
								<div class="form-group">																
									<div class="row" id="earning_allowance<?php echo $i++;?>">
										<div class="col-md-7">
											<label class="control-label">
												<?php echo (isset($key->earning_name) && !empty($key->earning_name))?$key->earning_name:'';?>
											</label>
										</div>
										<div class="col-md-5 input_percent">
											<div class="input-group  earning_allowance_input">
												<span class="input-group-addon">
													<?php if($key->earning_id==3){  ?>
													<div class="col-md-12 input-group  earning_allowance_input">
														<?php if(isset($key->earning_unit) && !empty($key->earning_unit))
														{
															if($key->earning_unit=='rupees')
															{?>
																<i class="fa fa-inr"></i>
															<?php }
															else{?>
																%
															<?php }
														} ?>
														<?php //echo (isset($key->convey_allowance_type) && !empty($key->convey_allowance_type))?$key->convey_allowance_type:'';?>&nbsp;
														<?php if(isset($key->earning_unit) && !empty($key->earning_unit))
														{
															if($key->convey_allowance_type=='fixed_amount')
															{ ?>
																<?php echo (isset($key->earn_value) && !empty($key->earn_value))?$key->earn_value:'';
																$gross = $gross+$key->earn_value;?>
															<?php }
															else{ ?>
																<?php $amount = $arrayName = array(); $amount= explode(',', $key->fixed_amount); ?><br/><br/>
																		Per Day KM &nbsp;&nbsp;<?php echo (isset($amount[0]) && !empty($amount[0]))?$amount[0]:'';?><br/> <br/>
																		KM Rate &nbsp;&nbsp;<?php echo (isset($amount[0]) && !empty($amount[1]))?$amount[1]:'';?><br/><br/>
																		Total &nbsp;&nbsp;<?php echo (isset($key->earn_value) && !empty($key->earn_value))?$key->earn_value:'';?>
																<?php }
														} ?>
													</div>
							 						<?php }else{ ?>
														<?php if(isset($key->earning_unit) && !empty($key->earning_unit))
														{
															if($key->earning_unit=='rupees')
															{?>
																<i class="fa fa-inr"></i>
															<?php }
															else{ ?>
																%
															<?php }
														}
														echo (isset($key->earn_value) && !empty($key->earn_value))?$key->earn_value:'';
														if($key->earning_id=='21')
														{
															$ctc = $ctc+$key->earn_value;
														}else{															
															$gross = $gross+$key->earn_value;
														}

														if($key->earning_id=='15')
														{
															$bonus = $key->earn_value;
														}
													} ?>	
												</span>
											</div>																		
										</div>
									</div>																
								</div>																																								
							</div>
						<?php }?>
					</div>
				</div>
			<?php }?>
			
			<?php
			//  echo '<pre>';print_r($deduction_data);
			 $total_deduct = 0;
			if (isset($deduction_data) && !empty($deduction_data))
			{?>
				<div class="col-md-6">											
					<div class="form-group">
						<label class="control-label">
							<b>Deduction Allowance</b>
						</label>
						<?php
						$j=1; 
						$total_deduct = 0;
						foreach ($deduction_data as $key) 
						{?>
							<div class="checkbox-list">																
								<div class="form-group">																
									<div class="row" id="deduction_allowance<?php echo $j++;?>">
										<div class="col-md-7">
											<label class="control-label">
												 <?php echo (isset($key->deduction_name) && !empty($key->deduction_name))?$key->deduction_name:'';?>
											</label>
										</div>
										<div class="col-md-5 input_percent">
											<div class="input-group  deduction_allowance_input">
												<span class="input-group-addon">
													<?php if(isset($key->earning_unit) && !empty($key->earning_unit))
													{
														if($key->earning_unit=='rupees')
														{?>
															<span class="input-group-addon"> 
																<i class="fa fa-inr"></i>
															</span>
														<?php }
														else
														{?>
															 <span class="input-group-addon"> 
																%
															</span> 
														<?php }
													}?>
														
													<?php if(isset($key->deduction_unit) && !empty($key->deduction_unit))
													{
														if($key->deduction_unit=='rupees')
														{?>
															<span> 
																<i class="fa fa-inr"></i>
															</span>
														<?php }
														else
														{?>
															<span> 
																%
															</span>
														<?php }
													}?>
													<?php echo (isset($key->deduct_value) && !empty($key->deduct_value))?$key->deduct_value:'0';
													$total_deduct = $total_deduct+$key->deduct_value; ?> 
												</span>
											</div>																		
										</div>
									</div>																
								</div>																																								
							</div>
						<?php }?>
					</div>					
				</div>
			<?php }?>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-7">
						<label class="control-label"><b>Gross Salary - </b></label>
					</div>
					
					<div class="col-md-5">
						<div class="input-group">
							<i class="fa fa-inr"></i>&nbsp;&nbsp;<b><?php echo $singleEmployee->emp_basic+$gross-$bonus; ?>.00</b>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-7">
						<label class="control-label"><b>CTC - </b></label>
					</div>
					<div class="col-md-5">
						<div class="input-group">
							<i class="fa fa-inr"></i>&nbsp;&nbsp;<b><?php echo $singleEmployee->emp_basic+$gross+$ctc; ?>.00</b>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-7">
						<label class="control-label"><b>Net Pay - </b></label>
					</div>
					<div class="col-md-5">
						<div class="input-group">
							<i class="fa fa-inr"></i>&nbsp;&nbsp;<b><?php echo ($singleEmployee->emp_basic+$gross)-$total_deduct-(isset($empPF) && !empty($empPF)?$empPF:0); ?>.00</b>
						</div>
					</div>
				</div>
			</div>
		</div>						
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('.modal-dialog').css('width','60%');
	});
</script>
<?php if(isset($empSalaryList) && !empty($empSalaryList))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th>Employee Id</th>
								<th>Name</th>
								<th>Gender</th>
								<th>Days Of Working</th>
								<!-- <th>Net Pay</th> -->
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>							
							<?php $i=1;
							foreach ($empSalaryList as $key) 
							{?>
								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->username) && !empty($key->username))?$key->username:'';?>
									</td>
									<td>
										<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->gender) && !empty($key->gender))?$key->gender:'';?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->work_day) && !empty($key->work_day))?$key->work_day:'';?>
									</td>
									<!-- <td style="text-align:right;">
										<?php echo (isset($key->basic_amt) && !empty($key->basic_amt))?($key->basic_amt + $key->total_allow_amt):'';?>.00
									</td> -->
									<td style="text-align:center;">												
										<!-- <span style="cursor: pointer;" class="tooltips reprint" data-tburl="<?php echo base_url();?>re_print" rev="<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>" rel="<?php echo (isset($key->salaryMonth) && !empty($key->salaryMonth))?$key->salaryMonth:'';?>" data-original-title="Delete" data-placement="top">
											<i class="fa fa-trash-o"></i>
										</span> -->											
										<?php if (isset($key->work_day) && $key->work_day>0) { ?>
										 <!-- <span style="cursor: pointer;" class="tooltips" data-original-title="Reprint" data-placement="top">
											<a href="<?php echo base_url();?>gef/<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>/<?php echo (isset($salaryMonth) && !empty($salaryMonth))?$salaryMonth:'';?>">
												<i class="fa fa-file-excel-o"></i> 
											</a>
										</span>
										&nbsp;&nbsp;&nbsp;&nbsp; -->
										<span style="cursor: pointer;" class="tooltips" data-original-title="Send By Mail" data-placement="top">
											<a href="<?php echo base_url();?>genPdf/<?php echo (isset($key->emp_id) && !empty($key->emp_id))?$key->emp_id:'';?>/<?php echo (isset($salaryMonth) && !empty($salaryMonth))?$salaryMonth:'';?>">
												<i class="fa fa-file-pdf-o"></i> 
											</a>
										</span>
										<?php } ?>
									</td>
								</tr>
							<?php }?>												
						</tbody>
					</table>
				<?php }
				else 
				{?>
					<center><h4>No Records Found</h4></center>
				<?php }?>
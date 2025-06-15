<html>
    <head>
        <style>
            body{width:100%; margin: 0; padding: 0;}
            table{width: 100%;border-collapse: collapse;}
            th{background-color: #ccc;border:1px solid black; font-size: 7pt; color: #fff; font-weight: bold;} 
            /*tr{border:1px solid black;} 
            th{border:1px solid black;} */
            td{font-size: 7pt;}
        </style>
    </head>
    <body>
    <?php if(isset($reportData) && !empty($reportData))
				{?>
					<table border="1">
						<tr>
							<td colspan="8" align="center"> Salary Slip Report of <?php echo (isset($compName) && !empty($compName))?$compName:'';?> For <?php echo (isset($emp_ac_type) && !empty($emp_ac_type))?$emp_ac_type:''; ?> </td>
						</tr>
						<thead>
							<tr>
								<th>Sr.No.</th>
								<!-- <th>Emp Id</th> -->
								<th>Name</th>
								<!-- <th>Comp Name</th> -->
								<!-- <th>Designation</th> -->
								<th>No of days</th>
								<th>Salary Amount</th>
								<th>Bank Name</th>
								<th>Branch Name</th>
								<th>IFSC Code</th>
								<th>Bank A/c</th> 
							</tr>
						</thead>
						<tbody>
						<?php $i=1;
							foreach ($reportData as $key) 
							{?>
								<tr style="border-style: solid;">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<!-- <td style="text-align:center;">
										<?php //echo (isset($key->comp_employee_id) && !empty($key->comp_employee_id))?$key->comp_employee_id:'';?>
									</td> -->
									<td>
										<?php echo (isset($key->emp_name) && !empty($key->emp_name))?$key->emp_name:'';?>
									</td>
									<!-- <td>
										<?php //echo (isset($key->emp_comp_name) && !empty($key->emp_comp_name))?$key->emp_comp_name:'';?>
									</td> 
									<td>
										<?php //echo (isset($key->emp_designation) && !empty($key->emp_designation))?$key->emp_designation:'';?>
									</td>-->
									<td style="text-align:center;">
										<?php echo (isset($key->emp_working_days) && !empty($key->emp_working_days))?$key->emp_working_days:'';?>
									</td>
									<td style="text-align:center;">
										<?php echo (isset($key->net_pay) && !empty($key->net_pay))?$key->net_pay:'';?>
									</td>
									<td style="text-align:right;">
										<?php echo (isset($key->bank_name) && !empty($key->bank_name))?$key->bank_name:'';?>
									</td>
									<td style="text-align:right;">
										<?php echo (isset($key->bank_branch) && !empty($key->bank_branch))?$key->bank_branch:'';?>
									</td>
									<td style="text-align:right;">
										<?php echo (isset($key->bank_ifc_code) && !empty($key->bank_ifc_code))?$key->bank_ifc_code:'';?>
									</td>
									
									 <td>
										<?php  echo (isset($key->emp_acc_no) && !empty($key->emp_acc_no))?$key->emp_acc_no:'';?>
									</td> 
									
								</tr>
							<?php }?>												
						</tbody>
					</table>
					<table border="1">
						
						<tbody>
							<tr colspan="8">
								<td colspan="2" align="center"> Total Amount</td>
								<td colspan="6"><?php  echo (isset($totalAmount) && !empty($totalAmount))?$totalAmount:'';?></td>
							</tr>
						</tbody>
					</table>
					
				<?php }
				else 
				{?>
					<center><h4>No Records Found</h4></center>
				<?php }?>
 	</body>
</html>
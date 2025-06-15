<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Allowance Master details
				</div>							
			</div>
			<div class="portlet-body">
				<?php if(isset($earningData) && !empty($earningData))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
							    <th>
									 Sr. No.
								</th>
								<th>
									Earning Type Name
								</th>
								<th>
									 Earning Short Name 
								</th>
								<th>
									Earning Unit
								</th>
								<th>
									Default Value
								</th>
								<th>
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach ($earningData as $key) 
							{?>
								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<td>
										<?php echo (isset($key->earning_name) && !empty($key->earning_name))?$key->earning_name:'';?>
									</td>
									<td>
										<?php echo (isset($key->earning_code) && !empty($key->earning_code))?$key->earning_code:'';?>
									</td>
									<td>
										<?php echo (isset($key->earning_unit) && !empty($key->earning_unit))?$key->earning_unit:'';?>
									</td>
									<td>
										<?php echo (isset($key->earning_default_value) && !empty($key->earning_default_value))?$key->earning_default_value:'';?>
									</td>

									
									<td style="text-align:center;">	
										<?php if($key->earning_name!='conveyance allowance'){  ?>								
										<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_earning_allowance" rel="<?php echo (isset($key->earning_id) && !empty($key->earning_id))?$key->earning_id:'';?>" data-original-title="Edit" data-placement="top">
											<i class="fa fa-edit"></i>
										</span>										
										<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#earningDetailsDiv" data-tburl="fetch_earning_allowance" rev="delete_earning_allowance" rel="<?php echo (isset($key->earning_id) && !empty($key->earning_id))?$key->earning_id:'';?>" data-original-title="Delete" data-placement="top">
											<i class="fa fa-trash-o"></i>
										</span>
										<?php }?>
									</td>
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
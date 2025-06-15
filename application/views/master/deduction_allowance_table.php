<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Deduction List
				</div>							
			</div>
			<div class="portlet-body">
				<?php if(isset($deductionData) && !empty($deductionData))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
								<th> 
									Sr. No.
								</th>
								<th>
									Deduction Type
								</th>
								<th>
									Deduction Short Name
								</th>
								<th>
									Deduction Unit
								</th>
								<th>
									Default Value
								</th>
								<th>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach ($deductionData as $key) 
							{?>
								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<td>
										<?php echo (isset($key->deduction_name) && !empty($key->deduction_name))?$key->deduction_name:'';?>
									</td>
									<td>
										<?php echo (isset($key->deduction_code) && !empty($key->deduction_code))?$key->deduction_code:'';?>
									</td>
									<td>
										<?php echo (isset($key->deduction_unit) && !empty($key->deduction_unit))?$key->deduction_unit:'';?>
									</td>
									<td>
										<?php echo (isset($key->deduction_default_value) && !empty($key->deduction_default_value))?$key->deduction_default_value:'';?>
									</td>
									<td style="text-align:center;">									
										<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_deduction_allowance" rel="<?php echo (isset($key->deduction_id) && !empty($key->deduction_id))?$key->deduction_id:'';?>" data-original-title="Edit" data-placement="top">
											<i class="fa fa-edit"></i>
										</span>										
										<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#deductionDetailsDiv" data-tburl="fetch_deduction_allowance" rev="delete_deduction_allowance" rel="<?php echo (isset($key->deduction_id) && !empty($key->deduction_id))?$key->deduction_id:'';?>" data-original-title="Delete" data-placement="top">
											<i class="fa fa-trash-o"></i>
										</span>
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
<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>State List
				</div>							
			</div>
			<div class="portlet-body">
				<?php if(isset($stateData) && !empty($stateData))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
								<th>
									Sr. No.
								</th>
								<th>
									 Country Name
								</th>
								<th>
									State Name
								</th>
								<th>
									State Description
								</th>
								<th>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach ($stateData as $key) 
							{?>
								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<td>
										<?php echo (isset($key->country_name) && !empty($key->country_name))?$key->country_name:'';?>
									</td>
									<td>
										<?php echo (isset($key->state_name) && !empty($key->state_name))?$key->state_name:'';?>
									</td>
									<td>
										<?php echo (isset($key->state_desc) && !empty($key->state_desc))?$key->state_desc:'';?>
									</td>
									<td style="text-align:center;">									
										<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_state" rel="<?php echo (isset($key->state_id) && !empty($key->state_id))?$key->state_id:'';?>" data-original-title="Edit" data-placement="top">
											<i class="fa fa-edit"></i>
										</span>										
										<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#stateDetailsDiv" data-tburl="fetch_state" rev="delete_state" rel="<?php echo (isset($key->state_id) && !empty($key->state_id))?$key->state_id:'';?>" data-original-title="Delete" data-placement="top">
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
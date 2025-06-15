<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>City List
				</div>							
			</div>
			<div class="portlet-body">
				<?php if(isset($cityData) && !empty($cityData))
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
									City Name
								</th>
								<th>
									City Description
								</th>
								<th>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach ($cityData as $key) 
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
										<?php echo (isset($key->city_name) && !empty($key->city_name))?$key->city_name:'';?>
									</td>
									<td>
										<?php echo (isset($key->city_desc) && !empty($key->city_desc))?$key->city_desc:'';?>
									</td>
									<td style="text-align:center;">									
										<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_city" rel="<?php echo (isset($key->city_id) && !empty($key->city_id))?$key->city_id:'';?>" data-original-title="Edit" data-placement="top">
											<i class="fa fa-edit"></i>
										</span>										
										<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#cityDetailsDiv" data-tburl="fetch_city" rev="delete_city" rel="<?php echo (isset($key->city_id) && !empty($key->city_id))?$key->city_id:'';?>" data-original-title="Delete" data-placement="top">
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
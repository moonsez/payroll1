<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Country List
				</div>							
			</div>
			<div class="portlet-body">
				<?php if(isset($countryData) && !empty($countryData))
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
									Country Description
								</th>
								<th>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach ($countryData as $key) 
							{?>
								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<td>
										<?php echo (isset($key->country_name) && !empty($key->country_name))?$key->country_name:'';?>
									</td>
									<td>
										<?php echo (isset($key->country_desc) && !empty($key->country_desc))?$key->country_desc:'';?>
									</td>
									<td style="text-align:center;">									
										<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_country" rel="<?php echo (isset($key->country_id) && !empty($key->country_id))?$key->country_id:'';?>" data-original-title="Edit" data-placement="top">
											<i class="fa fa-edit"></i>
										</span>										
										<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#countryDetailsDiv" data-tburl="fetch_country" rev="delete_country" rel="<?php echo (isset($key->country_id) && !empty($key->country_id))?$key->country_id:'';?>" data-original-title="Delete" data-placement="top">
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
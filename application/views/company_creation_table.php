<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Company List
				</div>							
			</div>
			<div class="portlet-body">
				<?php if(isset($companyData) && !empty($companyData))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
		 						<th>
									Sr. No.
								</th>
								<th>
									  Name
								</th>
								<th>
									  Address
								</th>
								<th>
									  Country
								</th>
								<th>
									  State
								</th>
								<th>
									  City
								</th>
								
								<th>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach ($companyData as $key) 
							{ if($key->company_id!=1){?>

								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<td>
										<?php echo (isset($key->company_name) && !empty($key->company_name))?$key->company_name:'';?>
									</td>
									<td>
										<?php echo (isset($key->company_add) && !empty($key->company_add))?$key->company_add:'';?>
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
								
									<td style="text-align:center;">									
										<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_company" rel="<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>" data-original-title="Edit" data-placement="top">
											<i class="fa fa-edit"></i>
										</span>										
										<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#companyDetailsDiv" data-tburl="fetch_company" rev="delete_company" rel="<?php echo (isset($key->company_id) && !empty($key->company_id))?$key->company_id:'';?>" data-original-title="Delete" data-placement="top">
											<i class="fa fa-trash-o"></i>
										</span>
									</td>
								</tr>
							<?php }}?>												
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
</div> <!-- CODER  Vishal Gurhale -->

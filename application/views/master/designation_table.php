<div class="row">
	<div class="col-md-12 col-sm-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Designation List
				</div>							
			</div>
			<div class="portlet-body">
				<?php if(isset($desigData) && !empty($desigData))
				{?>
					<table class="table table-striped table-bordered table-hover masterTable">
						<thead>
							<tr>
								<th>
									Sr. No.
								</th>
								<th>
									Designation Name
								</th>
								<th>
									Designation Description
								</th>
								<th>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; 
							foreach ($desigData as $key) 
							{?>
								<tr class="odd gradeX">
									<td style="text-align:center;">
										<?php echo $i++;?>
									</td>
									<td>
										<?php echo (isset($key->desig_name) && !empty($key->desig_name))?$key->desig_name:'';?>
									</td>
									<td>
										<?php echo (isset($key->desig_desc) && !empty($key->desig_desc))?$key->desig_desc:'';?>
									</td>
									<td style="text-align:center;">									
										<span style="cursor: pointer;" class="tooltips editRecord" rev="edit_designation" rel="<?php echo (isset($key->desig_id) && !empty($key->desig_id))?$key->desig_id:'';?>" data-original-title="Edit" data-placement="top">
											<i class="fa fa-edit"></i>
										</span>										
										<span style="cursor: pointer;" class="tooltips deleteRecord" data-tbdiv="#designationDetailsDiv" data-tburl="fetch_desig" rev="delete_designation" rel="<?php echo (isset($key->desig_id) && !empty($key->desig_id))?$key->desig_id:'';?>" data-original-title="Delete" data-placement="top">
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
	<?php if(isset($deduction) && !empty($deduction) || isset($earning) && !empty($earning) ) 
	{
		?>

			<div class="row">
			<?php $i=1;
							foreach ($empDetails as $key) 
							{?>
			

				<div class="col-md-6">		
					<div class="form-group">
						<label></label>
						<div class="radio-list">
							<label class="radio-inline">
							</label>							
						</div>
					</div>			
				</div>
				<div class="col-md-6 display-hide descDiv">
					<div class="form-group">
						<label>Description</label>
						<div>
							<textarea name="desc" class="form-control" style="resize:none;"> </textarea>	
						</div>
					</div>												
				</div>
			</div>
			<div class="row crDetails">
				<div class="col-md-6">		
					<div class="form-group">					
						<label class="control-label"> Select Courier Name </label>
						<select name="opd_name" class="form-control"> 
							<option value="Blue Dart">Blue Dart</option>
							<option value="Fedex">Fedex</option>
							<option value="DHL">DHL</option>
							<option value="DTDC">DTDC</option>
						</select>	
					</div>			
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">OPD number </label>
						<input type="text" name="opd_number" class="form-control"> 
					</div>												
				</div>
			</div>

		
	
		<?php }}
				else 
				{?>
					<center><h4>No Records Found</h4></center>
				<?php }?>
								

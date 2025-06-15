<form action="update_advance_str" id="update" class="horizontal-form">
	<div class="form-body">									
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">
						Opening Amount
					</label>
					<div class="input-icon right">
						<i class="fa"></i>
						<input type="text" name="opening_amt" value="<?php echo (isset($advance_data->remaining_amount) && !empty($advance_data->remaining_amount))?$advance_data->remaining_amount:'0' ?>" class="form-control remaining_amount" readonly="readonly">
						<input type="hidden" name="adv_id" value="<?php echo $adv_id; ?>">
					</div>
				</div>
			</div>	
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">
						Recovery Amount
					</label>
					<div class="input-icon right">
						<i class="fa"></i>
						<input type="text" id='recoveryPermonthAmt' name="recoveryPermonthAmt" value="<?php echo (isset($advance_data->recoveryPermonthAmt) && !empty($advance_data->recoveryPermonthAmt))?$advance_data->recoveryPermonthAmt:'0' ?>" class="form-control">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">
						Balance Amount
					</label>
					<div class="input-icon right">
						<i class="fa"></i>
						<input type="text" name="closing_amt" id="closing_amt" value="<?php echo (isset($advance_data->remaining_amount) && !empty($advance_data->remaining_amount))?($advance_data->remaining_amount-$advance_data->recoveryPermonthAmt):'0' ?>" class="form-control" readonly="readonly">
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		//$('.modal-dialog').css('width','60%');
		$(document).on('blur','#recoveryPermonthAmt',function() { 
			var recoveryPermonthAmt = $(this).val(); 
			var amt = $('.opening_amt').val();
			if(recoveryPermonthAmt>0){
				var closing_amt = (amt*1)-(recoveryPermonthAmt*1);
				$('#closing_amt').val(closing_amt);
			}else{
				$('#closing_amt').val(amt*1);
			}
		});		
	});
</script>
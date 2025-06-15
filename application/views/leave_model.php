<form action="update_leaves" class="form-horizontal form- common_form" id="officer_form" method="post">
	<div class="form-body">
        <div class="form-group">
            <label class="col-md-4 control-label">Total Paid Leave</label>
            <div class="col-md-8">
            <?
                $date1 = date('Y-m-d',strtotime($leave_data->date_of_joining));
                $date2 = date('Y-m-d');    
                $diff =  abs(strtotime($date1)-strtotime($date2));
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                $Period_of_Service = $years.' years, '.$months.' months, '.$days.' days';
                
                if($years>=1)
                {
                    $paid_leave = '10';
                }elseif($months>=6 && $years=0){
                    $paid_leave = '5';
                }else{
                    $paid_leave = '0';
                }
            ?>
                <input type="text" class="form-control input-inline input-medium paid_leave" name="paid_leave" readonly value="<?php echo $paid_leave; ?>">
            </div>
        </div>
        <input type="hidden" name="emp_id" value="<?php echo (isset($leave_data->emp_id) && !empty($leave_data->emp_id))?$leave_data->emp_id:'0'; ?>">
        
        <div class="form-group">
            <label class="col-md-4 control-label">Approve Leave</label>
            <div class="col-md-8">
                <input type="text" class="form-control input-inline input-medium approve_leave" name="approve_leave" value="<?php echo (isset($leave_data->approve_leave) && !empty($leave_data->approve_leave))?$leave_data->approve_leave:''; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Balance Approve Leave</label>
            <div class="col-md-8">
                <input type="text" class="form-control input-inline input-medium bal_approve_leave" name="bal_approve_leave" readonly value="<?php echo (isset($leave_data->bal_approve_leave) && !empty($leave_data->bal_approve_leave))?$leave_data->bal_approve_leave:'0'; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Paid Leave</label>
            <div class="col-md-8">
                <input type="text" class="form-control input-inline input-medium taken_leave" name="taken_leave" value="<?php echo (isset($leave_data->taken_leave) && !empty($leave_data->taken_leave))?$leave_data->taken_leave:''; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Balance Paid Leave</label>
            <div class="col-md-8">
                <input type="text" class="form-control input-inline input-medium bal_taken_leave" name="bal_taken_leave" readonly value="<?php echo (isset($leave_data->bal_taken_leave) && !empty($leave_data->bal_taken_leave))?$leave_data->bal_taken_leave:'0'; ?>">
            </div>
        </div>

        <!-- <div class="form-group">
            <label class="col-md-3 control-label">From Date</label>
            <div class="col-md-9">
				<div class="input-group input-medium date date-picker" data-date="<?php echo date('Y-m-d');?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
					<input class="form-control from_date" readonly name="from_date" type="text">
					<span class="input-group-btn">
						<button class="btn default" type="button">
							<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
			</div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">To Date</label>
            <div class="col-md-9">
				<div class="input-group input-medium date date-picker" data-date="<?php echo date('Y-m-d');?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
					<input class="form-control to_date" readonly name="to_date" type="text">
					<span class="input-group-btn">
						<button class="btn default" type="button">
							<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
			</div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-9">
                <span class="earn_leave btn-success" style="cursor: pointer;"> Click Here</span>
                <span class="leave_taken "></span>
                <input type="hidden" class="leave" name="earn_leave" value="">
            </div>
        </div> -->

        <div class="form-group">
            <label class="col-md-4 control-label">Balance Leave</label>
            <div class="col-md-8">
                <input type="text" class="form-control input-inline input-medium balance_leave" name="balance_leave" readonly value="<?php echo (isset($leave_data->balance_leave) && !empty($leave_data->balance_leave))?$leave_data->balance_leave:'0'; ?>">
            </div>
        </div>
    </div>
</form>
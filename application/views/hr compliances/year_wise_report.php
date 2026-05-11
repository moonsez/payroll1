<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<?php $user = $this->master_model->selectDetailsWhr("tbl_userinfo","user_id",$this->session->userdata("userid")); ?>
		<div class="row">
	   		<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<ul class="page-breadcrumb breadcrumb">
					
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>dashboard">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);">HR Compliance Report</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:void(0);">Year Wise Company Report</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN MAIN ROW CONTENT-->
		
		<!-- END MAIN ROW -->
		<div class="row">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<form action="get_year_wise_company_report" method="post">
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-calendar"></i>Year Wise Company Report
							</div>							
						</div>						
						<div class="portlet-body form">
						<!-- BEGIN FORM-->						
							<div class="form-body">							
								<div class="row">			
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">
												Select Company Name
												<span class="required" aria-required="true">*</span>
											</label>
											<select class="form-control select2me" name="c_id" >
												<option value="">Select</option>
												<?php if(isset($company_list) && !empty($company_list))
												{
													foreach ($company_list as $key) 
													{?>
														<option value="<?php echo $key['company_id']; ?>"><?php echo $key['company_name']; ?></option>
													<?php }
												}?>  
											</select>
										</div>
								 	</div>
								 	<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">
												Select Year
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="year" class="form-control select2me" id="year">
											    <?php
											    $currentYear = date('Y');
											    $startYear = $currentYear - 50;
											    $endYear = $currentYear + 50;

											    for ($i = $endYear; $i >= $startYear; $i--) 
											    {
											    ?>
											        <option value="<?php echo $i; ?>" <?php if ($i == $currentYear) echo 'selected'; ?>>
											            <?php echo $i; ?>
											        </option>
											    <?php } ?>
											</select>
										</div>
								 	</div>								 	
								</div>								
							</div>				
							<div class="form-actions">
								<center>
									<button type="submit" class="btn green get_year_wise_company_report">Submit</button>
									<button type="button" class="btn red clearData">Clear</button>
								</center>
							</div>											
					</div>				
					</div>
				</form>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>	
		
	</div>
</div>
<!-- END CONTENT -->
<!-- <script>
$(document).ready(function(){

    $('.get_year_wise_company_report').click(function(){

        let company_id = $('select[name="c_id"]').val();
        let year = $('#year').val();

        if(company_id == ''){
            alert('Please select company');
            return false;
        }

        if(year == ''){
            alert('Please select year');
            return false;
        }

        $.ajax({
            url: "<?php echo base_url('get_year_wise_company_report'); ?>",
            type: "POST",
            data: {
                c_id: company_id,
                year: year
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response){

                const url = window.URL.createObjectURL(response);
		        const a = document.createElement('a');
		        a.href = url;
		        a.download = "Year_Wise_Report.xls";
		        document.body.appendChild(a);
		        a.click();
		        a.remove();
            },
            error: function(){
                alert('Error while downloading report');
            }
        });

    });

});
</script> -->
<script>
$('.clearData').click(function(){
    $('select[name="c_id"]').val('').trigger('change');
    $('#year').val(new Date().getFullYear()).trigger('change');
});
</script>
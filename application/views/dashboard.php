<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">		
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<h3 class="page-title">
				Dashboard 
				</h3>
				<ul class="page-breadcrumb breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>					

					<li class="pull-right">
						<div id="" class="">
							<i class="fa fa-calendar"></i>
							<span><?php 
								date_default_timezone_set('Asia/Kolkata');
								echo date("l, j M Y, g:i A",time());
							?>								
							</span>								
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN DASHBOARD STATS -->
		<div class="row">
			<a href="<?php echo base_url();?>salary_slip_generate" class="load_page">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
								 
							</div>
							<div class="desc">
								 Pay Slip Generation
							</div>
						</div>
						<a class="more">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
			</a>
			<a href="<?php echo base_url();?>reprint_pay_slip" class="load_page">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="details">
							<div class="number">
								 
							</div>
							<div class="desc">
								 Reprint Previous Pay Slip
							</div>
						</div>
						<a class="more" >
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
			</a>
			<a href="<?php echo base_url();?>report_pay_slip" class="load_page">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="dashboard-stat purple-plum">
							<div class="visual">
								<i class="fa fa-globe"></i>
							</div>
							<div class="details">
								<div class="number">
									 
								</div>
								<div class="desc">
									 Salary Report
								</div>
							</div>
							<a class="more" >
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</a>
				</div>
			</a>
		</div>
		<!-- END DASHBOARD STATS -->
		<div class="clearfix">
		</div>
		<?php /*<div class="row">
			<div class="col-md-6 col-sm-6">
				<!-- BEGIN PORTLET-->
				<div class="portlet light ">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bar-chart font-green-sunglo"></i>
							<span class="caption-subject font-red-sunglo bold uppercase">Cost</span>
							<span class="caption-helper">by Company</span>
						</div>
					</div>
					<div class="portlet-body">
						<div id="site_statistics_loading">
							<img src="<?php echo base_url();?>assets/admin/layout/img/loading.gif" alt="loading"/>
						</div>
						<div id="site_statistics_content" class="display-none">
							<div id="site_statistics" class="chart" style="height: 280px;"></div>
						</div>
					</div>
				</div>
				<!-- END PORTLET-->
			</div>
			<div class="col-md-6 col-sm-6">
				<!-- BEGIN PORTLET-->
				<div class="portlet light ">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bar-chart font-green-sunglo"></i>
							<span class="caption-subject font-red-sunglo bold uppercase">Employee</span>
							<span class="caption-helper">Total Salary Distribution</span>
						</div>
					</div>
					<div class="portlet-body">
						<div id="site_activities_loading">
							<img src="<?php echo base_url();?>assets/admin/layout/img/loading.gif" alt="loading"/>
						</div>
						<div id="site_activities_content" class="display-none">
							<div id="site_activities" style="height: 280px;">
							</div>
						</div>
					</div>
				</div>
				<!-- END PORTLET-->
			</div>
		</div> */ ?>
	</div>
</div>
<!-- END CONTENT -->
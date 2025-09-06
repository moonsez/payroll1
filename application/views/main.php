<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title>Salary Slip | Dashboard</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->

	<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/> -->
	<link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url();?>assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php //echo base_url();?>assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php //echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/> -->

	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>

	<link href="<?php echo base_url();?>assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/select2/select2.css"/>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/global/plugins/data-tables/DT_bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE STYLES -->
	<link href="<?php echo base_url();?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="<?php echo base_url();?>assets/global/css/components.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo base_url();?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico"/>
	<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->
	<div class="page-header navbar navbar-fixed-top">
		<!-- BEGIN HEADER INNER -->
		<div class="page-header-inner">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="<?php echo base_url();?>dashboard">
				<img src="<?php echo base_url();?>assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>
				</a>
				<div class="menu-toggler sidebar-toggler hide">
					<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
				</div>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<div class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
			</div>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">				
					
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<?php /*<img alt="" class="img-circle" src="<?php echo base_url();?>images/logo/9030d4f8105887a3785880fc324ec08c.png"/>*/?>
						<span class="username">
						<?php echo ucfirst($this->session->userdata('user_name'));?> </span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li class="divider"></li>							
							<li>
								<a href="<?php echo base_url();?>logout">
								<i class="fa fa-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END HEADER INNER -->
	</div>
	<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<?php $this->load->view('sidebar_menu');?>

	<div class="changePageHtml">
		<?php date_default_timezone_set('Asia/kolkata');
		error_reporting(E_ALL);
		//ASSIGN VARIABLES TO USER INFO
		$time = date("M j G:i:s Y"); 
		$ip = getenv('REMOTE_ADDR');
		$userAgent = getenv('HTTP_USER_AGENT');
		$referrer = getenv('HTTP_REFERER');
		$query = getenv('QUERY_STRING');
		 
		//COMBINE VARS INTO OUR LOG ENTRY
		$msg = "IP:- " . $ip . "\r\nTIME:- " . $time . "\r\nREFERRER:- " . $referrer . "\r\nSEARCHSTRING:- " . $query . "\r\nUSERAGENT:- " . $userAgent. "\r\n";
		 
		//CALL OUR LOG FUNCTION
		//writeToLogFile($msg);
		 
//		function writeToLogFile($msg) {
//		     $today = date("Y_m_d");
//		     $logfile = $today."_log.txt";
//		     $dir = 'logs';
//		     $saveLocation=$dir . '/' . $logfile;
//		     if  (!$handle = @fopen($saveLocation, "a")) {
//		          exit;
//		     }
//		     else {
//		          if (@fwrite($handle,"$msg\r\n") === FALSE) {
//		               exit;
//		          }
//
//		          @fclose($handle);
//		     }
//		}?>
		<?php $this->load->view('dashboard');?>
	</div>	
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2017 &copy; Payslip.
	</div>
	<div class="page-footer-tools">
		<span class="go-top">
		<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<!--script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script-->
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo base_url();?>assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/lib/markdown.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-validation/lib/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/admin/pages/scripts/table-advanced.js"></script> 
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/form-validation.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/form-wizard.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/plugins.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/common.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/custom_v.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/custom_upload.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/tableHeadFixer.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() { 
   	Metronic.init();
   	Layout.init();
   	Index.init();
   	Demo.init();
   	TableAdvanced.init();
   	Index.initCalendar(); 
   	Index.initChat();
   	Index.initMiniCharts();   
   	Tasks.initDashboardWidget();
   	//TableAdvanced.init();

   	//1st graph
   	var tmp;
    $.ajax({
        url:completeURL('get_total_salary'),
        type:'post',
        data:'',
        dataType:'json',
        success:function(data)
        {
        	tmp = data;
        }
    });

    setTimeout(function(){
	    var visitors = tmp;
	   	/*var visitors = [
	        ['02/2013', 1500],
	        ['03/2013', 2600],
	        ['04/2013', 1200],
	        ['05/2013', 560],
	        ['06/2013', 2000],
	        ['07/2013', 2350],
	        ['08/2013', 1500],
	        ['09/2013', 4700],
	        ['10/2013', 1300],
	    ];*/

	    $('#site_statistics_loading').hide();
	    $('#site_statistics_content').show();

	    var plot_statistics = $.plot($("#site_statistics"),

	        [{
	            data: visitors,
	            lines: {
	                fill: 0.6,
	                lineWidth: 0,
	            },
	            color: ['#f89f9f']
	        }, {
	            data: visitors,
	            points: {
	                show: true,
	                fill: true,
	                radius: 5,
	                fillColor: "#f89f9f",
	                lineWidth: 3
	            },
	            color: '#fff',
	            shadowSize: 0
	        }, ],

	        {

	            xaxis: {
	                tickLength: 0,
	                tickDecimals: 0,
	                mode: "categories",
	                min: 0,
	                font: {
	                    lineHeight: 14,
	                    style: "normal",
	                    variant: "small-caps",
	                    color: "#6F7B8A"
	                }
	            },
	            yaxis: {
	                ticks: 5,
	                tickDecimals: 0,
	                tickColor: "#eee",
	                font: {
	                    lineHeight: 14,
	                    style: "normal",
	                    variant: "small-caps",
	                    color: "#6F7B8A"
	                }
	            },
	            grid: {
	                hoverable: true,
	                clickable: true,
	                tickColor: "#eee",
	                borderColor: "#eee",
	                borderWidth: 1
	            }
	        });

	    var previousPoint = null;
	    $("#site_statistics").bind("plothover", function (event, pos, item) {
	        $("#x").text(pos.x.toFixed(2));
	        $("#y").text(pos.y.toFixed(2));
	        if (item) {
	            if (previousPoint != item.dataIndex) {
	                previousPoint = item.dataIndex;

	                $("#tooltip").remove();
	                var x = item.datapoint[0].toFixed(2),
	                    y = item.datapoint[1].toFixed(2);

	                showChartTooltip(item.pageX, item.pageY, item.datapoint[0], '₹'+item.datapoint[1]);
	            }
	        } else {
	            $("#tooltip").remove();
	            previousPoint = null;
	        }
	    });
    }, 1000);
    /*SELECT MONTHNAME(STR_TO_DATE(SUBSTRING_INDEX(salary_month,'-',1),'%m')) AS Month_name, SUBSTRING_INDEX(salary_month,'-',1) AS mth_count, sum(net_pay) AS total FROM tbl_basic_pt as tle WHERE SUBSTRING_INDEX(salary_month,'-',-1)=YEAR(CURDATE()) GROUP BY Month_name order by mth_count*/
    //2nd graph
    var previousPoint2 = null;
    $('#site_activities_loading').hide();
    $('#site_activities_content').show();
    var emp;
    $.ajax({
        url:completeURL('get_total_emp'),
        type:'post',
        data:'',
        dataType:'json',
        success:function(data)
        {
        	emp = data;
        }
    });

    setTimeout(function(){
    var data1 = emp;

	    /*var data1 = [
	        ['DEC', 300],
	        ['JAN', 600],
	        ['FEB', 1100],
	        ['MAR', 1200],
	        ['APR', 860], 
	        ['MAY', 1200],
	        ['JUN', 1450],
	        ['JUL', 1800],
	        ['AUG', 1200],
	        ['SEP', 600],
	    ];*/

	    var plot_statistics = $.plot($("#site_activities"),

	        [{
	            data: data1,
	            lines: {
	                fill: 0.2,
	                lineWidth: 0,
	            },
	            color: ['#BAD9F5']
	        }, {
	            data: data1,
	            points: {
	                show: true,
	                fill: true,
	                radius: 4,
	                fillColor: "#9ACAE6",
	                lineWidth: 2
	            },
	            color: '#9ACAE6',
	            shadowSize: 1
	        }, {
	            data: data1,     
	            lines: { 
	                show: true, 
	                fill: false,
	                lineWidth: 3 
	            },                   
	            color: '#9ACAE6',
	            shadowSize: 0
	        } 
	        ],

	        {

	            xaxis: {
	                tickLength: 0,
	                tickDecimals: 0,
	                mode: "categories",
	                min: 0,
	                font: {
	                    lineHeight: 18,
	                    style: "normal",
	                    variant: "small-caps",
	                    color: "#6F7B8A"
	                }
	            },
	            yaxis: {
	                ticks: 5,
	                tickDecimals: 0,
	                tickColor: "#eee",
	                font: {
	                    lineHeight: 14,
	                    style: "normal",
	                    variant: "small-caps",
	                    color: "#6F7B8A"
	                }
	            },
	            grid: {
	                hoverable: true,
	                clickable: true,
	                tickColor: "#eee",
	                borderColor: "#eee",
	                borderWidth: 1
	            }
	        });

	    $("#site_activities").bind("plothover", function (event, pos, item) {
	        $("#x").text(pos.x.toFixed(2));
	        $("#y").text(pos.y.toFixed(2));
	        if (item) {
	            if (previousPoint2 != item.dataIndex) {
	                previousPoint2 = item.dataIndex;
	                $("#tooltip").remove();
	                var x = item.datapoint[0].toFixed(2),
	                    y = item.datapoint[1].toFixed(2);
	                showChartTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1]);
	            }
	        }
	    });
    }, 1000);

    $('#site_activities').bind("mouseleave", function () {
        $("#tooltip").remove();
    });

    function showChartTooltip(x, y, xValue, yValue) {
        $('<div id="tooltip" class="chart-tooltip">' + yValue + '<\/div>').css({
            position: 'absolute',
            display: 'none',
            top: y - 40,
            left: x - 40,
            border: '0px solid #ccc',
            padding: '2px 6px',
            'background-color': '#fff',
        }).appendTo("body").fadeIn(200);
    }

});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
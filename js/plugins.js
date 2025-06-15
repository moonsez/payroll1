
$(document).ready(function(){

	$(document).on('click','.load_page',function(event){
		event.preventDefault();
        var thisClass = $(this);
		var href_url=$(this).attr('href');
        thisClass.find('.imgloader').css('display','block');
		$.ajax({
			url:href_url,
			type:'POST',
			dataType:'html',
			success:function(data){
				//console.log(data);
				$('.changePageHtml').html(data);
			},
			complete:function(){				
				pluginPickers.init();
                FormWizard.init();
                thisClass.find('.imgloader').css('display','none');

                /*var jsfile = 'http://moonveda/FAMS/assets/global/plugins/jquery-validation/js/jquery.validate.min.js';
                var jsfile1 = 'http://moonveda/FAMS/assets/global/plugins/jquery-validation/js/additional-methods.min.js';
                $.getScript(jsfile);
                $.getScript(jsfile1);*/
			}
		});
	});

});


var  pluginPickers= function () {	

	var handleDatePickers = function () {
        if (jQuery().datepicker) {
            $('.datepicker').datepicker({
                rtl: Metronic.isRTL(),
                autoclose: true,
                format:'dd-mm-yyyy'                
            });
            $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }
    } 

    var handleBirthDatePickers = function () {
        if (jQuery().datepicker) {
            $('.birth_datepicker').datepicker({
                rtl: Metronic.isRTL(),
                autoclose: true,
                format:'dd-mm-yyyy',
                endDate:'-15y'
            });
            $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }
    }   

    var handleDatePickersMonth = function () {

        if (jQuery().datepicker) {
            $('.datepickerGeneral').datepicker({
                rtl: Metronic.isRTL(),
                autoclose: true,
                viewMode: 'months',
                minViewMode: 'months',
                format:'mm-yyyy',
                endDate:'+30d'
            });
            $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }
    }

    var handleDatePickersYear = function () {

        if (jQuery().datepicker) {
            $('.datepickerYear').datepicker({
                rtl: Metronic.isRTL(),
                autoclose: true,
                viewMode: 'years',
                minViewMode: 'years',
                format:'yyyy',
                endDate:'+30d'
            });
            $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }
    }

    // Handles Bootstrap Tooltips.
    var handleTooltips = function () {
       jQuery('.tooltips').tooltip();
    }

     // Handle Select2 Dropdowns
    var handleSelect2 = function() {
        if (jQuery().select2) {
            $('.select2me').select2({
                placeholder: "Select",
                allowClear: true
            });
        }
    }  

    var handleUniform = function () {
        if (!jQuery().uniform) {
            return;
        }
        var test = $("input[type=checkbox]:not(.toggle, .make-switch), input[type=radio]:not(.toggle, .star, .make-switch)");
        if (test.size() > 0) {
            test.each(function () {
                if ($(this).parents(".checker").size() == 0) {
                    $(this).show();
                    $(this).uniform();
                }
            });
        }
    }  

    var masterDataTable = function() {

        if (!jQuery().dataTable) {
            return;
        }

        $('.masterTable').dataTable({
            "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 5,
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records",
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [0] },
                { "bSearchable": false, "aTargets": [ 0 ] }
            ]
        });

        jQuery('.dataTables_wrapper .dataTables_filter input').addClass("form-control input-inline"); // modify table search input
        jQuery('.dataTables_wrapper .dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        jQuery('.dataTables_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
    }
   
	return {        
    	init: function () {
        	handleDatePickers(); 
            handleDatePickersMonth();
            handleDatePickersYear();
        	handleSelect2(); 
            handleUniform();   
            handleTooltips(); 
            masterDataTable(); 
            handleBirthDatePickers();     
    	}
	};

}();


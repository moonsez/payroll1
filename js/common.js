/*
Author : vishal
Work: All common funciton which needed for Pay Slip Projects
*/
$(document).ready(function(){


   
    

    $(document).on('change','#convey_allowance_type',function(){
        
        var selected_item = $(this).val();
        var val = "kilometer";
           if(selected_item == val){

            $('#km_basis').removeClass('hidden');
            $('#fixed_convey').addClass('hidden');
             
             $('.kmrate').attr('value','');
              $('.kmper').attr('value','');
        
         }else{
           $('#fixed_convey').removeClass('hidden');
           $('#km_basis').addClass('hidden');  
           $('.fix').attr('value','');
         }

       // alert(selected_item);
    });

    // Employee Advance Payment Details
    $(document).on('click','.fetch_emp_details', function(event){
        event.preventDefault();
        $('.fetch_emp_details').prop('disabled',true);
        var formId = '#'+$(this).parents('form').attr('id');
        var url = $(formId).attr('action');
        //var id = $(this).attr('rel');
        var serialize_data = $(formId).serialize();
        //serialize_data = serialize_data;

        $.ajax({
            url:completeURL(url),
            type:'post',
            data:serialize_data,
            dataType:'json',
            success:function(data)
            {
                $('#employeeAdvDetailsDiv').html(data.view);
            },
            complete:function()
            {
                $('.fetch_emp_details').removeAttr('disabled');
                var table = $('.masterTable');
                var oTable12 = table.dataTable({
                    "order": [
                        [1, 'asc']
                    ],
                    "columnDefs": [
                        { targets: 0, orderable: false }
                    ],
                    "lengthMenu": [
                        [5, 10, 15, -1],
                        [5, 10, 15, "All"] // change per page values here
                    ],

                    "pageLength": 10,


                });
                if($('.masterTable').parent('div').hasClass('table-scrollable'))
                {   
                    $('.masterTable').parent('div').removeClass('table-scrollable');
                }
                //table.css('width','100%');
                    //var tableWrapper = $('.dataTables_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper

                    //tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
                    jQuery('.dataTables_wrapper .dataTables_filter input').addClass("form-control input-inline"); // modify table search input
                    jQuery('.dataTables_wrapper .dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
                    jQuery('.dataTables_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
            }
        });

    });



    $(document).on('click','.generatePaySlip', function(event){
        event.preventDefault();
        $('.generatePaySlip').prop('disabled',true);
        var formId = '#'+$(this).parents('form').attr('id');
        var url = $(formId).attr('action');
        var id = $(this).attr('rel');
        var serialize_data = $(formId).serialize();
        serialize_data = serialize_data+"&id="+id;

        $.ajax({
            url:completeURL(url),
            type:'post',
            data:serialize_data,
            dataType:'json',
            success:function(data)
            {
                if(data.valid)
                {
                    window.location.href = data.url;
                }
            },
            complete:function()
            {
                $('.generatePaySlip').removeAttr('disabled');
            }
        });

    });

	$(document).on('click','.earning_checkbox', function()
    {
		var parentDivId = '#'+$(this).parents('.row').attr('id');   	
		if($(this).is(':checked'))
		{			
			$(parentDivId).find('.earning_allowance_input').removeClass('display-hide');
            $(parentDivId).find('.earning_allowance_input input[type="text"]').attr('name','earn_allowance_input[]');
            $(parentDivId).find('.earning_allowance_input select#convey_allowance_type').attr('name','earn_allowance_input[]');
		}
		else
		{
			$(parentDivId).find('.earning_allowance_input').addClass('display-hide');
			$(parentDivId).find('.earning_allowance_input input[type="text"]').attr('name','');
            $(parentDivId).find('.earning_allowance_input select#convey_allowance_type').attr('name','');
            $('#km_basis').addClass('hidden');
            $('#fixed_convey').addClass('hidden');
		}
	});
   
	$(document).on('click','.deduction_checkbox', function(){

		var parentDivId = '#'+$(this).parents('.row').attr('id');		
		if($(this).is(':checked'))
		{			
			$(parentDivId).find('.deduction_allowance_input').removeClass('display-hide');
			$(parentDivId).find('.deduction_allowance_input input[type="text"]').attr('name','deduction_allowance_input[]');
		}
		else
		{
			$(parentDivId).find('.deduction_allowance_input').addClass('display-hide');
			$(parentDivId).find('.deduction_allowance_input input[type="text"]').attr('name','');
		}		
	});
	
	
	$(document).on('click','ul.page-sidebar-menu>li',function(){
		$(this).siblings('li').removeClass("active");
		$(this).siblings('li').find('a').removeClass('selected');
		$(this).addClass("active");
		$(this).find('a').append('<span class="selected"></span>');
	});

	$(document).on('click','ul.sub-menu>li',function(){
		$(this).siblings('li').removeClass('open');
		$(this).addClass('open');		
	});

	 


	/************************ State and City Dynamically ****************************/

	$(document).on('change','.pre_country',function(){    
	    var c_id = $(this).val();
	    
	    $.ajax({
	        type:'POST',
	        url:completeURL('fetchAllStateByCountry'),
	        data:"cid="+c_id,
	        dataType:'json',
	        success:function(data)
	        {            
	            $('.pre_state_html').html(data);
	        },
	        complete:function()
	        {
	        	//$("select.select2me").select2('destroy'); 
	            $('select').select2();
	        }
	    }); 
	});

    //employyee by company name

    $(document).on('change','.pre_company',function(){    
        var id = $(this).val();
        
        $.ajax({
            type:'POST',
            url:completeURL('fetch_by_company_empName'),
            data:"id="+id,
            dataType:'json',
            success:function(data)
            {            
                $('.pre_comp_html').html(data);
            },
            complete:function()
            {
                //$("select.select2me").select2('destroy'); 
                $('select').select2();
            }
        }); 
    });

    $(document).on('change','.pre_company1',function(){    
        var id = $(this).val();
        
        $.ajax({
            type:'POST',
            url:completeURL('fetch_by_company_empName1'),
            data:"id="+id,
            dataType:'json',
            success:function(data)
            {            
                $('.pre_comp_html').html(data);
            },
            complete:function()
            {
                //$("select.select2me").select2('destroy'); 
                $('select').select2();
            }
        }); 
    });

    $(document).on('change','.emp_company',function(){    
        var id = $(this).val();
        $.ajax({
            type:'POST',
            url:completeURL('fetch_emp_by_company'),
            data:"id="+id,
            dataType:'json',
            success:function(data)
            {         
                $('.company_employee').html(data);
            },
            complete:function()
            {
                $('select').select2();
            }
        }); 
    });

    $(document).on('change','.emp_allowance',function(){    
        var id = $(this).val();
        $.ajax({
            type:'POST',
            url:completeURL('fetch_allowance_by_emp'),
            data:"id="+id,
            dataType:'json',
            success:function(data)
            {         
                $('.ear_allowance').html(data.earning);
                $('.ded_allowance').html(data.deduction);
            },
            complete:function()
            {
                $('select').select2();
            }
        }); 
    });

    $(document).on('change','.getempDetails',function(){    
        var id = $(this).val();
        
        $.ajax({
            type:'POST',
            url:completeURL('fetchAdminData'),
            data:"id="+id,
            dataType:'json',
            success:function(data)
            {            
                
               $('#employeeDetailsDiv').html(data);
                //$('.pre_comp_html').html(data);
            },
            complete:function()
            {
                //$("select.select2me").select2('destroy'); 
                $('select').select2();
            }
        }); 
    });


    $(document).on('change','.pre_country',function(){    
        var c_id = $(this).val();
        
        $.ajax({
            type:'POST',
            url:completeURL('fetchAllStateByCountry'),
            data:"cid="+c_id,
            dataType:'json',
            success:function(data)
            {            
                $('.pre_state_html').html(data);
            },
            complete:function()
            {
                //$("select.select2me").select2('destroy'); 
                $('select').select2();
            }
        }); 
    });

	$(document).on('change','.pre_state',function(){
	    var s_id = $(this).val();
	    
	    $.ajax({
	        type:'POST',
	        url:completeURL('fetchAllCityByState'),
	        data:"sid="+s_id,
	        dataType:'json',
	        success:function(data)
	        {            
	            $('.pre_city').html(data);
	        },
	        complete:function()
	        {
	            /*$('.select2me').select2({
	                placeholder: "Select",
	                allowClear: true
	            });*/
	    		$('select').select2();
	        }
	    });
	});
    
    $(document).on('blur','.earning_dynamic',function(){

        var total=0;

        $('.earning_dynamic').each(function(){
            var earn_amt = $(this).val()*1;
            total = earn_amt+total;    
        }); 

        total = total.toFixed(2);   
        
        $(':input[name="earn_total"]').val(total);
        var deduction_amt = $(':input[name="deduct_total"]').val()*1;
        var net_pay = total-deduction_amt;
        net_pay = net_pay.toFixed(2);
        $(':input[name="total_pay"]').val(net_pay);    

    });
    
    $(document).on('blur','.deduction_dynamic',function(){

        var sum=0;
        $('.deduction_dynamic').each(function(){
            var dect_amt = $(this).val()*1;
            sum = dect_amt+sum;              
        }); 

        sum = sum.toFixed(2);   
        $(':input[name="deduct_total"]').val(sum);
        var earn_amt = $(':input[name="earn_total"]').val()*1;
        var net_pay1 = earn_amt-sum;
        net_pay1 = net_pay1.toFixed(2);
        $(':input[name="total_pay"]').val(net_pay1); 
         
        });

    $(document).on('blur','.recovery',function(){

        var rec = $('.recovery').val()*1; 
        $('.deduction_dynamic1').val(rec);
        var open = $('.openinghiden').val();
        var close=0;
        close = open - rec;
        $('.closeing').val(close);
         open = 0;
        
        }); 

        

    
 


	$(document).on('click','.diff_common_save', function(){		

		var form = '#'+$(this).parents('form').attr('id');
		//alert(form);		
        var error = $('.alert-danger', form);
        var success = $('.alert-success', form);

      	$(form).validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {                
                employee_name:{
                	required : true
                },
                desig_id:{
                	required : true
                },
                pan_no:{
                	required : true,
                },
                date_of_joining:{
                	required : true
                },
                employee_id:{
                	required : true
                },
                basic: {
    					required : true
    			}, 
                country_name: {
                        lettersonly :true
                },
    			/*earning_name:{
    					required:true
    			},
    			deduction_name:{
    					required:true
    			},*/    			          
            },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success.hide();
                error.show();
                Metronic.scrollTo(error, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var icon = $(element).parent('.input-icon').children('i');
                icon.removeClass('fa-check').addClass("fa-warning");  
                icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
            },

            unhighlight: function (element) { // revert the change done by hightlight
                
            },

            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                icon.removeClass("fa-warning").addClass("fa-check");
            },

            submitHandler: function (form) {
                //success.show();
                //error.hide();

                $('.diff_common_save').prop('disabled',true);
                var url = $(form).attr('action');
                var tbDiv = $(form).data('tbdiv');
                var tbUrl = $(form).data('tburl');
                var id = $(form).find('.diff_common_save').attr('rel');
                var serialize_data = $(form).serialize();				
				serialize_data = serialize_data+"&id="+id;

                $.ajax({
					type:'POST',
					url:completeURL(url),
					dataType:'json',
					data:serialize_data,
					success:function(data)
					{
						bootbox.alert(data.msg, function() {
							//Example.show("Hello world callback");
							resetForm(form); 
							//refreshTable(tbDiv,tbUrl);  
							setTimeout(function(){								
								$('.diff_common_save').removeAttr('disabled');	
								$('.diff_common_save').text('Submit');
								$('.diff_common_save').attr('rel','0');									
							},2000);
						});			
					}
				});
            }
        });

		//apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
        $('.select2me', form).change(function () {
            $(form).validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

	});

	$(document).on('click','.common_save', function(){		

		var form = '#'+$(this).parents('form').attr('id');
		//alert(form);		
        var error = $('.alert-danger', form);
        var success = $('.alert-success', form);


      	$(form).validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                country_name: { 
                    required:true,
                     letterswithspecialsymbol :true                                      
                },
                
                state_coun_name: {                    
                     required:true                    
                },
                state_name: {
                    required:true,                    
                    letterswithspecialsymbol: true                     
                },
                city_coun_name: {
                	required : true
                },
                city_state_name: {
                	required : true
                },
                city_name: {
                	required : true,
                    letterswithspecialsymbol:true
                }, 
                employee_name:{
                    required:true,
                	
                }, 
                /*desig_id:{
                	integer : true
                },*/
                /*employee_id:{
                    required : true,
                                   	
                },*/
                bank_acc_no: {
                   integer : true
                },
                pan_no: {
                    pancard : true
                },
                basic: {
                    required : true,
                    integer : true
                },
                fixed_per: {
                    required : true,
                    integer : true
                },
                /*var_per: {
                    required : true,
                    integer : true
                },*/
                /*location:{
                    required : true,
                    //letterswithspecialsymbol:true
                },*/
                gender:{
                    required : true
                },
                company_name: {
    					required : true,
                        letterswithspecialsymbol:true
    			},
                company_address: {
    					required : true,
                        letterswithspecialsymbol:true
    			},
    			earning_name:{
    					required:true,
                        letterswithspecialsymbol:true
    			},
    			deduction_name:{
    					required:true,
                        letterswithspecialsymbol:true
    			},
    			date_of_joining:{
    					required:true

    			},
                desig_name:{
                    required:true,
                    letterswithspecialsymbol:true
                },
    			/*desig_id: {
    				    required:true
    			},*/
                unit: {
                        required:true
                },
                earning_default_value: {
                        required:true                        
                },
                earning_code: {
                         letterswithspecialsymbol:true
                },
                deduction_code: {
                         letterswithspecialsymbol:true
                 },
                deduction_unit: {
                        required:true
                },
                deduction_default_value: {
                        required:true
                },
                amount: {
                        required : true,
                        integer : true
                },
                advance_date: {
                        required : true
                },
                emp_name: {
                        required : true
                },
            },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success.hide();
                error.show();
                Metronic.scrollTo(error, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var icon = $(element).parent('.input-icon').children('i');
                icon.removeClass('fa-check').addClass("fa-warning");  
                icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
            },

            unhighlight: function (element) { // revert the change done by hightlight
            },

            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                icon.removeClass("fa-warning").addClass("fa-check");
            },

            submitHandler: function (form) {
                //success.show();
                //error.hide();

                $('.common_save').prop('disabled',true);
                var url = $(form).attr('action');
                var tbDiv = $(form).data('tbdiv');
                var tbUrl = $(form).data('tburl');
                var id = $(form).find('.common_save').attr('rel');
                var serialize_data = $(form).serialize();				
				serialize_data = serialize_data+"&id="+id;

                $.ajax({
					type:'POST',
					url:completeURL(url),
					dataType:'json',
					data:serialize_data,
					success:function(data)
					{
						bootbox.alert(data.msg, function() {
							//Example.show("Hello world callback");
							resetForm(form); 
							refreshTable(tbDiv,tbUrl);  
							setTimeout(function(){								
								$('.common_save').removeAttr('disabled');	
								$('.common_save').text('Submit');
								$('.common_save').attr('rel','0');									
							},2000);
						});			
					}
				});
            }
        });

		//apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
        $('.select2me', form).change(function () {
            $(form).validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

	  });
	
	$(document).on('click','.editRecord', function(){

		id = $(this).attr('rel');
		var url = $(this).attr('rev');

		$.ajax({
			url : completeURL(url),
			type : 'POST',
			dataType : 'html',
			data:"id="+id,
			success:function(data)
			{
				$('.changePageHtml').html(data);
                //$('#fixed_convey').removeClass('hidden');
			},
			complete: function()
			{
				pluginPickers.init();				
				$('html, body').animate({scrollTop:0});
			}
		});

	});

  /*  $(document).on('click','.viewRecord', function(){

        id = $(this).attr('rel');
        var url = $(this).attr('rev');

        $.ajax({
            url : completeURL(url),
            type : 'POST',
            dataType : 'html',
            data:"id="+id,
            success:function(data)
            {
                $('.changePageHtml').html(data);
            },
            complete: function()
            {
                pluginPickers.init();               
                $('html, body').animate({scrollTop:0});
            }
        });

    }); */

	$(document).on('click','.deleteRecord' , function(){

		var deleteDiv = $(this);


		bootbox.confirm("Are you sure?", function(result) {

			if(result)
			{
				var id = deleteDiv.attr('rel');
				var url = deleteDiv.attr('rev');
				var tbDiv = deleteDiv.data('tbdiv');				
				var tbUrl = deleteDiv.data('tburl');

				$.ajax({
					url : completeURL(url),
					type:'POST',
					dataType:'json',
					data: "id="+id,
					success:function(data)
					{
						bootbox.alert(data.msg, function() {				
							refreshTable(tbDiv,tbUrl);							
						});	
					},
					complete:function()
					{

					}

				});
							
				//refreshTable(tbDiv,tbUrl);
			}
			else
			{
				
			}
		
		}); 

	});	


	$(".only_number").live('keypress',function(event) {
	    
	    var a = [];
	    var k = event.which;
	    a.push(0);
	    a.push(8);
	    for (i = 48; i < 58; i++)
	        a.push(i);
	    
	    if (!(a.indexOf(k)>=0))
	        event.preventDefault();	 
	    $(this).text('KeyCode: '+k); 
	});

	$(".only_text").live('keypress',function(event) {  
	    
	    var k = event.which;
	    if(k>48 && k<58)
	    {
	        event.preventDefault();             
	    }	  
	});
  
    
    $(document).on('keypress','.txtpaymentamnt', function (event) {
        //alert(e.which);
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) ) 
        {
            if (event.keyCode !== 8 && event.keyCode !== 46 ){ //exception
                event.preventDefault();
            }
        }
        if(($(this).val().indexOf('.') != -1) && ($(this).val().substring($(this).val().indexOf('.'),$(this).val().indexOf('.').length).length>2 ))
        {
            if (event.keyCode !== 8 && event.keyCode !== 46 ){ //exception
                event.preventDefault();
            }
        }
    });
    

	$(".only_price").live('keypress',function(event) {  
	       
       	var a = [];
        var k = event.which;
        a.push(0);
        a.push(8);
        a.push(46);
        for (i = 48; i < 58; i++)
            a.push(i);
        
        if (!(a.indexOf(k)>=0))
        {
           event.preventDefault();  
        }
	});

	$(document).on('click','.clearData', function(){

		var formId = '#'+$(this).parents('form').attr('id');
		//alert(formId);
		$(formId).find('input:text, input:password, input:file, textarea, select').val('');
		$(formId).find('input:checkbox').removeAttr('checked').removeAttr('selected');
	    $(formId).find('.select2-container').select2('val','0');
	});

     $(document).on('change','.var_per, .var_amount',function(){
        
        var var_per = $(this).closest('tr').find('.var_per').val();
        var var_amount = $(this).closest('tr').find('.var_amount').val();
        var var_amount_hidden = $(this).closest('tr').find('.var_amount_hidden').val();
        if($(this).hasClass('var_per')){
            let amt = (var_amount_hidden*var_per/100).toFixed(2);
            $(this).closest('tr').find('.var_amount').val(amt);
        }else{
            let per = ((var_amount/var_amount_hidden)*100).toFixed(2);
            $(this).closest('tr').find('.var_per').val(per);
        }
       
    });

    $(document).on('click','.all_var_amount_submit',function(){
        $('.varTable tbody tr').each(function(){

        var var_per = $('.all_var_amount').val();
        $(this).closest('tr').find('.var_per').val(var_per);
        var var_amount_hidden = $(this).find('.var_amount_hidden').val();
            let amt = (var_amount_hidden*var_per/100).toFixed(2);
            $(this).find('.var_amount').val(amt);

        });
       
    });


});

/******************** End document ready function *******************/

/****************************** refresh table ***********************/
function refreshTable(divId, url)
{    
    $.ajax({
        url:completeURL(url),
        dataType : 'html',
        type : 'POST',
        success:function(data)
        {    
            $(divId).html(data); 
            $(".tooltips").tooltip({placement: 'top', trigger: 'hover'});                  
        },
        complete:function()
        {
            if($(".masterTable").length > 0)
		    {
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

            //$('select').select2();

            /*$('.table.masterTable').each(function(){                
                var tableFooter = $(this).next('div').find('div').attr('id');
                $('#'+tableFooter).removeClass('dataTables_filter').addClass('dataTables_length').css('margin-right','16.2%');
            }); */          
        }
    });     
}

/*Start of Reset Form*/
function resetForm(id) 
{
	$(id).find('input:text, input:password, input:file, textarea, select').val('');
	//$(id).find('input:checkbox').removeAttr('checked').removeAttr('selected');
    $(id).find('input:checkbox').prop('checked', false).uniform(); 
    $(id).find('.select2-container').select2('val','');
    //$.uniform.restore(':checkbox');
    //$(":checkbox").uniform();
}
/*End of reset form*/

function getCookie(key) 
{  
   var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');  
   return keyValue ? keyValue[2] : null;  
} 

function replaceurl(url)
{
	var url1=url.replace("%3A",":");
	var url2=url1.replace(/%2F/g,"/");  
	return url2;
}	

function completeURL(url)
{
	try
	{
		var target=	getCookie('pay_slip')+url;
		target=replaceurl(target);
		return replaceurl(target);		
	}
	catch(e)
	{
		alert(e);
	}

}  
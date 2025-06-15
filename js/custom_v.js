/*
Author : vishal
Work: All common funciton which needed for Pay Slip Projects
*/
$(document).ready(function()
{
    

    $(document).on('click','.companySave',function(){		

    		var form = '#'+ $(this).parents('form').attr('id');    				
            var error2 = $('.alert-danger', form);
            var success2 = $('.alert-success', form);


            $(form).validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
    				company_name: {
    					required : true
    				},
    				company_address: {
    					required : true 
    				},
                    company_country: {
                        required : true
                    },
                    company_state : {
                        required : true
                    },
                    company_city : {
                        required : true
                    },
                    company_pincode : {
                        required : true
                    },
                    company_login : {
                        required : true
                    },
                    company_password : {
                        required : true
                    },
                    emp_name : {
                        required : true
                    },
                    month : {
                        required : true
                    },
                    no_of_day : {
                        required : true
                    }
    			},
                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success2.hide();
                    error2.show();
                    Metronic.scrollTo(error2, -200);
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
                    //success2.show();
                    //error2.hide();
                    $('.companySave').prop('disabled',true);
                    var url = $(form).attr('action');
                    var tbDiv = $(form).data('tbdiv');
                    var tbUrl = $(form).data('tburl');
                    var id = $(form).find('.companySave').attr('rel');
                    //var serialize_data = $(form).serialize();               
                    //serialize_data = serialize_data+"&id="+id;                    

                    $(form).ajaxSubmit({
                    	type:'POST',
                        url:completeURL(url),
                        dataType:'json',
                        data:{id:id},
                    	success: function(data)
                    	{
                            bootbox.alert(data.msg, function() {                            
                            resetForm(form); 
                            refreshTable(tbDiv,tbUrl);  
                            setTimeout(function(){                              
                                $('.companySave').removeAttr('disabled');   
                                $('.companySave').text('Submit');
                                $('.companySave').attr('rel','0');                                  
                            },2000);
                        }); 
                    		
                    	}
                    });
                }
            });

    });

    $(document).on('change','.slip_emp_name',function() {
       
        var url="fetch_by_employee_name";
        var id=$(this).val();
         
       
        var data={id:id};
        $.ajax({
                    url:completeURL(url),
                    data:data,
                    type:'POST',
                    dataType:'json',
                    success:function(data)
                    {  
                        $('#design_name').val(data.desig_name);
                        
                        if(data.prev_amt > 0)
                        {
                            $('#prev_adv').css('display','block');
                            $('.prev_amount').val(data.prev_amt);
                            $('.prev_advance_date').val(data.prev_date);
                        }

                    }

                });
    });


    $(document).on('change','.getempData',function() {       
        var url="fetch_all_employee_data";
        var id=$(this).val();      
        var comp_id=$('#comyid').val();      
        var data={id:id,comp_id:comp_id};
        $.ajax({
                url:completeURL(url),
                data:data,
                type:'POST',
                dataType:'json',
                success:function(data)
                {  
                    $('#desig_id').val(data.desig_name);
                    $('#employee_id').val(data.emp_code);
                    $('#date_of_birth').val(data.dob);
                    $('#date_of_joining').val(data.dog);
                    $('#email_id').val(data.email);
                    $('#pan_no').val(data.pan);
                    $('#gender').val(data.gender);
                    $('#local_address').val(data.local_address);
                    $('#permanent_address').val(data.permanent_address);
                    $('#user_id').val(data.user_id);
                }
            });
    });
        //commonAjaxJson(url,data,content)
 
    $(document).on('click','.changePass',function(){       

            var form = '#'+ $(this).parents('form').attr('id');                 
            var error2 = $('.alert-danger', form);
            var success2 = $('.alert-success', form);


            $(form).validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input 
                rules: {
                    new_password: {
                        minlength: 5,
                        required: true
                    },
                    confirm_password: {
                        minlength: 5,
                        required: true,
                        equalTo: "#new_password"
                    },
                    oldPassword: {
                        minlength: 5,
                        required: true                        
                    },
                comp_id: {
                    required: true
                } 
                },
                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success2.hide();
                    error2.show();
                    Metronic.scrollTo(error2, -200);
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
                    //success2.show();
                    //error2.hide();
                    $('.changePass').prop('disabled',true);
                    var url = $(form).attr('action');                    
                    var serialize_data = $(form).serialize();                                    

                    $(form).ajaxSubmit({
                        type:'POST',
                        url:completeURL(url),
                        dataType:'json',
                        data:serialize_data,
                        success: function(data)
                        {
                            bootbox.alert(data.msg, function() {                            
                            resetForm(form);                             
                            setTimeout(function(){                              
                                $('.changePass').removeAttr('disabled');                                                                   
                            },2000);
                        }); 
                            
                        }
                    });
                }
            });

    });

    /****************** Slip Generate Data **********************************/

    $(document).on('click','.slipGenerate', function(){      

        var form = '#'+$(this).parents('form').attr('id');
        //alert(form);      
        var error = $('.alert-danger', form);
        var success = $('.alert-success', form);


        $(form).validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input  required: true, month_decimal:true                                                   
            ignore: "",  // validate all fields including form hidden input
            rules: {
                slip_emp_name: {                    
                    required: true                     
                },
                slip_months: {                    
                    required: true
                                         
                },
                no_of_day: {                    
                    required: true,
                    month_decimal:true                                       
                },
                comp_id: {
                    required: true
                }                
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

                $('.slipGenerate').prop('disabled',true);
                var url = $(form).attr('action');                
                var serialize_data = $(form).serialize();              

                $.ajax({
                    type:'POST',
                    url:completeURL(url),
                    dataType:'html',
                    data:serialize_data,
                    success:function(data)
                    {
                        //resetForm(form); 
                        $('#salaryGeneratePreview').html(data);
                    },
                    complete:function()
                    {                                                     
                        setTimeout(function(){                              
                            $('.slipGenerate').removeAttr('disabled');                                
                        },2000);
                    }
                });
            }
        });

        //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
        $('.select2me', form).change(function () {
            $(form).validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

    });

    $(document).on('click','.fetch_salaryslip_list', function(){      

        var form = '#'+$(this).parents('form').attr('id');
        //alert(form);      
        var error = $('.alert-danger', form);
        var success = $('.alert-success', form);


        $(form).validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input  required: true, month_decimal:true                                                   
            ignore: "",  // validate all fields including form hidden input
            rules: {
                slip_emp_name: {                    
                    required: true                     
                },
                slip_months: {                    
                    required: true
                                         
                },
                no_of_day: {                    
                    required: true,
                    month_decimal:true                                       
                },
                comp_id: {
                    required: true
                }                
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

                $('.fetch_salaryslip_list').prop('disabled',true);
                var url = $(form).attr('action');                
                var serialize_data = $(form).serialize();              

                $.ajax({
                    type:'POST',
                    url:completeURL(url),
                    dataType:'html',
                    data:serialize_data,
                    success:function(data)
                    {
                        //resetForm(form); 
                        $('#emp_salaryslip_list').html(data);
                    },
                    complete:function()
                    {                                                     
                        setTimeout(function(){                              
                            $('.fetch_salaryslip_list').removeAttr('disabled');                                
                        },2000);
                    }
                });
            }
        });

        //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
        $('.select2me', form).change(function () {
            $(form).validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

    });

    $(document).on('click','.updatestatus', function(){
        
        var emp_id = $('.select_opt:checked').map(function() {return this.value;}).get().join(',');
        var comp_id = $('.com_id').map(function() {return this.value;}).get().join(',');
        var month = $('.month').val();
        
        $.ajax({
            url : completeURL('update_salaryslip_status'),
            type : 'POST',
            dataType : 'json',
            data:{emp_id:emp_id,comp_id:comp_id,month:month},
            success:function(data)
            {
                bootbox.alert(data.msg, function() {
                    window.location.href=window.location.href;
                });
            },
            complete: function()
            {
               
            }
        });

    });

    

    $(document).on('click','.approveExpenditureReport', function(){
        var month = $(this).attr('data-month');
        var comp_id = $(this).attr('data-company_id');
      bootbox.confirm("Are you sure you want to approve?", function(result) {
        if(result)
        {
            
            
            $.ajax({
                url : completeURL('approveExpenditureReport'),
                type : 'POST',
                dataType : 'json',
                data:{comp_id:comp_id,month:month},
                success:function(data)
                {
                    bootbox.alert(data.msg, function() {
                        
                    });
                },
                complete: function()
                {
                   
                }
            });
        }
        });
    });



    $(document).on('click', '.select_all', function() {

        if($(this).is(':checked'))
        {           
            $('.select_opt').attr("checked",true);
            //$.uniform.update();            
        }
        else
        {           
            $('.select_opt').attr("checked",false);
            //$.uniform.update();
        }

    });

    $(document).on('click','.reprintSlipGenerate', function(){      

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
                reprint_slip_months: {                    
                    required: true                     
                },
                comp_id: {
                    required: true
                }                              
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

                $('.reprintSlipGenerate').prop('disabled',true);
                var url = $(form).attr('action');                
                var serialize_data = $(form).serialize();              

                $.ajax({
                    type:'POST',
                    url:completeURL(url),
                    dataType:'html',
                    data:serialize_data,
                    success:function(data)
                    {
                        //resetForm(form); 
                        $('#reprintSalaryGeneratePreview').html(data);
                    },
                    complete:function()
                    {  
                        //pluginPickers.init(); 
                        // $('.select2me').select2();                                                  
                        setTimeout(function(){                              
                            $('.reprintSlipGenerate').removeAttr('disabled');                                
                        },2000);
                    }
                });
            }
        });

        //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
        $('.select2me', form).change(function () {
            $(form).validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

    });

     $(document).on('click','.reprint',function(event){
            event.preventDefault();
            var rev = $(this).attr('rel');
            var id =$(this).attr('rev');
           
            var href_url=$(this).data('tburl');
          
         
            $.ajax({
                url:href_url,
                type:'POST',
                dataType:'html',
                data:{id:id,rev:rev},
                success:function(data){                    
                    $('#reprintSalaryGeneratePreview').html(data);
                },
                complete:function(){                
                    pluginPickers.init();
                },
            });
        });



        $(document).on('click','.editEmpCreation',function(){
            
        id = $(this).attr('rel');
        var url=$(this).attr('rev');
        $.ajax({
            url:completeURL(url),           
            type:'POST',
            dataType:'json',
            data:"id="+id,
            success: function(data)
            {                
                var dialog = bootbox.dialog({
                    message: data.view,
                    title: "Salary Info",
                    buttons: 
                    {
                        danger: {
                            label: "Back",
                            className: "green",
                            callback: function() {
                                // Example.show("uh oh, look out!");
                            }
                        }                   
                    }
                });
            },
            complete: function()
            {
               
            }
        });
    });

    // for report UX report
    $(document).on('change','#report_type',function(){
        var typeEmp = $(this).val();
        if( typeEmp == 'single_emp'){
            
            if(!$().hasClass('hide')){

            $('.emp').removeClass('hide');

            }
        }else{
            $('.emp').addClass('hide');
            $('#slip_emp_name').val('0');
        }

    }); 

     $(document).on('click','.reportGenerate', function(){      

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
                
                slip_months: {                    
                    required: true
                                         
                },
                report_type: {
                    required: true
                },
                comp_id: {
                    required: true
                }                
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

                $('.reportGenerate').prop('disabled',true);
                var url = $(form).attr('action');                
                var serialize_data = $(form).serialize();              

                $.ajax({
                    type:'POST',
                    url:completeURL(url),
                    dataType:'html',
                    data:serialize_data,
                    success:function(data)
                    {
                        //resetForm(form); 
                        $('#employeeDetailsDiv').html(data);
                    },
                    complete:function()
                    {                                                     
                        setTimeout(function(){                              
                            $('.reportGenerate').removeAttr('disabled');                                
                        },2000);
                    }
                });
            }
        });
    });
    
     $(document).on('blur','.days',function(){
        
        var rel = $(this).attr('rel');
        var hra_type  = $('.hra'+rel).attr('rel');
        var no_day_sal = $(this).val()*1;

        var ba_val = $('.basic_val'+rel).val()*1;
        var Allowance = $('.Allowance'+rel).val()*1;
        
        var mob = $('.mobile_allowance'+rel).val()*1;
        

        var bonus = $('.bonus'+rel).val()*1;
        var advance_deduct = $('.advance_deduct'+rel).val()*1;
        var advance = $('.advance'+rel).val()*1;
        var advAddition_val = $('.advAddition_val'+rel).val()*1;
        var special_allowance = $('.special_allowance'+rel).val()*1;
        var pf_earn = $('.pf_earn'+rel).val()*1;
        var ESIC_earn = $('.ESIC_earn'+rel).val()*1;

        if (isNaN(mob)) {
            mob=0;
        }
        if (isNaN(advAddition_val)) {
            advAddition_val=0;
        }
        if (isNaN(advrecovery_val)) {
            advrecovery_val=0;
        }  
        if (isNaN(bonus)) {
            bonus=0;
        }
        if (isNaN(advance)) {
            advance=0;
        }
        if (isNaN(advance_deduct)) {
            advance_deduct=0;
        }

       
        var num_of_day_inMonth = $('.num_of_day_inMonth').val()*1;
        var all_total=0;
        var ba_val_perday = ba_val/num_of_day_inMonth
        var final_basic = ba_val_perday*no_day_sal;
       
        if(no_day_sal!=''){          
        
        var Hra = $('.hra'+rel).val()*1;
        var holiday = $('.holiday').val()*1;
        var sunday = $('.sundays').val()*1;
        var varry_days = holiday+sunday;
        var convey_rel_type = $('.convey'+rel).attr('rel');
        var convey = $('.convey'+rel).val()*1;
        
        var advrecovery_val = $('.advrecovery_val'+rel).val()*1;
        //alert(convey);
       // var per_day_val =  ba_val/$('.num_of_day_inMonth').val()*1;
        var sal_amt = final_basic;//per_day_val * no_day_sal;
        $('.basicAmt'+rel).val(sal_amt); 
        var pt_val =$('.pt_val'+rel).val()*1;
        var earn_arrears = $('.earn_arrears'+rel).val()*1;
        var mobile_deduction = $('.mobile_deduction'+rel).val()*1;
        var other_deduct = $('.other_deduct'+rel).val()*1;
        
        var pf_ded = $('.pf_deduct'+rel).val()*1;
        var pf_val = pf_ded/num_of_day_inMonth;
        var pf_deduct = pf_val*no_day_sal;
        
        var ESIC_ded = $('.ESIC_deduct'+rel).val()*1;
        var esic_val = ESIC_ded/num_of_day_inMonth;
        var ESIC_deduct = esic_val*no_day_sal;


        if (convey_rel_type=='kilometer') {
            //alert("if inside");
            var convey_no_day_sal = Math.round(no_day_sal);
             
            var total_convey = (convey)*(convey_no_day_sal-varry_days);            
            //alert(total_convey);
            all_total = Math.round(all_total+total_convey);
            $('.convey'+rel).val(Math.round(total_convey));
            var hra_val = Hra/num_of_day_inMonth;

            if (hra_type=='fixed_hra') {
                
                $('.hra'+rel).val(Math.round(Hra));
                all_total = (all_total)+(Hra);
            }else{
                $('.hra'+rel).val(Math.round(hra_val*no_day_sal));
               // all_total = (all_total)+(hra_val*no_day_sal);
                all_total = (all_total)+(hra_val*no_day_sal);
                 $('.hra'+rel).val(Math.round(hra_val*no_day_sal));
            }
           // $('.hra'+rel).val(Hra);
        }else{
            //alert("else inside");  
            var convey_val = convey/num_of_day_inMonth;
            var hra_val = Hra/num_of_day_inMonth;    

            all_total = all_total+(convey_val*no_day_sal); 
            $('.convey'+rel).val(Math.round(all_total));
           
            if (hra_type=='fixed_hra') {
                $('.hra'+rel).val(Math.round(Hra));
                all_total = (all_total)+(Hra);
            }else{
                $('.hra'+rel).val(Math.round(hra_val*no_day_sal));
                all_total = (all_total)+(hra_val*no_day_sal);
            }   
        }

        //mobile allowance
        var mob_val = mob/num_of_day_inMonth;
        var mobile_al = mob_val*no_day_sal;
         
        var Allowance_cal = Allowance/num_of_day_inMonth;
        var allow_total = Allowance_cal*no_day_sal;
        
        all_total = all_total+allow_total;
        
        var sp = special_allowance/num_of_day_inMonth;
        var sp_total = sp*no_day_sal;
        
        all_total = all_total+sp_total;

        /*sal_amt = sal_amt+all_total;
        sal_amt = sal_amt+earn_arrears;        
        sal_amt = sal_amt+mobile_al;
        sal_amt = sal_amt+bonus;
        sal_amt = sal_amt+pf_earn;
        sal_amt = sal_amt+ESIC_earn;
        sal_amt = sal_amt+advance; 
         
        sal_amt = sal_amt-advance_deduct;        
        sal_amt = sal_amt-mobile_deduction;
        sal_amt = sal_amt-other_deduct;
        sal_amt = sal_amt-pf_deduct;        
        sal_amt = sal_amt-ESIC_deduct;
        sal_amt = sal_amt-pt_val;*/
        /*alert(sal_amt);
        alert(all_total);
        alert(mobile_al);*/
        sal_amt = sal_amt+all_total+mobile_al;//+pf_earn+ESIC_earn+pf_deduct+ESIC_deduct;
        //alert(sal_amt);
        //gross
        /*sal_amt = sal_amt-pf_earn; 
        sal_amt = sal_amt-ESIC_earn;*/ 
        //other earn
        sal_amt = sal_amt+earn_arrears; 
        sal_amt = sal_amt+bonus;
        sal_amt = sal_amt+advance;
        
        //other deduct
        sal_amt = sal_amt-advance_deduct;        
        sal_amt = sal_amt-mobile_deduction;
        sal_amt = sal_amt-other_deduct; 
        
        //net_pay
        var total_dedc = pf_deduct+ESIC_deduct+pt_val;
        sal_amt = sal_amt-total_dedc; 
        
        if (advrecovery_val) {
        sal_amt = sal_amt-advrecovery_val;
        }

        if (advAddition_val) {
            sal_amt = sal_amt+advAddition_val;
        }

        $('.Allowance'+rel).val(Math.round((mobile_al+Allowance)+(bonus+advance)));
        $('.net_pay'+rel).val(Math.round(sal_amt));
        }

    });


    $(document).on('blur','.pt_val',function(){
        
        var rel = $(this).attr('rel');
        var no_day_sal = $(this).val()*1;

        if(no_day_sal!=''){
        var ba_val = $('.basic_val'+rel).val()*1;
        var Allowance = $('.Allowance'+rel).val()*1;
        
        ba_val = ba_val+Allowance;
       
        var per_day_val =  ba_val/$('.num_of_day_inMonth').val()*1;
        var sal_amt = per_day_val * no_day_sal;
        $('.basicAmt'+rel).val(sal_amt); 
        var pt_val =$('.pt_val'+rel).val()*1;
        var earn_arrears = $('.earn_arrears'+rel).val()*1;
        var mobile_deduction = $('.mobile_deduction'+rel).val()*1;
        var other_deduct = $('.other_deduct'+rel).val()*1;
        
        sal_amt = sal_amt - pt_val;
        sal_amt = sal_amt+earn_arrears;
        sal_amt = sal_amt-mobile_deduction;
        sal_amt = sal_amt-other_deduct;
           // pt_val
          //  alert(pt_val); net_pay
          $('.net_pay'+rel).val(Math.round(sal_amt));
         }

    });
     

    // salary with basic professional tax 
    //basic salary with pt

$(document).on('click','.BasicSlipGenerate', function(){      

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
                basic_slip_months: {                    
                    required: true 


                }                             
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

                $('.BasicSlipGenerate').prop('disabled',true);
                var url = $(form).attr('action');                
                var serialize_data = $(form).serialize();              

                $.ajax({
                    type:'POST',
                    url:completeURL(url),
                    dataType:'html',
                    data:serialize_data,
                    success:function(data)
                    {
                        //resetForm(form); 
                        $('#BasicSalaryGenerate').html(data);
                    },
                    complete:function()
                    {  
                        $(".table").tableHeadFixer({"left" : 3}); 
                       /*if($(".masterTable").length > 0)
                        {
                            $('.masterTable').dataTable({
                                "aLengthMenu": [
                                    [5, 15, 20, -1],
                                    [5, 15, 20, "All"] // change per page values here
                                ],
                                // set the initial value
                                "iDisplayLength": -1,
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
                        }*/
                        //pluginPickers.init(); 
                        // $('.select2me').select2();                                                  
                        setTimeout(function(){                              
                            $('.BasicSlipGenerate').removeAttr('disabled');                                
                        },2000);
                    }
                });
            }
        });
    });

// save salary

    $(document).on('click','.paidleave', function(){      

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
                comp_id: {                    
                    required: true
                }                             
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
                
                $('.paidleave').prop('disabled',true);
                var url = $(form).attr('action');                
                var serialize_data = $(form).serialize();              

                $.ajax({
                    type:'POST',
                    url:completeURL(url),
                    dataType:'html',
                    data:serialize_data,
                    success:function(data)
                    {
                        $('#BasicSalaryGenerate').html(data);
                    },
                    complete:function()
                    {  
                        
                    }
                });
            }
        });
    });

    $(document).on('click','.add_leave',function() {
        var id= $(this).attr('rel');
        
        $.ajax({
            url:completeURL('leave_model'),          
            type:'POST',
            data:{id:id},
            dataType:'json',
            success: function(data)
            {
                var dialog = bootbox.dialog({
                    message: data.view,
                    title: "Leave Master Form",
                    buttons: 
                    {
                        success: {
                            label: "Submit",
                            className: "green save_assign_task",
                            callback: function()
                            {
                                var form= '#'+ $('.save_assign_task').parents('.modal-content').find('.modal-body').find('form').attr('id');
                                var url=$(form).attr('action');

                                var form2 = $(form);
                                var error2 = $('.alert-danger', form2);
                                var success2 = $('.alert-success', form2);

                                var $validate = $(form).validate({
                                    errorElement: 'span', //default input error message container
                                    errorClass: 'help-block', // default input error message class
                                    focusInvalid: false, // do not focus the last invalid input
                                    ignore: "",  // validate all fields including form hidden input,
                                    debug: true,
                                    rules: {
                                           approve_leave:{
                                            required:true
                                           },
                                           taken_leave:{
                                            required:true
                                           },
                                        },

                                    invalidHandler: function (event, validator) { //display error alert on form submit              
                                        success2.hide();
                                        error2.show();
                                        Metronic.scrollTo(error2, -200);
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
                                        $(element)
                                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                                    },

                                    success: function (label, element) {
                                        var icon = $(element).parent('.input-icon').children('i');
                                        $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                                        icon.removeClass("fa-warning").addClass("fa-check");
                                    },

                                    submitHandler: function (form) {
                                       // alert(1);
                                        
                                    }
                                }).form();

                                $('.select2me', form2).change(function () {
                                    $(form).validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
                                });                         
                                
                                var $valid = $(form).valid();
                                if(!$valid) 
                                {                                                               
                                    return false;
                                }
                                else
                                {                        
                                    //$('.changeButtonType').attr('disabled','disabled');
                                    var data_form=$(form).serialize();
                                    //var tbDiv = $(form).data('tbdiv');
                                    //var tbUrl = $(form).data('tburl');
                                    $(form).ajaxSubmit({
                                            url:url,
                                            data:data_form,
                                            type:'POST',
                                            dataType:'json',
                                            success:function(data)
                                            {
                                                if(data.valid)
                                                {
                                                    bootbox.alert(data.msg, function() {
                                                        ///refreshTable(tbDiv,tbUrl); 
                                                    });   
                                                } 
                                                else
                                                {
                                                    bootbox.alert(data.msg, function() {
                                                    }); 
                                                } 
                                            },
                                            complete:function()
                                            {
                                               
                                            }                                                
                                        });
                                }
                            }
                        },
                        danger: {
                            label: "Cancel",
                            className: "btn-danger",
                            callback: function() {
                                // Example.show("uh oh, look out!");
                            }
                        }                   
                    }
                });
            },
            complete:function(){
                if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        rtl: Metronic.isRTL(),
                        orientation: "left",
                        autoclose: true,
                        format: "yyyy-mm-dd"
                    });
                }
            }
        });
    });

    $(document).on('blur','.approve_leave', function(event){
        var paid_leave = $('.paid_leave').val();
        var approve_leave = $(this).val();
        var total_approve_leave = paid_leave-approve_leave;
        $('.bal_approve_leave').val(total_approve_leave);
    });

    $(document).on('blur','.taken_leave', function(event){
        var paid_leave = $('.approve_leave').val();
        var approve_leave = $(this).val();
        var total_paid = $('.paid_leave').val();
        var total_approve_leave = paid_leave-approve_leave;
        var total_bal_leave = total_paid-approve_leave;
        $('.bal_taken_leave').val(total_approve_leave);
        $('.balance_leave').val(total_bal_leave);
    });

    $(document).on('click','.earn_leave', function(event){
        // Here are the two dates to compare
        var date1 = $('.from_date').val();
        var date2 = $('.to_date').val();
        var bal_leave = $('.balance_leave').val();
        // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
        date1 = date1.split('-');
        date2 = date2.split('-');

        // Now we convert the array to a Date object, which has several helpful methods
        date1 = new Date(date1[0], date1[1], date1[2]);
        date2 = new Date(date2[0], date2[1], date2[2]);

        // We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
        date1_unixtime = parseInt(date1.getTime() / 1000);
        date2_unixtime = parseInt(date2.getTime() / 1000);

        // This is the calculated difference in seconds
        var timeDifference = date2_unixtime - date1_unixtime;

        // in Hours
        var timeDifferenceInHours = timeDifference / 60 / 60;

        // and finaly, in days :)
        var timeDifferenceInDays = (timeDifferenceInHours  / 24)+1;

        var leave_taken = 'You are taking '+timeDifferenceInDays+' days leave.';
        $('.leave_taken').text(leave_taken);
        $('.leave').val(timeDifferenceInDays);
        $('.balance_leave').val(bal_leave-timeDifferenceInDays);
    });

    $(document).on('click','.generateBasic', function(event){
        event.preventDefault();        
        $('.generateBasic').prop('disabled',true); 
        var formId = '#'+$(this).parents('form').attr('id');
        var url = $(formId).attr('action');
        //var id = $(this).attr('rel');
        var comp_id = $('#comp_id').val();
        var month = $('#month').val();
        var data={month:month,comp_id:comp_id};
        var serialize_data = $(formId).serialize();
        serialize_data = serialize_data;
        $.ajax({
            url:completeURL(url),
            type:'post',
            data:serialize_data,
            dataType:'json',
            success:function(data)
            {
                bootbox.alert(data.msg, function(){                            
                    setTimeout(function(){                      
                       window.location.href=completeURL('dashboard');
                    },2000);
                }); 
            },
            complete:function()
            {
                $.ajax({
                    url:completeURL('update_net_pay'),
                    type:'post',
                    data:data,
                    dataType:'json',
                    success:function(data)
                    {

                    },
                });
            }
        });
    }); 

       $(document).on('click','.generateVariable', function(event){
        event.preventDefault();        
        $('.generateBasic').prop('disabled',true); 
        var formId = '#'+$(this).parents('form').attr('id');
        var url = $(formId).attr('action');
        //var id = $(this).attr('rel');
        var comp_id = $('#comp_id').val();
        var month = $('#month').val();
        var data={month:month,comp_id:comp_id};
        var serialize_data = $(formId).serialize();
        serialize_data = serialize_data;
        $.ajax({
            url:completeURL(url),
            type:'post',
            data:serialize_data,
            dataType:'json',
            success:function(data)
            {
                bootbox.alert(data.msg, function(){                            
                    setTimeout(function(){                      
                       window.location.href=completeURL('dashboard');
                    },2000);
                }); 
            },
            complete:function()
            {
                
            }
        });
    }); 
 

    //allowance salary ajax call 
    
    //basic salary with pt

    $(document).on('click','.generateAllowance', function(){
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
                allowance_month: {                    
                    required: true                     
                },
                slip_emp_name: {                    
                    required: true                     
                }                             
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

                $('.generateAllowance').prop('disabled',true);
                var url = $(form).attr('action');                
                var serialize_data = $(form).serialize();              

                $.ajax({
                    type:'POST',
                    url:completeURL(url),
                    dataType:'html',
                    data:serialize_data,
                    success:function(data)
                    {
                        //resetForm(form); 
                        $('#Allowance_tbDiv').html(data);
                    },
                    complete:function()
                    {  
                        //pluginPickers.init(); 
                        // $('.select2me').select2();                                                  
                        setTimeout(function(){                              
                            $('.generateAllowance').removeAttr('disabled');                                
                        },2000);
                    }
                });
            }
        }); 
    });

    // save allowances 

    $(document).on('click','.saveAllowance', function(event){
        event.preventDefault();
        $('.saveAllowance').prop('disabled',true);
        var formId = '#'+$(this).parents('form').attr('id');
        var url = $(formId).attr('action');
       // var id = $(this).attr('rel');
        var serialize_data = $(formId).serialize();
        serialize_data = serialize_data;
  
        $.ajax({
            url:completeURL(url),
            type:'post',
            data:serialize_data,
            dataType:'json',
            success:function(data)
            {
                bootbox.alert(data.msg, function() {                            
                    // resetForm(form); 
                    // refreshTable(tbDiv,tbUrl);  
                    setTimeout(function(){                              
                      //  $('.saveAllowance').removeAttr('disabled');   
                                                       
                    },2000);
                }); 
            }
            /*complete:function()
            {
                $('.generatePaySlip').removeAttr('disabled');
            }*/
        });
    }); 

    // Allowance calculation 
    
    $(document).on('change','.update',function(){
        $('.working_days').prop('disabled',false);
    });

    $(document).on('blur','.working_days',function(){ //no_holiday
        var workDay = $(this).val()*1;
        //var conveyance = $().val()*1;
                $(this).prop('readonly',true);
                $('.no_holiday').prop('disabled',true);
                var days_inMonth =  $('.num_of_day_inMonth').val()*1;
                var sumEarning=0;
                var earnCount = $('.cntEarning').val()*1;

                  for (var k = 1; k <= earnCount; k++) {
                    
                    if( $('.earnVal'+k).attr('rel') == 1 ||  $('.earnVal'+k).attr('rev') == 1 || $('.earn_name'+k).attr('rel')==1){ 
                        
                        if ($('.earn_name'+k).attr('rel')==1) { 

                           var real = $('.earnVal'+k).val()*1;
                           var otherPerDay = real / days_inMonth;
                          // var hraDay = workDay  // deduct holiday of month
                           var other = otherPerDay *  workDay;
                           $('.earnVal'+k).val(Math.round(other));

                        }
                        // for other allowances  
                          if ($('.earnVal'+k).attr('rel')==1) { 

                           var real = $('.earnVal'+k).val()*1;
                           var hraPerDay = real / days_inMonth ;
                          // var hraDay = workDay  // deduct holiday of month
                           var hra = hraPerDay *  workDay;
                           $('.earnVal'+k).val(Math.round(hra));

                        }
                        // for conveyance 
                        if ($('.earnVal'+k).attr('rev')==1) {

                            if($('.allow_type'+k).val()!='kilometer'){

                                var real = $('.earnVal'+k).val()*1;

                                var conveyPerDay = real / days_inMonth;
                                var conveyDay = workDay-$('.no_holiday').val()*1; //  deduct hoiliday+absent of month
                                var convey = conveyPerDay *  conveyDay;
                                $('.earnVal'+k).val(Math.round(convey));

                               }else{

                                var real = $('.earnVal'+k).val()*1;
                                var  real1 = real *  days_inMonth;
                                var conveyPerDay = real1 / days_inMonth;
                                var deductDay = ($('.num_sundays').val()*1) + ($('.no_holiday').val()*1);
                                var conveyDay = workDay-deductDay; //  deduct hoiliday + sunday + absent of month for km
                                var convey = conveyPerDay *  conveyDay;
                                $('.earnVal'+k).val(Math.round(convey));

                               }

                        }
                         

                      
                        }
                }


                for (var i = 1; i <= earnCount; i++) {
                    sumEarning = sumEarning + ($('.earnVal'+i).val()*1);     
                }
                $('.totalEarn').val(Math.round(sumEarning)); 
                // var net = ($('.totalEarn').val()*1) + $('.totalDeduct').val()*1;
                // $('.netpay').val(Math.round(net));

                // deduction calculations 

                var sumDeduct=0;
                var cntDeduct = $('.cntDeduct').val()*1;                 
                for (var i = 1; i <= cntDeduct; i++) {
                    sumDeduct = sumDeduct + ($('.deductVal'+i).val()*1);     
                }
                $('.totalDeduct').val(Math.round(sumDeduct)); 
                var net = ($('.totalEarn').val()*1) - $('.totalDeduct').val()*1;
                $('.netpay').val(Math.round(net));
    });


   

        // //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
        // $('.select2me', form).change(function () {
        //     $(form).validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        // });

    //for generate excel sheet of employee salary 
    $(document).on('click','.clickonce',function(){

            if($('.hdShow').hasClass('hide')){
                $('.hdShow').removeClass('hide');
            }else{
                $('.hdShow').addClass('hide');
            }
    });

    $(document).on('click','.view_salary_str',function() {
        var id= $(this).attr('rel');        
        $.ajax({
            url:completeURL('approve_salary_model'),          
            type:'POST',
            data:{id:id},
            dataType:'json',
            success: function(data)
            {
                var dialog = bootbox.dialog({
                    message: data.view,
                    title: "Salary Structure Form",
                    buttons: 
                    {
                        success: {
                            label: "Submit",
                            className: "green save_assign_task",
                            callback: function()
                            {
                                var form= '#'+ $('.save_assign_task').parents('.modal-content').find('.modal-body').find('form').attr('id');
                                var url=$(form).attr('action');

                                var form2 = $(form);
                                var error2 = $('.alert-danger', form2);
                                var success2 = $('.alert-success', form2);

                                var $validate = $(form).validate({
                                    errorElement: 'span', //default input error message container
                                    errorClass: 'help-block', // default input error message class
                                    focusInvalid: false, // do not focus the last invalid input
                                    ignore: "",  // validate all fields including form hidden input,
                                    debug: true,
                                    rules: {
                                           status:{
                                            required:true
                                           }
                                        },

                                    invalidHandler: function (event, validator) { //display error alert on form submit              
                                        success2.hide();
                                        error2.show();
                                        Metronic.scrollTo(error2, -200);
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
                                        $(element)
                                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                                    },

                                    success: function (label, element) {
                                        var icon = $(element).parent('.input-icon').children('i');
                                        $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                                        icon.removeClass("fa-warning").addClass("fa-check");
                                    },

                                    submitHandler: function (form) {
                                       // alert(1);
                                        
                                    }
                                }).form();

                                $('.select2me', form2).change(function () {
                                    $(form).validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
                                });                         
                                
                                var $valid = $(form).valid();
                                if(!$valid) 
                                {                                                               
                                    return false;
                                }
                                else
                                {                        
                                    //$('.changeButtonType').attr('disabled','disabled');
                                    var data_form=$(form).serialize();
                                    var tbDiv = $(form).data('tbdiv');
                                    var tbUrl = $(form).data('tburl');
                                    $(form).ajaxSubmit({
                                            url:url,
                                            data:data_form,
                                            type:'POST',
                                            dataType:'json',
                                            success:function(data)
                                            {
                                                if(data.valid)
                                                {
                                                    bootbox.alert(data.msg, function() {
                                                        //refreshTable(tbDiv,tbUrl); 
                                                        $( ".table" ).load("approve_salary_str .masterTable");
                                                    });
                                                }
                                                else
                                                {
                                                    bootbox.alert(data.msg, function() {
                                                    }); 
                                                } 
                                            },
                                            complete:function()
                                            {
                                               
                                            }                                                
                                        });
                                }
                            }
                        },
                        danger: {
                            label: "Cancel",
                            className: "btn-danger",
                            callback: function() {
                                // Example.show("uh oh, look out!");
                            }
                        }                   
                    }
                });
            },
            complete:function(){
                if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        rtl: Metronic.isRTL(),
                        orientation: "left",
                        autoclose: true,
                        format: "yyyy-mm-dd"
                    });
                }
                $('.select2me').select2();
            }
        });
    });

    $(document).on('change','#status',function(){
        var txt = $(this).val();
        if(txt=='Approve')
        {
            $('#remark').removeClass('show').addClass('hide');
        }else{
            $('#remark').removeClass('hide').addClass('show');
        }
    });

    $(document).on('click','.update_advance',function() {
        var id= $(this).attr('rel');        
        var url= $(this).attr('rev');        
        $.ajax({
            url:completeURL(url),          
            type:'POST',
            data:{id:id},
            dataType:'json',
            success: function(data)
            {
                var dialog = bootbox.dialog({
                    message: data.view,
                    title: "Update Advance Form",
                    buttons: 
                    {
                        success: {
                            label: "Submit",
                            className: "green save_assign_task",
                            callback: function()
                            {
                                var form= '#'+ $('.save_assign_task').parents('.modal-content').find('.modal-body').find('form').attr('id');
                                var url=$(form).attr('action');

                                var form2 = $(form);
                                var error2 = $('.alert-danger', form2);
                                var success2 = $('.alert-success', form2);

                                var $validate = $(form).validate({
                                    errorElement: 'span', //default input error message container
                                    errorClass: 'help-block', // default input error message class
                                    focusInvalid: false, // do not focus the last invalid input
                                    ignore: "",  // validate all fields including form hidden input,
                                    debug: true,
                                    rules: {
                                           status:{
                                            required:true
                                           }
                                        },

                                    invalidHandler: function (event, validator) { //display error alert on form submit              
                                        success2.hide();
                                        error2.show();
                                        Metronic.scrollTo(error2, -200);
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
                                        $(element)
                                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                                    },

                                    success: function (label, element) {
                                        var icon = $(element).parent('.input-icon').children('i');
                                        $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                                        icon.removeClass("fa-warning").addClass("fa-check");
                                    },

                                    submitHandler: function (form) {
                                       // alert(1);
                                        
                                    }
                                }).form();

                                $('.select2me', form2).change(function () {
                                    $(form).validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
                                });                         
                                
                                var $valid = $(form).valid();
                                if(!$valid) 
                                {                                                               
                                    return false;
                                }
                                else
                                {                        
                                    //$('.changeButtonType').attr('disabled','disabled');
                                    var data_form=$(form).serialize();
                                    var tbDiv = $(form).data('tbdiv');
                                    var tbUrl = $(form).data('tburl');
                                    $(form).ajaxSubmit({
                                            url:url,
                                            data:data_form,
                                            type:'POST',
                                            dataType:'json',
                                            success:function(data)
                                            {
                                                if(data.valid)
                                                {
                                                    bootbox.alert(data.msg, function() {
                                                        //refreshTable(tbDiv,tbUrl); 
                                                        $( ".table" ).load("fetch_advance_data .masterTable");
                                                    });
                                                }
                                                else
                                                {
                                                    bootbox.alert(data.msg, function() {
                                                    }); 
                                                } 
                                            },
                                            complete:function()
                                            {
                                               
                                            }                                                
                                        });
                                }
                            }
                        },
                        danger: {
                            label: "Cancel",
                            className: "btn-danger",
                            callback: function() {
                                // Example.show("uh oh, look out!");
                            }
                        }                   
                    }
                });
            },
            complete:function(){
                if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        rtl: Metronic.isRTL(),
                        orientation: "left",
                        autoclose: true,
                        format: "yyyy-mm-dd"
                    });
                }
                $('.select2me').select2();
            }
        });
    });

    $(document).on('click','.deleteSalary', function(){
        var deleteDiv = $(this);
        bootbox.confirm("Are you sure?", function(result) {
            if(result)
            {
                var str = deleteDiv.attr('rel');
                var str = str.split("/");
                var id = str[0];
                var mth = str[1];
                var url = deleteDiv.attr('rev');
                $.ajax({
                    url : completeURL(url),
                    type:'POST',
                    dataType:'json',
                    data: {id:id,mth:mth},
                    success:function(data)
                    {
                        bootbox.alert(data.msg, function() {                
                            window.location.href=window.location.href;
                        }); 
                    },
                    complete:function()
                    {

                    }

                });
            }      
        });
    });
    

});
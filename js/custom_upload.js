/*
Author : vishal
Work: All common funciton which needed for Pay Slip Projects
*/
$(document).on('click','.uploadfile', function(){      

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
                attendance_sheet: {
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

                $('.uploadfile').prop('disabled',true);
                var url = $(form).attr('action');                
                var serialize_data = $(form).serialize();              
                
                 $(form).ajaxSubmit({

                    type:'POST',
                    url:completeURL(url),
                    dataType:'json',
                    data:serialize_data,
                    success:function(data)
                    {
                        //resetForm(form); 
                        //$('#employeeDetailsDiv').html(data);
                        bootbox.alert(data.msg, function() {
                            //Example.show("Hello world callback");
                            resetForm(form); 
                            //refreshTable(tbDiv,tbUrl);  
                            setTimeout(function(){                              
                                $('.uploadfile').removeAttr('disabled');  
                                // $('.diff_common_save').text('Submit');
                                // $('.diff_common_save').attr('rel','0');             

                            },2000);
                        }); 
                    },
                    complete:function()
                    {                                                     
                        setTimeout(function(){                              
                            $('.uploadfile').removeAttr('disabled');                                
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
var Login = function () {

	var handleLogin = function() {

		$('.login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                username: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	                remember: {
	                    required: false
	                }
	            },

	            messages: {
	                username: {
	                    required: "Username is required."
	                },
	                password: {
	                    required: "Password is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.login-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                //form.submit(); // form validation success, call ajax form submit	                

                	var login = $('#adminname').val();           
			        var pass = $('#adminpass').val();
			        var md5 = $().crypt({method:"md5",source:pass});
			        /*alert(md5);
			        var sha = $().crypt({method:"sha1",source:md5});
			        alert(sha);
			        var md = $().crypt({method:"md5",source:sha});
			        alert(md);*/  

			        if(login!='' && pass!='')
			        {
			            var submitBt = $('.login-form').find('button[type=submit]');
			            submitBt.attr('disabled','disabled');              
			            var target = $('.login-form').attr('action');			                      
			              
			            if (!target || target == '')
			            {                        
			                target = document.location.href.match(/^([^#]+)/)[1];
			            }
			                        
			            var data = {
			                key: $('#keyValue').val(),
			                username: login,
			                password: md5           
			            };

			                
			            var sendTimer = new Date().getTime();			            
		                try
		                {  
		                    $.ajax({
		                        url: target,
		                        dataType: 'json',
		                        type: 'POST',
		                        data: data,
		                        success: function(data, textStatus, XMLHttpRequest)
		                        {
		                            if (data.valid)
		                            {
		                                var receiveTimer = new Date().getTime();			                                
		                                if (receiveTimer-sendTimer < 500)
		                                {
		                                    setTimeout(function()
		                                    {
		                                        document.location.href = data.redirect;
		                                    }, 500-(receiveTimer-sendTimer));
		                                }
		                                else
		                                {		                                
		                                    document.location.href = data.redirect;
		                                }
		                            }
		                            else
		                            {
		                                // Message
		                                $('.alert-success', $('.login-form')).hide();
		                                $('.alert-wrong-user', $('.login-form')).show();                   
		                            }			                           
		                            submitBt.removeAttr('disabled');
		                        },
		                        error: function(XMLHttpRequest, textStatus, errorThrown)
		                        {
		                            // Message
		                            $('#adminMsg').css('display','block').html('<div class="alert alert-error">Error while contacting server, please try again</div>').fadeOut(5000);                    
		                            //resetForm($this);
		                            submitBt.removeAttr("disabled");
		                        },
		                        complete: function(data)
		                        {                  
		                            setTimeout(function(){                   
		                                $('#adminpass').val('');
		                            },2000);
		                        }  
		                    });
		                }
		                catch(e)
		                {
		                    alert(e)
		                }   
			            
			            //$('#adminMsg').css('display','block').html('<div class="alert alert-block">Please wait, checking login...</div>');                    
			            $('.alert-wrong-user', $('.login-form')).hide(); 
			            $('.alert-success', $('.login-form')).show();
			        }
			    }
	        });

	        $('.login-form input').keypress(function (e) {
	            if (e.which == 13) {

	                if ($('.login-form').validate().form()) {

	                	var login = $('#adminname').val();           
				        var pass = $('#adminpass').val();
				        var md5 = $().crypt({method:"md5",source:pass});
				        /*alert(md5);
				        var sha = $().crypt({method:"sha1",source:md5});
				        alert(sha);
				        var md = $().crypt({method:"md5",source:sha});
				        alert(md);*/  

				        if(login!='' && pass!='')
				        {
				            var submitBt = $('.login-form').find('button[type=submit]');
				            submitBt.attr('disabled','disabled');              
				            var target = $('.login-form').attr('action');			                      
				              
				            if (!target || target == '')
				            {                        
				                target = document.location.href.match(/^([^#]+)/)[1];
				            }
				                        
				            var data = {
				                key: $('#keyValue').val(),
				                username: login,
				                password: md5           
				            };

				                
				            var sendTimer = new Date().getTime();			            
			                try
			                {  
			                    $.ajax({
			                        url: target,
			                        dataType: 'json',
			                        type: 'POST',
			                        data: data,
			                        success: function(data, textStatus, XMLHttpRequest)
			                        {
			                            if (data.valid)
			                            {
			                                var receiveTimer = new Date().getTime();			                                
			                                if (receiveTimer-sendTimer < 500)
			                                {
			                                    setTimeout(function()
			                                    {
			                                        document.location.href = data.redirect;
			                                    }, 500-(receiveTimer-sendTimer));
			                                }
			                                else
			                                {		                                
			                                    document.location.href = data.redirect;
			                                }
			                            }
			                            else
			                            {
			                                // Message
			                                $('.alert-success', $('.login-form')).hide();
			                                $('.alert-wrong-user', $('.login-form')).show();                   
			                            }			                           
			                            submitBt.removeAttr('disabled');
			                        },
			                        error: function(XMLHttpRequest, textStatus, errorThrown)
			                        {
			                            // Message
			                            $('#adminMsg').css('display','block').html('<div class="alert alert-error">Error while contacting server, please try again</div>').fadeOut(5000);                    
			                            //resetForm($this);
			                            submitBt.removeAttr("disabled");
			                        },
			                        complete: function(data)
			                        {                  
			                            setTimeout(function(){                   
			                                $('#adminpass').val('');
			                            },2000);
			                        }  
			                    });
			                }
			                catch(e)
			                {
			                    alert(e)
			                }   
				            
				            //$('#adminMsg').css('display','block').html('<div class="alert alert-block">Please wait, checking login...</div>');                    
				            $('.alert-wrong-user', $('.login-form')).hide(); 
				            $('.alert-success', $('.login-form')).show();
				        } 

	                }
	                return false;
	            }
	        });
	}

	var handleForgetPassword = function () {
		$('.forget-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                email: {
	                    required: true,
	                    email: true
	                }
	            },

	            messages: {
	                email: {
	                    required: "Email is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   

	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });

	        $('.forget-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.forget-form').validate().form()) {
	                    $('.forget-form').submit();
	                }
	                return false;
	            }
	        });

	        jQuery('#forget-password').click(function () {
	            jQuery('.login-form').hide();
	            jQuery('.forget-form').show();
	        });

	        jQuery('#back-btn').click(function () {
	            jQuery('.login-form').show();
	            jQuery('.forget-form').hide();
	        });

	}

	var handleRegister = function () {

		function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }


		$("#select2_sample4").select2({
		  	placeholder: '<i class="fa fa-map-marker"></i>&nbsp;Select a Country',
            allowClear: true,
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function (m) {
                return m;
            }
        });


			$('#select2_sample4').change(function () {
                $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });



         $('.register-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                
	                fullname: {
	                    required: true
	                },
	                email: {
	                    required: true,
	                    email: true
	                },
	                address: {
	                    required: true
	                },
	                city: {
	                    required: true
	                },
	                country: {
	                    required: true
	                },

	                username: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	                rpassword: {
	                    equalTo: "#register_password"
	                },

	                tnc: {
	                    required: true
	                }
	            },

	            messages: { // custom messages for radio buttons and checkboxes
	                tnc: {
	                    required: "Please accept TNC first."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   

	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
	                    error.insertAfter($('#register_tnc_error'));
	                } else if (element.closest('.input-icon').size() === 1) {
	                    error.insertAfter(element.closest('.input-icon'));
	                } else {
	                	error.insertAfter(element);
	                }
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });

			$('.register-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.register-form').validate().form()) {
	                    $('.register-form').submit();
	                }
	                return false;
	            }
	        });

	        jQuery('#register-btn').click(function () {
	            jQuery('.login-form').hide();
	            jQuery('.register-form').show();
	        });

	        jQuery('#register-back-btn').click(function () {
	            jQuery('.login-form').show();
	            jQuery('.register-form').hide();
	        });
	}
    
    return {
        //main function to initiate the module
        init: function () {
        	
            handleLogin();
            handleForgetPassword();
            handleRegister();        
	       
        }

    };

}();
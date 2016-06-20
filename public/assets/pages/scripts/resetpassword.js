var resetpassword = function() {

    var handleResetPassword = function() {
        $('.reset-form').validate({
            errorElement: 'div', //default input error message container
            //errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                },
                password_confirmation: {
                    equalTo: "#confirm_password"
                }
            },

            messages: {
                email: {
                    required: 'Email is required',
                },
                password: {
                    required: 'Please enter new password',
                },
                password_confirmation: {
                    equalTo: 'Password mismatch'
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.reset-form')).show();
                $('.alert-danger', $('.reset-form')).find('div').remove();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.appendTo(element.closest('.reset-form').find('div.alert'));
            },

            submitHandler: function(form, event) {
                event.preventDefault();
                $('button[type="submit"]' ,$(".reset-form")).prop("disabled",true);
                var formData = new FormData();
                
                $('input[type="text"], input[type="password"], input[type="hidden"], select').each(function(i){
                    formData.append($(this).attr('name'), $(this).val());
                });

                $.ajax({
                url: $(form).attr('action'),
                method: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,

                data: formData,

                error: function (data) {
                    $('div.alert div',form).remove();
                    if (data.status === 422) {
                        $.each(data.responseJSON.error, function(i,v){
                            $('div.alert',form).append("<div>"+v+"</div>");
                            $('div.alert',form).show();
                        });
                    } else {
                        //log error
                        $('div.alert',form).show();
                        $('div.alert',form).append("<div>Unknown error occurs.</div>");
                        console.log(data.responseText);
                    }
                },
                success: function (data){
                    $('div.alert div',form).remove();
                        $('div.alert',form).show();
                        $('div.alert',form).css("background-color","#9FDE8A");
                        $('div.alert',form).css("border-color","#9FDE8A");
                        $('div.alert',form).css("color","#437A31");
                        $('div.alert',form).append("<div>"+data.message+"</div>");
                        setTimeout(function(){
                            window.location.href= data.redirect ;
                        }, 1000);  
                },
                complete: function(){
                    $('button[type="submit"]' ,$(".reset-form")).prop("disabled",false);
                }
                });
            }
        });

        $('.reset-form input').keypress(function(e) {
            $('.alert-danger', $('.reset-form')).find('div').remove();
            $('.alert-danger', $('.reset-form')).hide();
            if (e.which == 13) {
                if ($('.reset-form').validate().form()) {
                    $('.reset-form').submit();
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            handleResetPassword();
        }

    };

}();

jQuery(document).ready(function() {
    resetpassword.init();
});

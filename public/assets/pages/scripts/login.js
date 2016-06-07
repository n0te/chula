var Login = function() {

    var handleLogin = function() {

        $(".login-form").validate({
            errorElement: 'div', //default input error message container
            //errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
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
                email: {
                    required: "Username is required."
                },
                password: {
                    required: "Password is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).show();
                $('.alert-danger', $('.login-form')).find('div').remove();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
                if($('.alert-danger', $('.login-form')).find('div').length == 0){
                    $('.alert-danger', $('.login-form')).hide();
                }
            },

            errorPlacement: function(error, element) {
                error.after($("<br>")).appendTo(element.closest('.login-form').find('div.alert'));
            },

            submitHandler: function(form, event) {
                //form.submit(); // form validation success, call ajax form submit
                event.preventDefault();
                var formData = new FormData();
                formData.append('email', $("input[name='email']",form).val());
                formData.append('password', $("input[name='password']",form).val());
                formData.append('remember', $("input[name='remember']",form).val());
                //formData.append('image', image[0].files[0])
                $.ajax({
                url: $(this).attr('action'),
                method: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,

                data: formData,

                error: function (data) {
                    $('div.alert div',form).remove();
                    if (data.status === 422) {
                        $.each(data.responseJSON.error, function (i, v) {
                            $('div.alert',form).append("<div>"+v+"</div>");
                            $('div.alert',form).show();
                        });
                    } else {
                        //log error
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
                });
            }
        });

        $('.login-form input').keypress(function(e) {
            $('.alert-danger', $('.login-form')).find('div').remove();
            $('.alert-danger', $('.login-form')).hide();
            if (e.which == 13) {
                $('.login-form').validate();
            }
        });
    }

    var handleForgetPassword = function() {
        $('.forget-form').validate({
            errorElement: 'div', //default input error message container
            //errorClass: 'help-block', // default input error message class
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

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.forget-form')).show();
                $('div.alert',$('.forget-form')).css("background-color","#fbe1e3");
                $('div.alert',$('.forget-form')).css("border-color","#fbe1e3");
                $('div.alert',$('.forget-form')).css("color","#e73d4a");
                $('.alert-danger', $('.forget-form')).find('div').remove();
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
                error.appendTo(element.closest('.forget-form').find('div.alert'));
            },

            submitHandler: function(form, event) {
                event.preventDefault();
                var formData = new FormData();
                formData.append('email', $("input[name='email']",form).val());
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
                        $('div.alert',form).append("<div>"+data.responseJSON.message+"</div>");
                        $('div.alert',form).css("background-color","#fbe1e3");
                        $('div.alert',form).css("border-color","#fbe1e3");
                        $('div.alert',form).css("color","#e73d4a");
                        $('div.alert',form).show();
                    } else {
                        //log error
                        $('div.alert',form).css("background-color","#fbe1e3");
                        $('div.alert',form).css("border-color","#fbe1e3");
                        $('div.alert',form).css("color","#e73d4a");
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
                },
                });
            }
        });

        $('.forget-form input').keypress(function(e) {
            $('.alert-danger', $('.forget-form')).find('div').remove();
            $('.alert-danger', $('.forget-form')).hide();
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function() {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

    }

    var handleRegister = function() {

        OnTypeAndOccupationChange();

        //for 1st file inout
        $('.register-form input[type="file"]').last().on("change",function(){
                ValidateFileInput();
        });

        $('#file-add-btn',$('.register-form')).on('click',function(){
            $('.register-form .file-portlet').append('<div class="form-group file-panel" >'+
                        '<label class="control-label visible-ie8 visible-ie9">รายละเอียดของไฟล์</label><i class="fa fa-close"></i>'+
                        '<input class="form-control placeholder-no-fix filedesc" type="text" placeholder="รายละเอียดของไฟล์" name="filedesc[]" />'+
                        '<div class="fileinput fileinput-new" data-provides="fileinput">'+
                            '<span class="btn green btn-file">'+
                                '<span class="fileinput-new"> Select file </span>'+
                                '<span class="fileinput-exists"> Change </span>'+
                                '<input type="hidden" value="" name="..."><input type="file" accept="image/jpg,image/png,image/jpeg" name="documents[]"> </span>'+
                                '<span class="fileinput-filename"></span> &nbsp;'+
                                '<a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a></div></div>');

            //binding file input change delegate event on parent element doesn't trigger, so need to manually attached event every time the element added.
            $('.register-form input[type="file"]').last().on("change",function(){
                ValidateFileInput();
            });
        });

        $("body").on("click",".file-panel .fa-close",function(){
            $(this).parents(".file-panel").remove();
        });

        $("body").on("change",".file-panel input[name='filedesc[]']",function(){
            ValidateFileInput();
        });

        if($('input.module_chkbox:checked').length == 0){
                $('input#hidden_module_value').val('');
            }else{
                $('input#hidden_module_value').val('secret');
        }

        $('input.module_chkbox').on('click',function(){
            if($(this).is(':checked')){
                $(this).val('true');
            }else{
                $(this).val('');
            }
            if($('input.module_chkbox:checked').length == 0){
                $('input#hidden_module_value').val('');
            }else{
                $('input#hidden_module_value').val('secret');
            }
        });

        $('select[name="nationality"]').on("change",function(){
                if($(this).val() == "1"){
                    $('input[name="citizen_id"]').prop("disabled",false);
                    $('input[name="citizen_id"]').show();
                    $('input[name="passport_id"]').prop("disabled",true);
                    $('input[name="passport_id"]').hide();
                }else if($(this).val() != ""){
                    $('input[name="citizen_id"]').prop("disabled",true);
                    $('input[name="citizen_id"]').hide();
                    $('input[name="passport_id"]').prop("disabled",false);
                    $('input[name="passport_id"]').show();
                }
        });

        $('select[name="type"], select[name="occupation"]').on("change",function(){
                OnTypeAndOccupationChange();
        });

        $('.register-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: ":disabled",
            rules: {
                hidden_module_value: {
                    required: true
                },
                title: {
                    required: true
                },
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
                sex: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                nationality: {
                    required: true
                },
                type: {
                    required: true
                },
                occupation: {
                    required: true
                },
                student_id: {
                    required: true
                },
                advisor: {
                    required: true
                },
                researchtopic: {
                    required: true
                },
                department: {
                    required: true
                },
                company: {
                    required: true
                },
                citizen_id: {
                    required: true
                },
                passport_id: {
                    required: true
                },
                address: {
                    required: true
                },
                tel: {
                    required: true
                },
                password: {
                    required: true
                },
                password_confirmation: {
                    equalTo: "#register_password"
                }
            },

            messages: { // custom messages for radio buttons and checkboxes
                hidden_module_value: {
                    required: "กรุณาระบุส่วนงานที่ต้องการ"
                },
                title: {
                    required: "กรุณาระบุคำนำหน้า"
                },
                firstname: {
                    required: "กรุณาระบุชื่อจริง"
                },
                lastname: {
                    required: "กรุณาระบุนามสกุล"
                },
                sex: {
                    required: "กรุณาระบุเพศ"
                },
                email: {
                    required: "กรุณาระบุ Email",
                    email: true
                },
                nationality: {
                    required: "กรุณาระบุสัญชาติ"
                },
                type: {
                    required: "กรุณาระบุประเภทสมาชิก"
                },
                occupation: {
                    required: "กรุณาระบุประเภทบุคคลากร"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

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
                if($(element).attr("name") == "documents[]"){
                    error.appendTo($(element).parents("div.fileinput"));

                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form, event) {
                event.preventDefault();
                if(ValidateFileInput()){
                //clear all disabled input value
                $('.register-form input:disabled').each(function(){
                    $(this).val();
                });
                var formData = new FormData();

                $('input[type="text"], input[type="password"], input[type="hidden"], select, input[type="checkbox"]').each(function(i){
                    if($(this).attr('type')=='checkbox'){
                        if($(this).val()!=''){
                            formData.append($(this).attr('name'), $(this).val());
                        }
                    }else{
                        formData.append($(this).attr('name'), $(this).val());
                    }
                });

                $('input[type="file"]',$(".register-form")).each(function(i){
                    formData.append($(this).attr("name"), $(this).get(0).files[0]);
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
                    if (data.status === 422) {//could be email redundant
                        $.each(data.responseJSON, function(i,v){
                            $('div.alert',form).append("<div>"+v+"</div>");
                            $('div.alert',form).show();
                            WindowScrollTopAnimation('.register-form div.alert', 500);
                        });
                    } else {
                        //log error
                        $('div.alert',form).show();
                        $('div.alert',form).append("<div>Unknown error occurs.</div>");
                        console.log(data.responseText);
                        WindowScrollTopAnimation('.register-form div.alert', 500);
                    }
                },
                success: function (data){
                        $('div.alert div',form).remove();
                        $('div.alert',form).show();
                        $('div.alert',form).css("background-color","#9FDE8A");
                        $('div.alert',form).css("border-color","#9FDE8A");
                        $('div.alert',form).css("color","#437A31");
                        $('div.alert',form).append("<div>"+data.message+"</div>");
                        WindowScrollTopAnimation('.register-form div.alert', 500);
                        setTimeout(function(){
                            window.location.href = data.redirect;
                        }, 1000);
                },
                });
                }
            }
        });

        $('.register-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.register-form').validate().form()) {
                    //$('.register-form').submit();
                }
                return false;
            }
        });

        $('.register-form select').on('change',function(){
            $('.register-form').validate();
        });

        jQuery('#register-btn').click(function() {
            jQuery('.login-form').hide();
            jQuery('.register-form').show();
        });

        jQuery('#register-back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.register-form').hide();
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            handleLogin();
            handleForgetPassword();
            handleRegister();
        }
    };

}();

jQuery(document).ready(function() {
    Login.init();


});

function OnTypeAndOccupationChange(){
    var $type = $('select[name="type"]');
                var $type_v = $('select[name="type"]').val();
                var $oc = $('div.user_occupation_panel');
                var $oc_v = $('select[name="occupation"]').val();
                var $div = $('div#pre-hidden-group');
                var $dept = $('div.department-panel');

                $('input[hide]').hide();
                $('input[hide]').prop("disabled",true);
                if($type_v == ''){
                    $oc.hide();
                    $oc.find('select').prop("disabled",true);
                    $oc.slideUp();
                }else if($type_v == 1 || $type_v == 2){
                    $oc.show();
                    $oc.find('select').prop("disabled",false);
                    if($oc_v != ''){
                        $div.slideDown();
                    }else{
                        $div.slideUp();
                    }
                    if($oc_v == 1){//student
                        $('input[student]').show();
                        $('input[student]').prop("disabled",false);
                    }
                    if($type_v==1){//in med
                        $dept.show();
                        $dept.find('select').prop("disabled",false);
                    }else{
                        $dept.hide();
                        $dept.find('select').prop("disabled",true);
                    }   
                }else{
                    $dept.hide();
                    $dept.find('select').prop("disabled",true);
                    $oc.hide();
                    $oc.find('select').prop("disabled",true);
                    $('input[student]').slideUp();
                    $('input[student]').prop("disabled",true);
                    $('input[outsider]').show();
                    $('input[outsider]').prop("disabled",false);
                    $div.slideDown();
                }
}

function ValidateFileInput(){
    var result = true;
    $('.register-form input[type="file"]').each(function(){
        $(this).parents('.file-panel').find('span.file-custom-error').remove();
        if($(this).val() == ''){
            result = false;
            $(this).parents('.file-panel').append('<span class="file-custom-error">กรุณาอัพโหลดไฟล์เพื่อยืนยันตัวตน</span');
        }
        if($(this).parents('.file-panel').find('input[name="filedesc[]"]').val() == ''){
            result = false;
            if($(this).parents('.file-panel').find('span.file-custom-error').length != 0){
                $(this).parents('.file-panel').find('span.file-custom-error').html($(this).parents('.file-panel').find('span.file-custom-error').html() + " และรายละเอียดของไฟล์");
            }else{
                $(this).parents('.file-panel').append('<span class="file-custom-error">กรุณาระบุรายละเอียดของไฟล์</span');
            }
        }
    });
    if(!result){
        WindowScrollTopAnimation("div.portlet",500);
    }
    return result;
}
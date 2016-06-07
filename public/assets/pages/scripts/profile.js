var Profile = function() {
    var handlePersonelInfo = function (){
        OnTypeAndOccupationChange();
        OnNationalityChange();

        $.get('/getdocuments',showCurrentFile);

        //for 1st file inout
        $('.profile-form input[type="file"]').last().on("change",function(){
                ValidateFileInput();
        });

        $('#file-add-btn',$('.profile-form')).on('click',function(){
            $('.profile-form .file-portlet').append('<div class="form-group file-panel" >'+
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
            $('.profile-form input[type="file"]').last().on("change",function(){
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
            if($('input.module_chkbox:checked').length == 0){
                $('input#hidden_module_value').val('');
            }else{
                $('input#hidden_module_value').val('secret');
            }
        });

        $('select[name="nationality"]').on("change",function(){
                OnNationalityChange();
        });

        $('select[name="type"], select[name="occupation"]').on("change",function(){
                OnTypeAndOccupationChange();
        });

        $('body').on('click','.popover.confirmation .btn-success' ,function(){
                var identifier = $('[aria-describedby="'+$(this).parents('.popover.confirmation').attr('id')+'"]').attr('file-id');
                $.ajax({
                url:'/deleteDoc/'+identifier,
                type: 'post',
                success:showCurrentFile,
                error:ProcessFileDeleteError
                });
        });

        $('.profile-form').validate({
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
            },

            messages: { // custom messages for radio buttons and checkboxes
                
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
                error.insertAfter(element);        
            },

            submitHandler: function(form, event) {
                event.preventDefault();
                //clear all disabled input
                $('.profile-form input:disabled').each(function(){
                    $(this).val('');
                });

                var errorDiv = $(form).parents('#profile').find('div.alert');
                if(ValidateFileInput()){
                var formData = new FormData();

                $('input[type="text"], input[type="password"], input[type="hidden"], select').each(function(i){
                    formData.append($(this).attr('name'), $(this).val());
                });

                $('input[type="file"]',$(".profile-form")).each(function(i){
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
                    errorDiv.find("div").remove();
                    if (data.status === 422) {//could be email redundant
                        $.each(data.responseJSON.error, function(i,v){
                            errorDiv.append("<div>"+v+"</div>");
                            errorDiv.show();
                            WindowScrollTopAnimation('#profile div.alert', 500);
                        });
                    } else {
                        //log error
                        errorDiv.show();
                        errorDiv.append("<div>Unknown error occurs.</div>");
                        console.log(data.responseText);
                        WindowScrollTopAnimation('#profile div.alert', 500);
                    }
                },
                success: function (data){
                        errorDiv.find('div').remove();
                        errorDiv.show();
                        errorDiv.css("background-color","#9FDE8A");
                        errorDiv.css("border-color","#9FDE8A");
                        errorDiv.css("color","#437A31");
                        errorDiv.append("<div>"+data.message+"</div>");
                        WindowScrollTopAnimation('#profile div.alert', 500);
                        RefreshInputFile();
                        $.get('/getdocuments',showCurrentFile);
                },
                });
                }
            }
        });

        $('.profile-form input').keypress(function(e) {
            $('#profile div.alert').hide();
            if (e.which == 13) {
                if ($('.profile-form').validate().form()) {
                    //$('.profile-form').submit();
                }
                return false;
            }
        });

        $('.profile-form select').on('change',function(){
            $('.profile-form').validate();
        });
    }

    var handleModules = function(){

        $.get('/getmodules',ShowModules);

        $('body').on('click','.module-request-btn',function(){
            $.ajax({
                type:'post',
                url:'/requestmodule/'+$(this).attr('module-id'),
                error: function(data){
                    var errorDiv = $('.modules-form div.alert');
                    errorDiv.append('<div>'+data.error+'<div>');
                    console.log(data.error);
                },
                success: ShowModules,
            });
        });
    }

    var handleChangePassword = function(){
        $(".changepassword-form").validate({
            errorElement: 'div', //default input error message container
            //errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: ":disabled",
            rules: {
                old_password:{
                    required:true
                },
                new_password:{
                    required:true
                },
                new_password_confirmation:{
                    equalTo: "#new_password"
                }
            },

            messages: { // custom messages for radio buttons and checkboxes
                old_password:{
                    required:v_password_require
                },
                new_password:{
                    required:v_password_new_require
                },
                new_password_confirmation:{
                    equalTo: v_password_confirm
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label,element) {
                $(element).closest('.form-group').removeClass('has-error');
                label.remove();
                if($('.alert-danger', $('.changepassword-form')).find('div').length == 0){
                    $('.alert-danger', $('.changepassword-form')).hide();
                }
            },

            errorPlacement: function(error, element) {
                error.appendTo(element.parents('form').find('div.alert'));
                element.parents('form').find('div.alert').css("background-color","#fbe1e3");
                element.parents('form').find('div.alert').css("border-color","#fbe1e3");
                element.parents('form').find('div.alert').css("color","red");
                element.parents('form').find('div.alert').show();
            },

            submitHandler: function(form, event) {
                event.preventDefault();
                var errorDiv = $(form).find('div.alert');
                var formData = new FormData();

                $('input[type="text"], input[type="password"], input[type="hidden"]').each(function(i){
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
                    errorDiv.find("div").remove();
                    if (data.status === 422) {//wrong password
                        $.each(data.responseJSON.error, function(i,v){
                            errorDiv.append("<div wrong>"+v+"</div>");
                            errorDiv.show();
                            WindowScrollTopAnimation('.changepassword-form div.alert', 500);
                        });
                    } else {
                        //log error
                        errorDiv.show();
                        errorDiv.append("<div>Unknown error occurs.</div>");
                        console.log(data.responseText);
                        WindowScrollTopAnimation('.changepassword-form div.alert', 500);
                    }
                },
                success: function (data){
                        errorDiv.find('div').remove();
                        errorDiv.show();
                        errorDiv.css("background-color","#9FDE8A");
                        errorDiv.css("border-color","#9FDE8A");
                        errorDiv.css("color","#437A31");
                        errorDiv.append("<div success>"+data.message+"</div>");
                        WindowScrollTopAnimation('.changepassword-form div.alert', 500);
                },
                });
                
            }
        });
    
        $('.changepassword-form input').keypress(function(e) {
            $('.alert-danger', $('.changepassword-form')).find('div[success]').remove();
            $('.alert-danger', $('.changepassword-form')).find('div[wrong]').remove();
            if (e.which == 13) {
                $('.changepassword-form').validate();
            }
        });
    }

    return {
        //main function
        init: function() {
            handlePersonelInfo();
            handleModules();
            handleChangePassword();
        },
    };
}();

if (App.isAngularJsApp() === false) { 
jQuery(document).ready(function() {
    Profile.init();
});
}

function OnTypeAndOccupationChange(){
    var $type = $('select[name="type"]');
                var $type_v = $('select[name="type"]').val();
                var $oc = $('div.user_occupation_panel');
                var $oc_v = $('select[name="occupation"]').val();
                var $div = $('div#pre-hidden-group');
                var $dept = $('div.department-panel');

                $('div[hide]').hide();
                $('div[hide] input').prop("disabled",true);
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
                        $('div[student]').show();
                        $('div[student] input').prop("disabled",false);
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
                    $('div[student]').slideUp();
                    $('div[student] input').prop("disabled",true);
                    $('div[outsider]').show();
                    $('div[outsider] input').prop("disabled",false);
                    $div.slideDown();
                }
}

function OnNationalityChange(){
    if($('select[name="nationality"]').val() == "1"){
                    $('input[name="citizen_id"]').prop("disabled",false);
                    $('input[name="citizen_id"]').parents("div.form-group").show();
                    $('input[name="passport_id"]').prop("disabled",true);
                    $('input[name="passport_id"]').parents("div.form-group").hide();
                }else if($('select[name="nationality"]').val() != ""){
                    $('input[name="citizen_id"]').prop("disabled",true);
                    $('input[name="citizen_id"]').parents("div.form-group").hide();
                    $('input[name="passport_id"]').prop("disabled",false);
                    $('input[name="passport_id"]').parents("div.form-group").show();
                }
}

function ValidateFileInput(){
    var result = true;
    $('.profile-form input[type="file"]').each(function(){
        $(this).parents('.file-panel').find('span.file-custom-error').remove();
        if($(this).val() == ''){
            result = false;
            $(this).parents('.file-panel').append('<span class="file-custom-error">please upload file</span');
        }
        if($(this).parents('.file-panel').find('input[name="filedesc[]"]').val() == ''){
            result = false;
            if($(this).parents('.file-panel').find('span.file-custom-error').length != 0){
                $(this).parents('.file-panel').find('span.file-custom-error').html($(this).parents('.file-panel').find('span.file-custom-error').html() + " and description");
            }else{
                $(this).parents('.file-panel').append('<span class="file-custom-error">description is required.</span');
            }
        }
    });
    if(!result){
        WindowScrollTopAnimation(".file-portlet",500);
    }
    return result;
}

function showCurrentFile(data){
        $('.current-file-panel').html('')
            for(i in data){
                //$('.current-file-panel').append('<tr><td>'+data[i]["description"]+'</td><td><a href="'+data[i]["path"]+'">link</a></td><td><input type="button" class="doc-delete-button" file-id="'+data[i]["id"]+'"></td></tr>');
                $('.current-file-panel').append('<div class="tile image selected">'+
                                    '<div class="tile-body">'+
                                    '<a target="_blank" href="/'+data[i]["path"]+'"><img src="'+data[i]["path"]+'" alt=""></a></div>'+
                                    '<div class="tile-object">' +
                                    '<i class="fa fa-close doc-delete-button" data-toggle="confirmation" data-placement="top" file-id="'+data[i]["id"]+'">'+
                                    '</div></div>');

                $('.current-file-panel [data-toggle="confirmation"]').last().confirmation({title:profile_filedeleteconfirm,container:"body",btnOkClass:"btn btn-sm btn-success",btnCancelClass:"btn btn-sm btn-danger"});
            }

            
}

function ProcessFileDeleteError(data){
    console.log('alert on file delete');
}

function RefreshInputFile(){
    $('.profile-form .file-portlet .file-panel').remove();
    //binding file input change delegate event on parent element doesn't trigger, so need to manually attached event every time the element added.
    $('.profile-form input[type="file"]').last().on("change",function(){
        ValidateFileInput();
    });
}

function ShowModules(data){
    var container = $('#modules-table tbody')
    container.html('');
    $.each(data,function(i,v){
        var lb_type = '';
        var request_btntext = '';                                   
        var action_element = '';                                 
        switch(v.status_id){
            case 1:
                lb_type = 'label-info';
                request_btntext = module_requestbtntext;
                action_element =    '<div class="actions">'+
                                '<div class="btn-group">'+
                                '<a class="btn dark btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false"> '+module_actionbtntext+
                                '<i class="fa fa-angle-down"></i></a>'+
                                '<ul class="dropdown-menu pull-right">'+
                                '<li><a class="module-request-btn" module-id="'+v.module_id+'" href="javascript:;">'+request_btntext+'</a></li></ul></div></div>';
                break;
            case 2:
                lb_type = 'label-warning';
                break;
            case 3:
                lb_type = 'label-success';
                break;
            case 4:
                lb_type = 'label-danger';
                request_btntext = module_againbtntext;
                action_element =    '<div class="actions">'+
                                '<div class="btn-group">'+
                                '<a class="btn dark btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false"> '+module_actionbtntext+
                                '<i class="fa fa-angle-down"></i></a>'+
                                '<ul class="dropdown-menu pull-right">'+
                                '<li><a class="module-request-btn" module-id="'+v.module_id+'" href="javascript:;">'+request_btntext+'</a></li></ul></div></div>';
                break;
            default:
                lb_type = 'label-info';
        }

        
         
        container.append('<tr></tr>');

        container.find('tr').last().append('<td>'+v.module+'</td>');
        container.find('tr').last().append('<td><span class="label label-sm '+lb_type+'">'+v.status+'</td>');
        container.find('tr').last().append('<td>'+action_element+'</td>');
    });
}

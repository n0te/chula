var Profile = function() {
    var handlePersonelInfo = function (){
        
        dialog = $( "#reject-dialog" ).dialog({
            autoOpen: false,
            height: 'auto',
            width: 'auto',
            modal: true,
            fluid: true, //new option
            resizable: false,
        });

        $('body').on('click','button[type="submit"].approve',function(e){
            e.preventDefault();
            $(this).closest('form').attr('action','/approve/'+ $(this).attr('module-id')+'/'+$('.profile-form').find('input#_userid').val());
            $.ajax({
                url:$(this).closest('form').attr('action'),
                method: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,
                error: function (data) {
                    var errorDiv = $('.profile-content div.alert');
                    errorDiv.find("div").remove();
                    if (data.status === 422) {//could be email redundant
                        $.each(data.responseJSON.error, function(i,v){
                            errorDiv.append("<div>"+v+"</div>");
                            errorDiv.show();
                        });
                    } else {
                        //log error
                        errorDiv.show();
                        errorDiv.append("<div>Unknown error occurs.</div>");
                        console.log(data.responseText);
                    }
                },
                    success: function (data){
                        $.get('/getreviewmodules/'+$('.profile-form').find('input#_userid').val(), showReviewModules);
                    },
                
            });
            
        });

        $('body').on('click','button[type="reject"]',function(e){
            e.preventDefault();
            dialog.dialog('open');
            $( "#reject-dialog div.alert" ).removeClass('success').hide();
            $('.reject-form').attr('action','/reject/'+$(this).attr('module-id')+'/'+$('.profile-form').find('input#_userid').val());
        });

        $('.profile-form input').prop('disabled',true);
        $.get('/getdocuments/'+$('.profile-form').find('input#_userid').val(), showCurrentFile);
        $.get('/getreviewmodules/'+$('.profile-form').find('input#_userid').val(), showReviewModules);
        
        $('.reject-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: ":disabled",
            rules: {
                rejectmsg: {
                    required: true
                }
            },

            messages: { 
                rejectmsg: {
                    required: v_rejectmsg_require
                }
            },
            
            
            highlight: function(element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            
            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element);        
            },

            submitHandler: function(form, event) {
                event.preventDefault();
                //clear all disabled input
                var errorDiv = $(form).parents('#reject-dialog').find('div.alert');
                
                var formData = new FormData();
                $('input[type="text"]').each(function(i){
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
                    if (data.status === 422) {//could be email redundant
                        $.each(data.responseJSON.error, function(i,v){
                            errorDiv.append("<div>"+v+"</div>");
                            errorDiv.show();
                        });
                        WindowScrollTopAnimation('.profile-content div.alert', 500);
                    } else {
                        //log error
                        errorDiv.show();
                        errorDiv.append("<div>Unknown error occurs.</div>");
                        console.log(data.responseText);
                        WindowScrollTopAnimation('.profile-content div.alert', 500);
                    }
                },
                    success: function (data){
                        errorDiv.find('div').remove();
                        errorDiv.show();
                        errorDiv.addClass('success');
                        errorDiv.append("<div>"+data.message+' กำลังปิดหน้าต่างนี้....'+"</div>");
                        $('.reject-form input[name="rejectmsg"]').val('');
                        $.get('/getreviewmodules/'+$('.profile-form').find('input#_userid').val(), showReviewModules);
                        setTimeout(function(){
                            dialog.dialog('close');
                        }, 1500);
                    },
                });
            }
        });

        
    }

    return {
        //main function
        init: function() {
            handlePersonelInfo();
        },
    };
}();

if (App.isAngularJsApp() === false) { 
jQuery(document).ready(function() {
    Profile.init();
});
}

function showCurrentFile(data){
        $('.current-file-panel').html('')
            for(i in data){
                //$('.current-file-panel').append('<tr><td>'+data[i]["description"]+'</td><td><a href="'+data[i]["path"]+'">link</a></td><td><input type="button" class="doc-delete-button" file-id="'+data[i]["id"]+'"></td></tr>');
                $('.current-file-panel').append('<div class="tile image selected">'+
                                    '<div class="tile-body">'+
                                    '<a target="_blank" href="/'+data[i]["path"]+'"><img src="/'+data[i]["path"]+'" alt=""></a></div>'+
                                    '<div class="tile-object">' +
                                    '</div></div>');

                //$('.current-file-panel [data-toggle="confirmation"]').last().confirmation({title:profile_filedeleteconfirm,container:"body",btnOkClass:"btn btn-sm btn-success",btnCancelClass:"btn btn-sm btn-danger"});
            }

            
}

function showReviewModules(data){
    var container = $('.modules-panel tbody')
    container.html('');
    $.each(JSON.parse(data),function(i,v){
        var lb_type = '';
        var request_btntext = '';                                   
        var action_element = '';                                 
        switch(v.status+''){
            case '1':
                lb_type = 'label-info';
                action_element = '';
                break;
            case '2':
                lb_type = 'label-warning';
                action_element = '<form><button type="submit" module-id="'+v.m_id+'"" class="btn green approve">' +
                                 module_adminapprovebtntext+'</button>'+
                                 '<button type="reject" module-id="'+v.m_id+'" class="btn red">' +
                                 module_adminrejectbtntext+'</button></form>'
                break;
            case '3':
                lb_type = 'label-success';
                action_element = '';
                break;
            case '4':
                lb_type = 'label-danger';
                action_element = '';
                break;
            default:
                lb_type = 'label-info';
                action_element = '';
        }

        
         
        container.append('<tr></tr>');

        container.find('tr').last().append('<td>'+v.m_name+'</td>');
        container.find('tr').last().append('<td><span class="label label-sm '+lb_type+'">'+v.statusname+'</td>');
        container.find('tr').last().append('<td>'+action_element+'</td>');
    });
    //alert(data);
}

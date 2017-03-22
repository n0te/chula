var MembersList = function() {
    var handleMembersList = function(){
        showMembersList();
        $('body').on('click','button.refreshmemberlist',function(e){
            e.preventDefault();
            showMembersList();
        });
    }

    return {
        //main function
        init: function() {
            handleMembersList();
        },
    };
}();

if (App.isAngularJsApp() === false) { 
jQuery(document).ready(function() {
    MembersList.init();
});
}

function showMembersList(){
    var memberslistTable = $('#memberlist-table');
    memberslistTable.css('opacity','0.5');
    var errorDiv = $('.memberslist-content div.alert');
    $.ajax({
        url:$('.memberslist-content form').attr('action'),
        method: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,

        error: function (data) {
            errorDiv.find("div").remove();
            //log error
            errorDiv.show();
            errorDiv.append("<div>Unknown error occurs.</div>");
            console.log(data.responseText);
            WindowScrollTopAnimation('.memberslist-content div.alert', 500);
        },
        success: function (data){
            errorDiv.hide();
            var container = $('#memberlist-table tbody');
            container.html('');
            $.each(JSON.parse(data),function(i,v){
                var lb_type = '';                              
                switch(v.status){
                    case 1:
                        lb_type = 'label-info';
                        break;
                    case 2:
                        lb_type = 'label-warning';
                        break;
                    case 3:
                        lb_type = 'label-success';
                        break;
                    case 4:
                        lb_type = 'label-danger';
                        break;
                    default:
                        lb_type = 'label-info';
                }
                 
                container.append('<tr></tr>');

                container.find('tr').last().append('<td>'+v.modulename+'</td>');
                container.find('tr').last().append('<td>'+v.firstname+' '+v.lastname+'</td>');
                container.find('tr').last().append('<td>'+v.email+'</td>');
                container.find('tr').last().append('<td><span class="label label-sm '+lb_type+'">'+v.statusname+'</td>');
                container.find('tr').last().append('<td><a target="blank" href="/reviewprofile/'+v.userid+'"><button class="btn blue">'+memberlist_reviewbtntext+'</button></td>');
            });
            memberslistTable.css('opacity','1');
            memberslistTable.DataTable();
        }
    });
    
}

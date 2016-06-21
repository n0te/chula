var sudoNotify = $('.notification-container').sudoNotify({
    log: true,
    position: "top",
    animation: {
        type: "slide-fade", //fade, scroll-left, scroll-left-fade, scroll-right, scroll-right-fade, slide, slide-fade or none
        showSpeed: 400,
        hideSpeed: 250
    },
});
$(document).ready(function () {
    //$('#tblReviewform').DataTable();
});
function OpenRejectForm(fid) {
    $("#txtRejectReason").val('');
    $("#hidfid").val(fid);
}

function SaveReject() {
    var postData = {
        'fid': $("#hidfid").val(),
        'reasontorej': $("#txtRejectReason").val()
    };
    $.ajax({
        type: "POST",
        url: '/SaveReject',
        data: postData,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $('#mdlReject').modal('toggle');
            sudoNotify.success("บันทึกข้อมูลเรียบร้อย");
            
        },
        error: function () {
            alert("Fail to get data.");
        }
    });
}
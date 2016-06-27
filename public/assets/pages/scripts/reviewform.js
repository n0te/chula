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
    $('#tblReviewform').DataTable({
        "columnDefs": [{
                targets: [2, 3, 4, 5],
                "orderable": false,
            }],
        "lengthChange": false,
        "info": false,
        "pagingType": "full_numbers"
    });
    $('#txtMemoDate').datepicker({
        format: 'dd/mm/yyyy'
    });
});
function OpenRejectForm(fid) {
    $("#txtRejectReason").val('');
    $("#hidfid").val(fid);
}
function OpenCreateMemo(fid) {
    $("#hidfid").val(fid);
    $("#txtMemoRound").val('');
    $("#txtMemoDate").val('');
    $.ajax({
        url: '/getFormDataByID/' + fid,
        method: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        error: function (data) {
            console.log(data.responseText);
        },
        success: function (data) {

            if (data['Formreq'][0].FormReqMemoRound === null) {
                $("#txtMemoRound").val('');
            } else {
                $("#txtMemoRound").val(data['Formreq'][0].FormReqMemoRound);
            }
            if (data['Formreq'][0].FormReqMemoDate === null) {
                $("#txtMemoDate").val('');
            } else {
                $("#txtMemoDate").val($.format.date(data['Formreq'][0].FormReqMemoDate + 'T00:00:00.000', 'dd-MM-yyyy'));
            }
        }
    });

}
function SaveMemo() {

    if ($.trim($("#txtMemoRound").val()).length === 0) {
        sudoNotify.error("กรุณากรอกครั้งที่");
        return false;
    }
    if ($.trim($("#txtMemoDate").val()).length === 0) {
        sudoNotify.error("กรุณากรอกวันที่");
        return false;
    }

    var postData = {
        'fid': $("#hidfid").val(),
        'MemoRound': $("#txtMemoRound").val(),
        'MemoDate': $("#txtMemoDate").val()
    };
    $.ajax({
        type: "POST",
        url: '/SaveMemo',
        data: postData,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            //$('#mdlReject').modal('toggle');
            sudoNotify.success("บันทึกข้อมูลเรียบร้อย...กำลังกลับไปหน้าจัดการแบบฟอร์ม");
            window.location.href = '/createdocx/' + $("#hidfid").val() + '_memo';
            setTimeout(function () {
                window.location.href = "/reviewform";
            }, 3000);
        },
        error: function () {
            alert("Fail to get data.");
        }
    });
}
function SaveReject() {

    if ($.trim($("#txtRejectReason").val()).length === 0) {
        sudoNotify.error("กรุณากรอกเหตุผลในการปฏิเสธ");
        return false;
    }

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
            //$('#mdlReject').modal('toggle');
            sudoNotify.success("บันทึกข้อมูลเรียบร้อย...กำลังกลับไปหน้าจัดการแบบฟอร์ม");
            setTimeout(function () {
                window.location.href = "/reviewform";
            }, 1000);
        },
        error: function () {
            alert("Fail to get data.");
        }
    });
}
function OpenAnnouncementNumber(fid) {
    $('#fupPDF').fileinput('clear');
    $("#hidfid").val(fid);
    $('#txtAnnouncementNumber').val('');
    $.ajax({
        url: '/getFormDataByID/' + fid,
        method: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        error: function (data) {
            console.log(data.responseText);
        },
        success: function (data) {

            if (data['Formreq'][0].FormReqAnnouncementNumber === null) {
                $("#txtAnnouncementNumber").val('');
            } else {
                $("#txtAnnouncementNumber").val(data['Formreq'][0].FormReqAnnouncementNumber);
            }
            //$("#fupPDF").text(data['Formreq'][0].FormReqCRCNumber + '.pdf');

        }
    });
}
function SaveAnnouncementNumber() {

    if ($.trim($("#txtAnnouncementNumber").val()).length === 0) {
        sudoNotify.error("กรุณากรอกรหัสประกาศ");
        return false;
    }
    if ($('#fupPDF').val() === "") {
        sudoNotify.error("กรุณาเลือกไฟล์ PDF");
        return false;
    }

    var fd = new FormData();
    fd.append('fid', $("#hidfid").val());
    fd.append('file', $('#fupPDF').prop('files')[0]);
    fd.append('AnnouncementNumber', $('#txtAnnouncementNumber').val());
    $.ajax({
        url: '/SaveAnnouncementNumber',
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
            console.log(data);
            //$('#mdlReject').modal('toggle');
            sudoNotify.success("บันทึกข้อมูลเรียบร้อย...กำลังกลับไปหน้าจัดการแบบฟอร์ม");
            setTimeout(function () {
                window.location.href = "/reviewform";
            }, 1000);
        },
        error: function () {
            alert("Fail to get data.");
        }
    });
}
var Objective = {};
var ManagementProject = {};
var TopicBudget1 = {};
var TopicBudget2 = {};
var TopicBudget3 = {};
var TopicBudget4 = {};
var TopicBudget5 = {};
var TopicBudget6 = {};
var TopicBudget7 = {};
var Payroll = {};
var AuthorizedPerson = {};
var PayDate = {};
var wizard;

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
    // $('form').each(function () {
    //     $(this).find('input').keypress(function (e) {
    //         // Enter pressed?
    //         if (e.which == 10 || e.which == 13) {
    //             validate();
    //             return false;
    //         }
    //     });

    //     $(this).find('input[type=submit]').hide();
    // });

    wizard = $("#formwiz").steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        titleTemplate: '#title#',
        startIndex: activestep,
        labels: {
            cancel: "Cancel",
            current: "current step:",
            pagination: "Pagination",
            finish: "ส่งข้อเสนอโครงการ",
            next: "ถัดไป",
            previous: "ย้อนกลับ",
            loading: "Loading ..."
        },
        onInit: function (event, currentIndex) {
            $("#hidCurrentStep").val(currentIndex);
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
//            if (currentIndex == 4) {
//                var get31count = TopicBudget1.getFormsCount();
//                if (get31count !== 0) {
//                    var Payroll4 = [];
//                    for (var i = 0; i < get31count; i++) {
//                        Payroll4.push({
//                            topic: $('#TopicBudget1_Topic_' + i).val(),
//                            amout: $('#TopicBudget1_Amount_' + i).val()
//                        });
//                    }
//                    Payroll.inject(Payroll4);
//                    for (var i = 0; i < Payroll4.length; i++) {
//                        $("#Payroll_" + i).val(i);
//                        $("#Payroll_Name_" + i).val(Payroll4[i].topic);
//                        $("#Payroll_Amount_" + i).val((Payroll4[i].amout === 0) ? '' : Payroll4[i].amout);
//                    }
//
//                }
//            }
            $("#hidCurrentStep").val(currentIndex);
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if (newIndex < currentIndex) {
                return true;
            } else {
                if (currentIndex === 0) {
                    if (validateDetail()) {
                        $("#hidCurrentStep").val(newIndex);
                        PreSave();
                        return true;
                    }
                }
                if (currentIndex === 1) {
                    if (validate1()) {
                        $("#hidCurrentStep").val(newIndex);
                        PreSave();
                        return true;
                    }
                }
                if (currentIndex === 2) {
                    if (validate2()) {
                        $("#hidCurrentStep").val(newIndex);
                        PreSave();
                        return true;
                    }
                }
                if (currentIndex === 3) {
                    if (validate31() === false) {
                        return false;
                    }
                    if (validate32() === false) {
                        return false;
                    }
                    if (validate33() === false) {
                        return false;
                    }
                    if (validate34() === false) {
                        return false;
                    }
                    if (validate35() === false) {
                        return false;
                    }
                    if (validate36() === false) {
                        return false;
                    }
                    if (validate37() === false) {
                        return false;
                    }
                    $("#hidCurrentStep").val(newIndex);
                    PreSave();
                    return true;
                }
                if (currentIndex === 4) {
                    if (validate4()) {
                        $("#hidCurrentStep").val(newIndex);
                        PreSave();
                        return true;
                    }
                }
                if (currentIndex === 5) {
                    if ($("#txtAccountNumber").val() === '0454923038') {
                        var bg = parseFloat($("#txtBudgetScholarship").val());
                        var textbg = '';
                        if (bg > 500000) {
                            textbg = 'ให้คณบดีแพทยศาสตร์ เป็นผู้มีอำนาจสั่งจ่ายในวงเงินครั้งละไม่เกิน 500,000.00 บาท';
                        } else {
                            textbg = 'ให้คณบดีแพทยศาสตร์ เป็นผู้มีอำนาจสั่งจ่ายในวงเงินครั้งละไม่เกิน ' + $.number(bg, 2) + ' บาท';
                        }

                        $("#txtNotation").val(textbg);
                    }
                    if (validate5()) {
                        $("#hidCurrentStep").val(newIndex);
                        PreSave();
                        return true;
                    }
                }
                if (currentIndex === 6) {
                    if (validate6()) {
                        $("#hidCurrentStep").val(newIndex);
                        PreSave();
                        return true;
                    }
                }
                if (currentIndex === 7) {
                    if (validate7()) {
                        $("#hidCurrentStep").val(newIndex);
                        PreSave();
                        return true;
                    }
                }

            }
        },
        onFinishing: function (event, currentIndex) {
            if (currentIndex === 8) {
                $("#hidCurrentStep").val(currentIndex);
                SendData();
                return true();
            }
        }
    });
    // wizard.steps("setStep", 7);
    $('input.number').number(true, 2);
    $('#txtStartDateScholarship').datepicker({
        format: 'dd/mm/yyyy'
    });
    $('#txtEndDateScholarship').datepicker({
        format: 'dd/mm/yyyy'
    });

    $('#ddlDepartment').change(function () {
        if ($(this).val() == '22') {
            $('#divOtherDepartment').show("slow");
        } else {
            $('#divOtherDepartment').hide("slow");
        }
    });
    ManagementProject = $('#ManagementProject').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        maxFormsCount: 100,
        minFormsCount: 0,
        iniFormsCount: 1
//        afterAdd: function (source, newForm) {
//            //alert(newForm.find('#ManagementProject_label').text());
//
//            var aa = parseInt(newForm.find('#ManagementProject_label').text());
//            $('#ManagementProject_' + (aa - 1)).closest(".form-group").find("label").text("2.2." + (aa + 1));
//        }
    });

    Objective = $('#Objective').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        maxFormsCount: 100,
        minFormsCount: 1,
        iniFormsCount: 1
    });
    TopicBudget1 = $('#TopicBudget1').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        maxFormsCount: 100,
        minFormsCount: 0,
        iniFormsCount: 0,
        afterAdd: function (source, newForm) {
            bindAutoSumBG1();
            $('input.number').number(true, 2);
        },
        afterRemoveCurrent: function (source) {
            sumBG1();
        }
    });
    TopicBudget2 = $('#TopicBudget2').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        maxFormsCount: 100,
        minFormsCount: 0,
        iniFormsCount: 0,
        afterAdd: function (source, newForm) {
            bindAutoSumBG2();
            $('input.number').number(true, 2);
        },
        afterRemoveCurrent: function (source) {
            sumBG2();
        }
    });
    TopicBudget3 = $('#TopicBudget3').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        maxFormsCount: 100,
        minFormsCount: 0,
        iniFormsCount: 0,
        afterAdd: function (source, newForm) {
            bindAutoSumBG3();
            $('input.number').number(true, 2);
        },
        afterRemoveCurrent: function (source) {
            sumBG3();
        }
    });
    TopicBudget4 = $('#TopicBudget4').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        maxFormsCount: 100,
        minFormsCount: 0,
        iniFormsCount: 0,
        afterAdd: function (source, newForm) {
            bindAutoSumBG4();
            $('input.number').number(true, 2);
        },
        afterRemoveCurrent: function (source) {
            sumBG4();
        }
    });
    TopicBudget5 = $('#TopicBudget5').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        maxFormsCount: 100,
        minFormsCount: 0,
        iniFormsCount: 0,
        afterAdd: function (source, newForm) {
            bindAutoSumBG5();
            $('input.number').number(true, 2);
        },
        afterRemoveCurrent: function (source) {
            sumBG5();
        }
    });
    TopicBudget6 = $('#TopicBudget6').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        maxFormsCount: 100,
        minFormsCount: 0,
        iniFormsCount: 0,
        afterAdd: function (source, newForm) {
            bindAutoSumBG6();
            $('input.number').number(true, 2);
            var chkboxid = newForm.find('[type=checkbox]').attr('id');
            var lastChar = chkboxid.substr(chkboxid.length - 1);
            $("#" + chkboxid).change(function () {
                if (this.checked) {
                    $("#" + chkboxid).val('1');
                    $('#TopicBudget6_Amount_' + lastChar).val('0');
                    $('#TopicBudget6_Amount_' + lastChar).prop('readonly', true);
                    sumBG6();
                } else {
                    $("#" + chkboxid).val('0');
                    $('#TopicBudget6_Amount_' + lastChar).val('0');
                    $('#TopicBudget6_Amount_' + lastChar).prop('readonly', false);
                    sumBG6();
                }


            });
        },
        afterRemoveCurrent: function (source) {
            sumBG6();
        }
    });
    TopicBudget7 = $('#TopicBudget7').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        maxFormsCount: 100,
        minFormsCount: 0,
        iniFormsCount: 0,
        afterAdd: function (source, newForm) {
            bindAutoSumBG7();
            $('input.number').number(true, 2);
            var chkboxid = newForm.find('[type=checkbox]').attr('id');
            var lastChar = chkboxid.substr(chkboxid.length - 1);
            $("#" + chkboxid).change(function () {
                if (this.checked) {
                    $("#" + chkboxid).val('1');
                    $('#TopicBudget7_Amount_' + lastChar).val('0');
                    $('#TopicBudget7_Amount_' + lastChar).prop('readonly', true);
                    sumBG7();
                } else {
                    $("#" + chkboxid).val('0');
                    $('#TopicBudget7_Amount_' + lastChar).val('0');
                    $('#TopicBudget7_Amount_' + lastChar).prop('readonly', false);
                    sumBG7();
                }
            });
        },
        afterRemoveCurrent: function (source) {
            sumBG7();
        }
    });
//
//    TopicBudget = $('#TopicBudget').sheepIt({
//        separator: '',
//        allowRemoveLast: false,
//        allowRemoveCurrent: true,
//        allowRemoveAll: false,
//        allowAdd: true,
//        maxFormsCount: 100,
//        minFormsCount: 1,
//        iniFormsCount: 1,
////        afterAdd: function (source, newForm) {
////            if ((TopicBudget).length) {
////                var rindex = (parseInt(newForm.find('#TopicBudget_label').text()) - 1);
////                newForm.find('input').each(function () {
////                    var oldid = ((this.id).slice(0, -1)) + rindex;
////                    var oldname = (this.name.slice(0, -1)) + rindex;
////                    this.id = oldid;
////                    this.name = oldname;
////                })
////            }
////        },
////        afterRemoveCurrent: function (source) {
////            var ddd = TopicBudget.getFormsCount();
////            for (var i = 0; i < ddd; i++) {
////                $("[id*=TopicBudget_Topic_]").each(function () {
////                    var oldid = ((this.id).slice(0, -1)) + i;
////                    var oldname = (this.name.slice(0, -1)) + i;
////                    this.id = oldid;
////                    this.name = oldname;
////                });
////                $("[id*=TopicBudget_Amount_]").each(function () {
////                    var oldid = ((this.id).slice(0, -1)) + i;
////                    var oldname = (this.name.slice(0, -1)) + i;
////                    this.id = oldid;
////                    this.name = oldname;
////                });
////            }
////        },
//        nestedForms: [
//            {
//                id: 'TopicBudget_#index#_Sub',
//                options: {
//                    indexFormat: '#index_Sub#',
//                    separator: '',
//                    allowRemoveLast: false,
//                    allowRemoveCurrent: true,
//                    allowRemoveAll: false,
//                    allowAdd: true,
//                    maxFormsCount: 100,
//                    minFormsCount: 0,
//                    iniFormsCount: 0,
//                    afterAdd: function (source, newForm) {
//                        var rindex = (parseInt(newForm.parent().parent().parent().find('#TopicBudget_label:eq(0)').text()));
//                        newForm.find('#TopicBudget_label').text(rindex);
//                    },
//                }
//            }
//        ]
//
//    });
    Payroll = $('#Payroll').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        allowAddN: false,
        maxFormsCount: 100,
        minFormsCount: 0,
        iniFormsCount: 0
    });
    AuthorizedPerson = $('#AuthorizedPerson').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        allowAddN: false,
        maxFormsCount: 100,
        minFormsCount: 0,
        iniFormsCount: 0
    });
    PayDate = $('#PayDate').sheepIt({
        separator: '',
        allowRemoveLast: false,
        allowRemoveCurrent: true,
        allowRemoveAll: false,
        allowAdd: true,
        allowAddN: false,
        maxFormsCount: 100,
        minFormsCount: 1,
        iniFormsCount: 1
    });

    if (fid !== '') {
        $.ajax({
            url: '/getFormDataByID/' + fid,
            method: 'get',
            dataType: 'json',
            contentType: false,
            processData: false,
            error: function (data) {
                console.log(data.responseText);
                //alert(data.responseText);
                //WindowScrollTopAnimation('#profile div.alert', 500);
            },
            success: function (data) {
                //alert(data);
                //console.log(data);
                $("#hidfid").val(fid);
                $("#txtTopic").val(data['Formreq'][0].FormReqTopic);
                $("#ddlDepartment").val(data['Formreq'][0].FormReqDepartment);
                if (data['Formreq'][0].FormReqDepartment === "22") {
                    $('#divOtherDepartment').show();
                }
                $("#txtOtherDepartment").val(data['Formreq'][0].FormReqOtherDepartment);
                $("#txtTel").val(data['Formreq'][0].FormReqTel);
                $("#ddlKnowlageType").val(data['Formreq'][0].FormReqKnowlageType);
                $("#txtTo").val(data['Formreq'][0].FormReqTo);
                $("#ddlRequesterTitle").val(data['Formreq'][0].FormReqRequesterTitle);
                $("#txtRequesterFirstname").val(data['Formreq'][0].FormReqRequesterFirstname);
                $("#txtRequesterLastname").val(data['Formreq'][0].FormReqRequesterLastname);
                $("#txtSponser").val(data['Formreq'][0].FormReqSponser);
                $("#txtBudgetScholarship").val((data['Formreq'][0].FormReqBudgetScholarship === 0) ? '' : data['Formreq'][0].FormReqBudgetScholarship);

                if (data['Formreq'][0].FormReqStartDateScholarship === null) {
                    $("#txtStartDateScholarship").val('');
                } else {
                    $("#txtStartDateScholarship").val($.format.date(data['Formreq'][0].FormReqStartDateScholarship + 'T00:00:00.000', 'dd-MM-yyyy'));
                }

                if (data['Formreq'][0].FormReqEndDateScholarship === null) {
                    $("#txtEndDateScholarship").val('');
                } else {
                    $("#txtEndDateScholarship").val($.format.date(data['Formreq'][0].FormReqEndDateScholarship + 'T00:00:00.000', 'dd-MM-yyyy'));
                }
                // $("#txtStartDateScholarship").val(data['Formreq'][0].FormReqStartDateScholarship);
                // $("#txtEndDateScholarship").val(data['Formreq'][0].FormReqEndDateScholarship);
                $("#txtResponsibleProjectPerson").val(data['Formreq'][0].FormReqResponsibleProjectPerson);
                $("#txtCaseIncome").val(data['Formreq'][0].FormReqCaseIncome);
                $("#txtBankName").val(data['Formreq'][0].FormReqBankName);
                $("#txtBranch").val(data['Formreq'][0].FormReqBranch);
                $("#txtAccountName").val(data['Formreq'][0].FormReqAccountName);
                $("#txtAccountNumber").val(data['Formreq'][0].FormReqAccountNumber);
                $("#txtNotation").val(data['Formreq'][0].FormReqNotation);
                $("#txtReport").val(data['Formreq'][0].FormReqReport);

                if (data['Formreq_Objective'].length > 0) {
                    Objective.inject(data['Formreq_Objective']);
                    for (var i = 0; i < data['Formreq_Objective'].length; i++) {
                        $("#Objective_" + i).val(data['Formreq_Objective'][i].Objective);
                    }
                }

                if (data['Formreq_ManagementProject'].length > 0) {
                    ManagementProject.inject(data['Formreq_ManagementProject']);
                    for (var i = 0; i < data['Formreq_ManagementProject'].length; i++) {
                        $("#ManagementProject_" + i).val(i);
                        $("#ManagementProject_Name_" + i).val(data['Formreq_ManagementProject'][i].ManagementProjectName);
                        $("#ManagementProject_Position_" + i).val(data['Formreq_ManagementProject'][i].ManagementProjectPosition);
                    }
                }
//
                if (data['Formreq_Budget31'].length > 0) {
                    TopicBudget1.inject(data['Formreq_Budget31']);
                    var sum31 = 0;
                    for (var i = 0; i < data['Formreq_Budget31'].length; i++) {
                        $("#TopicBudget1_Topic_" + i).val(data['Formreq_Budget31'][i].Formreq_Budget_Topic);
                        $("#TopicBudget1_Amount_" + i).val((data['Formreq_Budget31'][i].Formreq_Budget_Amount === 0) ? '' : data['Formreq_Budget31'][i].Formreq_Budget_Amount);
                        sum31 += parseFloat(data['Formreq_Budget31'][i].Formreq_Budget_Amount);
                    }
                    $("#TopicBudget1_sum").val(sum31);
                }

                if (data['Formreq_Budget32'].length > 0) {
                    TopicBudget2.inject(data['Formreq_Budget32']);
                    var sum32 = 0;
                    for (var i = 0; i < data['Formreq_Budget32'].length; i++) {
                        $("#TopicBudget2_Topic_" + i).val(data['Formreq_Budget32'][i].Formreq_Budget_Topic);
                        $("#TopicBudget2_Amount_" + i).val((data['Formreq_Budget32'][i].Formreq_Budget_Amount === 0) ? '' : data['Formreq_Budget32'][i].Formreq_Budget_Amount);
                        sum32 += parseFloat(data['Formreq_Budget32'][i].Formreq_Budget_Amount);
                    }
                    $("#TopicBudget2_sum").val(sum32);
                }

                if (data['Formreq_Budget33'].length > 0) {
                    TopicBudget3.inject(data['Formreq_Budget33']);
                    var sum33 = 0;
                    for (var i = 0; i < data['Formreq_Budget33'].length; i++) {
                        $("#TopicBudget3_Topic_" + i).val(data['Formreq_Budget33'][i].Formreq_Budget_Topic);
                        $("#TopicBudget3_Amount_" + i).val((data['Formreq_Budget33'][i].Formreq_Budget_Amount === 0) ? '' : data['Formreq_Budget33'][i].Formreq_Budget_Amount);
                        sum33 += parseFloat(data['Formreq_Budget33'][i].Formreq_Budget_Amount);
                    }
                    $("#TopicBudget3_sum").val(sum33);
                }

                if (data['Formreq_Budget34'].length > 0) {
                    TopicBudget4.inject(data['Formreq_Budget34']);
                    var sum34 = 0;
                    for (var i = 0; i < data['Formreq_Budget34'].length; i++) {
                        $("#TopicBudget4_Topic_" + i).val(data['Formreq_Budget34'][i].Formreq_Budget_Topic);
                        $("#TopicBudget4_Amount_" + i).val((data['Formreq_Budget34'][i].Formreq_Budget_Amount === 0) ? '' : data['Formreq_Budget34'][i].Formreq_Budget_Amount);
                        sum34 += parseFloat(data['Formreq_Budget34'][i].Formreq_Budget_Amount);
                    }
                    $("#TopicBudget4_sum").val(sum34);
                }

                if (data['Formreq_Budget35'].length > 0) {
                    TopicBudget5.inject(data['Formreq_Budget35']);
                    var sum35 = 0;
                    for (var i = 0; i < data['Formreq_Budget35'].length; i++) {
                        $("#TopicBudget5_Topic_" + i).val(data['Formreq_Budget35'][i].Formreq_Budget_Topic);
                        $("#TopicBudget5_Amount_" + i).val((data['Formreq_Budget35'][i].Formreq_Budget_Amount === 0) ? '' : data['Formreq_Budget35'][i].Formreq_Budget_Amount);
                        sum35 += parseFloat(data['Formreq_Budget35'][i].Formreq_Budget_Amount);
                    }
                    $("#TopicBudget5_sum").val(sum35);
                }

                if (data['Formreq_Budget36'].length > 0) {
                    TopicBudget6.inject(data['Formreq_Budget36']);
                    var sum36 = 0;
                    for (var i = 0; i < data['Formreq_Budget36'].length; i++) {
                        $("#TopicBudget6_Topic_" + i).val(data['Formreq_Budget36'][i].Formreq_Budget_Topic);
                        $("#TopicBudget6_Amount_" + i).val((data['Formreq_Budget36'][i].Formreq_Budget_Amount === 0) ? '' : data['Formreq_Budget36'][i].Formreq_Budget_Amount);
                        if (data['Formreq_Budget36'][i].Formreq_Budget_Except === 0) {
                            $("#TopicBudget6_Except_" + i).prop("checked", false);
                            $("#TopicBudget6_Except_" + i).val('0');
                        } else {
                            $("#TopicBudget6_Except_" + i).prop("checked", true);
                            $("#TopicBudget6_Except_" + i).val('1');
                            $('#TopicBudget6_Amount_' + i).prop('readonly', true);
                        }
                        sum36 += parseFloat(data['Formreq_Budget36'][i].Formreq_Budget_Amount);
                    }
                    $("#TopicBudget6_sum").val(sum36);
                }

                if (data['Formreq_Budget37'].length > 0) {
                    TopicBudget7.inject(data['Formreq_Budget37']);
                    var sum37 = 0;
                    for (var i = 0; i < data['Formreq_Budget37'].length; i++) {
                        $("#TopicBudget7_Topic_" + i).val(data['Formreq_Budget37'][i].Formreq_Budget_Topic);
                        $("#TopicBudget7_Amount_" + i).val((data['Formreq_Budget37'][i].Formreq_Budget_Amount === 0) ? '' : data['Formreq_Budget37'][i].Formreq_Budget_Amount);
                        if (data['Formreq_Budget37'][i].Formreq_Budget_Except === 0) {
                            $("#TopicBudget7_Except_" + i).prop("checked", false);
                            $("#TopicBudget7_Except_" + i).val('0');
                        } else {
                            $("#TopicBudget7_Except_" + i).prop("checked", true);
                            $("#TopicBudget7_Except_" + i).val('1');
                            $("#TopicBudget7_Amount_" + i).prop('readonly', true);
                        }
                        sum37 += parseFloat(data['Formreq_Budget37'][i].Formreq_Budget_Amount);
                    }
                    $("#TopicBudget7_sum").val(sum37);
                }

                if (data['Formreq_Payroll'].length > 0) {
                    Payroll.inject(data['Formreq_Payroll']);
                    for (var i = 0; i < data['Formreq_Payroll'].length; i++) {
                        $("#Payroll_" + i).val(i);
                        $("#Payroll_Name_" + i).val(data['Formreq_Payroll'][i].Payroll_Name);
                        $("#Payroll_Amount_" + i).val((data['Formreq_Payroll'][i].Payroll_Amount === 0) ? '' : data['Formreq_Payroll'][i].Payroll_Amount);
                    }
                }

                if (data['Formreq_AuthorizedPerson'].length > 0) {
                    AuthorizedPerson.inject(data['Formreq_AuthorizedPerson']);
                    for (var i = 0; i < data['Formreq_AuthorizedPerson'].length; i++) {
                        $("#AuthorizedPerson_" + i).val(i);
                        $("#AuthorizedPerson_" + i).val(data['Formreq_AuthorizedPerson'][i].AuthorizedPersonName);
                    }
                }

                if (data['Formreq_PayDate'].length > 0) {
                    PayDate.inject(data['Formreq_PayDate']);
                    for (var i = 0; i < data['Formreq_PayDate'].length; i++) {
                        $("#PayDate_" + i).val(i);
                        $("#PayDate_Amount_" + i).val((data['Formreq_PayDate'][i].PayDateAmount === 0) ? '' : data['Formreq_PayDate'][i].PayDateAmount);
                        $("#PayDate_Remark_" + i).val(data['Formreq_PayDate'][i].PayDateRemark);
                    }
                }

//                if (appr === 'yes') {
//                    if (data['Formreq'][0].FormReqApprovePerson1 !== null) {
//                        $('#divApprove1').show();
//                        $('#spnApprover1').text();
//                        $('#spnApproveDate1').text('วันที่อนุมัติ ' + data['Formreq'][0].FormReqApprove1Date);
//                    }
//
//
//                    $('input[type="text"], input[type="password"], input[type="hidden"], select').attr('readonly', 'readonly');
//                    $('form select').attr("disabled", true);
//                    $('form a').hide();
//                    $('#approveSeoction').show();
//                }
                sumallbud();
            }
        });
    }


    $('.actions ul').prepend('<li class="" aria-disabled="false"><a onclick="PreSave(); return false;" href="#" role="menuitem">บันทึก</a></li>');

});
function sumBG1() {

    var sum = 0;
    $(".sumBG1").each(function () {

        var value = $(this).val();
        // add only if the value is number
        if (!isNaN(value) && value.length !== 0) {
            sum += parseFloat(value);
        }
    });

    $('#TopicBudget1_sum').val(sum);
    sumallbud();
}
function bindAutoSumBG1() {
    $(".sumBG1").on("keyup", function () {
        sumBG1();
    });
}
function sumBG2() {

    var sum = 0;
    $(".sumBG2").each(function () {

        var value = $(this).val();
        // add only if the value is number
        if (!isNaN(value) && value.length !== 0) {
            sum += parseFloat(value);
        }
    });

    $('#TopicBudget2_sum').val(sum);
    sumallbud();
}
function bindAutoSumBG2() {
    $(".sumBG2").on("keyup", function () {
        sumBG2();
    });
}
function sumBG3() {

    var sum = 0;
    $(".sumBG3").each(function () {

        var value = $(this).val();
        // add only if the value is number
        if (!isNaN(value) && value.length !== 0) {
            sum += parseFloat(value);
        }
    });

    $('#TopicBudget3_sum').val(sum);
    sumallbud();
}
function bindAutoSumBG3() {
    $(".sumBG3").on("keyup", function () {
        sumBG3();
    });
}
function sumBG4() {

    var sum = 0;
    $(".sumBG4").each(function () {

        var value = $(this).val();
        // add only if the value is number
        if (!isNaN(value) && value.length !== 0) {
            sum += parseFloat(value);
        }
    });

    $('#TopicBudget4_sum').val(sum);
    sumallbud();
}
function bindAutoSumBG4() {
    $(".sumBG4").on("keyup", function () {
        sumBG4();
    });
}
function sumBG5() {

    var sum = 0;
    $(".sumBG5").each(function () {

        var value = $(this).val();
        // add only if the value is number
        if (!isNaN(value) && value.length !== 0) {
            sum += parseFloat(value);
        }
    });

    $('#TopicBudget5_sum').val(sum);
    sumallbud();
}
function bindAutoSumBG5() {
    $(".sumBG5").on("keyup", function () {
        sumBG5();
    });
}
function sumBG6() {

    var sum = 0;
    $(".sumBG6").each(function () {

        var value = $(this).val();
        // add only if the value is number
        if (!isNaN(value) && value.length !== 0) {
            sum += parseFloat(value);
        }
    });

    $('#TopicBudget6_sum').val(sum);
    sumallbud();
}
function bindAutoSumBG6() {
    $(".sumBG6").on("keyup", function () {
        sumBG6();
    });
}
function sumBG7() {

    var sum = 0;
    $(".sumBG7").each(function () {

        var value = $(this).val();
        // add only if the value is number
        if (!isNaN(value) && value.length !== 0) {
            sum += parseFloat(value);
        }
    });

    $('#TopicBudget7_sum').val(sum);
    sumallbud();
}
function bindAutoSumBG7() {
    $(".sumBG7").on("keyup", function () {
        sumBG7();
    });
}
function sumallbud() {

    var sum = 0;
    $(".sumallbud").each(function () {

        var value = $(this).val();
        // add only if the value is number
        if (!isNaN(value) && value.length !== 0) {
            sum += parseFloat(value);
        }
    });

    $('#TopicBudget_SumAll').val(sum);

}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function PreSave() {
    $("#hidSaveOrSend").val('Save');
    SaveData();
}
function SaveData() {
//                                            alert('dsadsad');
    var formData = new FormData();
    $('input[type="text"], input[type="checkbox"], textarea, input[type="password"], input[type="hidden"], select').each(function (i) {
        formData.append($(this).attr('id'), $(this).val());
    });
    var ObjectiveCount = Objective.getFormsCount();
    formData.append('ObjectiveCount', ObjectiveCount);
    var ManagementProjectCount = ManagementProject.getFormsCount();
    formData.append('ManagementProjectCount', ManagementProjectCount);
    var BudgetCount1 = TopicBudget1.getFormsCount();
    formData.append('BudgetCount1', BudgetCount1);
    var BudgetCount2 = TopicBudget2.getFormsCount();
    formData.append('BudgetCount2', BudgetCount2);
    var BudgetCount3 = TopicBudget3.getFormsCount();
    formData.append('BudgetCount3', BudgetCount3);
    var BudgetCount4 = TopicBudget4.getFormsCount();
    formData.append('BudgetCount4', BudgetCount4);
    var BudgetCount5 = TopicBudget5.getFormsCount();
    formData.append('BudgetCount5', BudgetCount5);
    var BudgetCount6 = TopicBudget6.getFormsCount();
    formData.append('BudgetCount6', BudgetCount6);
    var BudgetCount7 = TopicBudget7.getFormsCount();
    formData.append('BudgetCount7', BudgetCount7);
    var PayrollCount = Payroll.getFormsCount();
    formData.append('PayrollCount', PayrollCount);
    var AuthorizedPersonCount = AuthorizedPerson.getFormsCount();
    formData.append('AuthorizedPersonCount', AuthorizedPersonCount);
    var PayDateCount = PayDate.getFormsCount();
    formData.append('PayDateCount', PayDateCount);
    fid = $("#hidfid").val();
    formData.append('fid', fid);
    formData.append('SaveOrSend', $("#hidSaveOrSend").val());
    $.ajax({
        url: '/SaveForm',
        method: 'post',
        dataType: 'json',
        contentType: false,
        processData: false,
        data: formData,
        error: function (data) {
            console.log(data.responseText);
            alert(data.responseText);
            //WindowScrollTopAnimation('#profile div.alert', 500);
        },
        success: function (data) {
            //alert('555555');
            console.log(data);
            if ($("#hidSaveOrSend").val() === 'Save') {
                sudoNotify.success("บันทึกข้อมูลเรียบร้อย");
                $("#hidfid").val(data.lastid);
            } else {
                sudoNotify.success("ส่งข้อมูลเรียบร้อย กำลังกลับไปหน้า แบบฟอร์มทั้งหมด");
                setTimeout(function () {
                    window.location.href = "/allformrequest";
                }, 4000);
            }


        }

    });
}
function SendData() {
    $("#hidSaveOrSend").val('Send');
    SaveData();
    return false;
}


function validateDetail() {

    if ($.trim($("#txtTopic").val()).length === 0) {
        sudoNotify.error("กรุณากรอกชื่อโครงการวิจัย");
        return false;
    }
    if ($.trim($("#ddlDepartment").val()) === '') {
        sudoNotify.error("กรุณาเลือก ส่วนงาน ภาควิชา");
        return false;
    }
    if ($.trim($("#ddlDepartment").val()) === '22') {
        if ($.trim($("#txtOtherDepartment").val()).length === 0) {
            sudoNotify.error("กรุณากรอกส่วนงาน ภาควิชาอื่นๆ");
            return false;
        }
    }
    if ($.trim($("#txtTel").val()).length === 0) {
        sudoNotify.error("กรุณากรอกเบอร์โทรศัพท์");
        return false;
    }
    if ($.trim($("#txtTo").val()).length === 0) {
        sudoNotify.error("กรุณากรอกชื่ออาจารย์ที่ต้องการส่งข้อมูล");
        return false;
    }
    if ($.trim($("#txtSponser").val()).length === 0) {
        sudoNotify.error("กรุณากรอกผู้สนับสนุนทุนวิจัย");
        return false;
    }
    if ($.trim($("#txtBudgetScholarship").val()).length === 0) {
        sudoNotify.error("กรุณากรอกจำนวนงบทุนวิจัย");
        return false;
    }
    if ($.trim($("#txtStartDateScholarship").val()).length === 0) {
        sudoNotify.error("กรุณาเลือกวันเริ่มต้น");
        return false;
    }
    if ($.trim($("#txtEndDateScholarship").val()).length === 0) {
        sudoNotify.error("กรุณาเลือกวันสิ้นสุด");
        return false;
    }
    return true;
}
function validate1() {
    if (Objective.getFormsCount() === 0) {
        sudoNotify.error("กรุณากรอกวัตถุประสงค์อย่างน้อย 1 วัตถุประสงค์");
        return false;
    }
    for (var i = 0; i <= Objective.getFormsCount() - 1; i++) {
        if ($.trim($("#Objective_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกวัตถุประสงค์ที่ " + (i + 1));
            return false;
        }
    }
    return true;
}
function validate2() {
//    if (ManagementProject.getFormsCount() === 0) {
//        sudoNotify.error("กรุณากรอกผู้ร่วมโครงการวิจัยอย่างน้อย 1 ท่าน");
//        return false;
//    }
    for (var i = 0; i <= ManagementProject.getFormsCount() - 1; i++) {
        if ($.trim($("#ManagementProject_Name_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกชื่อคณะผู้ทำการวิจัยท่านที่ " + (i + 1));
            return false;
        }
        if ($.trim($("#ManagementProject_Position_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกตำแหน่งคณะผู้ทำการวิจัยท่านที่ " + (i + 1));
            return false;
        }
    }
    return true;
}
function validate31() {
//    if (ManagementProject.getFormsCount() === 0) {
//        sudoNotify.error("กรุณากรอกผู้ร่วมโครงการวิจัยอย่างน้อย 1 ท่าน");
//        return false;
//    }
    for (var i = 0; i <= TopicBudget1.getFormsCount() - 1; i++) {
        if ($.trim($("#TopicBudget1_Topic_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกหัวข้องบประมาณที่ 3.1." + (i + 1));
            return false;
        }
        if ($.trim($("#TopicBudget1_Amount_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกงบประมาณที่ 3.1." + (i + 1));
            return false;
        }
    }
    return true;
}
function validate32() {
//    if (ManagementProject.getFormsCount() === 0) {
//        sudoNotify.error("กรุณากรอกผู้ร่วมโครงการวิจัยอย่างน้อย 1 ท่าน");
//        return false;
//    }
    for (var i = 0; i <= TopicBudget2.getFormsCount() - 1; i++) {
        if ($.trim($("#TopicBudget2_Topic_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกหัวข้องบประมาณที่ 3.2." + (i + 1));
            return false;
        }
        if ($.trim($("#TopicBudget2_Amount_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกงบประมาณที่ 3.2." + (i + 1));
            return false;
        }
    }
    return true;
}
function validate33() {
//    if (ManagementProject.getFormsCount() === 0) {
//        sudoNotify.error("กรุณากรอกผู้ร่วมโครงการวิจัยอย่างน้อย 1 ท่าน");
//        return false;
//    }
    for (var i = 0; i <= TopicBudget3.getFormsCount() - 1; i++) {
        if ($.trim($("#TopicBudget3_Topic_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกหัวข้องบประมาณที่ 3.3." + (i + 1));
            return false;
        }
        if ($.trim($("#TopicBudget3_Amount_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกงบประมาณที่ 3.3." + (i + 1));
            return false;
        }
    }
    return true;
}
function validate34() {
//    if (ManagementProject.getFormsCount() === 0) {
//        sudoNotify.error("กรุณากรอกผู้ร่วมโครงการวิจัยอย่างน้อย 1 ท่าน");
//        return false;
//    }
    for (var i = 0; i <= TopicBudget4.getFormsCount() - 1; i++) {
        if ($.trim($("#TopicBudget4_Topic_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกหัวข้องบประมาณที่ 3.4." + (i + 1));
            return false;
        }
        if ($.trim($("#TopicBudget4_Amount_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกงบประมาณที่ 3.4." + (i + 1));
            return false;
        }
    }
    return true;
}
function validate35() {
//    if (ManagementProject.getFormsCount() === 0) {
//        sudoNotify.error("กรุณากรอกผู้ร่วมโครงการวิจัยอย่างน้อย 1 ท่าน");
//        return false;
//    }
    for (var i = 0; i <= TopicBudget5.getFormsCount() - 1; i++) {
        if ($.trim($("#TopicBudget5_Topic_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกหัวข้องบประมาณที่ 3.5." + (i + 1));
            return false;
        }
        if ($.trim($("#TopicBudget5_Amount_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกงบประมาณที่ 3.5." + (i + 1));
            return false;
        }
    }
    return true;
}
function validate36() {
//    if (ManagementProject.getFormsCount() === 0) {
//        sudoNotify.error("กรุณากรอกผู้ร่วมโครงการวิจัยอย่างน้อย 1 ท่าน");
//        return false;
//    }
    for (var i = 0; i <= TopicBudget6.getFormsCount() - 1; i++) {
        if ($.trim($("#TopicBudget6_Topic_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกหัวข้องบประมาณที่ 3.6." + (i + 1));
            return false;
        }
        if ($.trim($("#TopicBudget6_Amount_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกงบประมาณที่ 3.6." + (i + 1));
            return false;
        }
    }
    return true;
}
function validate37() {
//    if (ManagementProject.getFormsCount() === 0) {
//        sudoNotify.error("กรุณากรอกผู้ร่วมโครงการวิจัยอย่างน้อย 1 ท่าน");
//        return false;
//    }
    for (var i = 0; i <= TopicBudget7.getFormsCount() - 1; i++) {
        if ($.trim($("#TopicBudget7_Topic_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกหัวข้องบประมาณที่ 3.7." + (i + 1));
            return false;
        }
        if ($.trim($("#TopicBudget7_Amount_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกงบประมาณที่ 3.7." + (i + 1));
            return false;
        }
    }
    return true;
}
function validate4() {
    if (Payroll.getFormsCount() > 0) {
        for (var i = 0; i <= Payroll.getFormsCount() - 1; i++) {
            if ($("#Payroll_Name_" + i).val() === '') {
                sudoNotify.error("กรุณากรอกชื่อบุคลากร 4." + (i + 1));
                return false;
            }
            if ($.trim($("#Payroll_Amount_" + i).val()).length === 0) {
                sudoNotify.error("กรุณากรอกค่าจ้าง 4." + (i + 1));
                return false;
            }
        }
    }
    return true;
}
function validate5() {
    if ($.trim($("#txtBankName").val()).length === 0) {
        sudoNotify.error("กรุณากรอกธนาคาร");
        return false;
    }
    if ($.trim($("#txtBranch").val()).length === 0) {
        sudoNotify.error("กรุณากรอกสาขา");
        return false;
    }
    if ($.trim($("#txtAccountName").val()).length === 0) {
        sudoNotify.error("กรุณากรอกชื่อบัญชี");
        return false;
    }
    if ($.trim($("#txtAccountNumber").val()).length === 0) {
        sudoNotify.error("กรุณากรอกเลขที่บัญชี");
        return false;
    }
    return true;
}
function validate6() {
//    if (AuthorizedPerson.getFormsCount() === 0) {
//        sudoNotify.error("กรุณากรอกผู้มีอำนาจสั่งจ่ายอย่างน้อย 1 ท่าน");
//        return false;
//    }
    for (var i = 0; i <= AuthorizedPerson.getFormsCount() - 1; i++) {
        if ($.trim($("#AuthorizedPerson_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกชื่อผู้มีอำนาจสั่งจ่ายท่านที่ " + (i + 1));
            return false;
        }
    }
    return true;
}
function validate7() {
    if (!$.trim($("#txtReport").val())) {
        sudoNotify.error("กรุณากรอกการรายงาน");
        return false;
    }
    return true;
}
function validate8() {
    if (PayDate.getFormsCount() === 0) {
        sudoNotify.error("กรุณากรอกกำหนดระยะเวลาการจ่ายเงินอย่างน้อย 1 งวด");
        return false;
    }
    for (var i = 0; i <= PayDate.getFormsCount() - 1; i++) {
        if ($("#PayDate_Amount_" + i).val() === '') {
            sudoNotify.error("กรุณากรอกจำนวนเงินงวดที่ " + (i + 1));
            return false;
        }
        if ($.trim($("#PayDate_Remark_" + i).val()).length === 0) {
            sudoNotify.error("กรุณากรอกรายละเอียดงวดที่ " + (i + 1));
            return false;
        }
    }
    return true;
}
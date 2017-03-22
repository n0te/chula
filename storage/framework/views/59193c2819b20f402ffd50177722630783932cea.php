<?php $__env->startSection('head'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
<link href="public/assets/global/plugins/sudobar/dist/style/jquery.sudo-notify.css" rel="stylesheet" type="text/css"/>
<link href="public/assets/global/plugins/datatables/DataTables-1.10.12/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
<link href="public/assets/global/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="public/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css"/>
<style>
    .file-panel{
        position:relative;
        border: none !important;
    }
    .file-panel .fa-close{
        position: absolute;
        right: 0px;
        font-size: 30px;
        color: red;
        top: 8px;
        left:95%;
        cursor:pointer;
    }
    .file-panel .filedesc{
        margin-bottom:7px;
        width:90%;
    }
    .file-panel .file-custom-error{
        color:red;
    }
    div.fileinput-new{
        border: none !important;
        padding: 10px 0px 0px 0px !important;
    }
    div.portlet.light.bordered{
        margin:3% !important;
    }
    .doc-delete-button{
        color: red;
        position: absolute;
        right: 5px;
        bottom: 5px;
        font-size: 200%;
    }
    .tile-body img{
        width:100%;
        height:100%;
    }
    div.fileinput-exists{
        border:none !important;
        padding-left: 0px !important;
    }

    @media (max-width: 768px){
        .form-horizontal .control-label {
            text-align: center;
            margin-bottom: 0;
        }
    }
    @media (max-width: 991px){
        .form .form-bordered .form-group .control-label {
            padding-top: 20px;
        }
    }
    required{
        color: red;         
    }
    hdmargin{
        margin-bottom: 20px;
    }
    .disabled {
        background-color: #eef1f5;
    }

</style>
<!-- END PAGE LEVEL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>อาจารย์</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> 

    </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->

            <!-- END SAMPLE FORM PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file"></i>
                        <span class="caption-subject font-dark bold uppercase">อาจารย์ทั้งหมด</span>
                    </div>
                    <div class="actions">
                        <!--                        <a href="#" onclick="OpenAddEquipment(); return false;" class="btn green-meadow">
                                                    <i class="fa fa-plus"></i> เพิ่มอุปกรณ์</a>-->
                    </div>
                </div>
                <table id='tblReviewform' width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>
                                รหัส
                            </td>
                            <td>
                                ภาพ
                            </td>
                            <td>
                                ชื่ออาจารย์
                            </td>
                            <td>
                                สถานที่
                            </td>
                            <td>
                                คำสั่ง
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="mdlBookTeacher" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">นัดพบอาจารย์</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <div id='calendar'></div>
                    <div class=" clearfix"></div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="note note-info">
                                    <h4 class="block">วันที่สามารถนัดพบได้</h4>
                                    <p id="divaviday"> </p>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">วันที่จะนัดพบ</label>
                                    <div class="col-md-6">
                                        <input  class="form-control placeholder-no-fix" readonly="true" type="text" placeholder="" name="biobookingdate" id="biobookingdate" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">เวลาที่จะนัดพบ</label>
                                    <div class="col-md-6">
                                        <input  class="form-control placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="biobookingstarttime" id="biobookingstarttime" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">เวลาสิ้นสุดการนัดพบ</label>
                                    <div class="col-md-6">
                                        <input  class="form-control placeholder-no-fix  timepicker timepicker-24" type="text" placeholder="" name="biobookingendtime" id="biobookingendtime" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">ระยะเวลาสูงสุดในการนัดพบ (ชั่วโมง)</label>
                                    <div class="col-md-6">
                                        <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="teacherhourallow" readonly="true" id="teacherhourallow" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">ราคา / ชั่วโมง</label>
                                    <div class="col-md-6">
                                        <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="teacherprice" readonly="true" id="teacherprice" value=""/>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>
                <a class='btn btn-primary btn-sm' href='#' onclick='BookTeacher(); return false;'><span class='glyphicon glyphicon-ok'></span> บันทึก</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
<input type="hidden" name="hidusertype" id="hidusertype" value="<?php echo e(Auth::user()->type); ?>">
<input type="hidden" name="hidsaveoredit" id="hidsaveoredit" value="">
<input type="hidden" name="hidteacherid" id="hidteacherid" value="">
<input type="hidden" name="hiddateselect" id="hiddateselect" value="">
<input type="hidden" name="hiddateselect" id="hidchkavi" value="">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="public/assets/global/plugins/kartik-v-bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/kartik-v-bootstrap-fileinput/js/plugins/canvas-to-blob.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/sudobar/dist/jquery.sudo-notify.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="public/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>

<script src="public/assets/global/plugins/jquerydateFormat.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="public/assets/global/plugins/datatables/DataTables-1.10.12/media/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/jquery-number-master/jquery.number.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/fullcalendar/lib/moment.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js" type="text/javascript"></script>
<script>
                    var sudoNotify = $('.notification-container').sudoNotify({
                        log: true,
                        position: "top",
                        animation: {
                            type: "slide-fade", //fade, scroll-left, scroll-left-fade, scroll-right, scroll-right-fade, slide, slide-fade or none
                            showSpeed: 400,
                            hideSpeed: 250
                        }
                    });
                    $(document).ready(function () {
                        $('#tblReviewform').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '/getTeacherforbooking',
                            "lengthChange": false,
                            "info": false,
                            "pagingType": "full_numbers",
                            columns: [
                                {data: 'bioteacherid', name: 'bioteacherid'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return "<img width='200px' alt='' src='public/uploads/teacherimg/" + full.bioteacherpicturename + "' class='img-thumbnail' />";
                                    }
                                },
                                {data: 'bioteachername', name: 'bioteachername'},
                                //{data: 'groupname', name: 'groupname'},
                                {data: 'bioplacename', name: 'bioplacename'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol)
                                    {
                                        $(nTd).css('text-align', 'center');
                                    },
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return " <a class='btn btn-primary btn-sm' href='#' onclick='return OpenBookingTeacher(\"" + full.bioteacherid + "\")'><span class='glyphicon glyphicon-file'></span> นัดพบ</a>";
                                    }
                                }
                            ]
                        });
                    });
                    function resetfield() {
                        $("#biobookingstarttime").val('');
                        $("#biobookingendtime").val('');
                        $("#biobookingdate").val('');
                    }

                    function OpenBookingTeacher(teacherid) {
                        $('#calendar').fullCalendar('destroy');
                        $("#biobookingdate").val('');
                        $("#biobookingstarttime").val('');
                        $("#biobookingendtime").val('');
                        $("#hidteacherid").val(teacherid);
                        $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,basicWeek,basicDay'
                            },
                            defaultDate: '<?php echo e(Date("Y-m-d")); ?>',
                            selectable: true,
                            selectHelper: true,
                            timeFormat: 'H(:mm)',
                            displayEventTime: false,
                            select: function (start, end) {


                                var check = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                                var today = moment(new Date()).format('YYYY-MM-DD');
                                if (check < today)
                                {
                                    sudoNotify.error("คุณไม่สามารถจองวันย้อนหลังได้");
                                } else
                                {
                                    $('#biobookingdate').val(moment(start).format('DD/MM/YYYY'));
                                    $('#hiddateselect').val(moment(start).format('YYYY/MM/DD'));
                                }

                            },
                            events: {
                                url: '/getBookingbyTeacherid/' + teacherid,
                                error: function () {

                                }
                            },
                            eventRender: function (event, element) {
                                $(element).tooltip({title: event.title});
                            },
                            dayRender: function (date, cell) {
                                var today = new Date();
                                if (date < today) {
                                    $(cell).addClass('disabled');
                                }
                            }
                        });
                        $.ajax({
                            url: '/getTeacherByID/' + teacherid,
                            method: 'get',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            error: function (data) {
                                console.log(data.responseText);
                            },
                            success: function (data) {
                                $("#hidteacherid").val(data['teacher'][0].bioteacherid);
                                $("#teacherhourallow").val(data['teacher'][0].bioteacherhourallow);
                                //equipmentprice
                                var tcprice = 0;
                                if ($("#hidusertype").val() === '1') {
                                    tcprice = data['teacher'][0].bioteacherfordoctordepartment;
                                } else if ($("#hidusertype").val() === '2') {
                                    tcprice = data['teacher'][0].bioteacherforuniversity;
                                } else if ($("#hidusertype").val() === '3') {
                                    tcprice = data['teacher'][0].bioteacherforoutsideuniversitygov;
                                } else if ($("#hidusertype").val() === '4') {
                                    tcprice = data['teacher'][0].bioteacherforoutsideuniversityprivate;
                                }
                                $("#teacherprice").val(tcprice);
                                var txtavi = '';
                                for (var i = 0; i < data['tavi'].length; i++) {
                                    txtavi += data['tavi'][i].biodayname + ' เวลา ' + (data['tavi'][0].bioavailablestarttime).slice(0, -3) + ' ถึง ' + (data['tavi'][0].bioavailableendtime).slice(0, -3) + '<br>';
                                }
                                $("#divaviday").html(txtavi);
                            }
                        });
                        $('#mdlBookTeacher').modal('toggle');
                    }

                    $('#mdlBookTeacher').on('shown.bs.modal', function () {
                        $("#calendar").fullCalendar('render');
                    });
                    function chkavi() {
                        var start_time = ($("#bookingstarttime").val()).replace(/ /g, "");
                        var end_time = ($("#bookingendtime").val()).replace(/ /g, "");
                        var formData = new FormData();
                        formData.append('bookingdate', $("#hiddateselect").val());
                        formData.append('bookingequipmentid', $("#hidequipmentid").val());
                        formData.append('bookingstarttime', start_time + ":00");
                        formData.append('bookingendtime', end_time + ":00");
                        $.ajax({
                            url: '/checkTimeAvailable',
                            method: 'post',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            data: formData,
                            error: function (data) {
                                console.log(data.responseText);
                                alert(data.responseText);
                            },
                            success: function (data) {
                                if (data.message === 'notfree') {
                                    $("#hidchkavi").val('notfree');
                                }
                            }
                        });
                    }
                    function BookTeacher() {
                        if ($.trim($("#biobookingdate").val()).length === 0) {
                            sudoNotify.error("กรุณาเลือกวันที่นัดพบ");
                            return false;
                        }
                        if ($.trim($("#biobookingstarttime").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกเวลาเริ่มต้น");
                            return false;
                        }
                        if ($.trim($("#biobookingendtime").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกเวลาสิ้นสุด");
                            return false;
                        }

                        var start_time = ($("#biobookingstarttime").val()).replace(/ /g, "");
                        var end_time = ($("#biobookingendtime").val()).replace(/ /g, "");

                        var stt = new Date("November 13, 2013 " + start_time + ":00");
                        stt = stt.getTime();

                        var endt = new Date("November 13, 2013 " + end_time + ":00");
                        endt = endt.getTime();

                        if (stt > endt) {
                            sudoNotify.error("กรุณากรอกเวลาสิ้นสุดมากกว่าเวลาเริ่มต้น");
                            return false;
                        }
                        if (Math.abs(endt - stt) / 36e5 > parseFloat($("#teacherhourallow").val())) {
                            sudoNotify.error("กรุณาจองอุปกรณ์ภายในระยะเวลาที่อนุญาติ");
                            return false;
                        }
                        var formData = new FormData();
                        formData.append('biobookingdate', $("#hiddateselect").val());
                        formData.append('biobookingteacherid', $("#hidteacherid").val());
                        formData.append('biobookingstarttime', start_time + ":00");
                        formData.append('biobookingendtime', end_time + ":00");
                        $.ajax({
                            url: '/BookTeacher',
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
                                if (data.message === 'saved') {
                                    sudoNotify.success("นัดพบอาจารย์เรียบร้อย กำลังกลับไปหน้า การนัดพบอาจารย์ทั้งหมด");
                                    setTimeout(function () {
                                        window.location.href = "/mybiobooking";
                                    }, 3000);
                                } else if (data.message === 'notavi') {
                                    sudoNotify.error("อาจารย์ที่ท่านนัดพบไม่ว่างในวันและเวลาดังกล่าว");
                                    return false;
                                } else if (data.message === 'daytimenotavi') {
                                    sudoNotify.error("อาจารย์ที่ท่านนัดพบไม่อณุญาตให้นัดหมายในวันและเวลาดังกล่าว");
                                    return false;
                                }
                            }

                        });
                    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
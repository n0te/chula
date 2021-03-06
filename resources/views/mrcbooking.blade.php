@extends('layouts.app')

@section('head')
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
@endsection
@section('content')


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
                <span>อุปกรณ์</span>
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
                        <span class="caption-subject font-dark bold uppercase">ตารางอุปกรณ์ทั้งหมด</span>
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
                                ชื่ออุปกรณ์
                            </td>
<!--                            <td>
                                ประเภท
                            </td>-->
                            <td>
                                สถานที่
                            </td>
                            <td>
                                หลักสูตรการอบรม
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
<div class="modal fade" id="mdlBookEquipment" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">จองเข้าใช้งานเครื่องมือ</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <div id='calendar'></div>
                    <div class=" clearfix"></div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-6 control-label">วันที่จะเข้าใช้งาน</label>
                                    <div class="col-md-6">
                                        <input  class="form-control placeholder-no-fix" readonly="true" type="text" placeholder="" name="bookingdate" id="bookingdate" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">เวลาที่จะเข้าใช้งาน</label>
                                    <div class="col-md-6">
                                        <input  class="form-control placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="bookingstarttime" id="bookingstarttime" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">เวลาเมื่อเสร็จสิ้นการใช้งาน</label>
                                    <div class="col-md-6">
                                        <input  class="form-control placeholder-no-fix  timepicker timepicker-24" type="text" placeholder="" name="bookingendtime" id="bookingendtime" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">ระยะเวลาสูงสุดในการใช้งาน (ชั่วโมง)</label>
                                    <div class="col-md-6">
                                        <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="equipmenthourallow" readonly="true" id="equipmenthourallow" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">ราคา / ชั่วโมง</label>
                                    <div class="col-md-6">
                                        <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="equipmentprice" readonly="true" id="equipmentprice" value=""/>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>
                <a class='btn btn-primary btn-sm' href='#' onclick='BookEquipment(); return false;'><span class='glyphicon glyphicon-ok'></span> บันทึก</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="hidusertype" id="hidusertype" value="{{ Auth::user()->type }}">
<input type="hidden" name="hidsaveoredit" id="hidsaveoredit" value="">
<input type="hidden" name="hidequipmentid" id="hidequipmentid" value="">
<input type="hidden" name="hiddateselect" id="hiddateselect" value="">
<input type="hidden" name="hiddateselect" id="hidchkavi" value="">

@endsection

@section('footer')
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
                        // $('input.number').number(true, 2);
                        $('#tblReviewform').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '/getEquipmentforbooking',
                            "lengthChange": false,
                            "info": false,
                            "pagingType": "full_numbers",
                            columns: [
                                {data: 'equipmentid', name: 'equipmentid'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return "<img width='200px' alt='' src='public/uploads/equipmentimg/" + full.equipmentpicturename + "' class='img-thumbnail' />";
                                    }
                                },
                                {data: 'equipmentname', name: 'equipmentname'},
                                //{data: 'groupname', name: 'groupname'},
                                {data: 'placename', name: 'placename'},
                                {data: 'cousename', name: 'cousename'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol)
                                    {
                                        $(nTd).css('text-align', 'center');
                                    },
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return " <a class='btn btn-primary btn-sm' href='#' onclick='return OpenBookingEquipment(\"" + full.equipmentid + "\")'><span class='glyphicon glyphicon-file'></span> จอง</a>";
                                    }
                                }
                            ]
                        });
//                        $('.timepicker').timepicki({
//                            show_meridian: false,
//                            min_hour_value: 0,
//                            max_hour_value: 23,
//                            overflow_minutes: true,
//                            increase_direction: 'up',
//                            disable_keyboard_mobile: true
//                        });
                        //  $('input.number').number(true, 2);
                    });
                    function resetfield() {
                        $("#bookingstarttime").val('');
                        $("#bookingendtime").val('');
                        $("#bookingdate").val('');
                    }

                    function OpenBookingEquipment(equipmentid) {
                        $('#calendar').fullCalendar('destroy');
                        $("#bookingdate").val('');
                        $("#bookingstarttime").val('');
                        $("#bookingendtime").val('');
                        $("#hidequipmentid").val(equipmentid);
                        $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,basicWeek,basicDay'
                            },
                            defaultDate: '{{ Date("Y-m-d")}}',
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
                                    $('#bookingdate').val(moment(start).format('DD/MM/YYYY'));
                                    $('#hiddateselect').val(moment(start).format('YYYY/MM/DD'));
                                }

                            },
                            events: {
                                url: '/getBookingbyEquipmentid/' + equipmentid,
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
                            url: '/getEquipmentByID/' + equipmentid,
                            method: 'get',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            error: function (data) {
                                console.log(data.responseText);
                            },
                            success: function (data) {
                                $("#hidequipmentid").val(data['MRCEquipment'][0].equipmentid);
                                $("#equipmenthourallow").val(data['MRCEquipment'][0].equipmenthourallow);
                                //equipmentprice
                                var eqprice = 0;
                                if ($("#hidusertype").val() === '1') {
                                    eqprice = data['MRCEquipment'][0].equipmentpricefordoctordepartment;
                                } else if ($("#hidusertype").val() === '2') {
                                    eqprice = data['MRCEquipment'][0].equipmentpriceforuniversity;
                                } else if ($("#hidusertype").val() === '3') {
                                    eqprice = data['MRCEquipment'][0].equipmentforoutsideuniversitygov;
                                } else if ($("#hidusertype").val() === '4') {
                                    eqprice = data['MRCEquipment'][0].equipmentforoutsideuniversityprivate;
                                }
                                $("#equipmentprice").val(eqprice);
                            }
                        });
                        $('#mdlBookEquipment').modal('toggle');
                    }

                    $('#mdlBookEquipment').on('shown.bs.modal', function () {
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
                    function BookEquipment() {
                        if ($.trim($("#bookingdate").val()).length === 0) {
                            sudoNotify.error("กรุณาเลือกวันที่จะเข้าใช้งาน");
                            return false;
                        }
                        if ($.trim($("#bookingstarttime").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกเวลาเริ่มต้น");
                            return false;
                        }
                        if ($.trim($("#bookingendtime").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกเวลาสิ้นสุด");
                            return false;
                        }

                        var start_time = ($("#bookingstarttime").val()).replace(/ /g, "");
                        var end_time = ($("#bookingendtime").val()).replace(/ /g, "");

                        var stt = new Date("November 13, 2013 " + start_time + ":00");
                        stt = stt.getTime();

                        var endt = new Date("November 13, 2013 " + end_time + ":00");
                        endt = endt.getTime();

                        if (stt > endt) {
                            sudoNotify.error("กรุณากรอกเวลาสิ้นสุดมากกว่าเวลาเริ่มต้น");
                            return false;
                        }
                        if (Math.abs(endt - stt) / 36e5 > parseFloat($("#equipmenthourallow").val())) {
                            sudoNotify.error("กรุณาจองอุปกรณ์ภายในระยะเวลาที่อนุญาติ");
                            return false;
                        }
                        var formData = new FormData();
                        formData.append('bookingdate', $("#hiddateselect").val());
                        formData.append('bookingequipmentid', $("#hidequipmentid").val());
                        formData.append('bookingstarttime', start_time + ":00");
                        formData.append('bookingendtime', end_time + ":00");
                        $.ajax({
                            url: '/BookEquipment',
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
                                    sudoNotify.success("จองอุปกรณ์เรียบร้อย กำลังกลับไปหน้า การจองอุปกรณ์ทั้งหมด");
                                    setTimeout(function () {
                                        window.location.href = "/mymrcbooking";
                                    }, 3000);
                                } else if (data.message === 'notavi') {
                                    sudoNotify.error("อุปกรณ์ที่ท่านจองไม่ว่างในวันและเวลาดังกล่าว");
                                    return false;
                                }
                            }

                        });
                    }
</script>
@endsection
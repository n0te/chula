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
                <span>ห้องแล็ป</span>
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
                        <span class="caption-subject font-dark bold uppercase">ตารางห้องแล็ปทั้งหมด</span>
                    </div>
                    <div class="actions">

                        <a href="#" onclick="OpenAddAniRoom(); return false;" class="btn green-meadow">
                            <i class="fa fa-plus"></i> เพิ่มห้องแล็ป</a>


                    </div>
                </div>
                <table id='tblReviewform' width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>
                                รหัส
                            </td>
                            <td>
                                ห้องแล็ป
                            </td>
                            <td>
                                สถานะ
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
<div class="modal fade" id="mdlAniRoom" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">ห้องแล็ป</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อห้องแล็ป</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="aniroomname" id="aniroomname" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">จำนวนชั่วโมงที่กำหนดให้จอง</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="aniroomhourallow" id="aniroomhourallow" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลในคณะแพทย์</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="aniroomfordoctordepartment" id="aniroomfordoctordepartment" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลในมหาวิทยาลัย</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="aniroomforuniversity" id="aniroomforuniversity" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลภายนอกภาครัฐ</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="aniroomforoutsideuniversitygov" id="aniroomforoutsideuniversitygov" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลภายนอกภาคเอกชน</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="aniroomforoutsideuniversityprivate" id="aniroomforoutsideuniversityprivate" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">สถานะ</label>
                                <div class="col-md-9">
                                    <select name="aniroomstatus"  id="aniroomstatus" class="form-control">
                                        <option value='1'>เปิด</option>
                                        <option value='0'>ปิด</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>
                <a class='btn btn-primary btn-sm' href='#' onclick='SaveAniRoom(); return false;'><span class='glyphicon glyphicon-ok'></span> บันทึก</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlAniRoomCfmDel" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content warning">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">ยืนยันการลบ</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    คุณแน่ใจว่าจะลบรายการนี้
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>
                <a class='btn btn-danger btn-sm' href='#' onclick='DeleteByID(); return false;'><span class='glyphicon glyphicon-trash'></span> ลบ</a>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlBookAniRoom" tabindex="-1" role="basic" aria-hidden="true">
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
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<input type="hidden" name="hidsaveoredit" id="hidsaveoredit" value="">
<input type="hidden" name="hidAniRoomid" id="hidAniRoomid" value="">
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
<script src="public/assets/global/plugins/timepicker/js/timepicki.js" type="text/javascript"></script>
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
                            ajax: '/getaniroomfortbl',
                            "order": [[0, "desc"]],
                            "lengthChange": false,
                            "info": false,
                            "pagingType": "full_numbers",
                            columns: [
                                {data: 'aniroomid', name: 'aniroomid'},
                                {data: 'aniroomname', name: 'aniroomname'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol)
                                    {
                                        $(nTd).css('text-align', 'center');
                                    },
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        if (full.aniroomstatus === '1') {
                                            return '<span class="label label-sm label-success"> เปิดใช้งาน </span>';
                                        } else {
                                            return '<span class="label label-sm label-warning"> ปิดใช้งาน </span>';
                                        }

                                    }
                                },
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol)
                                    {
                                        $(nTd).css('text-align', 'center');
                                    },
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return " <a class='btn btn-success btn-sm' href='#' onclick='return OpenBookingAniRoom(\"" + full.aniroomid + "\")'><span class='glyphicon glyphicon-calendar'></span> การจองทั้งหมด</a>"
                                                + "&nbsp; <a class='btn btn-primary btn-sm' href='#' onclick='return setAccess(\"" + full.aniroomid + "\",\"" + full.aniroomname + "\")'><span class='glyphicon glyphicon-home'></span> ตั้งเครื่องนี้สำหรับเข้าใช้งาน</a>"
                                                + "&nbsp; <a class='btn btn-primary btn-sm' href='#' onclick='return OpenEditAniRoom(\"" + full.aniroomid + "\")'><span class='glyphicon glyphicon-file'></span> แก้ไข</a>"
                                                + "&nbsp; <a class='btn btn-danger btn-sm' href='#' onclick='return OpenDelete(\"" + full.aniroomid + "\")'><span class='glyphicon glyphicon-trash'></span> ลบ</a>";
                                    }
                                }
                            ]
                        });
                        //  $('input.number').number(true, 2);
                    });
                    function resetfield() {

                        $("#aniroomname").val('');
                        $("#aniroomhourallow").val('');
                        $("#aniroomfordoctordepartment").val('');
                        $("#aniroomforuniversity").val('');
                        $("#aniroomforoutsideuniversitygov").val('');
                        $("#aniroomforoutsideuniversityprivate").val('');
                        $('#aniroomstatus').val('1');
                    }
                    function OpenAddAniRoom() {
                        resetfield();
                        $('#mdlAniRoom').modal('toggle');
                        $("#hidsaveoredit").val('SaveAniRoom');
                    }
                    function OpenEditAniRoom(aniroomid) {
                        //hidequipmentid();
                        resetfield();
                        $("#hidsaveoredit").val('EditAniRoom');
                        $.ajax({
                            url: '/getAniRoomByID/' + aniroomid,
                            method: 'get',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            error: function (data) {
                                console.log(data.responseText);
                            },
                            success: function (data) {
                                $("#hidAniRoomid").val(data['room'][0].aniroomid);
                                $("#aniroomname").val(data['room'][0].aniroomname);
                                $("#aniroomhourallow").val(data['room'][0].aniroomhourallow);
                                $("#aniroomfordoctordepartment").val(data['room'][0].aniroomfordoctordepartment);
                                $("#aniroomforuniversity").val(data['room'][0].aniroomforuniversity);
                                $("#aniroomforoutsideuniversitygov").val(data['room'][0].aniroomforoutsideuniversitygov);
                                $("#aniroomforoutsideuniversityprivate").val(data['room'][0].aniroomforoutsideuniversityprivate);
                                $("#aniroomstatus").val(data['room'][0].aniroomstatus);
                                $('#mdlAniRoom').modal('toggle');
                            }
                        });
                    }
                    function OpenDelete(aniroomid) {
                        $('#mdlAniRoomCfmDel').modal('toggle');
                        $("#hidAniRoomid").val(aniroomid);
                    }
                    function DeleteByID() {
                        $.ajax({
                            url: '/deleteAniRoomByID/' + $("#hidAniRoomid").val(),
                            method: 'get',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            error: function (data) {
                                console.log(data.responseText);
                            },
                            success: function (data) {
                                if (data.message === 'saved') {
                                    $('#tblReviewform').DataTable().ajax.reload();
                                    $('#mdlAniRoomCfmDel').modal('toggle');
                                    sudoNotify.success("ลบห้องแล็ปเรียบร้อย");
                                }
                            }
                        });
                    }
                    function setAccess(aniroomid, aniroomname) {
                        var formData = new FormData();
                        formData.append('aniroomid', aniroomid);
                        $.ajax({
                            url: '/setAccessAni',
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
                                if (data.message === 'cookieset') {
                                    sudoNotify.success("บันทึกคอมพิวเตอร์เครื่องสำหรับเข้าใช้อุปกรณ์ " + aniroomname);
                                }
                            }
                        });
                    }
                    function SaveAniRoom() {
                        if ($.trim($("#aniroomname").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกชื่อห้อง");
                            return false;
                        }
                        if ($.trim($("#aniroomhourallow").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกจำนวนชั่วโมงที่กำหนดให้จอง");
                            return false;
                        }
                        if ($.trim($("#aniroomfordoctordepartment").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลในคณะแพทย์");
                            return false;
                        }
                        if ($.trim($("#aniroomforuniversity").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลในมหาวิทยาลัย");
                            return false;
                        }
                        if ($.trim($("#aniroomforoutsideuniversitygov").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลภายนอกภาครัฐ");
                            return false;
                        }
                        if ($.trim($("#aniroomforoutsideuniversityprivate").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลภายนอกภาคเอกชน");
                            return false;
                        }

                        var formData = new FormData();
                        $('input[type="text"], input[type="checkbox"], textarea, input[type="password"], input[type="hidden"], select').each(function (i) {
                            formData.append($(this).attr('id'), $(this).val());
                        });

                        $.ajax({
                            url: '/' + $("#hidsaveoredit").val(),
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
                                    $('#tblReviewform').DataTable().ajax.reload();
                                    $('#mdlAniRoom').modal('toggle');
                                    if ($("#hidsaveoredit").val() === 'EditAniRoom') {
                                        sudoNotify.success("แก้ไขห้องแล็ปเรียบร้อย");
                                    } else {
                                        sudoNotify.success("เพิ่มห้องแล็ปเรียบร้อย");
                                    }
                                }
                            }
                        });
                    }

                    $('#mdlBookAniRoom').on('shown.bs.modal', function () {
                        $("#calendar").fullCalendar('render');
                    });

                    function OpenBookingAniRoom(aniroomid) {
                        $('#calendar').fullCalendar('destroy');
                        $("#hidAniRoomid").val(aniroomid);
                        $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,basicWeek,basicDay'
                            },
                            defaultDate: '{{ Date("Y-m-d")}}',
                            selectable: false,
                            selectHelper: true,
                            timeFormat: 'H(:mm)',
                            displayEventTime: false,
                            events: {
                                url: '/getBookingbyAniRoomIDWithUsername/' + aniroomid,
                                error: function () {

                                }
                            },
                            eventRender: function (event, element) {
                                $(element).tooltip({title: event.title});
                            }
                        });
                        $('#mdlBookAniRoom').modal('toggle');
                    }
</script>
@endsection
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
                <span>ค้นหาและจองเครื่องมือ</span>
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
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">

                        <span class="caption-subject bold uppercase"> ค้นหาและจองเครื่องมือ</span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-2 control-label">รหัส</label>
                                <div class="col-md-10">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="txtTopic" id="txtTopic" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">ชื่อ</label>
                                <div class="col-md-10">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="txtTopic" id="txtTopic" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">ประเภทกลุ่มเครื่องมือ</label>
                                <div class="col-md-10">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="txtTopic" id="txtTopic" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">สถานที่ตั้ง</label>
                                <div class="col-md-10">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="txtTopic" id="txtTopic" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">หลักสูตรการฝึกอบรม</label>
                                <div class="col-md-10">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="txtTopic" id="txtTopic" value=""/>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <button type="submit" class="btn green">ค้นหา</button>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->
            <div class="portlet light">

                <table id='tblReviewform' class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>
                                รหัส
                            </td>
                            <td>
                                รูปภาพ
                            </td>
                            <td>
                                ชื่ออุปกรณ์
                            </td>
                            <td>
                                ประเภท
                            </td>
                            <td>
                                สถานะ
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

                        <tr>
                            <td>
                                100
                            </td>
                            <td>
                                <img src="..public/assets/global/img/imagelarge.jpg" alt=""/>
                            </td>
                            <td>
                                เครื่องเพิ่มปริมาณสารพันธุกรรม
                                PCR 9700
                            </td>
                            <td>
                                เครื่องเพิ่มปริมาณสารพันธุกรรม
                            </td>
                            <td>
                                available
                            </td>
                            <td>
                                ห้อง 1010/3 ชั้น 10 อาคาร อปร.
                            </td>
                            <td>
                                <a traget="_blank" data-toggle="modal" href="#mdlReject" class="btn btn-outline btn-circle blue btn-sm blue">
                                    <i class="fa fa-check-square-o"></i> จอง </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="mdlReject" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">จองเข้าใช้งานเครื่องมือ</h4>
            </div>
            <div class="modal-body">
                <div id='calendar'></div>
                <div class=" clearfix"></div>
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-6 control-label">วันที่และเวลา ที่จะเข้าใช้งาน</label>
                                <div class="col-md-6">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="txtTopic" id="txtTopic" value=""/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-6 control-label">วันที่และเวลา เมื่อเสร็จสิ้นการใช้งาน</label>
                                <div class="col-md-6">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="txtTopic" id="txtTopic" value=""/>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn blue">บันทึก</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<input type="hidden" name="hidfid" id="hidfid" value="">
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
<script src="public/assets/global/plugins/fullcalendar/lib/moment.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>
<script>

    $(document).ready(function () {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '2016-06-12',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                {
                    title: 'All Day Event',
                    start: '2016-06-01'
                },
                {
                    title: 'Long Event',
                    start: '2016-06-07',
                    end: '2016-06-10'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2016-06-09T16:00:00'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2016-06-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2016-06-11',
                    end: '2016-06-13'
                },
                {
                    title: 'Meeting',
                    start: '2016-06-12T10:30:00',
                    end: '2016-06-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2016-06-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2016-06-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2016-06-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2016-06-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2016-06-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2016-06-28'
                }
            ]
        });
        $('#mdlReject').on('shown.bs.modal', function () {
            $("#calendar").fullCalendar('render');
        });
    });</script>
@endsection
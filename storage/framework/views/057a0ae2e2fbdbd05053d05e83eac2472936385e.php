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

            <!-- END SAMPLE FORM PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file"></i>
                        <span class="caption-subject font-dark bold uppercase">ตารางสถานที่ทั้งหมด</span>
                    </div>
                    <div class="actions">

                        <a href="#" onclick="OpenAddPlace(); return false;" class="btn green-meadow">
                            <i class="fa fa-plus"></i> เพิ่มสถานที่</a>


                    </div>
                </div>
                <table id='tblReviewform' width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>
                                รหัส
                            </td>
                            <td>
                                ชื่อสถานที่ตั้ง
                            </td>
                            <td>
                                ชื่อย่อ
                            </td>
<!--                            <td>
                                ชื่อเครื่องคอมพิวเตอร์
                            </td>-->
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
<div class="modal fade" id="mdlPlace" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">สถานที่ตั้ง</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อสถานที่</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="placename" id="placename" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อย่อ</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="placeabbreviate" id="placeabbreviate" value=""/>
                                </div>
                            </div>
<!--                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อเครื่องคอมพิวเตอร์</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="placecomputername" id="placecomputername" value=""/>
                                </div>
                            </div>-->
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>
                <a class='btn btn-primary btn-sm' href='#' onclick='SavePlace(); return false;'><span class='glyphicon glyphicon-ok'></span> บันทึก</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlPlaceCfmDel" tabindex="-1" role="basic" aria-hidden="true">
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

<input type="hidden" name="hidsaveoredit" id="hidsaveoredit" value="">
<input type="hidden" name="hidfid" id="hidplaceid" value="">
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
<script src="public/assets/global/plugins/fullcalendar/lib/moment.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script>
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
                            processing: true,
                            serverSide: true,
                            ajax: '/getplace',
                            "lengthChange": false,
                            "info": false,
                            "pagingType": "full_numbers",
                            columns: [
                                {data: 'placeid', name: 'placeid'},
                                {data: 'placename', name: 'placename'},
                                {data: 'placeabbreviate', name: 'placeabbreviate'},
                                //{data: 'placecomputername', name: 'placecomputername'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol)
                                    {
                                        $(nTd).css('text-align', 'center');
                                    },
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return " <a class='btn btn-primary btn-sm' href='#' onclick='return OpenEditPlace(\"" + full.placeid + "\")'><span class='glyphicon glyphicon-file'></span> แก้ไข</a>"
                                                + "&nbsp; <a class='btn btn-danger btn-sm' href='#' onclick='return OpenDelete(\"" + full.placeid + "\")'><span class='glyphicon glyphicon-trash'></span> ลบ</a>";
                                    }
                                }
                            ]
                        });

                    });
                    function resetfield() {
                        $("#placename").val('');
                        $("#placeabbreviate").val('');
                        //$("#placecomputername").val('');
                    }
                    function OpenAddPlace() {
                        resetfield();
                        $('#mdlPlace').modal('toggle');
                        $("#hidsaveoredit").val('SavePlace');
                    }
                    function OpenEditPlace(placeid) {
                        resetfield();
                        $("#hidsaveoredit").val('EditPlace');
                        $.ajax({
                            url: '/getPlaceByID/' + placeid,
                            method: 'get',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            error: function (data) {
                                console.log(data.responseText);
                            },
                            success: function (data) {
                                $("#hidplaceid").val(data['MRCPlace'][0].placeid);
                                $("#placename").val(data['MRCPlace'][0].placename);
                                $("#placeabbreviate").val(data['MRCPlace'][0].placeabbreviate);
                                //$("#placecomputername").val(data['MRCPlace'][0].placecomputername);
                                $('#mdlPlace').modal('toggle');
                            }
                        });
                    }
                    function OpenDelete(placeid) {
                        $('#mdlPlaceCfmDel').modal('toggle');
                        $("#hidplaceid").val(placeid);
                    }
                    function DeleteByID() {
                        $.ajax({
                            url: '/deletePlaceByID/' + $("#hidplaceid").val(),
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
                                    $('#mdlPlaceCfmDel').modal('toggle');
                                    sudoNotify.success("ลบสถานที่เรียบร้อย");
                                }
                            }
                        });
                    }
                    function SavePlace() {
                        if ($.trim($("#placename").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกชื่อสถานที่");
                            return false;
                        }
                        if ($.trim($("#placeabbreviate").val()).length === 0) {
                            sudoNotify.error("กรุณาชื่อย่อสถานที่");
                            return false;
                        }
//                        if ($.trim($("#placecomputername").val()).length === 0) {
//                            sudoNotify.error("กรุณากรอกชื่อเครื่องคอมพิวเตอร์ที่สถานที่นั้น");
//                            return false;
//                        }
                     
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
                                    $('#mdlPlace').modal('toggle');
                                    if ($("#hidsaveoredit").val() === 'EditPlace') {
                                        sudoNotify.success("แก้ไขสถานที่เรียบร้อย");
                                    } else {
                                        sudoNotify.success("เพิ่มสถานที่เรียบร้อย");
                                    }

                                }
                            }

                        });
                    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
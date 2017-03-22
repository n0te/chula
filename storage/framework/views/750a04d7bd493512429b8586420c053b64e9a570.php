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
                <span>รายการนัดพบ</span>
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
                        <span class="caption-subject font-dark bold uppercase">ตารางรายการนัดพบ</span>
                    </div>

                </div>
                <table id='tblReviewform' width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>
                                ลำดับ
                            </td>
                            <td>
                                ผู้ใช้งาน
                            </td>
                            <td>
                                วันที่
                            </td>
                            <td>
                                เวลา
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

<div class="modal fade" id="mdlCancel" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content warning">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">ยืนยันการลบ</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    คุณแน่ใจว่าจะยกเลิกรายการนี้
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ปิด</a>
                <a class='btn btn-danger btn-sm' href='#' onclick='CancelByID(); return false;'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="mdlApprove" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content warning">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">ยืนยันการอนุมัติ</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    คุณแน่ใจว่าจะอนุมัติรายการนี้
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ปิด</a>
                <a class='btn btn-info btn-sm' href='#' onclick='ApproveByID(); return false;'><span class='glyphicon glyphicon-check'></span> อนุมัติ</a>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<input type="hidden" name="hidsaveoredit" id="hidsaveoredit" value="">
<input type="hidden" name="hidfid" id="hidbiobookid" value="">
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
                            ajax: '/getbookingbyteacheridforapprove',
                            "lengthChange": false,
                            "info": false,
                            "pagingType": "full_numbers",
                            columns: [//`bookingid``bookingdate``bookingstarttime``bookingendtime``equipmentname``equipmentpicturename`
                                {data: 'biobookingid', name: 'biobookingid'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return  full.firstname + " " + full.lastname;
                                    }
                                },
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return  moment(full.biobookingdate).format("DD/MM/YYYY");
                                        ;
                                    }
                                },
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return  moment(full.biobookingdate + 'T' + full.biobookingstarttime).format("HH:mm") + " - " + moment(full.biobookingdate + 'T' + full.biobookingendtime).format("HH:mm");
                                    }
                                },
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        if (String(full.biobookingstatus) === '0') {
                                            return '<span class="label label-sm label-info">อนุมัติ</span>';
                                        } else if (String(full.biobookingstatus) === '1') {
                                            return '<span class="label label-sm label-success">ใช้งานแล้ว</span>';
                                        } else if (String(full.biobookingstatus) === '-1') {
                                            return '<span class="label label-sm label-danger">เลยกำหนดการนัดพบ</span>';
                                        } else if (String(full.biobookingstatus) === '10') {
                                            return '<span class="label label-sm label-info">รอการอนุมัติ</span>';
                                        } else if (String(full.biobookingstatus) === '-10') {
                                            return '<span class="label label-sm label-danger">ยกเลิก</span>';
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
                                        return "<a class='btn btn-info btn-sm' href='#' onclick='return OpenApprove(\"" + full.biobookingid + "\")'><span class='glyphicon glyphicon-check'></span> ตกลง</a>"
                                                + "&nbsp; <a class='btn btn-danger btn-sm' href='#' onclick='return OpenCancel(\"" + full.biobookingid + "\")'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>";
                                    }
                                }
                            ]
                        });

                    });

                    function OpenCancel(bookid) {
                        $('#mdlCancel').modal('toggle');
                        $("#hidbiobookid").val(bookid);
                    }

                    function OpenApprove(bookid) {
                        $('#mdlApprove').modal('toggle');
                        $("#hidbiobookid").val(bookid);
                    }
                    function CancelByID() {
                        $.ajax({
                            url: '/cancelBioBookingByBookingid/' + $("#hidbiobookid").val(),
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
                                    $('#mdlCancel').modal('toggle');
                                    sudoNotify.success("ลบการจองอุปกรณ์เรียบร้อย");
                                }
                            }
                        });
                    }
                    function ApproveByID() {
                        $.ajax({
                            url: '/approveBioBookingByBookingid/' + $("#hidbiobookid").val(),
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
                                    $('#mdlApprove').modal('toggle');
                                    sudoNotify.success("ลบการจองอุปกรณ์เรียบร้อย");
                                }
                            }
                        });
                    }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <span>กลุ่มเครื่องมือ</span>
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
                        <span class="caption-subject font-dark bold uppercase">ตารางการระงับการใช้งานชั่วคราวทั้งหมด</span>
                    </div>

                </div>
                <table id='tblReviewform' width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>
                                รหัส
                            </td>
                            <td>
                                ชื่อ
                            </td>
                            <td>
                                อุปกรณ์
                            </td>
                            <td>
                                ครั้งที่
                            </td>
                            <td>
                                วันที่เริ่มระงับการใช้งาน
                            </td>
                            <td>
                                วันสิ้นสุดการระงับการใช้งาน
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


<input type="hidden" name="hidsaveoredit" id="hidsaveoredit" value="">
<input type="hidden" name="hidgroupid" id="hidgroupid" value="">
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
            bFilter: false,
            ajax: '/getBanning',
            "lengthChange": false,
            "info": false,
            "pagingType": "full_numbers",
            columns: [
                {data: 'banid', name: 'banid'},
                {"bVisible": true, "bSearchable": true, "bSortable": false,
                    "mData": null,
                    "mRender": function (data, type, full) {
                        return full.firstname + " " + full.lastname;
                    }
                },
                {data: 'equipmentname', name: 'equipmentname'},
                {data: 'bantime', name: 'bantime'},
                {data: 'banstartdate', name: 'banstartdate'},
                {data: 'banenddate', name: 'banenddate'},
                {"bVisible": true, "bSearchable": false, "bSortable": false,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol)
                    {
                        $(nTd).css('text-align', 'center');
                    },
                    "mData": null,
                    "mRender": function (data, type, full) {
                        if (full.banactive === '1') {
                            return "<select onchange='return setActive(\"" + full.banid + "\",this)' class='form-control'><option value='1' selected>เปิดระงับการใช้งาน</option><option value='0'>ปิดระงับการใช้งาน</option></select>";
                        } else {
                            return "<select onchange='return setActive(\"" + full.banid + "\",this)' class='form-control'><option value='1'>เปิดระงับการใช้งาน</option><option value='0' selected>ปิดระงับการใช้งาน</option></select>";
                        }

                    }
                }
            ]
        });
    });
    function setActive(bid, ac) {
        //alert(bid + ' ' + ac.value);
        var formData = new FormData();
        formData.append('bid', bid);
        formData.append('bactive', ac.value);
        $.ajax({
            url: '/activeBanning',
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
                    sudoNotify.success("แก้ไขสถานะเรียบร้อย");
                }
            }

        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('head'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
<link href="public/assets/global/plugins/sudobar/dist/style/jquery.sudo-notify.css" rel="stylesheet" type="text/css"/>
<link href="public/assets/global/plugins/datatables/DataTables-1.10.12/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
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
                <span>แบบฟอร์มทั้งหมด</span>
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
        <div class="col-md-12">
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-file"></i>
                                    <span class="caption-subject font-dark bold uppercase">จัดการแบบฟอร์ม</span>
                                </div>
                                <div class="actions">
                                    <a traget="_blank" href="/exporttoexcel/" class="btn btn-outline btn-circle green btn-sm green">
                                        <i class="fa fa-file-excel-o"></i> Export to excel</a>
                                </div>
                            </div>
                            <table id='tblReviewform' class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>
                                            ลำดับ
                                        </td>
                                        <td>
                                            เลข CRC
                                        </td>
                                        <td>
                                            รหัสประกาศ
                                        </td>
                                        <td>
                                            วันที่ส่ง
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
                                    <?php if(count($Formreqs)): ?>
                                    <?php $i = 1; ?>
                                    <?php foreach($Formreqs as $Formreq): ?>
                                    <tr>
                                        <td>
                                            <?php echo e($i++); ?>

                                        </td>
                                        <td>
                                            <?php if($Formreq->FormReqCRCNumber !== NULL): ?>
                                            <?php echo e($Formreq->FormReqCRCNumber); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($Formreq->FormReqAnnouncementNumber !== NULL): ?>
                                            <?php echo e($Formreq->FormReqAnnouncementNumber); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e(date("d-m-Y", strtotime($Formreq->FormReqSendDate))); ?>

                                        </td>
                                        <td>
                                            <?php if($Formreq->FormReqStstus === 2): ?>
                                            <span class="label label-sm label-info"> รอตรวจสอบ </span>
                                            <?php elseif($Formreq->FormReqStstus === 3): ?>
                                            <span class="label label-sm label-warning"> รอเอกสารตัวจริงจากผู้วิจัย </span>
                                            <?php elseif($Formreq->FormReqStstus === 4): ?>
                                            <span class="label label-sm label-warning"> อยู่ระหว่างรออนุมัติจาก กรรมการคณะฯ </span>
                                            <?php elseif($Formreq->FormReqStstus === 5): ?>
                                            <span class="label label-sm label-warning"> ร่างประกาศส่งต่อไปยังมหาวิทยาลัย </span>
                                            <?php elseif($Formreq->FormReqStstus === 6): ?>
                                            <span class="label label-sm label-success"> ประกาศแหล่งทุนภายนอกเสร็จสมบูรณ์ </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($Formreq->FormReqStstus === 2): ?>
                                            <a traget="_blank" href="/createdocx/<?php echo e($Formreq->FormReqID); ?>" class="btn btn-outline btn-circle blue btn-sm blue">
                                                <i class="fa fa-file-word-o"></i> ดาวโหลดไฟล์ Word </a>
                                            <a href="/approveformbyadmin/<?php echo e($Formreq->FormReqID); ?>" data-toggle="confirmation" data-original-title="คุณแน่ใจว่าจะอนุมัติรายการนี้" data-popout="true" title=""  class="btn btn-outline btn-circle green btn-sm green">
                                                <i class="fa fa-trash-o"></i> อนุมัติ </a>
                                            <a href="#mdlReject" data-toggle="modal" onclick="OpenRejectForm('<?php echo e($Formreq->FormReqID); ?>'); return false;" class="btn btn-outline btn-circle yellow btn-sm yellow">
                                                <i class="fa fa-trash-o"></i> ปฏิเสธ </a>
                                            <a href="/deleteformrequestadmin/<?php echo e($Formreq->FormReqID); ?>"  data-toggle="confirmation" data-original-title="คุณแน่ใจว่าจะลบรายการนี้" data-popout="true" title=""  class="btn btn-outline btn-circle red btn-sm red">
                                                <i class="fa fa-trash-o"></i> ลบ </a>
                                            <?php elseif($Formreq->FormReqStstus === 3): ?>
                                            <a href="/receivepaper/<?php echo e($Formreq->FormReqID); ?>" data-toggle="confirmation" data-original-title="คุณแน่ใจว่าได้รับเอกสารตัวจริงแล้ว" data-popout="true" title=""  class="btn btn-outline btn-circle green btn-sm green">
                                                <i class="fa fa-trash-o"></i> ได้รับเอกสารตัวจริง </a>
                                            <a href="/deleteformrequestadmin/<?php echo e($Formreq->FormReqID); ?>" data-toggle="confirmation" data-original-title="คุณแน่ใจว่าจะลบรายการนี้" data-popout="true" title=""  class="btn btn-outline btn-circle red btn-sm red">
                                                <i class="fa fa-trash-o"></i> ลบ </a>
                                            <?php elseif($Formreq->FormReqStstus === 4): ?>
                                            <a href="#mdlMemo" data-toggle="modal" onclick="OpenCreateMemo('<?php echo e($Formreq->FormReqID); ?>'); return false;" class="btn btn-outline btn-circle blue btn-sm blue">
                                                <i class="fa fa-edit"></i> สร้างบรรทึกข้อความ </a>
                                            <a href="/deleteformrequestadmin/<?php echo e($Formreq->FormReqID); ?>" data-toggle="confirmation" data-original-title="คุณแน่ใจว่าจะลบรายการนี้" data-popout="true" title=""  class="btn btn-outline btn-circle red btn-sm red">
                                                <i class="fa fa-trash-o"></i> ลบ </a>

                                            <?php elseif($Formreq->FormReqStstus === 5): ?>
                                            <a href="#mdlMemo" data-toggle="modal" onclick="OpenCreateMemo('<?php echo e($Formreq->FormReqID); ?>'); return false;" class="btn btn-outline btn-circle blue btn-sm blue">
                                                <i class="fa fa-edit"></i> สร้างบรรทึกข้อความ </a>
                                            <a href="#mdlAnnouncementNumber" data-toggle="modal" onclick="OpenAnnouncementNumber('<?php echo e($Formreq->FormReqID); ?>'); return false;" class="btn btn-outline btn-circle blue btn-sm blue">
                                                <i class="fa fa-edit"></i> กรอกรหัสประกาศ </a>
                                            <a href="/deleteformrequestadmin/<?php echo e($Formreq->FormReqID); ?>" data-toggle="confirmation" data-original-title="คุณแน่ใจว่าจะลบรายการนี้" data-popout="true" title=""  class="btn btn-outline btn-circle red btn-sm red">
                                                <i class="fa fa-trash-o"></i> ลบ </a>
                                            <?php elseif($Formreq->FormReqStstus === 6): ?>
                                            <a href="#mdlMemo" data-toggle="modal" onclick="OpenCreateMemo('<?php echo e($Formreq->FormReqID); ?>'); return false;" class="btn btn-outline btn-circle blue btn-sm blue">
                                                <i class="fa fa-edit"></i> สร้างบรรทึกข้อความ </a>
                                            <a href="#mdlAnnouncementNumber" data-toggle="modal" onclick="OpenAnnouncementNumber('<?php echo e($Formreq->FormReqID); ?>'); return false;" class="btn btn-outline btn-circle blue btn-sm blue">
                                                <i class="fa fa-edit"></i> กรอกรหัสประกาศ </a>
                                            <a href="/deleteformrequestadmin/<?php echo e($Formreq->FormReqID); ?>" data-toggle="confirmation" data-original-title="คุณแน่ใจว่าจะลบรายการนี้" data-popout="true" title=""  class="btn btn-outline btn-circle red btn-sm red">
                                                <i class="fa fa-trash-o"></i> ลบ </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            ยังไม่มีการสร้างฟอร์ม
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
</div>
<div class="modal fade" id="mdlReject" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">ปฏิเสธ</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>เหตุผลในการปฏิเสธ</label>
                    <textarea class="form-control" name="txtRejectReason" id="txtRejectReason" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">ยกเลิก</button>
                <button type="button" onclick="SaveReject(); return false;" class="btn yellow">บันทึก</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlMemo" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">สร้างบรรทึกข้อความ</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>ครั้งที่</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtMemoRound" id="txtMemoRound" value="" />
                </div>
                <div class="form-group">
                    <label>วันที่</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtMemoDate" id="txtMemoDate" value="" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">ปิด</button>
                <button type="button" onclick="SaveMemo(); return false;" class="btn green">ดาวโหลดเอกสารพร้อมบรรทึกข้อความ</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlAnnouncementNumber" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">กรอกรหัสประกาศ</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>รหัสประกาศ</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtAnnouncementNumber" id="txtAnnouncementNumber" value="" />
                </div>
                <div class="form-group">
                    <label>ไฟล์ PDF</label>
                    <input id="fupPDF" type="file" name="fupPDF" data-show-upload="false" class="file pull-left" data-allowed-file-extensions='["pdf"]' data-show-preview="false">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">ปิด</button>
                <button type="button" onclick="SaveAnnouncementNumber(); return false;" class="btn green">บันทึก</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<input type="hidden" name="hidfid" id="hidfid" value="">
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
<script src="public/assets/pages/scripts/reviewform.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/jquerydateFormat.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="public/assets/global/plugins/datatables/DataTables-1.10.12/media/js/jquery.dataTables.js" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
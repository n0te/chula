<?php $__env->startSection('head'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="public/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
<link href="public/assets/global/plugins/sudobar/dist/style/jquery.sudo-notify.css" rel="stylesheet" type="text/css"/>
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
                                    <span class="caption-subject font-dark bold uppercase">ตารางสรุปการจัดทำประกาศแหล่งทุนภายนอก</span>
                                </div>
                                <div class="actions">

                                    <a href="/requestform" class="btn green-meadow">
                                        <i class="fa fa-plus"></i> สร้างคำขอ</a>


                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>
                                            ลำดับ
                                        </td>
                                        <td>
                                            หัวข้อ
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
                                        <td class="col-md-1">
                                            <?php echo e($i++); ?>

                                        </td>
                                        <td class="col-md-4">
                                            <?php if($Formreq->FormReqTopic !== NULL): ?>
                                            <?php echo e($Formreq->FormReqTopic); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td class="col-md-1">
                                            <?php if($Formreq->FormReqCRCNumber !== NULL): ?>
                                            <?php echo e($Formreq->FormReqCRCNumber); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td class="col-md-1">
                                            <?php if($Formreq->FormReqAnnouncementNumber !== NULL): ?>
                                            <?php echo e($Formreq->FormReqAnnouncementNumber); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td class="col-md-1">
                                            <?php if((int)$Formreq->FormReqStstus !== 1): ?>
                                            <?php echo e(date("d-m-Y", strtotime($Formreq->FormReqSendDate))); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td class="col-md-1">
                                            <?php if((int)$Formreq->FormReqStstus === 2): ?>
                                            <span class="label label-sm label-success"> รอการตรวจสอบจากฝ่ายวิจัย </span>
                                            <?php elseif((int)$Formreq->FormReqStstus === 1): ?>
                                            <?php if(is_null($Formreq->FormReqRejectReason)): ?>
                                            <span class="label label-sm label-warning"> ยังไม่ได้ส่งข้อมูล </span>
                                            <?php else: ?>
                                            <span class="label label-sm label-warning"> มีข้อแก้ไข (<?php echo e($Formreq->FormReqRejectReason); ?>) </span>
                                            <?php endif; ?>
                                            <?php elseif((int)$Formreq->FormReqStstus === 3): ?>
                                            <span class="label label-sm label-info"> จัดทำเอกสารตัวจริงส่งมายังฝ่ายวิจัย </span>
                                            <?php elseif((int)$Formreq->FormReqStstus === 4): ?>
                                            <span class="label label-sm label-info"> อยู่ระหว่างรออนุมัติจาก กรรมการคณะฯ </span>
                                            <?php elseif((int)$Formreq->FormReqStstus === 5): ?>
                                            <span class="label label-sm label-info"> ร่างประกาศส่งต่อไปยังมหาวิทยาลัย </span>
                                            <?php elseif((int)$Formreq->FormReqStstus === 6): ?>
                                            <span class="label label-sm label-info"> ประกาศแหล่งทุนภายนอกเสร็จสมบูรณ์ </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="col-md-3">
                                            <?php if((int)$Formreq->FormReqStstus === 3): ?>
                                            <a traget="_blank" href="/createdocx/<?php echo e($Formreq->FormReqID); ?>" class="btn btn-outline btn-circle blue btn-sm blue">
                                                <i class="fa fa-file-word-o"></i> ดาวโหลดไฟล์ Word </a>
                                            <?php elseif((int)$Formreq->FormReqStstus === 1): ?>
                                            <a href="/requestform/<?php echo e($Formreq->FormReqID); ?>" class="btn btn-outline btn-circle blue btn-sm blue">
                                                <i class="fa fa-edit"></i> แก้ไข </a>
                                            <a href="/deleteformrequest/<?php echo e($Formreq->FormReqID); ?>" data-toggle="confirmation" data-original-title="คุณแน่ใจว่าจะลบรายการนี้" data-popout="true" title=""  class="btn btn-outline btn-circle red btn-sm red">
                                                <i class="fa fa-trash-o"></i> ลบ </a>
                                            <?php elseif((int)$Formreq->FormReqStstus === 6): ?>
                                            <a traget="_blank" href="uploads/pdf/<?php echo e($Formreq->FormReqCRCNumber); ?>.pdf" class="btn btn-outline btn-circle blue btn-sm blue">
                                                <i class="fa fa-edit"></i> ดาวน์โหลด PDF </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="7">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/sheepit/jquery.sheepItPlugin.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/sudobar/dist/jquery.sudo-notify.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="public/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<!-- <script src="public/assets/pages/scripts/formreq.js" type="text/javascript"></script> -->
<script src="public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
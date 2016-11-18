<?php $__env->startSection('head'); ?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="/public/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
        
        <link href="/public/assets/global/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL STYLES -->
        <link href="/public/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <link href="/public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
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
        .ui-widget-content.ui-dialog{
            margin:0px 20px!important;
        }

        .from-group.has-error input{
            border-color:red !important;
        }

        .success{
            background-color:#9FDE8A;
            border-color:#9FDE8A;
            color:#437A31;
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

        </style>
        <!-- END PAGE LEVEL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <<div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="index.html">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <a href="/reviewmembers">Review Members</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Individual Profile</span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> <?php echo e($reviewuser->firstname); ?> Profile 
                        
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light ">
                                            
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="profile">
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
        </div>

                 <form role="form" class="profile-form form-bordered" action="<?php echo e(url('/profile')); ?>" enctype="multipart/form-data">
                        <input type="hidden" id="_userid" value="<?php echo e($reviewuser->id); ?>"/>
                        <div class="form-group">
                            <label class="control-label">คำนำหน้า</label>
                                <label class="control-label visible-ie8 visible-ie9">คำนำหน้าชื่อ</label>
                                
                                <input class="form-control placeholder-no-fix" type="text"  name="title" value="<?php echo e($title); ?>" />
                            </div>

                        
                        <div class="form-group">
                            <label class="control-label">ชื่อจริง</label>
                                <label class="control-label visible-ie8 visible-ie9">ชื่อจริง</label>
                                <input class="form-control placeholder-no-fix" type="text" name="firstname" value="<?php echo e(old('firstname')!=null ? old('firstname') : $reviewuser->firstname); ?>" />
                        </div>
                        <div class="form-group">
                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                            <label class="control-label">นามสกุล</label>
                            
                                <label class="control-label visible-ie8 visible-ie9">นามสกุล</label>
                                <input class="form-control placeholder-no-fix" type="text" name="lastname" value="<?php echo e(old('lastname')!=null ? old('lastname') : $reviewuser->lastname); ?>" />
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label">เพศ</label>
                                <label class="control-label visible-ie8 visible-ie9">เพศ</label>
                                <input class="form-control placeholder-no-fix" type="text"  name="sex" value="<?php echo e($sex); ?>" />
                        </div>
                        <div class="form-group">
                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                            <label class="control-label">Email</label>
                                <label class="control-label visible-ie8 visible-ie9">Email</label>
                                <input class="form-control placeholder-no-fix" type="text" name="email" value="<?php echo e(old('email')!=null ? old('email') : $reviewuser->email); ?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">เกิดวันที่</label>
                                <input data-date-format="dd-mm-yyyy" class="form-control form-control-inline date-picker" size="16" type="text" value="<?php echo e(old('dob')!=null ? old('dob') : $reviewuser->get_userDOB()); ?>" name="dob">
                        </div>
                        <div class="form-group">
                            <label class="control-label">สัญชาติ</label>
                                <label class="control-label visible-ie8 visible-ie9">สัญชาติ</label>
                                
                                <input class="form-control placeholder-no-fix" type="text"  name="nationality" value="<?php echo e($nationality); ?>" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">กลุ่มสมาชิก</label>
                                <label class="control-label visible-ie8 visible-ie9">กลุ่มสมาชิก</label>
                                <input class="form-control placeholder-no-fix" type="text"  name="type" value="<?php echo e($type); ?>" />
                        </div>
                        <div class="form-group user_occupation_panel" >
                            <label class="control-label">ประเภทของบุคคลากร</label>
                                <label class="control-label visible-ie8 visible-ie9">ประเภทของบุคคลากร</label>
                                
                                <input class="form-control placeholder-no-fix" type="text"  name="occupation" value="<?php echo e($occupation); ?>" />
                        </div>
                        <div id="pre-hidden-group">
                            <div>
                                <div class="form-group" hide student>
                                    <label class="control-label">รหัสนิสิต</label>
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label visible-ie8 visible-ie9">รหัสนิสิต</label>
                                        <input class="form-control placeholder-no-fix" type="text"  name="student_id" value="<?php echo e(old('student_id')!=null ? old('student_id') : $reviewuser->student_id); ?>" />
                                </div>
                                <div class="form-group" hide student>
                                    <label class="control-label">อาจารย์ที่ปรึกษา</label>
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label visible-ie8 visible-ie9">อาจารย์ที่ปรึกษา</label>
                                        <input class="form-control placeholder-no-fix" type="text"  name="advisor" value="<?php echo e(old('advisor')!=null ? old('advisor') : $reviewuser->advisor); ?>" />
                                </div>
                                <div class="form-group" hide student>
                                    <label class="control-label">หัวข้องานวิจัย</label>
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label visible-ie8 visible-ie9">หัวข้องานวิจัย</label>
                                        <input class="form-control placeholder-no-fix" type="text"  name="researchtopic" value="<?php echo e(old('researchtopic')!=null ? old('researchtopic') : $reviewuser->researchtopic); ?>" /> 
                                </div>
                                <div class="form-group department-panel">
                                    <label class="control-label">ภาควิชา</label>
                                        <label class="control-label visible-ie8 visible-ie9">ภาควิชา</label>
                                        <input class="form-control placeholder-no-fix" type="text"  name="department" value="<?php echo e($department); ?>" />
                                </div>
                            </div>
                            <div class="form-group" hide outsider>
                                <label class="control-label">มหาวิทยาลัย/บริษัท</label>
                                    <label class="control-label visible-ie8 visible-ie9">มหาวิทยาลัย/บริษัท</label>
                                    <input class="form-control placeholder-no-fix" type="text"  name="company" value="<?php echo e(old('company')!=null ? old('company') : $reviewuser->company); ?>" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">เลขบัตรประจำตัวประชาชน</label>
                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                    <label class="control-label visible-ie8 visible-ie9">เลขบัตรประจำตัวประชาชน</label>
                                    <input class="form-control placeholder-no-fix" type="text" name="citizen_id" value="<?php echo e(old('citizen_id')!=null ? old('citizen_id') : $reviewuser->citizen_id); ?>" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Passport ID</label>
                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                    <label class="control-label visible-ie8 visible-ie9">Passport ID</label>
                                    <input class="form-control placeholder-no-fix" type="text" name="passport_id" value="<?php echo e(old('passport_id')!=null ? old('passport_id') : $reviewuser->passport_id); ?>" disabled="true" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">ที่อยู่</label>
                                    <label class="control-label visible-ie8 visible-ie9">ที่อยู่</label>
                                    <input class="form-control placeholder-no-fix" type="text" name="address" value="<?php echo e(old('address')!=null ? old('address') : $reviewuser->address); ?>" />
                            </div>

                            <div class="form-group">
                                <label class="control-label">โทรศัพท์</label>
                                    <label class="control-label visible-ie8 visible-ie9">โทรศัพท์</label>
                                    <input class="form-control placeholder-no-fix" type="text" name="tel" value="<?php echo e(old('tel')!=null ? old('tel') : $reviewuser->tel); ?>" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">ไฟล์ที่อัพโหลดแล้ว</label>
                                    <div class="tiles current-file-panel">

                                    </div>
                            </div>
                        </div>
                   <div class="portlet light bordered modules-panel" style="box-shadow: 0 2px 3px 2px rgba(0,0,0,.03);">
                            <div class="portlet-title">
                                <div class="caption font-green-sharp">
                                    <span class="caption-subject bold uppercase"></span>
                                    <div class="caption-helper" style="width:200px;margin-top: 4px;">จัดการผู้ร้องขอ </div>
                                </div>
                            </div>
                            <div class="portlet-body file-portlet">
                                <div id="modules-table" class="table">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th> ส่วนงาน </th>
                                                    <th> สถานะ </th>
                                                    <th></th>
                                                </tr>
                                                
                                                
                                                
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div> 
                </form>
                
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>
                </div>
<!-- dialog -->
<div id="reject-dialog" title="กรุณาระบุเหตุผลที่ไม่อนุญาติ ">
  <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
        </div>
  <p class="validateTips">ข้อความนี้จะถูกส่งผ่าน E-mail ไปยังผู้ที่ทำการร้องขอ</p>
  <form class="reject-form" action="">
    <fieldset class="form-group">
      <div>
      <input type="text" name="rejectmsg" id="rejectmsg" value="" class="text ui-widget-content ui-corner-all" style="width:100%;">
      </div>
      <button type="submit" class="btn red" style="margin-top: 20px;">
                                    <i class="fa fa-check"></i>ตกลง</button>
    </fieldset>
  </form>
</div>
<!-- dialog -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/public/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/public/assets/pages/scripts/reviewprofile.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
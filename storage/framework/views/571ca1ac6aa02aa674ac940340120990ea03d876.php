<?php $__env->startSection('header'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css">
        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
        <link href="/assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <style>
        .file-panel{
            position:relative;
        }
        .file-panel .fa-close{
                position: absolute;
                right: 0px;
                font-size: 30px;
                color: red;
                top: 11px;
                cursor:pointer;
        }
        .file-panel .filedesc{
            margin-bottom:7px;
            width:90%;
        }
        .file-panel .file-custom-error{
            color:red;
        }
        </style>
<!-- END PAGE LEVEL STYLES -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
        <!-- BEGIN LOGO -->
        <div class="logo">
<!--            <a href="/index.html">-->
                <img src="/assets/global/img/logo-big.png" alt="" /> 
<!--        </a>-->
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="<?php echo e(url('/login')); ?>" method="post">
                <h3 class="form-title font-green">เข้าสู่ระบบ</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                </div>
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">E-Mail</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="email" name="email" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">รหัสผ่าน</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="รหัสผ่าน" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn red-pink uppercase">เข้าสู่ระบบ</button>
                    <label class="rememberme check">
                        <input type="checkbox" name="remember" />อยู่ในระบบต่อไป </label>
                    <a href="javascript:;" id="forget-password" class="forget-password">ลืม Password?</a>
                </div>
                <div class="create-account">
                    <p>
                        <a href="javascript:;" id="register-btn" class="uppercase">สมัครใช้งาน</a>
                    </p>
                </div>
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="<?php echo e(url('/password/email')); ?>" method="post">
                <?php echo csrf_field(); ?>

                <h3 class="font-green">กู้คืนหรัสผ่าน ?</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <?php if($errors->has('email')): ?>
                        <span><?php echo e($errors->first('email')); ?></span>
                    <?php endif; ?>
                </div>
                <?php if(session('status')): ?>
                        <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
                <?php endif; ?>
                
                <p> กรุณาระบุ E-mail เพื่อกู้คืนรหัสผ่าน. </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">กลับ</button>
                    <button type="submit" class="btn btn-success uppercase pull-right">ตกลง</button>
                </div>
            </form>
<!-- END FORGOT PASSWORD FORM -->
        <!-- BEGIN REGISTRATION FORM -->
            <form class="register-form" action="<?php echo e(url('/register')); ?>" method="post">
                <?php echo csrf_field(); ?>

                <h3 class="font-green">สมัครสมาชิก</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                </div>
                <div class="form-group form-md-checkboxes">
                    <p>กรุณากรอกข้อมูลให้ครบถ้วนทุก field ตามจริง</p>
                    <label>กรุณาเลือกระบบที่ต้องการใช้งาน :</label>
                    <div class="md-checkbox-list">
                    <?php foreach($modules as $module): ?>
                        <div class="md-checkbox">
                            <input type="checkbox" id="checkbox<?php echo e($module->id); ?>" class="md-check module_chkbox" name="module_<?php echo e($module->id); ?>" value="" <?php echo e(old('module_'.$module->id) != null ? 'checked' : ''); ?>>
                            <label for="checkbox<?php echo e($module->id); ?>">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span><?php echo e($module->name); ?></label>
                        </div>
                    <?php endforeach; ?>                 
                    </div>
                    <input type="hidden" id="hidden_module_value" value="" name="hidden_module_value"></input>
                    
                </div>
                <p class="hint"> กรุณากรอกข้อมูลส่วนตัว : </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">คำนำหน้าชื่อ</label>
                    <select name="title" class="form-control">
                        <option value="">กรุณาเลือกคำนำหน้า</option>
                        <?php foreach($titles as $title): ?>
                        <option value='<?php echo e($title->id); ?>' <?php echo e((old('title') == $title->id) ? 'selected' : ''); ?>><?php echo e($title->name); ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">ชื่อจริง</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="ชื่อจริง"  name="firstname" value="<?php echo e(old('firstname')); ?>"/> </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">นามสกุล</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="นามสกุล" name="lastname" value="<?php echo e(old('lastname')); ?>"/> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">เพศ</label>
                    <select name="sex" class="form-control">
                        <option value="">เพศ</option>
                        <?php foreach($sexes as $sex): ?>
                        <option value='<?php echo e($sex->id); ?>' <?php echo e((old('sex') == $sex->id) ? 'selected' : ''); ?>><?php echo e($sex->name); ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>" /> </div>
                    <div class="form-group">                  
                        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date="12-02-2012">
                            <input type="text" class="form-control" name="dob" value="<?php echo e(old('dob')); ?>" readonly="" placeholder="Date of birth">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button" style="line-height:2.1">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                        </div>         
                    </div>
                    <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">สัญชาติ</label>
                    <select name="nationality" class="form-control">
                        <option value=''>กรุณาระบุสัญชาติ</option>
                        <?php foreach($nationalities as $nationality): ?>
                        <option value='<?php echo e($nationality->id); ?>' <?php echo e((old('nationality') == $nationality->id) ? 'selected' : ''); ?>><?php echo e($nationality->name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">กลุ่มสมาชิก</label>
                    <select name="type" class="form-control">
                        <option value="">กรุณาเลือกประเภทสมาชิก</option>
                        <?php foreach($types as $type): ?>
                        <option value='<?php echo e($type->id); ?>' <?php echo e((old('type') == $type->id) ? 'selected' : ''); ?>><?php echo e($type->name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group user_occupation_panel" style="display:none;">
                    <label class="control-label visible-ie8 visible-ie9">ประเภทของบุคคลากร</label>
                    <select name="occupation" class="form-control">
                        <option value="">กรุณาเลือกประเภทบุคคลากร</option>
                        <?php foreach($occupations as $occupation): ?>
                        <option value='<?php echo e($occupation->id); ?>' <?php echo e((old('occupation') == $occupation->id) ? 'selected' : ''); ?>><?php echo e($occupation->name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="pre-hidden-group" style="display:none;">
                <div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">รหัสนิสิต</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="รหัสนิสิต" name="student_id" value="<?php echo e(old('student_id')); ?>" hide student/> </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">อาจารย์ที่ปรึกษา</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="อาจารย์ที่ปรึกษา" name="advisor" value="<?php echo e(old('advisor')); ?>" hide student/> </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">หัวข้องานวิจัย</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="หัวข้องานวิจัย" name="researchtopic" value="<?php echo e(old('researchtopic')); ?>" hide student/> </div>
                <div class="form-group department-panel">
                    <label class="control-label visible-ie8 visible-ie9">ภาควิชา</label>
                    <select name="department" class="form-control" hide>
                        <option value=''>ภาควิชา</option>
                        <?php foreach($departments as $department): ?>
                        <option value='<?php echo e($department->id); ?>' <?php echo e((old('department') == $department->id) ? 'selected' : ''); ?>><?php echo e($department->name); ?></option>
                        <?php endforeach; ?>
                    </select> </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">มหาวิทยาลัย/บริษัท</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="มหาวิทยาลัย/บริษัท" name="company" value="<?php echo e(old('company')); ?>" hide outsider/> </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">เลขบัตรประจำตัวประชาชน</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="เลขบัตรประจำตัวประชาชน" name="citizen_id" value="<?php echo e(old('citizen_id')); ?>"/> </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Passport ID</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Passport ID" name="passport_id" value="<?php echo e(old('passport_id')); ?>" style="display:none;" disabled="true" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">ที่อยู่</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="ที่อยู่" name="address" value="<?php echo e(old('address')); ?>" /> </div>
                
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">โทรศัพท์</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="โทรศัพท์" name="tel" value="<?php echo e(old('tel')); ?>" /> </div>
                </div>
                <div class="portlet light bordered" style="box-shadow: 0 2px 3px 2px rgba(0,0,0,.03);">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <span class="caption-subject bold uppercase"></span>
                            <i class="fa fa-file-image-o"></i>
                            <div class="caption-helper" style="width:200px;">ไฟล์รูปภาพเพื่อประกอบการสมัคร ท่านต้องอัพโหลดไฟล์ภาพบัตรนักศึกษา หรือบัตรประจำตัวประชาชน หรือเอกสารต่างๆที่เกี่ยวข้องให้ครบถ้วน</div>
                        </div>
                        <div class="actions">
                            <a href="javascript:;" id="file-add-btn" class="btn btn-circle btn-default btn-sm">
                            <i class="fa fa-plus"></i> เพิ่ม </a>
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body file-portlet">
                        <div class="form-group file-panel" >
                        <label class="control-label visible-ie8 visible-ie9">รายละเอียดของไฟล์</label>
                        <input class="form-control placeholder-no-fix filedesc" type="text" placeholder="รายละเอียดของไฟล์" name="filedesc[]" /> 
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn green btn-file">
                                <span class="fileinput-new"> Select file </span>
                                <span class="fileinput-exists"> Change </span>
                                <input type="hidden" value="" name="..."><input type="file" name="documents[]" accept="image/jpg,image/png,image/jpeg"> </span>
                                <span class="fileinput-filename"></span> &nbsp;
                                <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                        </div>
                        </div>         
                    </div>
                </div>

                <p class="hint"> กรุณาตั้งรหัสผ่าน : </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">รหัสผ่าน</label>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="รหัสผ่าน" name="password" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">ยืนยันรหัสผ่าน</label>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="ยืนยันรหัสผ่าน" name="password_confirmation" /> </div>
                <!--<div class="form-group margin-top-20 margin-bottom-20">
                    <label class="check">
                        <input type="checkbox" name="tnc" /> I agree to the
                        <a href="javascript:;"> Terms of Service </a> &
                        <a href="javascript:;"> Privacy Policy </a>
                    </label>
                    <div id="register_tnc_error"> </div>
                </div>-->
                <p>เมื่อท่านได้ทำการสมัครแล้วท่านจะได้รับอีเมลล์ยืนยันการสมัครจากระบบ Research Application และเมื่อ Admin ได้ทำการอนุมัติการสมัครของท่านแล้ว ท่านจะได้รับอีกเมลล์อีกครั้ง ท่านจึงจะสามารถใช้อีเมลล์และรหัสผ่านที่ท่านตั้งไว้เข้าระบบได้</p>
                <div class="form-actions">
                    <button type="button" id="register-back-btn" class="btn btn-default">กลับ</button>
                    <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">สมัคร</button>
                </div>
            </form>
            <!-- END REGISTRATION FORM -->
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/assets/pages/scripts/login.js" type="text/javascript"></script>
        <script src="/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
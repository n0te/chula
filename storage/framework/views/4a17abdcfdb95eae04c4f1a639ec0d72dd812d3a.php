<?php $__env->startSection('head'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
<link href="/assets/global/plugins/sudobar/dist/style/jquery.sudo-notify.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/jquery-steps/jquery.step.css" rel="stylesheet" type="text/css"/>
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
    .form-horizontal .control-label{
        text-align: left;
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
                <span>แบบฟอร์มขอจัดทำประกาศแหล่งทุนภายนอก</span>
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


                <div id='approveSeoction' style=" display: none;" class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i> การอนุมัติ</div>
                        <div class="tools">
                            <a href="" class="collapse" data-original-title="" title=""> </a>

                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div style=" display: none;" id='divApprove1' class="form-body" style=" padding-bottom: 0px;">
                            <div class="form-group">
                                <label>ผู้อนุมัติท่านที่ 1. </label><span id='spnApprover1'>Peerachart Umpaichitr</span> <span id='spnApproveDate1'>วันที่อนุมัติ 12/04/2016</span>

                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group">
                                <label>เหตุผลในการปฏิเสธ</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-actions right1">
                            <a type="submit" onclick="PreSave(); return false;" class="btn green">
                                <i class="fa fa-check"></i> อนุมัติ</a>

                            <a type="submit" onclick="SendData(); return false;" class="btn red">
                                <i class="fa fa-close"></i> ปฏิเสธ</a>
                        </div>

                    </div>
                </div>
                <div class="portlet light bordered" id="reqform">
                    <form role="form" class="form-horizontal" action="<?php echo e(url('/formreq')); ?>" enctype="multipart/form-data">
                        <div id="formwiz">
                            <h3>รายละเอียด</h3>
                            <fieldset  style=" width: 100%;">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">ส่วนงาน ภาควิชา</label>
                                        <div class="col-md-10">
                                            <select name="ddlDepartment"  id="ddlDepartment" class="form-control">
                                                <option value=''>ภาควิชา</option>
                                                <?php foreach($departments as $department): ?>
                                                <option value='<?php echo e($department -> id); ?>'> <?php echo e($department -> name); ?>

                                                </option>

                                                <?php endforeach; ?>

                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div  id='divOtherDepartment' style=" display: none;" class="form-group">
                                        <label class="col-md-2 control-label">ส่วนงาน ภาควิชา อื่นๆ</label>
                                        <div class="col-md-10">
                                            <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtOtherDepartment" id="txtOtherDepartment" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">โทร</label>
                                        <div class="col-md-10">
                                            <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="txtTel" id="txtTel" value=""/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">เรียน</label>
                                        <div class="col-md-10">
                                            <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtTo" id="txtTo" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">ผู้สนับสนุนทุนวิจัย(แหล่งทุน)</label>
                                        <div class="col-md-10">
                                            <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtSponser" id="txtSponser" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">จำนวนงบทุนวิจัย</label>
                                        <div class="col-md-10">
                                            <div class="input-group" style=" border: 0px; padding: 0px;">
                                                <input onkeypress="return isNumberKey(event)" class="form-control placeholder-no-fix" type="text" placeholder="" name="txtBudgetScholarship" id="txtBudgetScholarship" value="" />
                                                <div class="input-group-addon">บาท</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">กำหนดระยะเวลาตั้งแต่</label>
                                        <div class="col-md-10">
                                            <div class="input-group">
                                                <input data-date-format="dd-mm-yyyy" class="form-control form-control-inline date-picker" size="16" type="text" value="" id="txtStartDateScholarship" name="txtStartDateScholarship">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">ถึง</label>
                                        <div class="col-md-10">
                                            <div class="input-group">
                                                <input data-date-format="dd-mm-yyyy" class="form-control form-control-inline date-picker" size="16" type="text" value="" name="txtEndDateScholarship" id="txtEndDateScholarship">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h3>1.วัตถุประสงค์โครงการวิจัย</h3>
                            <fieldset style=" width: 100%;">
                                <div class="form-body">
                                    <div id="Objective" class="form-body">

                                        <!-- Form template-->
                                        <div id="Objective_template" class="form-group" >
                                            <label class="col-md-2 control-label" for="Objective_#index#">ข้อที่ <span id="Objective_label"></span><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control placeholder-no-fix" type="text" placeholder="" id="Objective_#index#" name="Objective_#index#" value="" />
                                            </div>
                                            <div class="col-md-1">
                                                <a id="Objective_remove_current">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>
                                        </div>

                                        <!-- /Form template-->

                                        <!-- No forms template -->
                                        <div id="Objective_noforms_template">คลิก "เพิ่ม" เพื่อเพิ่มวัตถุประสงค์โครงการวิจัย</div>
                                        <!-- /No forms template-->

                                        <!-- Controls -->

                                        <div id="Objective_controls">
                                            <div class="clearfix">&nbsp;</div>
                                            <div id="Objective_add" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-plus"></i> เพิ่ม
                                                </a>
                                            </div>
                                            <div id="Objective_remove_last" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>
                                            <div id="Objective_remove_all" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบทั้งหมด
                                                </a>
                                            </div>
                                            <div id="Objective_add_n" class="pull-left">
                                                <input id="Objective_add_n_input" type="text" size="4" />
                                                <div id="Objective_add_n_button">
                                                    <a class="btn btn-circle btn-default btn-sm">
                                                        <i class="fa fa-plus"></i> เพิ่ม
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h3>2.การบริหารโครงการวิจัย</h3>
                            <fieldset style=" width: 100%;">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">2.1 ผู้รับผิดชอบโครงการ</label>
                                        <div class="col-md-9">
                                            <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtResponsibleProjectPerson" id="txtResponsibleProjectPerson" value="คณบดีคณะแพทย์ศาสตร์" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">2.2 คณะผู้ทำการวิจัย</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">2.2.1 (หัวหน้าโครงการวิจัย)<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtHeadOfProject" id="txtHeadOfProject" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">2.2.2 (ผู้ร่วมโครงการวิจัย)</label>
                                    </div>
                                    <div id="ManagementProject">

                                        <!-- Form template-->
                                        <div id="ManagementProject_template" class="form-group" >
                                            <div class="form-group">
                                                <div class="input-group hidden">
                                                    <input class="form-control placeholder-no-fix" type="text" id="ManagementProject_#index#" name="ManagementProject_#index#" value="" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="col-md-12 control-label" for="ManagementProject_#index#">2.2.2.<span id="ManagementProject_label"></span><span class="required">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control placeholder-no-fix" type="text" placeholder="" id="ManagementProject_Firstname_#index#" name="ManagementProject_Firstname_#index#" value="" />
                                                </div>
                                                <div class="col-md-1">
                                                    <a id="ManagementProject_remove_current">
                                                        <i class="fa fa-close"></i> ลบ
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /Form template-->

                                        <!-- No forms template -->
                                        <div id="ManagementProject_noforms_template">คลิก "เพิ่ม" เพื่อเพิ่มคณะผู้ทำการวิจัย</div>
                                        <!-- /No forms template-->

                                        <!-- Controls -->

                                        <div id="ManagementProject_controls">
                                            <div class="clearfix">&nbsp;</div>
                                            <div id="ManagementProject_add" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-plus"></i> เพิ่ม
                                                </a>
                                            </div>
                                            <div id="ManagementProject_remove_last" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>
                                            <div id="ManagementProject_remove_all" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบทั้งหมด
                                                </a>
                                            </div>
                                            <div id="ManagementProject_add_n" class="pull-left">
                                                <input id="ManagementProject_add_n_input" type="text" size="4" />
                                                <div id="ManagementProject_add_n_button">
                                                    <a class="btn btn-circle btn-default btn-sm">
                                                        <i class="fa fa-plus"></i> เพิ่ม
                                                    </a></div>
                                            </div>
                                        </div>


                                        <!-- /Controls -->

                                    </div>
                                    <!-- /sheepIt Form -->
                                </div>

                            </fieldset>
                            <h3>3.งบประมาณ</h3>
                            <fieldset  style=" width: 100%;">

                                <div class="form-body">
                                    <!-- sheepIt Form -->
                                    <div id="TopicBudget">

                                        <!-- Form template-->
                                        <div id="TopicBudget_template">

                                            <div class="col-md-12 form-group">
                                                <label for="TopicBudget_#index#">3.<span id="TopicBudget_label"></span><span class="required">*</span></label>
                                                <a id="TopicBudget_remove_current">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label class="control-label col-md-2">หัวข้องบประมาณ</label>
                                                <div class="col-md-10">
                                                    <input class="form-control placeholder-no-fix" type="text" placeholder="" id="TopicBudget_Topic_#index#" name="TopicBudget_Topic_#index#" value="" />
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label class="control-label col-md-2">งบประมาณ</label>
                                                <div class="col-md-10">
                                                    <input onkeypress="return isNumberKey(event)" class="form-control placeholder-no-fix" type="text" placeholder="" id="TopicBudget_Amount_#index#" name="TopicBudget_Amount_#index#" value="" />
                                                </div>
                                            </div>

                                            <div  class="col-md-12">
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-11">
                                                    <div id="TopicBudget_#index#_Sub">


                                                        <div id="TopicBudget_#index#_Sub_template" class="form-group" >
                                                            <div class="col-md-12 form-group">
                                                                <label>งบประมาณย่อย  <label for="for="TopicBudget_#index#_Sub_#index_Sub#">3.</label><span id="TopicBudget_label"></span>.<span id="TopicBudget_#index#_Sub_label"></span></label> </label>
                                                                <a id="TopicBudget_#index#_Sub_remove_current">
                                                                    <i class="fa fa-close"></i> ลบ
                                                                </a>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label class="control-label col-md-3">หัวข้องบประมาณ</label>
                                                                <div class="col-md-9">
                                                                    <input class="form-control placeholder-no-fix" type="text" placeholder="" id="TopicBudget_Topic_#index#_#index_Sub#" name="TopicBudget_Topic_#index#_#index_Sub#" name2="TopicBudget_Topic_#index#_#index_Sub#"  value="" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label class="control-label col-md-3">งบประมาณ</label>
                                                                <div class="col-md-9">
                                                                    <input onkeypress="return isNumberKey(event)" class="form-control placeholder-no-fix" type="text" placeholder="" id="TopicBudget_Amount_#index#_#index_Sub#" name="TopicBudget_Amount_#index#_#index_Sub#" name2="TopicBudget_Amount_#index#_#index_Sub#"  value="" />
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div id="TopicBudget_#index#_Sub_noforms_template">คลิก "เพิ่ม" เพื่อเพิ่มงบประมาณย่อย</div>


                                                        <div id="TopicBudget_#index#_Sub_controls">
                                                            <div class="clearfix">&nbsp;</div>
                                                            <div id="TopicBudget_#index#_Sub_add" class="pull-left">
                                                                <a class="btn btn-circle btn-default btn-sm">
                                                                    <i class="fa fa-plus"></i> เพิ่ม
                                                                </a>
                                                            </div>
                                                            <div id="TopicBudget_#index#_Sub_remove_last" class="pull-left">
                                                                <a class="btn btn-circle btn-default btn-sm">
                                                                    <i class="fa fa-close"></i> ลบ
                                                                </a>
                                                            </div>
                                                            <div id="TopicBudget_#index#_Sub_remove_all" class="pull-left">
                                                                <a class="btn btn-circle btn-default btn-sm">
                                                                    <i class="fa fa-close"></i> ลบทั้งหมด
                                                                </a>
                                                            </div>
                                                            <div id="TopicBudget_#index#_Sub_add_n" class="pull-left">
                                                                <input id="TopicBudget_#index#_Sub_add_n_input" type="text" size="4" />
                                                                <div id="TopicBudget_#index#_Sub_add_n_button">
                                                                    <a class="btn btn-circle btn-default btn-sm">
                                                                        <i class="fa fa-plus"></i> เพิ่ม
                                                                    </a></div>
                                                            </div>
                                                            <div class="clearfix">&nbsp;</div>
                                                        </div>




                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <!-- /Form template-->

                                        <!-- No forms template -->
                                        <div id="TopicBudget_noforms_template">คลิก "เพิ่ม" เพื่อเพิ่มงบประมาณ</div>
                                        <!-- /No forms template-->

                                        <!-- Controls -->

                                        <div id="TopicBudget_controls">
                                            <div class="clearfix">&nbsp;</div>
                                            <div id="TopicBudget_add" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-plus"></i> เพิ่ม
                                                </a>
                                            </div>
                                            <div id="TopicBudget_remove_last" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>
                                            <div id="TopicBudget_remove_all" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบทั้งหมด
                                                </a>
                                            </div>
                                            <div id="TopicBudget_add_n" class="pull-left">
                                                <input id="TopicBudget_add_n_input" type="text" size="4" />
                                                <div id="TopicBudget_add_n_button">
                                                    <a class="btn btn-circle btn-default btn-sm">
                                                        <i class="fa fa-plus"></i> เพิ่ม
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="clearfix">&nbsp;</div>
                                        </div>


                                        <!-- /Controls -->

                                    </div>
                                    <!-- /sheepIt Form -->
                                </div>


                            </fieldset>
                            <h3>4.ค่าจ้าง ค่าตอบแทน(ถ้ามี)</h3>
                            <fieldset  style=" width: 100%;">
                                <div class="form-body">
                                    <div id="Payroll">

                                        <!-- Form template-->
                                        <div id="Payroll_template" >
                                            <div class="col-md-12 form-group">
                                                <label for="Payroll_#index#">4.<span id="Payroll_label"></span></label>
                                                <a id="Payroll_remove_current">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>
                                            <div class="input-group hidden">
                                                <input class="form-control placeholder-no-fix" type="text" id="Payroll_#index#" name="Payroll_#index#" value="" />
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label class="control-label col-md-2">รายการ</label>
                                                <div class="col-md-10">
                                                    <input class="form-control placeholder-no-fix" type="text" placeholder="" id="Payroll_Name_#index#" name="Payroll_Name_#index#" value="" />
                                                </div>

                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label class="control-label col-md-2">ค่าจ้าง</label>
                                                <div class="col-md-10">
                                                    <input onkeypress="return isNumberKey(event)" class="form-control placeholder-no-fix" type="text" placeholder="" id="Payroll_Amount_#index#" name="Payroll_Amount_#index#" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Form template-->

                                        <!-- No forms template -->
                                        <div id="Payroll_noforms_template">คลิก "เพิ่ม" เพื่อเพิ่มค่าจ้าง ค่าตอบแทน ของบุคลากรในโครงการ</div>
                                        <!-- /No forms template-->

                                        <!-- Controls -->

                                        <div id="Payroll_controls">
                                            <div class="clearfix">&nbsp;</div>
                                            <div id="Payroll_add" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-plus"></i> เพิ่ม
                                                </a>
                                            </div>
                                            <div id="Payroll_remove_last" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>
                                            <div id="Payroll_remove_all" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบทั้งหมด
                                                </a>
                                            </div>
                                            <div id="Payroll_add_n" class="pull-left">
                                                <input id="Payroll_add_n_input" type="text" size="4" />
                                                <div id="Payroll_add_n_button">
                                                    <a class="btn btn-circle btn-default btn-sm">
                                                        <i class="fa fa-plus"></i> เพิ่ม
                                                    </a></div>
                                            </div>
                                        </div>


                                        <!-- /Controls -->

                                    </div>
                                </div>

                            </fieldset>
                            <h3>5.การเก็บรักษาเงิน</h3>
                            <fieldset   style=" width: 100%;">
                                <div class="form-body">
                                    <div class="col-md-12 form-group">
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label col-md-2">ธนาคาร<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtBankName" id="txtBankName" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label col-md-2">สาขา<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtBranch" id="txtBranch" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label col-md-2">ชื่อบัญชี<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtAccountName" id="txtAccountName" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label col-md-2">เลขที่บัญชี<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control placeholder-no-fix" type="text" placeholder="" name="txtAccountNumber" id="txtAccountNumber" value="" />
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                            <h3>6.ผู้มีอำนาจสั่งจ่าย</h3>
                            <fieldset style=" width: 100%;">
                                <div class="form-body">
                                    <div id="AuthorizedPerson" class="form-body">

                                        <!-- Form template-->
                                        <div id="AuthorizedPerson_template" class="form-group" >
                                            <label class="col-md-2 control-label" for="AuthorizedPerson_#index#">ท่านที่ <span id="AuthorizedPerson_label"></span><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control placeholder-no-fix" type="text" placeholder="" id="AuthorizedPerson_#index#" name="AuthorizedPerson_#index#" value="" />
                                            </div>
                                            <div class="col-md-1">
                                                <a id="AuthorizedPerson_remove_current">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>
                                        </div>

                                        <!-- /Form template-->

                                        <!-- No forms template -->
                                        <div id="AuthorizedPerson_noforms_template">คลิก "เพิ่ม" เพื่อเพิ่มผู้มีอำนาจสั่งจ่าย</div>
                                        <!-- /No forms template-->

                                        <!-- Controls -->

                                        <div id="AuthorizedPerson_controls">
                                            <div class="clearfix">&nbsp;</div>
                                            <div id="AuthorizedPerson_add" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-plus"></i> เพิ่ม
                                                </a>
                                            </div>
                                            <div id="AuthorizedPerson_remove_last" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>
                                            <div id="AuthorizedPerson_remove_all" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบทั้งหมด
                                                </a>
                                            </div>
                                            <div id="AuthorizedPerson_add_n" class="pull-left">
                                                <input id="AuthorizedPerson_add_n_input" type="text" size="4" />
                                                <div id="AuthorizedPerson_add_n_button">
                                                    <a class="btn btn-circle btn-default btn-sm">
                                                        <i class="fa fa-plus"></i> เพิ่ม
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <h3>7.กำหนดการรายงาน</h3>
                            <fieldset  style=" width: 100%;">
                                <div class="form-body" class="col-md-12">
                                    <div class="form-group col-md-12">
                                        <label class="col-md-3 control-label">กำหนดการรายงาน</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="txtReport" name="txtReport" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h3>8.กำหนดระยะเวลาการจ่ายเงิน</h3>
                            <fieldset  style=" width: 100%;">
                                <div class="form-body">


                                    <!-- sheepIt Form -->
                                    <div id="PayDate">

                                        <!-- Form template-->
                                        <div id="PayDate_template" class="form-group" >
                                            <div class="col-md-12 form-group">
                                                <label for="PayDate_#index#">งวดที่ <span id="PayDate_label"></span><span class="required">*</span></label>
                                                <a id="PayDate_remove_current">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>

                                            <div class="input-group hidden">
                                                <input class="form-control placeholder-no-fix" type="text" id="PayDate_#index#" name="PayDate_#index#" value="" />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                                <div class="input-group" style=" border: 0px; padding: 0px;">
                                                    <input onkeypress="return isNumberKey(event)" class="form-control placeholder-no-fix" type="text" placeholder="" id="PayDate_Amount_#index#" name="PayDate_Amount_#index#" value="" />
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <input  class="form-control placeholder-no-fix" type="text" value="" id="PayDate_Date_#index#" name="PayDate_Date_#index#">
                                            </div>

                                        </div>
                                        <!-- /Form template-->

                                        <!-- No forms template -->
                                        <div id="PayDate_noforms_template">คลิก "เพิ่ม" เพื่อเพิ่มระยะเวลาการจ่ายเงิน</div>
                                        <!-- /No forms template-->

                                        <!-- Controls -->

                                        <div id="PayDate_controls">
                                            <div id="PayDate_add" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-plus"></i> เพิ่ม
                                                </a>
                                            </div>
                                            <div id="PayDate_remove_last" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบ
                                                </a>
                                            </div>
                                            <div id="PayDate_remove_all" class="pull-left">
                                                <a class="btn btn-circle btn-default btn-sm">
                                                    <i class="fa fa-close"></i> ลบทั้งหมด
                                                </a>
                                            </div>
                                            <div id="PayDate_add_n" class="pull-left">
                                                <input id="PayDate_add_n_input" type="text" size="4" />
                                                <div id="PayDate_add_n_button">
                                                    <a class="btn btn-circle btn-default btn-sm">
                                                        <i class="fa fa-plus"></i> เพิ่ม
                                                    </a></div>
                                            </div>
                                        </div>


                                        <!-- /Controls -->

                                    </div>
                                    <!-- /sheepIt Form -->

                                </div>
                            </fieldset>
                        </div>


                    </form>
                    <input type="hidden" name="hidSaveOrSend" id="hidSaveOrSend" value="">

                </div>


            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/sheepit/jquery.sheepItPlugin.js" type="text/javascript"></script>
<script src="/assets/global/plugins/sudobar/dist/jquery.sudo-notify.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquerydateFormat.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-steps/jquery.steps.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
                                                        var fid = '<?php echo e($fid); ?>';
                                                        var appr = '<?php echo e($appr); ?>';
</script>
<script src="/assets/pages/scripts/formreq2.js" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
@extends('layouts.app')

@section('head')
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL STYLES -->
        <link href="public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
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
                                <span>User</span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> {{$user->firstname}} Profile 
                        
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
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#profile" data-toggle="tab">ข้อมูลส่วนตัว</a>
                                                    </li>
                                                    <li>
                                                        <a href="#module" data-toggle="tab">ส่วนงาน</a>
                                                    </li>
                                                    <li>
                                                        <a href="#password" data-toggle="tab">เปลี่ยนรหัสผ่าน</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="profile">
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
        </div>

                 <form role="form" class="profile-form form-bordered" action="{{ url('/profile') }}" enctype="multipart/form-data">
                    
                        <div class="form-group">
                            <label class="control-label">คำนำหน้า</label>
                                <label class="control-label visible-ie8 visible-ie9">คำนำหน้าชื่อ</label>
                                <select name="title" class="form-control">
                                    <option value="">กรุณาเลือกคำนำหน้า</option>
                                    @foreach($titles as $title)
                                    <option value='{{$title->id}}' @if(old( 'title') != null) {{ (old( 'title')== $title->id) ? 'selected' : ''}} @else {{ $user->title == $title->id ? 'selected' : ''}} @endif > {{$title->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        
                        <div class="form-group">
                            <label class="control-label">ชื่อจริง</label>
                                <label class="control-label visible-ie8 visible-ie9">ชื่อจริง</label>
                                <input class="form-control placeholder-no-fix" type="text" placeholder="ชื่อจริง" name="firstname" value="{{ old('firstname')!=null ? old('firstname') : $user->firstname}}" />
                        </div>
                        <div class="form-group">
                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                            <label class="control-label">นามสกุล</label>
                            
                                <label class="control-label visible-ie8 visible-ie9">นามสกุล</label>
                                <input class="form-control placeholder-no-fix" type="text" placeholder="นามสกุล" name="lastname" value="{{ old('lastname')!=null ? old('lastname') : $user->lastname}}" />
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label">เพศ</label>
                                <label class="control-label visible-ie8 visible-ie9">เพศ</label>
                                <select name="sex" class="form-control" disabled>
                                    <option value="">เพศ</option>
                                    @foreach($sexes as $sex)
                                    <option value='{{$sex->id}}' @if(old('sex')!=null) {{ old( 'sex')== $sex->id ? 'selected' : '' }} @elseif($user->sex == $sex->id) {{ 'selected' }} @endif > {{$sex->name}}
                                    </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                            <label class="control-label">Email</label>
                                <label class="control-label visible-ie8 visible-ie9">Email</label>
                                <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" value="{{ old('email')!=null ? old('email') : $user->email}}" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">เกิดวันที่</label>
                                <input data-date-format="dd-mm-yyyy" class="form-control form-control-inline date-picker" size="16" type="text" value="{{ old('dob')!=null ? old('dob') : $user->get_userDOB()}}" name="dob" disabled>
                        </div>
                        <div class="form-group">
                            <label class="control-label">สัญชาติ</label>
                                <label class="control-label visible-ie8 visible-ie9">สัญชาติ</label>
                                <select name="nationality" class="form-control" disabled>
                                    <option value=''>กรุณาระบุสัญชาติ</option>
                                    @foreach($nationalities as $nationality)
                                    <option value='{{$nationality->id}}' @if(old( 'nationality')!=null) {{ old('nationality')== $nationality->id ? 'selected' : '' }} @elseif($user->nationality == $nationality->id) {{ 'selected' }} @endif > {{$nationality->name}}
                                    </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">กลุ่มสมาชิก</label>
                                <label class="control-label visible-ie8 visible-ie9">กลุ่มสมาชิก</label>
                                <select name="type" class="form-control" disabled>
                                    <option value="">กรุณาเลือกประเภทสมาชิก</option>
                                    @foreach($types as $type)
                                    <option value='{{$type->id}}' @if(old('type')!=null) {{ old('type')==$type->id ? 'selected' : '' }} @elseif($user->type == $type->id) {{ 'selected' }} @endif > {{$type->name}}
                                    </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group user_occupation_panel" style="display:none;">
                            <label class="control-label">ประเภทของบุคคลากร</label>
                                <label class="control-label visible-ie8 visible-ie9">ประเภทของบุคคลากร</label>
                                <select name="occupation" class="form-control" disabled>
                                    <option value="">กรุณาเลือกประเภทบุคคลากร</option>
                                    @foreach($occupations as $occupation)
                                    <option value='{{$occupation->id}}' @if(old( 'occupation')!=null) {{ old('occupation')==$occupation->id ? 'selected' : '' }} @elseif($user->occupation == $occupation->id) {{ 'selected' }} @endif > {{$occupation->name}}
                                    </option>
                                    @endforeach
                                </select>
                        </div>
                     
                        <div id="pre-hidden-group" style="display:none;">
                            <div>
                                <div class="form-group" hide other>
                                    <label class="control-label">อื่นๆ</label>
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label visible-ie8 visible-ie9">อื่นๆ</label>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="อื่นๆ" name="orther_specify" value="{{ old('orther_specify')!=null ? old('orther_specify') : $user->orther_specify}}" disabled/>
                                </div>
                                <div class="form-group" hide student>
                                    <label class="control-label">รหัสนิสิต</label>
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label visible-ie8 visible-ie9">รหัสนิสิต</label>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="รหัสนิสิต" name="student_id" value="{{ old('student_id')!=null ? old('student_id') : $user->student_id}}" disabled/>
                                </div>
                                <div class="form-group" hide student>
                                    <label class="control-label">อาจารย์ที่ปรึกษา</label>
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label visible-ie8 visible-ie9">อาจารย์ที่ปรึกษา</label>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="อาจารย์ที่ปรึกษา" name="advisor" value="{{ old('advisor')!=null ? old('advisor') : $user->advisor}}" disabled/>
                                </div>
                                <div class="form-group" hide student>
                                    <label class="control-label">หัวข้องานวิจัย</label>
                                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                        <label class="control-label visible-ie8 visible-ie9">หัวข้องานวิจัย</label>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="หัวข้องานวิจัย" name="researchtopic" value="{{ old('researchtopic')!=null ? old('researchtopic') : $user->researchtopic}}" disabled/> 
                                </div>
                                <div class="form-group department-panel" hide>
                                    <label class="control-label">อาจารย์ที่ปรึกษา</label>
                                        <label class="control-label visible-ie8 visible-ie9">ภาควิชา</label>
                                        <select name="department" class="form-control" disabled>
                                            <option value=''>ภาควิชา</option>
                                            @foreach($departments as $department)
                                            <option value='{{$department->id}}' @if(old( 'department')!=null) {{ old( 'department')== $department->id ? 'selected' : '' }} @elseif($user->department == $department->id) {{ 'selected' }} @endif > {{$department->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="form-group" hide outsider>
                                <label class="control-label">มหาวิทยาลัย/บริษัท</label>
                                    <label class="control-label visible-ie8 visible-ie9">มหาวิทยาลัย/บริษัท</label>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="มหาวิทยาลัย/บริษัท" name="company" value="{{ old('company')!=null ? old('company') : $user->company}}" disabled/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">เลขบัตรประจำตัวประชาชน</label>
                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                    <label class="control-label visible-ie8 visible-ie9">เลขบัตรประจำตัวประชาชน</label>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="เลขบัตรประจำตัวประชาชน" name="citizen_id" value="{{ old('citizen_id')!=null ? old('citizen_id') : $user->citizen_id}}" disabled/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Passport ID</label>
                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                    <label class="control-label visible-ie8 visible-ie9">Passport ID</label>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="Passport ID" name="passport_id" value="{{ old('passport_id')!=null ? old('passport_id') : $user->passport_id}}" disabled/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">ที่อยู่</label>
                                    <label class="control-label visible-ie8 visible-ie9">ที่อยู่</label>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="ที่อยู่" name="address" value="{{ old('address')!=null ? old('address') : $user->address}}" />
                            </div>

                            <div class="form-group">
                                <label class="control-label">โทรศัพท์</label>
                                    <label class="control-label visible-ie8 visible-ie9">โทรศัพท์</label>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="โทรศัพท์" name="tel" value="{{ old('tel')!=null ? old('tel') : $user->tel}}" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">ไฟล์ที่อัพโหลดแล้ว</label>
                                    <div class="tiles current-file-panel">

                                    </div>
                            </div>
                        </div>
                        <div class="portlet light bordered" style="box-shadow: 0 2px 3px 2px rgba(0,0,0,.03);">
                            <div class="portlet-title">
                                <div class="caption font-green-sharp">
                                    <span class="caption-subject bold uppercase"></span>
                                    <i class="fa fa-file-image-o"></i>
                                    <div class="caption-helper" style="width:200px;margin-top: 4px;">ไฟล์รูปภาพเพื่อประกอบการสมัคร </div>
                                </div>
                                <div class="actions">
                                    <a href="javascript:;" id="file-add-btn" class="btn btn-circle btn-default btn-sm">
                                        <i class="fa fa-plus"></i> อัพโหลดเพิ่ม </a>
                                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body file-portlet">
                            </div>
                        </div>
                    
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn red">
                                    <i class="fa fa-check"></i> อัพเดทข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </form>
                               
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    <!-- MODULES TAB -->
                                                    <div class="tab-pane" id="module">
                                                        
                                                        <form class="modules-form" action="#" role="form">
                                                            <div class="form-group">
                                                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-social-dribbble font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">ส่วนงาน</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                </div>
                                    <div id="modules-table" class="table">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th> ส่วนงาน </th>
                                                    <th> สถานะ </th>
                                                    <th>  </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                                                                
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END MODULES TAB -->
                                                    <!-- CHANGE PASSWORD TAB -->
                                                    <div class="tab-pane" id="password">
        <form class="changepassword-form" action="{{ url('/changepassword') }}">
                                                        <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                </div>
                                                            <div class="form-group">
                                                                <label class="control-label">รหัสผ่านปัจจุบัน</label>
                                                                <input type="password" class="form-control" name="old_password"/> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">รหัสผ่านใหม่</label>
                                                                <input id="new_password" type="password" class="form-control" name="new_password"/> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">ยืนยันรหัสผ่านใหม่</label>
                                                                <input type="password" class="form-control" name="new_password_confirmation"/> </div>
                                                            <div class="margin-top-10">
                                                                <button type="submit" class="btn green">
                                                        <i class="fa fa-check"></i>เปลี่ยนรหัสผ่าน</button> 
                                                            </div>
           </form>
                                                    </div>
                                                    <!-- END CHANGE PASSWORD TAB -->
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
@endsection

@section('footer')
	<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
        
        
        
        <script src="public/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="public/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <script src="public/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
        <script src="public/assets/pages/scripts/profile.js" type="text/javascript"></script>
        <script src="public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
@endsection
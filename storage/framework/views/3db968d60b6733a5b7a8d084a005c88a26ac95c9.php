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
<link href="public/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css"/>
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
                <span>อาจารย์</span>
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
                        <span class="caption-subject font-dark bold uppercase">ตารางอาจารย์ทั้งหมด</span>
                    </div>
                    <div class="actions">

                        <a href="#" onclick="OpenAddTeacher(); return false;" class="btn green-meadow">
                            <i class="fa fa-plus"></i> เพิ่มอาจารย์</a>


                    </div>
                </div>
                <table id='tblteacher' width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>
                                รหัส
                            </td>
                            <td>
                                ภาพ
                            </td>
                            <td>
                                ชื่ออาจารย์
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
<div class="modal fade" id="mdlTeacher" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">อาจารย์</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่ออาจารย์</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="bioteachername" id="bioteachername" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email อาจารย์</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="bioteacheremail" id="bioteacheremail" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">วันที่สามารถนัดพบได้</label>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <div class="col-md-4"> 
                                            <label class="mt-checkbox">
                                                <input name="day1" value="1" id="day1" type="checkbox"> วันจันทร์ 
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day1s" id="day1s" value=""/>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day1n" id="day1n" value=""/>
                                        </div>
                                    </div> 
                                    <div style=" margin-top: 10px" class="col-md-12">
                                        <div class="col-md-4"> 
                                            <label class="mt-checkbox">
                                                <input name="day2" id="day2" value="2"  type="checkbox"> วันอังคาร 
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day2s" id="day2s" value=""/>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day2n" id="day2n" value=""/>
                                        </div>
                                    </div> 
                                    <div style=" margin-top: 10px" class="col-md-12">
                                        <div class="col-md-4"> 
                                            <label class="mt-checkbox">
                                                <input name="day3" id="day3"  value="3" type="checkbox"> วันพุทธ 
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day3s" id="day3s" value=""/>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day3n" id="day3n" value=""/>
                                        </div>
                                    </div> 
                                    <div style=" margin-top: 10px" class="col-md-12">
                                        <div class="col-md-4"> 
                                            <label class="mt-checkbox">
                                                <input name="day4" id="day4" value="4" type="checkbox"> วันพฤหัสบดี 
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day4s" id="day4s" value=""/>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day4n" id="day4n" value=""/>
                                        </div>
                                    </div> 
                                    <div style=" margin-top: 10px" class="col-md-12">
                                        <div class="col-md-4"> 
                                            <label class="mt-checkbox">
                                                <input name="day5" id="day5" value="5" type="checkbox"> วันศุกร์ 
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day5s" id="day5s" value=""/>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day5n" id="day5n" value=""/>
                                        </div>
                                    </div> 
                                    <div style=" margin-top: 10px" class="col-md-12">
                                        <div class="col-md-4"> 
                                            <label class="mt-checkbox">
                                                <input name="day6" id="day6" value="6" type="checkbox"> วันเสาร์ 
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day6s" id="day6s" value=""/>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day6n" id="day6n" value=""/>
                                        </div>
                                    </div> 
                                    <div style=" margin-top: 10px" class="col-md-12">
                                        <div class="col-md-4"> 
                                            <label class="mt-checkbox">
                                                <input name="day7" id="day7" value="7" type="checkbox"> วันอาทิตย์ 
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day7s" id="day7s" value=""/>
                                        </div>
                                        <div class="col-md-4">  
                                            <input  class="form-control input-sm placeholder-no-fix timepicker timepicker-24" type="text" placeholder="" name="day7n" id="day7n" value=""/>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">จำนวนชั่วโมงที่กำหนดให้จอง</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="bioteacherhourallow" id="bioteacherhourallow" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลในคณะแพทย์</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="bioteacherfordoctordepartment" id="bioteacherfordoctordepartment" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลในมหาวิทยาลัย</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="bioteacherforuniversity" id="bioteacherforuniversity" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลภายนอกภาครัฐ</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="bioteacherforoutsideuniversitygov" id="bioteacherforoutsideuniversitygov" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลภายนอกภาคเอกชน</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="bioteacherforoutsideuniversityprivate" id="bioteacherforoutsideuniversityprivate" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">สถานที่</label>
                                <div class="col-md-9">
                                    <select name="bioteacherplaceid"  id="bioteacherplaceid" class="form-control">
                                        <?php foreach($places as $place): ?>
                                        <option value='<?php echo e($place -> bioplaceid); ?>'> <?php echo e($place -> bioplacename); ?>

                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">สถานะ</label>
                                <div class="col-md-9">
                                    <select name="bioteacherstatus"  id="bioteacherstatus" class="form-control">
                                        <option value='1'>เปิด</option>
                                        <option value='0'>ปิด</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">รูปภาพอาจารย์</label>
                                <div class="col-md-9">
                                    <input id="bioteacherpicturename" type="file" name="bioteacherpicturename" data-show-upload="false" class="file pull-left" data-allowed-file-extensions='["jpeg","jpg","png"]' data-show-preview="false">
                                </div>
                            </div>
                            <div id="divimgteacher" class="form-group">
                                <div class="col-md-12">
                                    <img width='200px' id="imgteacher" src="" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>
                <a class='btn btn-primary btn-sm' href='#' onclick='SaveTeacher(); return false;'><span class='glyphicon glyphicon-ok'></span> บันทึก</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlTeacherCfmDel" tabindex="-1" role="basic" aria-hidden="true">
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
<div class="modal fade" id="mdlBookTeacher" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">ปฏิทินการนัดพบ</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <div id='calendar'></div>
                    <div class=" clearfix"></div>
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<input type="hidden" name="hidsaveoredit" id="hidsaveoredit" value="">
<input type="hidden" name="hidteacherid" id="hidteacherid" value="">
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
<script src="public/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/jquery-number-master/jquery.number.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/fullcalendar/lib/moment.min.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>
<script src="public/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js" type="text/javascript"></script>
<script>
                    var sudoNotify = $('.notification-container').sudoNotify({
                        log: true,
                        position: "top",
                        animation: {
                            type: "slide-fade", //fade, scroll-left, scroll-left-fade, scroll-right, scroll-right-fade, slide, slide-fade or none
                            showSpeed: 400,
                            hideSpeed: 250
                        }
                    });
                    $(document).ready(function () {
                        resetfield();
                        $('#tblteacher').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '/getTeacher',
                            "order": [[0, "desc"]],
                            "lengthChange": false,
                            "info": false,
                            "pagingType": "full_numbers",
                            columns: [
                                {data: 'bioteacherid', name: 'bioteacherid'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return "<img width='200px' alt='' src='public/uploads/teacherimg/" + full.bioteacherpicturename + "' class='img-thumbnail' />";
                                    }
                                },
                                {data: 'bioteachername', name: 'bioteachername'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol)
                                    {
                                        $(nTd).css('text-align', 'center');
                                    },
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        if (full.bioteacherstatus === '1') {
                                            return '<span class="label label-sm label-success"> เปิดใช้งาน </span>';
                                        } else {
                                            return '<span class="label label-sm label-warning"> ปิดใช้งาน </span>';
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
                                        return " <a class='btn btn-success btn-sm' href='#' onclick='return OpenBookingTeacher(\"" + full.bioteacherid + "\")'><span class='glyphicon glyphicon-calendar'></span> การจองทั้งหมด</a>"
                                                + "&nbsp; <a class='btn btn-primary btn-sm' href='#' onclick='return setAccess(\"" + full.bioteacherid + "\",\"" + full.bioteachername + "\")'><span class='glyphicon glyphicon-home'></span> ตั้งเครื่องนี้สำหรับเข้าใช้งาน</a>"
                                                + "&nbsp; <a class='btn btn-primary btn-sm' href='#' onclick='return OpenEditTeacher(\"" + full.bioteacherid + "\")'><span class='glyphicon glyphicon-file'></span> แก้ไข</a>"
                                                + "&nbsp; <a class='btn btn-danger btn-sm' href='#' onclick='return OpenDelete(\"" + full.bioteacherid + "\")'><span class='glyphicon glyphicon-trash'></span> ลบ</a>";
                                    }
                                }
                            ]
                        });


                    });
                    function setAccess(teacherid, teachername) {
                        var formData = new FormData();
                        formData.append('teacherid', teacherid);
                        $.ajax({
                            url: '/setAccessBio',
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
                                if (data.message === 'cookieset') {
                                    sudoNotify.success("บันทึกคอมพิวเตอร์เครื่องสำหรับใช้เข้าพบอาจารย์ " + teachername);
                                }
                            }
                        });
                    }
                    function resetfield() {
                        $("#bioteachername").val('');
                        $("#bioteacheremail").val('');
                        $("#bioteacherhourallow").val('');
                        $("#bioteacherfordoctordepartment").val('');
                        $("#bioteacherforuniversity").val('');
                        $("#bioteacherforoutsideuniversitygov").val('');
                        $("#bioteacherforoutsideuniversityprivate").val('');
                        $('#bioteacherplaceid option:first-child').attr("selected", "selected");
                        $('#bioteacherstatus option:first-child').attr("selected", "selected");
                        $('#bioteacherpicturename').fileinput('clear');
                        //$('input:checkbox').removeAttr('checked');
                        $('.timepicker').prop("disabled", true);
                        $('#day1').change(function () {
                            $("#day1s").prop("disabled", !$(this).is(':checked'));
                            $("#day1n").prop("disabled", !$(this).is(':checked'));
                        });
                        $('#day2').change(function () {
                            $("#day2s").prop("disabled", !$(this).is(':checked'));
                            $("#day2n").prop("disabled", !$(this).is(':checked'));
                        });
                        $('#day3').change(function () {
                            $("#day3s").prop("disabled", !$(this).is(':checked'));
                            $("#day3n").prop("disabled", !$(this).is(':checked'));
                        });
                        $('#day4').change(function () {
                            $("#day4s").prop("disabled", !$(this).is(':checked'));
                            $("#day4n").prop("disabled", !$(this).is(':checked'));
                        });
                        $('#day5').change(function () {
                            $("#day5s").prop("disabled", !$(this).is(':checked'));
                            $("#day5n").prop("disabled", !$(this).is(':checked'));
                        });
                        $('#day6').change(function () {
                            $("#day6s").prop("disabled", !$(this).is(':checked'));
                            $("#day6n").prop("disabled", !$(this).is(':checked'));
                        });
                        $('#day7').change(function () {
                            $("#day7s").prop("disabled", !$(this).is(':checked'));
                            $("#day7n").prop("disabled", !$(this).is(':checked'));
                        });
                        $('.timepicker').val('');
                        for (var i = 1; i < 8; i++) {
                            $('span', $('#uniform-day' + i)).removeClass("checked");
                            $('#day' + i).removeClass("checked");
                            $('#day' + i).prop('checked', false);
                        }
                    }
                    function OpenAddTeacher() {
                        resetfield();
                        $('#divimgteacher').hide();
                        $('#mdlTeacher').modal('toggle');
                        $("#hidsaveoredit").val('SaveTeacher');
                        $('.timepicker').val('');
                    }
                    function OpenEditTeacher(teacherid) {
                        //hidequipmentid();
                        resetfield();
                        $("#hidsaveoredit").val('EditTeacher');
                        $.ajax({
                            url: '/getTeacherByID/' + teacherid,
                            method: 'get',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            error: function (data) {
                                console.log(data.responseText);
                            },
                            success: function (data) {
                                $("#hidteacherid").val(data['teacher'][0].bioteacherid);
                                $("#bioteachername").val(data['teacher'][0].bioteachername);
                                $("#bioteacheremail").val(data['teacher'][0].bioteacheremail);
                                $("#bioteacherhourallow").val(data['teacher'][0].bioteacherhourallow);
                                $("#bioteacherfordoctordepartment").val(data['teacher'][0].bioteacherfordoctordepartment);
                                $("#bioteacherforuniversity").val(data['teacher'][0].bioteacherforuniversity);
                                $("#bioteacherforoutsideuniversitygov").val(data['teacher'][0].bioteacherforoutsideuniversitygov);
                                $("#bioteacherforoutsideuniversityprivate").val(data['teacher'][0].bioteacherforoutsideuniversityprivate);
                                $("#bioteacherplaceid").val(data['teacher'][0].bioteacherplaceid);
                                $("#bioteacherstatus").val(data['teacher'][0].bioteacherstatus);
                                $('#bioteacherpicturename').fileinput('clear');
                                $('#divimgteacher').show();
                                $('#imgteacher').attr('src', 'public/uploads/teacherimg/' + data['teacher'][0].bioteacherpicturename);

                                for (var i = 0; i < data['tavi'].length; i++) {
                                    $('span', $('#uniform-day' + data['tavi'][i].bioavailableday)).addClass("checked");
                                    //.prop('checked', true);
                                    $('#day' + data['tavi'][i].bioavailableday).prop('checked', true);
                                    $('#day' + data['tavi'][i].bioavailableday).addClass("checked");
                                    $("#day" + data['tavi'][i].bioavailableday + "s").timepicker('setTime', (data['tavi'][0].bioavailablestarttime).slice(0, -3));
                                    $("#day" + data['tavi'][i].bioavailableday + "n").timepicker('setTime', (data['tavi'][0].bioavailableendtime).slice(0, -3));
                                    $("#day" + data['tavi'][i].bioavailableday + "s").removeAttr("disabled");
                                    $("#day" + data['tavi'][i].bioavailableday + "n").removeAttr("disabled");
                                }

                                $('#mdlTeacher').modal('toggle');
                            }
                        });
                    }
                    function OpenDelete(teacherid) {
                        $('#mdlTeacherCfmDel').modal('toggle');
                        $("#hidteacherid").val(teacherid);
                    }
                    function DeleteByID() {
                        $.ajax({
                            url: '/deleteTeacherByID/' + $("#hidteacherid").val(),
                            method: 'get',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            error: function (data) {
                                console.log(data.responseText);
                            },
                            success: function (data) {
                                if (data.message === 'saved') {
                                    $('#tblteacher').DataTable().ajax.reload();
                                    $('#mdlTeacherCfmDel').modal('toggle');
                                    sudoNotify.success("ลบกลุ่มเครื่องมือเรียบร้อย");
                                }
                            }
                        });
                    }

                    function SaveTeacher() {
                        if ($.trim($("#bioteachername").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกชื่ออาจารย์");
                            return false;
                        }
                        if ($.trim($("#bioteacheremail").val()).length === 0) {
                            sudoNotify.error("กรุณากรอก Email อาจารย์");
                            return false;
                        }
                        if ($.trim($("#bioteacherhourallow").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกจำนวนชั่วโมงที่กำหนดให้จอง");
                            return false;
                        }
                        if ($('#day1').is(':checked')) {
                            if ($('#day1s').val() === "" || $('#day1n').val() === "") {
                                sudoNotify.error("กรุณากรอกเวลาเริ่มต้นและสิ้นสุดของวันจันทร์");
                                return false;
                            }
                        }
                        if ($('#day2').is(':checked')) {
                            if ($('#day2s').val() === "" || $('#day2n').val() === "") {
                                sudoNotify.error("กรุณากรอกเวลาเริ่มต้นและสิ้นสุดของวันอังคาร");
                                return false;
                            }
                        }
                        if ($('#day3').is(':checked')) {
                            if ($('#day3s').val() === "" || $('#day3n').val() === "") {
                                sudoNotify.error("กรุณากรอกเวลาเริ่มต้นและสิ้นสุดของวันพุทธ");
                                return false;
                            }
                        }
                        if ($('#day4').is(':checked')) {
                            if ($('#day4s').val() === "" || $('#day4n').val() === "") {
                                sudoNotify.error("กรุณากรอกเวลาเริ่มต้นและสิ้นสุดของวันวันพฤหัสบดี");
                                return false;
                            }
                        }
                        if ($('#day5').is(':checked')) {
                            if ($('#day5s').val() === "" || $('#day5n').val() === "") {
                                sudoNotify.error("กรุณากรอกเวลาเริ่มต้นและสิ้นสุดของวันศุกร์");
                                return false;
                            }
                        }
                        if ($('#day6').is(':checked')) {
                            if ($('#day6s').val() === "" || $('#day6n').val() === "") {
                                sudoNotify.error("กรุณากรอกเวลาเริ่มต้นและสิ้นสุดของวันเสาร์");
                                return false;
                            }
                        }
                        if ($('#day7').is(':checked')) {
                            if ($('#day7s').val() === "" || $('#day7n').val() === "") {
                                sudoNotify.error("กรุณากรอกเวลาเริ่มต้นและสิ้นสุดของวันอาทิตย์");
                                return false;
                            }
                        }
                        if ($.trim($("#bioteacherfordoctordepartment").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลในคณะแพทย์");
                            return false;
                        }
                        if ($.trim($("#bioteacherforuniversity").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลในมหาวิทยาลัย");
                            return false;
                        }
                        if ($.trim($("#bioteacherforoutsideuniversitygov").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลภายนอกภาครัฐ");
                            return false;
                        }
                        if ($.trim($("#bioteacherforoutsideuniversityprivate").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลภายนอกภาคเอกชน");
                            return false;
                        }
                        if ($("#hidsaveoredit").val() === 'SaveTeacher') {
                            if ($('#bioteacherpicturename').val() === "") {
                                sudoNotify.error("กรุณาเลือกไฟล์รูปภาพอาจารย์");
                                return false;
                            }
                        }

                        var formData = new FormData();
                        $('input[type="text"], input[type="checkbox"], textarea, input[type="password"], input[type="hidden"], select').each(function (i) {
                            formData.append($(this).attr('id'), $(this).val());
                        });
                        formData.append('file', $('#bioteacherpicturename').prop('files')[0]);

                        var myCheckboxes = new Array();
                        $("input:checked").each(function () {
                            myCheckboxes.push($(this).val());
                        });
                        formData.append('chkb', myCheckboxes);

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
                                    $('#tblteacher').DataTable().ajax.reload();
                                    $('#mdlTeacher').modal('toggle');
                                    if ($("#hidsaveoredit").val() === 'EditTeacher') {
                                        sudoNotify.success("แก้ไขกลุ่มเครื่องมือเรียบร้อย");
                                    } else {
                                        sudoNotify.success("เพิ่มกลุ่มเครื่องมือเรียบร้อย");
                                    }
                                }
                            }
                        });
                    }

                    $('#mdlBookTeacher').on('shown.bs.modal', function () {
                        $("#calendar").fullCalendar('render');
                    });

                    function OpenBookingTeacher(teacherid) {
                        $('#calendar').fullCalendar('destroy');
                        $("#hidteacherid").val(teacherid);
                        $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,basicWeek,basicDay'
                            },
                            defaultDate: '<?php echo e(Date("Y-m-d")); ?>',
                            selectable: false,
                            selectHelper: true,
                            timeFormat: 'H(:mm)',
                            displayEventTime: false,
                            events: {
                                url: '/getBookingbyTeacheridWithUsername/' + teacherid,
                                error: function () {

                                }
                            },
                            eventRender: function (event, element) {
                                $(element).tooltip({title: event.title});
                            }
                        });
                        $('#mdlBookTeacher').modal('toggle');
                    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
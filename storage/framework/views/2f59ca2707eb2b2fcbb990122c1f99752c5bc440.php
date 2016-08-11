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
                <span>อุปกรณ์</span>
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
                        <span class="caption-subject font-dark bold uppercase">ตารางอุปกรณ์ทั้งหมด</span>
                    </div>
                    <div class="actions">

                        <a href="#" onclick="OpenAddEquipment(); return false;" class="btn green-meadow">
                            <i class="fa fa-plus"></i> เพิ่มอุปกรณ์</a>


                    </div>
                </div>
                <table id='tblReviewform' width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>
                                รหัส
                            </td>
                            <td>
                                ภาพ
                            </td>
                            <td>
                                ชื่ออุปกรณ์
                            </td>
                            <td>
                                ประเภท
                            </td>
                            <td>
                                สถานที่
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
<div class="modal fade" id="mdlEquipment" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">กลุ่มเครื่องมือ</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่ออุปกรณ์</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="equipmentname" id="equipmentname" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่ออุปกรณ์ภาษาอังกฤษ</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="equipmentenname" id="equipmentenname" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">รายละเอียด</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="equipmentdetail" id="equipmentdetail"  rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">รายละเอียดภาษาอังกฤษ</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="equipmentendetail" id="equipmentendetail"  rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">จำนวนชั่วโมงที่กำหนดให้จอง</label>
                                <div class="col-md-9">
                                    <input  class="form-control placeholder-no-fix" type="text" placeholder="" name="equipmenthourallow" id="equipmenthourallow" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลในคณะแพทย์</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="equipmentpricefordoctordepartment" id="equipmentpricefordoctordepartment" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลในมหาวิทยาลัย</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="equipmentpriceforuniversity" id="equipmentpriceforuniversity" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลภายนอกภาครัฐ</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="equipmentforoutsideuniversitygov" id="equipmentforoutsideuniversitygov" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ราคาสำหรับบุคคลภายนอกภาคเอกชน</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control placeholder-no-fix number" type="text" placeholder="" name="equipmentforoutsideuniversityprivate" id="equipmentforoutsideuniversityprivate" value="" />
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">สถานที่</label>
                                <div class="col-md-9">
                                    <select name="equipmentplace"  id="equipmentplace" class="form-control">
                                        <?php foreach($places as $place): ?>
                                        <option value='<?php echo e($place -> placeid); ?>'> <?php echo e($place -> placename); ?>

                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">หลักสูตรการอบรม</label>
                                <div class="col-md-9">
                                    <select name="equipmentcouse"  id="equipmentcouse" class="form-control">
                                        <?php foreach($couses as $couse): ?>
                                        <option value='<?php echo e($couse -> couseid); ?>'> <?php echo e($couse -> cousename); ?>

                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">กลุ่มเครื่องมือ</label>
                                <div class="col-md-9">
                                    <select name="equipmentgroup"  id="equipmentgroup" class="form-control">
                                        <?php foreach($groups as $group): ?>
                                        <option value='<?php echo e($group -> groupid); ?>'> <?php echo e($group -> groupname); ?>

                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">สถานะ</label>
                                <div class="col-md-9">
                                    <select name="equipmentstatus"  id="equipmentstatus" class="form-control">
                                        <option value='1'>เปิด</option>
                                        <option value='0'>ปิด</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">รูปภาพอุปกรณ์</label>
                                <div class="col-md-9">
                                    <input id="equipmentpicturename" type="file" name="equipmentpicturename" data-show-upload="false" class="file pull-left" data-allowed-file-extensions='["jpeg","jpg","png"]' data-show-preview="false">
                                </div>
                            </div>
                            <div id="divimgequipment" class="form-group">
                                <div class="col-md-12">
                                    <img width='200px' id="imgequipment" src="" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a class='btn dark btn-outline btn-sm' data-dismiss="modal" href='#'><span class='glyphicon glyphicon-remove'></span> ยกเลิก</a>
                <a class='btn btn-primary btn-sm' href='#' onclick='SaveEquipment(); return false;'><span class='glyphicon glyphicon-ok'></span> บันทึก</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlEquipmentCfmDel" tabindex="-1" role="basic" aria-hidden="true">
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
<input type="hidden" name="hidfid" id="hidequipmentid" value="">
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
                        // $('input.number').number(true, 2);
                        $('#tblReviewform').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '/getequipmentfortbl',
                            "lengthChange": false,
                            "info": false,
                            "pagingType": "full_numbers",
                            columns: [
                                {data: 'equipmentid', name: 'equipmentid'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        return "<img width='200px' alt='' src='public/uploads/equipmentimg/" + full.equipmentpicturename + "' class='img-thumbnail' />";
                                    }
                                },
                                {data: 'equipmentname', name: 'equipmentname'},
                                {data: 'groupname', name: 'groupname'},
                                {data: 'placename', name: 'placename'},
                                {"bVisible": true, "bSearchable": false, "bSortable": false,
                                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol)
                                    {
                                        $(nTd).css('text-align', 'center');
                                    },
                                    "mData": null,
                                    "mRender": function (data, type, full) {
                                        if (full.equipmentstatus === 1) {
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
                                        return " <a class='btn btn-primary btn-sm' href='#' onclick='return OpenEditEquipment(\"" + full.equipmentid + "\")'><span class='glyphicon glyphicon-file'></span> แก้ไข</a>"
                                                + "&nbsp; <a class='btn btn-danger btn-sm' href='#' onclick='return OpenDelete(\"" + full.equipmentid + "\")'><span class='glyphicon glyphicon-trash'></span> ลบ</a>";
                                    }
                                }
                            ]
                        });
                      //  $('input.number').number(true, 2);
                    });
                    function resetfield() {
                        $("#equipmentname").val('');
                        $("#equipmentenname").val('');
                        $("#equipmentdetail").val('');
                        $("#equipmentendetail").val('');
                        $("#equipmenthourallow").val('');
                        $("#equipmentpricefordoctordepartment").val('');
                        $("#equipmentpriceforuniversity").val('');
                        $("#equipmentforoutsideuniversitygov").val('');
                        $("#equipmentforoutsideuniversityprivate").val('');
                        $('#equipmentplace option:first-child').attr("selected", "selected");
                        $('#equipmentgroup option:first-child').attr("selected", "selected");
                        $('#equipmentcouse option:first-child').attr("selected", "selected");
                        $('#equipmentpicturename').fileinput('clear');
                    }
                    function OpenAddEquipment() {
                        resetfield();
                        $('#divimgequipment').hide();
                        $('#mdlEquipment').modal('toggle');
                        $("#hidsaveoredit").val('SaveEquipment');
                    }
                    function OpenEditEquipment(equipmentid) {
                        //hidequipmentid();
                        $("#hidsaveoredit").val('EditEquipment');
                        $.ajax({
                            url: '/getEquipmentByID/' + equipmentid,
                            method: 'get',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            error: function (data) {
                                console.log(data.responseText);
                            },
                            success: function (data) {
                                $("#hidequipmentid").val(data['MRCEquipment'][0].equipmentid);
                                $("#equipmentname").val(data['MRCEquipment'][0].equipmentname);
                                $("#equipmentenname").val(data['MRCEquipment'][0].equipmentenname);
                                $("#equipmentdetail").val(data['MRCEquipment'][0].equipmentdetail);
                                $("#equipmentendetail").val(data['MRCEquipment'][0].equipmentendetail);
                                $("#equipmenthourallow").val(data['MRCEquipment'][0].equipmenthourallow);
                                $("#equipmentpricefordoctordepartment").val(data['MRCEquipment'][0].equipmentpricefordoctordepartment);
                                $("#equipmentpriceforuniversity").val(data['MRCEquipment'][0].equipmentpriceforuniversity);
                                $("#equipmentforoutsideuniversitygov").val(data['MRCEquipment'][0].equipmentforoutsideuniversitygov);
                                $("#equipmentforoutsideuniversityprivate").val(data['MRCEquipment'][0].equipmentforoutsideuniversityprivate);
                                $('#equipmentplace').val(data['MRCEquipment'][0].equipmentplace);
                                $('#equipmentgroup').val(data['MRCEquipment'][0].equipmentgroup);
                                $('#equipmentcouse').val(data['MRCEquipment'][0].equipmentcouse);
                                $('#equipmentstatus').val(data['MRCEquipment'][0].equipmentstatus);
                                $('#fupPDF').fileinput('clear');
                                $('#divimgequipment').show();
                                $('#imgequipment').attr('src', 'public/uploads/equipmentimg/' + data['MRCEquipment'][0].equipmentpicturename);
                                $('#mdlEquipment').modal('toggle');
                            }
                        });
                    }
                    function OpenDelete(equipmentid) {
                        $('#mdlEquipmentCfmDel').modal('toggle');
                        $("#hidequipmentid").val(equipmentid);
                    }
                    function DeleteByID() {
                        $.ajax({
                            url: '/deleteEquipmentByID/' + $("#hidequipmentid").val(),
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
                                    $('#mdlEquipmentCfmDel').modal('toggle');
                                    sudoNotify.success("ลบกลุ่มเครื่องมือเรียบร้อย");
                                }
                            }
                        });
                    }
                    function SaveEquipment() {
                        if ($.trim($("#equipmentname").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกชื่ออุปกรณ์");
                            return false;
                        }
                        if ($.trim($("#equipmentenname").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกชื่ออุปกรณ์ภาษาอังกฤษ");
                            return false;
                        }
                        if ($.trim($("#equipmentdetail").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกรายละเอียด");
                            return false;
                        }
                        if ($.trim($("#equipmentendetail").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกรายละเอียดภาษาอังกฤษ");
                            return false;
                        }
                        if ($.trim($("#equipmenthourallow").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกจำนวนชั่วโมงที่กำหนดให้จอง");
                            return false;
                        }
                        if ($.trim($("#equipmentpricefordoctordepartment").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลในคณะแพทย์");
                            return false;
                        }
                        if ($.trim($("#equipmentpriceforuniversity").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลในมหาวิทยาลัย");
                            return false;
                        }
                        if ($.trim($("#equipmentforoutsideuniversitygov").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลภายนอกภาครัฐ");
                            return false;
                        }
                        if ($.trim($("#equipmentforoutsideuniversityprivate").val()).length === 0) {
                            sudoNotify.error("กรุณากรอกราคาสำหรับบุคคลภายนอกภาคเอกชน");
                            return false;
                        }
                        if ($("#hidsaveoredit").val() === 'SaveEquipment') {
                            if ($('#equipmentpicturename').val() === "") {
                                sudoNotify.error("กรุณาเลือกไฟล์รูปภาพอุปกรณ์");
                                return false;
                            }
                        }

                        var formData = new FormData();
                        $('input[type="text"], input[type="checkbox"], textarea, input[type="password"], input[type="hidden"], select').each(function (i) {
                            formData.append($(this).attr('id'), $(this).val());
                        });
                        formData.append('file', $('#equipmentpicturename').prop('files')[0]);
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
                                    $('#mdlEquipment').modal('toggle');
                                    if ($("#hidsaveoredit").val() === 'EditEquipment') {
                                        sudoNotify.success("แก้ไขกลุ่มเครื่องมือเรียบร้อย");
                                    } else {
                                        sudoNotify.success("เพิ่มกลุ่มเครื่องมือเรียบร้อย");
                                    }
                                }
                            }
                        });
                    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
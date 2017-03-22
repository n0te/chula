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
<link href="public/assets/global/plugins/timepicker/css/timepicki.css" rel="stylesheet" type="text/css"/>
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
    .borderless td, .borderless th {
        border: 0px;
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
                <span>รายงานการเข้าใช้งานห้องแล็ปทั้งหมด</span>
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
                        <span class="caption-subject font-dark bold uppercase">แผนภูมิแท่งแสดงการเข้าใช้งานห้องแล็ปทั้งหมด</span>
                    </div>

                    <div class="actions">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless borderless">
                            <tr>
                                <td style=" border:0px;">
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input class="form-control form-control-inline" type="text" value="" id="txtStartDate" name="txtStartDate">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td style=" border:0px;">
                                    ถึง
                                </td>
                                <td style=" border:0px;">
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input class="form-control form-control-inline" type="text" value="" id="txtEndDate" name="txtEndDate">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td style=" border:0px;">
                                    <a onclick="getChart(); return false;" class="btn btn-circle btn-primary">
                                        <i class="fa fa-search"></i> ค้นหา
                                    </a>
                                </td>
                                <td style=" border:0px;">
                                    <a id="btntoexcel" onclick="aniexporttoexcel(); return false;" traget="_blank" class="btn btn-outline btn-circle green btn-sm green">
                                        <i class="fa fa-file-excel-o"></i> Export to excel</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="columnchart_values"></div>





            </div>
        </div>

    </div>
</div>


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
<script src="public/assets/global/plugins/timepicker/js/timepicki.js" type="text/javascript"></script>
<!--Load the AJAX API-->

<script src="public/assets/global/plugins/gchart/loader.js" type="text/javascript"></script>
<script type="text/javascript">
                                        google.charts.load("current", {packages: ['corechart']});
                                        function getChart() {
                                            if ($.trim($("#txtStartDate").val()).length === 0) {
                                                sudoNotify.error("กรุณาเลือกวันเริ่มต้น");
                                                return false;
                                            }
                                            if ($.trim($("#txtEndDate").val()).length === 0) {
                                                sudoNotify.error("กรุณาเลือกวันสิ้นสุด");
                                                return false;
                                            }
                                            google.charts.setOnLoadCallback(drawChart);
                                            $('#btntoexcel').show();
                                        }

                                        function drawChart() {


                                            var formData = new FormData();
                                            formData.append('sd', $("#txtStartDate").val());
                                            formData.append('ed', $("#txtEndDate").val());
                                            $.ajax({
                                                url: '/getchartani',
                                                method: 'post',
                                                dataType: 'json',
                                                contentType: false,
                                                processData: false,
                                                data: formData,
                                                error: function (data) {
                                                    console.log(data.responseText);
                                                    alert(data.responseText);
                                                },
                                                success: function (result) {
                                                    var Combined = new Array();
                                                    Combined[0] = ['eqm', 'time', {role: "style"}];
                                                    for (var i = 0; i < result.length; i++) {
                                                        Combined[i + 1] =
                                                                [result[i].aniroomname,
                                                                    parseInt(result[i].ce),
                                                                    ''];
                                                    }
//second parameter is false because first row is headers, not data.
                                                    var table = google.visualization.arrayToDataTable(Combined, false);
                                                    //var datag = google.visualization.arrayToDataTable([["eqm", "time", {role: "style"}], jsonArr]);
                                                    var view = new google.visualization.DataView(table);
                                                    view.setColumns([0, 1,
                                                        {calc: "stringify",
                                                            sourceColumn: 1,
                                                            type: "string",
                                                            role: "annotation"},
                                                        2]);
                                                    var options = {
                                                        title: "จำนวนการเข้าใช้งานห้องแล็ป",
                                                        legend: {position: "none"},
                                                        height: 600,
                                                        hAxis: {
                                                            title: 'ห้อง'
                                                        },
                                                        vAxis: {
                                                            title: 'จำนวนครั้ง'
                                                        }
                                                    };
                                                    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                                                    chart.draw(view, options);
                                                }
                                            });
                                        }
</script>
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
        $('#btntoexcel').hide();
        $('#txtStartDate').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('#txtEndDate').datepicker({
            format: 'dd-mm-yyyy'
        });
    });
    function aniexporttoexcel() {
//        alert('5555');
//        var formData = new FormData();
//        formData.append('sd', $("#txtStartDate").val());
//        formData.append('ed', $("#txtEndDate").val());
        window.open('/aniexporttoexcel/' + $("#txtStartDate").val() + '/' + $("#txtEndDate").val());

    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
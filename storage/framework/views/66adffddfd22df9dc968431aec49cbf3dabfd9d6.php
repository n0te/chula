<?php $__env->startSection('head'); ?>
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL PLUGINS -->
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
                                <span>Review Members</span>
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
                            <div class="memberslist-content">
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
        		<form action="/getreviewmembers">
                 <button style="margin-bottom: 20px;float:right;" class="btn green refreshmemberlist" type="submit"><i class="fa fa-refresh"></i></button>
                </form>
                <div id="modules-table" class="table">
                                        <table id="memberlist-table" class="table table-hover">
                                            <thead>
                                                <tr>
                                                	<th>ระบบที่ใช้งาน</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>E-mail</th>
                                                    <th>สถานะปัจจุบัน</th>
                                                    <th>จัดการ</th>
                                                </tr>   
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="public/assets/pages/scripts/reviewmembers.js" type="text/javascript"></script>
        <script src="public/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Research Affairs Faculty of Medicine, Chulalongkorn University</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        @yield('head')
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
    <div style="z-index: 99999;" class="notification-container"></div>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white page-sidebar-menu">

        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">

            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="/">
                        <img src="/assets/global/img/logo.png" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="username username-hide-on-mobile"> {{$user->firstname}} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="/profile">
                                        <i class="icon-user"></i> My Profile </a>
                                </li>
                                <li>
                                    <a href="/profile#module">
                                        <i class="icon-calendar"></i> My Modules </a>
                                </li>
                                <li>
                                    <a href="/profile#password">
                                        <i class="fa fa-key"></i> Change Password
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="/logout">
                                        Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>

                </div>
                <!-- END TOP NAVIGATION MENU -->

            </div>

            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-closed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <!--   <li class="sidebar-search-wrapper"> -->
                        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                        <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                        <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                        <!--  <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                             <a href="javascript:;" class="remove">
                                 <i class="icon-close"></i>
                             </a>
                             <div class="input-group">
                                 <input type="text" class="form-control" placeholder="Search...">
                                 <span class="input-group-btn">
                                     <a href="javascript:;" class="btn submit">
                                         <i class="icon-magnifier"></i>
                                     </a>
                                 </span>
                             </div>
                         </form> -->
                        <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        <!--  </li> -->
                        <li class="nav-item start ">
                            <a href="/" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Home</span>
                            </a>
                        </li>

                        <li class="heading">
                            <h3 class="uppercase">SERVICES</h3>
                        </li>
                        <li class="nav-item active open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-diamond"></i>
                                <span class="title">Clinical Research Funds</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu"> 
                                <li class="nav-item  ">
                                    <a href="/allformrequest" class="nav-link ">
                                        <span class="title">ตารางสรุปการจัดทำประกาศแหล่งทุนภายนอก</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="/requestform" class="nav-link ">
                                        <span class="title">สร้างคำขอจัดทำประกาศแหล่งทุนภายนอก</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <span class="title">ตัวอย่างการกรอกคำขอ</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="/contactus" class="nav-link ">
                                        <span class="title">ติดต่อ Admin Clinical Research Funds</span>
                                    </a>
                                </li>

                            </ul>

                        </li>
                        <li class="nav-item">
                            <a href="http://rs.md.chula.ac.th" target="_blank" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">กลับสู่หน้า ฝ่ายวิจัย</span>
                            </a>
                        </li>
                        <!--    <li class="nav-item  ">
                               <a href="javascript:;" class="nav-link nav-toggle">
                                   <i class="icon-bulb"></i>
                                   <span class="title">MRC</span>
                                   <span class="arrow"></span>
                               </a>
                               <ul class="sub-menu">
                                   <li class="nav-item  ">
                                       <a href="javascript:;" class="nav-link ">
                                           <span class="title">Sub-Item</span>
                                       </a>
                                   </li>
                               </ul>
                           </li>
                           <li class="nav-item  ">
                               <a href="javascript:;" class="nav-link nav-toggle">
                                   <i class="icon-briefcase"></i>
                                   <span class="title">Biostatistics</span>
                                   <span class="arrow"></span>
                               </a>
                               <ul class="sub-menu">
                                   <li class="nav-item  ">
                                       <a href="javascript:;" class="nav-link nav-toggle">
                                           <span class="title">Sub-Item</span>
                                       </a>
                                   </li>
                               </ul>
                           </li>
                           <li class="nav-item  ">
                               <a href="?p=" class="nav-link nav-toggle">
                                   <i class="icon-wallet"></i>
                                   <span class="title">Animal Houses</span>
                                   <span class="arrow"></span>
                               </a>
                               <ul class="sub-menu">
                                   <li class="nav-item  ">
                                       <a href="javascript:;" class="nav-link ">
                                           <span class="title">Sub-Item</span>
                                       </a>
                                   </li>
                               </ul>
                           </li> -->
                        @if(Utility::isAdminOfAnyModule(Auth::user()->id))
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">ผู้ดูแลระบบ</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="/reviewmembers" class="nav-link ">
                                        <span class="title">จัดการผู้ใช้</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="/reviewform" class="nav-link ">
                                        <span class="title">จัดการแบบฟอร์ม</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                @yield('content')
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2016 © Research Affairs Faculty of Medicine, Chulalongkorn University
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        @yield('footer')
        <!-- BEGIN GLOBAL MESSAGES SCRIPTS -->
        <script src="/assets/global/scripts/globalConfig.js" type="text/javascript"></script>
        <!-- END GLOBAL MESSAGES SCRIPTS -->
        <script>
//for post verification
$.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
        </script>
    </body>
</html>
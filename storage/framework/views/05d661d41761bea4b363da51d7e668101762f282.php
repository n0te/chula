<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Research Application System</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/public/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="/public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/public/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <?php echo $__env->yieldContent('header'); ?>
        <link rel="shortcut icon" href="favicon.ico" /> 
    </head>
    <body class="login">
    <?php echo $__env->yieldContent('content'); ?>
    <div class="copyright"> 2016 © Research Affairs Faculty of Medicine, Chulalongkorn University </div>
    <!-- BEGIN CORE PLUGINS -->
        <script src="/public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/public/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="/public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/public/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN GLOBAL MESSAGES SCRIPTS -->
        <script src="/public/assets/global/scripts/globalConfig.js" type="text/javascript"></script>
        <!-- END GLOBAL MESSAGES SCRIPTS -->
        <script>
        //for post verification
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN' : '<?php echo e(csrf_token()); ?>' } });    
        </script>
    <?php echo $__env->yieldContent('footer'); ?>
    </body>
</html>
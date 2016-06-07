@extends('layouts.app-login')

@section('header')
<!-- BEGIN PAGE LEVEL STYLES -->
        <link href="/assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
@endsection

@section('content')
<!-- BEGIN LOGO -->
        <div class="logo">
            <a href="/index.html">
                <img src="/assets/layouts/layout/img/logo-big.png" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <div class="content">
            <!-- BEGIN RESET FORM -->
            <form class="reset-form" action="{{ url('/password/reset') }}" method="post">
                <h3 class="form-title font-green">Reset Password</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                </div>
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="email" name="email" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">New Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" id="confirm_password" autocomplete="off" placeholder="Password" name="password_confirmation" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn red-pink uppercase">Change Password</button>
                </div>
            </form>
            <!-- END RESET FORM -->
        </div>
@endsection

@section('footer')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/assets/pages/scripts/resetpassword.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
@endsection

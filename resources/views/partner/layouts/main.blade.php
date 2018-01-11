<?php
$user = Auth::user();
?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>柒天伞客经销商系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="_token" content="{{csrf_token()}}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />--}}

    {{--<link href="http://fonts.fengqi.me/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />--}}
    <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
@yield('styles')
    <!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/layer/layer.js"></script>
<script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/velocity/velocity.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="/assets/sea.js"></script>
<script src="/assets/sea.config.js"></script>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">

            <a href="#">
                <img src="/assets/layouts/layout4/img/logo-light.png" alt="logo" class="logo-default"/> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
    {{--<div class="page-actions">--}}
    {{--<div class="btn-group">--}}
    {{--<button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">--}}
    {{--<span class="hidden-sm hidden-xs">Actions&nbsp;</span>--}}
    {{--<i class="fa fa-angle-down"></i>--}}
    {{--</button>--}}
    {{--<ul class="dropdown-menu" role="menu">--}}
    {{--<li>--}}
    {{--<a href="javascript:;">--}}
    {{--<i class="icon-docs"></i> New Post </a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="javascript:;">--}}
    {{--<i class="icon-tag"></i> New Comment </a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="javascript:;">--}}
    {{--<i class="icon-share"></i> Share </a>--}}
    {{--</li>--}}
    {{--<li class="divider"> </li>--}}
    {{--<li>--}}
    {{--<a href="javascript:;">--}}
    {{--<i class="icon-flag"></i> Comments--}}
    {{--<span class="badge badge-success">4</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="javascript:;">--}}
    {{--<i class="icon-users"></i> Feedbacks--}}
    {{--<span class="badge badge-danger">2</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"></li>
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-notification dropdown-dark"
                        id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-success message-count" id="message_count">0</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    当前有<span class="bold message-count">0</span> 条消息记录</h3>
                                <a href="{{url('partner/message')}}">查看所有</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283" id="MessageContent">
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <span class="username username-hide-on-mobile"> {{$user->name}} </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            <img alt="" class="img-circle" src="/assets/layouts/layout4/img/avatar9.jpg"/> </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            {{--<li>--}}
                            {{--<a href="#">--}}
                            {{--<i class="icon-user"></i> My Profile </a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">--}}
                            {{--<i class="icon-calendar"></i> My Calendar </a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">--}}
                            {{--<i class="icon-envelope-open"></i> My Inbox--}}
                            {{--<span class="badge badge-danger"> 3 </span>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">--}}
                            {{--<i class="icon-rocket"></i> My Tasks--}}
                            {{--<span class="badge badge-success"> 7 </span>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"> </li>--}}
                            <li>
                                <a href="/admin/user/logout">
                                    <i class="icon-key"></i> 注销 </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                {{--<li class="dropdown dropdown-extended quick-sidebar-toggler">--}}
                {{--<span class="sr-only">Toggle Quick Sidebar</span>--}}
                {{--<i class="icon-logout"></i>--}}
                {{--</li>--}}
                <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
@include('partner.layouts.sidebar')
<!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
    @yield('content')
    <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2017 &copy; By Shineraini & john.</div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<input type="hidden" id="cur_url" value="{{url( Route::getCurrentRoute()->uri() )}}">
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/assets/global/scripts/app.js" type="text/javascript"></script>
<script src="/assets/global/scripts/Shineraini.js" type="text/javascript"></script>

<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
{{--<script src="/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>--}}
{{--<script src="/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>--}}
<!-- END THEME LAYOUT SCRIPTS -->
@yield('scripts')
<script type="text/javascript">
    $(function () {
        seajs.use('partner/message.js', function (app) {
            setInterval(function(){ app.roll($); }, 5000);
        });
    });
</script>
<audio id="audioObj" src="/audio/2478.wav" >提示声音</audio>
</body>

</html>
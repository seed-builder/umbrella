<?php
$user = Auth::user();
$loginUserName = $user->fullname;
?>

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
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item">
                <a href="" class="nav-link nav-toggle">
                    <i class="fa fa-circle-o"></i>
                    <span class="title">共享伞管理</span>
                    <span class="arrow"></span>

                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="/partner/umbrella" class="nav-link"><i class=""></i><span
                                    class="title">共享伞列表</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/partner/customer-hire" class="nav-link"><i class=""></i><span
                                    class="title">租用纪录</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="/partner/price" class="nav-link"><i class="fa fa-circle-o"></i><span class="title"> 押金规则管理</span></a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link nav-toggle">
                    <i class="fa fa-circle-o"></i>
                    <span class="title">网点管理</span>
                    <span class="arrow"></span>

                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="/partner/site" class="nav-link"><i class=""></i><span class="title">网点信息管理</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="" class="nav-link nav-toggle">
                    <i class="fa fa-circle-o"></i>
                    <span class="title">设备管理</span>
                    <span class="arrow"></span>

                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="/partner/equipment" class="nav-link"><i class=""></i><span class="title">设备信息管理</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="/partner/equipment-log" class="nav-link"><i class=""></i><span
                                    class="title">设备日志</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/partner/message" class="nav-link"><i class=""></i><span
                                    class="title">设备消息</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="/partner/comment" class="nav-link"><i class="fa fa-circle-o"></i><span class="title"> 用户反馈管理</span></a>
            </li>

            <li class="nav-item">
                <a href="/partner/view-partner-statistics" class="nav-link"><i class="fa fa-circle-o"></i><span class="title"> 数据统计</span></a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>

<script>
    /**
     *    根据当前url选中菜单
     *    设置导航栏
     **/
    $(function () {
        $(".selected").each(function (i, obj) {
            $(obj).parents("li").each(function (j, li) {
                $(li).addClass('start active open');
                $('.arrow', li).addClass('open');
            });
            $(obj).parents("ul.sub-menu").css('display', "block");

            var t = $(obj).parent().parent().parent().parent().find('.title').get(0);
            var m = $(t).text();
            var n = $(obj).siblings('.title').text();

            var title = '<h1>' + m + '<small>' + n + '</small></h1>'
            $('.page-title').html(title);
            $('#breadcrumb').html(n);
        });
    });
</script>
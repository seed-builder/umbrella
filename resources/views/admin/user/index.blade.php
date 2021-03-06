@extends('admin.layouts.main')
@section('styles')
    @include('admin.layouts.datatable-css')
@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>top module
                <small>系统用户</small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
        <!-- BEGIN PAGE TOOLBAR -->
        @include('admin.layouts.page-toolbar')    <!-- END PAGE TOOLBAR -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb" class="active">users</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-docs font-dark"></i>
                        <span class="caption-subject bold uppercase font-dark">系统用户</span>
                        
                    </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                        
                        
                        
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="moduleTable" class="table table-bordered table-hover display nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            {{--<th>id</th>--}}
                            <th>登陆名</th>
                            <th>昵称</th>
                            {{--<th>Email</th>--}}
                            <th>电话</th>
                            <th>地址</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <!-- END PAGE BASE CONTENT -->
</div>


@endsection
@section('scripts')
    @include('admin.layouts.datatable-js')
    <script type="text/javascript">
        $(function () {
            seajs.use('admin/user.js', function (app) {
                app.index($, 'moduleTable');
            });
        });
    </script>

@endsection
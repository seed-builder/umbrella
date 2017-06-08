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
                <h1>用户权限管理
                    <small>角色管理</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
            @include('admin.layouts.page-toolbar')
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb"  class="active">角色管理</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-xs-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-docs font-dark"></i>
                            <span class="caption-subject bold uppercase font-dark">角色列表</span>
                            {{--<span class="caption-helper">distance stats...</span>--}}
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"> </a>
                            {{--<a href="#portlet-config" data-toggle="modal" class="config"> </a>--}}
                            {{--<a href="" class="reload"> </a>--}}
                            {{--<a href="" class="remove"> </a>--}}
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table id="moduleTable" class="table table-bordered table-hover display nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>英文名称</th>
                                <th>中文名称</th>
                                <th>描述</th>
                                <th>创建时间</th>
                                <th>修改时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
@endsection
@section('scripts')
    @include('admin.layouts.datatable-js')
    <script type="text/javascript">
        $(function () {
            seajs.use('admin/role.js', function (app) {
                app.index($, 'moduleTable');
            });
        });
    </script>

@endsection
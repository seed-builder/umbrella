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
                    <small>批量设置角色</small>
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
                <span class="active">批量设置角色</span>
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
                                <th>类型</th>
                                <th>状态</th>
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
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-docs font-dark"></i>
                            <span class="caption-subject bold uppercase font-dark">角色列表</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form id="form-id" method="post" action="#" >
                            {!! csrf_field() !!}
                            <table id="moduleTable" class="table table-bordered table-hover display nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" onchange="cball(this)" /> </th>
                                    <th>名称</th>
                                    <th>显示名称</th>
                                    <th>描述</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($roles as $role)
                                    <tr onclick="cbsingle(this)">
                                        <td><input class="cb" type="checkbox" name="roles[]" value="{{$role->id}}"/></td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->display_name}}</td>
                                        <td>{{$role->description}}</td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" id="user_ids" name="user_ids" value="">

                            <input class="btn btn-primary form-submit" type="button" value="保存">
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('scripts')
    @include('admin.layouts.datatable-js')
    <script type="text/javascript">
        $(function () {
            seajs.use('admin/batch-user-role.js', function (app) {
                app.index($, 'moduleTable');
            });
        });

        function cball(cb) {
            if(cb.checked){
                $('.cb').each(function(i, el){
                    //alert(el);
                    el.checked = true;
                });
            }else{
                $('.cb').each(function(i, el){
                    //alert(el);
                    el.checked = false;
                });
            }
        }

        function cbsingle(tr) {
            $('input[type=checkbox]', $(tr)).click();
        }
    </script>

@endsection
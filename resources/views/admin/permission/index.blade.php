@extends('admin.layouts.main')
@section('styles')
    @include('admin.layouts.datatable-css')
    <link href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="/assets/global/plugins/bootstrap-treeview/bootstrap-treeview.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/global/plugins/bootstrap-validator/css/bootstrapValidator.min.css" />
@endsection



@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>用户权限管理
                    <small>菜单权限管理</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
            <!-- BEGIN PAGE TOOLBAR -->
            @include('admin.layouts.page-toolbar')
            <!-- END PAGE TOOLBAR -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">菜单权限管理</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-5 col-sm-5">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-docs font-dark"></i>
                            <span class="caption-subject bold uppercase font-dark">菜单权限树</span>
                            {{--<span class="caption-helper">distance stats...</span>--}}
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"> </a>
                            {{--<a href="#portlet-config" data-toggle="modal" class="config"> </a>--}}
                            {{--<a href="" class="reload"> </a>--}}
                            {{--<a href="" class="remove"> </a>--}}
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" id="btnAddChild"><i class="fa fa-file"></i>新增下级菜单功能</a></li>
                                    <li><a href="#" id="btnAddSame"><i class="fa fa-file"></i>新增同级菜单功能</a></li>
                                    {{--<li><a href="#" id="btnEdit"><i class="fa fa-pencil"></i>编辑</a></li>--}}
                                    <li><a href="#" id="btnRemove"><i class="fa fa-remove"></i>删除</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" id="btnOpen"><i class="fa fa-folder-open"></i>展开</a></li>
                                    <li><a href="#" id="btnCollapse"><i class="fa fa-folder"></i>折叠</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="tree" ></div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-sm-7">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase font-dark">菜单权限详情</span>
                            {{--<span class="caption-helper">distance stats...</span>--}}
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"> </a>
                            {{--<a href="#portlet-config" data-toggle="modal" class="config"> </a>--}}
                            {{--<a href="" class="reload"> </a>--}}
                            {{--<a href="" class="remove"> </a>--}}
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal form-row-seperated" id="permissionForm" action="{{route('permission.store')}}">
                            <div class="form-body">
                            {{ csrf_field() }}
                            <input type="hidden" id="id" name="id" />
                            <div class="form-group">
                                <label class="control-label col-md-3">名称</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-data" name="display_name" id="display_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">编号</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-data" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">链接地址</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-data" name="url" id="url" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">图标</label>
                                <div class="col-md-9">
                                    <select class="bs-select form-control" data-show-subtext="true" id="icon" name="icon">
                                        <option value="">--select--</option>
                                        @forelse($icons as $icon)
                                            <option value="{{$icon}}"  data-icon="{{$icon}}">{{$icon}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">上级</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="pid" id="pid">
                                        <option value="">--请选择--</option>
                                        @foreach($perOptions as $p)
                                            <option value="{{$p['value']}}">{{$p['label']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">类型</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="type" id="type">
                                        <option value="m">模块</option>
                                        <option value="f">功能</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">排序</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-data" name="sort" id="sort" value="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">备注</label>
                                <div class="col-md-9">
                                    <textarea  class="form-control form-data" name="description" id="description"></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">保存</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>

@endsection
@section('scripts')
    @include('admin.layouts.datatable-js')
    <script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-treeview/bootstrap-treeview.min.js"></script>
    <script src="/assets/global/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
    <script src="/assets/global/plugins/bootstrap-validator/js/language/zh_CN.js"></script>
    <script src="/assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        //$('.selectpicker').selectpicker();

    </script>
    <script type="text/javascript">
        $(function () {
            seajs.use('admin/permission.js', function (app) {
                app.index($, 'moduleTable', 'tree');
            });
        });
    </script>

@endsection
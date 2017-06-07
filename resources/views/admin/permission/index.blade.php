@extends('admin.layouts.main')
@section('styles')
    @include('admin.layouts.datatable-css')
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
            <div class="page-toolbar">
                <div id="dashboard-report-range" data-display-range="0" class="pull-right tooltips btn btn-fit-height green" data-placement="left" data-original-title="Change dashboard date range">
                    <i class="icon-calendar"></i>&nbsp;
                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                    <i class="fa fa-angle-down"></i>
                </div>
                <!-- BEGIN THEME PANEL -->
                <div class="btn-group btn-theme-panel">
                    <a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-settings"></i>
                    </a>
                    <div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <h3>HEADER</h3>
                                <ul class="theme-colors">
                                    <li class="theme-color theme-color-default active" data-theme="default">
                                        <span class="theme-color-view"></span>
                                        <span class="theme-color-name">Dark Header</span>
                                    </li>
                                    <li class="theme-color theme-color-light " data-theme="light">
                                        <span class="theme-color-view"></span>
                                        <span class="theme-color-name">Light Header</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12 seperator">
                                <h3>LAYOUT</h3>
                                <ul class="theme-settings">
                                    <li> Layout
                                        <select class="layout-option form-control input-small input-sm">
                                            <option value="fluid" selected="selected">Fluid</option>
                                            <option value="boxed">Boxed</option>
                                        </select>
                                    </li>
                                    <li> Header
                                        <select class="page-header-option form-control input-small input-sm">
                                            <option value="fixed" selected="selected">Fixed</option>
                                            <option value="default">Default</option>
                                        </select>
                                    </li>
                                    <li> Top Dropdowns
                                        <select class="page-header-top-dropdown-style-option form-control input-small input-sm">
                                            <option value="light">Light</option>
                                            <option value="dark" selected="selected">Dark</option>
                                        </select>
                                    </li>
                                    <li> Sidebar Mode
                                        <select class="sidebar-option form-control input-small input-sm">
                                            <option value="fixed">Fixed</option>
                                            <option value="default" selected="selected">Default</option>
                                        </select>
                                    </li>
                                    <li> Sidebar Menu
                                        <select class="sidebar-menu-option form-control input-small input-sm">
                                            <option value="accordion" selected="selected">Accordion</option>
                                            <option value="hover">Hover</option>
                                        </select>
                                    </li>
                                    <li> Sidebar Position
                                        <select class="sidebar-pos-option form-control input-small input-sm">
                                            <option value="left" selected="selected">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </li>
                                    <li> Footer
                                        <select class="page-footer-option form-control input-small input-sm">
                                            <option value="fixed">Fixed</option>
                                            <option value="default" selected="selected">Default</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END THEME PANEL -->
            </div>
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
                <span class="active">菜单权限管理</span>
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
                    <div class="portlet-body">
                        <form class="form-horizontal" id="permissionForm" action="{{route('permission.store')}}">
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
                                    <select class="form-control selectpicker" id="logo" name="logo">
                                        <option value="">--select--</option>
                                        @forelse($icons as $icon)
                                            <option value="{{$icon}}" data-content="<span class='{{$icon}}'></span>"></option>
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
    <script src="/assets/global/plugins/bootstrap-treeview/bootstrap-treeview.min.js"></script>
    <script src="/assets/global/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
    <script src="/assets/global/plugins/bootstrap-validator/js/language/zh_CN.js"></script>
    <script src="/assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="/assets/global/plugins/bootstrap-select/i18n/defaults-zh_CN.min.js"></script>
    <script type="text/javascript">
        $('.selectpicker').selectpicker();

    </script>
    <script type="text/javascript">
        $(function () {
            seajs.use('admin/permission.js', function (app) {
                app.index($, 'moduleTable', 'tree');
            });
        });
    </script>

@endsection
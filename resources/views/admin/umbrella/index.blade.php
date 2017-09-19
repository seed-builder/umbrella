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
                    <small>共享伞</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">共享伞</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i>
                            <span class="caption-subject font-dark sbold uppercase">共享伞搜索</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal search-form">
                            <div class="form-body">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">伞编号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][sn]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">伞序列号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][number]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">出厂设备号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][birth_ep_sn]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">出厂网点</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][birth_site_name]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">出厂网点地址</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][birth_site_address]">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">当前设备号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][current_ep_sn]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">当前网点</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][current_site_name]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">当前网点地址</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][current_site_address]">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">状态</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="filter[][status]">
                                                <option value="">请选择</option>
                                                <option value="1">未发放</option>
                                                <option value="2">待借中</option>
                                                <option value="3">借出中</option>
                                                <option value="4">失效</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">创建时间</label>
                                        <div class="col-md-4">
                                            <input type="date" class="form-control" name="filter[][start_created_at]">
                                        </div>
                                        <div class="col-md-1">
                                            --
                                        </div>
                                        <div class="col-md-4">
                                            <input type="date" class="form-control" name="filter[][end_created_at]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"></div>


                            <div class="form-actions right">
                                <button type="button" class="btn green table-search">查询</button>
                                <button type="button" class="btn red table-reset">重置</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="portlet light bordered">
                    <div id="alert-id"></div>

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-th-list"></i>
                            <span class="caption-subject bold uppercase font-dark">共享伞</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table id="moduleTable" class="table table-bordered table-hover display nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th width="10%">操作</th>
                                <th>伞序列号</th>
                                <th>伞编号</th>
                                <th>出厂网点</th>
                                <th>出厂设备号</th>
                                <th>出厂网点地址</th>
                                <th>当前网点</th>
                                <th>当前设备号</th>
                                <th>当前网点地址</th>
                                <th>状态</th>
                                <th>创建时间</th>
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
            seajs.use('admin/umbrella.js', function (app) {
                app.index($, 'moduleTable', 'alert-id');
            });
        });
    </script>

@endsection
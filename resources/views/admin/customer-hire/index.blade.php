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
                <h1>共享伞管理
                    <small>租用纪录</small>
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
                <span id="breadcrumb" class="active">租用纪录</span>
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
                            <span class="caption-subject font-dark sbold uppercase">租用纪录搜索</span>
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
                                        <label class="col-md-3 control-label">创建时间</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][created_at]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">伞编号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][umbrella_sn]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">用户</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][customer_name]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">到期时间</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][expired_at]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">有效期</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][expire_day]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">租借费用</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][hire_amt]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">借伞时间</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][hire_at]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">租用时长</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][hire_day]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">借伞设备号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][hire_equ_sn]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">借伞网点</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][hire_site_name]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">还伞时间</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][return_at]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">还伞设备</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"
                                                   name="filter[][return_equ_sn]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">还伞网点</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][return_site_name]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">状态</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="filter[][status]">
                                                <option value="">请选择</option>
                                                <option value="1">正常出租</option>
                                                <option value="2">待支付租金</option>
                                                <option value="3">已完成</option>
                                                <option value="4">逾期未归还</option>
                                            </select>
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
                            <span class="caption-subject bold uppercase font-dark">租用纪录</span>
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
                                <th>共享伞编号</th>
                                <th>用户</th>

                                <th>借伞网点</th>
                                <th>借伞设备</th>
                                <th>借伞时间</th>

                                <th>还伞网点</th>
                                <th>还伞设备</th>
                                <th>还伞时间</th>

                                <th>押金</th>
                                <th>有效期（天）</th>
                                <th>到期时间</th>
                                <th>租用时长</th>
                                <th>租借费用</th>
                                <th>状态</th>

                                <th>创建时间</th>
                                <th>修改时间</th>



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
            seajs.use('admin/customer_hire.js', function (app) {
                app.index($, 'moduleTable', 'alert-id');
            });
        });
    </script>

@endsection
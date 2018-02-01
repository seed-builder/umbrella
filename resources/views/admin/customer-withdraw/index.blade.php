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
                    <small>用户提现纪录</small>
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
                <span id="breadcrumb" class="active">用户提现纪录</span>
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
                            <span class="caption-subject font-dark sbold uppercase">用户提现纪录搜索</span>
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
                                        <label class="col-md-3 control-label">金额</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="filter[][start_amt]">
                                        </div>
                                        <div class="col-md-1">
                                            --
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="filter[][end_amt]">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">用户</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][nickname]">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">ID</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][id]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">状态</label>
                                        <div class="col-md-9">
                                            <select  class="form-control" name="filter[][status]">
                                                <option value="">全部</option>
                                                <option value="1">已申请</option>
                                                <option value="2">已打款</option>
                                                <option value="3">提现失败</option>
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
                            <span class="caption-subject bold uppercase font-dark">用户提现纪录</span>
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
                                <th>ID</th>
                                <th>用户微信号</th>
                                <th>提现金额</th>
                                <th>状态</th>
                                <th>创建时间</th>
                                <th>备注</th>

                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="remit-modal">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">手动执行打款计划</h4>
                </div>
                <div class="modal-body" >
                    <div id="modal-alert-id"></div>
                    <form id="remit-form" class="form-horizontal" action="/admin/customer-withdraw/remit">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="excel" class="col-sm-2 control-label">日期</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control"  name="date" placeholder="请输入要打款的纪录的日期">
                                <span class="help-block">例如：选择2017-10-01 则会手动执行该日期的打款计划（避免一次性打款的数据量过大造成超时）</span>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                    <button type="button" id="importExcelBtn" class="btn btn-default form-submit">确定</button>
                </div>
            </div>

        </div>
    </div>


@endsection
@section('scripts')
    @include('admin.layouts.datatable-js')
    <script type="text/javascript">
        $(function () {
            seajs.use('admin/customer_withdraw.js', function (app) {
                app.index($, 'moduleTable', 'alert-id');
            });

            $('.form-submit').on('click', function (e) {
                e.preventDefault();
                App.ajaxForm('#remit-form', '#modal-alert-id', '#remit-modal');
            });
        });
    </script>

@endsection
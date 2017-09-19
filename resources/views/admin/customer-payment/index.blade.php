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
                    <small>customer_payments</small>
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
                <span id="breadcrumb" class="active">用户支付纪录</span>
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
                            <span class="caption-subject font-dark sbold uppercase">用户支付纪录搜索</span>
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
                                        <label class="col-md-3 control-label">外部订单号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][outer_order_sn]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">支付渠道</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="filter[][payment_channel]">
                                                <option value="">请选择</option>
                                                <option value="1">微信支付</option>
                                                <option value="2">支付宝</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">内部订单号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][sn]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">状态</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="filter[][status]">
                                                <option value="">请选择</option>
                                                <option value="1">未支付</option>
                                                <option value="2">已支付</option>
                                                <option value="3">已取消</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">类型</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="filter[][type]">
                                                <option value="">请选择</option>
                                                <option value="1">账户充值</option>
                                                <option value="2">押金充值</option>
                                                <option value="3">押金支出</option>
                                                <option value="4">押金退回</option>
                                                <option value="5">借伞租金支出</option>
                                                <option value="6">账户提现</option>
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
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup">{{$all_recharge_amt}}</span>
                                <small class="font-green-sharp">¥</small>
                            </h3>
                            <small>总充值金额</small>
                        </div>
                        <div class="icon">
                            <i class="icon-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup">{{$all_withdraw_amt}}</span>
                                <small class="font-red-haze">¥</small>
                            </h3>
                            <small>总提现金额</small>
                        </div>
                        <div class="icon">
                            <i class="icon-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup">{{$today_recharge_amt}}</span>
                                <small class="font-green-sharp">¥</small>
                            </h3>
                            <small>今日充值金额</small>
                        </div>
                        <div class="icon">
                            <i class="icon-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red-haze">
                                <span data-counter="counterup">{{$today_withdraw_amt}}</span>
                                <small class="font-red-haze">¥</small>
                            </h3>
                            <small>今日提现金额</small>
                        </div>
                        <div class="icon">
                            <i class="icon-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="portlet light bordered">
                    <div id="alert-id"></div>

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-th-list"></i>
                            <span class="caption-subject bold uppercase font-dark">用户支付纪录</span>
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
                                <th>内部订单号</th>
                                <th>外部订单号</th>
                                <th>用户</th>
                                <th>支付渠道</th>
                                <th>金额</th>
                                <th>支付状态</th>
                                <th>支付类别</th>
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
            seajs.use('admin/customer_payment.js', function (app) {
                app.index($, 'moduleTable', 'alert-id');
            });
        });
    </script>

@endsection
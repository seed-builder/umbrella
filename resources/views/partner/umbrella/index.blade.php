@extends('partner.layouts.main')
@section('styles')
    @include('partner.layouts.datatable-css')
@endsection

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>共享伞管理
                    <small>共享伞</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/partner/">首页</a>
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
                                        <label class="col-md-3 control-label">当前通道</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="filter[][equipment_channel_num]">
                                                <option value="">请选择</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                {{--<th></th>--}}
                                {{--<th>操作</th>--}}
                                <th>伞序列号</th>
                                <th>伞编号</th>
                                <th>当前网点</th>
                                <th>当前设备号</th>
                                <th>当前网点地址</th>
                                <th>当前通道</th>
                                <th>状态</th>
                                <th>价格规则</th>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="import-modal">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Excel导入</h4>
                </div>
                <div class="modal-body" id="blockui-id">
                    <div id="import-alert-id"></div>
                    <form id="importExcelForm" class="form-horizontal" action="/partner/umbrella/import-excel">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="excel" class="col-sm-2 control-label">Excel文件</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="excel" name="excel" placeholder="Excel">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price_id" class="col-sm-2 control-label">价格规则</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="price_id" >
                                    @foreach($prices as $price)
                                        <option value="{{$price->id}}">{{$price->name}}</option>
                                    @endforeach
                                </select>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="price-modal">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">批量设置价格规则</h4>
                </div>
                <div class="modal-body" id="blockui-id">
                    <div id="price-alert-id"></div>
                    <form id="form-price" class="form-horizontal" action="/partner/umbrella/batch-price">
                        {{ csrf_field() }}
                        <input type="hidden" name="ids" id="ids">
                        <div class="form-group">
                            <label for="price_id"  class="col-sm-2 control-label">价格规则</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="price_id" >
                                    @foreach($prices as $price)
                                        <option value="{{$price->id}}">{{$price->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                    <button type="button"  id="batchChangePriceBtn" class="btn btn-default form-submit">确定</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    @include('partner.layouts.datatable-js')
    <script type="text/javascript">
        $(function () {
            seajs.use('partner/umbrella.js', function (pkg) {
                pkg.index($, 'moduleTable', 'alert-id', App);
            });
        });


    </script>

@endsection
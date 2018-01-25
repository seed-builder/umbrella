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
                <h1>用户反馈管理</h1>
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
                <span id="breadcrumb" class="active">用户反馈</span>
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
                            <span class="caption-subject font-dark sbold uppercase">用户反馈搜索</span>
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
                                        <label class="col-md-3 control-label">反馈类型</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="filter[][service_id]">
                                                <option value="">请选择</option>
                                                <option value="1">故障申报</option>
                                                <option value="2">损坏举报</option>
                                                <option value="3">疑问咨询</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">事发地点</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][address]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">内容</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][content]">
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="col-md-4">--}}
                                {{--<div class="form-group">--}}
                                {{--<label class="col-md-3 control-label">用户手机号</label>--}}
                                {{--<div class="col-md-9">--}}
                                {{--<input type="text" class="form-control" name="filter[][created_at]">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{----}}
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
                            <span class="caption-subject bold uppercase font-dark">用户反馈</span>
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
                                <th>用户</th>
                                <th>手机号</th>
                                <th>反馈类型</th>
                                <th>事发地点</th>
                                <th>创建时间</th>
                                <th>内容</th>

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
    @include('partner.layouts.datatable-js')
    <script type="text/javascript">
        $(function () {
            seajs.use('partner/comment.js', function (app) {
                app.index($, 'moduleTable', 'alert-id');
            });
        });
    </script>

@endsection
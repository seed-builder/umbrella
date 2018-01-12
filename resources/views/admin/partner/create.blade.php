@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>经销商管理
                    <small>经销商新增</small>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="blockui-id">
                    <div id="alert-id"></div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">经销商新增</span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" id="form-id" action="/admin/partner/store">
                            {{ csrf_field() }}
                            <div class="form-body">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">登录账号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">密码</label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">经销商全称</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="full_name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">联系人</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="linkman">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">联系电话</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">详细地址</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="address">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row"></div>


                            <div class="form-actions right">
                                <button type="button" class="btn default back-link">返回</button>
                                <button type="button" class="btn green form-submit">提交</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id', '#alert-id', '#blockui-id');
        });
    </script>

@endsection
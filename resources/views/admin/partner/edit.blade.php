@extends('admin.layouts.main')
@section('styles')
    @include('admin.layouts.datatable-css')
@endsection

@section('content')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>经销商管理
                    <small>经销商编辑</small>
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
                            <span class="caption-subject font-dark sbold uppercase">经销商编辑</span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" id="form-id" action="/admin/partner/edit/{{$entity->id}}">
                            {{ csrf_field() }}
                            <div class="form-body">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">登录账号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name"
                                                   value="{{$entity->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">经销商全称</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="full_name"
                                                   value="{{$entity->full_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">联系人</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="linkman"
                                                   value="{{$entity->linkman}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">联系电话</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="mobile"
                                                   value="{{$entity->mobile}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">详细地址</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="address"
                                                   value="{{$entity->address}}">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <hr>
                            <div class="form-actions right">
                                <button type="button" class="btn default back-link">返回</button>
                                <button type="button" class="btn green form-submit">提交</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div id="alert-id"></div>

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-th-list"></i>
                            <span class="caption-subject bold uppercase font-dark">未分配设备信息</span>
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
                                        <label class="col-md-3 control-label">编号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][sn]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">网点</label>
                                        <div class="col-md-9">
                                            <select class="form-control selectpicker" data-live-search="true" name="filter[][site_id]">
                                                <option value="">请选择</option>
                                                @foreach($sites as $site)
                                                    <option value="{{$site->id}}">{{$site->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">状态</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="filter[][status]">
                                                <option value="">请选择</option>
                                                <option value="1">未启用</option>
                                                <option value="2">启用</option>
                                                <option value="3">系统故障</option>
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
                    <div class="portlet-body">
                        <table id="allTable" class="table table-bordered table-hover display nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>设备编号</th>
                                <th>网点</th>
                                <th>状态</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div id="alert-id"></div>

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-th-list"></i>
                            <span class="caption-subject bold uppercase font-dark">经销商负责设备信息</span>
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
                                <th>设备编号</th>
                                <th>网点</th>
                                <th>状态</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    @include('admin.layouts.datatable-js')
    <script>
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id', '#alert-id', '#blockui-id');
        });

        $(function () {
            seajs.use('admin/partner_edit.js', function (app) {
                app.index($, 'moduleTable', 'alert-id','{{$entity->id}}');
            });
        });


    </script>

@endsection
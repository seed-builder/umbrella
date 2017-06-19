@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>top module
                    <small>共享伞新增</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">共享伞新增</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="blockui-id">
                    <div id="alert-id"></div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">共享伞新增</span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" id="form-id" action="/admin/umbrella/store">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">颜色</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="color">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">初始设备</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="equipment_id">
                                                @foreach($equipments as $equipment)
                                                    <option value="{{$equipment->id}}">{{$equipment->sn}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">伞名称</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name" placeholder="不填将自动生成">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">初始网点</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="site_id">
                                                @foreach($sites as $site)
                                                    <option value="{{$site->id}}">{{$site->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">状态</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="status">
                                                <option value="1">未发放</option>
                                                <option value="2">待借中</option>
                                                <option value="3">借出中</option>
                                                <option value="4">失效</option>
                                            </select>
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
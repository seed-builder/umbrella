@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>共享伞管理
                    <small>共享伞编辑</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">共享伞</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="blockui-id">
                    <div id="alert-id"></div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">共享伞编辑</span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" id="form-id" action="/admin/umbrella/edit/{{$entity->id}}">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">伞编号</label>
                                        <div class="col-md-7">
                                            <p class="form-control-static"> {{$entity->sn}} </p>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="col-md-3 control-label">伞名称</label>--}}
                                        {{--<div class="col-md-7">--}}
                                            {{--<input type="text" class="form-control" name="name"--}}
                                                   {{--value="{{$entity->name}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="col-md-3 control-label">颜色</label>--}}
                                        {{--<div class="col-md-7">--}}
                                            {{--<input type="text" class="form-control" name="color"--}}
                                                   {{--value="{{$entity->color}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">当前所属设备</label>
                                        <div class="col-md-7">
                                            <p class="form-control-static"> {{$entity->equipment->sn}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">当前所属网点</label>
                                        <div class="col-md-7">
                                            <p class="form-control-static"> {{$entity->site->name}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">状态</label>
                                        <div class="col-md-7">
                                            <select class="form-control" name="status">
                                                <option value="1" {{$entity->status==1?'selected':''}} >未发放</option>
                                                <option value="2" {{$entity->status==2?'selected':''}} >待借中</option>
                                                <option value="3" {{$entity->status==3?'selected':''}} >借出中</option>
                                                <option value="4" {{$entity->status==4?'selected':''}} >失效</option>
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
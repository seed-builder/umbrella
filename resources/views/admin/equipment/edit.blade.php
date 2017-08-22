@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>设备管理
                    <small>设备编辑</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">设备</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="blockui-id">
                    <div id="alert-id"></div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">设备编辑</span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" id="form-id" action="/admin/equipment/edit/{{$entity->id}}">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">设备号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="sn" value="{{$entity->sn}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">伞容量</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="capacity"
                                                   value="{{$entity->capacity}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">ip</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="ip" value="{{$entity->ip}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">网点</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="site_id">
                                                @foreach($sites as $site)
                                                    <option value="{{$site->id}}" {{$site->id==$entity->site_id?'selected':''}}>{{$site->name}}</option>
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
                                                <option value="1" {{$entity->status==1?'selected':''}}>未启用</option>
                                                <option value="2" {{$entity->status==2?'selected':''}}>启用</option>
                                                <option value="3" {{$entity->status==3?'selected':''}}>系统故障</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">type</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="type">
                                                <option value="1" {{$entity->type==1?'selected':''}}>伞机设备</option>
                                                <option value="2" {{$entity->type==2?'selected':''}}>手持设备</option>
                                            </select>
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
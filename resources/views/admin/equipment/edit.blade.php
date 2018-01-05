@extends('admin.layouts.main')
@section('styles')
    @include('admin.layouts.datatable-css')
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
                                                <option value="0">无</option>
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
                                                <option value="3" {{$entity->status==3?'selected':''}}>在线</option>
                                                <option value="4" {{$entity->status==4?'selected':''}}>离线</option>
                                                <option value="5" {{$entity->status==5?'selected':''}}>系统故障</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">伞机类型</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="type">
                                                <option value="1" {{$entity->type==1?'selected':''}}>伞机设备</option>
                                                <option value="2" {{$entity->type==2?'selected':''}}>手持设备</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">通道数量</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="channels" value="{{$entity->channels}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">服务端IP</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="server_ip" value="{{$entity->server_ip}}" readonly="readonly">
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
            <div class="col-md-12 col-sm-12">
                <div class="portlet light bordered">
                    <div id="alert-id"></div>

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-th-list"></i>
                            <span class="caption-subject bold uppercase font-dark">设备通道</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table id="moduleTable" class="table table-bordered table-hover display nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>equipment_id</th>
                                <th>id</th>
                                <th>通道号</th>
                                <th>伞数量</th>
                                <th>是否有效</th>
                                <th>超时次数</th>
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
    <script>
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id', '#alert-id', '#blockui-id');
        });
    </script>
    @include('admin.layouts.datatable-js')
    <script type="text/javascript">
        $(function () {
            seajs.use('admin/equipment_channel.js', function (app) {
                app.index($, 'moduleTable', {{$entity->id}});
            });
        });
    </script>
@endsection
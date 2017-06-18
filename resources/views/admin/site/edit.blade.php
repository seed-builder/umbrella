@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1>top module
                <small>sites编辑</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb" class="active">sites</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered" id="blockui-id">
                <div id="alert-id"></div>
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">sites编辑</span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" id="form-id" action="/admin/site/edit/{{$entity->id}}">
                        {{ csrf_field() }}                        <div class="form-body">
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">address</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="address" value="{{$entity->address}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">city</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="city" value="{{$entity->city}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">created_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="created_at" value="{{$entity->created_at}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">creator_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="creator_id" value="{{$entity->creator_id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">deleted_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="deleted_at" value="{{$entity->deleted_at}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">district</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="district" value="{{$entity->district}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="id" value="{{$entity->id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">latitude</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="latitude" value="{{$entity->latitude}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">longitude</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="longitude" value="{{$entity->longitude}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">modifier_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="modifier_id" value="{{$entity->modifier_id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{$entity->name}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">province</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="province" value="{{$entity->province}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">type</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="type" value="{{$entity->type}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">updated_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="updated_at" value="{{$entity->updated_at}}">
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
@section('scripts')<script>
    $('.form-submit').on('click', function (e) {
        e.preventDefault();
        App.ajaxForm('#form-id','#alert-id','#blockui-id');
    });
</script>

@endsection
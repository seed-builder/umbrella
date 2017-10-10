@extends('admin.layouts.main')
@section('styles')
    <link rel="stylesheet" href="/assets/global/plugins/bootstrap-summernote/summernote.css">
    <style>
        /*.note-editor{*/
        /*width: 375px;*/
        /*}*/
    </style>
@endsection

@section('content')
<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1>配置管理
                <small>配置项编辑</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb" class="active">配置项</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered" id="blockui-id">
                <div id="alert-id"></div>
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">配置项编辑</span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" id="form-id" action="/admin/sys-config/edit/{{$entity->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" name="id" value="{{$entity->id}}">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-1 control-label">名称</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{$entity->name}}" {{$entity->category == 'system'?'readonly':''}}>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-1 control-label">描述</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="desc" value="{{$entity->desc}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-1 control-label">分类</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="category">
                                            <option value="common" {{$entity->category == 'common'?'selected':''}}>普通</option>
                                            <option value="system" {{$entity->category == 'system'?'selected':''}}>系统</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-1 control-label">内容</label>
                                    <div class="col-md-9">
                                        <textarea id="content" class="form-control" name="value">
                                            {!! $entity->value !!}
                                        </textarea>
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
    <script src="/assets/global/plugins/bootstrap-summernote/summernote.js"></script>
    <script src="/assets/global/plugins/bootstrap-summernote/lang/summernote-zh-CN.js"></script>
    <script>
    $('.form-submit').on('click', function (e) {
        e.preventDefault();
        App.ajaxForm('#form-id','#alert-id','#blockui-id');
    });
    $('#content').summernote({
        width: 375,
        height: 667,
        lang: 'zh-CN'
    });
</script>

@endsection
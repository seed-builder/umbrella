@extends('admin.layouts.main')
@section('styles')
    <link rel="stylesheet" href="/assets/global/plugins/bootstrap-summernote/summernote.css">
@endsection

@section('content')
<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1>配置管理
                <small>配置项详情</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb" class="active">配置项详情</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-green-haze"></i>
                        <span class="caption-subject font-green-haze bold uppercase">配置项详情</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form row">
                    <!-- BEGIN FORM-->
                    <form class="form-horizontal">
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
                    </form>
                    <!-- END FORM-->
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
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
                <h1>帮助中心
                    <small>新增</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">帮助中心新增</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="blockui-id">
                    <div id="alert-id"></div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">帮助中心新增</span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" id="form-id" action="/admin/help/store">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-1 control-label">名称</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="name" style="width: 375px !important;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-1 control-label">排序值</label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control" name="sort" style="width: 375px !important;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-1 control-label">内容</label>
                                    <div class="col-md-10">
                                        <textarea id="content" name="content"></textarea>
                                    </div>
                                </div>
                            </div>


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
            App.ajaxForm('#form-id', '#alert-id', '#blockui-id');
        });

        $('#content').summernote({
            width: 375,
            height: 667,
            lang: 'zh-CN'
        });
    </script>

@endsection
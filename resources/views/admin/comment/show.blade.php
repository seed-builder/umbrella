@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>用户反馈管理
                    <small>用户反馈详情</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">用户反馈详情</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-green-haze"></i>
                            <span class="caption-subject font-green-haze bold uppercase">用户反馈详情</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form class="form-horizontal" role="form">
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3">用户昵称:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{$entity->customer->nickname}} </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">用户手机号:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{$entity->customer->mobile}} </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">事发地点:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{$entity->address}} </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">内容:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{$entity->content}} </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">创建时间:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{$entity->created_at}} </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">反馈类型:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{$entity->service()}} </p>
                                    </div>
                                </div>

                                @php
                                $photo_ids = explode(',',$entity->photo_id)
                                @endphp

                                <div class="form-group">
                                    <label class="control-label col-md-3">图片:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            @foreach($photo_ids as $photo_id)
                                                <img src="/admin/show-image/{{$photo_id}}">
                                        @endforeach
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
    <script>
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id', '#alert-id', '#blockui-id');
        });
    </script>

@endsection
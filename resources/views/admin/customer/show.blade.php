@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>top module
                    <small>微信用户详情</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">微信用户详情</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-green-haze"></i>
                            <span class="caption-subject font-green-haze bold uppercase">微信用户详情</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">微信昵称:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->nickname}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">手机号:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->mobile}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">性别:</label>
                                            <div class="col-md-9">
                                                @if($entity->gender==2)
                                                    <p class="form-control-static"> 女 </p>
                                                @elseif($entity->gender==1)
                                                    <p class="form-control-static"> 男 </p>
                                                @else
                                                    <p class="form-control-static"> 未知 </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">头像:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> <img src="{{$entity->head_img_url}}"> </p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">登陆次数:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->login_time}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">生日:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->birth_day}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">地址:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->address}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">创建时间:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->created_at}} </p>
                                            </div>
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
    <script>
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id', '#alert-id', '#blockui-id');
        });
    </script>

@endsection
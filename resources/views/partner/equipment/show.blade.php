@extends('partner.layouts.main')
@section('styles')

@endsection

@section('content')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>设备管理
                    <small>设备详情</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/partner/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">设备详情</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-green-haze"></i>
                            <span class="caption-subject font-green-haze bold uppercase">设备详情</span>
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
                                            <label class="control-label col-md-3">设备编号:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->sn}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">伞容量:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->capacity}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">剩余数量:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->have}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ip:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->ip}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">所属网点:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{!empty($entity->site)?$entity->site->name:'无'}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">设备类型:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->type()}} </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">状态:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->status()}} </p>
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">修改时间:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->updated_at}} </p>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">设备二维码:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">
                                                    @php
                                                        $base = env('WECHAT_AUTH_LOGIN');
                                                        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.$base.'&response_type=code&scope=snsapi_userinfo&state=mobileAAscanAA'.$entity->sn.'#wechat_redirect'
                                                    @endphp
                                                    @if(!empty($entity->site))
                                                        {{--                                                    {!! QrCode::size(300)->generate(url('mobile/customer-hire/store?hire_equipment_id='.$entity->id)) !!}--}}
                                                        {!! QrCode::size(300)->generate($url) !!}
                                                        {{--                                                    {!! QrCode::size(300)->generate($entity->sn) !!}--}}
                                                    @else
                                                        未找到设备关联网点 无法显示二维码
                                                    @endif
                                                </p>
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
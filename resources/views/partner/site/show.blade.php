@extends('partner.layouts.main')
@section('styles')
    <style>
        #map {
            height: 300px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>top module
                    <small>网点详情</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/partner/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">网点详情</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="blockui-id">
                    <div id="alert-id"></div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">网点详情</span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">网点名称</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{$entity->name}} </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">类别</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{$entity->type()}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">省份</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{$entity->province}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">城市</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{$entity->city}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">区域</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{$entity->district}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">详细地址</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{$entity->address}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"></div>
                            <hr>
                            <div id="map"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
    <script type='text/javascript' src='/mobile/Shineraini/js/web_map.js' charset='utf-8'></script>
    <script>
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id', '#alert-id', '#blockui-id');
        });

        var mapTool = new Map();
        mapTool.key("{{env('QQ_MAP_KEY')}}")
        mapTool.init();
        var point = new qq.maps.LatLng('{{$entity->latitude}}', '{{$entity->longitude}}') ;
        mapTool.initPoint(point,clickFun)

        function clickFun(data) {
            $("#province").val(data.address_component.province);
            $("#city").val(data.address_component.city);
            $("#district").val(data.address_component.district);
            $("#address").val(data.address_component.street_number);
            $("#latitude").val(data.ad_info.location.lat);
            $("#longitude").val(data.ad_info.location.lng);
        }



    </script>

@endsection
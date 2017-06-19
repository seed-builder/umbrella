@extends('admin.layouts.main')
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
                    <small>网点新增</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">网点新增</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="blockui-id">
                    <div id="alert-id"></div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">网点新增</span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" id="form-id" action="/admin/site/store">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">网点名称</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">类别</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="type">
                                                <option value="1">设备网点</option>
                                                <option value="2">还伞网点</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">详细地址</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="address" id="address">
                                        </div>
                                    </div>
                                </div>
                                <div id="map_selected" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">province</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="province" id="province">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">city</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="city" id="city">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">district</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="district" id="district">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">latitude</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="latitude" id="latitude">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">longitude</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="longitude" id="longitude">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"></div>
                            <hr>
                            <div id="map"></div>

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
    <script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
    <script>
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id', '#alert-id', '#blockui-id');
        });

        var container = document.getElementById("map");
        var map = new qq.maps.Map(container, {
            zoom: 13
        });

        citylocation = new qq.maps.CityService({
            complete : function(result){
                map.setCenter(result.detail.latLng);
            }
        });
        citylocation.searchLocalCity();

        qq.maps.event.addListener(map, 'click', function(event) {
            console.log(event)
        });
    </script>

@endsection
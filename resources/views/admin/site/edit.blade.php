@extends('admin.layouts.main')
@section('styles')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css">
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
                <h1>网点管理
                    <small>网点编辑</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">网点编辑</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="blockui-id">
                    <div id="alert-id"></div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">网点编辑</span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" id="form-id" action="/admin/site/edit/{{$entity->id}}">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">网点名称</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name" value="{{$entity->name}}">
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
                                        <label class="col-md-3 control-label">省份</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="province" id="province" value="{{$entity->province}}" readonly >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">城市</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="city" id="city" value="{{$entity->city}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">区域</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="district" id="district" value="{{$entity->district}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">详细地址</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="address" id="address" value="{{$entity->address}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">区域编号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="postal_code" id="code" value="{{$entity->postal_code}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label col-md-3">网点照片</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail"
                                                     style="width: 200px; height: 150px;">
                                                    @if(!empty($entity->photo_id))
                                                        <img src="{{ url('admin/show-image/'.$entity->photo_id) }}"
                                                             alt=""/>
                                                    @endif
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                     style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> 选择图片 </span>
                                                                        <span class="fileinput-exists"> 重新上传 </span>
                                                                        <input type="file" name="photo_id">
                                                                    </span>
                                                    <a href="javascript:;"
                                                       class="btn red-sunglo fileinput-exists"
                                                       data-dismiss="fileinput"> 删除图片 </a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div id="map_selected" style="display: none;">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">关键字搜索</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="tipinput">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script type="text/javascript" src = 'http://webapi.amap.com/maps?v=1.3&key=3e3dbb3d6dce66cd3b9fd70e234bb050&plugin=AMap.Autocomplete,AMap.Geocoder'></script>
    <script type="text/javascript">
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            App.ajaxFormWithFile('#form-id', '#alert-id', '#blockui-id');
        });

        var map = new AMap.Map("map", {
            resizeEnable: true
        });
        var markers = [];

        getAddress([{{$entity->longitude}},{{$entity->latitude}}]);

        map.on('click', function(e) {
            var lng = e.lnglat.lng;
            var lat = e.lnglat.lat;

            map.remove(markers);
            getAddress([lng,lat]);
        });

        var auto = new AMap.Autocomplete({
            input: "tipinput"
        });

        AMap.event.addListener(auto, "select", function (e) {
            if (e.poi && e.poi.location) {
                map.setZoom(15);
                map.setCenter(e.poi.location);
            }
        });

        function getAddress(point) {
            var geocoder = new AMap.Geocoder({
                radius: 1000,
                extensions: "all"
            });
            geocoder.getAddress(point, function(status, result) {
                $("#longitude").val(point[0])
                $("#latitude").val(point[1])
                if (status === 'complete' && result.info === 'OK') {
                    getAddressCallback(result);
                }
            });

            var marker = new AMap.Marker({
                map: map,
                position: point
            });
            markers.push(marker);
            map.setFitView();
        }
        function getAddressCallback(data) {
            var ad = data.regeocode.addressComponent;

            $("#province").val(ad.province)
            $("#city").val(ad.city)
            $("#district").val(ad.district)
            $("#address").val(ad.street+ad.streetNumber)
            $("#code").val(ad.adcode)

        }
    </script>

@endsection
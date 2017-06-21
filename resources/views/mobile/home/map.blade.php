@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="home-map">
        <div id="map"></div>
    </div>
@endsection

@section('javascript')
    <script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
    <script type='text/javascript' src='/mobile/Shineraini/js/mobile_map.js' charset='utf-8'></script>
    <script>
//        var mapmodel = new Map();
//        mapmodel.wechatLocation()
        {{--mapTool.initGeolocation('{{env('QQ_MAP_KEY')}}');--}}
//        mapmodel.h5Location();
    </script>
@endsection
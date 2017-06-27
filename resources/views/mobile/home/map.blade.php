@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')

    <div class="page page-current" id="home-map">
        <div id="map"></div>
    </div>
@endsection

@section('javascript')
    <script>
        var enough_deposit = {{ $user->account->deposit >= $price->deposit_cash ? 1 : 0  }};
    </script>
    <script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
    <script type='text/javascript' src='/mobile/Shineraini/js/mobile_map.js' charset='utf-8'></script>
@endsection
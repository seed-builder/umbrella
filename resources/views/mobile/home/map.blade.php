@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')

    <div class="page page-current" id="home-map">
        <div id="map"></div>

        <div class="panel panel-right panel-cover" id='my-panel'>
            <div class="content-block">
                <div class="panel-header">
                    <div class="panel-header-img">
                        <img src="{{$user->head_img_url}}">
                    </div>
                    <div class="panel-header-text">
                        <span>{{$user->nickname}}</span>
                    </div>
                </div>
            </div>
            <div class="content-block">
                <div class="list-block">
                    <ul>
                        <li class="item-content ajax-link" data-url="/mobile/customer/view">
                            <div class="item-media"><i class="iconfont icon-gerenziliao"></i></div>
                            <div class="item-inner">
                                <div class="item-title">个人资料</div>
                            </div>
                        </li>
                        <li class="item-content ajax-link" data-url="/mobile/customer-account/index">
                            <div class="item-media"><i class="iconfont icon-qianbao3"></i></div>
                            <div class="item-inner">
                                <div class="item-title">我的钱包</div>
                            </div>
                        </li>
                        <li class="item-content link" data-url="/mobile/customer-payment/index">
                            <div class="item-media"><i class="iconfont icon-dingdan"></i></div>
                            <div class="item-inner">
                                <div class="item-title">我的订单</div>
                            </div>
                        </li>
                        <li class="item-content link" data-url="/mobile/customer-account-record/index">
                            <div class="item-media"><i class="iconfont icon-qianbao1"></i></div>
                            <div class="item-inner">
                                <div class="item-title">我的资金</div>
                            </div>
                        </li>
                        <li class="item-content link" data-url="/mobile/customer-hire/index">
                            <div class="item-media"><i class="iconfont icon-emisan"></i></div>
                            <div class="item-inner">
                                <div class="item-title">用伞纪录</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
    <script>
        var enough_deposit = {{ $user->account->deposit >= $price->deposit_cash ? 1 : 0  }};
    </script>
    <script type="text/javascript" src = 'http://webapi.amap.com/maps?v=1.3&key=3e3dbb3d6dce66cd3b9fd70e234bb050'></script>

    <script type="text/javascript">
        $(function () {
            seajs.use('mobile/home_map.js', function (app) {
                app.index($);
            });
        });
    </script>

@endsection
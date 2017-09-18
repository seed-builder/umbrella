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
                                <div class="item-title">资金纪录</div>
                            </div>
                        </li>
                        {{--<li class="item-content link" data-url="/mobile/customer-account-record/index">--}}
                            {{--<div class="item-media"><i class="iconfont icon-qianbao1"></i></div>--}}
                            {{--<div class="item-inner">--}}
                                {{--<div class="item-title">我的资金</div>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        <li class="item-content link" data-url="/mobile/customer-hire/index">
                            <div class="item-media"><i class="iconfont icon-emisan"></i></div>
                            <div class="item-inner">
                                <div class="item-title">用伞纪录</div>
                            </div>
                        </li>
                        <li class="item-content link" data-url="/mobile/comment/create">
                            <div class="item-media"><i class="iconfont icon-yijianfankui"></i></div>
                            <div class="item-inner">
                                <div class="item-title">我要反馈</div>
                            </div>
                        </li>
                        <li class="item-content link" data-url="/mobile/help/index">
                            <div class="item-media"><i class="iconfont icon-bangzhu"></i></div>
                            <div class="item-inner">
                                <div class="item-title">帮助中心</div>
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
        var customer_id = {{Auth::guard('mobile')->user()->id}}

    </script>
    <script type="text/javascript" src = 'http://webapi.amap.com/maps?v=1.3&key=3e3dbb3d6dce66cd3b9fd70e234bb050'></script>
    <script src="//webapi.amap.com/ui/1.0/main.js"></script>


    <script type="text/javascript">
        $(function () {
            seajs.use('mobile/home_map.js?d={{uniqid()}}', function (app) {
                app.index($);
            });
        });
    </script>

    <script id="info-window" type="text/template">
        <div class="amap-ui-smp-ifwn-container info">
            <a class="amap-ui-infowindow-close amap-ui-smp-ifwn-def-tr-close">&#10006;</a>
            <div class="amap-ui-smp-ifwn-content-body">
                <div class="info-title">
                    <i class="iconfont icon-house"></i> <%= site_name %>
                </div>
                <hr>
                <div class="info-text">
                    <p><i class="iconfont icon-san"></i> 可用雨伞 <span class="have-count"><%= have %></span> 把 </p>
                    <p><i class="iconfont icon-yusan"></i> 可还伞位 <span class="repay-count"><%= repay %></span> 把</p>
                </div>
                <hr>
                <div class="info-image">
                    <img src="<%= photo %>" />
                </div>
            </div>
            <div class="amap-ui-smp-ifwn-combo-sharp"></div>
        </div>
    </script>

@endsection
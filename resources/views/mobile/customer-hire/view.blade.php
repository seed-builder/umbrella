@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="customer-hire-view">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left ajax-link" data-url="/mobile/customer-hire/index"></a>
            <h1 class='title'>借伞纪录详情</h1>
        </header>
        <div class="content">
            <div class="list-block">
                <ul>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-kaishishijian"></i></div>
                        <div class="item-inner">
                            <div class="item-title">借伞时间</div>
                            <div class="item-after">{{date('m月d日 H:i',strtotime($entity->hire_at))}}</div>
                        </div>
                    </li>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-icon"></i></div>
                        <div class="item-inner">
                            <div class="item-title">借伞网点</div>
                            <div class="item-after">{{$entity->hire_site_name}}</div>
                        </div>
                    </li>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-jieshushijian"></i></div>
                        <div class="item-inner">
                            <div class="item-title">还伞时间</div>
                            <div class="item-after">
                                {{$entity->return_at=='0000-00-00 00:00:00'? '暂未还伞':date('m月d日 H:i',strtotime($entity->return_at))}}</div>
                        </div>
                    </li>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-guihuan"></i></div>
                        <div class="item-inner">
                            <div class="item-title">还伞网点</div>
                            <div class="item-after">{{!empty($entity->return_site_name)?$entity->return_site_name:'暂未还伞'}}</div>
                        </div>
                    </li>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-yanchi"></i></div>
                        <div class="item-inner">
                            <div class="item-title">最迟还伞时间</div>
                            <div class="item-after">{{date('m月d日 H:i',strtotime($entity->expired_at))}}</div>
                        </div>
                    </li>
                    {{--<li class="item-content" style="">--}}
                        {{--<div class="item-media"><i class="iconfont icon-yituichi"></i></div>--}}
                        {{--<div class="item-inner">--}}
                            {{--<div class="item-title">有效期</div>--}}
                            {{--<div class="item-after">{{$entity->expire_day}}天</div>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-icon_status"></i></div>
                        <div class="item-inner">
                            <div class="item-title">当前状态</div>
                            <div class="item-after">{{$entity->status()}}</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-media"><i class="iconfont icon-49"></i></div>
                        <div class="item-inner">
                            <div class="item-title">押金</div>
                            <div class="item-after">¥{{$entity->deposit_amt}}</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-media"><i class="iconfont icon-qian"></i></div>
                        <div class="item-inner">
                            <div class="item-title">租借费用</div>
                            <div class="item-after">¥{{$entity->hire_amt}}</div>
                        </div>
                    </li>
                </ul>
            </div>

            <form id="form-id" action="/mobile/wechat-payment/hire-pay/{{$entity->id}}" style="display: none">
                {{ csrf_field() }}
                <input id="amt" type="text" name="amt" value="{{$entity->hire_amt}}">
            </form>

            @if($entity->status==\App\Models\CustomerHire::STATUS_PAYING)
            <div class="content-block">
                <div class="col-100"><a class="button button-big button-fill form-submit">等待支付 ¥{{$entity->hire_amt}} 元</a></div>
            </div>
            @endif
        </div>

    </div>


@endsection

@section('javascript')
    <script type="text/javascript">
        $(function () {
            seajs.use('mobile/customer_hire_view.js', function (app) {
                app.index($);
            });
        });
    </script>
@endsection
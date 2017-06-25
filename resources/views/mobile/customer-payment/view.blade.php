@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="customer-payment-view">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left ajax-link" data-url="/mobile/customer-payment/index"></a>
            <h1 class='title'>订单详情</h1>
        </header>

        <div class="content">
            <div class="list-block">
                <ul>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-qian"></i></div>
                        <div class="item-inner">
                            <div class="item-title">交易金额</div>
                            <div class="item-after">{{$entity->amt}}</div>
                        </div>
                    </li>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-leixing"></i></div>
                        <div class="item-inner">
                            <div class="item-title">类型</div>
                            <div class="item-after">{{$entity->type()}}</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-media"><i class="iconfont icon-shijian"></i></div>
                        <div class="item-inner">
                            <div class="item-title">时间</div>
                            <div class="item-after">{{$entity->created_at}}</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-media"><i class="iconfont icon-chongzhidingdanhao"></i></div>
                        <div class="item-inner">
                            <div class="item-title">单号</div>
                            <div class="item-after">{{$entity->sn}}</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-media">
                            @if($entity->payment_channel==1)
                                <i class="iconfont icon-iconfontweixin"></i>
                            @else
                                <i class="iconfont icon-zhifubao"></i>
                            @endif
                        </div>
                        <div class="item-inner">
                            <div class="item-title">支付渠道</div>
                            <div class="item-after">{{$entity->channel()}}</div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>

    </div>


@endsection

@section('javascript')
    <script type="text/javascript">
    </script>
@endsection
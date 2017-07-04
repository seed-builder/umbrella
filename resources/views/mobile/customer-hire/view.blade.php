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
                            <div class="item-after">{{$entity->hire_at}}</div>
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
                            <div class="item-after">{{$entity->return_at}}</div>
                        </div>
                    </li>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-guihuan"></i></div>
                        <div class="item-inner">
                            <div class="item-title">还伞网点</div>
                            <div class="item-after">{{$entity->return_site_name}}</div>
                        </div>
                    </li>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-yanchi"></i></div>
                        <div class="item-inner">
                            <div class="item-title">最迟还伞时间</div>
                            <div class="item-after">{{$entity->expired_at}}</div>
                        </div>
                    </li>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-yituichi"></i></div>
                        <div class="item-inner">
                            <div class="item-title">有效期</div>
                            <div class="item-after">{{$entity->expire_day}}天</div>
                        </div>
                    </li>
                    <li class="item-content" style="">
                        <div class="item-media"><i class="iconfont icon-icon_status"></i></div>
                        <div class="item-inner">
                            <div class="item-title">当前状态</div>
                            <div class="item-after">{{$entity->status()}}</div>
                        </div>
                    </li>
                </ul>
            </div>
            <form id="form-id" action="/mobile/wechat-payment/create-order" style="display: none">
                {{ csrf_field() }}
                <input id="amt" type="text" name="amt" value="">
                <input type="text" name="payment_channel" value="1">
                <input type="text" name="type" value="1">
            </form>

            @if($entity->status==4)
            <div class="content-block">
                <div class="row">
                    <div class="col-100"><a class="button button-big button-fill button-success form-submit">支付租金</a></div>
                </div>
            </div>
            @endif
        </div>

    </div>


@endsection

@section('javascript')
    <script type="text/javascript">
    </script>
@endsection
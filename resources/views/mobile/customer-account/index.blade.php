@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="customer-account-index">
        <div class="content">
            <div class="content-block-title">账户信息</div>
            <div class="list-block">
                <ul>
                    <li class="item-content">
                        <div class="item-media"><i class="fa fa-wechat" aria-hidden="true"></i></div>
                        <div class="item-inner">
                            <div class="item-title">微信昵称</div>
                            <div class="item-after">{{$user->nickname}}</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-media"><i class="fa fa-credit-card" aria-hidden="true"></i></div>
                        <div class="item-inner">
                            <div class="item-title">账户号</div>
                            <div class="item-after">{{$user->account->sn}}</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-media"><i class="iconfont icon-qian"></i></div>
                        <div class="item-inner">
                            <div class="item-title">可用金额</div>
                            <div class="item-after">¥{{$user->account->balance_amt}}</div>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="iconfont icon-xuehua"></i></div>
                        <div class="item-inner ajax-link" data-url="/mobile/customer-account/deposit">
                            <div class="item-title">押金</div>
                            <div class="item-after">¥{{$user->account->deposit+$user->account->freeze_deposit}}</div>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="iconfont icon-msnui-gift-square"></i></div>
                        <div class="item-inner">
                            <div class="item-title">优惠券</div>
                            <div class="item-after">¥0.00</div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="content-block-title">充值</div>
            <div class="grid">
                <div class="row">
                    <div class="col-50">
                        <div class="amt-item" data-value="5">¥ 5元</div>
                    </div>
                    <div class="col-50">
                        <div class="amt-item" data-value="10">¥ 10元</div>
                    </div>
                    <div class="col-50">
                        <div class="amt-item" data-value="15">¥ 15元</div>
                    </div>
                    <div class="col-50">
                        <div class="amt-item" data-value="20">¥ 20元</div>
                    </div>
                    <div class="col-50">
                        <input type="number" class="amt-item amt-input col-100" placeholder="其他">
                    </div>
                </div>
            </div>

            <div class="content-padded">
                <p>点击充值，代表已接受<a>《充值协议》</a></p>
            </div>

            <form id="form-id" action="/mobile/wechat-payment/create-order" style="display: none">
                {{ csrf_field() }}
                <input id="amt" type="text" name="amt" value="">
                <input type="text" name="payment_channel" value="1">
                <input type="text" name="type" value="1">
            </form>

            <div class="content-block">
                <div class="row">
                    <div class="col-50">
                        <div data-url="/mobile/home/map" class="button button-big button-fill button-danger link">返回</div>
                    </div>
                    <div class="col-50"><a class="button button-big button-fill button-success form-submit">充值</a></div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(function () {
            seajs.use('mobile/customer_account.js', function (app) {
                app.index($);
            });
        });
    </script>
@endsection
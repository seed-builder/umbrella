@extends('mobile.layouts.app')
@section('css')
@endsection
@section('content')
    <div class="page page-current" id="customer-account-deposit">
        <header class="bar bar-nav">
            <a href="/mobile/customer-account/index" class="icon icon-left pull-left"></a>
            <h1 class='title'>我的押金</h1>
        </header>
        <div class="content">
            <div class="buttons-tab">
                <a href="#tab1" class="tab-link button {{$tab=='withdraw'?'active':''}}">押金提现</a>
                <a href="#tab2" class="tab-link button {{$tab=='deposit'?'active':''}}">押金充值</a>
            </div>
            <div class="content-block">
                <div class="tabs">

                    <!-------提现----->
                    <div id="tab1" class="tab {{$tab=='withdraw'?'active':''}}">
                        <div class="content-block-title">押金信息</div>
                        <div class="list-block">
                            <ul>
                                <li class="item-content">
                                    <div class="item-media"><i class="iconfont icon-xuehua"></i></div>
                                    <div class="item-inner">
                                        <div class="item-title">押金总额</div>
                                        <div class="item-after">
                                            ¥{{$user->account->deposit+$user->account->freeze_deposit}}</div>
                                    </div>
                                </li>
                                <li class="item-content">
                                    <div class="item-media"><i class="iconfont icon-qian"></i></div>
                                    <div class="item-inner">
                                        <div class="item-title">可提现押金</div>
                                        <div class="item-after">¥{{$user->account->deposit}}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="list-block">
                            <form id="form-id" action="/mobile/wechat-payment/withdraw">
                                {{ csrf_field() }}
                                <ul>
                                    <li>
                                        <div class="item-content">
                                            <div class="item-media"><i class="iconfont icon-tixian"></i></div>
                                            <div class="item-inner">
                                                <div class="item-title label">提现金额</div>
                                                <div class="item-input">
                                                    <input type="number" name="amt" placeholder="请输入您要提现的金额">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </form>
                        </div>

                        <div class="content-padded">
                            <p>每个用户每天最多有三次提现次数</p>
                        </div>

                        <div class="content-block">
                            <div class="row">
                                <div class="col-50">
                                    <a href="/mobile/customer-account/index"
                                       class="button button-big button-fill button-danger ">返回</a>
                                </div>
                                <div class="col-50"><a
                                            class="button button-big button-fill button-lightblue form-submit">申请提现</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-------充值----->
                    <div id="tab2" class="tab {{$tab=='deposit'?'active':''}}">
                        <div class="content-block-title">押金信息</div>
                        <div class="list-block">
                            <ul>
                                <li class="item-content">
                                    <div class="item-media"><i class="iconfont icon-49"></i></div>
                                    <div class="item-inner">
                                        <div class="item-title">押金</div>
                                        <div class="item-after">¥{{$deposit->deposit_cash}}</div>
                                    </div>
                                </li>
                            </ul>

                            <form id="deposit-form-id" action="/mobile/wechat-payment/create-order"
                                  style="display: none">
                                {{ csrf_field() }}
                                <input type="text" name="amt" value="{{$deposit->deposit_cash}}">
                                <input type="text" name="payment_channel" value="1">
                                <input type="text" name="type" value="2">
                            </form>
                        </div>

                        <div class="content-padded">
                            <p>请先阅读<a>《押金充值协议》</a></p>
                        </div>

                        <div class="content-block">
                            <div class="row">
                                <div class="col-50">
                                    <a href="/mobile/customer-account/index"
                                       class="button button-big button-fill button-danger ">返回</a>
                                </div>
                                <div class="col-50"><a
                                            class="button button-big button-fill button-success deposit-form-submit">充押金</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(function () {
            seajs.use('mobile/customer_account_deposit.js', function (app) {
                app.index($);
            });


        });
    </script>
@endsection
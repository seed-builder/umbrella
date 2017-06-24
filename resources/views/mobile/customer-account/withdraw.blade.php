@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="customer-account-withdraw">
        <div class="content">
            <div class="content-block-title">押金信息</div>
            <div class="list-block">
                <ul>
                    <li class="item-content">
                        <div class="item-media"><i class="iconfont icon-xuehua"></i></div>
                        <div class="item-inner">
                            <div class="item-title">押金总额</div>
                            <div class="item-after">¥{{$user->account->freeze_amt}}</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-media"><i class="iconfont icon-qian"></i></div>
                        <div class="item-inner">
                            <div class="item-title">可提现押金</div>
                            <div class="item-after">¥0.00</div>
                        </div>
                    </li>
                </ul>
            </div>


            <div class="content-padded">
                <p>每个账户每天只能提现三次。</p>
            </div>

            <form id="form-id" action="/mobile/wechat-payment/create-order" style="display: none">
                {{ csrf_field() }}
                <input type="text" name="amt" value="">
                <input type="text" name="payment_channel" value="1">
                <input type="text" name="type" value="3">
            </form>

            <div class="content-block">
                <div class="row">
                    <div class="col-50">
                        <a href="/mobile/customer-account/index" class="button button-big button-fill button-danger ">返回</a>
                    </div>
                    <div class="col-50"><a class="button button-big button-fill button-success form-submit">申请提现</a></div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(function () {
            seajs.use('mobile/customer_account_withdraw.js', function (app) {
                app.index($);
            });
        });
    </script>
@endsection
@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')

<div class="grid">
    <div class="row">
        <div class="col-33 grid-item">
            <img class="icon-img" src="/images/icon/icon_data.png">
            <span class="tab-label tool-bar-text">资料完善</span>
        </div>
        <div class="col-33 grid-item">
            <img class="icon-img" src="/images/icon/icon_account.png">
            <span class="tab-label tool-bar-text">个人账户</span>
        </div>
        <div class="col-33 grid-item">
            <img class="icon-img" src="/images/icon/icon_money_record.png">
            <span class="tab-label tool-bar-text">资金流水</span>
        </div>
        <div class="col-33 grid-item">
            <img class="icon-img" src="/images/icon/icon_payment.png">
            <span class="tab-label tool-bar-text">支付记录</span>
        </div>
        <div class="col-33 grid-item">
            <img class="icon-img" src="/images/icon/icon_umbrella.png">
            <span class="tab-label tool-bar-text">租用纪录</span>
        </div>
    </div>
</div>
@endsection


@section('javascript')

@endsection
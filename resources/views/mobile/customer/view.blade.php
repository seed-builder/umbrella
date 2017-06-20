@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="customer-view">
        <div class="content">
        <div class="content-block-title">个人信息</div>
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
                    <div class="item-media"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
                    <div class="item-inner">
                        <div class="item-title">手机号</div>
                        <div class="item-after">{{$user->mobile}}</div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-media"><i class="fa fa-venus-mars" aria-hidden="true"></i></div>
                    <div class="item-inner">
                        <div class="item-title">性别</div>
                        @if($user->gender==2)
                            <div class="item-after">女</div>
                        @elseif($user->gender==1)
                            <div class="item-after">男</div>
                        @elseif($user->gender==0)
                            <div class="item-after">未知</div>
                        @endif
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-media"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                    <div class="item-inner">
                        <div class="item-title">生日</div>
                        <div class="item-after">{{date('Y-m-d',strtotime($user->birth_day))}}</div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-media"><i class="fa fa-address-book" aria-hidden="true"></i></div>
                    <div class="item-inner">
                        <div class="item-title">地址</div>
                        <div class="item-after">{{$user->address}}</div>
                    </div>
                </li>

            </ul>
        </div>

        <div class="content-block">
            <div class="row">
                <div class="col-50"><div data-url="/mobile/home/map" class="button button-big button-fill button-danger link">返回</div></div>
                <div class="col-50"><a href="/mobile/customer/edit" class="button button-big button-fill button-success">完善个人信息</a></div>
            </div>
        </div>

    </div>
    </div>
@endsection

@section('javascript')

@endsection
@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="customer-view">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left back"></a>
            <h1 class='title'>个人信息</h1>
        </header>
        <div class="content">
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
                <div class="col-100"><a href="/mobile/customer/edit" class="button button-big button-fill">完善个人信息</a></div>
            </div>

        </div>
    </div>
@endsection

@section('javascript')

@endsection
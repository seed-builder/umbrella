@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="customer-payment-view">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left ajax-link" data-url="/mobile/customer-account-record/index"></a>
            <h1 class='title'>资金流水详情</h1>
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
                        <div class="item-media"><i class="iconfont icon-beizhu"></i></div>
                        <div class="item-inner">
                            <div class="item-title">备注</div>
                            <div class="item-after">{{$entity->remark}}</div>
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
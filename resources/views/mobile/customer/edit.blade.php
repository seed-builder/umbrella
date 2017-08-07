@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="customer-edit">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left back" ></a>
            <h1 class='title'>个人信息完善</h1>
        </header>
        <div class="content">
            <form id="form-id" action="/mobile/customer/edit">
                {{ csrf_field() }}
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="fa fa-wechat" aria-hidden="true"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">微信昵称</div>
                                    <div class="item-input">
                                        {{$entity->nickname}}
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">手机号</div>
                                    <div class="item-input">
                                        <input type="text" name="mobile" value="{{$entity->mobile}}">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="fa fa-venus-mars" aria-hidden="true"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">性别</div>
                                    <div class="item-input">
                                        <select name="gender">
                                            <option value="1">男</option>
                                            <option value="2">女</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">生日</div>
                                    <div class="item-input">
                                        <input type="date" name="birth_day" value="{{$entity->birth_day}}">
                                    </div>
                                </div>
                            </div>
                        </li>


                    </ul>
                </div>
                <div class="content-block">
                    <div class="col-100"><a class="button button-big button-fill form-submit">保存</a></div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(function () {
            seajs.use('mobile/customer.js', function (app) {
                app.index($);
            });
        });
    </script>
@endsection
@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="customer-edit">
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
                                            <option>男</option>
                                            <option>女</option>
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
                    <div class="row">
                        <div class="col-50"><a href="/mobile/customer/view"
                                               class="button button-big button-fill button-danger">返回</a>
                        </div>
                        <div class="col-50"><a class="button button-big button-fill button-success form-submit">保存</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>

    </script>
@endsection
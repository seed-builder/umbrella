@extends('mobile.layouts.app')
@section('css')
    <style>
        .send-code-disabled {
            background: grey !important;
        }
    </style>
@endsection
@section('content')

    <div class="page page-current" id="register">
        <header class="bar bar-nav">
            <h1 class='title'>柒天伞客</h1>
        </header>
        <div class="content">
            <form id="form-id" action="/mobile/register">
                {{ csrf_field() }}
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">手机号</div>
                                    <div class="item-input">
                                        <input type="tel" name="mobile" id="phone" value="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="fa fa-shield" aria-hidden="true"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">验证码</div>
                                    <div class="item-input">
                                        <input type="text" name="code" value="">
                                    </div>
                                    <div class="item-input">
                                        <button type="button" class="button button-fill" id="send_code">发送验证码</button>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="content-block">
                    <div class="col-100"><a class="button button-big button-fill form-submit ">开始用伞</a></div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(".form-submit").on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id');
        })

        var sending = false;
        var wait = 60;

        $("#send_code").on('click', function () {
            if (sending) {
                return;
            }

            var phone = $("#phone").val();
            sending = true
            App.ajaxLink("/mobile/send?phone="+phone,function(data){
                sending = true;
            },function(){
                layer.open({
                    'content' : '请填写手机号'
                })
            })

            time();
        })

        function time() {
            if (wait == 0) {
                $("#send_code").removeClass("send-code-disabled");
                $("#send_code").text('发送验验证码');
                sending = false;
                wait = 60

            } else {
                $("#send_code").addClass('send-code-disabled')
                $("#send_code").text(wait + "秒后可重发")
                wait--;
                setTimeout(function () {
                        time()
                    },
                    1000)
            }
        }

    </script>

@endsection
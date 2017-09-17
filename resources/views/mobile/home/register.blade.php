@extends('mobile.layouts.app')
@section('css')
    <style>
        .send-code-disabled {
            background: grey !important;
        }
        .check-register{
            text-align: center;
        }
        .check-register{
            text-align: center;
            font-size: 13px;
            margin-top: .5rem;
        }
        .check-register input{
            margin: .5rem;
        }
        .register-text{
            color: #FFD700;
            margin-left: 5px;
        }
    </style>
@endsection
@section('content')

    <div class="page page-current" id="register">
        <header class="bar bar-nav " >
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
                                        <input type="tel" name="mobile" id="phone" value="" placeholder="请输入您的手机号">
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
                                        <input type="number" name="code" value=""  >
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
                    <div class="col-100 check-register"><input type="checkbox" checked disabled>我已阅读
                        <span class="register-text link" data-url="/html/register.html">《用户注册协议》</span>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(".form-submit").on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id',function(){
                window.location.href = '/mobile/home/map'
            });
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
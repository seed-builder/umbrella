@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="scan"></div>

@endsection

@section('javascript')
    <script>

        seajs.use('/assets/api/golang.js', function (app) {

            $.get('/mobile/umbrella/unlock-check', {}, function (data) {
                if (data.code == 500) {
                    layer.open({
                        content: data.message
                        , btn: '我知道了'
                    });
                    return
                } else if (data.code == 501) {
//                    $.router.loadPage("/mobile/customer-account/deposit?index=deposit");
                    window.location.href = '/mobile/customer-account/deposit?index=deposit';
                    return
                } else {
                    var api = app.config;
                    var golang_host = api.host;
                    var key = api.sign_key
                    var customer_id = '{{$user->id}}'
                    var sn = '{{$sn}}'

                    var url = golang_host + 'customer/' + customer_id + '/hire/' + sn + '?sign=' + md5(customer_id + sn + key);

                    layer.open({
                        type: 2,
                        shadeClose: false
                        , content: '系统正在出伞，请稍等15秒左右...'
                    });

                    $.post(url, {}, function (data) {
                        if (data.success) {
                            timer = setInterval(function () {
                                checkHire(data.hire_id);
                            }, 4000);
                        }
                    })
                }
            })

            var timer;

            var checkHire = function (id) {

                $.get('/mobile/customer-hire/check/' + id, {}, function (data) {
                    if (data.code == 0) {
                        layer.closeAll();
                        clearInterval(timer);
                        layer.open({
                            content: '出伞成功，请到机器上领取您的伞'
                            , btn: '我知道了'
                            , yes: function (index) {
                                window.location.href = '/mobile/home/map'
                            },
                        });
                    }
                })
            }
        });
    </script>

@endsection
/**
 * Created by dell on 2017/6/20.
 */
define(function (require, exports, module) {
    exports.index = function ($) {
        var jsApiParams;

        $(".amt-item").on('click',function () {
            $(".amt-item").removeClass('amt-select')
            $(this).addClass('amt-select')

            $("input[name='amt']").val($(this).data('value'))
        })

        $('.amt-input').on('change',function () {
            var amt = $(this).val()
            $("input[name='amt']").val(amt)
        })


        $(".form-submit").on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id',function (data) {
                jsApiParams = data;
                callpay();
                // $.router.loadPage("/mobile/customer-payment/pay/"+data.id)
            })
        })

        var jsApiCall =function ()
        {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                jsApiParams,
            function(res){
                if (res.err_msg == "get_brand_wcpay_request:ok") {
                    layer.open({
                        content: '充值成功'
                        , btn: '我知道了',
                        yes: function () {
                            layer.closeAll();
                            $.router.loadPage("/mobile/customer-account/index")
                        }
                    });
                } else if (res.err_msg == "get_brand_wcpay_request:cancel") {
                    layer.open({
                        content: '用户取消支付'
                        , btn: '我知道了'
                    });
                }
            }
        );
        }

        var callpay = function ()
        {
            if (typeof('WeixinJSBridge') == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            }else{
                jsApiCall();
            }
        }
    }
})
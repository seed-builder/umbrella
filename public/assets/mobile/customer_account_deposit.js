/**
 * Created by dell on 2017/6/20.
 */
define(function (require, exports, module) {
    exports.index = function ($) {
        $(".form-submit").on('click', function () {
            App.ajaxForm('#form-id')
        })

        $(".deposit-form-submit").on('click', function () {
            App.ajaxForm('#deposit-form-id')
        })

        var jsApiCall = function () {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                jsApiParams,
                function (res) {
                    if (res.err_msg == "get_brand_wcpay_request:ok") {
                        layer.open({
                            content: '充值押金成功'
                            , btn: '去借伞',
                            yes: function () {
                                layer.closeAll();
                                window.location.href = '/mobile/home/map'
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

        var callpay = function () {
            if (typeof('WeixinJSBridge') == "undefined") {
                if (document.addEventListener) {
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            } else {
                jsApiCall();
            }
        }
    }
})
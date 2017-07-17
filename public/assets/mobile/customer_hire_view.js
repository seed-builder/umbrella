/**
 * Created by dell on 2017/6/20.
 */
define(function (require, exports, module) {
    exports.index = function ($) {


        var jsApiParams;
        var order_id;

        $(".form-submit").on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id',function (data) {
                if (data!=null){
                    jsApiParams = data.js_params;
                    order_id = data.order_id
                    callpay();

                }else {
                    layer.open({
                        content: '支付成功'
                        , btn: '我知道了'
                        ,yes: function(index){
                            location.reload();
                            layer.close(index);
                        }
                    });

                }
            })
        })

        var jsApiCall =function ()
        {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                jsApiParams,
                function(res){
                    if (res.err_msg == "get_brand_wcpay_request:ok") {
                        App.ajaxLink('/mobile/wechat-payment/pay-success/'+order_id,function () {
                            layer.open({
                                content: '支付成功'
                                , btn: '我知道了'
                            })
                        })
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
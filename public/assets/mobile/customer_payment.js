/**
 * Created by dell on 2017/6/20.
 */
define(function (require, exports, module) {
    exports.index = function ($) {

        var module = new Vue({
            el: '#app',
            data: {
                listOptions: {
                    scrollId: 'scroll-id',
                    refreshId: 'refresh-id',
                    searchBtnId : 'form-search',
                    resetBtnId : 'form-reset',
                    searchFormId : 'search-form',
                    ajax: '/mobile/customer-payment/pagination',
                    ajaxParams: {},
                    itemUrl: function (item) {
                        return '/mobile/customer-payment/view/' + item.id
                    },
                    columns : [
                        {
                            name : '订单号',
                            value : 'sn'
                        },
                        {
                            name : '交易金额',
                            render : function (item) {
                                return item.amt
                            }
                        },
                        {
                            name : '订单类别',
                            render : function (item) {
                                if (item.type==1)
                                    return '账户充值'
                                else
                                    return '押金支付'
                            }
                        }
                    ],
                    footer: function (data) {
                        return data.created_at
                    },
                },
            },
            methods: {

            }
        })

        var form_length = $(".search-form").length;
        if (form_length>1){
            $(".search-form").each(function (index,el) {
                if (form_length==1)
                    return ;
                $(el).remove();
                form_length--;
            })
        }
    }
})
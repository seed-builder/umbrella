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
                    left: function (data) {
                        if (data.type == 1)
                            return '押金支付'
                        else if (data.type == 2)
                            return '租金支付'
                        else
                            return '账户充值'
                    },
                    right: function (data) {
                        if (data.type == 1 || data.type == 2)
                            return '<span class="amt-out">-' + data.amt + '</span>'
                        else
                            return '<span class="amt-in">+' + data.amt + '</span>'
                    },
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
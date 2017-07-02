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
                    ajax: '/mobile/customer-account-record/pagination',
                    ajaxParams: {},
                    itemUrl: function (item) {
                        return '/mobile/customer-account-record/view/' + item.id
                    },
                    left: function (data) {
                        return data.type_name;
                    },
                    right: function (data) {
                        return data.amt
                        // if (data.type == 2 || data.type == 3)
                        //     return '<span class="amt-out">' + data.amt + '</span>'
                        // else
                        //     return '<span class="amt-in">' + data.amt + '</span>'
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
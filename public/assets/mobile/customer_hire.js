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
                    ajax: '/mobile/customer-hire/pagination',
                    ajaxParams: {},
                    itemUrl: function (item) {
                        return '/mobile/customer-hire/view/' + item.id
                    },
                    columns : [
                        {
                            name : '借伞网点',
                            value : 'hire_site_name'
                        },
                        {
                            name : '还伞网点',
                            value : 'return_site_name'
                        },
                    ],

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
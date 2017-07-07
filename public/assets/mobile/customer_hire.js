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
                    header : function (item) {
                        if (item.status==4)
                            return '<a></a>'+'<span style="color: orangered">'+item.status_name+'</span>'+'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        else
                            return '<a></a>'+item.status_name+'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                    },
                    columns : [
                        {
                            render : function (item) {
                                return '<svg class="iconfont-svg" aria-hidden="true"><use xlink:href="#icon-shijian1"></use></svg>'+item.updated_at
                            }
                        },
                        {
                            render : function (item) {
                                return '<svg class="iconfont-svg" aria-hidden="true"><use xlink:href="#icon-normal"></use></svg>'+item.hire_site_name
                            }
                        },
                        {
                            render : function (item) {
                                return '<svg class="iconfont-svg" aria-hidden="true"><use xlink:href="#icon-zhuangtai"></use></svg>'+item.return_site_name
                            }
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
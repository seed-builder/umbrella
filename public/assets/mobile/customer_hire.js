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
                            return '<span><i class="iconfont icon-qian4"></i>  '+item.hire_amt+'</span>'+'<span style="color: red">'+item.status_name+'</span>';
                        else
                            return '<span><i class="iconfont icon-qian4"></i>  '+item.hire_amt+'</span>'+'<span style="color: grey">'+item.status_name+'</span>';
                    },
                    footer : function (item) {
                        return '<i class="iconfont icon-shijian"></i> '+item.updated_at+'</span>'
                    },
                    columns : [
                        // {
                        //     render : function (item) {
                        //         return '<svg class="iconfont-svg" aria-hidden="true"><use xlink:href="#icon-shijian1"></use></svg>'+item.updated_at
                        //     }
                        // },
                        {
                            render : function (item) {
                                return '<span class="hire-item-text">借</span>'+item.hire_site_name
                            }
                        },
                        {
                            render : function (item) {
                                return '<span class="hire-item-text">还</span>'+(item.return_site_name!=null?item.return_site_name:'暂未还伞')
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
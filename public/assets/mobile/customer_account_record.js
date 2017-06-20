/**
 * Created by dell on 2017/6/20.
 */
define(function (require, exports, module) {
    exports.index = function ($) {

        new Vue({
            el: '#app',
            data: {
                listOptions: {
                    scrollId: 'scroll-id',
                    refreshId: 'refresh-id',
                    ajax: '/mobile/customer-account-record/index',
                    ajaxParams: {},
                    itemUrl: function (item) {
                        return '/customers/view/' + item.id
                    },
                    columns: [
                        {
                            name: '流水类型',
                            render: function (item) {
                                return item.type == 1 ? '收入' : '支出'
                            }
                        },
                        {
                            name: '创建时间',
                            render: function (item) {
                                return item.created_at
                            }
                        }
                    ]
                },
            }
        })
    }
})
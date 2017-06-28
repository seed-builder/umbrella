/**
 *
 */
define(function (require, exports, module) {

    var zhCN = require('datatableZh');
    exports.index = function ($, tableId, alertId) {

        var table = $("#" + tableId).DataTable({
            dom: "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'<'pull-right'B>><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            language: zhCN,
            processing: true,
            serverSide: true,
            searching: false,
            select: false,
            paging: true,
            rowId: "id",
            ajax: '/admin/customer-payment/pagination',
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '';
                    }
                },
                {'data': 'sn'},
                {'data': 'outer_order_sn'},
                {'data': 'nickname'},
                {
                    'data': 'payment_channel',
                    render: function (data, type, full) {
                        return data == 1 ? '微信支付' : '支付宝';
                    }
                },
                {'data': 'amt'},
                {
                    'data': 'status',
                    render: function (data, type, full) {
                        if (data==1)
                            return '未支付'
                        else if(data==2)
                            return '已支付'
                        else if(data==3)
                            return '支付失败'
                        else
                            return '已关闭'
                    }
                },
                {
                    'data': 'type',
                    render: function (data, type, full) {
                        if (data==1)
                            return '充值'
                        else if(data==2)
                            return '押金支付'
                    }
                },
                {'data': 'created_at'},
            ],
            columnDefs: [
                {
                    'targets': [0],
                    "visible": false
                }
            ],

            buttons: [
                // {
                //     text: '新增<i class="fa fa-fw fa-plus"></i>', action: function () {
                //     window.location.href = "/admin/customer-payment/create"
                // }
                // },
                //{extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                {extend: 'colvis', text: '列显示 <i class="fa fa-bars"></i>'}
            ]
        });

        $(".table-search").on('click', function () {
            var data = $(this).parents('.search-form').serializeArray()
            var arr = $.param(data)
            table.ajax.url("/admin/customer-payment/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/admin/customer-payment/pagination").load();
        })

        $("table").on('click', '.csx-delete', function () {
            var url = $(this).data('url')
            layer.confirm("确定删除该记录吗?", function (result) {
                App.ajaxLink(url, '#' + alertId, '#' + tableId, function () {
                    table.ajax.reload();
                    layer.closeAll();
                })
            });
        })


    }

});
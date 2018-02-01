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
                {'data': 'mobile'},

                {
                    'data': 'payment_channel',
                    render: function (data, type, full) {
                        return full.channel_name;
                    }
                },
                {'data': 'amt'},
                {'data': 'status_name'},
                {'data': 'type_name'},
                {'data': 'created_at'},
            ],
            columnDefs: [
                {
                    'targets': [0],
                    "visible": false
                },
                { "orderable": false, "targets": [1,2,3,4,5,6,7,8,9] }
            ],
            order:[[9,'desc']],
            buttons: [
                // {
                //     text: '新增<i class="fa fa-fw fa-plus"></i>', action: function () {
                //     window.location.href = "/admin/customer-payment/create"
                // }
                // },
                //{extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                {
                    text: '导出EXCEL <i class="fa fa-file-excel-o"></i>',
                    className: 'btn',
                    action: function () {
                        $(".search-form").attr('action', '/admin/customer-payment/export-excel')
                        $(".search-form").submit();
                        $(".search-form").attr('action', '')
                    }
                },
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



    }

});
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
            ajax: '/admin/customer-hire/pagination',
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '';
                    }
                },

                {'data': 'umbrella_sn'},
                {'data': 'customer_name'},
                {'data': 'hire_site_name'},
                {'data': 'hire_equ_sn'},
                {'data': 'hire_at'},
                {'data': 'return_site_name'},
                {'data': 'return_equ_sn'},
                {'data': 'return_at'},
                {'data': 'deposit_amt'},
                {'data': 'expire_hours'},
                {'data': 'expired_at'},
                {'data': 'hire_hours'},
                {'data': 'hire_amt'},
                {'data': 'status_name'},
                {'data': 'created_at'},
                {'data': 'updated_at'},
            ],
            columnDefs: [
                {
                    'targets': [14,15],
                    "visible": false
                }
            ],

            buttons: [
                // {
                //     text: '新增<i class="fa fa-fw fa-plus"></i>', action: function () {
                //     window.location.href = "/admin/customer-hire/create"
                // }
                // },
                //{extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                {
                    text: '导出EXCEL <i class="fa fa-file-excel-o"></i>',
                    className: 'btn',
                    action: function () {
                        $(".search-form").attr('action', '/admin/customer-hire/export-excel')
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
            table.ajax.url("/admin/customer-hire/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/admin/customer-hire/pagination").load();
        })



    }

});
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
            ajax: '/admin/customer-withdraw/pagination',
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '';
                    }
                },{
                    'data': 'id',

                },
                {'data': 'customer_id',
                    render: function (data, type, full) {
                        return full.customer.nickname;
                    }},
                {'data': 'amt'},
                {
                    'data': 'status',
                    render: function (data, type, full) {
                        return full.status_name;
                    }

                },
                {'data': 'created_at'},
                {'data': 'remark'},


            ],
            columnDefs: [
                {
                    'targets': [0],
                    "visible": false
                }
            ],
            order:[[5,'desc']],
            buttons: [
                {
                    text: '手动执行打款任务<i class="fa fa-fw fa-plus"></i>', action: function () {
                        $("#remit-modal").modal('show')
                    }
                },
                // {extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                {extend: 'colvis', text: '列显示 <i class="fa fa-bars"></i>'}
            ]
        });

        $(".table-search").on('click', function () {
            var data = $(this).parents('.search-form').serializeArray()
            var arr = $.param(data)
            table.ajax.url("/admin/customer-withdraw/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/admin/customer-withdraw/pagination").load();
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
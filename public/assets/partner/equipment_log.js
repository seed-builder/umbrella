/**
 *
 */
define(function (require, exports, module) {

    var zhCN = require('datatableZh');
    exports.index = function ($, tableId, alertId) {

        var table = $("#" + tableId).DataTable({
            dom: "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'<'pull-right'B>><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'p>>",
            language: zhCN,
            processing: true,
            serverSide: true,
            searching: false,
            select: false,
            paging: true,
            rowId: "id",
            ajax: '/partner/equipment-log/pagination',
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '';
                    }
                },

                {
                    'data': 'level',
                    render: function (data, type, full) {
                        return full.level_name;
                    }

                },
                {'data': 'content'},
                {'data': 'created_at'},
            ],
            columnDefs: [
                {
                    'targets': [0],
                    "visible": false
                }
            ],
            order:[[3,'desc']],
            buttons: [
                // {
                //     text: '新增<i class="fa fa-fw fa-plus"></i>', action: function () {
                //     window.location.href = "/partner/equipment-log/create"
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
            table.ajax.url("/partner/equipment-log/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/partner/equipment-log/pagination").load();
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
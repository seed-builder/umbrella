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
            ajax: '/admin/customer/pagination',
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '';
                    }
                },
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return `<div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-cog"></i>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="/admin/customer/show/` + data + `"> 详情 <i class="fa fa-file-o"></i> </a>
                        </li>
                    </ul>
                </div>`;
                    }
                },
                {'data': 'nickname'},
                {
                    'data': 'gender',
                    render: function (data, type, full) {
                        if (data===2)
                            return '女'
                        else if (data==1)
                            return '男'
                        else
                            return '未知'

                    }
                },
                {'data': 'mobile'},
                {'data': 'province'},
                {'data': 'city'},
                {'data': 'created_at'},

            ],
            order:[[7,'desc']],
            columnDefs: [
                {
                    'targets': [0],
                    "visible": false
                }
            ],
            buttons: [
                //{extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                {
                    text: '导出EXCEL <i class="fa fa-file-excel-o"></i>',
                    className: 'btn',
                    action: function () {
                        $(".search-form").attr('action', '/admin/customer/export-excel')
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
            table.ajax.url("/admin/customer/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/admin/customer/pagination").load();
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
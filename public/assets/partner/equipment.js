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
            ajax: '/partner/equipment/pagination',
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
                        return  '<a class="btn btn-xs green" href="/partner/equipment/show/' + data + '"> 详情 <i class="fa fa-file-o"></i> </a>'
                    }
                },
                {'data': 'sn'},
                {
                    'data': 'site_id',
                    render: function (data, type, full) {
                        return full.site != null ? full.site.name : '无';
                    }
                },
                {'data': 'capacity'},
                {'data': 'have'},
                {
                    'data': 'type',
                    render: function (data, type, full) {
                        return data==1?'伞机设备':'手持设备'
                    }
                },
                {'data': 'ip'},
                {
                    'data': 'status',
                    render: function (data, type, full) {
                        return full.status_name
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
                //{extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                {extend: 'colvis', text: '列显示 <i class="fa fa-bars"></i>'}
            ]
        });

        $(".table-search").on('click', function () {
            var data = $(this).parents('.search-form').serializeArray()
            var arr = $.param(data)
            table.ajax.url("/partner/equipment/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/partner/equipment/pagination").load();
        })

    }

});
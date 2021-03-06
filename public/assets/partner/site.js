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
            select: true,
            paging: true,
            rowId: "id",
            ajax: '/partner/site/pagination',
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '';
                    }
                },
                {'data': 'province'},
                {'data': 'city'},
                {'data': 'district'},
                {'data': 'address'},
                {'data': 'name'},
                {
                    'data': 'type',
                    render: function (data, type, full) {
                        if (data == 1)
                            return '设备网点'
                        else
                            return '还伞网点'
                    }
                },
                {'data': 'longitude'},
                {'data': 'latitude'},
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
                //     window.location.href = "/partner/site/create"
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
            table.ajax.url("/partner/site/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/partner/site/pagination").load();
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


        var map = new AMap.Map("map", {
            resizeEnable: true
        });

        table.on('select', rowSelect).on('deselect', rowSelect);

        var markers = [];

        function rowSelect() {
            map.remove(markers);

            var row = table.rows('.selected').data();
            if (row.length < 1)
                return

            if (row) {
                row = row[0]
                if (row.longitude != null && row.latitude != null) {
                    var marker = new AMap.Marker({
                        map: map,
                        position: [row.longitude, row.latitude]
                    });

                    markers.push(marker);
                }
            }


        }

    }

});
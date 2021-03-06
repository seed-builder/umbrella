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
            ajax: '/admin/equipment/pagination',
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '<input type="checkbox" class="editor-active" value="'+data+'">';
                    },
                    className: "dt-body-center"
                },
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '<div class="btn-group">' +
                            '<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">' +
                            ' <i class="fa fa-cog"></i>' +
                            ' <i class="fa fa-angle-down"></i>' +
                            '</button>' +
                            '<ul class="dropdown-menu" role="menu">' +
                            '<li>' +
                            '<a href="/admin/equipment/edit/' + data + '"> 编辑 <i class="fa fa-fw fa-pencil"></i> </a>' +
                            '</li>' +
                            '<li>' +
                            '<a class="csx-delete" data-url="/admin/equipment/delete/' + data + '" href="javascript:;"> 删除 <i class="fa fa-fw fa-trash"></i> </a>' +
                            '</li>' +
                            '<li>' +
                            '<a href="/admin/equipment/show/' + data + '"> 详情 <i class="fa fa-file-o"></i> </a>' +
                            '</li>' +
                            '</ul>' +
                            '</div>'
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
                    'data': 'price_id',
                    render: function (data, type, full) {
                        return full.price != null ? full.price.name : '无';
                    }
                },
                {
                    'data': 'price_id',
                    render: function (data, type, full) {
                        return full.price != null ? full.price.deposit_cash : '无';
                    }
                },
                {
                    'data': 'status',
                    render: function (data, type, full) {
                        return full.status_name
                    }
                },
                {'data': 'created_at'},
                {
                    'data': 'type',
                    render: function (data, type, full) {
                        return data==1?'伞机设备':'手持设备'
                    }
                },
                {'data': 'ip'},
            ],
            columnDefs: [
                {
                    'targets': [0],
                    'checkboxes': { 'selectRow': true },
                    'searchable': false,
                    'sortable': false
                }
            ],

            buttons: [
                {
                    text: '新增<i class="fa fa-fw fa-plus"></i>', action: function () {
                    window.location.href = "/admin/equipment/create"
                }
                },
                {
                    text: '批量设置价格', action: function () {
                    $("#price-modal").modal('show');
                }
                },
                //{extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                {extend: 'colvis', text: '列显示 <i class="fa fa-bars"></i>'}
            ]
        });

        $(".table-search").on('click', function () {
            var data = $(this).parents('.search-form').serializeArray()
            var arr = $.param(data)
            table.ajax.url("/admin/equipment/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/admin/equipment/pagination").load();
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

        $('#batchChangePriceBtn').on('click', function (e) {
            e.preventDefault();
            var arr = table.rows('.selected').data();
            if(arr.length > 0) {
                var ids = [];
                for(var i = 0; i < arr.length; i ++){
                    ids[ids.length] = arr[i].id;
                }

                $('#ids').val(ids.join(','));
                App.ajaxForm('#form-price', '#price-alert-id', '#blockui-id', function () {
                    // $("#price-modal").modal('hide');
                    table.ajax.reload();
                });
            }
        });


    }

});
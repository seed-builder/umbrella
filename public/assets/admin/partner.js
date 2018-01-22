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
            ajax: '/admin/partner/pagination',
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
                        var btns = '<button class="btn btn-xs green"><a href="/admin/partner/edit/' + data + '" style="color: white"> 编辑&分配设备 <i class="fa fa-fw fa-pencil"></i> </a></button>'

                        if(full.status == 1)
                            btns+= '<button class="btn btn-xs red"><a href="/admin/partner/change-status/' + data + '" style="color: white"> 禁用 <i class="fa fa-fw fa-trash"></i> </a></button>'
                        else
                            btns+= '<button class="btn btn-xs blue"><a href="/admin/partner/change-status/' + data + '" style="color: white"> 启用 <i class="fa fa-fw fa-pencil"></i> </a></button>'
                        return btns

                    }
                },
                {'data': 'name'},
                {'data': 'full_name'},
                {
                    'data': 'status',
                    render: function (data, type, full) {
                        return data == 1 ? '启用' : '禁用'
                    }
                },
                {'data': 'linkman'},
                {'data': 'mobile'},
                {'data': 'address'},
                {'data': 'created_at'},

            ],
            columnDefs: [
                {
                    'targets': [0],
                    "visible": false
                }
            ],

            buttons: [
                {
                    text: '新增<i class="fa fa-fw fa-plus"></i>', action: function () {
                    window.location.href = "/admin/partner/create"
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
            table.ajax.url("/admin/partner/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/admin/partner/pagination").load();
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
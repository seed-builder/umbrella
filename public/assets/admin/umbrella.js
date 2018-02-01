/**
 *
 */
define(function (require, exports, module) {

    var zhCN = require('datatableZh');
    exports.index = function ($, tableId, alertId, App) {

        var table = $("#" + tableId).DataTable({
            dom: "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'<'pull-right'B>><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            language: zhCN,
            processing: true,
            serverSide: true,
            searching: false,
            select: false,
            paging: true,
            rowId: "id",
            ajax: '/admin/umbrella/pagination',
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
                            '<i class="fa fa-cog"></i>' +
                            '<i class="fa fa-angle-down"></i>' +
                            '</button>' +
                            '<ul class="dropdown-menu" role="menu">' +
                            '<li>' +
                            '<a href="/admin/umbrella/edit/' + data + '"> 编辑 <i class="fa fa-fw fa-pencil"></i> </a>' +
                            '</li>' +
                            '<li>' +
                            '<a class="csx-delete" data-url="/admin/umbrella/delete/' + data + '" href="javascript:;"> 删除 <i class="fa fa-fw fa-trash"></i> </a>' +
                            '</li>' +
                            '</ul>' +
                            '</div>';
                        //<li><a href="/admin/umbrella/show/` + data + `"> 详情 <i class="fa fa-file-o"></i> </a></li>
                    }
                },
                {'data': 'number'},
                {'data': 'sn'},
                {
                    'data': 'current_site_name',
                    render: function (data, type, full) {
                        return data ? data :'无网点信息';
                    }
                },
                {
                    'data': 'current_ep_sn',
                    render: function (data, type, full) {
                        return data ? data :'无设备信息';
                    }
                },
                {
                    'data': 'current_site_address',
                    render: function (data, type, full) {
                        return data ? data :'无网点地址';
                    }
                },
                {'data': 'equipment_channel_num'},
                {
                    'data': 'status',
                    render: function (data, type, full) {
                        if (data == 1)
                            return '未发放'
                        else if (data == 2)
                            return '待借中'
                        else if (data == 3)
                            return '借出中'
                        else
                            return '失效'
                    }
                },
                {'data': 'price_name'},
                {'data': 'created_at'},
            ],
            columnDefs: [
                {
                    'targets': [0],
                    'checkboxes': { 'selectRow': true },
                    'searchable': false,
                    'sortable': false
                },
            ],
            order:[[10,'desc']],
            buttons: [
                {
                    text: '导入', action: function () {
                    $("#import-modal").modal('show')
                }
                },
                {
                    text: '下载导入模板', action: function () {
                        window.location.href = '/admin/umbrella/down-template';
                    }
                },
                {
                    text: '批量设置价格', action: function () {
                        $("#price-modal").modal('show');
                    }
                },
                {
                    text: '初始化', action: function () {
                        var arr = table.rows('.selected').data();
                        if(arr.length > 0) {
                            var ids = '';
                            for(var i = 0; i < arr.length; i ++){
                                if(i==0)
                                    ids+=arr[i].id;
                                else
                                    ids+=','+arr[i].id;
                            }

                            layer.confirm('确认初始化该把伞吗，将清空该伞关联的设备和网点信息！',function () {
                                // window.location.href = '/admin/umbrella/reset?id='+ids
                                App.ajaxLink('/admin/umbrella/reset?id='+ids,'#' + alertId, '#' + tableId, function () {
                                    layer.closeAll();
                                    table.ajax.reload();
                                })
                            });
                        }


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
            table.ajax.url("/admin/umbrella/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/admin/umbrella/pagination").load();
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

        $('#importExcelBtn').on('click', function (e) {
            e.preventDefault();
            App.ajaxFormWithFile('#importExcelForm','#import-alert-id','#blockui-id');
        });

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
                    $("#price-modal").modal('hide');
                    table.ajax.reload();
                });
            }
        });

    }

});
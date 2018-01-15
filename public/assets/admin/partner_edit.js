/**
 *
 */
define(function (require, exports, module) {

    var zhCN = require('datatableZh');
    exports.index = function ($, tableId, alertId, partner_id) {

        var allTable = $("#allTable").DataTable({
            dom: "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'<'pull-right'B>><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            language: zhCN,
            processing: true,
            serverSide: true,
            searching: false,
            select: true,
            paging: true,
            rowId: "id",
            // ajax: '/admin/equipment/pagination',
            ajax: {
                url: '/admin/equipment/pagination',
                type: "GET",
                dataSrc: 'data',
                data: function (data) {
                    data.partner_id = 0
                }
            },
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '<input type="checkbox" class="editor-active" value="'+data+'">';
                    },
                    className: "dt-body-center"
                },

                {'data': 'sn'},
                {
                    'data': 'site_id',
                    render: function (data, type, full) {
                        return full.site != null ? full.site.name : '无';
                    }
                },
                {
                    'data': 'status',
                    render: function (data, type, full) {
                        return full.status_name
                    }
                },
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
                    text: '分配设备<i class="fa fa-fw fa-plus"></i>', action: function () {
                    //window.location.href = "/admin/equipment/create"
                    var arr = allTable.rows('.selected').data();
                    if(arr.length > 0) {
                        var ids = [];
                        for(var i = 0; i < arr.length; i ++){
                            ids[ids.length] = arr[i].id;
                        }
                        App.ajaxLink('/admin/partner/allot-equipment?partner_id='+partner_id+'&equipment_ids='+ids,alertId,'#allTable',function (data) {
                            allTable.ajax.reload();
                            table.ajax.reload();
                        })

                    }
                }
                },
                //{extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                // {extend: 'colvis', text: '列显示 <i class="fa fa-bars"></i>'}
            ]
        });

        var table = $("#moduleTable").DataTable({
            dom: "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'<'pull-right'B>><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            language: zhCN,
            processing: true,
            serverSide: true,
            searching: false,
            select: false,
            paging: true,
            rowId: "id",
            // ajax: '/admin/equipment/pagination',
            ajax: {
                url: '/admin/equipment/pagination',
                type: "GET",
                dataSrc: 'data',
                data: function (data) {
                    data.partner_id = partner_id
                }
            },
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '<input type="checkbox" class="editor-active" value="'+data+'">';
                    },
                    className: "dt-body-center"
                },
                {'data': 'sn'},
                {
                    'data': 'site_id',
                    render: function (data, type, full) {
                        return full.site != null ? full.site.name : '无';
                    }
                },
                {
                    'data': 'status',
                    render: function (data, type, full) {
                        return full.status_name
                    }
                },
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
                    text: '取消分配<i class="fa fa-fw fa-trash"></i>', action: function () {
                    //window.location.href = "/admin/equipment/create"
                        var arr = table.rows('.selected').data();
                        if(arr.length > 0) {
                            var ids = [];
                            for(var i = 0; i < arr.length; i ++){
                                ids[ids.length] = arr[i].id;
                            }
                            App.ajaxLink('/admin/partner/remove-allot-equipment?equipment_ids='+ids,alertId,'#allTable',function (data) {
                                allTable.ajax.reload();
                                table.ajax.reload();
                            })

                        }
                    }
                },
                //{extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                // {extend: 'colvis', text: '列显示 <i class="fa fa-bars"></i>'}
            ]
        });


        $(".table-search").on('click', function () {
            var data = $(this).parents('.search-form').serializeArray()
            var arr = $.param(data)
            allTable.ajax.url("/admin/equipment/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            allTable.ajax.url("/admin/equipment/pagination").load();
        })

    }

});
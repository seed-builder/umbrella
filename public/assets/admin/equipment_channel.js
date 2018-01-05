/**
*
*/
define(function(require, exports, module) {

    var zhCN = require('datatableZh');
    var editorCN = require('i18n');
    exports.index = function ($, tableId, equipmentId) {
        var editor = new $.fn.dataTable.Editor({
            ajax: {
                create: {
                    type: 'POST',
                    url: '/admin/equipment-channel',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                },
                edit: {
                    type: 'PUT',
                    url: '/admin/equipment-channel/_id_',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                },
                remove: {
                    type: 'DELETE',
                    url: '/admin/equipment-channel/_id_',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                }
            },
            i18n: editorCN,
            table: "#" + tableId,
            idSrc: 'id',
            fields: [
                { 'label':  '通道号', 'name': 'num', },
                { 'label':  '是否有效', 'name': 'valid', 'type':'select', 'options':[{'label':'有效', 'value': 1},{'label': '无效', 'value': 0}], 'def': 1},
                { 'label':  '伞数量', 'name': 'umbrellas', 'type':"readonly"},
                { 'label':  '超时次数', 'name': 'rescue_times', 'type':"readonly"},
                //通道锁状态(0-未知, 1-通道忙, 2-通讯超时, 160-通道超时, 161-中间,162-借伞,163-还伞)
                { 'label':  '通道锁状态', 'name': 'lock_status', 'type':"select",
                    'options':[
                        {'label': '未知', 'value': 0},
                        {'label': '通道忙', 'value': 1},
                        {'label': '通讯超时', 'value': 2},
                        {'label': '通道超时', 'value': 160},
                        {'label': '中间', 'value': 161},
                        {'label': '借伞', 'value': 162},
                        {'label': '还伞', 'value': 163},
                        ]
                },
            ]
        });

        var table = $("#" + tableId).DataTable({
            dom: "lBfrtip",
            language: zhCN,
            processing: true,
            serverSide: true,
            select: true,
            paging: true,
            rowId: "id",
            ajax: {
                url: '/admin/equipment-channel/pagination',
                data: function (data) {
                    data.columns[0]['search']['value'] = equipmentId
                }
            },
            columns: [
                {  'data': 'equipment_id' },
                {  'data': 'id' },
                {  'data': 'num' },
                {  'data': 'umbrellas' },
                {  'data': 'valid', render: function (data, type, full) {
                        return data ? '有效':'无效';
                    } },
                {  'data': 'rescue_times' },
                //通道锁状态(0-未知, 1-通道忙, 2-通讯超时, 160-通道超时, 161-中间,162-借伞,163-还伞)
                {  'data': 'lock_status',render: function (data, type, full) {
                       switch (data){
                           default:
                           case 0:
                               return '未知';
                           case 1:
                               return '通道忙';
                           case 2:
                               return '通讯超时';
                           case 160:
                               return '通道超时';
                           case 161:
                               return '中间';
                           case 162:
                               return '借伞';
                           case 163:
                               return '还伞';
                       }
                    } },
            ],
            columnDefs: [
                {
                    "targets": [0],
                    "visible": false
                }
            ],
            buttons: [
                // { text: '新增', action: function () { }  },
                // { text: '编辑', className: 'edit', enabled: false },
                // { text: '删除', className: 'delete', enabled: false },
                {extend: "create", text: '新增<i class="fa fa-fw fa-plus"></i>', editor: editor},
                {extend: "edit", text: '编辑<i class="fa fa-fw fa-pencil"></i>', editor: editor},
                {extend: "remove", text: '删除<i class="fa fa-fw fa-trash"></i>', editor: editor},
                {extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                {extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                //{extend: 'colvis', text: '列显示'}
            ]
        });

        // table.on( 'select', checkBtn).on( 'deselect', checkBtn);
        //
        // function checkBtn(e, dt, type, indexes) {
        //     var count = table.rows( { selected: true } ).count();
        //     table.buttons( ['.edit', '.delete'] ).enable(count > 0);
        // }

    }

});
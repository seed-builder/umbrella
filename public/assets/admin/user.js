/**
*
*/
define(function(require, exports, module) {

    var zhCN = require('datatableZh');
    var editorCN = require('i18n');
    exports.index = function ($, tableId) {
        var editor = new $.fn.dataTable.Editor({
            ajax: {
                create: {
                    type: 'POST',
                    url: '/admin/user',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                },
                edit: {
                    type: 'PUT',
                    url: '/admin/user/_id_',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                },
                remove: {
                    type: 'DELETE',
                    url: '/admin/user/_id_',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                }
            },
            i18n: editorCN,
            table: "#" + tableId,
            idSrc: 'id',
            fields: [
            { 'label':  'address', 'name': 'address', },
                { 'label':  'birth_day', 'name': 'birth_day', },
                    { 'label':  'email', 'name': 'email', },
                { 'label':  'gender', 'name': 'gender', },
                    { 'label':  'login_time', 'name': 'login_time', },
                { 'label':  'name', 'name': 'name', },
                { 'label':  'nick_name', 'name': 'nick_name', },
                { 'label':  'password', 'name': 'password', },
                { 'label':  'remark', 'name': 'remark', },
                { 'label':  'remember_token', 'name': 'remember_token', },
                { 'label':  'tel', 'name': 'tel', },
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
            ajax: '/admin/user/pagination',
            columns: [
                    {  'data': 'address' },
                    {  'data': 'birth_day' },
                    {  'data': 'created_at' },
                    {  'data': 'email' },
                    {  'data': 'gender' },
                    {  'data': 'id' },
                    {  'data': 'login_time' },
                    {  'data': 'name' },
                    {  'data': 'nick_name' },
                    {  'data': 'password' },
                    {  'data': 'remark' },
                    {  'data': 'remember_token' },
                    {  'data': 'tel' },
                    {  'data': 'updated_at' },
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
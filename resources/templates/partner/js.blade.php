<?php

function exclude($column){
	$arr = ['id', 'created_at', 'updated_at'];
	return in_array($column->name , $arr);
}
function showEditorType($column){
	if(empty($column))
		return '';

	switch ($column->name){
		case 'created_at':
		case 'updated_at':
			return "'type':'datetime'";
	}
}
?>

/**
*
*/
define(function(require, exports, module) {

    var zhCN = require('datatableZh');
    exports.index = function ($, tableId,alertId) {

        var table = $("#" + tableId).DataTable({
            dom: "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'<'pull-right'B>><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            language: zhCN,
            processing: true,
            serverSide: true,
            searching : false,
            select: false,
            paging: true,
            rowId: "id",
            ajax: '/partner/{{snake_case($model,'-')}}/pagination',
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
                            <a href="/partner/{{snake_case($model,'-')}}/edit/`+data+`"> 编辑 <i class="fa fa-fw fa-pencil"></i> </a>
                        </li>
                        <li>
                            <a class="csx-delete" data-url="/partner/{{snake_case($model,'-')}}/delete/`+data+`" href="javascript:;"> 删除 <i class="fa fa-fw fa-trash"></i> </a>
                        </li>
                        <li>
                            <a href="/partner/{{snake_case($model,'-')}}/show/`+data+`"> 详情 <i class="fa fa-file-o"></i> </a>
                        </li>
                    </ul>
                </div>`;
                }
            },
        @forelse($columns as $col)
            {  'data': '{{$col->name}}' },
        @empty
        @endforelse

    ],
    columnDefs: [
        {
            'targets': [0],
            "visible": false
        }
    ],

            buttons: [
                { text: '新增<i class="fa fa-fw fa-plus"></i>', action: function () {
                    window.location.href="/partner/{{snake_case($model,'-')}}/create"
                }  },
                //{extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                {extend: 'colvis', text: '列显示 <i class="fa fa-bars"></i>'}
            ]
        });

        $(".table-search").on('click',function(){
            var data = $(this).parents('.search-form').serializeArray()
            var arr = $.param(data)
            table.ajax.url("/partner/{{snake_case($model,'-')}}/pagination?" + arr).load();
        })

        $(".table-reset").on('click',function(){
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/partner/{{snake_case($model,'-')}}/pagination").load();
        })

        $("table").on('click','.csx-delete',function(){
            var url = $(this).data('url')
            layer.confirm("确定删除该记录吗?", function(result) {
                App.ajaxLink(url,'#'+alertId,'#'+tableId,function(){
                    table.ajax.reload();
                    layer.closeAll();
                })
            });
        })


    }

});
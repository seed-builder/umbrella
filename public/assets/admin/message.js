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
            ajax: '/admin/message/pagination',
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '';
                    }
                },
                // {
                //     'data': 'id',
                //     render: function (data, type, full) {
                //         return `<div class="btn-group">
                //     <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                //         <i class="fa fa-cog"></i>
                //         <i class="fa fa-angle-down"></i>
                //     </button>
                //     <ul class="dropdown-menu" role="menu">
                //         <li>
                //             <a href="/admin/message/edit/` + data + `"> 编辑 <i class="fa fa-fw fa-pencil"></i> </a>
                //         </li>
                //         <li>
                //             <a class="csx-delete" data-url="/admin/message/delete/` + data + `" href="javascript:;"> 删除 <i class="fa fa-fw fa-trash"></i> </a>
                //         </li>
                //         <li>
                //             <a href="/admin/message/show/` + data + `"> 详情 <i class="fa fa-file-o"></i> </a>
                //         </li>
                //     </ul>
                // </div>`;
                //     }
                // },
                {
                    'data': 'category',
                    render: function (data, type, full) {
                        return full.category_name
                    }
                },
                {'data': 'content'},
                {
                    'data': 'site_id',
                    render: function (data, type, full) {
                        return full.site_name
                    }
                },
                {
                    'data': 'equipment_id',
                    render: function (data, type, full) {
                        return full.equ_name
                    }
                },
                {'data': 'channel'},

                {'data': 'created_at'},
                {
                    'data': 'read',
                    render: function (data, type, full) {
                        return data==0 ? '未读' : '已读'
                    }
                },
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
                    window.location.href = "/admin/message/create"
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
            table.ajax.url("/admin/message/pagination?" + arr).load();
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/admin/message/pagination").load();
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

    var audioPlayed = false;
    exports.roll = function ($) {
        $.get('/admin/message/get-tops', {read: 0}, function (result) {
            if (result.cancelled == 0 && result.data.length > 0) {
                $("#message_count").velocity("fadeOut", {duration: 500}).velocity("fadeIn", {duration: 500});
                if (!audioPlayed) {
                    document.getElementById('audioObj').play();
                    audioPlayed = true;
                }
                var messages = result.data;
                $('.message-count').text(messages.length);
                $('#MessageContent').html('');
                for (var i = 0; i < messages.length; i++) {
                    var msg = messages[i];
                    $('<li><a href="javascript:;"><span class="time">' + msg['time_desc'] + '</span><span class="details"><span class="label label-sm label-icon label-danger">' +
                        '<i class="fa fa-bullhorn"></i>' +
                        '</span> ' + msg['title'] + '</span></a></li>').appendTo('#MessageContent');
                }
            }
        });
    }
});
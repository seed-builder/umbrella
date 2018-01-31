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
            ajax: '/partner/view-partner-statistics/pagination',
            columns: [
                {
                    'data': 'id',
                    render: function (data, type, full) {
                        return '';
                    }
                },
                {'data': 'id'},
                {'data': 'site_name'},
                {'data': 'equipments_sn'},
                {'data': 'deposit_amt'},
                {'data': 'hire_amt'},
                {'data': 'created_at'},
            ],
            columnDefs: [
                {
                    'targets': [0],
                    "visible": false
                }
            ],
            order:[[6,'desc']],
            buttons: [
                //{extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                //{extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                {extend: 'colvis', text: '列显示 <i class="fa fa-bars"></i>'}
            ]
        });

        var data = $('.search-form').serializeArray()
        var arr = $.param(data)
        App.ajaxData('/partner/view-partner-statistics/statistics?'+arr,function (resp) {
            $("#deposit").text(resp.deposit)
            $("#amt").text(resp.amt)
        })

        $(".table-search").on('click', function () {
            var data = $(this).parents('.search-form').serializeArray()
            var arr = $.param(data)
            table.ajax.url("/partner/view-partner-statistics/pagination?" + arr).load();

            App.ajaxData('/partner/view-partner-statistics/statistics?'+arr,function (resp) {
                $("#deposit").text(resp.deposit)
                $("#amt").text(resp.amt)
            })
        })

        $(".table-reset").on('click', function () {
            $(this).parents('.search-form')[0].reset();
            table.ajax.url("/partner/view-partner-statistics/pagination").load();
        })



    }

});
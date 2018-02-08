@extends('admin.layouts.main')
@section('styles')
    <style>
        .highcharts-credits{
            display: none !important;
        }
    </style>
@endsection
@section('content')
    <div class="page-content" id="app">
        <div class="page-head">
            <div class="page-title">
                <h1>首页</h1>
            </div>
            @include('admin.layouts.page-toolbar')
        </div>

        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">Dashboard</span>
            </li>
        </ul>

        <div class="row" style="display: none">
            <div class="col-md-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>
                            <span class="caption-subject font-dark sbold uppercase">用户增长情况</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn blue btn-outline btn-sm" href="javascript:;" data-toggle="dropdown"
                                   data-hover="dropdown" data-close-others="true" aria-expanded="false"> 选择
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;" @click="userMode = '7d'"> 近七天</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" @click="userMode = '1m'"> 近一月</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" @click="userMode = '3m'"> 近三月</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="user_charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bar-chart"></i>
                            <span class="caption-subject font-dark sbold uppercase">资金收入&支出情况</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn blue btn-outline btn-sm" href="javascript:;" data-toggle="dropdown"
                                   data-hover="dropdown" data-close-others="true" aria-expanded="false"> 选择
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;" @click="userMode = '7d'"> 近七天</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" @click="userMode = '1m'"> 近一月</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" @click="userMode = '3m'"> 近三月</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="payment_charts"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-star-o"></i>
                            <span class="caption-subject font-dark sbold uppercase">各网点借伞情况</span>
                        </div>
                        <div class="actions" >
                            {{--<div class="col-md-6">--}}
                                {{--<select class="form-control selectpicker" data-live-search="true">--}}
                                    {{--<option value="">全部</option>--}}
                                    {{--@foreach($sites as $site)--}}
                                        {{--<option value="{{$site->id}}">{{$site->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a class="btn blue btn-outline btn-sm" href="javascript:;" data-toggle="dropdown"
                                       data-hover="dropdown" data-close-others="true" aria-expanded="false"> 选择
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;" @click="hireMode = '7d'"> 近七天</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" @click="hireMode = '1m'"> 近一月</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" @click="hireMode = '3m'"> 近三月</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="hire_chart"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.hcharts.cn/highcharts/highcharts.js"></script>
    <script src="/assets/global/scripts/vue.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                userMode: '',
                hireMode: '',
                paymentMode: '',
            },
            mounted:function(){
                var self = this;
            },
            created: function () {
                this.userMode = '7d';
                this.hireMode = '7d';
                this.paymentMode = '1m';
            },
            watch: {
                userMode: function () {
                    var self = this;
                    App.ajaxData('admin/charts/user?flag=' + self.userMode, function (resp) {
                        self.loadUserChart(resp);
                    })
                },
                hireMode: function () {
                    var self = this;
                    App.ajaxData('admin/charts/hire?flag=' + self.hireMode, function (resp) {
                        self.loadHireChart(resp);
                    })
                },
                paymentMode: function () {
                    var self = this;
                    App.ajaxData('admin/charts/payment?flag=' + self.paymentMode, function (resp) {
                        self.loadPaymentChart(resp);
                    })
                },
            },
            methods: {
                dateTitle: function (mode) {
                    switch (mode) {
                        case '7d':
                            return '近七日'
                        case '1m':
                            return '近一月'
                        case '3m':
                            return '近三月'
                    }
                },
                loadUserChart: function (data) {
                    console.log(data)
                    var t = this.dateTitle(this.userMode);
                    $('#user_charts').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: t + '用户增长情况'
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: data['xs'],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: '新增用户数'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y} 个</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: '有效用户',
                            data: data['ys'][0],
                            color: 'rgb(124, 181, 236)'
                        }, {
                            name: '无效用户',
                            data: data['ys'][1],
                            color: 'rgb(255, 188, 117)'
                        }]
                    });
                },
                loadHireChart: function (data) {
                    var t = this.dateTitle(this.hireMode);
                    Highcharts.chart('hire_chart', {
                        title: {
                            text: t + '各网点借伞情况统计'
                        },
                        subtitle: {
                            text: ''
                        },
                        yAxis: {
                            title: {
                                text: '租借单数量'
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },
                        xAxis: {
                            categories: data['xs'],
                            crosshair: true
                        },
                        series: data['ys'],
                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 500
                                },
                                chartOptions: {
                                    legend: {
                                        layout: 'horizontal',
                                        align: 'center',
                                        verticalAlign: 'bottom'
                                    }
                                }
                            }]
                        }
                    });
                },
                loadPaymentChart: function (data) {
                    var t = this.dateTitle(this.paymentMode);
                    $('#payment_charts').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: t + '平台资金收入&支出情况统计'
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: data['xs'],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: '金额'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y} 元</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                borderWidth: 0
                            }
                        },
                        series: data['ys']
                    });
                },



            }
        })

    </script>
@endsection
@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>押金规则管理
                    <small>押金规则编辑</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">押金规则</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="blockui-id">
                    <div id="alert-id"></div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">押金规则编辑</span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" id="form-id" action="/admin/price/edit/{{$entity->id}}">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">押金规则</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name" value="{{$entity->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">押金</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="deposit_cash" value="{{$entity->deposit_cash}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">开始日期</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" name="begin" value="{{date('Y-m-d',strtotime($entity->begin))}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">结束日期</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" name="end" value="{{date('Y-m-d',strtotime($entity->end))}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">日租金</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="hire_day_cash" value="{{$entity->hire_day_cash}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">租借逾期天数</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="hire_expire_days" value="{{$entity->hire_expire_days}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">免费租借天数</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="hire_free_days" value="{{$entity->hire_free_days}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">状态</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="status">
                                                <option value="1" {{$entity->status==1 ? 'selected' : ''}}>启用</option>
                                                <option value="2" {{$entity->status==2 ? 'selected' : ''}}>禁用</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-actions right">
                                <button type="button" class="btn default back-link">返回</button>
                                <button type="button" class="btn green form-submit">提交</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id', '#alert-id', '#blockui-id');
        });
    </script>

@endsection
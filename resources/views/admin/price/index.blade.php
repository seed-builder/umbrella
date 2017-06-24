@extends('admin.layouts.main')
@section('styles')
    @include('admin.layouts.datatable-css')
@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>top module
                <small>prices</small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb"  class="active">prices</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-search"></i>
                        <span class="caption-subject font-dark sbold uppercase">prices搜索</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal search-form">
                        <div class="form-body">
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">begin</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][begin]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">created_at</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][created_at]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">creator_id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][creator_id]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">deleted_at</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][deleted_at]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">deposit_cash</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][deposit_cash]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">end</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][end]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">hire_day_cash</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][hire_day_cash]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">hire_expire_days</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][hire_expire_days]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">hire_free_days</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][hire_free_days]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][id]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">is_default</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][is_default]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">modifier_id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][modifier_id]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">name</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][name]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">status</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][status]">
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">updated_at</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][updated_at]">
                                        </div>
                                    </div>
                                </div>
                                                    </div>
                        <div class="row"></div>


                        <div class="form-actions right">
                            <button type="button" class="btn green table-search">查询</button>
                            <button type="button" class="btn red table-reset">重置</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet light bordered">
                <div id="alert-id"></div>

                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-th-list"></i>
                        <span class="caption-subject bold uppercase font-dark">prices</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="moduleTable" class="table table-bordered table-hover display nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th width="10%">操作</th>
                                                            <th>begin</th>
                                                            <th>created_at</th>
                                                            <th>creator_id</th>
                                                            <th>deleted_at</th>
                                                            <th>deposit_cash</th>
                                                            <th>end</th>
                                                            <th>hire_day_cash</th>
                                                            <th>hire_expire_days</th>
                                                            <th>hire_free_days</th>
                                                            <th>id</th>
                                                            <th>is_default</th>
                                                            <th>modifier_id</th>
                                                            <th>name</th>
                                                            <th>status</th>
                                                            <th>updated_at</th>
                            
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <!-- END PAGE BASE CONTENT -->
</div>


@endsection
@section('scripts')
    @include('admin.layouts.datatable-js')
    <script type="text/javascript">
        $(function () {
            seajs.use('admin/price.js', function (app) {
                app.index($, 'moduleTable','alert-id');
            });
        });
    </script>

@endsection
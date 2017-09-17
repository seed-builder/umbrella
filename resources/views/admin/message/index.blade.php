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
                <small>messages</small>
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
            <span id="breadcrumb"  class="active">messages</span>
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
                        <span class="caption-subject font-dark sbold uppercase">messages搜索</span>
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
                                        <label class="col-md-3 control-label">category</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][category]">
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">channel</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][channel]">
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">content</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][content]">
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
                                        <label class="col-md-3 control-label">equipment_id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][equipment_id]">
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
                                        <label class="col-md-3 control-label">level</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][level]">
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
                                        <label class="col-md-3 control-label">read</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][read]">
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">site_id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="filter[][site_id]">
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
                        <span class="caption-subject bold uppercase font-dark">messages</span>
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
                            <th>category</th>
                            <th>channel</th>
                            <th>content</th>
                            <th>created_at</th>
                            <th>creator_id</th>
                            <th>deleted_at</th>
                            <th>equipment_id</th>
                            <th>id</th>
                            <th>level</th>
                            <th>modifier_id</th>
                            <th>read</th>
                            <th>site_id</th>
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
            seajs.use('admin/message.js', function (app) {
                app.index($, 'moduleTable','alert-id');
            });
        });
    </script>

@endsection
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
                <small>umbrellas</small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb"  class="active">umbrellas</span>
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
                        <span class="caption-subject font-dark sbold uppercase">umbrellas搜索</span>
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
                                        <label class="col-md-3 control-label">color</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][color]" filter-op='like' filter-name='color'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">created_at</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][created_at]" filter-op='like' filter-name='created_at'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">creator_id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][creator_id]" filter-op='like' filter-name='creator_id'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">deleted_at</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][deleted_at]" filter-op='like' filter-name='deleted_at'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">equipment_id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][equipment_id]" filter-op='like' filter-name='equipment_id'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][id]" filter-op='like' filter-name='id'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">logo</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][logo]" filter-op='like' filter-name='logo'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">modifier_id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][modifier_id]" filter-op='like' filter-name='modifier_id'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">name</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][name]" filter-op='like' filter-name='name'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">site_id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][site_id]" filter-op='like' filter-name='site_id'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">sn</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][sn]" filter-op='like' filter-name='sn'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">status</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][status]" filter-op='like' filter-name='status'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">updated_at</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][updated_at]" filter-op='like' filter-name='updated_at'>
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
                        <span class="caption-subject bold uppercase font-dark">umbrellas</span>
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
                                                            <th>color</th>
                                                            <th>created_at</th>
                                                            <th>creator_id</th>
                                                            <th>deleted_at</th>
                                                            <th>equipment_id</th>
                                                            <th>id</th>
                                                            <th>logo</th>
                                                            <th>modifier_id</th>
                                                            <th>name</th>
                                                            <th>site_id</th>
                                                            <th>sn</th>
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
            seajs.use('admin/umbrella.js', function (app) {
                app.index($, 'moduleTable','alert-id');
            });
        });
    </script>

@endsection
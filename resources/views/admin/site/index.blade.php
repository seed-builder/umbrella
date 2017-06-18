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
                <small>sites</small>
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
            <span id="breadcrumb"  class="active">sites</span>
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
                        <span class="caption-subject font-dark sbold uppercase">sites搜索</span>
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
                                        <label class="col-md-3 control-label">address</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][address]" filter-op='like' filter-name='address'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">city</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][city]" filter-op='like' filter-name='city'>
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
                                        <label class="col-md-3 control-label">district</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][district]" filter-op='like' filter-name='district'>
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
                                        <label class="col-md-3 control-label">latitude</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][latitude]" filter-op='like' filter-name='latitude'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">longitude</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][longitude]" filter-op='like' filter-name='longitude'>
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
                                        <label class="col-md-3 control-label">province</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][province]" filter-op='like' filter-name='province'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">type</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][type]" filter-op='like' filter-name='type'>
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
                        <span class="caption-subject bold uppercase font-dark">sites</span>
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
                                                            <th>address</th>
                                                            <th>city</th>
                                                            <th>created_at</th>
                                                            <th>creator_id</th>
                                                            <th>deleted_at</th>
                                                            <th>district</th>
                                                            <th>id</th>
                                                            <th>latitude</th>
                                                            <th>longitude</th>
                                                            <th>modifier_id</th>
                                                            <th>name</th>
                                                            <th>province</th>
                                                            <th>type</th>
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
            seajs.use('admin/site.js', function (app) {
                app.index($, 'moduleTable','alert-id');
            });
        });
    </script>

@endsection
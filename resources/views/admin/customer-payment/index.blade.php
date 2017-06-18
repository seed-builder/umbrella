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
                <small>customer_payments</small>
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
            <span id="breadcrumb"  class="active">customer_payments</span>
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
                        <span class="caption-subject font-dark sbold uppercase">customer_payments搜索</span>
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
                                        <label class="col-md-3 control-label">amt</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][amt]" filter-op='like' filter-name='amt'>
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
                                        <label class="col-md-3 control-label">customer_id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][customer_id]" filter-op='like' filter-name='customer_id'>
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
                                        <label class="col-md-3 control-label">id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][id]" filter-op='like' filter-name='id'>
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
                                        <label class="col-md-3 control-label">outer_order_sn</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][outer_order_sn]" filter-op='like' filter-name='outer_order_sn'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">payment_channel</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][payment_channel]" filter-op='like' filter-name='payment_channel'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">reference_id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][reference_id]" filter-op='like' filter-name='reference_id'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">reference_type</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][reference_type]" filter-op='like' filter-name='reference_type'>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">remark</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][remark]" filter-op='like' filter-name='remark'>
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
                        <span class="caption-subject bold uppercase font-dark">customer_payments</span>
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
                                                            <th>amt</th>
                                                            <th>created_at</th>
                                                            <th>creator_id</th>
                                                            <th>customer_id</th>
                                                            <th>deleted_at</th>
                                                            <th>id</th>
                                                            <th>modifier_id</th>
                                                            <th>outer_order_sn</th>
                                                            <th>payment_channel</th>
                                                            <th>reference_id</th>
                                                            <th>reference_type</th>
                                                            <th>remark</th>
                                                            <th>sn</th>
                                                            <th>status</th>
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
            seajs.use('admin/customer_payment.js', function (app) {
                app.index($, 'moduleTable','alert-id');
            });
        });
    </script>

@endsection
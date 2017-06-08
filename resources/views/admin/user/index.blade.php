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
                <small>users</small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
        <!-- BEGIN PAGE TOOLBAR -->
        @include('admin.layouts.page-toolbar')    <!-- END PAGE TOOLBAR -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">users</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-docs font-dark"></i>
                        <span class="caption-subject bold uppercase font-dark">users</span>
                        
                    </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                        
                        
                        
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="moduleTable" class="table table-bordered table-hover display nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                                                            <th>address</th>
                                                            <th>birth_day</th>
                                                            <th>created_at</th>
                                                            <th>email</th>
                                                            <th>gender</th>
                                                            <th>id</th>
                                                            <th>login_time</th>
                                                            <th>name</th>
                                                            <th>nick_name</th>
                                                            <th>password</th>
                                                            <th>remark</th>
                                                            <th>remember_token</th>
                                                            <th>tel</th>
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
            seajs.use('admin/user.js', function (app) {
                app.index($, 'moduleTable');
            });
        });
    </script>

@endsection
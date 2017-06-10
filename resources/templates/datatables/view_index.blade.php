<?php echo "@extends('admin.layouts.main')"; ?>

<?php echo  "@section('styles')" ; ?>

    <?php echo  "@include('admin.layouts.datatable-css')" ; ?>

<?php echo  "@endsection" ; ?>


<?php echo  "@section('content')" ; ?>

<div class="page-content">
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>{{$topModule or 'top module'}}
                <small>{{$table}}</small>
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
            <span id="breadcrumb"  class="active">{{$table}}</span>
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
                        <span class="caption-subject font-dark sbold uppercase">{{$table}}搜索</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal search-form">
                        <div class="form-body">
                            @forelse($columns as $k=>$col)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">{{$col->name}}</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control filter-condition" name="filter[][{{$col->name}}]" filter-op='like' filter-name='{{$col->name}}'>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
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
                        <span class="caption-subject bold uppercase font-dark">{{$table}}</span>
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
                            @forelse($columns as $col)
                                <th>{{$col->name}}</th>
                            @empty
                            @endforelse

                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <!-- END PAGE BASE CONTENT -->
</div>


<?php echo "@endsection"  ; ?>

<?php echo "@section('scripts')"  ; ?>

    <?php echo "@include('admin.layouts.datatable-js')"  ; ?>

    <script type="text/javascript">
        $(function () {
            seajs.use('admin/{{snake_case($model)}}.js', function (app) {
                app.index($, 'moduleTable','alert-id');
            });
        });
    </script>

<?php echo "@endsection"  ; ?>
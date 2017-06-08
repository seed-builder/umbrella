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
            <h1><?php echo e(isset($topModule) ? $topModule : 'top module'); ?>

                <small><?php echo e($table); ?></small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
        <!-- BEGIN PAGE TOOLBAR -->
        <?php echo "@include('admin.layouts.page-toolbar')"  ; ?>
    <!-- END PAGE TOOLBAR -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active"><?php echo e($table); ?></span>
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
                        <span class="caption-subject bold uppercase font-dark"><?php echo e($table); ?></span>
                        
                    </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                        
                        
                        
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="moduleTable" class="table table-bordered table-hover display nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <?php $__empty_1 = true; $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <th><?php echo e($col->name); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
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
            seajs.use('admin/<?php echo e(snake_case($model)); ?>.js', function (app) {
                app.index($, 'moduleTable');
            });
        });
    </script>

<?php echo "@endsection"  ; ?>
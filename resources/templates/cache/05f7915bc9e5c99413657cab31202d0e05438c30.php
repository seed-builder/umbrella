<?php echo "@extends('admin.layouts.main')"; ?>

<?php echo  "@section('styles')" ; ?>


<?php echo  "@endsection" ; ?>


<?php echo  "@section('content')" ; ?>

<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1><?php echo e(isset($topModule) ? $topModule : 'top module'); ?>

                <small><?php echo e($table); ?>详情</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb" class="active"><?php echo e($table); ?>详情</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-green-haze"></i>
                        <span class="caption-subject font-green-haze bold uppercase"><?php echo e($table); ?>详情</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" role="form">
                        <div class="form-body">
                            
                            
                            <div class="row">
                                <?php $__empty_1 = true; $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3"><?php echo e($col->name); ?>:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> <?php echo '{{$entity->'.$col->name.'}}'  ; ?> </p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(($k+1)%3==0): ?>
                                    </div>
                                    <div class="row">
                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                            </div>


                        </div>

                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
</div>


<?php echo "@endsection"  ; ?>

<?php echo "@section('scripts')"  ; ?>
<script>
    $('.form-submit').on('click', function (e) {
        e.preventDefault();
        App.ajaxForm('#form-id','#alert-id','#blockui-id');
    });
</script>

<?php echo "@endsection"  ; ?>
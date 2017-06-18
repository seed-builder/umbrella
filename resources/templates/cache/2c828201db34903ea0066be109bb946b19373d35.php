<?php echo $BEGIN_PHP; ?>

Route::get('<?php echo e(snake_case($model,'-')); ?>/pagination', ['uses' => '<?php echo e($model); ?>Controller@pagination']);
Route::get('<?php echo e(snake_case($model,'-')); ?>/create', ['uses' => '<?php echo e($model); ?>Controller@create']);
Route::post('<?php echo e(snake_case($model,'-')); ?>/store', ['uses' => '<?php echo e($model); ?>Controller@store']);
Route::get('<?php echo e(snake_case($model,'-')); ?>/edit/{id}', ['uses' => '<?php echo e($model); ?>Controller@edit']);
Route::post('<?php echo e(snake_case($model,'-')); ?>/edit/{id}', ['uses' => '<?php echo e($model); ?>Controller@update']);
Route::get('<?php echo e(snake_case($model,'-')); ?>/show/{id}', ['uses' => '<?php echo e($model); ?>Controller@show']);
Route::get('<?php echo e(snake_case($model,'-')); ?>/delete/{id}', ['uses' => '<?php echo e($model); ?>Controller@destroy']);
Route::resource('<?php echo e(snake_case($model,'-')); ?>', '<?php echo e($model); ?>Controller');
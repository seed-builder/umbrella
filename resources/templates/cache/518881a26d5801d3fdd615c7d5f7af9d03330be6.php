<?php
if(!function_exists('dataTypeFilter')){
function dataTypeFilter($data_type){
	return $data_type == 'datetime' ? 'string' : $data_type;
}
}
$vaildate_fields = [];
foreach ($columns as $col){
    if($col->data_type == 'string'){
        $vaildate_fields[] = $col->name;
    }
}

$vaildate_message = [];
foreach ($columns as $col){
    if($col->data_type == 'string'){
        $vaildate_message[] = [
            $col->name => $col->name.'不能为空'
        ];
    }
}

?>
<?php echo $BEGIN_PHP; ?>


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class <?php echo e($model); ?>

 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="<?php echo e($model); ?>")
 <?php $__empty_1 = true; $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
* @SWG\Property(name="<?php echo e($c->name); ?>", type="<?=dataTypeFilter($c->data_type)?>", description="<?php echo e($c->comment); ?>")
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <?php endif; ?>
 */
class <?php echo e($model); ?> extends BaseModel
{
	//
	protected $table = '<?php echo e($table); ?>';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];
}

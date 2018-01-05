<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class EquipmentChannel
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="EquipmentChannel")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="equipment_id", type="integer", description="设备id")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="num", type="integer", description="伞道编号")
 * @SWG\Property(name="rescue_times", type="integer", description="检测次数")
 * @SWG\Property(name="status", type="integer", description="状态")
 * @SWG\Property(name="umbrellas", type="integer", description="伞数量")
 * @SWG\Property(name="updated_at", type="string", description="")
 * @SWG\Property(name="valid", type="integer", description="是否有效")
  */
class EquipmentChannel extends BaseModel
{
	//
	protected $table = 'equipment_channels';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];
}

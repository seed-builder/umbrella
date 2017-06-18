<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class Equipment
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Equipment")
 * @SWG\Property(name="capacity", type="integer", description="容量（伞数量）")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="have", type="integer", description="当前还有数（伞数量）")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="ip", type="string", description="ip")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="site_id", type="integer", description="sites id")
 * @SWG\Property(name="sn", type="string", description="设备编号")
 * @SWG\Property(name="status", type="integer", description="状态（0-未启用, 1-启用, 2-系统故障）")
 * @SWG\Property(name="type", type="integer", description="设备类型 1-伞机设备 2-手持设备")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class Equipment extends BaseModel
{
	//
	protected $table = 'equipments';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];
}

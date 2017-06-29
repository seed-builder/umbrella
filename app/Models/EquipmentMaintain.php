<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class EquipmentMaintain
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="EquipmentMaintain")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="engineer", type="string", description="维修人员")
 * @SWG\Property(name="equipment_id", type="integer", description="equipments id")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="maintain_content", type="string", description="维修内容")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="site_id", type="integer", description="equipments id")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class EquipmentMaintain extends BaseModel
{
	//
	protected $table = 'equipment_maintains';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];

    public function equipment(){
        return $this->hasOne(Equipment::class,'id','equipment_id');
    }

    public function site(){
        return $this->hasOne(Site::class,'id','site_id');
    }
}

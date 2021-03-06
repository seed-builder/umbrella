<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class EquipmentLog
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="EquipmentLog")
 * @SWG\Property(name="api_name", type="string", description="模块名 （表名|请求接口名）")
 * @SWG\Property(name="code", type="string", description="报警返回码")
 * @SWG\Property(name="content", type="string", description="报警内容")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="equipment_id", type="integer", description="equipments id")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="site_id", type="integer", description="equipments id")
 * @SWG\Property(name="type", type="string", description="超时|异常")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class EquipmentLog extends BaseModel
{
	//
	protected $table = 'equipment_logs';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];

    public function level(){
        switch ($this->level){
            case 0:
                return 'CRITICAL';
            case 1:
                return 'ERROR';
            case 2:
                return 'WARNING';
            case 3:
                return 'NOTICE';
            case 4:
                return 'INFO ';
            case 5:
                return 'DEBUG';

        }
    }

//    public function equipment(){
//        return $this->hasOne(Equipment::class,'id','equipment_id');
//    }
//
//    public function site(){
//        return $this->hasOne(Site::class,'id','site_id');
//    }
}

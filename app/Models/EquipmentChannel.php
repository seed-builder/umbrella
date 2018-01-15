<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Services\EquipmentService;

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
 * @SWG\Property(name="rescue_times", type="integer", description="检测超时次数")
 * @SWG\Property(name="lock_status", type="integer", description="通道锁状态(0-未知, 1-通道忙, 2-通讯超时, 160-通道超时, 161-中间,162-借伞,163-还伞, 166-锁异常)")
 * @SWG\Property(name="umbrellas", type="integer", description="伞数量")
 * @SWG\Property(name="updated_at", type="string", description="")
 * @SWG\Property(name="valid", type="integer", description="是否有效")
  */
class EquipmentChannel extends BaseModel
{
	//
	protected $table = 'equipment_channels';
	protected $guarded = ['id'];
	protected $casts = ['valid' => 'boolean'];

    public $validateRules = [];

    public $validateMessages = [];

    public function equipment()
    {
        return $this->hasOne(Equipment::class, 'id', 'equipment_id');
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::updated(function ($model){
            if(!empty($model->equipment) && !empty($model->equipment->server_http_base)){
                $service = new EquipmentService;
                $service->init($model->equipment->server_http_base);
                $service->changeChannel($model->equipment->sn, $model->num, $model->valid);
            }
        });
    }
}
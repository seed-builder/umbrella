<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class CustomerHire
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="CustomerHire")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="customer_id", type="integer", description="customer id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="expired_at", type="string", description="到期时间")
 * @SWG\Property(name="expire_day", type="integer", description="有效期（天）")
 * @SWG\Property(name="hire_amt", type="number", description="租借费用")
 * @SWG\Property(name="hire_at", type="string", description="借伞时间")
 * @SWG\Property(name="hire_day", type="integer", description="租用时长")
 * @SWG\Property(name="hire_equipment_id", type="integer", description="equipments id 借伞设备id")
 * @SWG\Property(name="hire_site_id", type="integer", description="sites id 借伞网点id")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="margin_amt", type="number", description="缴纳的保证金")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="return_at", type="string", description="还伞时间")
 * @SWG\Property(name="return_equipment_id", type="integer", description="equipments id 还伞设备id")
 * @SWG\Property(name="return_site_id", type="integer", description="sites id 还伞网点id")
 * @SWG\Property(name="status", type="integer", description="状态(1-正常出租, 2-按时归还, 3-逾期未归还)")
 * @SWG\Property(name="umbrella_id", type="integer", description="umbrellas id")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class CustomerHire extends BaseModel
{
	//
	protected $table = 'customer_hires';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];
}

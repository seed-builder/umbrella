<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class CustomerAccountRecord
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="CustomerAccountRecord")
 * @SWG\Property(name="amt", type="number", description="流水金额")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="customer_account_id", type="integer", description="accounts id")
 * @SWG\Property(name="customer_id", type="integer", description="customer id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="remark", type="string", description="备注")
 * @SWG\Property(name="status", type="integer", description="状态(0-未完成，1-已完成, 2-取消)")
 * @SWG\Property(name="type", type="integer", description="流水类型 1-充值（收入） 2-支出")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class CustomerAccountRecord extends BaseModel
{
	//
	protected $table = 'customer_account_records';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];
}

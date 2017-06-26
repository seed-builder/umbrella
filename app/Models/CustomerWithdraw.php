<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class CustomerWithdraw
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="CustomerWithdraw")
 * @SWG\Property(name="amt", type="number", description="订单金额")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="customer_id", type="integer", description="customer id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="outer_order_sn", type="string", description="外部单号 微信生成的单号")
 * @SWG\Property(name="remark", type="string", description="备注")
 * @SWG\Property(name="sn", type="string", description="内部单号 系统内部的单号")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class CustomerWithdraw extends BaseModel
{
	//
	protected $table = 'customer_withdraws';
	protected $guarded = ['id'];

    public $validateRules = [
        'amt' => 'required|min:1',
    ];

    public $validateMessages = [
        'amt.required' => "提现金额不能为空",
        'amt.min' => "提现金额不能低于1元哦",
    ];

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class CustomerAccount
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="CustomerAccount")
 * @SWG\Property(name="balance_amt", type="number", description="余额")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="customer_id", type="integer", description="customers id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="freeze_amt", type="number", description="冻结金额")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="sn", type="string", description="账户号")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class CustomerAccount extends BaseModel
{
	//
	protected $table = 'customer_accounts';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}

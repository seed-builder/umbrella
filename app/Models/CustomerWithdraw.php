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
 * @SWG\Property(name="amt", type="number", description="提现押金")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="customer_id", type="integer", description="customer_id *customers")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="payment_id", type="integer", description="payment_id *customer_payments")
 * @SWG\Property(name="remark", type="string", description="备注")
 * @SWG\Property(name="sn", type="string", description="内部订单号 系统内部的订单号")
 * @SWG\Property(name="status", type="integer", description="状态(1-已申请，2-已打款, 3-打款失败 )")
 * @SWG\Property(name="updated_at", type="string", description="")
 */
class CustomerWithdraw extends BaseModel
{
    //
    protected $table = 'customer_withdraws';
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

    /**
     * 已申请
     */
    const STATUS_INIT = 1;

    /**
     * 已打款
     */
    const STATUS_SUCCESS = 2;

    /**
     * 打款失败
     */
    const STATUS_FAIL = 3;

    public function status()
    {
        switch ($this->status) {
            case 1:
                return '已申请';
            case 2:
                return '已打款';
            case 3:
                return '打款失败';
            default:
                return '异常';
        }
    }
}

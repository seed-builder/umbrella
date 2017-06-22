<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class CustomerPayment
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="CustomerPayment")
 * @SWG\Property(name="amt", type="number", description="订单金额")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="customer_id", type="integer", description="customer id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="outer_order_sn", type="string", description="外部订单号 支付宝|微信生成的订单号")
 * @SWG\Property(name="payment_channel", type="integer", description="支付渠道 1-微信支付 2-支付宝")
 * @SWG\Property(name="reference_id", type="integer", description="关联表id")
 * @SWG\Property(name="reference_type", type="string", description="关联表类型")
 * @SWG\Property(name="remark", type="string", description="备注")
 * @SWG\Property(name="sn", type="string", description="内部订单号 系统内部的订单号")
 * @SWG\Property(name="status", type="integer", description="支付状态（1-未支付, 2-已支付, 3-支付失败）")
 * @SWG\Property(name="type", type="integer", description="类型(1-定金支付, 2-租金支付, 3-账户充值支付")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class CustomerPayment extends BaseModel
{
	//
	protected $table = 'customer_payments';
	protected $guarded = ['id'];

    public $validateRules = [
        'amt' => 'required|numeric',
    ];

    public $validateMessages = [
        'amt.required' => "请选择一个金额",
        'amt.numeric' => '金额只能为数字',
    ];

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }

    public function type(){
        switch ($this->type){
            case 1:{
                return '押金支付';
            }
            case 2:{
                return '租金支付';
            }
            case 3:{
                return '账户充值';
            }
            default : {
                return '押金支付';
            }
        }
    }

    public function channel(){
        switch ($this->payment_channel){
            case 1:{
                return '微信支付';
            }
            case 2:{
                return '支付宝';
            }
            default : {
                return '微信支付';
            }
        }
    }


}

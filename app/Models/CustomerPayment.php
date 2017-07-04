<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use Illuminate\Support\Facades\Auth;

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
        'amt' => 'required|numeric|min:1',
    ];

    public $validateMessages = [
        'amt.required' => "请选择一个金额",
        'amt.numeric' => '金额只能为数字',
        'amt.min' => '每次充值最低1元哦~',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }


    public function type($type = null)
    {
        $type = empty($type) ? $this->type : $type;

        switch ($type) {
            case 1: {
                return '账户充值';
            }
            case 2: {
                return '押金充值';
            }
            case 3: {
                return '押金支出';
            }
            case 4: {
                return '押金退回';
            }
            case 5: {
                return '借伞租金支出';
            }
            case 6: {
                return '账户提现';
            }
        }
    }

    public function channel()
    {
        switch ($this->payment_channel) {
            case 1: {
                return '微信支付';
            }
            case 2: {
                return '支付宝';
            }
            default : {
                return '微信支付';
            }
        }
    }

    public function status(){
        switch ($this->status) {
            case 1: {
                return '未完成';
            }
            case 2: {
                return '已完成';
            }
            case 3: {
                return '已取消';
            }
            default : {
                return '未完成';
            }
        }
    }

    /**
     * 首字母 A账户 Y押金 H租用纪录
     * 第二个字母 C充值 O支出 B退回 W提现
     * @param $type
     * @return string
     */
    public function snFlag($type)
    {
        switch ($type) {
            case 1: {
                return 'AC';
            }
            case 2: {
                return 'YC';
            }
            case 3: {
                return 'YO';
            }
            case 4: {
                return 'YB';
            }
            case 5: {
                return 'HO';
            }
            case 6: {
                return 'AW';
            }
        }
    }


    public function createPayment($data){
        $user = Auth::guard('mobile')->user();

        $payment = CustomerPayment::create([
            'customer_account_id' => $user->account->id,
            'customer_id' => $user->id,
            'sn' => $this->snFlag($data['type']) . date('YmdHis') . $user->id . random_int(1000, 9999),
            'payment_channel' => 1,
            'amt' => $data['amt'],
            'type' => $data['type'],
            'status' => 1,
            'remark' => env('PROJECT_NAME').$this->type($data['type']),
        ]);

        return $payment;
    }


}

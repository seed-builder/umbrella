<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomerHire;
use App\Models\CustomerPayment;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\Umbrella;
use Illuminate\Support\Facades\Auth;

class UmbrellaController extends ApiController
{
	//
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Umbrella($attributes);
	}

    public function unlock(Request $request){
        $num = $request->input('number','');

        $umbrella = Umbrella::where('number',$num)
            ->whereNotNull('site_id')
            ->whereNotNull('equipment_id')
            ->where('status',Umbrella::STATUS_WAITING)
            ->first();
        if (empty($umbrella))
            return $this->fail('伞编码输入不正确，请核对后重试！');

//        $price_model = new Price();
//        $price = $price_model->getUsingPrice();

        $user = $request->customer;
        $hire = new CustomerHire([
            'customer_id' => $user->id,
            'umbrella_id' => $umbrella->id,
            'hire_equipment_id' => !empty($umbrella->equipment_id) ? $umbrella->equipment_id : 0 ,
            'hire_site_id' => $umbrella->site_id,
            'hire_at' => date('Y-m-d H:i:s'),
            'status' => CustomerHire::STATUS_HIRING,
            'deposit_amt' => $umbrella->price->deposit_cash,
            'expire_hours' => $umbrella->price->hire_expire_hours,
            'expired_at' => date('Y-m-d H:i:s',strtotime("+$umbrella->price->hire_expire_hours hour ")),
        ]);
        $hire->save();

        $payment = new CustomerPayment();
        $payment->createPayment([
            'type' => CustomerPayment::TYPE_OUT_DEPOSIT,
            'amt' => $hire->deposit_amt,
            'customer_id' => $hire->customer_id,
            'reference_id' => $hire->id,
//            'reference_type' => 'App\Models\CustomerHire',
            'reference_type' => 'customer_hire',
        ],CustomerPayment::STATUS_SUCCESS);

        $umbrella->status = 3 ;
        $umbrella->save();

        return $this->success($hire,'借伞成功');
    }

    /**
     * 解锁伞校验
     * @return mixed
     */
    public function unlockCheck(){
        $user = $this->request->customer;

        $price = Price::query()->where('status',1)->first();

        $date = date('Y-m-d');
        $start = $date.': 00:00:00';
        $end= $date.': 23:59:59';

        $no_finsh_count = CustomerHire::whereIn('status',[CustomerHire::STATUS_HIRING,CustomerHire::STATUS_PAYING])
            ->where('customer_id',$user->id)
            ->where('created_at','>=',$start)
            ->where('created_at','<=',$end)
            ->count();

        if ($no_finsh_count>=3){
            return $this->fail('您今日还未还的伞已超过3把，请先将租借中的伞归还');
        }

        info($user->account->deposit);
        info($price->deposit_cash);
        info($user->account->deposit < $price->deposit_cash);

        if ($user->account->deposit < $price->deposit_cash)
            return $this->fail('当前押金不足，请先充值押金');

        return $this->success('');
    }
}
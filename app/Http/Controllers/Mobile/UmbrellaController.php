<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\MobileController;
use App\Models\CustomerHire;
use App\Models\CustomerPayment;
use App\Models\Price;
use App\Models\Umbrella;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class UmbrellaController extends MobileController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Umbrella($attributes);
	}

	public function unlock(Request $request){
	    $sn = $request->input('number','');

	    $umbrella = Umbrella::where('number',$sn)->where('status',Umbrella::STATUS_WAITING)->first();
	    if (empty($umbrella))
	        return $this->fail_result('伞编码输入不正确，请核对后重试！');

	    $price_model = new Price();
        $price = $price_model->getUsingPrice();

	    $user = Auth::guard('mobile')->user();
	    $hire = new CustomerHire([
	        'customer_id' => $user->id,
	        'umbrella_id' => $umbrella->id,
	        'hire_equipment_id' => $umbrella->equipment_id,
	        'hire_site_id' => $umbrella->site_id,
	        'hire_at' => date('Y-m-d H:i:s'),
	        'status' => CustomerHire::STATUS_HIRING,
	        'deposit_amt' => $price->deposit_cash,
	        'expire_day' => $price->hire_expire_days,
	        'expired_at' => date('Y-m-d H:i:s',strtotime("+$price->hire_expire_days day")),
        ]);
        $hire->save();

	    $payment = new CustomerPayment();
        $payment->createPayment([
            'type' => CustomerPayment::TYPE_OUT_DEPOSIT,
            'amt' => $hire->deposit_amt,
            'customer_id' => $hire->customer_id,
            'reference_id' => $hire->id,
            'reference_type' => 'App\Models\CustomerHire',
        ],CustomerPayment::STATUS_SUCCESS);

        return $this->success_result('借伞成功',$hire);
    }

}

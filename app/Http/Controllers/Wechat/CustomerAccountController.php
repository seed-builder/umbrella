<?php

namespace App\Http\Controllers\Wechat;

use App\Helpers\WeChatApi;
use App\Http\Controllers\Wechat\BaseController;
use App\Models\CustomerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CustomerAccountController extends BaseController
{
	//
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new CustomerAccount($attributes);
	}

	public function get(){
	    $customer = $this->request->cutomer;

	    $account = CustomerAccount::where('customer_id',$customer->id)->first();
//	    $account = CustomerAccount::where('customer_id',78)->first();
        $account->total_deposit = number_format($account->deposit + $account->freeze_deposit,2);

	    return $this->success_result('',$account);
    }
}
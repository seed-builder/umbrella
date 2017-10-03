<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\CustomerAccount;

class CustomerAccountController extends ApiController
{
	//
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new CustomerAccount($attributes);
	}

	public function showByCustomer(){
        $customer = $this->request->cutomer;

//        $account = CustomerAccount::where('customer_id',$customer->id)->first();
	    $account = CustomerAccount::where('customer_id',78)->first();
        $account->total_deposit = number_format($account->deposit + $account->freeze_deposit,2);

        return $this->success($account);
    }
}
<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\CustomerHire;

class CustomerHireController extends ApiController
{
	//
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new CustomerHire($attributes);
	}

    public function customerNoCompletes(){
//        $customer = $this->request->customer;
//        $count = CustomerHire::where('customer_id',$customer->id)->where('status',CustomerHire::STATUS_PAYING)->count();
        $count=2;
        if ($count>0)
            return $this->fail('您当前还有 '.$count.' 把伞未还，是否要立即支付');

        return $this->success([],'');
    }
}
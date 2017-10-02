<?php

namespace App\Http\Controllers\Wechat;

use App\Helpers\WeChatApi;
use App\Http\Controllers\Wechat\BaseController;
use App\Models\CustomerHire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CustomerHireController extends BaseController
{
	//
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new CustomerHire($attributes);
	}

	public function checkNoPayHires(){
	    $customer = $this->request->customer;
        $count = CustomerHire::where('customer_id',$customer->id)->where('status',CustomerHire::STATUS_PAYING)->count();
        if ($count>0)
            return $this->fail_result('您当前还有 '.$count.' 把伞未还，是否要立即支付');

        return $this->success_result('');
    }
}
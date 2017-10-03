<?php

namespace App\Http\Controllers\Api;

use App\Helpers\WeChatPay;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\CustomerPayment;

class CustomerPaymentController extends ApiController
{
    //
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new CustomerPayment($attributes);
    }

    public function store(Request $request)
    {
        $data = $request->except('token');
//        $data['customer_id'] = 78;
        $data['customer_id'] = $request->customer->id;

        $fieldErrors = $this->validateFields($data);

        if (!empty($fieldErrors)) {
            return $this->fail($fieldErrors);
        }

        $order = $this->newEntity()->createPayment($data);

        $wxpay = new WeChatPay();
        $result = $wxpay->jsApiParameters($order);

        return $this->success([
            'order_id' => $order->id,
            'js_params' => json_decode($result)
        ]);
    }
}
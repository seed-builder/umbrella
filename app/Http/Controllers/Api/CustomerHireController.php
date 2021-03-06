<?php

namespace App\Http\Controllers\Api;

use App\Helpers\WeChatApi;
use App\Helpers\WeChatPay;
use App\Models\CustomerPayment;
use Illuminate\Database\Eloquent\Builder;
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

    public function fillQueryForIndex(Request $request, Builder &$query)
    {
        $query->with(['umbrella', 'hire_site', 'return_site']);
        parent::fillQueryForIndex($request, $query); // TODO: Change the autogenerated stub
        if (!empty($this->request->customer)) {
            $query->where('customer_id', $this->request->customer->id);
        }
    }

    public function customerNoCompletes()
    {
        $customer = $this->request->customer;
        $count = CustomerHire::where('customer_id', $customer->id)->where('status', CustomerHire::STATUS_PAYING)->count();
//        $count=2;
        if ($count > 0)
            return $this->fail('您当前还有 ' . $count . ' 把伞未还，是否要立即支付');

        return $this->success([], '');
    }

    public function pay($id)
    {
        $data = $this->request->all();

//        $fieldErrors = $this->validateFields($data);
        $fieldErrors = '';

        $hire = CustomerHire::find($id);
        if ($hire->status == CustomerHire::STATUS_COMPLETE) {
            $fieldErrors .= '该订单已完成';
        }

        if (!empty($fieldErrors)) {
            return $this->fail($fieldErrors);
        }

        $user = $this->request->customer;
        $account = $user->account;

        $data['customer_id'] = $user->id;
        $data['type'] = CustomerPayment::TYPE_OUT_RENT;
        $data['amt'] = $hire->hire_amt;
        $data['reference_id'] = $id;
//        $data['reference_type'] = 'App\Models\CustomerHire';
        $data['reference_type'] = 'customer_hire';

        $payment = new CustomerPayment();
        if ($account->balance_amt >= $hire->hire_amt) {
            $data['payment_channel'] = 3;

            $payment->createPayment($data, CustomerPayment::STATUS_SUCCESS);

            return $this->success([]);
        } else {
            $order = $payment->createPayment($data);

            $wxpay = new WeChatPay();
            $result = $wxpay->jsApiParameters($order);

            return $this->success([
                'order_id' => $order->id,
                'js_params' => json_decode($result)
            ]);
//            return $this->result(0, '', json_decode($result));
        }
    }

    public function check($id)
    {
        $hire = CustomerHire::find($id);
        if ($hire->status == CustomerHire::STATUS_HIRING) {

            $api = new WeChatApi();
            $api->wxSend('borrow', [
                'first' => '您成功借了一把共享雨伞，伞编号：' . $hire->umbrella->number . '，请好好爱护您的伞哦，记得按时归还！',
                'keyword1' => 'H' . $hire->customer->id . date('YmdHis', strtotime($hire->hire_at)),
                'keyword2' => date('Y年m月d日 H:i:s'),
                'keyword3' => $hire->hire_amt . '元',
            ], $hire->customer->openid);

            return $this->success($hire, '出伞成功');
        } else if ($hire->status == CustomerHire::STATUS_INIT) {
            return $this->fail('用户未拿伞');
        } else {
            return $this->fail('');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if ($id == 0) {
            return $this->fail('id is empty');
        } else {
            $entity = CustomerHire::with(['return_site', 'hire_site'])->find($id);
            // var_dump($entity);
            $entity->wait_pay = false;
//            info($entity);
            if ($entity->status == CustomerHire::STATUS_PAYING)
                $entity->wait_pay = true;

            return $this->success($entity);
        }
    }
}
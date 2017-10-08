<?php

namespace App\Http\Controllers\Api;

use App\Events\WechatApiEvent;
use App\Helpers\Utl;
use App\Helpers\WeChatApi;
use App\Helpers\WeChatLib\WxPayApi;
use App\Helpers\WeChatLib\WxPayEnterprise;
use App\Helpers\WeChatLib\WxPayOrderQuery;
use App\Helpers\WeChatLib\WxPayUnifiedOrder;
use App\Helpers\WeChatPay;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\Wechat\BaseController;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\CustomerHire;
use App\Models\CustomerPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Session;

class WeChatController extends ApiController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new CustomerPayment();
    }

    public function jsApiConfig(){
        $data = $this->request->all();
        $utl = new Utl();
        $config = $utl->config($data['url']);

        return $this->success($config);
    }

    /**
     * 支付成功 - 同步地址
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function payReturn($id)
    {
        $order = CustomerPayment::find($id);

        $result = $this->orderQuery($order);
        $order->outer_order_sn = $result['transaction_id'];

        if ($order->status != CustomerPayment::STATUS_INIT)
            return $this->success([]);

        event(new WechatApiEvent('支付同步回调', $result, $order));

        $order->status = CustomerPayment::STATUS_SUCCESS;
        $order->save();

        return $this->success([]);
    }

    /**
     * 支付成功 异步通知
     * @param $sign
     */
    public function payNotify($key)
    {
        $order = CustomerPayment::find(Crypt::decrypt($key));
        $result = $this->orderQuery($order);
        $order->outer_order_sn = $result['transaction_id'];

        if ($order->status != CustomerPayment::STATUS_INIT)
            dd('SUCCESS');

        event(new WechatApiEvent('支付异步回调', $result, $order));

        $order->status = CustomerPayment::STATUS_SUCCESS;
        $order->save();

        dd('SUCCESS');
    }


    /**
     * 调用接口 - 微信订单查询
     * @param $order
     * @return \App\Helpers\WeChatLib\成功时返回
     */
    protected function orderQuery($order)
    {
        $input = new WxPayOrderQuery();
        $input->SetOut_trade_no($order->sn);

        $api = new WxPayApi();
        $response = $api->orderQuery($input);

        event(new WechatApiEvent('订单查询', $response, $order->sn));

        return $response;
    }


}

<?php

namespace App\Http\Controllers\Mobile;

use App\Events\WechatApiEvent;
use App\Helpers\Utl;
use App\Helpers\WeChatApi;
use App\Helpers\WeChatLib\WxPayApi;
use App\Helpers\WeChatLib\WxPayEnterprise;
use App\Helpers\WeChatLib\WxPayOrderQuery;
use App\Helpers\WeChatLib\WxPayUnifiedOrder;
use App\Helpers\WeChatPay;
use App\Http\Controllers\MobileController;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\CustomerHire;
use App\Models\CustomerPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Session;

class WeChatController extends MobileController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new CustomerPayment();
    }

    /**
     * 微信登陆
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function authLogin(Request $request)
    {
        $code = $request->input('code', '');
        $state = $request->input('state', '');

        if (!empty($code)) {
            $api = new WeChatApi();
            $response = $api->getUserByCode($code);

            $data = [
                'nickname' => $response->nickname,
                'head_img_url' => $response->headimgurl,
                'gender' => $response->sex,
                'city' => $response->city,
                'country' => $response->country,
                'province' => $response->province,
                'openid' => $response->openid,
            ];

            $user = Customer::query()->where('openid', $response->openid)->first();

            if (!empty($user)) {
                $user->fill($data);
                $user->save();

            } else {
                $user = Customer::create($data);
            }

            //创建资金账户
            if (empty($user->account)) {
                CustomerAccount::create([
                    'sn' => 'A' . date('YmdHis') . $user->id . random_int(10, 99),
                    'customer_id' => $user->id
                ]);
            }

            Auth::guard('mobile')->login($user);

            if (empty($user->mobile))
                return redirect(url('mobile/register'));

            if ($state != 'CC') {
                $url = str_replace("AA", "/", $state);

                return redirect(url($url));
            }

            return redirect(url('mobile/home/map'));
        }
    }

    /**
     * 通用创建订单（资金纪录）方法
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrder(Request $request)
    {
        $data = $request->all();

        $fieldErrors = $this->validateFields($data);

        if (!empty($fieldErrors)) {
            return $this->fail_result($fieldErrors);
        }

        $order = $this->newEntity()->createPayment($data);

        $result = $this->wxpay($order);
        return $this->result(0, '', [
            'order_id' => $order->id,
            'js_params' => json_decode($result)
        ]);
    }

    /**
     * 支付成功 - 同步地址
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentSuccess($id)
    {
        $order = CustomerPayment::find($id);

        $result = $this->orderQuery($order);
        $order->outer_order_sn = $result['transaction_id'];

        if ($order->status != CustomerPayment::STATUS_INIT)
            return $this->success_result('');

        event(new WechatApiEvent('支付同步回调', $result, $order));

        $order->status = CustomerPayment::STATUS_SUCCESS;
        $order->save();

        return $this->success_result('');
    }

    /**
     * 支付成功 异步通知
     * @param $sign
     */
    public function paymentNotify($sign)
    {
        $order = CustomerPayment::find(Crypt::decrypt($sign));
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
     * 提现
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function withdraw(Request $request)
    {
        $data = $request->all();
        $user = Auth::guard('mobile')->user();

        $data['type'] = CustomerPayment::TYPE_OUT_WITHDRAW;

        $fieldErrors = $this->validateFields($data);

        if ($user->account->deposit < $data['amt']) {
            $fieldErrors .= '您当前可提现押金只有' . $user->account->deposit . '元,不能超过哦！';
        }

        if (!empty($fieldErrors)) {
            return $this->fail_result($fieldErrors);
        }

        $withdraw = $this->newEntity()->createPayment($data);

        $result = $this->epPay($withdraw);
        if (empty($result['payment_no'])) {
            $withdraw->status = CustomerPayment::STATUS_FAIL;
            $withdraw->save();

            return $this->fail_result('提交提现申请失败，请联系客服人员处理');
        }

        $withdraw->outer_order_sn = $result['payment_no'];
        $withdraw->status = CustomerPayment::STATUS_SUCCESS;
        $withdraw->save();

        return $this->success_result('已提交提现申请，系统会尽快为您处理');
    }


    /**
     * 租金支付
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function hirePay(Request $request, $id)
    {
        $data = $request->all();

        $fieldErrors = $this->validateFields($data);

        $hire = CustomerHire::find($id);
        if ($hire->status == CustomerHire::STATUS_COMPLETE) {
            $fieldErrors .= '该订单已完成';
        }

        if (!empty($fieldErrors)) {
            return $this->fail_result($fieldErrors);
        }

        $user = Auth::guard('mobile')->user();
        $account = $user->account;

        $data['type'] = CustomerPayment::TYPE_OUT_RENT;
        $data['reference_id'] = $id;
//        $data['reference_type'] = 'App\Models\CustomerHire';
        $data['reference_type'] = 'customer_hire';

        if ($account->balance_amt >= $data['amt']) {
            $data['payment_channel'] = 3;

            $this->newEntity()->createPayment($data, CustomerPayment::STATUS_SUCCESS);

            return $this->result(0, '', null);
        } else {
            $order = $this->newEntity()->createPayment($data);
            $result = $this->wxpay($order);

            return $this->result(0, '', [
                'order_id' => $order->id,
                'js_params' => json_decode($result)
            ]);
//            return $this->result(0, '', json_decode($result));
        }


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

    /**
     * 调用接口 - 微信生成订单 获取支付JsApiParameters
     * @param $order
     * @return string
     */
    protected function wxpay($order)
    {
        $input = new WxPayUnifiedOrder();

        $body = env('PROJECT_NAME') . $order->type();
        //         $price = $order->amt * 100; // 微信支付金额单位为分
        $price = 1; // 测试环境

        $notify_url = env('WECHATPAY_NOTIFY_URL') . '/' . Crypt::encrypt($order->id);

        $input->SetBody($body);
        $input->SetAttach($order->sn . "," . $order->customer_id);
        $input->SetOut_trade_no($order->sn);
        $input->SetTotal_fee($price);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetNotify_url($notify_url);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($order->customer->openid);

        $pay = new WeChatPay();
        $out_order = $pay->unifiedOrder($input);

        $jsApiParams = $pay->GetJsApiParameters($out_order);


        return $jsApiParams;
    }

    /**
     * 调用接口 - 企业向个人付款
     * @param $withdraw
     * @return array
     */
    protected function epPay($withdraw)
    {
        $input = new WxPayEnterprise();

        $input->setOpenid($withdraw->customer->openid);
        $input->setCheck_name('NO_CHECK');
        $input->setPartner_trade_no($withdraw->sn);
        $input->setAmount($withdraw->amt * 100);
        $input->setDesc(env('PROJECT_NAME') . '账户提现');

        $pay = new WeChatPay();
        $result = $pay->enterprisePay($input);

        event(new WechatApiEvent('企业向个人付款', $result, $input));

        return $result;
    }


    public function test()
    {
        $order = CustomerPayment::find(1);
        $rs = $this->orderQuery($order);
//        $order->status = 2;
//        $order->save();
        event(new WechatApiEvent('', 'xx', $rs, 'x'));
        dd($rs);
        foreach ($rs as $k => $v) {
            if (strpos('SUCCESS', $k) !== false || strpos('SUCCESS', $v) !== false) {
                dd(123123);
            }
        }
        dd(1);
//        dd(storage_path() . env('WECHAT_CERTPATH'));
//        $this->epPay(1);

    }
}

<?php
namespace App\Http\Controllers\Mobile;

use App\Helpers\WeChatApi;
use App\Helpers\WeChatLib\WxPayApi;
use App\Helpers\WeChatLib\WxPayException;
use App\Helpers\WeChatLib\WxPayJsApiPay;
use App\Helpers\WeChatLib\WxPayOrderQuery;
use App\Helpers\WeChatLib\WxPayUnifiedOrder;
use App\Helpers\WeChatPay;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MobileController;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\CustomerPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class WeChatController extends MobileController
{
    public  function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new CustomerPayment();
    }

    public function authLogin(Request $request)
    {
        $code = $request->input('code', '');

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

            return redirect(url('mobile/home/map'));
        }
    }

    /*
     * 创建订单
     */
    public function createOrder(Request $request)
    {
        $data = $request->all();
        $user = Auth::guard('mobile')->user();

        $fieldErrors = $this->validateFields($data);

        if (!empty($fieldErrors)) {
            return $this->fail_result($fieldErrors);
        }

        $order = CustomerPayment::create([
            'sn' => 'O' . date('YmdHis') . $user->id . random_int(1000, 9999),
            'customer_id' => $user->id,
            'payment_channel' => 1,
            'amt' => $data['amt'],
            'status' => 1,
            'type' => $data['type'],
        ]);

        $result = $this->wxpay($order);
        return $this->result(0,'',json_decode($result));
    }

    /*
     * 支付成功 - 同步地址
     */
    public function paySuccess($id){
        $order = CustomerPayment::find($id);

        $out_order = $this->orderQuery($order);
        dd($out_order);
    }

    /*
     * 微信订单查询
     */
    public function orderQuery($order){
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($order->sn);

        $api = new WxPayApi();
        return $api->orderQuery($input);
    }

    /*
     * 微信下单 获取jsApiParams
     */
    protected function wxpay($order)
    {
        $input = new WxPayUnifiedOrder();

        $body = env('PROJECT_NAME') . $order->type();
        //         $price = $order->amt * 100; // 微信支付金额单位为分
        $price = 1; // 测试环境

        $input->SetBody($body);
        $input->SetAttach($order->sn . "," . $order->customer_id);
        $input->SetOut_trade_no($order->sn);
        $input->SetTotal_fee($price);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetNotify_url(env('WECHATPAY_NOTIFY_URL'));
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($order->customer->openid);

        $pay = new WeChatPay();
        $out_order = $pay->unifiedOrder($input);

        $jsApiParams = $this->GetJsApiParameters($out_order);


        return $jsApiParams;
    }

    /*
     * 获取微信支付JsApi参数
     */
    protected function GetJsApiParameters($UnifiedOrderResult)
    {
        if(!array_key_exists("appid", $UnifiedOrderResult)
            || !array_key_exists("prepay_id", $UnifiedOrderResult)
            || $UnifiedOrderResult['prepay_id'] == "")
        {
            throw new WxPayException("参数错误");
        }
        $jsapi = new WxPayJsApiPay();
        $jsapi->SetAppid($UnifiedOrderResult["appid"]);
        $timeStamp = time();
        $jsapi->SetTimeStamp("$timeStamp");
        $wxPayApi = new WxPayApi();
        $jsapi->SetNonceStr($wxPayApi->getNonceStr());
        $jsapi->SetPackage("prepay_id=" . $UnifiedOrderResult['prepay_id']);
        $jsapi->SetSignType("MD5");
        $jsapi->SetPaySign($jsapi->MakeSign());
        $parameters = json_encode($jsapi->GetValues());
        return $parameters;
    }
}

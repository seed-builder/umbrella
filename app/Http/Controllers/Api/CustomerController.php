<?php

namespace App\Http\Controllers\Api;

use App\Helpers\WeChatApi;
use App\Models\CustomerAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\Customer;
use Illuminate\Support\Facades\Cache;

class CustomerController extends ApiController
{
	//
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Customer($attributes);
	}

    /**
     * 微信登陆
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function login()
    {
//        $token = md5(78);
//
//        Cache::put($token,78, 120);
//
//        return $this->success([
//            'customer' => Customer::find(78),
//            'token' => $token
//        ],'' );
//
//        return ;
//
        $data = $this->request->all();
        if (empty($data['code']))
            return $this->fail('请在微信端浏览器中打开');


        $api = new WeChatApi();
        $response = $api->getUserByCode($data['code']);

        $info = [
            'nickname' => $response->nickname,
            'head_img_url' => $response->headimgurl,
            'gender' => $response->sex,
            'city' => $response->city,
            'country' => $response->country,
            'province' => $response->province,
            'openid' => $response->openid,
        ];

        $customer = Customer::query()->where('openid',$response->openid)->first();
        if (empty($customer)){
            $customer = new Customer();
        }

        $customer->fill($info);
        $customer->save();

        //创建资金账户
        if (empty($customer->account)) {
            CustomerAccount::create([
                'sn' => 'A' . date('YmdHis') . $customer->id . random_int(10, 99),
                'customer_id' => $customer->id
            ]);
        }

        $token = md5($customer->id);

        Cache::put($token, $customer->id, 120);

        if (empty($customer->mobile))
            return $this->success( [
                'customer' => $customer,
                'token' => $token,
                'url' => '/register'
            ],'');

        return $this->success_result([
            'customer' => $customer,
            'token' => $token
        ], '');
    }
}
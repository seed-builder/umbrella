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
            'login_time' => 0,
        ];

        $customer = Customer::query()->where('openid',$response->openid)->first();
        if (empty($customer)){
            $customer = new Customer();
        }

        $customer->fill($info);
        $customer->login_time = $customer->login_time+1;
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

        return $this->success([
            'customer' => $customer,
            'token' => $token
        ], '');
    }

    public function info(){
        $id = $this->request->input('id', 0);
        if(!empty($id)) {
            $customer = Customer::find($id);
        }else{
            $customer = $this->request->customer;
        }
        return $this->success($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $entity = $this->request->customer;
        if(empty($entity)){
            $entity = $this->newEntity()->newQuery()->find($id);
        }
        $data = $request->all();
        unset($data['_sign']);
        unset($data['token']);
        $entity->fill($data);
        $re = $entity->save();
        return $re ? $this->success($re) : $this->fail('update fail!');
    }

}
<?php

namespace App\Http\Controllers\Api;

use App\Helpers\WeChatApi;
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

    public function login()
    {
        $data = $this->request->all();
        if (empty($data['code']))
            return $this->fail('请在微信端浏览器中打开');


        $api = new WeChatApi();
        $response = $api->getUserByCode($data['code']);

        $info = [
            'wechat_name' => $response->nickname,
            'head_img_url' => $response->headimgurl,
            'openid' => $response->openid,
        ];

        if (empty($account))
            return $this->success_result('', [
                'openid' => $info['openid'],
                'token' => null
            ]);

        $account->fill($info);
        $account->save();

        $token = md5($account->id);

        Cache::put($token, $account->id, 120);

        return $this->success_result('', [
            'openid' => $info['openid'],
            'token' => $token
        ]);
    }
}
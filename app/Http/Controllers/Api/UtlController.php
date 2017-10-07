<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sms;
use Dysms;

class UtlController extends ApiController
{
    //
	/**
	 * 发送验证码短信
	 * @param Request $request
	 * @return Response
	 */
	public function sendVerifyCode(Request $request){
		$phone = $request->input('phone');
		$resp = Dysms::sendVerifyCode($phone);
		return !empty($resp) && $resp->Code == 'OK' ? $this->success($resp): $this->fail('fail'); //response(['result' => $resp], $status);
	}

	/**
	 * 判断验证码是否正确
	 * @param Request $request
	 * @return Response
	 */
	public function checkVerifyCode(Request $request){
		$phone = $request->input('phone');
		$code = $request->input('code');
		$resp = Dysms::checkVerifyCode($phone, $code);
		return $resp ? $this->success($resp):$this->fail('fail');//response(['success' => $resp], $status);
	}

    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
    }
}

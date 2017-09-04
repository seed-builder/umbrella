<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sms;
use Dysms;

class UtlController extends Controller
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
		//var_dump($resp);
		$status = !empty($resp) && $resp->Code == 'OK' ? 200 : 400;
		return response(['result' => $resp], $status);
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
		$status = $resp ? 200 : 400;
		return response(['success' => $resp], $status);
	}

}

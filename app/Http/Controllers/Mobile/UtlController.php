<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sms;

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
		$resp = Sms::verify($phone);
		dd($resp);
		///var_dump($resp);
		$status = !empty($resp->result) && $resp->result->success ? 200 : 400;
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
		$resp = Sms::checkVerifyCode($phone, $code);
		$status = $resp ? 200 : 400;
		return response(['success' => $resp], $status);
	}

}

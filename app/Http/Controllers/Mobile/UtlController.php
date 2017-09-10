<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function sendVerifyCode(Request $request)
    {
        $phone = $request->input('phone');
        if (empty($phone))
            return response()->json(['code' => 500, 'result' => '请填写您的手机号']);

        $resp = Dysms::sendVerifyCode($phone);
//        $status = !empty($resp->result) && $resp->result->success ? 200 : 400;
        return response()->json(['code' => 0, 'result' => '']);
    }

    /**
     * 判断验证码是否正确
     * @param Request $request
     * @return Response
     */
    public function checkVerifyCode(Request $request)
    {
        $phone = $request->input('phone');
        $code = $request->input('code');
        $resp = Dysms::checkVerifyCode($phone, $code);
        $status = $resp ? 200 : 400;
        return response(['success' => $resp], $status);
    }

}

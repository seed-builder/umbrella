<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\MobileController;
use App\Models\CustomerHire;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Dysms;

class HomeController extends MobileController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
    }

    public function index(){
        return view('mobile.home.index');
    }


    public function showRegister(){
        return view('mobile.home.register');
    }

    public function register(Request $request){
        $phone = $request->input('phone');
        $code = $request->input('code');
        $resp = Dysms::checkVerifyCode($phone, $code);

        if (!$resp)
            return $this->fail_result('验证码错误！');

        $user = Auth::guard('mobile')->user();
        $user->mobile = $phone;
        $user->save();

        return redirect(url('mobile/home/map'));
    }

    public function map(){
        $user = Auth::guard('mobile')->user();
        $price = Price::query()->where('status',1)->first();

        return view('mobile.home.map',compact('user','price'));
    }

    public function checkNoPayOrder(){
        $user = Auth::guard('mobile')->user();

        $count = CustomerHire::where('customer_id',$user->id)->where('status',CustomerHire::STATUS_PAYING)->count();

        if ($count>0)
            return $this->fail_result('您当前还有 '.$count.' 把伞未还，是否要立即支付');

        return $this->success_result('');
    }
}

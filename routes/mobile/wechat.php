<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-12
 * Time: 17:43
 */

Route::get('auth-login', ['uses' => 'WeChatController@authLogin']);
Route::any('wechat-payment/notify/{sign}', ['uses' => 'WeChatController@paymentNotify']);
Route::any('wechat-payment/pay-success/{id}', ['uses' => 'WeChatController@paymentSuccess']);//支付成功后 用户手动点确定
Route::any('wechat-payment/create-order', ['uses' => 'WeChatController@createOrder']);
Route::any('wechat-payment/withdraw', ['uses' => 'WeChatController@withdraw']);
Route::any('wechat-payment/hire-pay/{id}', ['uses' => 'WeChatController@hirePay']);

Route::any('wechat-payment/test', ['uses' => 'WeChatController@test']);

Route::any('wechat/test',function (){
    $api = new \App\Helpers\WeChatApi();
    $api->wxSend('return', [
        'first' => '您所借的共享雨伞已经归还，感谢您的使用！',
        'keyword1' => 'xxx',
        'keyword2' => date('Y年m月d日 H:i:s'),
        'keyword3' => '10元',
        'keyword4' => '10元',
    ], 'oxY5Aw2AGdwwiWtU8uyrO34ROP_w');

    $api->wxSend('borrow', [
        'first' => '您成功借了一把共享雨伞 请好好爱护您的伞哦，记得按时归还！',
        'keyword1' => 'xxx',
        'keyword2' => date('Y年m月d日 H:i:s'),
        'keyword3' =>  '10元',
    ], 'oxY5Aw2AGdwwiWtU8uyrO34ROP_w');

    $api->wxSend('expired', [
        'first' => '已超过您的最迟还伞期限！',
        'keyword1' => 'xx',
        'keyword2' => 'xx',
        'remark' => '押金已经从您的账户里扣除，感谢您的使用！'
    ], 'oxY5Aw2AGdwwiWtU8uyrO34ROP_w');
});

Route::any('wechat/test1',function (){
    $wxpay = new \App\Helpers\WeChatPay();
    $date = date('Y-m-d', strtotime('-1 day'));

    $fails = \App\Models\CustomerWithdraw::query()->where('status', \App\Models\CustomerWithdraw::STATUS_FAIL)->get();
    foreach ($fails as $fail) {
        $rs = $wxpay->enterprisePay($fail);
//        $this->result($rs,$fail);
    }
    $withdraws = \App\Models\CustomerWithdraw::query()
        ->where('created_at', '>=',$date . ' 00:00:00')
        ->where('created_at','<=', $date . ' 23:59:59')
        ->where('status', \App\Models\CustomerWithdraw::STATUS_INIT)
        ->get();
//    dd($withdraws);
    foreach ($withdraws as $withdraw) {
        $api = new \App\Helpers\WeChatApi();
        $rs = $api->epPay($withdraw);
//        $rs = $wxpay->enterprisePay($wxOrder);
        dump($withdraw);
        dump($rs);
        dd(1);
    }
});


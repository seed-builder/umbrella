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

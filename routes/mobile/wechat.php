<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-12
 * Time: 17:43
 */

Route::get('auth-login', ['uses' => 'WeChatController@authLogin']);
Route::any('wechat-payment/notify', ['uses' => 'WeChatController@paymentNotify']);
Route::any('wechat-payment/redirect', ['uses' => 'WeChatController@paymentRedirect']);
Route::any('wechat-payment/create-order', ['uses' => 'WeChatController@createOrder']);
<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-12
 * Time: 17:43
 */

Route::get('customer/view', ['uses' => 'CustomerController@view']);
Route::get('customer/edit', ['uses' => 'CustomerController@edit']);
Route::post('customer/edit', ['uses' => 'CustomerController@update']);
Route::get('customer/test', function (){
    $user = \App\Models\Customer::find(1);
//    \Illuminate\Support\Facades\Session::put('wechat_user',$user);
//    dd(\Illuminate\Support\Facades\Session::get('wechat_user'));
    \Illuminate\Support\Facades\Auth::guard('mobile')->login($user);
});
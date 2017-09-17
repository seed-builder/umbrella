<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-07
 * Time: 13:01
 */


Route::get('wechat-menu/index', ['uses' => 'WechatMenuController@index']);
Route::any('wechat-menu/store', ['uses' => 'WechatMenuController@store']);
Route::any('wechat-menu/pro-store', ['uses' => 'WechatMenuController@proStore']);
Route::get('wechat-menu/delete', ['uses' => 'WechatMenuController@delete']);
Route::post('wechat-menu/update', ['uses' => 'WechatMenuController@update']);

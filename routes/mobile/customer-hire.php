<?php

Route::get('customer-hire/index', ['uses' => 'CustomerHireController@showIndex']);
Route::post('customer-hire/pagination', ['uses' => 'CustomerHireController@pagination']);
Route::get('customer-hire/view/{id}', ['uses' => 'CustomerHireController@view']);
Route::get('customer-hire/store', ['uses' => 'CustomerHireController@store']);
Route::get('customer-hire/check/{id}', ['uses' => 'CustomerHireController@check']);
Route::get('customer-hire/return-wechat-send/{id}', ['uses' => 'CustomerHireController@returnWechatSend']);

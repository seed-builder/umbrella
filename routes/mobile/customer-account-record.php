<?php

Route::get('customer-account-record/index', ['uses' => 'CustomerAccountRecordController@showIndex']);
Route::post('customer-account-record/index', ['uses' => 'CustomerAccountRecordController@index']);
Route::get('customer-account-record/view/{id}', ['uses' => 'CustomerAccountRecordController@view']);
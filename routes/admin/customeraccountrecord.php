<?php
Route::get('customer-account-record/pagination', ['uses' => 'CustomerAccountRecordController@pagination']);
Route::get('customer-account-record/create', ['uses' => 'CustomerAccountRecordController@create']);
Route::post('customer-account-record/store', ['uses' => 'CustomerAccountRecordController@store']);
Route::get('customer-account-record/edit/{id}', ['uses' => 'CustomerAccountRecordController@edit']);
Route::post('customer-account-record/edit/{id}', ['uses' => 'CustomerAccountRecordController@update']);
Route::get('customer-account-record/show/{id}', ['uses' => 'CustomerAccountRecordController@show']);
Route::get('customer-account-record/delete/{id}', ['uses' => 'CustomerAccountRecordController@destroy']);
Route::resource('customer-account-record', 'CustomerAccountRecordController');
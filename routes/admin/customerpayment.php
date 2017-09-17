<?php
Route::get('customer-payment/pagination', ['uses' => 'CustomerPaymentController@pagination']);
Route::get('customer-payment/create', ['uses' => 'CustomerPaymentController@create']);
Route::post('customer-payment/store', ['uses' => 'CustomerPaymentController@store']);
Route::get('customer-payment/edit/{id}', ['uses' => 'CustomerPaymentController@edit']);
Route::post('customer-payment/edit/{id}', ['uses' => 'CustomerPaymentController@update']);
Route::get('customer-payment/show/{id}', ['uses' => 'CustomerPaymentController@show']);
Route::get('customer-payment/delete/{id}', ['uses' => 'CustomerPaymentController@destroy']);
Route::get('customer-payment/export-excel', ['uses' => 'CustomerPaymentController@exportExcel']);
Route::resource('customer-payment', 'CustomerPaymentController');
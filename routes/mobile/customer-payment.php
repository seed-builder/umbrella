<?php

Route::get('customer-payment/index', ['uses' => 'CustomerPaymentController@index']);
Route::post('customer-payment/pagination', ['uses' => 'CustomerPaymentController@pagination']);
Route::get('customer-payment/view/{id}', ['uses' => 'CustomerPaymentController@view']);
Route::post('customer-payment/create', ['uses' => 'CustomerPaymentController@store']);
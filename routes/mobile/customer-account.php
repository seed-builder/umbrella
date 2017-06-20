<?php

Route::get('customer-account/index', ['uses' => 'CustomerAccountController@index']);
Route::get('customer/edit', ['uses' => 'CustomerController@edit']);
Route::post('customer/edit', ['uses' => 'CustomerController@update']);
<?php

Route::get('customer-account/index', ['uses' => 'CustomerAccountController@index']);
//Route::get('customer-account/withdraw', ['uses' => 'CustomerAccountController@withdraw']);
Route::get('customer-account/deposit', ['uses' => 'CustomerAccountController@deposit']);
Route::get('customer-account/check', ['uses' => 'CustomerAccountController@check']);
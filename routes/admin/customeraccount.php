<?php
Route::get('customer-account/pagination', ['uses' => 'CustomerAccountController@pagination']);
Route::get('customer-account/create', ['uses' => 'CustomerAccountController@create']);
Route::post('customer-account/store', ['uses' => 'CustomerAccountController@store']);
Route::get('customer-account/edit/{id}', ['uses' => 'CustomerAccountController@edit']);
Route::post('customer-account/edit/{id}', ['uses' => 'CustomerAccountController@update']);
Route::get('customer-account/show/{id}', ['uses' => 'CustomerAccountController@show']);
Route::get('customer-account/delete/{id}', ['uses' => 'CustomerAccountController@destroy']);
Route::resource('customer-account', 'CustomerAccountController');
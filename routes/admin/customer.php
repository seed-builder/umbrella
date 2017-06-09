<?php
Route::get('customer/pagination', ['uses' => 'CustomerController@pagination']);
Route::get('customer/create', ['uses' => 'CustomerController@create']);
Route::post('customer/store', ['uses' => 'CustomerController@store']);
Route::get('customer/edit/{id}', ['uses' => 'CustomerController@edit']);
Route::post('customer/edit/{id}', ['uses' => 'CustomerController@update']);
Route::get('customer/show/{id}', ['uses' => 'CustomerController@show']);
Route::resource('customer', 'CustomerController');
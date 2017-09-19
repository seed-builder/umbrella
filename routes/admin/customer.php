<?php
Route::get('customer/pagination', ['uses' => 'CustomerController@pagination']);
Route::get('customer/create', ['uses' => 'CustomerController@create']);
Route::post('customer/store', ['uses' => 'CustomerController@store']);
Route::get('customer/edit/{id}', ['uses' => 'CustomerController@edit']);
Route::post('customer/edit/{id}', ['uses' => 'CustomerController@update']);
Route::get('customer/show/{id}', ['uses' => 'CustomerController@show']);
Route::get('customer/delete/{id}', ['uses' => 'CustomerController@destroy']);
Route::get('customer/export-excel', ['uses' => 'CustomerController@exportExcel']);
Route::resource('customer', 'CustomerController');
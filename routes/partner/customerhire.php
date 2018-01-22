<?php
Route::get('customer-hire/pagination', ['uses' => 'CustomerHireController@pagination']);
Route::get('customer-hire/create', ['uses' => 'CustomerHireController@create']);
Route::post('customer-hire/create', ['uses' => 'CustomerHireController@store']);
Route::get('customer-hire/edit/{id}', ['uses' => 'CustomerHireController@edit']);
Route::post('customer-hire/edit/{id}', ['uses' => 'CustomerHireController@update']);
Route::get('customer-hire/show/{id}', ['uses' => 'CustomerHireController@show']);
Route::get('customer-hire/delete/{id}', ['uses' => 'CustomerHireController@destroy']);
Route::get('customer-hire/export-excel', ['uses' => 'CustomerHireController@exportExcel']);
Route::resource('customer-hire', 'CustomerHireController');
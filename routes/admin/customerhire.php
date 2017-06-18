<?php
Route::get('customer-hire/pagination', ['uses' => 'CustomerHireController@pagination']);
Route::get('customer-hire/create', ['uses' => 'CustomerHireController@create']);
Route::post('customer-hire/store', ['uses' => 'CustomerHireController@store']);
Route::get('customer-hire/edit/{id}', ['uses' => 'CustomerHireController@edit']);
Route::post('customer-hire/edit/{id}', ['uses' => 'CustomerHireController@update']);
Route::get('customer-hire/show/{id}', ['uses' => 'CustomerHireController@show']);
Route::get('customer-hire/delete/{id}', ['uses' => 'CustomerHireController@destroy']);
Route::resource('customer-hire', 'CustomerHireController');
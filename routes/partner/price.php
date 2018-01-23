<?php
Route::get('price/pagination', ['uses' => 'PriceController@pagination']);
Route::get('price/create', ['uses' => 'PriceController@create']);
Route::post('price/create', ['uses' => 'PriceController@store']);
Route::get('price/edit/{id}', ['uses' => 'PriceController@edit']);
Route::post('price/edit/{id}', ['uses' => 'PriceController@update']);
Route::get('price/show/{id}', ['uses' => 'PriceController@show']);
Route::get('price/delete/{id}', ['uses' => 'PriceController@destroy']);
Route::resource('price', 'PriceController');
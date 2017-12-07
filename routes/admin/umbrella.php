<?php
Route::get('umbrella/pagination', ['uses' => 'UmbrellaController@pagination']);
Route::get('umbrella/create', ['uses' => 'UmbrellaController@create']);
Route::post('umbrella/store', ['uses' => 'UmbrellaController@store']);
Route::get('umbrella/edit/{id}', ['uses' => 'UmbrellaController@edit']);
Route::post('umbrella/edit/{id}', ['uses' => 'UmbrellaController@update']);
Route::get('umbrella/show/{id}', ['uses' => 'UmbrellaController@show']);
Route::get('umbrella/delete/{id}', ['uses' => 'UmbrellaController@destroy']);
Route::post('umbrella/import-excel', ['uses' => 'UmbrellaController@importExcel']);
Route::post('umbrella/batch-price', ['uses' => 'UmbrellaController@batchPrice']);
Route::get('umbrella/down-template', ['uses' => 'UmbrellaController@downTemplate']);
Route::get('umbrella/reset', ['uses' => 'UmbrellaController@reset']);

Route::resource('umbrella', 'UmbrellaController');
<?php
Route::get('message/pagination', ['uses' => 'MessageController@pagination']);
Route::get('message/create', ['uses' => 'MessageController@create']);
Route::post('message/store', ['uses' => 'MessageController@store']);
Route::get('message/edit/{id}', ['uses' => 'MessageController@edit']);
Route::post('message/edit/{id}', ['uses' => 'MessageController@update']);
Route::get('message/show/{id}', ['uses' => 'MessageController@show']);
Route::get('message/delete/{id}', ['uses' => 'MessageController@destroy']);
Route::get('message/get-tops', ['uses' => 'MessageController@getTops']);
Route::resource('message', 'MessageController');
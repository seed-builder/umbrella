<?php
Route::get('help/pagination', ['uses' => 'HelpController@pagination']);
Route::get('help/create', ['uses' => 'HelpController@create']);
Route::post('help/store', ['uses' => 'HelpController@store']);
Route::get('help/edit/{id}', ['uses' => 'HelpController@edit']);
Route::post('help/edit/{id}', ['uses' => 'HelpController@update']);
Route::get('help/show/{id}', ['uses' => 'HelpController@show']);
Route::get('help/delete/{id}', ['uses' => 'HelpController@destroy']);
Route::resource('help', 'HelpController');
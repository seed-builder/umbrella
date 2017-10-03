<?php
Route::get('sys-config/pagination', ['uses' => 'SysConfigController@pagination']);
Route::get('sys-config/create', ['uses' => 'SysConfigController@create']);
Route::post('sys-config/store', ['uses' => 'SysConfigController@store']);
Route::get('sys-config/edit/{id}', ['uses' => 'SysConfigController@edit']);
Route::post('sys-config/edit/{id}', ['uses' => 'SysConfigController@update']);
Route::get('sys-config/show/{id}', ['uses' => 'SysConfigController@show']);
Route::get('sys-config/delete/{id}', ['uses' => 'SysConfigController@destroy']);
Route::resource('sys-config', 'SysConfigController');
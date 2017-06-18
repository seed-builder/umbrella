<?php
Route::get('sys-log/pagination', ['uses' => 'SysLogController@pagination']);
Route::get('sys-log/create', ['uses' => 'SysLogController@create']);
Route::post('sys-log/store', ['uses' => 'SysLogController@store']);
Route::get('sys-log/edit/{id}', ['uses' => 'SysLogController@edit']);
Route::post('sys-log/edit/{id}', ['uses' => 'SysLogController@update']);
Route::get('sys-log/show/{id}', ['uses' => 'SysLogController@show']);
Route::get('sys-log/delete/{id}', ['uses' => 'SysLogController@destroy']);
Route::resource('sys-log', 'SysLogController');
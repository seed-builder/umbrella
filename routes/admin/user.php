<?php
Route::get('user/pagination', ['uses' => 'UserController@pagination']);
Route::get('user/reset-pwd', ['uses' => 'UserController@resetPwd']);
Route::match(['get', 'post'], 'user/{id}/set-role', ['uses' => 'UserController@setRole']);
Route::match(['get', 'post'], 'user/{id}/set-position', ['uses' => 'UserController@setPosition']);
Route::get('user/batch-user-role', ['uses' => 'UserController@batchUserRole']);
Route::get('user/logout', ['uses' => 'UserController@logout']);
Route::post('user/batch-user-role', ['uses' => 'UserController@batchUserRole']);
Route::resource('user', 'UserController');
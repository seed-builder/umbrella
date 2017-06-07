<?php

Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
Route::post('login', ['uses' => 'LoginController@login']);
Route::get('logout', ['uses' => 'LoginController@logout']);

<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-12
 * Time: 17:43
 */

Route::get('home/index', ['uses' => 'HomeController@index']);
Route::get('home/map', ['uses' => 'HomeController@map']);
Route::get('home/check-npo', ['uses' => 'HomeController@checkNoPayOrder']);
Route::get('send', ['uses' => 'UtlController@sendVerifyCode']);
Route::get('register', ['uses' => 'HomeController@showRegister']);
Route::post('register', ['uses' => 'HomeController@Register']);

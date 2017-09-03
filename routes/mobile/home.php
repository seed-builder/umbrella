<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-12
 * Time: 17:43
 */

Route::get('home/index', ['uses' => 'HomeController@index']);
Route::get('home/map', ['uses' => 'HomeController@map']);
Route::get('send', ['uses' => 'UtlController@sendVerifyCode']);

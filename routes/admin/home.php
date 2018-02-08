<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-07
 * Time: 13:01
 */


Route::get('/', ['uses' => 'HomeController@index']);

Route::get('/charts/user', ['uses' => 'HomeController@chartsUser']);
Route::get('/charts/hire', ['uses' => 'HomeController@chartsHire']);
Route::get('/charts/payment', ['uses' => 'HomeController@chartsPayment']);
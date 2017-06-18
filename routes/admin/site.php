<?php
Route::get('site/pagination', ['uses' => 'SiteController@pagination']);
Route::get('site/create', ['uses' => 'SiteController@create']);
Route::post('site/store', ['uses' => 'SiteController@store']);
Route::get('site/edit/{id}', ['uses' => 'SiteController@edit']);
Route::post('site/edit/{id}', ['uses' => 'SiteController@update']);
Route::get('site/show/{id}', ['uses' => 'SiteController@show']);
Route::get('site/delete/{id}', ['uses' => 'SiteController@destroy']);
Route::resource('site', 'SiteController');
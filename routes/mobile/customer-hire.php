<?php

Route::get('customer-hire/index', ['uses' => 'CustomerHireController@showIndex']);
Route::post('customer-hire/pagination', ['uses' => 'CustomerHireController@pagination']);
Route::get('customer-hire/view/{id}', ['uses' => 'CustomerHireController@view']);

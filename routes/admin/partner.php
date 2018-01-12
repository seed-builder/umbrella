<?php
Route::get('partner/pagination', ['uses' => 'PartnerController@pagination']);
Route::get('partner/create', ['uses' => 'PartnerController@create']);
Route::post('partner/store', ['uses' => 'PartnerController@store']);
Route::get('partner/edit/{id}', ['uses' => 'PartnerController@edit']);
Route::post('partner/edit/{id}', ['uses' => 'PartnerController@update']);
Route::get('partner/show/{id}', ['uses' => 'PartnerController@show']);
Route::get('partner/delete/{id}', ['uses' => 'PartnerController@destroy']);
Route::get('partner/change-status/{id}', ['uses' => 'PartnerController@changeStatus']);
Route::resource('partner', 'PartnerController');
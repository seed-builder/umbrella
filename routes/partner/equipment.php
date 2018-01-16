<?php
Route::get('equipment/pagination', ['uses' => 'EquipmentController@pagination']);
Route::get('equipment/create', ['uses' => 'EquipmentController@create']);
Route::post('equipment/create', ['uses' => 'EquipmentController@store']);
Route::get('equipment/edit/{id}', ['uses' => 'EquipmentController@edit']);
Route::post('equipment/edit/{id}', ['uses' => 'EquipmentController@update']);
Route::get('equipment/show/{id}', ['uses' => 'EquipmentController@show']);
Route::get('equipment/delete/{id}', ['uses' => 'EquipmentController@destroy']);
Route::resource('equipment', 'EquipmentController');
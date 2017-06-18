<?php
Route::get('equipment-log/pagination', ['uses' => 'EquipmentLogController@pagination']);
Route::get('equipment-log/create', ['uses' => 'EquipmentLogController@create']);
Route::post('equipment-log/store', ['uses' => 'EquipmentLogController@store']);
Route::get('equipment-log/edit/{id}', ['uses' => 'EquipmentLogController@edit']);
Route::post('equipment-log/edit/{id}', ['uses' => 'EquipmentLogController@update']);
Route::get('equipment-log/show/{id}', ['uses' => 'EquipmentLogController@show']);
Route::get('equipment-log/delete/{id}', ['uses' => 'EquipmentLogController@destroy']);
Route::resource('equipment-log', 'EquipmentLogController');
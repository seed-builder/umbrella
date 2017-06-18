<?php
Route::get('equipment-maintain/pagination', ['uses' => 'EquipmentMaintainController@pagination']);
Route::get('equipment-maintain/create', ['uses' => 'EquipmentMaintainController@create']);
Route::post('equipment-maintain/store', ['uses' => 'EquipmentMaintainController@store']);
Route::get('equipment-maintain/edit/{id}', ['uses' => 'EquipmentMaintainController@edit']);
Route::post('equipment-maintain/edit/{id}', ['uses' => 'EquipmentMaintainController@update']);
Route::get('equipment-maintain/show/{id}', ['uses' => 'EquipmentMaintainController@show']);
Route::get('equipment-maintain/delete/{id}', ['uses' => 'EquipmentMaintainController@destroy']);
Route::resource('equipment-maintain', 'EquipmentMaintainController');
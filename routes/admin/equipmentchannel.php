<?php
Route::get('equipment-channel/pagination', ['uses' => 'EquipmentChannelController@pagination']);
Route::resource('equipment-channel', 'EquipmentChannelController');
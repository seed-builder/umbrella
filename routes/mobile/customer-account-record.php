<?php

Route::get('customer-account-record/index', ['uses' => 'CustomerAccountRecordController@showIndex']);
Route::post('customer-account-record/pagination', ['uses' => 'CustomerAccountRecordController@pagination']);
Route::get('customer-account-record/view/{id}', ['uses' => 'CustomerAccountRecordController@view']);

<?php
Route::get('view-partner-statistics/pagination', ['uses' => 'ViewPartnerStatisticsController@pagination']);
Route::get('view-partner-statistics/create', ['uses' => 'ViewPartnerStatisticsController@create']);
Route::post('view-partner-statistics/store', ['uses' => 'ViewPartnerStatisticsController@store']);
Route::get('view-partner-statistics/edit/{id}', ['uses' => 'ViewPartnerStatisticsController@edit']);
Route::post('view-partner-statistics/edit/{id}', ['uses' => 'ViewPartnerStatisticsController@update']);
Route::get('view-partner-statistics/show/{id}', ['uses' => 'ViewPartnerStatisticsController@show']);
Route::get('view-partner-statistics/delete/{id}', ['uses' => 'ViewPartnerStatisticsController@destroy']);
Route::get('view-partner-statistics/statistics', ['uses' => 'ViewPartnerStatisticsController@statistics']);
Route::resource('view-partner-statistics', 'ViewPartnerStatisticsController');
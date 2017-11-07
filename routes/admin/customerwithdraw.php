<?php
Route::get('customer-withdraw/pagination', ['uses' => 'CustomerWithdrawController@pagination']);
Route::get('customer-withdraw/create', ['uses' => 'CustomerWithdrawController@create']);
Route::post('customer-withdraw/store', ['uses' => 'CustomerWithdrawController@store']);
Route::get('customer-withdraw/edit/{id}', ['uses' => 'CustomerWithdrawController@edit']);
Route::post('customer-withdraw/edit/{id}', ['uses' => 'CustomerWithdrawController@update']);
Route::get('customer-withdraw/show/{id}', ['uses' => 'CustomerWithdrawController@show']);
Route::get('customer-withdraw/delete/{id}', ['uses' => 'CustomerWithdrawController@destroy']);

Route::any('customer-withdraw/remit',function (\App\Services\WithdrawService $withdrawService){
    $withdrawService->remit();
});
Route::resource('customer-withdraw', 'CustomerWithdrawController');


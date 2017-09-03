<?php
Route::group(['prefix' => 'utl'], function () {

	Route::post('/sms-verify', ['uses' => 'UtlController@sendVerifyCode']);

	Route::post('/check-verify', ['uses' => 'UtlController@checkVerifyCode']);

});

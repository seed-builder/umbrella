<?php
Route::get('comment/pagination', ['uses' => 'CommentController@pagination']);
Route::get('comment/create', ['uses' => 'CommentController@create']);
Route::post('comment/store', ['uses' => 'CommentController@store']);
Route::get('comment/edit/{id}', ['uses' => 'CommentController@edit']);
Route::post('comment/edit/{id}', ['uses' => 'CommentController@update']);
Route::get('comment/show/{id}', ['uses' => 'CommentController@show']);
Route::get('comment/delete/{id}', ['uses' => 'CommentController@destroy']);
Route::resource('comment', 'CommentController');
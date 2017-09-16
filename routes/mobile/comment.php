<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-12
 * Time: 17:43
 */

Route::get('comment/create', ['uses' => 'CommentController@create']);
Route::post('comment/store', ['uses' => 'CommentController@store']);
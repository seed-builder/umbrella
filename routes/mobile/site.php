<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-12
 * Time: 17:43
 */

Route::get('site/index', ['uses' => 'SiteController@showIndex']);
Route::any('site/pagination', ['uses' => 'SiteController@pagination']);

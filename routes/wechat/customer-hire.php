<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-12
 * Time: 17:43
 */

Route::get('customer-hire/check-nph', ['uses' => 'CustomerHireController@checkNoPayHires']);

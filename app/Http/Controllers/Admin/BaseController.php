<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-07
 * Time: 15:01
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\DataTableController;

class BaseController extends DataTableController
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
	}
}
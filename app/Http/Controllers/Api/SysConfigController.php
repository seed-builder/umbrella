<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\SysConfig;

class SysConfigController extends ApiController
{
	//
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new SysConfig($attributes);
	}

	public function getByName(Request $request, $name){
        $entity = SysConfig::where('name', $name)->first();
        return $this->success($entity);
    }

}
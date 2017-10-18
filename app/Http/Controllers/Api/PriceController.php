<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\Price;

class PriceController extends ApiController
{
	//
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Price($attributes);
	}

	public function index(Request $request, $conditionCall = null, $dataHandle = null)
    {
        $entities = Price::query()->groupby('deposit_cash')->where('status',1)->get();
        $prices = $entities->pluck('deposit_cash');

//        $entity = $this->newEntity()->getUsingPrice();
        return $this->success($prices);
    }
}
<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\MobileController;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\Price;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class SiteController extends MobileController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Site($attributes);
	}

	public function pagination(Request $request, $with = [], $conditionCall = null, $dataHandleCall = null)
    {
        return parent::pagination($request, $with, function($query){
            $query->where('longitude','!=','')
                ->where('latitude','!=','');
        }, $dataHandleCall); // TODO: Change the autogenerated stub
    }

}

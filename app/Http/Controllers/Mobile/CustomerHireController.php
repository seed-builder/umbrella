<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\MobileController;
use App\Models\CustomerAccountRecord;
use App\Models\CustomerHire;
use App\Models\ViewCustomerHire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CustomerHireController extends MobileController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new CustomerHire($attributes);
	}

	public function showIndex(){

        return view('mobile.customer-hire.index');
    }

    public function view($id){
	    $entity = ViewCustomerHire::find($id);
        return view('mobile.customer-hire.view',compact('entity'));
    }

    public function entityQuery()
    {
        $user = Auth::guard('mobile')->user();


        return ViewCustomerHire::query()->where('customer_id',$user->id);
    }


}

<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\MobileController;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CustomerAccountController extends MobileController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new CustomerAccount($attributes);
	}

	public function index(){
	    $user = Auth::guard('mobile')->user();

        return view('mobile.customer-account.index',compact('user'));
    }

    public function deposit(Request $request){
        $user = Auth::guard('mobile')->user();
        $deposit = Price::query()->where('status',1)->first();

        $tab = $request->input('index','withdraw');
        return view('mobile.customer-account.deposit',compact('user','deposit','tab'));
    }

}

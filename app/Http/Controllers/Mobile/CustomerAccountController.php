<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\MobileController;
use App\Models\Customer;
use App\Models\CustomerAccount;
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

    public function withdraw(){
        $user = Auth::guard('mobile')->user();

        return view('mobile.customer-account.withdraw',compact('user'));
    }
}

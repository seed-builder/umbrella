<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\MobileController;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\CustomerHire;
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

    public function check(){
        $user = Auth::guard('mobile')->user();

        $price = Price::query()->where('status',1)->first();

        $hiring_count = CustomerHire::whereIn('status',[CustomerHire::STATUS_HIRING,CustomerHire::STATUS_PAYING])->count();
        if ($hiring_count>0){
            return $this->fail_result('您当前还有伞未还，请先将租借中的伞归还');
        }

        if ($user->account->deposit < $price->deposit_cash)
            return $this->fail_result('请先充值押金',501);

        return $this->success_result('');

    }

}

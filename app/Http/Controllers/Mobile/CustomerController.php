<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\MobileController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CustomerController extends MobileController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Customer($attributes);
	}

	public function view(){
        $user = Auth::guard('mobile')->user();
        return view('mobile.customer.view',compact('user'));
    }

    public function edit()
    {
        $entity =  Auth::guard('mobile')->user();
        return view('mobile.customer.edit',compact('entity'));
    }

    public function update(Request $request, $id, $only = [], $extraFields = [], $redirect_url = null)
    {
        $data = $request->all();
        $user = Auth::guard('mobile')->user();
        $user->fill($data);
        $user->save();

        return $this->success_result('保存成功');
    }
}

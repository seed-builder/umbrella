<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\MobileController;
use App\Models\CustomerAccountRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CustomerAccountRecordController extends MobileController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new CustomerAccountRecord($attributes);
	}

	public function showIndex(){

        return view('mobile.customer-account-record.index');
    }

    public function view($id){
	    $entity = $this->newEntity()->newQuery()->find($id);
        return view('mobile.customer-account-record.index',compact('entity'));
    }
}

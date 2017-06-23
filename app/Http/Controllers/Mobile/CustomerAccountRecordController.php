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

    public function entityQuery()
    {
        $user = Auth::guard('mobile')->user();
        return CustomerAccountRecord::query()->where('customer_id',$user->id);
    }

    public function filterQuery($filters,$queryBuilder){
        foreach ($filters as $filter) {
            foreach ($filter as $k => $v){
                if (empty($v))
                    continue ;

                if ($k=='start_date')
                    $queryBuilder->where('created_at', '>=', $v);

                if ($k=='end_date')
                    $queryBuilder->where('created_at', '<=', $v);
            }
        }
    }
}

<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\MobileController;
use App\Models\CustomerPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CustomerPaymentController extends MobileController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new CustomerPayment($attributes);
	}

	public function index(){

        return view('mobile.customer-payment.index');
    }

    public function view($id){
	    $entity = $this->newEntity()->newQuery()->find($id);
        return view('mobile.customer-payment.view',compact('entity'));
    }

    public function entityQuery()
    {
        $user = Auth::guard('mobile')->user();
        return $this->newEntity()->newQuery()->where('customer_id',$user->id);
    }

    public function filterQuery($filters,$queryBuilder){
        foreach ($filters as $filter) {
            foreach ($filter as $k => $v){
                if (empty($v))
                    continue ;

                if ($k=='start_date')
                    $queryBuilder->where('created_at', '>=', $v);
                else if ($k=='end_date')
                    $queryBuilder->where('created_at', '<=', $v);
                else
                    $queryBuilder->where($k, 'like binary', '%' . $v . '%');
            }
        }
    }

    public function pagination(Request $request, $with = [], $conditionCall = null, $dataHandleCall = null)
    {
        return parent::pagination($request, $with, $conditionCall, function ($entities){
            foreach ($entities as $entity){
                $entity->type_name = $entity->type();
            }
        }); // TODO: Change the autogenerated stub
    }
}

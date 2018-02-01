<?php
namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Services\WithdrawService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\CustomerWithdraw;

class CustomerWithdrawController extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new CustomerWithdraw($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('admin.customer-withdraw.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('admin.customer-withdraw.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = CustomerWithdraw::find($id);
		return view('admin.customer-withdraw.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$entity = CustomerWithdraw::find($id);
		return view('admin.customer-withdraw.show', ['entity' => $entity]);
	}

	/**
	* @param  Request $request
	* @param  array $searchCols
	* @param  array $with
	* @param  null $conditionCall
	* @param  bool $all_columns
	* @return  \Illuminate\Http\JsonResponse
	*/
	public function pagination(Request $request, $searchCols = [], $with=[], $conditionCall = null, $dataHandleCall = null, $all_columns = false){
		$searchCols = ["remark","sn"];
		return parent::pagination($request, $searchCols,['customer'],$conditionCall,function ($entities){
            foreach ($entities as $entity){
                $entity->status_name = $entity->status();
            }
        });
	}

    public function filterQuery($filters, $queryBuilder)
    {
        foreach ($filters as $filter) {
            foreach ($filter as $k => $v){
                if (empty($v)) {
                    continue ;
                }
                switch ($k){
                    case 'start_created_at':{
                        $queryBuilder->where('created_at','>=',$v );
                        break ;
                    }
                    case 'end_created_at':{
                        $queryBuilder->where('created_at','<=',$v );
                        break ;
                    }
                    case 'start_amt':{
                        $queryBuilder->where('amt','>=',$v );
                        break ;
                    }
                    case 'end_amt':{
                        $queryBuilder->where('amt','<=',$v );
                        break ;
                    }
                    case 'nickname':{
                        $ids = Customer::query()->where('nickname','like','%'.$v.'%')->pluck('id')->toArray();
                        $queryBuilder->whereIn('customer_id',$ids );
                        break ;
                    }
                    default : {
                        $queryBuilder->where($k, 'like binary', '%' . $v . '%');
                    }
                }
            }

        }
    }

    /**
     * 手动打款功能
     */
    public function remit(Request $request){
        $date = $request->input('date','');

        if (empty($date))
            return $this->fail_result('日期不能为空');

        $service = new  WithdrawService();
        $service->date_remit($date);

        return $this->success_result('打款成功，请核对打款数据，若出现系统繁忙的请重新执行打款任务');
    }

}

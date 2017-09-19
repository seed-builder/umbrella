<?php
namespace App\Http\Controllers\Admin;

use App\Models\ViewCustomerHire;
use App\Services\ExcelService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\CustomerHire;

class CustomerHireController extends BaseController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new CustomerHire($attributes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.customer-hire.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer-hire.create');
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = CustomerHire::find($id);
        return view('admin.customer-hire.edit', ['entity' => $entity]);
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = CustomerHire::find($id);
        return view('admin.customer-hire.show', ['entity' => $entity]);
    }

    /**
     * @param  Request $request
     * @param  array $searchCols
     * @param  array $with
     * @param  null $conditionCall
     * @param  bool $all_columns
     * @return  \Illuminate\Http\JsonResponse
     */
    public function pagination(Request $request, $searchCols = [], $with = [], $conditionCall = null, $dataHandleCall = null, $all_columns = false)
    {
        $searchCols = [];
        return parent::pagination($request, $searchCols, $with, $conditionCall, function($entities){
            foreach ($entities as $entity){
                $entity->status_name = $entity->status();
            }
        },true);
	}

    public function entityQuery()
    {
        return ViewCustomerHire::query();
    }

    public function export($entities)
    {
        $result[0] = [
//            '共享伞编号',
            '用户',
            '借伞网点',
            '借伞时间',
            '还伞网点',
            '还伞时间',
            '到期时间',
            '租用时长（小时）',
            '租借费用',
        ];
        foreach ($entities as $entity){
            $result[] = [
                $entity->customer_name,
                $entity->hire_site_name,
                $entity->hire_at,
                $entity->return_site_name,
                $entity->return_at,
                $entity->expired_at,
                $entity->hire_hours,
                $entity->hire_amt,
            ];
        }

        $excel = new ExcelService();
        $excel->export($result, date('Ymd') . '_客户租借单');
    }

}

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
        return parent::pagination($request, $searchCols, $with, $conditionCall, function ($entities) {
            foreach ($entities as $entity) {
                $entity->status_name = $entity->status();

                $entity->real_time = $entity->hire_hours;

                //租借单状态不为初始或者租借中时 计算租借时间
                if ($entity->status == CustomerHire::STATUS_INIT || $entity->status == CustomerHire::STATUS_HIRING){
                    $entity->real_time = '未还伞';
                    continue ;
                }

                if ($entity->hire_hours == 0) {
                    $time = strtotime($entity->return_at) - strtotime($entity->hire_at);
                    $entity->real_time = time_diff($time);
                    continue ;
                }

            }
        }, true);
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
        foreach ($entities as $entity) {
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

    public function filterQuery($filters, $queryBuilder)
    {
        foreach ($filters as $filter) {
            foreach ($filter as $k => $v) {
                if (empty($v)) {
                    continue;
                }
                switch ($k) {
                    case 'start_created_at': {
                        $queryBuilder->where('created_at', '>=', $v);
                        break;
                    }
                    case 'end_created_at': {
                        $queryBuilder->where('created_at', '<=', $v);
                        break;
                    }
                    case 'start_expired_at': {
                        $queryBuilder->where('expired_at', '>=', $v);
                        break;
                    }
                    case 'end_expired_at': {
                        $queryBuilder->where('expired_at', '<=', $v);
                        break;
                    }
                    case 'start_hire_amt': {
                        $queryBuilder->where('hire_amt', '>=', $v);
                        break;
                    }
                    case 'end_hire_amt': {
                        $queryBuilder->where('hire_amt', '<=', $v);
                        break;
                    }
                    case 'start_hire_at': {
                        $queryBuilder->where('hire_at', '>=', $v);
                        break;
                    }
                    case 'end_hire_at': {
                        $queryBuilder->where('hire_at', '<=', $v);
                        break;
                    }
                    case 'start_return_at': {
                        $queryBuilder->where('return_at', '>=', $v);
                        break;
                    }
                    case 'end_return_at': {
                        $queryBuilder->where('return_at', '<=', $v);
                        break;
                    }
                    default : {
                        $queryBuilder->where($k, 'like binary', '%' . $v . '%');
                    }
                }
            }

        }
    }

}

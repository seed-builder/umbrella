<?php

namespace App\Http\Controllers\Admin;

use App\Services\ExcelService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Customer;

class CustomerController extends BaseController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new Customer($attributes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = Customer::find($id);
        return view('admin.customer.edit', ['entity' => $entity]);
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = Customer::find($id);
        return view('admin.customer.show', ['entity' => $entity]);
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
        $searchCols = ["address", "head_img_url", "mobile", "nickname", "openid", "password", "remark"];
        return parent::pagination($request, $searchCols);
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
                    default : {
                        $queryBuilder->where($k, 'like binary', '%' . $v . '%');
                    }
                }
            }

        }
    }

    public function export($entities)
    {
        $result[0] = [
            '微信昵称',
            '手机号',
            '性别',
            '省份',
            '城市',
            '创建时间',
        ];
        foreach ($entities as $entity) {
            $result[] = [
                $entity->nickname,
                $entity->mobile,
                $entity->gender == 1 ? '男' : '女',
                $entity->province,
                $entity->city,
                $entity->created_at,
            ];
        }

        $excel = new ExcelService();
        $excel->export($result, date('Ymd') . '_微信用户信息');
    }
}

<?php
namespace App\Http\Controllers\Admin;

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
     * @param    int $id
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
     * @param    int $id
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
    public function pagination(Request $request, $searchCols = [], $with = [], $conditionCall = null, $dataHandleCall = null, $all_columns = false)
    {
        $searchCols = ["outer_order_sn", "remark", "sn"];
        return parent::pagination($request, $searchCols, $with, $conditionCall, $dataHandleCall, true);
    }

    public function entityQuery()
    {
        $query = CustomerWithdraw::query();
        $query->select(
            'customer_withdraws.id as id',
            'customer_withdraws.sn',
            'customer_withdraws.outer_order_sn',
            'customer_withdraws.customer_id',
            'customer_withdraws.status',
            'customer_withdraws.amt',
            'customer_withdraws.remark',
            'customer_withdraws.created_at',
            'customers.nickname'
        );

        $query->leftJoin('customers', function ($join) {
            $join->on('customers.id', '=', 'customer_withdraws.customer_id');
        });

        return $query;
    }

}

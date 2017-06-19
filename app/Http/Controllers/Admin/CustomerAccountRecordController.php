<?php
namespace App\Http\Controllers\Admin;

use App\Models\CustomerAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\CustomerAccountRecord;

class CustomerAccountRecordController extends BaseController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new CustomerAccountRecord($attributes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.customer-account-record.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer-account-record.create');
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = CustomerAccountRecord::find($id);
        return view('admin.customer-account-record.edit', ['entity' => $entity]);
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = CustomerAccountRecord::find($id);
        return view('admin.customer-account-record.show', ['entity' => $entity]);
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
        $searchCols = ["remark"];
        return parent::pagination($request, $searchCols, $with, $conditionCall, $dataHandleCall, true);
    }

    public function entityQuery()
    {
        $query = CustomerAccountRecord::query();
        $query->select(
            'customer_account_records.id as id',
            'customer_account_records.amt',
            'customer_account_records.type',
            'customer_account_records.status',
            'customer_account_records.remark',
            'customer_account_records.created_at',
            'customer_accounts.sn',
            'customers.nickname'
        );

        $query->leftJoin('customers', function ($join) {
            $join->on('customers.id', '=', 'customer_account_records.customer_id');
        });

        $query->leftJoin('customer_accounts', function ($join) {
            $join->on('customer_accounts.id', '=', 'customer_account_records.customer_account_id');
        });

        return $query;
    }

}

<?php
namespace App\Http\Controllers\Admin;

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
        return parent::pagination($request, $searchCols, $with, $conditionCall, $dataHandleCall,true);
	}

    public function entityQuery()
    {
        $query = CustomerHire::query();
        $query->select(
            'customer_hires.id as id',
            'customer_hires.customer_id',
            'customer_hires.umbrella_id',
            'customer_hires.hire_equipment_id',
            'customer_hires.hire_site_id',
            'customer_hires.hire_at',
            'customer_hires.margin_amt',
            'customer_hires.return_equipment_id',
            'customer_hires.return_site_id',
            'customer_hires.return_at',
            'customer_hires.expire_day',
            'customer_hires.expired_at',
            'customer_hires.hire_day',
            'customer_hires.hire_amt',
            'customer_hires.status',
            'customer_hires.created_at',
            'customers.nickname',
            'customers.nickname'
        );

        $query->leftJoin('customers', function ($join) {
            $join->on('customers.id', '=', 'customer_accounts.customer_id');
        });

        $query->leftJoin('equipments as return_equipment', function ($join) {
            $join->on('return_equipment.id', '=', 'customer_hires.return_equipment_id');
        });

        return $query;
    }

}

<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\CustomerAccount;

class CustomerAccountController extends BaseController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new CustomerAccount($attributes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $deposit = CustomerAccount::query()->sum('deposit');
        $freeze_deposit = CustomerAccount::query()->sum('freeze_deposit');
        return view('admin.customer-account.index',compact('deposit','freeze_deposit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer-account.create');
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = CustomerAccount::find($id);
        return view('admin.customer-account.edit', ['entity' => $entity]);
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = CustomerAccount::find($id);
        return view('admin.customer-account.show', ['entity' => $entity]);
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
        $searchCols = ["sn"];
        return parent::pagination($request, $searchCols, ['customer'], null, null, true);
    }

    public function entityQuery()
    {
        $query = CustomerAccount::query();
        $query->select(
            'customer_accounts.id as id',
            'customer_accounts.sn',
            'customer_accounts.balance_amt',
            'customer_accounts.freeze_deposit',
            'customer_accounts.deposit',
            'customer_accounts.created_at',
            'customers.nickname'
        );

        $query->leftJoin('customers', function ($join) {
            $join->on('customers.id', '=', 'customer_accounts.customer_id');
        });

        return $query;
    }

    public function filterQuery($filters, $queryBuilder)
    {
        foreach ($filters as $filter) {
            foreach ($filter as $k => $v){
                if (empty($v)) {
                    continue ;
                }
                switch ($k){
                    case 'start_balance_amt':{
                        $queryBuilder->where('balance_amt','>=',$v );
                        break ;
                    }
                    case 'end_balance_amt':{
                        $queryBuilder->where('balance_amt','<=',$v );
                        break ;
                    }
                    case 'start_deposit':{
                        $queryBuilder->where('deposit','>=',$v );
                        break ;
                    }
                    case 'end_deposit':{
                        $queryBuilder->where('deposit','<=',$v );
                        break ;
                    }
                    default : {
                        $queryBuilder->where($k, 'like binary', '%' . $v . '%');
                    }
                }
            }

        }
    }

}

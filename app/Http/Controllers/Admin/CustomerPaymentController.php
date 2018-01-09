<?php
namespace App\Http\Controllers\Admin;

use App\Services\ExcelService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\CustomerPayment;

class CustomerPaymentController extends BaseController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new CustomerPayment($attributes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d');
        $all = CustomerPayment::where('status',CustomerPayment::STATUS_SUCCESS)->get();

        $all_deposit_amt = $all->where('type',CustomerPayment::TYPE_IN_DEPOSIT)->sum('amt');
        $all_recharge_amt = $all->where('type',CustomerPayment::TYPE_IN_CHARGE)->sum('amt');
        $all_withdraw_amt = $all->where('type',CustomerPayment::TYPE_OUT_WITHDRAW)->sum('amt');

        $today_deposit_amt = $all->where('type',CustomerPayment::TYPE_IN_DEPOSIT)
            ->where('created_at','>',$date.' 00:00:00')
            ->where('created_at','<',$date.' 23:59:59')
            ->sum('amt');

        $today_recharge_amt = $all->where('type',CustomerPayment::TYPE_IN_CHARGE)
            ->where('created_at','>',$date.' 00:00:00')
            ->where('created_at','<',$date.' 23:59:59')
            ->sum('amt');

        $today_withdraw_amt = $all->where('type',CustomerPayment::TYPE_OUT_WITHDRAW)
            ->where('created_at','>=',$date.' 00:00:00')
            ->where('created_at','<=',$date.' 23:59:59')
            ->sum('amt');

        return view('admin.customer-payment.index',compact('all_deposit_amt','all_recharge_amt','all_withdraw_amt','today_deposit_amt','today_recharge_amt','today_withdraw_amt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer-payment.create');
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = CustomerPayment::find($id);
        return view('admin.customer-payment.edit', ['entity' => $entity]);
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = CustomerPayment::find($id);
        return view('admin.customer-payment.show', ['entity' => $entity]);
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
        $searchCols = ["outer_order_sn", "reference_type", "remark", "sn"];
        return parent::pagination($request, $searchCols, $with, function($queryBuilder){
            $queryBuilder->where('status',CustomerPayment::STATUS_SUCCESS);
        }, function($entities){
            foreach ($entities as $entity){
                $entity->status_name = $entity->status();
                $entity->type_name = $entity->type();
                $entity->channel_name = $entity->channel();

            }
        }, true);
    }

    public function entityQuery()
    {
        $query = CustomerPayment::query();
        $query->select(
            'customer_payments.id as id',
            'customer_payments.sn',
            'customer_payments.outer_order_sn',
            'customer_payments.customer_id',
            'customer_payments.payment_channel',
            'customer_payments.amt',
            'customer_payments.remark',
            'customer_payments.status',
            'customer_payments.type',
            'customer_payments.created_at',
            'customers.nickname',
            'customers.mobile'
        );

        $query->leftJoin('customers', function ($join) {
            $join->on('customers.id', '=', 'customer_payments.customer_id');
        });

        return $query;
    }

    public function export($entities)
    {
        $result[0] = [
            '订单号',
            '微信昵称',
            '手机号',
            '支付渠道',
            '金额',
            '支付状态',
            '支付类别',
            '时间',
        ];
        foreach ($entities as $entity){
            $result[] = [
                $entity->sn,
                empty($entity->customer->nickname) ? '无' : $entity->customer->nickname,
                empty($entity->customer->mobile) ? '无' : $entity->customer->mobile,
                $entity->channel(),
                $entity->amt,
                $entity->status(),
                $entity->type(),
                $entity->created_at,
            ];
        }

        $excel = new ExcelService();
        $excel->export($result, date('Ymd') . '_客户资金流水');
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
                        $queryBuilder->where('customer_payments.created_at','>=',$v );
                        break ;
                    }
                    case 'end_created_at':{
                        $queryBuilder->where('customer_payments.created_at','<=',$v );
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
                    default : {
                        $queryBuilder->where($k, 'like binary', '%' . $v . '%');
                    }
                }
            }

        }
    }
}

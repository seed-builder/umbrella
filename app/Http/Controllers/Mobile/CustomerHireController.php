<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\WeChatApi;
use App\Http\Controllers\MobileController;
use App\Models\CustomerHire;
use App\Models\CustomerPayment;
use App\Models\Equipment;
use App\Models\Price;
use App\Models\ViewCustomerHire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CustomerHireController extends MobileController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new CustomerHire($attributes);
    }

    public function showIndex()
    {

        return view('mobile.customer-hire.index');
    }

    public function view($id)
    {
        $entity = ViewCustomerHire::find($id);
        return view('mobile.customer-hire.view', compact('entity'));
    }

    public function entityQuery()
    {
        $user = Auth::guard('mobile')->user();


        return ViewCustomerHire::query()->where('customer_id', $user->id);
    }

    public function pagination(Request $request, $with = [], $conditionCall = null, $dataHandleCall = null)
    {
        return parent::pagination($request, $with, function ($query) {
            $query->orderBy('status', 'asc');
            $query->orderBy('updated_at', 'desc');

        }, function ($entities) {
            foreach ($entities as $entity) {
                $entity->status_name = $entity->status();
            }
        }); // TODO: Change the autogenerated stub
    }

    public function store(Request $request, $only = [], $extraFields = [], $successMsg = null)
    {
//        $hire_equipment_id = $request->input('hire_equipment_id',0);
//
//        if (empty($hire_equipment_id))
//            return $this->fail_result('参数错误');
//
//        $equipment = Equipment::find($hire_equipment_id);
//        $hire_site_id = $equipment->site_id;
//
//        $user = Auth::guard('mobile')->user();
//        $price = new Price();
//
//        $extraFields = [
//            'customer_id' => $user->id,
//            'hire_site_id' => $hire_site_id,
//            'hire_at' => date('Y-m-d H:i:s'),
//            'deposit_amt' => $price->getUsingPrice()->deposit_cash
//        ];
//        return parent::store($request, $only, $extraFields, $successMsg); // TODO: Change the autogenerated stub

        return $this->success_result('');
    }

    public function check($id)
    {
        $hire = CustomerHire::find($id);
        if ($hire->status == CustomerHire::STATUS_HIRING) {
//            $payment = new CustomerPayment();
//            $payment->createPayment([
//                'type' => CustomerPayment::TYPE_OUT_DEPOSIT,
//                'amt' => $hire->deposit_amt,
//                'customer_id' => $hire->customer_id,
//                'reference_id' => $hire->id,
//                'reference_type' => 'App\Models\CustomerHire',
//            ], CustomerPayment::STATUS_SUCCESS);

            $api = new WeChatApi();
            $api->wxSend('borrow', [
                'first' => '您成功借了一把共享雨伞，伞编号：'.$hire->umbrella->number.'，请好好爱护您的伞哦，记得按时归还！',
                'keyword1' => 'H'.$hire->customer->id.date('YmdHis',strtotime($hire->hire_at)),
                'keyword2' => date('Y年m月d日 H:i:s'),
                'keyword3' => $hire->hire_amt . '元',
            ], $hire->customer->openid);

            return $this->success_result('出伞成功', $hire);
        } else if ($hire->status == CustomerHire::STATUS_INIT) {
            return $this->fail_result('用户未拿伞');
        } else {
            return $this->fail_result('');
        }
    }

    public function returnWechatSend($id){
        $hire = CustomerHire::find($id);

        $api = new WeChatApi();
        $rs = $api->wxSend('return', [
            'first' => '您所借的共享雨伞，编号：'.$hire->umbrella->number.'已经归还，请将伞移出感应区，感谢您的使用！',
            'keyword1' => 'H' . $hire->customer->id . date('YmdHis', strtotime($hire->hire_at)),
            'keyword2' => date('Y年m月d日 H:i:s'),
            'keyword3' => $hire->hire_amt . '元',
            'keyword4' => $hire->deposit_amt . '元',
        ], $hire->customer->openid);

        if (!empty($rs->errcode))
            return $this->fail_result($rs->errmsg);
        else
            return $this->success_result('success');
    }
}

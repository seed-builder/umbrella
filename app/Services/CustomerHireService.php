<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/6/29
 * Time: 18:02
 */

namespace App\Services;


use App\Models\CustomerAccount;
use App\Models\CustomerAccountRecord;
use App\Models\CustomerHire;
use App\Models\SysLog;
use App\Models\Umbrella;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class CustomerHireService
{
    /**
     * 租借逾期
     */
    public function due()
    {
        DB::beginTransaction();

        try {
            $hires = CustomerHire::query()
                ->where('expired_at', '<', date('Y-m-d H:i:s'))
                ->where('status', 1)
                ->get();

            //状态变更为逾期
            CustomerHire::query()
                ->where('expired_at', '<', date('Y-m-d H:i:s'))
                ->where('status', 1)
                ->update([
                    'status' => 3
                ]);

            foreach ($hires as $hire){
                //账户冻结金额中扣除对应押金
                $account = CustomerAccount::query()->where('customer_id',$hire->customer_id)->first();
                $account->freeze_deposit = $account->freeze_deposit - $hire->deposit_amt;
                $account->save();

                //伞变更为未归还状态
                $umbrella = Umbrella::find($hire->umbrella_id);
                $umbrella->status = 4;
                $umbrella->save();
            }

            DB::commit();

            $this->addLog('租借逾期','执行完成',1);

        } catch (Exception $e) {
            $this->addLog('租借逾期',$e->getMessage(),2);

            DB::rollback();
        }
    }

    public function addLog($action, $content, $status)
    {
        SysLog::create([
            'module' => '定时任务',
            'action' => '执行'.$action.'定时任务',
            'content' => $content,
            'status' => $status,
        ]);
    }
}
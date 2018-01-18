<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/6/29
 * Time: 18:02
 */

namespace App\Services;


use App\Helpers\WeChatApi;
use App\Models\CustomerAccount;
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
                ->where('status', CustomerHire::STATUS_HIRING)
                ->get();

            foreach ($hires as $hire){
                //状态变更为逾期
                $hire->status = CustomerHire::STATUS_EXPIRED;
                $hire->save();

                //账户冻结金额中扣除对应押金
                $account = CustomerAccount::query()->where('customer_id',$hire->customer_id)->first();
                $account->freeze_deposit = $account->freeze_deposit - $hire->deposit_amt;
                $account->save();

                //伞变更为未归还状态
                $umbrella = Umbrella::find($hire->umbrella_id);
                $umbrella->status = Umbrella::STATUS_EXPIRED;
                $umbrella->save();

                if (empty($hire->customer)){
                    continue ;
                }
                $api = new WeChatApi();
                $api->wxSend('expired', [
                    'first' => '您所借的共享雨伞，伞编号：'.$hire->umbrella->number.'，已超过您的最迟还伞期限！',
                    'keyword1' => 'H'.$hire->customer->id.date('YmdHis',strtotime($hire->hire_at)),
                    'keyword2' => date('Y年m月d日 H:i:s',strtotime($hire->hire_at)),
                    'remark' => '押金已经从您的账户里扣除，感谢您的使用！'
                ], $hire->customer->openid);
            }

            DB::commit();

            $this->addLog('租借逾期','执行完成',1);

        } catch (Exception $e) {
            $this->addLog('租借逾期',$e->getMessage(),2);

            DB::rollback();
        }
    }

    /**
     * 租借逾期提醒
     */
    public function dueTip()
    {
        $hires = CustomerHire::query()
            ->where('status', CustomerHire::STATUS_HIRING)
            ->get();

        foreach ($hires as $hire) {
            $hour = floor((strtotime($hire->expired_at) - strtotime(date('Y-m-d H:i:s'))) / 3600);

            if (empty($hire->customer)) {
                continue;
            }

            if ($hire->price->expire_tip_hours == $hour){
                info('逾期提醒 租借单id：'.$hire->id);
                $api = new WeChatApi();
                $api->wxSend('expired', [
                    'first' => '您所借的共享雨伞，伞编号：' . $hire->umbrella->number . '，即将到期，请尽快归还！',
                    'keyword1' => 'H' . $hire->customer->id . date('YmdHis', strtotime($hire->hire_at)),
                    'keyword2' => date('Y年m月d日 H:i:s', strtotime($hire->hire_at)),
                    'remark' => '最迟还伞时间为：'.$hire->expired_at.'！'
                ], $hire->customer->openid);
            }
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
<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/6/29
 * Time: 18:02
 */

namespace App\Services;


use App\Helpers\WeChatApi;
use App\Helpers\WeChatPay;
use App\Models\CustomerAccount;
use App\Models\CustomerHire;
use App\Models\CustomerWithdraw;
use App\Models\SysLog;
use App\Models\Umbrella;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class WithdrawService
{
    /**
     * 租借逾期
     */
    public function remit()
    {
        DB::beginTransaction();

        try {
            $wxpay = new WeChatPay();
            $date = date('Y-m-d', strtotime('-1 day'));

            $fails = CustomerWithdraw::query()->where('status', CustomerWithdraw::STATUS_FAIL)->get();
            foreach ($fails as $fail) {
                if ($this->validateAccountDeposit($fail)){
                    $rs = $wxpay->epPay($fail);
                    $this->result($rs, $fail);
                }
            }
            $withdraws = CustomerWithdraw::query()
                ->where('created_at', '>=', $date . ' 00:00:00')
                ->where('created_at', '<=', $date . ' 23:59:59')
                ->where('status', CustomerWithdraw::STATUS_INIT)
                ->get();
            foreach ($withdraws as $withdraw) {
                if ($this->validateAccountDeposit($withdraw)){
                    $rs = $wxpay->epPay($withdraw);
                    $this->result($rs, $withdraw);
                }
            }


            DB::commit();

            $this->addLog('用户提现：打款', '执行完成', 1);

        } catch (Exception $e) {
            $this->addLog('用户提现：打款', $e->getMessage(), 2);

            DB::rollback();
        }
    }

    /**
     * 处理结果
     * @param $rs
     * @param $entity
     */
    protected function result($rs, $entity)
    {
        if ($rs['return_code'] == 'FAIL')
            return;


        if ($rs['result_code'] == 'FAIL') {
            $entity->remark = $rs['err_code_des'];
            $entity->status = CustomerWithdraw::STATUS_FAIL;
            $entity->save();
            return;
        }

        if ($rs['result_code'] == 'SUCCESS') {
            $entity->remark = '【打款单号】：' . $rs['payment_no'] . '，【打款时间】：' . $rs['payment_time'] . '';
            $entity->status = CustomerWithdraw::STATUS_SUCCESS;
            $entity->save();
        }
    }

    /**
     * 判断当前账户可提现押金是否足够
     * @param $withdraw
     * @return bool
     */
    protected function validateAccountDeposit($withdraw)
    {
        $account = CustomerAccount::where('customer_id', $withdraw->customer_id)->first();

        if ($account->deposit < $withdraw->amt) {
            $withdraw->status = CustomerWithdraw::STATUS_CLOSE;
            $withdraw->remark = '用户账户可提现余额不足';
            $withdraw->save();
            return false ;
        }

        return true;
    }

    /**
     * 添加日志
     * @param $action
     * @param $content
     * @param $status
     */
    protected function addLog($action, $content, $status)
    {
        SysLog::create([
            'module' => '定时任务',
            'action' => '执行' . $action . '定时任务',
            'content' => $content,
            'status' => $status,
        ]);
    }
}
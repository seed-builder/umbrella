<?php
/**
 * Created by PhpStorm.
 * User: Shineraini
 * Date: 2017/6/29
 * Time: 17:29
 */

namespace App\Services;


use App\Models\CustomerPayment;
use App\Models\SysLog;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class OrderService
{

    /**
     * 前一天未支付订单关闭
     */
    public function close()
    {
        $date = date('Y-m-d', strtotime('-1 day'));

        DB::beginTransaction();

        try {
            $count = CustomerPayment::query()
                ->where('created_at', '>=', $date . '00:00:00')
                ->where('created_at', '<=', $date . '23:59:59')
                ->where('status', 1)
                ->count();

            DB::table('customer_payments')
                ->where('created_at', '>=', $date . '00:00:00')
                ->where('created_at', '<=', $date . '23:59:59')
                ->where('status', 1)
                ->update([
                    'status' => 4
                ]);

            SysLog::create([
                'module' => '定时任务',
                'action' => '执行订单关闭定时任务',
                'content' => '关闭订单数量'.$count,
                'status' => 1,
            ]);

            DB::commit();
        } catch (Exception $e) {
            SysLog::create([
                'module' => '定时任务',
                'action' => '执行订单关闭定时任务',
                'content' => $e->getMessage(),
                'status' => 2,
            ]);

            DB::rollback();
        }

    }
}
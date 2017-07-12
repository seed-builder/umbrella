<?php

namespace App\Listeners;

use App\Events\WechatApiEvent;
use App\Models\SysLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WechatApiHandler
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WechatApiEvent $event
     * @return void
     */
    public function handle(WechatApiEvent $event)
    {
        $log = [
            'module' => '微信接口-' . $event->module,
            'action' => $event->url,
        ];

        $content = '';
        if (!empty($event->data))
            $content .= '【请求数据】：' . json_encode($event->data);

        if (!empty($event->result)) {
            $content .= '【返回结果】：' . json_encode($event->result);
        }

        $log['content'] = $content;

        $rs = $event->result;

        if (is_array($rs)){
            foreach ($rs as $k => $v) {
                if (!empty($rs['errcode']) || !empty($rs['err_code'])) {
                    $log['status'] = 2;
                }else {
                    if (strpos('SUCCESS', $k) !== false || strpos('SUCCESS', $v) !== false) {
                        $log['status'] = 1;
                    }
                }
            }

        }

        SysLog::create($log);
    }
}

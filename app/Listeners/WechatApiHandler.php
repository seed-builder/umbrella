<?php

namespace App\Listeners;

use App\Events\WechatApiEvent;
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
     * @param  WechatApiEvent  $event
     * @return void
     */
    public function handle(WechatApiEvent $event)
    {
        //
    }
}

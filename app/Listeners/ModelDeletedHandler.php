<?php

namespace App\Listeners;

use App\Events\ModelDeletedEvent;
use App\Models\SysLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModelDeletedHandler
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
     * @param  ModelDeletedEvent  $event
     * @return void
     */
    public function handle(ModelDeletedEvent $event)
    {
        SysLog::create([
            'module' => $event->model->getTable().'模型',
            'action' => '删除',
            'content' => json_encode($event->model->toArray()),
            'status' => 1
        ]);
    }
}

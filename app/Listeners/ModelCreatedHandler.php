<?php

namespace App\Listeners;

use App\Events\ModelCreatedEvent;
use App\Models\SysLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModelCreatedHandler
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
     * @param  ModelCreatedEvent  $event
     * @return void
     */
    public function handle(ModelCreatedEvent $event)
    {
        SysLog::create([
            'module' => $event->model->getTable().'模型',
            'action' => '新增',
            'content' => json_encode($event->model->toArray()),
            'status' => 1
        ]);
    }
}

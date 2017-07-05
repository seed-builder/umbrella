<?php

namespace App\Listeners;

use App\Events\ModelUpdatedEvent;
use App\Models\SysLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModelUpdatedHandler implements ShouldQueue
{
    use InteractsWithQueue;
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
     * @param  ModelUpdatedEvent  $event
     * @return void
     */
    public function handle(ModelUpdatedEvent $event)
    {
        SysLog::create([
            'module' => $event->model->getTable().'模型',
            'action' => '修改',
            'content' => json_encode($event->model->toArray()),
            'status' => 1
        ]);
    }
}

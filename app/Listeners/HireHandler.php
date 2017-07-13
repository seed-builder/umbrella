<?php

namespace App\Listeners;

use App\Events\HireEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HireHandler
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
     * @param  HireEvent  $event
     * @return void
     */
    public function handle(HireEvent $event)
    {
        $model = $event->model;
        switch ($model->status){

        }
    }
}

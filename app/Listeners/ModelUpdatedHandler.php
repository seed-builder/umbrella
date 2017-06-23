<?php

namespace App\Listeners;

use App\Events\ModelUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModelUpdatedHandler
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
     * @param  ModelUpdatedEvent  $event
     * @return void
     */
    public function handle(ModelUpdatedEvent $event)
    {
        //
    }
}

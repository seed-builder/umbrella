<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
	    'App\Events\FlagChangedEvent' => [
		    'App\Listeners\FlagChangedEventHandler',
	    ],
        'App\Events\ModelCreatedEvent' => [
            'App\Listeners\ModelCreatedHandler',
        ],
        'App\Events\ModelDeletedEvent' => [
            'App\Listeners\ModelDeletedHandler',
        ],
        'App\Events\ModelUpdatedEvent' => [
            'App\Listeners\ModelUpdatedHandler',
        ],
        'App\Events\WechatApiEvent' => [
            'App\Listeners\WechatApiHandler',
        ],
        'App\Events\PaymentEvent' => [
            'App\Listeners\PaymentHandler',
        ],
        'App\Events\HireEvent' => [
            'App\Listeners\HireHandler',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

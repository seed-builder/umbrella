<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WechatApiEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $url;
    public $result;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($url,$result)
    {
        $this->url = $url;
        $this->result = $result;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

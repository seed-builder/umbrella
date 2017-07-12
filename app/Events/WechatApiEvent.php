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

    public $module;
    public $url;
    public $data;
    public $result;
    public $status;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($module, $url, $result = null, $data = null, $status = 1)
    {
        $this->module = $module;
        $this->url = $url;
        $this->result = $result;
        $this->data = $data;
        $this->status = $status;
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

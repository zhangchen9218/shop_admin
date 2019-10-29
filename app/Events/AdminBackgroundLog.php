<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AdminBackgroundLog
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $param;
    public $describe;
    /**
     * AdminBackgroundLog constructor.
     * @param $route
     * @param $param
     * @param string $describe
     */
    public function __construct($data)
    {
        $this->data     = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApprovalRequestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $approvalRequest;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($approvalRequest)
    {
        $this->approvalRequest = $approvalRequest;
    }
    
    public function broadcastOn()
    {
        return new Channel('approval-requests');
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

}

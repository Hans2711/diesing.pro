<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserPresenceEvent implements ShouldBroadcast
{
    public $type;
    public $userId;

    public function __construct($type, $userId)
    {
        $this->type = $type;
        $this->userId = $userId;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('public-online-users');
    }

    public function broadcastAs()
    {
        return 'UserPresenceEvent';
    }
}

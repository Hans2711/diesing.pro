<?php
namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DataReceivedEvent implements ShouldBroadcast
{
    public $senderId;
    public $data;
    protected $receiverId;

    public function __construct($senderId, $receiverId, $data)
    {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->data = base64_encode($data);
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('user.' . $this->receiverId);
    }

    public function broadcastAs()
    {
        return 'DataReceivedEvent';
    }
}

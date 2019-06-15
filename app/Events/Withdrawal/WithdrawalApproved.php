<?php

namespace App\Events\Withdrawal;

use App\Models\WithDrawal;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WithdrawalApproved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var WithDrawal
     */
    private $withDrawal;

    /**
     * Create a new event instance.
     *
     * @param WithDrawal $withDrawal
     */
    public function __construct(WithDrawal $withDrawal)
    {
        $this->withDrawal = $withDrawal;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('withdrawal'.$this->withDrawal->withdrawal_id);
    }

    public function broadcastAs()
    {
        return 'approved';
    }

    public function broadcastWith()
    {
        return [
            'amount' => $this->withDrawal->present()->amount,
        ];
    }
}

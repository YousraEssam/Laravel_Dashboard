<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NewStaffMemberHasBeenAddedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $staffMember;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($staffMember)
    {
        $this->staffMember = $staffMember;
    }

}

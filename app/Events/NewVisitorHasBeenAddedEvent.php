<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewVisitorHasBeenAddedEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $visitor;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($visitor)
    {
        $this->visitor = $visitor;
    }
}

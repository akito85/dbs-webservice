<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Trip;

class TripWasDeleted extends Event
{
    public $trip;

    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }
}

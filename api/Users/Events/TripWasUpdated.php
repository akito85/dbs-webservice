<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Trip;

class TripWasUpdated extends Event
{
    public $trip;

    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }
}

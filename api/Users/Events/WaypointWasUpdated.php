<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Waypoint;

class WaypointWasUpdated extends Event
{
    public $waypoint;

    public function __construct(Waypoint $waypoint)
    {
        $this->waypoint = $waypoint;
    }
}

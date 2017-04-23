<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Vehicle;

class VehicleWasDeleted extends Event
{
    public $vehicle;

    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }
}

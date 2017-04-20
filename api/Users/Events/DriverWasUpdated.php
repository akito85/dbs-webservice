<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Driver;

class DriverWasUpdated extends Event
{
    public $driver;

    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }
}

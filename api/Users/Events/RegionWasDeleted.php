<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Region;

class RegionWasDeleted extends Event
{
    public $region;

    public function __construct(Region $region)
    {
        $this->region = $region;
    }
}

<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Division;

class DivisionWasCreated extends Event
{
    public $division;

    public function __construct(Division $division)
    {
        $this->division = $division;
    }
}

<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Checkpoint;

class CheckpointWasCreated extends Event
{
    public $checkpoint;

    public function __construct(Checkpoint $checkpoint)
    {
        $this->checkpoint = $checkpoint;
    }
}

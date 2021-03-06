<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Feedback;

class FeedbackWasDeleted extends Event
{
    public $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }
}

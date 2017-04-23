<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Site;

class SiteWasDeleted extends Event
{
    public $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }
}

<?php

namespace Api\Users\Events;

use Infrastructure\Events\Event;
use Api\Users\Models\Site;

class SiteWasUpdated extends Event
{
    public $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }
}

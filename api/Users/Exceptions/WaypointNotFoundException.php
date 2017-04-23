<?php

namespace Api\Users\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WaypointNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The waypoint was not found.');
    }
}

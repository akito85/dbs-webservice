<?php

namespace Api\Users\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TripNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The trip was not found.');
    }
}

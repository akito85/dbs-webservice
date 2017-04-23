<?php

namespace Api\Users\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VehicleNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The vehicle was not found.');
    }
}

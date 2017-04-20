<?php

namespace Api\Users\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DriverNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The driver was not found.');
    }
}

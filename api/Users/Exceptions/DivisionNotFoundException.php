<?php

namespace Api\Users\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DivisionNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The division was not found.');
    }
}
